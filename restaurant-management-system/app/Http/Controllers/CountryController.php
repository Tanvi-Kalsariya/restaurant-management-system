<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    //
    public function getCountryList(Request $request)
    {
        // $response = Http::get('https://restcountries.com/v3.1/all');
        // $result = json_decode( $response->collect(), true );
        // $data=array();
        // foreach($result as $item){
        //     $data[] = array('country'=>$item["name"]["common"],'country code' => $item["cca2"]);
        // }
        // return view("home", ['data'=>$data]);
        $search = $request['search'];
        if($search != "" ){
            $country = Country::where('country', 'like', '%' .$search. '%')->get();
        }
        else{
            $country = Country::all();
        }
        return view("home", compact(['country','search']));

    }
    
    public function addCountry(){
        $response = Http::get('https://restcountries.com/v3.1/all');
        $result = json_decode( $response->collect(), true );
        $data=array();
        foreach($result as $item){
            $data[] = array('country'=>$item["name"]["common"],'country code' => $item["cca2"]);

            Country::updateOrCreate(
                [
                    'country' => $item["name"]["common"],
                    'country code' => $item["cca2"]
                ],
                [
                    'country' => $item["name"]["common"],
                    'country code' => $item["cca2"]
                ]
            );
        }
        // dd("hello");
        return back();
    }

    public function serchCountry(Request $request){
        
        // if($request->ajax()){
            $country = Country::where('country', 'like', '%' .$request->search. '%')->orWhere('country code', 'like', '%' .$request->search. '%')->get();
            $output = '';
            if(count($country) > 0){
                $output = "<ul class='list-group'>";
                foreach($country as $cname){
                    $output .= 
                    '<tr>
                        <td>'.$cname['country'].'</td>
                        <td>'.$cname['country code'].'</td>
                    </tr>';
                }
                $output .= "</ul>";
            }
            // else{
            //     $output .= "<li class='list-group-item'>No Data Found</li>";
            // }
            return response($output);
        // }   
        // return view("home");
    }
}

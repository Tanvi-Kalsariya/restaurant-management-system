<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    //
    public function getCountryList()
    {
        $response = Http::get('https://restcountries.com/v3.1/all');
        $result = json_decode( $response->collect(), true );
        $data=array();
        foreach($result as $item){
            $data[] = array('country'=>$item["name"]["common"],'shourt_code' => $item["cca2"]);
        }
        return view("home", ['data'=>$data]);
    }
}

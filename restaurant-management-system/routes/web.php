<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::controller(CountryController::class)->group(function(){
    Route::get('/home','getCountryList')->name('getCountryList');
    Route::get('addCountry','addCountry')->name('addCountry');
    Route::get('/search','serchCountry')->name('serchCountry');
});

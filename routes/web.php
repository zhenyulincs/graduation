<?php

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

Auth::routes();

Route::any('/home', 'HomeController@UserProducesManagement')->name('home');
Route::get('/query', 'HomeController@queryApi');
Route::get('/queryuser', 'HomeController@queryUserApi');
Route::get('/messagecheckout/{id}','HomeController@messageCheckout');
Route::prefix("admin")->group(function() {
    Route::any('producesmanagement', 'HomeController@adminProducesManagement');
    Route::any('/', 'HomeController@adminUser')->name('admin');
    Route::any('message', 'HomeController@adminMessage');
    Route::post('message/submit', 'HomeController@adminMessage');
    Route::any('personalinfo', 'HomeController@adminPersonalInfo');
});
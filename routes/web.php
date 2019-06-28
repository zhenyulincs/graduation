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
Route::any('/personalinfo', 'HomeController@PersonalInfo');
Route::prefix("admin")->name('admin.')->group(function() {
    Route::any('producesmanagement', 'HomeController@adminProducesManagement')->name('producesmanagement');
    Route::any('/', 'HomeController@adminUser');
    Route::any('message', 'HomeController@adminMessage')->name('message');
    Route::any('personalinfo', 'HomeController@adminPersonalInfo')->name('personalinfo');
    Route::post('message/submit', 'HomeController@adminMessage')->name('message.submit');
});
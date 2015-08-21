<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::pattern('id', '[0-9]+');
Route::pattern('lat', '([0-9]+).([0-9]+)');
Route::pattern('lng', '([0-9]+).([0-9]+)');
Route::pattern('radius', '[0-9]+');
Route::get('itembyid/{id}', 'MapController@getItemById');
Route::get('itembylatlng/{lat}/{lng}', 'MapController@getItemByLatLng');
Route::get('itemsincircle/{lat}/{lng}', 'MapController@getItemsInCircle');
Route::get('itemsincircle/{lat}/{lng}/{radius}', 'MapController@getItemsInCircle');
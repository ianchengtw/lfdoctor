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
    return view('landingpage');
});
Route::get('jquery', function () {
    return view('jquery');
});
Route::get('mobile_factory', function() {
	return view('mobilefactory');
});

Route::pattern('id', '[0-9]+');
Route::pattern('lat', '([0-9]+).([0-9]+)');
Route::pattern('lng', '([0-9]+).([0-9]+)');

Route::get('itembyid/{id}', 'MapController@getItemById');
Route::post('itembyid/{id}', 'MapController@getItemById');

Route::get('itembyname/{name}', 'MapController@getItemByName');
Route::post('itembyname/{name}', 'MapController@getItemByName');

Route::get('itembylatlng/{lat}/{lng}', 'MapController@getItemByLatLng');
Route::post('itembylatlng/{lat}/{lng}', 'MapController@getItemByLatLng');

Route::get('itemsincircle/{lat}/{lng}', 'MapController@getItemsInCircle');
Route::post('itemsincircle/{lat}/{lng}', 'MapController@getItemsInCircle');

Route::get('itemsincircle', 'MapController@getItemsInCircle');
Route::post('itemsincircle', 'MapController@getItemsInCircle');

Route::get('itemsincirclebytype', 'MapController@getItemsInCircleByType');
Route::post('itemsincirclebytype', 'MapController@getItemsInCircleByType');

Route::get('itemsincirclebytypetime', 'MapController@getItemsInCircleByTypeTime');
Route::post('itemsincirclebytypetime', 'MapController@getItemsInCircleByTypeTime');

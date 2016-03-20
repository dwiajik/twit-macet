<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as' => 'maps', 'uses' => 'MapsController@index'
    ]);

    Route::get('/tweets', [
        'as' => 'tweets', 'uses' => 'TweetsController@index'
    ]);
    Route::get('/tweets/datatable', [
        'as' => 'tweets.datatable', 'uses' => 'TweetsController@datatable'
    ]);

    Route::get('/about', [
        'as' => 'index', 'uses' => 'AboutController@index'
    ]);
});

Route::group(['middleware' => ['api']], function () {
    Route::get('maps/placeInfo', [
        'as' => 'maps.placeInfo', 'uses' => 'MapsController@getPlaceInfo'
    ]);
});

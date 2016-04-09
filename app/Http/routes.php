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
        'as' => 'map', 'uses' => 'MapController@index'
    ]);

    Route::get('/auth/login', [
        'as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin'
    ]);

    Route::get('/tweet', [
        'as' => 'tweet', 'uses' => 'TweetController@index'
    ]);
    Route::get('/tweet/datatable', [
        'as' => 'tweet.datatable', 'uses' => 'TweetController@datatable'
    ]);

    Route::get('/analytic', [
        'as' => 'analytic', 'uses' => 'AnalyticController@index'
    ]);
    Route::get('/analytic/api/v1/timeColumnChart', [
        'as' => 'analytic', 'uses' => 'AnalyticController@timeColumnChartAPI'
    ]);
    Route::get('/analytic/api/v1/dayColumnChart', [
        'as' => 'analytic', 'uses' => 'AnalyticController@dayColumnChartAPI'
    ]);
    Route::get('/analytic/api/v1/lineChart', [
        'as' => 'analytic', 'uses' => 'AnalyticController@lineChartAPI'
    ]);

    Route::get('/about', [
        'as' => 'index', 'uses' => 'AboutController@index'
    ]);

    Route::auth();

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index');

        Route::group(['prefix' => 'location'], function() {
            Route::get('/', [
                'as' => 'location', 'uses' => 'LocationController@index'
            ]);
            Route::get('/datatable', [
                'as' => 'location.datatable', 'uses' => 'LocationController@datatable'
            ]);
            Route::get('/create', [
                'as' => 'location.create', 'uses' => 'LocationController@create'
            ]);
            Route::get('/{location}/edit', [
                'as' => 'location.edit', 'uses' => 'LocationController@edit'
            ]);
            Route::post('/', [
                'as' => 'location.store', 'uses' => 'LocationController@store'
            ]);
            Route::get('/{location}/delete', [
                'as' => 'location.destroy', 'uses' => 'LocationController@destroy'
            ]);
        });

        Route::get('/auth/logout', [
            'as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout'
        ]);
    });
});

Route::group(['middleware' => ['api']], function () {
    Route::get('map/placeInfo', [
        'as' => 'map.placeInfo', 'uses' => 'MapController@getPlaceInfo'
    ]);
});

<?php

// use Illuminate\Http\Request;
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

    Route::post('/student','StudentController@store');
    Route::get('/getSecondHighestPocketMoney','StudentController@getSecondHighestPocketMoneyOfStudent');
    Route::get('/student/listings','StudentController@getStudentsListings');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

// });


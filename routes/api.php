<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/all', array('middleware' => 'cors', 'uses' => 'ProductController@getAllProducts'));
Route::post('/products/store', array('middleware' => 'cors', 'uses' => 'ProductController@storeProduct'));
Route::delete('/products/delete', array('middleware' => 'cors', 'uses' => 'ProductController@deleteProduct'));


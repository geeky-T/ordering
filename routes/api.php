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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
// Put routes in here
Route::post('login', 'UserLoginController@login');
Route::post('register', 'UserLoginController@register');
Route::get('end', 'UserOrderController@end');
Route::get('show', 'UserOrderController@index');
Route::post('create', 'UserOrderController@create');
Route::get('available', 'UserOrderController@available');


//Route::middleware('auth:api')

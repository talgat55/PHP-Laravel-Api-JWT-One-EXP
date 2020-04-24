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

Route::group(['middleware' => ['api'],
    'prefix' => 'member'], static function ($router) {
    Route::post('login', 'MemberController@login');
    Route::post('register', 'MemberController@register');
    Route::group(['middleware' => 'jwt.verify'], static function ($router) {
        Route::post('logout', 'MemberController@logout');
        Route::post('refresh', 'MemberController@refresh');
        Route::get('detail', 'MemberController@detail');
    });
});
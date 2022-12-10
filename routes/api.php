<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('obat', 'Api\ObatController@index');
Route::get('obat/{id}', 'Api\ObatController@show');
Route::post('obat', 'Api\ObatController@store');
Route::put('obat/{id}', 'Api\ObatController@update');
Route::delete('obat/{id}', 'Api\ObatController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
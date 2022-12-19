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

Route::get('User/{username}', 'Api\UserController@show');
Route::put('User/{username}', 'Api\UserController@update');

Route::get('transaksi', 'Api\TransaksiController@index');
Route::post('transaksi', 'Api\TransaksiController@store');
Route::delete('transaksi/{id}', 'Api\TransaksiController@destroy');
Route::delete('transaksi', 'Api\TransaksiController@destroyAll');

Route::get('suplemen', 'Api\SuplemenController@index');
Route::get('suplemen/{id}', 'Api\SuplemenController@show');
Route::post('suplemen', 'Api\SuplemenController@store');
Route::put('suplemen/{id}', 'Api\SuplemenController@update');
Route::delete('suplemen/{id}', 'Api\SuplemenController@destroy');

Route::get('kontrasepsi', 'Api\KontrasepsiController@index');
Route::get('kontrasepsi/{id}', 'Api\KontrasepsiController@show');
Route::post('kontrasepsi', 'Api\KontrasepsiController@store');
Route::put('kontrasepsi/{id}', 'Api\KontrasepsiController@update');
Route::delete('kontrasepsi/{id}', 'Api\KontrasepsiController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

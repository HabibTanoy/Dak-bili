<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'App\Http\Controllers\BillController@viewBillList')->name('dashboard');
Route::get('/bill-search', 'App\Http\Controllers\BillDetailsController@billDateFilter')->name('date-filter');
Route::get('/bill-id', 'App\Http\Controllers\BillDetailsController@billSearchById')->name('bill-search');
Route::get('/registry', 'App\Http\Controllers\BillController@registry')->name('registry');
Route::get('/gep', 'App\Http\Controllers\BillController@gep')->name('gep');
Route::get('/parcel', 'App\Http\Controllers\BillController@parcel')->name('parcel');
Route::get('/phone-bill', 'App\Http\Controllers\BillController@phoneBill')->name('tele-bill');
Route::get('/wasa-bill', 'App\Http\Controllers\BillController@wasaBill')->name('wasa-bill');

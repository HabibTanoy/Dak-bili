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
Route::get('/', 'App\Http\Controllers\BillController@viewBillList');
//Route::get('/bill-details/{id}', 'App\Http\Controllers\BillController@perBillDetails')->name('bill-details');
Route::get('/gep-list', 'App\Http\Controllers\BillController@viewGep')->name('list-gep');

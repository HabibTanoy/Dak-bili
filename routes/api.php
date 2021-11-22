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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bill-list', 'App\Http\Controllers\BillStatusController@allBillListed');
Route::post('/bill-assigned', 'App\Http\Controllers\BillStatusController@billCreated');
Route::post('/bill-delivered', 'App\Http\Controllers\BillStatusController@billDelivered');
Route::post('/bill-cancelled', 'App\Http\Controllers\BillStatusController@billNotDelivered');


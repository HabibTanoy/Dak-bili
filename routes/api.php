<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/all-bill', 'App\Http\Controllers\BillStatusController@billList');
Route::get('/bill-list', 'App\Http\Controllers\BillStatusController@allBillListed');
Route::get('/suggestion', 'App\Http\Controllers\BillStatusController@autocompleteSearch');
Route::post('/bill-assigned', 'App\Http\Controllers\BillStatusController@billCreated');
Route::post('/bill-delivered', 'App\Http\Controllers\BillStatusController@billDelivered');
Route::post('/bill-cancelled', 'App\Http\Controllers\BillStatusController@billNotDelivered');
Route::post('/update-status', 'App\Http\Controllers\BillStatusController@billStatusUpdate');


<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\PostOfficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class,'login'])->name('login'); // Login from dashboard
Route::post('register',[AuthController::class,'register']); // register new user
Route::post('logout', [AuthController::class,'logout']);
Route::post('refresh', [AuthController::class,'logout']); // refresh token
Route::get('auth/user', [AuthController::class,'me']);
Route::post('change-password',[AuthController::class,'changePassword']); //change password
Route::post('save_post_office',[PostOfficeController::class,'savePostOffice']);//save post office
Route::get('get-post-office',[PostOfficeController::class,'getPostOffice']); // get post office

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

// Temp API
Route::get('/bill-search', 'App\Http\Controllers\BillDetailsController@billDateFilter');
Route::get('/bill-id', 'App\Http\Controllers\BillDetailsController@billSearchById');
Route::get('/bill-types', 'App\Http\Controllers\BillDetailsController@searchByBillTypes');
Route::get('/bill-types-count', 'App\Http\Controllers\BillDetailsController@billTypesCount');

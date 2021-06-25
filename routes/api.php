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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Tạo services
Route::get('/services/getall', 'ServicesController@get');
Route::post('/services/create', 'ServicesController@store');
Route::get('/services/getone', 'ServicesController@edit');
Route::put('/services/update', 'ServicesController@update');
Route::get('/services/getDelete', 'ServicesController@getDelete');
Route::delete('/services/delete', 'ServicesController@delete');

// lấy ra order của customer
Route::get('/order/read', 'OrderController@getOrder');
Route::get('/order/customerget', 'OrderController@getOrderCustomer');
Route::get('/order/getone', 'OrderController@getOneOrder');
Route::put('/order/update', 'OrderController@update');

// lcập nhật thông tin customer
Route::put('/customer/update', 'DisplayCustomerController@infoupdate');

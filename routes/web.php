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


// Auth Customer

Route::get('/', 'DisplayCustomerController@index')->name('customer.index');



// Before Login
Route::middleware(['checklogincustomer:auth'])->group(function () {
	Route::get('login', 'DisplayCustomerController@login')->name('customer.login');
	Route::post('login', 'AuthenCustomerController@login')->name('customer.login');
	Route::get('register', 'DisplayCustomerController@register')->name('customer.register');
	Route::post('register', 'AuthenCustomerController@create')->name('customer.register');

    Route::get('resetPassword', 'CustomerController@resetPassword')->name('customer.resetPassword');
    Route::post('sendLinkPassword', 'CustomerController@sendLinkPassword')->name('customer.sendLinkPassword');
});
// After login
Route::middleware(['checklogincustomer:customer'])->group(function () {
	Route::post('logout', 'AuthenCustomerController@logout')->name('customer.logout');

	// danh sách đơn hàng
	Route::get('/order', 'DisplayCustomerController@order')->name('customer.order');
	

	//danh sách dịch vụ
	Route::get('customer-services', 'DisplayCustomerController@services')->name('customer.services');
	Route::get('customer-services-detail/{id}', 'DisplayCustomerController@servicesDetail')->name('customer.servicesDetail');


	// tạo đơn hàng mới
	Route::get('/create/{id}', 'DisplayCustomerController@create')->name('customer.create');
	Route::get('/create-defaul/{id}', 'DisplayCustomerController@create2')->name('customer.create2');
	Route::post('/create', 'DisplayCustomerController@store')->name('customer.store');
	Route::get('checkout', 'DisplayCustomerController@checkout')->name('customer.checkout');

	// thực hiện đặt hàng
	Route::post('createOrder', 'DisplayCustomerController@createOrder')->name('customer.createOrder');

	// lấy ra đơn hàng đã đặt để chỉnh sửa
	Route::get('order-edit/{id}', 'DisplayCustomerController@orderEdit')->name('customer.orderEdit');
	Route::get('order-view/{id}', 'DisplayCustomerController@orderView')->name('customer.orderView');
	Route::post('order-remove', 'DisplayCustomerController@orderRemove')->name('customer.orderRemove');

	// láy ra thông tin customer
	Route::get('info', 'DisplayCustomerController@info')->name('customer.info');
	Route::post('infoupdate', 'DisplayCustomerController@infoupdate')->name('customer.infoupdate');

	// Thanh toán online qua API
    Route::post('payment', 'PaymentController@create_pay')->name('customer.create_pay');
    Route::get('return-vnpay', 'PaymentController@return_pay')->name('customer.return_vnpay');

    // đổi mật khẩu
    Route::post('updatePassword', 'CustomerController@updatePassword')->name('customer.updatePassword');

});


// Auth Admin
Route::prefix('admin')->group(function () {
	// Before Login
	Route::middleware(['checklogin:auth'])->group(function () {
		Route::get('login', 'DisplayController@login')->name('admin.login');
		Route::post('login', 'AuthenController@login')->name('admin.login');
		// Route::get('register', 'DisplayController@register')->name('admin.register');
		// Route::post('register', 'AuthenController@register')->name('admin.register');
	});
	// After login
	Route::middleware(['checklogin:admin'])->group(function () {
		Route::get('/', 'DisplayController@order')->name('admin.order');
		Route::post('logout', 'AuthenController@logout')->name('admin.logout');

		Route::get('/order-admin-view/{id}', 'DisplayController@orderView')->name('admin.orderView');
		Route::post('/order-admin-view', 'DisplayController@orderUpdateStatus')->name('admin.orderUpdateStatus');

	    Route::prefix('services')->group(function () {
			Route::get('index', 'ServicesController@index')->name('services.index');
			Route::post('/create', 'ServicesController@store')->name('services.store');
			Route::get('/edit/{id}', 'ServicesController@edit')->name('services.edit');
			Route::post('/edit/{id}', 'ServicesController@update')->name('services.edit');
		});
	    Route::prefix('user')->group(function () {
			Route::get('index', 'CustomerController@index')->name('user.index');
			Route::get('change-status/{id}', 'CustomerController@update')->name('user.change');

		});

	});


	Route::middleware(['checklogin:admin'])->group(function () {
		Route::post('/create', 'ServicesController@store');
	});
});

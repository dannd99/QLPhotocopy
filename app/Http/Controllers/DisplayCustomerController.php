<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\OrderRequest;
use Session;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Services;
use App\Repositories\ServicesRepository;
use App\Repositories\OrderRepository;
use App\Repositories\CustomerRepository;

class DisplayCustomerController extends Controller
{
    protected $order;
    protected $services;
    protected $customer;

    public function __construct(Order $order, Services $services, Customer $customer)
    {
        $this->order 		= new OrderRepository($order);
        $this->services 	= new ServicesRepository($services);
        $this->customer 	= new CustomerRepository($customer);
    }
	// trả về trang đăng nhập
	public function login(){
		return view('customer.auth.login'); 
	}
	// trả về trang đăng kí
	public function register(){
		return view('customer.auth.register'); 
	}


	// trang dịch vụ
	public function index(){
		$services 	= $this->services->getAll();
		return view('customer.index', compact('services')); 
	}


	// trang dịch vụ
	public function services(){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		$services 	= $this->services->getAll();
		return view('customer.services.index', compact('services', 'customer_info')); 
	}
	// trang dịch vụ
	public function servicesDetail($id){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		$service 	= $this->services->find($id);
		return view('customer.services.detail', compact('service', 'customer_info')); 
	}

	// trả về trang đặt hàng
	public function create(Request $request, $id){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
		$service 	= $this->services->find($id);
		return view('customer.order.create', compact('user_id', 'service', 'customer_info')); 
	}
	// trả về trang đặt hàng
	public function create2(Request $request, $id){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
		$service 	= $this->services->find($id);
		return view('customer.order.create2', compact('user_id', 'service', 'customer_info')); 
	}

	// trả về trang đơn hàng
	public function order(Request $request){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		return view('customer.order.index', compact('user_id', 'customer_info')); 
	}
	public function store(OrderRequest $request){
		$service = $this->services->find($request->services_id);
		$order       = new Orders();
        $order->create($request, $service);
        $request->session()->put('order', $order);
		return redirect()->route('customer.checkout');  
	}
	// trả về trang thanh toán
	public function checkout(Request $request){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		$order       = Session('order');
		if ($order) {
			$service = $this->services->find($order->services_id);
			return view('customer.order.checkout', compact('order', 'service', 'customer_info')); 
		}else{
			return redirect()->route('customer.services')->with('error', 'Bạn chưa tạo đơn hàng nào cả !!');  
		}
		
	}
	// thực hiện đặt hàng
	public function createOrder(Request $request){
		$order       = Session('order');
		$data 		= [
			"customer_id"		=> $order->customer_id,
			"services_name"		=> $order->services_name,
			"services_prices"	=> $order->services_prices,
			"printed_start"		=> $order->printed_start,
			"printed_end"		=> $order->printed_end,
			"url"		 		=> $order->url,
			"note"		 		=> $order->note,
			"total_prices"		=> $order->total_prices,
			"status"			=> 0,
			"payment_status"	=> 0,
			"slide"				=> $order->slide,
			"copy"				=> $order->copy,
		];
		$this->order->create($data);
		$request->session()->forget('order');
		return redirect()->route('customer.order')->with('success' ,'Bạn đã đặt hàng thành công');
	}
	// trả về form chỉnh sửa đơn hàng
	public function orderEdit(Request $request, $id){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		$order 	= $this->order->find($id);
		$service 	= $this->services->findName($order->services_name);
		return view('customer.order.edit', compact('user_id', 'service', 'order', 'customer_info')); 
	}
	// trả về form xem đơn hàng
	public function orderView(Request $request, $id){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		$order 	= $this->order->find($id);
		$service 	= $this->services->findName($order->services_name);
		return view('customer.order.view', compact('user_id', 'service', 'order', 'customer_info')); 
	}


	// yêu cầu hủy đơn
	public function orderRemove(Request $request){
		$order 	= $this->order->requestRemove($request);
		return redirect()->route('customer.order')->with('success', 'Bạn đã yêu cầu hủy đơn hàng !!');  
	}
	
	// trả về trang thông tin người dùng
	public function info(Request $request){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        $customer_info = $this->customer->getCustomer($user_id);

		return view('customer.info.index', compact('customer_info')); 
	}
	// cập nhật thông tin người dùng
	public function infoupdate(Request $request){
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
		$this->customer->updateCustomer($user_id, $request);
		return redirect()->back()->with('success', 'Cập nhật thành công');  
	}

}

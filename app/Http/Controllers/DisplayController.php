<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Order;
use App\Models\Services;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ServicesRepository;

class DisplayController extends Controller
{
    protected $order;
    protected $services;

    public function __construct(Order $order, Services $services, Customer $customer)
    {
        $this->customer 	= new CustomerRepository($customer);
        $this->order 		= new OrderRepository($order);
        $this->services 	= new ServicesRepository($services);
    }
	// trả về trang đăng nhập
	public function login(Request $request){
		return view('admin.auth.login'); 
	}
	// trả về trang đơn hàng
	public function order(){
		$all = count($this->order->getOrderStatus(100));
		$Pending = count($this->order->getOrderStatus(0));
		$Confirm = count($this->order->getOrderStatus(1));
		$Processing = count($this->order->getOrderStatus(2));
		$Success = count($this->order->getOrderStatus(3));
		$Shipped = count($this->order->getOrderStatus(4));
		$RequestUnpaid = count($this->order->getOrderStatus(6));
		$Unpaid = count($this->order->getOrderStatus(5));
		return view('admin.order.index', compact('all', 'Pending', 'Confirm', 'Processing', 'Success', 'Shipped', 'RequestUnpaid', 'Unpaid')); 
	}
	// trả về trang danh sách kiểu in
	public function product(){
		return view('admin.product.index'); 
	}
	public function orderView($id){
		$order 		= $this->order->find($id);
		$customer 	= $this->customer->getCustomer($order->customer_id);
		$service 	= $this->services->findName($order->services_name);
		return view('admin.order.edit', compact('order', 'service', 'customer')); 
	}
	public function orderUpdateStatus(Request $request){
		$status = 0;
		// lấy ra order
		$order_data = $this->order->find($request->order_id);
		if ($order_data->status == 0) {
			$status = 1;
		}else if ($order_data->status == 1) {
			$status = 2;
		}else if ($order_data->status == 2) {
			$status = 3;
		}else if ($order_data->status == 3) {
			$status = 4;
		}else if ($order_data->status == 6) {
			$status = 5;
		}
		$this->order->orderUpdateStatus($request->order_id, $status);
		return redirect()->route('admin.order');  
	}
}

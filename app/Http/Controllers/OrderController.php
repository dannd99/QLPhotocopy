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

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order 		= new OrderRepository($order);
    }
    public function getOrder(Request $request){
        return $this->order->getOrderStatus($request->status);
    }
    public function getOrderCustomer(Request $request){
    	return $this->order->getOrderCustomer($request->customer_id);
    }
    public function getOneOrder(Request $request){
        return $this->order->findOrder($request->customer_id, $request->id);
    }
    public function update(Request $request){
        return $this->order->updateOrder($request);
    }

}

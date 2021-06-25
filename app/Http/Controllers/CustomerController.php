<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Password;
use Illuminate\Support\Facades\Cookie;
use DB;
use Session;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Repositories\AuthCustomerRepository;

class CustomerController extends Controller
{

    private $customer;

    public function __construct(Customer $customer){
        $this->customer = new CustomerRepository($customer);
        $this->token 	= new AuthCustomerRepository($customer);
    }
	public function updatePassword(Password $request){

        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');
        list($user_id, $token) = explode('$', $token, 2);
        /**
         * passwordRequest sễ Kiểm tra dữ liệu nhập vào theo đúng định dạng ... file ở app/Http/Requests/Password
         *
         * Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
         */
        $checkPassword = $this->customer->password($request, $user_id);
        if ($checkPassword) {
			Cookie::queue(Cookie::forget('customer_token'));
	        $request->session()->forget('customer_token');
	        Cookie::queue('customer_token', $this->token->createTokenClient($user_id), 2628000);
            Session::flash('pass_success', 'Đổi Mật Khẩu Thành Công!');

        }else{
            Session::flash('pass_error', 'Mật khẩu Cũ không đúng!');
        }
        return redirect()->back();
	}
    public function resetPassword(){
        return view('customer.auth.resetPassword');
    }
    public function sendLinkPassword(Request $request){
        dd($request);
    }


    public function index(){
        $users = $this->customer->getAllCustomer();
        return view('admin.user.index', compact('users'));
    }
    public function update($id){
        $this->customer->customerBlock($id);
        return redirect()->route('user.index')->with('success', 'Đã thay đổi trạng thái !!');  
    }


}

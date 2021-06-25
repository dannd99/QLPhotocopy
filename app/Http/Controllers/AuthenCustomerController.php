<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthCustomerRepository;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class AuthenCustomerController extends Controller
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer 	= new AuthCustomerRepository($customer);
    }

	// thực hiện đnăg kí
	public function create(RegisterRequest $request){
		// kiểm tra email đã tồn tại chưa
		if ($this->customer->checkEmail($request->email)) {
			return redirect()->back()->with('error', 'Email đã tồn tại!!!');   
		}else{
			$secret_key 	= $this->customer->generateSecretKey();
			$customer = [
                'secret_key'        =>  $secret_key,
                'email'             =>  $request->email,
                'password'          =>  Hash::make($request->password),
                'status'            => '1',
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
			];
			$this->customer->create($customer);
			return redirect()->route('customer.login')->with('success', 'Đăng kí thành công !!');  
		}
	}

	// thực hiện đnăg nhập
	public function login(LoginRequest $request){
		// kiểm tra tài khoản đăng nhập
		$user_id = $this->customer->checkLogin($request->email, $request->password);
		if ($user_id) {
			// tạo customer_token client
			if ($request->remember) {
			    $name_cookie = Cookie::queue('customer_token', $this->customer->createTokenClient($user_id), 2628000);
			}else{
        		$request->session()->put('customer_token', $this->customer->createTokenClient($user_id));
			}
			return redirect()->back()->with('success', 'Đăng nhập thành công');  
		}else{
			return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác'); 
		}
	}
	// # đăng xuất
	public function logout(Request $request){
		Cookie::queue(Cookie::forget('customer_token'));
        $request->session()->forget('customer_token');
		return redirect()->route('customer.login')->with('success', 'Đăng xuất thành công');  
	}


}
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use App\Models\Authen;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

use Illuminate\Http\Request;

class AuthenController extends Controller
{
    protected $authen;

    public function __construct(Authen $authen)
    {
        $this->authen 	= new AuthRepository($authen);
    }
	public function register(AuthRequest $request){
		// kiểm tra email đã tồn tại chưa
		if ($this->authen->checkEmail($request->email)) {
			return redirect()->back()->with('error', 'Email đã tồn tại!!!');   
		}else{
			if ($this->authen->registerAccount( $request->email, $request->password, $this->authen->generateSecretKey() )) {
				return redirect()->back()->with('success', 'Đăng kí thành công');  
			}else{
				return redirect()->back()->with('error', 'Đăng kí thất bại'); 
			}
		}
	}
	public function login(LoginRequest $request){
		// kiểm tra tài khoản đăng nhập
		$user_id = $this->authen->checkLogin($request->email, $request->password);
		if ($user_id) {
			// tạo token client
			if ($request->remember) {
			    $name_cookie = Cookie::queue('token', $this->authen->createTokenClient($user_id), 2628000);
			}else{
        		$request->session()->put('token', $this->authen->createTokenClient($user_id));
			}
			return redirect()->back()->with('success', 'Đăng nhập thành công');  
		}else{
			return redirect()->back()->with('error', 'Tên tài khoản hoặc mật khẩu không chính xác'); 
		}
	}
	// # đăng xuất
	public function logout(Request $request){
		Cookie::queue(Cookie::forget('token'));
        $request->session()->forget('token');
		return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công');  
	}
}

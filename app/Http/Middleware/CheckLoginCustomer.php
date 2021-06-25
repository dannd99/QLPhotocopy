<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Session;
use Hash;
use App\Models\Customer;
use DB;

class CheckLoginCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $url)
    {   
        $token = Session('customer_token') ? Session('customer_token') : $request->cookie('customer_token');

        // kiểm tra route có thuộc diện chưa đăng nhập : 'auth' = chưa đăng nhập
        if ($url == 'auth') {
            // kiểm tra có tồn tại token
            if ($token) {
                list($user_id, $token) = explode('$', $token, 2);
                $user = DB::table('customer_account')->where('id', '=', $user_id)->first();
                if ($user) {
                    $secret_key     = $user->secret_key;
                    // kiểm tra token có hợp lệ
                    if ($user->status) {
                        if (Hash::check($user_id . '$' . $secret_key, $token)) {
                            return redirect()->route('customer.order');
                        }else{
                            Cookie::queue(Cookie::forget('customer_token'));
                            $request->session()->forget('customer_token');
                            return redirect()->route('customer.login')->with('success', 'Token đã hết hạn');  
                        }
                    }else{
                        $request->session()->forget('customer_token');
                        Cookie::queue(Cookie::forget('customer_token'));
                        return redirect()->route('customer.login')->with('error', 'Tài khoản đã bị khóa!');  
                    }
                }else{
                    $request->session()->forget('customer_token');
                    Cookie::queue(Cookie::forget('customer_token'));
                    return redirect()->route('customer.login')->with('success', 'Tài khoản không tồn tại!');  
                }
            }else{
                return $next($request);
            }
        }else{
            // kiểm tra có tồn tại token
            if ($token) {
                list($user_id, $token) = explode('$', $token, 2);
                $user = DB::table('customer_account')->where('id', '=', $user_id)->first();
                if ($user->status) {
                    if ($user) {
                        $secret_key     = $user->secret_key;

                        if (Hash::check($user_id . '$' . $secret_key, $token)) {
                            return $next($request);
                        }else{
                            Cookie::queue(Cookie::forget('customer_token'));
                            $request->session()->forget('customer_token');
                            return  redirect()->route('customer.login')->with('success', 'Token đã hết hạn');  
                        }
                    }else{
                        $request->session()->forget('customer_token');
                        Cookie::queue(Cookie::forget('customer_token'));
                        return redirect()->route('customer.login')->with('success', 'Tài khoản không tồn tại!');  
                    }
                }else{
                    $request->session()->forget('customer_token');
                    Cookie::queue(Cookie::forget('customer_token'));
                    return redirect()->route('customer.login')->with('error', 'Tài khoản đã bị khóa!');  
                }
            }else{
                return redirect()->route('customer.login')->with('success', 'Bạn cần đăng nhập để thực hiện hành động này');  
            }
        }
    }
}

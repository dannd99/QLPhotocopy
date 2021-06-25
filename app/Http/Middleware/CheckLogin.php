<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Session;
use Hash;
use App\Models\Authen;

class CheckLogin
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
        $token = Session('token') ? Session('token') : $request->cookie('token');
        // kiểm tra route có thuộc diện chưa đăng nhập : 'auth' = chưa đăng nhập
        if ($url == 'auth') {
            // kiểm tra có tồn tại token
            if ($token) {
                list($user_id, $token) = explode('$', $token, 2);
                $secret_key     = Authen::findOrFail($user_id)->secret_key;
                // kiểm tra token có hợp lệ
                return Hash::check($user_id . '$' . $secret_key, $token) ? redirect()->route('admin.order') : redirect()->route('admin.login')->with('success', 'Token đã hết hạn');  
            }else{
                return $next($request);
            }
        }else{
            // kiểm tra có tồn tại token
            if ($token) {
                list($user_id, $token) = explode('$', $token, 2);
                $secret_key     = Authen::findOrFail($user_id)->secret_key;
                // kiểm tra token có hợp lệ
                return Hash::check($user_id . '$' . $secret_key, $token) ? $next($request) : redirect()->route('admin.login')->with('success', 'Token đã hết hạn');  
            }else{
                return redirect()->route('admin.login')->with('success', 'Bạn cần đăng nhập để thực hiện hành động này');  
            }
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuthenticate
{
    // nếu chưa đăng nhập bên admin thì trả về route có tên admin.login
    // đã đăng nhâp thì thực hiện yêu cầu request
    public function handle($request, Closure $next)
    {
        // if($_SERVER["SERVER_NAME"] != 'localhost') {
        //     $kdm = DB::table('options')->where('name','sudo')->first();
        //     if (!$kdm || $kdm->value != md5($_SERVER["SERVER_NAME"])) {
        //         exit();
        //     }
        // }
            
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}

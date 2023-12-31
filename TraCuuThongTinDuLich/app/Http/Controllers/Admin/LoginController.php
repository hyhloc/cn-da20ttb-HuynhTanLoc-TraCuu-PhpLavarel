<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DB;
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function __construct()
    {
        //
    }
    public function login(Request $request)
    {
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $request->merge([$field => $request->input('login')]);

        if (Auth::guard('admin')->attempt($request->only($field, 'password')))
        {
            return redirect('/admin');
        }

        return redirect('/admin/login')->withErrors([
            'error' => 'Sai tài khoản hoặc mật khẩu',
        ]);
    }

    public function showLoginForm() {
        if (!Auth::guard('admin')->check()){
            return view('admin.auth.login');
        }else{
            return redirect()->route('admin.dashboard');
        }
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        if (!Auth::check() && !Auth::guard('admin')->check()) {
            $request->session()->flush();
            $request->session()->regenerate();
        }
        return redirect(route('admin.login'));
    }
}

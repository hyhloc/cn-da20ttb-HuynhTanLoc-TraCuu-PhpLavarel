<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DB;
use App;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check()){
            if(Auth::guard('admin')->user()->status == 2){
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with(['flash_level'=>'danger','flash_message'=>'Tài khoản không được hoạt động']);
            }elseif(Auth::guard('admin')->user()->status == 3){
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with(['flash_level'=>'danger','flash_message'=>'Tài khoản đang bị cấm']);
            }elseif(Auth::guard('admin')->user()->status == 4){
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with(['flash_level'=>'danger','flash_message'=>'Tài khoản không tồn tại']);
            }else{
                return view('admin.dashboard');
            }
        }
        else{
            return redirect()->route('admin.login');
        }
    }
}

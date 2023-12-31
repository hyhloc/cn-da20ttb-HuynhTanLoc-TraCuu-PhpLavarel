<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\MyForm\MyForm;
use DB;
use Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->module_name = 'tài khoản quản trị';
        $this->table_name = 'users';
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request) {
        $table = $this->table_name;
        $data = DB::table($table)->where('id','<>','1')->whereNotIn('status',[4])->get();
        $status = [
            '1'=>'Publisher',
            '2'=>'Nháp',
            '3'=>'Thùng rác',
        ];
        return view('admin.users.index',compact('data','table','status'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array = [
            '0'=>'Chọn lựa',
            '1'=>'Chọn lựa 1',
            '2'=>'Chọn lựa 2',
        ];
        $form = new MyForm();
        $data_form[] = $form->text('name','',1,'Tên đăng nhập');
        $data_form[] = $form->text('email','',1,'Email');
        $data_form[] = $form->passwordGenerate('password','',1,'Mật khẩu','Nhập mật khẩu hoặc dùng tính năng tạo tự động','comfirm_password');
        $data_form[] = $form->password('comfirm_password','',1,'Nhập lại mật khẩu');
        $data_form[] = $form->checkbox('status',1,1,'Kích hoạt');
        $data_form[] = $form->action('add');
        return view('admin.layouts.create',compact('data_form'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate_form($request,'name',1,'Bạn chưa nhập tên',1,'Tên đã được sử dụng');
        $this->validate_form($request,'email',1,'Bạn chưa nhập email',1,'Email đã được sử dụng');
        $this->validate_form($request,'password',1,'Bạn chưa nhập mật khẩu');
        $this->validate_form($request,'comfirm_password',1,'Bạn chưa nhập lại mật khẩu');
        $created_at = $updated_at = date("Y-m-d H:i:s");
        $data_form = $request->all();
        $status = 2;
        extract($data_form,EXTR_OVERWRITE);
        if($password != $comfirm_password){
            return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Mật khẩu không trùng khớp!']);
        }elseif (passwordStrength($password) < 4) {
            return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Mật khẩu phải lớn hơn 6 ký tự, nên có đủ ký tự hoa, thường, số hoặc ký tự đặc biệt']);
        }else{
            $password = bcrypt($password);
            $data_insert = compact('name','email','password','status','created_at','updated_at');
            $id_insert = DB::table($this->table_name)->insertGetId($data_insert);
            return redirect(route($this->table_name.'.'.$redirect,$id_insert))->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data_edit = DB::table($this->table_name)->where('id',$id)->first();

        $form = new MyForm();
        $data_form[] = $form->text('name',$data_edit->name,1,'Tên đăng nhập','',0,'','disabled');
        $data_form[] = $form->text('email',$data_edit->email,1,'Email','',0,'','disabled');
        $data_form[] = $form->checkbox('change_password',0,1,'Đổi mật khẩu');
        $data_form[] = $form->passwordGenerate('password','',0,'Mật khẩu','','comfirm_password');
        $data_form[] = $form->password('comfirm_password','',0,'Nhập lại mật khẩu');
        $data_form[] = $form->checkbox('status',$data_edit->status,1,'Kích hoạt');
        $data_form[] = $form->action('edit');

        return view('admin.layouts.edit',compact('data_form','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkRole($this->table_name.'_edit');
        $updated_at = date("Y-m-d H:i:s");

        $data_form = $request->all();
        $status = 2;
        extract($data_form,EXTR_OVERWRITE);
        if(isset($change_password) && $change_password == 1) {
            if($password != $comfirm_password){
                return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Mật khẩu không trùng khớp!']);
            }elseif (passwordStrength($password) < 4) {
                return redirect()->back()->with(['flash_level'=>'danger','flash_message'=>'Mật khẩu phải lớn hơn 6 ký tự, nên có đủ ký tự hoa, thường, số hoặc ký tự đặc biệt']);
            }else{
                $password = bcrypt($password);
            }
            $data_update = compact('password','status','updated_at');
        }else {
            $data_update = compact('status','updated_at');
        }

        DB::table($this->table_name)->where('id',$id)->update($data_update);
        return redirect(route($this->table_name.'.'.$redirect,$id))->with(['flash_level'=>'success','flash_message'=>'Cập nhật dữ liệu thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table($this->table_name)->where('id',$id)->update(['status'=>4]);
        return response()->json(['status'=>1,'message'=>'Xóa thành công']);
        
    }
    public function changePassword()
    {
        $form = new MyForm();
        $data_form=[];
        $data_form[]=$form->password('password','',1,'Mật khẩu cũ');
        $data_form[]=$form->passwordGenerate('password_new','',1,'Mật khẩu mới','Nhập mật khẩu hoặc dùng tính năng tạo tự động','repassword_new');
        $data_form[]=$form->password('repassword_new','',1,'Nhập lại mật khẩu mới');
        $data_form[]=$form->action('edit');
        return view('admin.auth.change_password',compact('data_form'));
    }
    public function postChangePassword(Request $request){
        $password=$request->password;
        $password_new=$request->password_new;
        $repassword_new=$request->repassword_new;
        if (!Hash::check($password, Auth::guard('admin')->user()->password)) {
            return redirect()->route('admin.admin_user.changePassword')->with(['flash_level'=>'danger','flash_message'=>'Nhập mật khẩu cũ không đúng !']);
        }
        elseif($password_new!=$repassword_new){
            return redirect()->route('admin.admin_user.changePassword')->with(['flash_level'=>'danger','flash_message'=>'Nhập mật khẩu mới không trùng khớp!']);
        }elseif (passwordStrength($password_new) < 4) {
            return redirect()->route('admin.admin_user.changePassword')->with(['flash_level'=>'danger','flash_message'=>'Mật khẩu phải lớn hơn 6 ký tự, nên có đủ ký tự hoa, thường, số hoặc ký tự đặc biệt']);
        }else{
            DB::table('admin_users')->where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($password_new)]);
            return redirect()->route('admin.admin_user.changePassword')->with(['flash_level'=>'success','flash_message'=>'Cập nhật mật khẩu thành công !']);
        }
    }
}

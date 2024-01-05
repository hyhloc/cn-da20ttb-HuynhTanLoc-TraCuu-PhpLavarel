<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\MyForm\MyForm;
use DB;
use Auth;

class CategoriesController extends Controller
{
    function __construct()
    {
        $this->module_name = 'Danh mục';
        $this->table_name = 'categories';
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table = $this->table_name;
        $data = DB::table($table)->whereNotIn('name', [4])->paginate(20);

        // dump($data);
        return view('admin.categories.index',compact('data','table',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::guard('admin')->check()){
            $form = new MyForm();
            $data_form[] = $form->text('name','',1,'Tiêu đề bài viết','VD: Cồn Phụng');
            $data_form[] = $form->action('add');
            return view('admin.layouts.create',compact('data_form'));
        }else {
            return redirect()->route('admin.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate_form($request,'name',1,'Bạn chưa nhập tên',1,'Tên đã được sử dụng');
        $created_at = $updated_at = date("Y-m-d H:i:s");
        $data_form = $request->all();
        $thumnail = null;
        $slides = null;
        // dump($request->all());
        extract($data_form,EXTR_OVERWRITE);
        // dd($data_form);
        if($created_at == null) {
            $created_at = date("Y-m-d H:i:s");
        }
        $thumnail = $this->uploadFileImage($thumnail);
        $slides = $this->uploadFileSlideImage($slides);
        // dd($slides);
        $data_insert = compact(
            'name',
        );
        $id_insert = DB::table($this->table_name)->insertGetId($data_insert);

        return redirect(route($this->table_name.'.'.$redirect,$id_insert))->with(['flash_level'=>'success','flash_message'=>'Thêm mới thành công!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::guard('admin')->check()){
            $data_edit = DB::table($this->table_name)->find($id);
            $form = new MyForm();
            $data_form[] = $form->text('name',$data_edit->name,1,'Tiêu đề bài viết','VD: Cồn Phụng');
            $data_form[] = $form->action('edit');
            return view('admin.layouts.edit',compact('data_form','id'));
        }else {
            return redirect()->route('admin.login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data_edit = DB::table($this->table_name)->find($id);
        $this->validate_form($request,'name',1,'Bạn chưa nhập tiêu đề');
        $updated_at = date("Y-m-d H:i:s");
        $data_form = $request->all();
        $slides = null;
        $thumnail = null;
        extract($data_form,EXTR_OVERWRITE);
        // dd($request->all());
        if(!empty($thumnail)) {
            $thumnail = $this->uploadFileImage($thumnail);
        }else {
            $thumnail = $data_edit->thumnail??null;
        }
        if(!empty($slides)) {
            $slides = $this->uploadFileSlideImage($slides);
        }else {
            $slides = $data_edit->slides??null;
        }
        $data_update = compact(
            'name'
        );

        DB::table($this->table_name)->where('id',$id)->update($data_update);
        return redirect(route($this->table_name.'.'.$redirect,$id))->with(['flash_level'=>'success','flash_message'=>'Cập nhật dữ liệu thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table($this->table_name)->where('id',$id)->update([
            'status'=>4,
            'name' => DB::raw("CONCAT(name, '--delete--".time()."')"),
        ]);
        return response()->json(['status'=>1,'message'=>'Xóa thành công']);
    }
}

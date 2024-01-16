<?php

namespace App\Http\Controllers\Admin;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\MyForm\MyForm;
use DB;
use Auth;

class LocationController extends Controller
{
    function __construct()
    {
        $this->module_name = 'địa điểm du lịch';
        $this->table_name = 'locations';
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
        // $data = DB::table($table)->whereNotIn('status',[4])->paginate(20);
        $status = [
            '1'=>'Publisher',
            '2'=>'Nháp',
            '3'=>'Thùng rác',
        ];
        // foreach($data as $dt){
        $data = Locations::with('category')->get();
           
        // }
        return view('admin.locations.index',compact('data','table','status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::guard('admin')->check()){
            $category_array= [];
            $categories= DB::table('categories')->get();
            $category_array['0'] = '--Chọn loại hình du lịch--';
            foreach ($categories as $key => $value) {
                $category_array[$value->id??0] = $value->name??'';
            }
            $form = new MyForm();
            $data_form[] = $form->text('name','',1,'Tiêu đề bài viết','VD: Cồn Phụng');
            $data_form[] = $form->text('slug','',1,'Slug bài viết (Url)','VD: con-phung');
            $data_form[] = $form->image('thumnail','',0,'Ảnh thumnail');
            $data_form[] = $form->slides_image('slides','',0);
            $data_form[] = $form->text('address','',0,'Địa chỉ','VD: huyện Châu Thành, Bến Tre');
            $data_form[] = $form->select('categories_id','',0,'Chọn loại hình du lịch',$category_array);
            $data_form[] = $form->text('price','',0,'Giá ');
            $data_form[] = $form->textarea('description','',0,'Mô tả');
            $data_form[] = $form->editor('detail','',0,'Nội dung');
            $data_form[] = $form->textarea('maps','',0,'iframe Google Maps');
            $data_form[] = $form->checkbox('status',1,1,'Publisher');
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
        $this->validate_form($request,'slug',1,'Đường dẫn không được để trống');
        $created_at = $updated_at = date("Y-m-d H:i:s");
        $data_form = $request->all();
        $status = 2;
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
            'categories_id','name','slug','thumnail','slides','address','maps','price',
            'description','detail','status','created_at','updated_at'
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
            $category_array = [];
            $categories = DB::table('categories')->get();
            $category_array['0'] = '--Chọn loại hình du lịch--';
            foreach ($categories as $key => $value) {
                $category_array[$value->id??0] = $value->name??'';
            }
            $form = new MyForm();
            $data_form[] = $form->text('name',$data_edit->name,1,'Tiêu đề bài viết','VD: Cồn Phụng');
            $data_form[] = $form->text('slug',$data_edit->slug,1,'Slug bài viết (Url)','VD: con-phung');
            $data_form[] = $form->image('thumnail',$data_edit->thumnail,0,'Ảnh thumnail');
            $data_form[] = $form->slides_image('slides',explode(',',$data_edit->slides),0);
            $data_form[] = $form->text('address',$data_edit->address,0,'Địa chỉ','VD: huyện Châu Thành, Bến Tre');
            $data_form[] = $form->select('categories_id',$data_edit->categories_id,0,'Chọn loại hình du lịch',$category_array);
            $data_form[] = $form->text('price','',0,'Giá');
            $data_form[] = $form->textarea('description',$data_edit->description,0,'Mô tả');
            $data_form[] = $form->editor('detail',$data_edit->detail,0,'Nội dung');
            $data_form[] = $form->textarea('maps',$data_edit->maps,0,'iframe Google Maps');
            $data_form[] = $form->checkbox('status',$data_edit->status,1,'Publisher');
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
        $this->validate_form($request,'slug',1,'Đường dẫn không được để trống');
        $updated_at = date("Y-m-d H:i:s");
        $data_form = $request->all();
        $status = 2;
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
            'categories_id','name','slug','thumnail','slides','address','maps','price',
            'description','detail','status','updated_at'
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
            'slug' => DB::raw("CONCAT(slug, '--delete--".time()."')")
        ]);
        return response()->json(['status'=>1,'message'=>'Xóa thành công']);
    }
}

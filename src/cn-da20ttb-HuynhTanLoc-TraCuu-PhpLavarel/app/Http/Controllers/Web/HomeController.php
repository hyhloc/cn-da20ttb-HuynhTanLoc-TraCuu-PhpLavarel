<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Locations;
use App\Models\Hotels;
use App\Models\Foods;
use App\Models\Categories;
use Auth;
use DB;
use App;

class HomeController extends Controller
{
    public function index()
    {
        $foods = Foods::where('status',1)->limit(4)->get();
        $hotels = Hotels::where('status',1)->limit(4)->get();
        $locations = Locations::where('status',1)->limit(4)->get();
        $title_seo = "Trang chủ";
       
        return view('web.home.index',compact('title_seo','locations','hotels','foods',));
    }
    
    public function loginUser(){
        return view('admin.index');
    }


    public function diadiem(Request $request){
        $searchTerm = $request->input('searchTerm');
        $categories = Categories::all();
        $query = Locations::where('status', 1)
            ->where(function ($query) use ($searchTerm,) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%');
    
            });

        $locations = $query->paginate(8);   
        $title_seo = "Kết quả tìm kiếm";
        return view('diadiem', compact('title_seo', 'locations', 'searchTerm','categories',));
    }

    public function home()
    {
        return redirect()->route('app.home');
    }

    public function luutru(Request $request){
        $searchTerm = $request->input('searchTerm');
    
        // Thực hiện truy vấn cơ sở dữ liệu để tìm kiếm
        $hotels = Hotels::where('status', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%');
            })
            ->paginate(8);   
        $title_seo = "Kết quả tìm kiếm";
                
        return view('luutru', compact('title_seo', 'hotels', 'searchTerm'));
    }

    public function amthuc(Request $request){
        $searchTerm = $request->input('searchTerm');
        $foods = Foods::where('status', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%');
            })
            ->paginate(8);  
        $title_seo = "Kết quả tìm kiếm";      
        return view('amthuc', compact('title_seo', 'foods', 'searchTerm'));
    }

    public function searchdd($slug){
        $data = Locations::where('slug',$slug)->where('status',1)->firstOrFail();
        // Lấy các nhà hàng ẩm thực có location_id  liên quan
        $foods = Foods::where('status',1)
            ->where('location_id',$data->id)
            ->limit(4)->get();
         // Lấy các dịch vụ lưu trú có location_id  liên quan
        $hotels = Hotels::where('status',1)
            ->where('location_id',$data->id)
            ->limit(4)->get();
            $ct = $data->categories_id;
            $category = Categories::find($ct);
            $categoryName = $category ? $category->name : '';            
        $name = Categories :: where('id', $data->categories_id)->first();
        $category = Categories::where('id',$ct)->first();
        $title_seo = $data->name??'';
        return view('searchdd',compact('title_seo','data','foods','hotels','category','name','categoryName'));
    }

    public function searchamthuc($slug){
        $data = Foods::where('slug',$slug)->where('status',1)->firstOrFail();
        $title_seo = $data->name??'';
        return view('searchamthuc',compact('title_seo','data'));
    }

    public function searchluutru($slug){
        $data = Hotels::where('slug',$slug)->where('status',1)->firstOrFail();
        $title_seo = $data->name??'';
        return view('searchluutru',compact('title_seo','data'));
    }

    public function categories(Request $request,$id){
        //$locationss= Locations::where('categories_id', $id)->get();
        $searchTerm = $request->input('searchTerm');
        $categories = Categories::all();
        $query = Locations::where('categories_id', $id)
            ->where(function ($query) use ($searchTerm,) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%');   
            });      
        $locations = $query->paginate(8);   
        $title_seo = "Kết quả tìm kiếm";
        return view('diadiem', compact('title_seo', 'locations', 'searchTerm','categories',)); 
    } 
}


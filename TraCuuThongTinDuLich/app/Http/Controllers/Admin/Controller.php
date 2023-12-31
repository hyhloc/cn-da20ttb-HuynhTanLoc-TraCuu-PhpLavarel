<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use Image;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use View;

class Controller extends BaseController
{
	public $module_name;
    public $table_name;

    function __construct()
    {
        View::share('module_name', $this->module_name);
        View::share('table_name',$this->table_name);
    }

    public function validate_form($request,$field, $required = 1, $required_message = '', $unique = 0, $unique_message = '') {
        if ($required)
            $request->validate([$field => 'required'],[$field.'.required' => $required_message]);
        if ($unique)
            $request->validate([$field => 'unique:'.$this->table_name],[$field.'.unique' => $unique_message]);
        return;
    }

    public function saveOne(Request $request) {
        if($request->ajax()){
            $id = $request->get('id');
            $table = $request->get('table');
            $data = $request->get('data');
            $data = json_decode($data,true);
            $check = DB::table($table)->where('id',$id)->first();
            if ($check) {
                $save_count = DB::table($table)->where('id',$id)->update($data);
                if ($save_count == 1) {
                    return response()->json(['status'=>1,'message'=>'Sửa thành công','ids'=>$id,'table'=>$table]);
                }else {
                    return response()->json(['status'=>0,'message'=>'Bạn chưa thay đổi dữ liệu hoặc có lỗi xảy ra với thao tác']);
                }
            }else {
                return response()->json(['status'=>0,'message'=>'Không tìm thấy dữ liệu cần sửa']);
            }
            
        }else {
            return response()->json(['status'=>0,'message'=>'Hành động bị cấm !']);
        }
    }
    public function saveAll(Request $request) {
        if($request->ajax()){
            $table = $request->get('table');
            $data = $request->get('data');
            $data = json_decode($data,true);
            $count = 0;
            $ids = [];
            foreach ($data as $value) {
                if(isset($value['id'])) {
                    $id = $value['id'];
                    $ids[] = $id;
                    unset($value['id']);
                    $save_count = DB::table($table)->where('id',$id)->update($value);
                    if ($save_count == 1) {
                        $count++;
                        return response()->json(['status'=>1,'message'=>'Sửa thành công','ids'=>$id,'table'=>$table]);
                    }
                }
            }

            if ($count > 0) {
                return response()->json(['status'=>1,'message'=>'Sửa thành công '.$count.' bản ghi','ids'=>implode(',',$ids),'table'=>$table]);
            }else {
                return response()->json(['status'=>0,'message'=>'Bạn chưa thay đổi dữ liệu hoặc có lỗi xảy ra với thao tác','ids'=>implode(',',$ids),'table'=>$table]);
            }
        }else {
            return response()->json(['status'=>0,'message'=>'Hành động bị cấm !']);
        }
    }
    //Upload file ảnh
    public function uploadFileImage($files) {
        $files = $files;
        $url_image = '';
        if(!empty($files)) {
            $month = date('m');
            $year = date('Y');
            $path = $year.'/'.$month.'/';
            $file_pathinfo = pathinfo($files->getClientOriginalName());
            $file_name = $file_pathinfo['filename'];
            $file_name = $this->beautiful_name($file_name);
            $file_extension = $file_pathinfo['extension'];
            $file_size = filesize($files);
            //Tên kèm đường dẫn
            $imageName = $file_name.'.'.$file_extension;

            $upload = Storage::disk('local');
            //Check kiểm tra nếu có ảnh trùng tên thì thêm kí tự vào ảnh mới
            $i=0;
            while($upload->fileExists($path.$imageName)) {
                $i++;
                $imageName = $file_name.'-'.$i.'.'.$file_extension;
            }
            $upload->put($path.$imageName, file_get_contents($files), 'public');
            $url_image = url('uploads').'/'.$path.$imageName;
            // dd($url_image);
            
        }else {
            $url_image = '';
        }
        return $url_image;
    }
    //Upload file slide ảnh
    public function uploadFileSlideImage($files) {
        $files = $files;
        $link_image = [];
        if(!empty($files) && count($files)>0) {
            $j=0;
            foreach ($files as $file) {
                if(!empty($file))
                $month = date('m');
                $year = date('Y');
                $path = $year.'/'.$month.'/';
                $file_pathinfo = pathinfo($file->getClientOriginalName());
                $file_name = $file_pathinfo['filename'];
                $file_name = $this->beautiful_name($file_name);
                $file_extension = $file_pathinfo['extension'];
                $file_size = filesize($file);
                //Tên kèm đường dẫn
                $imageName = $file_name.'.'.$file_extension;

                $upload = Storage::disk('local');
                //Check kiểm tra nếu có ảnh trùng tên thì thêm kí tự vào ảnh mới
                $i=0;
                while($upload->fileExists($path.$imageName)) {
                    $i++;
                    $imageName = $file_name.'-'.$i.'.'.$file_extension;
                }
                $upload->put($path.$imageName, file_get_contents($file), 'public');
                $link_image[$j++] = url('uploads').'/'.$path.$imageName;
            }
            
            // dump($link_image);
        }
        return implode(',',$link_image);;
    }
    protected function beautiful_name($string) {
        $coDau = array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ",
            "è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ","ê","ù","à");
        $khongDau = array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","e","u","a");
        $string = str_replace($coDau,$khongDau,$string);
        $string  =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
        $string  =  str_replace(" ","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("--","-",$string);
        $string = str_replace("/","-",$string);
        return strtolower($string);
    }
}


<?php 

namespace App\MyForm;
/**
* 
*/
class MyForm
{
	/**
     * @param string $name - tên trường dữ liệu
     * @param string $value - Giá trị hiện tại
     * @param int $required - có bắt buộc hay không (1 | 0)
     * @param string $title - Tên label
     * @param string $placeholder
     * @param int $slug - có trường slug không (1 | 0)
     * @param string $slugField - tên trường slug để map (trong db hay để luôn là slug)
     * @return array
     */
    function text($name = '', $value = '', $required = 0, $title = 'Tiêu đề', $placeholder = '',$slug = 0, $slugField = 'slug',$extra = '') {
        return ['store'=>'text','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'placeholder'=>$placeholder,'slug'=>$slug,'slugField'=>$slugField,'extra'=>$extra];
    }

    function password($name = '', $value = '', $required = 0, $title = 'Tiêu đề', $placeholder = '') {
        return ['store'=>'password','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'placeholder'=>$placeholder];
    }
    function passwordGenerate($name = '', $value = '', $required = 0, $title = 'Tiêu đề', $placeholder = '',$confirm='') {
        return ['store'=>'passwordGenerate','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'placeholder'=>$placeholder,'confirm'=>$confirm];
    }
    function select($name = '', $value = '', $required = 0, $title = '', $options = [], $select2 = 0, $disabled = []) {
        return ['store'=>'select','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'options'=>$options,'select2'=>$select2,'disabled'=>$disabled];
    }
    function textarea($name = '', $value = '', $required = 0, $title = '', $placeholder = '') {
        return ['store'=>'textarea','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'placeholder'=>$placeholder];
    }
    function image($name = '', $value = '', $required = 0, $title = 'Ảnh đại diện', $title_btn = 'Chọn làm ảnh đại diện',$helper_text = '') {
        return ['store'=>'image','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'title_btn'=>$title_btn,'helper_text'=>$helper_text];
    }
    function slides_image($name = '', $value = '', $required = 0, $title = 'Ảnh slides', $title_btn = 'Chọn làm ảnh slides',$helper_text = '') {
        return ['store'=>'slides_image','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title,'title_btn'=>$title_btn,'helper_text'=>$helper_text];
    }
    function editor($name = '', $value = '', $required = 0, $title = '') {
        return ['store'=>'editor','name'=>$name,'value'=>$value,'required'=>$required,'title'=>$title];
    }
    function checkbox($name = '', $value = '', $checked = 1, $title) {
        return ['store'=>'checkbox','name'=>$name,'value'=>$value, 'checked' => $checked, 'title'=>$title];
    }
    function action($store = 'store',$preview = '') {
        return ['store'=>$store,'preview'=>$preview];
    }
}
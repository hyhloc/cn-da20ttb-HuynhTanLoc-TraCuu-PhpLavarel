<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * Toàn bộ các function phần admin
 */
function change_time_to_text($time,$type = null){
    if(!is_numeric($time)){
        $time = strtotime($time);
    }
    if($type == 'update'){
        $text = 'Cập nhật khoảng ';
    }else{
        $text = '';
    }
    if((time() - $time) < 60){
        return $text.round(time()-$time).' giây trước';
    }elseif((time() - $time) < 60*60){
        return $text.round((time() - $time)/60).' phút trước';
    }elseif ((time() - $time) < 60*60*24){
        return $text.round(((time()-$time)/60)/60).' giờ trước';
    }else{
        return date('H:i:s A d/m/Y',$time);
    }
}
function show_editor_sudo_media($name_textare,$height,$default = null){
    $option = '<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        tinymce.init({
            path_absolute : "/",
            selector:\'textarea[id="'.$name_textare.'"]\',
            branding: false,
            hidden_input: false,
            relative_urls: false,
            convert_urls: false,
            height : '.$height.',
            autosave_ask_before_unload:true,
            autosave_interval:\'10s\',
            autosave_restore_when_empty:true,
            entity_encoding : "raw",
            fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 36pt 40pt 46pt 52pt 60pt",
            plugins: [
                "textcolor",
                "advlist autolink lists link image imagetools charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table autosave contextmenu paste wordcount"
            ],
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            language: "vi_VN",
            autosave_retention:"30m",
            autosave_prefix: "tinymce-autosave-{path}{query}-{id}-",
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            toolbar: "insertfile undo redo table sudomedia charmap | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | forecolor " +
            "backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent " +
            "indent | link unlink fullscreen restoredraft filemanager",
            setup: function (editor) {
                editor.addButton(\'sudomedia\', {
                  text: \'Tải ảnh\',
                  icon: \'image\',
                  label:\'Nhúng ảnh vào nội dung\',
                  onclick: function () {
                    media_popup("add","tinymce","'.$name_textare.'","Chèn ảnh vào bài viết");
                  }
                });
              },
            file_picker_callback: function() {
                    media_popup("add","tinymce","'.$name_textare.'","Chèn ảnh vào bài viết");
            }
        });
    });
    </script>';
    $option .= '<textarea id="'.$name_textare.'" name="'.$name_textare.'">'.$default.'</textarea>';
    return $option;
}
function passwordGenerate($length = 12) {
    $characters = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*()';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function passwordStrength($password) {
    $strength = 0;
    if (strlen($password) < 6) {//Phải có 6 ký tự trở lên
        return $strength;
    }else {
        $strength++;
    }
    if (preg_match("@\d@", $password)) {//Nên có ít nhất 1 số
        $strength++;
    }
    if (preg_match("@[A-Z]@", $password)) {//Nên có ít nhất 1 chữ hoa
        $strength++;
    }
    if (preg_match("@[a-z]@", $password)) {//Nên có ít nhất 1 chữ thường
        $strength++;
    }
    if (preg_match("@\W@", $password)) {//Nên có 1 ký tự đặc biệt
        $strength++;
    }
    if (!preg_match("@\s@", $password)) {//Không nên có ký tự rỗng
        $strength++;
    }
    return $strength;// = 6 - Tùy vào mức độ cần thiết của ứng dụng mà đưa ra số strength yêu cầu
}
function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen( $chars );
    $str = '';
    for( $i = 0; $i < $length; $i++ ) {
    $str .= $chars[ rand( 0, $size - 1 ) ];
     }
    return $str;
}

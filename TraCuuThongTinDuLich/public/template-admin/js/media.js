/**
 *
 * @param view tab hiểu thi mặc định: add | list
 * @param type kiểu chèn vào trường image hay editor: single | tinymce
 * @param element id thẻ html chèn giá trị
 * @param text Nội dụng text của button chèn ảnh
 */
// upload ảnh trong editor
function media_upload_editor() {
   alert(12);
}
//check file upload ảnh
$('body').on('change','*[data-uploadimageadmin]', function(e){
    file = this.files;
    str = '';
    check_size = 0;
    check_extention = 0;
    allowed_size = 12097152; // Tổng kích thước các file là được dặt trong config
    allowed_extention = ['png','jpg','jpeg','gif','PNG','JPG','JPEG','GIF'];
    $.each(file,function(index,file_data) {
        if (file_data.size > allowed_size) {
            check_size = 1;
        }
        if ($.inArray(file_data.name.split('.').pop().toLowerCase(), allowed_extention) == -1) {
            check_extention = 1;
        }
        url_file = URL.createObjectURL(file_data);
        str += url_file;
        // alert(str);
    });
    if (check_size == 1) {
        message = "File ảnh phải có kích thước nhỏ hơn 2MB";
        alert('message');
    }else if(check_extention == 1) {
        message = "Định dạng cho phép: 'png','jpg','jpeg','gif','PNG','JPG','JPEG','GIF'";
        alert('message');
    }else {
        // console.log(str);
        $(this).closest('.form-group').find('.thumb-img').attr('src',str);
    }
});
//check file upload slide ảnh
$('body').on('change','*[data-uploadimageslideadmin]', function(e){
    file = this.files;
    str = '';
    check_size = 0;
    check_extention = 0;
    allowed_size = 12097152; // Tổng kích thước các file là được dặt trong config
    allowed_extention = ['png','jpg','jpeg','gif','PNG','JPG','JPEG','GIF'];
    $.each(file,function(index,file_data) {
        if (file_data.size > allowed_size) {
            check_size = 1;
        }
        if ($.inArray(file_data.name.split('.').pop().toLowerCase(), allowed_extention) == -1) {
            check_extention = 1;
        }
        url_file = URL.createObjectURL(file_data);
        url_file;
        str += '<img src="'+url_file+'" class="thumb-img" style="width: 120px;">'+' ';
    });
    if (check_size == 1) {
        message = "File ảnh phải có kích thước nhỏ hơn 2MB";
        alert('message');
    }else if(check_extention == 1) {
        message = "Định dạng cho phép: 'png','jpg','jpeg','gif','PNG','JPG','JPEG','GIF'";
        alert('message');
    }else {
        // slide_img = str.split("-");
        $(this).closest('.form-group').find('.slide-image-preview').html(str);
    }
});
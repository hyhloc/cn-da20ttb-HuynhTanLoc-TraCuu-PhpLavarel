jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (typeof $.datetimepicker !== "undefined") {
        $.datetimepicker.setLocale('vi');
        $('.datepicker').datetimepicker({
            timepicker:false,
            format:'Y-m-d'
        });
        $('.datetimepicker').datetimepicker({
            format:'Y-m-d H:i:s',
            defaultTime:'00:00:00',
            formatTime:'H:i:s'
        });
    }

    $('.close-alert').on('click',function(){
        $('.alert-success').fadeOut();
    });
    $('.close-error').on('click',function(){
        $('.alert-danger').fadeOut();
    });
    
    $('.select2').select2();

    //Các input có class tags dùng jquery.tagsinput.js
    $('.tags').tagsInput({
        //'autocomplete_url': url_to_autocomplete_api,
        //'autocomplete': { option: value, option: value},
        'height':'40px',
        'width':'100%',
        'interactive':true,
        'defaultText':'thêm tag',
        //'onAddTag':callback_function,
        //'onRemoveTag':callback_function,
        //'onChange' : callback_function,
        'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
        'removeWithBackspace' : true,
        'minChars' : 0,
        'maxChars' : 0, // if not provided there is no limit
        'placeholderColor' : '#666666'
    });

    //Lấy slug cho về link preview seo
    if($('.preview_snippet_link').length && $('#slug').length) {
        setInterval(function(){ 
            $slug = $('#slug').val();
            $('.preview_snippet_link span').html($slug);
        }, 2000);
    }
    //Đếm ký tự tiêu đề meta seo
    $(".in_title").on("keyup",function(){
        $(".preview_snippet_title").html($(this).val());
        $(".in_title_count").html($(this).val().length);
    });
    //Đếm ký tự mô tả meta seo
    $(".in_des").on("keyup",function(){
        $(".preview_snippet_des").html($(this).val());
        $(".in_des_count").html($(this).val().length);
    });

    //Click nút ghim
    $('.btn-pins').on('click',function () {
        var type = $(this).attr('data-type');
        var type_id = $(this).closest('.record-data').attr('data-id');
        var place = $(this).attr('data-place');
        var pin_group = $(this).closest('.pins-group');
        var value = pin_group.find('input').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {type: type,type_id: type_id,place: place,value: value},
            url: '/admin/ajax/pins',
            success: function (result) {
                pin_group.find('.loading-wrap').remove();
                bootbox.alert(result.message);
            },
            beforeSend: function () {
                pin_group.append('<div class="loading-wrap"><img src="/template-admin/images/loading.gif"></div>')
            }
        });
    });
    //js cho relate field
    //ajax search khi keyup
    $('.relate-search').on('keyup',function () {
        var relateSearch = $(this);
        var relateForm = relateSearch.closest('.form-relate');
        var relateTable = relateSearch.attr('data-table');
        var relateId = relateSearch.attr('data-id');
        var relateName = relateSearch.attr('data-name');
        var inputName = relateForm.attr('data-name');
        var keyword = relateSearch.val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {table: relateTable, id: relateId, name: relateName, key: keyword},
            url: '/admin/ajax/relate-suggest',
            success: function (result) {
                if(result.status == 1) {
                    var result_data = result.data;
                    var str = '';
                    for(var i = 0; i < result_data.length; i++) {
                        var obj = result_data[i];
                        str += '<li class="relate-suggest-item" data-id="'+obj.id+'">'+obj.name+'</li>';
                    }
                    relateForm.find('.relate-suggest').html(str);
                }else {
                    relateForm.find('.relate-suggest').html(result.message);
                }
            }
        });
    });
    //click chọn từ suggest
    $('.form-relate').on('click','.relate-suggest-item',function () {
        var relateForm = $(this).closest('.form-relate');
        var id = $(this).attr('data-id');
        var name = $(this).html();
        var inputName = relateForm.attr('data-name');
        var str = '';
        str += '<p class="relate-item">';
        str += '<input type="hidden" name="'+inputName+'[]" value="'+id+'">';
        str += name;
        str += '<a href="javascript:;" class="relate-item-remove"><i class="fa fa-times"></i></a>';
        str += '</p>';
        relateForm.find('.relate-result').append(str);
        $('.relate-suggest').html('');
    });
    //click nút remove item relate
    $('.form-relate').on('click','.relate-item-remove',function () {
        $(this).closest('.relate-item').remove();
    });
});
function validForm(form,list){
    var elements = list.split(',');
    var valid = true;
    var check_focus = true;
    for(i in elements){
        if($('#'+elements[i]).hasClass('multi-check')) {//valid cho kiểu multicheck
            if($('input[name="'+elements[i]+'[]"]:checked').length == 0) {
                $('#'+elements[i]).css({border:'1px solid #ff0000'});
                valid = false;
            }else {
                $('#'+elements[i]).css({border:'1px solid #ccc'});
            }
        }
        else if($('#'+elements[i]).hasClass('slide-check')) {//valid cho kiểu slide
            if($('#'+elements[i]).find('.result_image_item').length == 0) {
                $('#'+elements[i]).css({border:'1px solid #ff0000'});
                valid = false;
            }else {
                $('#'+elements[i]).css({border:'1px solid #ccc'});
            }
        }
        else if($('#'+elements[i]).hasClass('relate-search')) {//valid cho kiểu relate
            if($('#'+elements[i]).closest('.form-relate').find('.relate-item').length == 0) {
                $('#'+elements[i]).css({border:'1px solid #ff0000'});
                valid = false;
            }else {
                $('#'+elements[i]).css({border:'1px solid #ccc'});
            }
        }
        else if($('#'+elements[i]).val().trim() == '') {
            if (check_focus) {
                if($('#'+elements[i]).attr('type') == 'hidden') {//hidden cho input ảnh => border cho div controll
                    $('#'+elements[i]).parent().css({border:'1px solid #ff0000'}).focus();
                }else {
                    $('#'+elements[i]).css({border:'1px solid #ff0000'}).focus();
                    check_focus = false;
                }
            }else {
                if($('#'+elements[i]).attr('type') == 'hidden') {
                    $('#'+elements[i]).parent().css({border:'1px solid #ff0000'});
                }else {
                    $('#'+elements[i]).css({border:'1px solid #ff0000'});
                }
            }
            valid = false;
        }
        else {//nếu đã valid => trả lại trạng thái bình thường cho các element
            if($('#'+elements[i]).attr('type') == 'hidden') {
                $('#'+elements[i]).parent().css({border:'none'});
            }else {
                $('#'+elements[i]).css({border:'1px solid #ccc'});
            }
        }
    }

    if (valid) {
        document.form.submit();
    }else {
        alert('Những trường có dấu * là bắt buộc');
        return false;
    }
}
function media_remove_item(el){
    el.closest('.result_image_item').remove();
}

function check_edit(i) {
    var input = $(i).closest('tr').find('.well input');
    input.prop("checked", true);
    input.parent().removeClass('fa-square-o');
    input.parent().addClass('fa-check-square-o');
}
function check_one(i) {
    if ($(i).prop('checked')) {
        $(i).parent().removeClass('fa-square-o');
        $(i).parent().addClass('fa-check-square-o');
    } else {
        $(i).parent().addClass('fa-square-o');
        $(i).parent().removeClass('fa-check-square-o');
    }
}

function check_all() {
    if ($('#check_all').prop('checked')) {
        $('.well input.check').parent().removeClass('fa-square-o');
        $('.well input.check').parent().addClass('fa-check-square-o');
        $('.well input.check').prop("checked", true);
    } else {
        $('.well input.check').parent().addClass('fa-square-o');
        $('.well input.check').parent().removeClass('fa-check-square-o');
        $('.well input.check').prop("checked", false);
    }
}
function check_all_role(){
    if($('#check_all').prop('checked')){
        $('.well input.check').parent().removeClass('fa-square-o');
        $('.well input.check').parent().addClass('fa-check-square-o');
        $('.well input.check').prop( "checked", true );
    }else{
        $('.well input.check').parent().addClass('fa-square-o');
        $('.well input.check').parent().removeClass('fa-check-square-o');
        $('.well input.check').prop( "checked", false );
    }
}

function delete_one(id,destroy_uri) {
    if (confirm('Bạn muốn xóa vĩnh viễn bản ghi này ?')) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {id: id,_method: 'DELETE'},
            url: destroy_uri,
            success: function (result) {
                if(result.status == 1) {
                    $('#record-'+id).fadeOut('slow');
                }else {
                    bootbox.alert(result.message);
                }
            }
        });
    }
}
function delete_all(table) {
    if (confirm('Bạn muốn xóa vĩnh viễn các bản ghi đã chọn ?')) {
        var ids = [];
        $('tr.record-data').each(function () {
            if ($(this).find('.check').is(":checked")) {
                ids.push(parseInt($(this).attr('data-id')));
            }
        });
        if(ids.length) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {ids: ids,table: table},
                url: '/admin/ajax/delete-all',
                success: function (result) {
                    if(result.status == 1) {
                        $.each(ids, function( index, value ) {
                            $('#record-'+value).fadeOut('slow');
                        });
                    }
                    bootbox.alert(result.message);
                }
            });
        }else {
            bootbox.alert('Vui lòng chọn ít nhất một bản ghi để thực hiện thao tác này');
        }
    }
}
function trash_all(table) {
    if (confirm('Bạn muốn chuyển các bản ghi đã chọn vào thùng rác ?')) {
        var ids = [];
        $('tr.record-data').each(function () {
            if ($(this).find('.check').is(":checked")) {
                ids.push(parseInt($(this).attr('data-id')));
            }
        });
        if(ids.length) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {ids: ids,table: table},
                url: '/admin/ajax/trash-all',
                success: function (result) {
                    if(result.status == 1) {
                        $.each(ids, function( index, value ) {
                            $('#record-'+value).find('select[name=status]').val(3);
                            //Bỏ check input
                            var input = $('#record-'+value).find('.well input');
                            input.checked = false;
                            input.parent().addClass('fa-square-o');
                            input.parent().removeClass('fa-check-square-o');
                        });
                    }
                    bootbox.alert(result.message);
                }
            });
        }else {
            bootbox.alert('Vui lòng chọn ít nhất một bản ghi để thực hiện thao tác này');
        }
    }
}
function deactive_all(table) {
    if (confirm('Bạn muốn chuyển các bản ghi đã chọn về trạng thái không hoạt động ?')) {
        var ids = [];
        $('tr.record-data').each(function () {
            if ($(this).find('.check').is(":checked")) {
                ids.push(parseInt($(this).attr('data-id')));
            }
        });
        if(ids.length) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {ids: ids,table: table},
                url: '/admin/ajax/deactive-all',
                success: function (result) {
                    if(result.status == 1) {
                        $.each(ids, function( index, value ) {
                            $('#record-'+value).find('select[name=status]').val(2);
                            //Bỏ check input
                            var input = $('#record-'+value).find('.well input');
                            input.checked = false;
                            input.parent().addClass('fa-square-o');
                            input.parent().removeClass('fa-check-square-o');
                        });
                    }
                    bootbox.alert(result.message);
                }
            });
        }else {
            bootbox.alert('Vui lòng chọn ít nhất một bản ghi để thực hiện thao tác này');
        }
    }
}

function save_one(id,table) {
    var data = new Object();
    $('#record-'+id).find('.quick-edit').each(function () {
        var attr_name = $(this).attr('name');
        var attr_value = $(this).val();
        data[attr_name] = attr_value;
    });
    if(!$.isEmptyObject(data)) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {id: id,table: table, data: JSON.stringify(data)},
            url: '/admin/ajax/save-one',
            success: function (result) {
                if(result.status == 1) {
                    //Bỏ check input
                    var input = $('#record-'+id).find('.well input');
                    input.checked = false;
                    input.parent().addClass('fa-square-o');
                    input.parent().removeClass('fa-check-square-o');
                }
                bootbox.alert(result.message);
            }
        });
    }
}

function save_all(table) {
    var all_data = [];
    $('.well input.check').each(function () {
        if(this.checked) {
            //console.log($(this).closest('.record-data').attr('data-id'));
            var item_id = $(this).closest('.record-data').attr('data-id');
            var data = new Object();
            data['id'] = item_id;
            $('#record-'+item_id).find('.quick-edit').each(function () {
                var attr_name = $(this).attr('name');
                var attr_value = $(this).val();
                data[attr_name] = attr_value;
            });
            if(!$.isEmptyObject(data)) {
                all_data.push(data);
            }
        }
    });
    //console.log(all_data);
    if(all_data.length) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {table: table, data: JSON.stringify(all_data)},
            url: '/admin/ajax/save-all',
            success: function (result) {
                if(result.status == 1) {

                }
                bootbox.alert(result.message);
            }
        });
    }
}


function format_price(number, decimals, dec_point, thousands_sep) {
    var _decimals = 0;
    var _dec_point = ',';
    var _thousands_sep = '.';
    $.extend(_decimals, decimals);
    $.extend(_dec_point, dec_point);
    $.extend(_thousands_sep, thousands_sep);
    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

function password_generator( len ) {
    var length = (len)?(len):(10);
    var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
    var numeric = '0123456789';
    var punctuation = '!@#$%^&*()';
    var password = "";
    var character = "";
    var crunch = true;
    while( password.length<length ) {
        entity1 = Math.ceil(string.length * Math.random()*Math.random());
        entity2 = Math.ceil(numeric.length * Math.random()*Math.random());
        entity3 = Math.ceil(punctuation.length * Math.random()*Math.random());
        hold = string.charAt( entity1 );
        hold = (password.length%2==0)?(hold.toUpperCase()):(hold);
        character += hold;
        character += numeric.charAt( entity2 );
        character += punctuation.charAt( entity3 );
        password = character;
    }
    password=password.split('').sort(function(){return 0.5-Math.random()}).join('');
    return password.substr(0,len);
}
function password_strength(password){ 
    //initial strength
    var strength = 0    
    if (password.length == 0) {
        return strength;
    }
 
    if (password.match(/[a-z]+/)) {
        strength += 1;
    }
    if (password.match(/[A-Z]+/)) {
        strength += 1;
    }
    if (password.match(/[0-9]+/)) {
        strength += 1;
    }
    if (password.match(/[!@#$%^&*()]+/)) {
        strength += 1;
    }
    if (password.length >= 6) {
        strength += 1;
    }
    return strength;
}
<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
	<div class="controls col-md-9 col-sm-10 col-xs-12">
        <div id="{!! $value['name'] !!}" class="slide-wrap slide-check">
            <input type="file" name="{!! $value['name'].'[]' !!}" id="{!! $value['name'] !!}" multiple="multiple" accept="image/png, image/jpeg" class="cps-upload file_attrack file-browser" data-uploadimageslideadmin="{!! $value['name'] !!}">
            @php
                $str_val = '';
                $str_id = $value['name'];
                if(!empty($value['value'])) {
                    foreach($value['value'] as $v) {
                        if($v != '') {

                            $str_val .= '<img src="'.$v.'" class="thumb-img" style="width: 120px;" alt="Không có ảnh"/>';
                        }
                    }
                }
            @endphp
            <div class="slide-image-preview" style="width:100%">
                {!!$str_val!!}
            </div>
            @if($value['helper_text'] != '')<p class="help-block">{!! $value['helper_text'] !!}</p>@endif
        </div>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
	<div class="controls col-md-9 col-sm-10 col-xs-12">
        <input type="file" name="{!! $value['name'] !!}" id="{!! $value['name'] !!}" multiple="multiple" accept="image/png, image/jpeg" class="cps-upload file_attrack file-browser" value="{!!$value['value']!!}" data-uploadimageadmin="{!! $value['name'] !!}">
        <img src="{!!$value['value']!!}" class="thumb-img" style="width: 200px;">
        @if($value['helper_text'] != '')<p class="help-block">{!! $value['helper_text'] !!}</p>@endif
    </div>
</div>
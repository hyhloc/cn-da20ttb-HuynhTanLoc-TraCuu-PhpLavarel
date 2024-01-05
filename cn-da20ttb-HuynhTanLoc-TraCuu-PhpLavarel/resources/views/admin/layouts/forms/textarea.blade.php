<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
    <div class="controls col-md-9 col-sm-10 col-xs-12">
	    <textarea rows="6" name="{!! $value['name'] !!}" id="{!! $value['name'] !!}" class="form-control" placeholder="{!! $value['placeholder'] !!}">{!! $value['value'] !!}</textarea>
    </div>
 </div>
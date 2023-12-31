<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
    <div class="controls col-md-9 col-sm-10 col-xs-12">
	    <select name="{!! $value['name'] !!}" id="{!! $value['name'] !!}" class="form-control{{($value['select2']==1) ? ' select2' : ''}}">
	        @foreach($value['options'] as $k => $v)
	        	@php
					$selected = '';
					if($value['value']==$k) {
						$selected = ' selected="selected"';
					}
					$disabled = '';
					if(in_array($k,$value['disabled'])) {
						$disabled = ' disabled="disabled"';
					}
	        	@endphp
	        	<option value="{!! $k !!}"{!!$selected!!}{!!$disabled!!}>{!! $v !!}</option>
	        @endforeach()
	    </select>
    </div>
 </div>
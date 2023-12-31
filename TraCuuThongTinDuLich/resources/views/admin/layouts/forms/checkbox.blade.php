<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12">{!! $value['title'] !!}</label>
	<div class="controls col-md-9 col-sm-10 col-xs-12">
	<div style="position: relative;">
			<i class="fa icon-green font-size17 mgt7 @php if($value['checked']==$value['value']){ echo 'fa-check-square-o';}else{ echo 'fa-square-o';} @endphp">
            <input style="position: absolute;
               top: -20%;
               display: block;
               height: 140%;
               margin: 0px;
               padding: 0px;
               border: 0px;
               opacity: 0;
               background: rgb(255, 255, 255);" type="checkbox" name="{!! $value['name'] !!}" value="{!! $value['checked'] !!}" id="{!! $value['name'] !!}" @php if($value['checked']==$value['value']){ echo 'checked';} @endphp  onclick="return check_one(this)"></i>
			</div>
		</div>
	</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">@if($value['required']==1)<span class="form-asterick">* </span>@endif {!! $value['title'] !!}</label>
    <div class="controls col-md-9 col-sm-10 col-xs-12">
    	<div class="input-group">
			<input type="password" class="form-control" name="{!! $value['name'] !!}" id="{!! $value['name'] !!}" value="{!! $value['value'] !!}" placeholder="{!! $value['placeholder'] !!}">
			<span class="input-group-btn">
				<button type="button" class="btn btn-primary">Tạo tự động</button>
			</span>
		</div>
		<div id="strength">
    		<span class="result"></span>
	    	<span class="str-box box1"><div></div></span>
	      	<span class="str-box box2"><div></div></span>
	      	<span class="str-box box3"><div></div></span>
	      	<span class="str-box box4"><div></div></span>
	      	<span class="str-box box5"><div></div></span>
    	</div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#{!! $value['name'] !!}').closest('.input-group').find('.btn').on('click',function(){
			var pwd = password_generator();
			var pwd_value = prompt("Mật khẩu đã được tạo tự động, hãy sao chép và lưu lại!", pwd);
			if (pwd_value != null) {
		    $('#{!! $value['name'] !!}').val(pwd_value);
		    if($('#{!! $value['confirm'] !!}').length) {
		    	$('#{!! $value['confirm'] !!}').val(pwd_value);
		    }
		    var strength = password_strength(pwd_value);
        	show_password_strength(strength);
	  	}
		});
		$('#{!! $value['name'] !!}').keyup(function(){
    	$('#strength .result').html('');
        var strength = password_strength($(this).val());
        show_password_strength(strength);
    });
    function show_password_strength(strength) {
    	var strength = (strength)?(strength):(0);
    	switch(strength) {
		  	case 1:
		    	$('#strength').removeClass().addClass('strength1');
		    	$('#strength .result').html('Rất yếu');
		    	break;
		  	case 2:
		    	$('#strength').removeClass().addClass('strength2');
		    	$('#strength .result').html('Yếu');
		    	break;
		  	case 3:
		    	$('#strength').removeClass().addClass('strength3');
		    	$('#strength .result').html('Bình thường');
		    	break;
		  	case 4:
		    	$('#strength').removeClass().addClass('strength4');
		    	$('#strength .result').html('Tốt');
		    	break;
		  	case 5:
		    	$('#strength').removeClass().addClass('strength5');
		    	$('#strength .result').html('Mạnh');
		    	break;
		  	default:
		    	$('#strength').removeClass();
		}
    }
	});
</script>
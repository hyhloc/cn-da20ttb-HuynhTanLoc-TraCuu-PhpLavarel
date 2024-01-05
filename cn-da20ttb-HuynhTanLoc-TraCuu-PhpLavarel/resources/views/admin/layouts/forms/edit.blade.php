<div class="form-actions">
	<button type="submit" name="redirect" value="edit" class="btn btn-success">Lưu lại</button>&nbsp;
	<button type="submit" name="redirect" value="index" class="btn btn-info">Lưu lại & thoát</button>&nbsp;
	@if($value['preview'] != '')
		<a href="{!! $value['preview'] !!}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Xem</a>
	@endif
	<button type="button" onclick="window.location='{!! route($table_name.'.index') !!}'" class="btn btn-danger">Thoát</button>&nbsp;
</div>
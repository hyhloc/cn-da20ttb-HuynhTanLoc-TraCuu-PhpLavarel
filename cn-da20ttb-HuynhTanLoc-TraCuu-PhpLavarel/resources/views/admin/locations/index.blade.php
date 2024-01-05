@extends('admin.layouts.app')
@section('title')
    <h3>Danh sách {{$module_name}}</h3>
@endsection()
@section('title2')
    <div class="row">
        <div class="col-sm-8 col-md-10"></div>
        <div class="col-sm-4 col-md-2 text-right">
            @if($table != 'system_logs')
                <a href="{!! route($table.'.create') !!}" class="btn btn-success"><i class="fa fa-plus"></i> Thêm mới {{$module_name}}</a>
            @endif
        </div>
    </div>
@endsection()
@section('content')
    @include('errors.alert')
    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
        <thead>
        	<tr id="0">
                <th class="center">STT</th>
                <th class="center well">
                    <div class="" style="position: relative;">
                        <i class="fa icon-green fa-square-o font-size17 " style="position: relative;">
                            <input style="position: absolute;
                        top: -20%;
                        display: block;
                        z-index: 999;
                        width: 140%;
                        height: 140%;
                        margin: 0px;
                        padding: 0px;
                        border: 0px;
                        opacity: 0;
                        background: rgb(255, 255, 255);" type="checkbox" id="check_all" class="check" onclick="return check_all()">
                        </i>
                    </div>
                </th>
                <th class="center no-sorting"><i onclick="return save_all('{!! $table !!}')" style="cursor: pointer;" class="fa fa-save pointer icon-green font-size17"></i></th>
				<th class="center">Tên địa điểm</th>
				<th class="center">Ảnh</th>
                <th class="center">Địa chỉ</th>
                <th class="center">Loại hình du lịch</th>
				<th class="center">Trạng thái</th>
				<th class="center">Sửa</th>
				<th class="center">Xoá</th>
            </tr>
        </thead>
        <tbody>
        	{{-- @dump($data) --}}
        	@foreach($data as $key => $value)
        	<tr class="record-data" id="record-{!! $value->id !!}" data-id="{!! $value->id !!}">
        		<td class="center">{{$key + 1}}</td>
        		<td class="center well">
                    <div class="" style="position: relative;">
                        <i class="fa icon-green fa-square-o font-size17 fa_{!! $value->id !!}" style="position: relative;">
                            <input style="position: absolute;
						top: -20%;
						display: block;
						z-index: 999;
						width: 140%;
						height: 140%;
						margin: 0px;
						padding: 0px;
						border: 0px;
						opacity: 0;
						background: rgb(255, 255, 255);" type="checkbox" name="" id="id_{!! $value->id !!}"  class="check" onclick="check_one(this)">
                        </i>
                    </div>
                </td>
                <td class="center">
                    <i onclick="return save_one({!! $value->id !!},'{!! $table !!}')" style="cursor: pointer;" class="fa fa-save pointer icon-green font-size17 fa-save-{!! $value->id !!}"></i>
                    <img style="display: none;" class="loading loading_save_{!! $value->id !!}" src="{!! url('/template-admin/images/loading.gif') !!}" alt="">
                </td>
        		<td width="200" class="center">{{$value->name??''}}</td>
        		<td width="120" class="center">
                    <img style="width: 80px;" src="{!! $value->thumnail??'' !!}" onerror="this.src='/template-admin/images/no-image.png'">   
                </td>
                <td width="200" align="center">{{$value->address??''}}</td>
                <td align="center">{{$value->type??''}}</td>
        		<td class="center">
        			<select class="form-control quick-edit" name="status" onchange="check_edit(this)">
        				@foreach($status as $k => $st)
        				<option value="{{$k??''}}" @if($value->status==$k??''){!! 'selected' !!} @endif()>{{$st??'No Status'}}</option>
                        @endforeach
        			</select>
        		</td>
        		<td class="center"><a href="{!! route($table.'.edit', $value->id) !!}"><i class="fa fa-pencil-square-o icon-green font-size17"></i></a></td>
        		<td class="center"><a class="delete-record" href="javascript:;" onclick="delete_one('{!! $value->id !!}','{!! route($table_name.'.destroy',$value->id) !!}')"><i class="fa fa-trash-o icon-red font-size17"></i></a></td>
        	</tr>
        	@endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>{!! $data->links() !!}</td>
            </tr>
        </tfoot>
    </table>
@endsection()
@section('script')
@endsection()

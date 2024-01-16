@extends('admin.layouts.app')
@section('title')
    <h3>Sửa {{$module_name}}</h3>
@endsection()
@section('title2')
    <h2>Những trường đánh dấu (<span style="color:red;">*</span>) là bắt buộc nhập</h2>
@endsection()
@section('content')
    @include('errors.alert')
    @include('errors.error')

    @php
    $array_valid = [];
    foreach($data_form as $value) {
        if(isset($value['required']) && $value['required'] == 1) {
            $array_valid[] = $value['name'];
        }
    }
    $string_valid = '';
    if(count($array_valid) > 0) {
        $string_valid = 'onsubmit="validForm(this,\''.implode(',',$array_valid).'\');return false;"';
    }
    @endphp

    <form action="{!! route($table_name.'.update',$id) !!}" class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" {!! $string_valid !!}>
        {{ method_field('PUT') }}
        @include('admin.layouts.form')
    </form>

@endsection()

@section('script')
@endsection()
@extends('admin.layouts.app')
@php
	extract($data,EXTR_OVERWRITE);
@endphp
@section('title')
    <h3>Danh sách {{$module_name}}</h3>
@endsection()
@section('title2')
@endsection()
@section('content')
    @include('errors.alert')
    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
        <thead>
        	<tr id="0">
                @yield('head_table_list')
            </tr>
        </thead>
        <tbody>
        	<tr>
        		@yield('body_table_list')
        	</tr>
        </tbody>
    </table>
@endsection()
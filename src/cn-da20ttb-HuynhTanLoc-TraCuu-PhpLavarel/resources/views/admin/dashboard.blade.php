@extends('admin.layouts.app')

@section('title')
  <h3>Chào mừng bạn đến với trang quản trị</h3>
@endsection

@section('title2')
    <h4>Hệ thống quản trị</h4>
@endsection

@section('content')
    <h4>Hướng dẫn quản trị</h4>
    <ul>
        <li>Quản lý các Modules theo các danh mục Modules bên trái.</li>
        <li>Nội dung các Modules được hiển thị ở khung bên phải</li>
        <li>Có thể mở rộng màn hình module bằng cách mở rộng/thu nhỏ thanh điều hướng ở header</li>
        <li>Icon user : Truy cập Module quản lý thông tin cá nhân - Thoát phiên đăng nhập</li>
    </ul>
@endsection

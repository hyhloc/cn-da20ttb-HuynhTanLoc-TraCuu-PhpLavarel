<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Managerment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{!! url('/template-admin/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/vendors/select2/dist/css/select2.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/daterangepicker.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/fancybox.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/custom.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/style1.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/media_new.css') !!}" rel="stylesheet">
    @yield('css')
    <script src="{!! url('/template-admin/js/jquery.min.js') !!}"></script>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title" target="_blank"><i class="fa fa-desktop"></i>
                        <span>Trang chủ</span></a>
                </div>
                <div class="clearfix"></div>
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <li>
                                <a href="{!! url('admin') !!}"><i class="fa fa-tachometer "></i>Bảng điều khiển</a>
                            </li>
                            <li class="item-nav-menu">
                                <a>
                                    <i class="fa fa-users" aria-hidden="true"></i>Quản trị tài khoản 
                                    <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li>
                                        <a href="{{route('users.create')}}">Tạo tài khoản</a>
                                    </li>
                                    <li>
                                        <a href="{{route('users.index')}}">Danh sách tài khoản</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-nav-menu">
                                <a>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>Địa điểm du lịch 
                                    <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li>
                                        <a href="{{route('locations.create')}}">Thêm địa điểm</a>
                                    </li>
                                    <li>
                                        <a href="{{route('locations.index')}}">Danh sách địa điểm</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-nav-menu">
                                <a>
                                    <i class="fa fa-coffee" aria-hidden="true"></i>Ẩm thực 
                                    <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li>
                                        <a href="{{route('foods.create')}}">Thêm cơ sở ẩm thực</a>
                                    </li>
                                    <li>
                                        <a href="{{route('foods.index')}}">Danh sách cơ sở</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="item-nav-menu">
                                <a>
                                    <i class="fa fa-bed" aria-hidden="true"></i>Lưu trú 
                                    <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li>
                                        <a href="{{route('hotels.create')}}">Thêm cơ sở lưu trú</a>
                                    </li>
                                    <li>
                                        <a href="{{route('hotels.index')}}">Danh sách cơ sở lưu trú</a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="nav navbar-nav navbar-left">
                        {{-- <a id="purge-cache" href="javascript:;"><i class="fa fa-bug"></i> Purge cache</a> --}}
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               style="font-size: 16px;" aria-expanded="false">
                                <img src="{!! url('/template-admin/images/no-avatar.png') !!}"
                                     alt="{!! Auth::guard('admin')->user()->name !!}">
                                {!! Auth::guard('admin')->user()->name !!}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{!! route('admin.admin_user.changePassword') !!}">Đổi mật khẩu</a></li>
                                <li><a href="{!! route('admin.logout') !!}"><i class="fa fa-sign-out pull-right"></i>Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        @yield('title')
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                @yield('title2')
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<script src="{!! url('/template-admin/tinymce/js/tinymce/tinymce.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/moment.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/bootstrap.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/bootbox.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/jquery.datetimepicker.full.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/daterangepicker.js') !!}"></script>
<script src="{!! url('/template-admin/vendors/select2/dist/js/select2.full.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/jquery.tagsinput.js') !!}"></script>
<script src="{!! url('/template-admin/js/jquery.sortable.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/fancybox.js') !!}"></script>
<script src="{!! url('/template-admin/js/custom.min.js') !!}"></script>
<script src="{!! url('/template-admin/js/media.js') !!}"></script>
<script src="{!! url('/template-admin/js/media_new.js') !!}"></script>
<script src="{!! url('/template-admin/js/script.js') !!}"></script>
@yield('script')
</body>
</html>

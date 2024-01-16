@extends('web.layouts.app')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="/css/searchdd.css">-->
@endsection
@section('content')
<div class="container pt-5" > <!--style="overflow: hidden;"-->
    <div class = "row">
        <div class = "col-md-6">
            @php
                $slides_image = explode(',',$data->slides); 
            @endphp
            @if($data->slides != null)
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach($slides_image as $key => $slide)
                    <button type="button" data-bs-target="#demo" class="@if($key == 0) active @endif" data-bs-slide-to="{!! $key??0 !!}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($slides_image as $key => $slide)
                    <div class="carousel-item @if($key == 0) active @endif">
                        <img src="{!! $slide??'' !!}" alt="{!! $data->name??'' !!}" class="d-block" style="width:100%; height:600px">
                        <div class="carousel-caption">
                            <h3>{!! $data->name??'' !!}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
                    
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            @endif
        </div>
        <div class = "col-md-6 p-5">
            <h4 style="font-size: 40px; margin-bottom:40px" >Thông tin tóm tắt</h4>
            <div class="container4">
                <div class="flex">
                    <div class="box0">
                        <i class="fa-solid fa-phone"></i>
                        <b style="font-size: 20px;">SĐT :  </b><p style="font-size: 20px;">{!! $data->phone??'' !!}</p>
                    </div>
                    <div class="box0">
                        <i class="fa-solid fa-location-dot"></i>
                        <b style="font-size: 20px;">Địa chỉ: </b><p style="font-size: 20px;">{!! $data->address??'' !!}</p>
                    </div>
                    <div class="box0">
                        <i class="fa-solid fa-compass"></i>
                        <b style="font-size: 20px;">Loại hình lưu trú: </b><p style="font-size: 20px;">{!! $data->type??'' !!}</p>
                    </div>
                    <div class="box0">
                        <i class="fa-solid fa-flag"></i>
                        <b style="font-size: 20px;">Tên cơ sở lưu trú: </b><p style="font-size: 20px;">{!! $data->name??'' !!}</p>
                    </div>
                    <div class="box0">
                        <i class="fa-solid fa-money-bill"></i>
                        <b style="font-size: 20px;">Giá thuê </b><p style="font-size: 20px;">{!! $data->price??'' !!}</p>
                    </div>
                    <div class="box0">
                        <i class="fa-solid fa-clock"></i>
                        <b style="font-size: 20px;">Thời gian hoạt động </b><p style="font-size: 20px;">{!! $data->times??'' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-8">
            <div class="container">
                <div class="box1">
                    <h2 style="font-size: 40px" >Giới thiệu</h2>
                    <p style="text-align: justify;font-size:18px">{!! $data->description ?? '' !!}</p>     
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Xem thêm
                    </button>
                </div>
                    
                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                    
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Giới thiệu chi tiết</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>{!! $data->detail??'' !!}</p>
                            </div>
                        
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>           
                        </div>
                    </div>
                </div>
            </div>  
       </div>
       <div class="col-md-4">
            <!--Nhung map-->
            <div >
                {!! $data->maps??'' !!}
           </div>

       </div>
    </div>
    
</div>
<footer style="height: 100px;">
    <div class="copyright" style="margin-top: 5px; margin-bottom: 5px;">
        <h3 style="margin: 0; font-size:20px"> Website Tra cứu thông tin du lịch</h3>
        <p style="margin: 0;">Huỳnh Tấn Lộc - 110120044</p>
    </div>
</footer>
@endsection
@section('foot')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

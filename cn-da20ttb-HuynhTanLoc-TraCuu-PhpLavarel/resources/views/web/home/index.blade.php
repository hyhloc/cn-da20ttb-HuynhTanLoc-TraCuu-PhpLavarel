@extends('web.layouts.app')
@section('content')
<div style="width:100%; height:40px">

</div>
    <section class="wrap d_flex banner-slide" >
        <div class="wrap banner-slides owl-carousel owl-theme">
            <div class="item">
                <img  src="/image/bg05.jpg" alt="">
            </div>  
            <div   class="item">
                <img src="/image/tv01.jpg" alt="">
            </div>
            <div  class="item">
                <img src="/image/bg9.jpg" alt="">
            </div>
        </div>
    </section>
    <section class="wrap d_flex location-home">
        <div class="containers">
            <div class="wrap location-home__title">
                <h2 class="text--green">Địa điểm du lịch</h2>
            </div>
            <div class="wrap location-home__content">
                <div class="wrap d_flex location-home__content-list">
                    @include('web.generals.item_location',[
                        'data'=>$locations??[]
                    ])
                </div>
            </div>
        </div>
    </section>
    <section class="wrap d_flex food-home">
        <div class="containers">
            <div class="wrap food-home__title">
                <h2 class="text--green">Ẩm thực - Nhà hàng</h2>
            </div>
            <div class="wrap food-home__content">
                <div class="wrap d_flex food-home__content-list">
                    @include('web.generals.item_food',[
                        'data'=>$foods??[]
                    ])
                </div>
            </div>
        </div>
    </section>
    <section class="wrap d_flex hotel-home">
        <div class="containers">
            <div class="wrap hotel-home__title">
                <h2 class="text--green">Dịch vụ lưu trú</h2>
            </div>
            <div class="wrap hotel-home__content">
                <div class="wrap d_flex hotel-home__content-list">
                    @include('web.generals.item_hotel',[
                        'data'=>$hotels??[]
                    ])
                </div>
            </div>
        </div>
    </section>
    <footer style="height: 50px;">
        <div class="copyright">
            <p>&copy; 2023 Your Website. All rights reserved.</p>
        </div>
    </footer>
@endsection
@section('foot')
    <script>
        $('.banner-slides').owlCarousel({
            loop:true,
            margin:0,
            nav:false,
            dots:true,
            items:1,
            autoplay:true,
            autoplayTimeout:5000,
        })
    </script>
@endsection

       

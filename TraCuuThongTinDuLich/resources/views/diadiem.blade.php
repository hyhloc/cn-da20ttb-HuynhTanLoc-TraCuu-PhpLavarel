@extends('web.layouts.app')
@section('content')
    <div class="container1">
        <div class="search">
            <form action="{{ route('diadiem') }}" method="GET">
                @csrf
                <input name="searchTerm" placeholder="Nhập địa điểm du lịch cần tra cứu" type="text">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>
        <h3 style="font-family: 'Times New Roman', Times, serif; "><a href="/">Trang chủ</a>&nbsp;<i class="fa-solid fa-arrow-right"></i>&nbsp;<a href="{{ route('diadiem') }}">Địa điểm</a></h3>
    </div>
    <section class="wrap d_flex location-home">
        <div class="containers">
            <div class="wrap location-home__title">
                <h2 class="text--green">Địa điểm du lịch</h2>
            </div>
            <div class="wrap location-home__content">
                <div class="wrap d_flex location-home__content-list">
                    @include('web.generals.item_location', [
                        'data' => $locations ?? []
                    ])
                </div>
            </div>
        </div>
    </section>

@endsection
@section('foot')
@endsection

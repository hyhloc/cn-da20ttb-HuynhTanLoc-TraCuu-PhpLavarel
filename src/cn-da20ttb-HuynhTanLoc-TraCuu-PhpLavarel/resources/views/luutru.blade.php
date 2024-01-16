@extends('web.layouts.app')
@section('content')
<div style="width:100%; height:40px">
</div>
<div class="searchhotel">
  <div class="searchhotel1">
      <form action="{{ route('luutru') }}" method="GET">
          @csrf
          <input name="searchTerm" placeholder="Nhập nơi ở cần tra cứu" type="text">
          <button type="submit">Tìm kiếm</button>
      </form>
  </div>
  <h3 style="font-family: 'Times New Roman', Times, serif; "><a href="/">Trang chủ</a>&nbsp;<i class="fa-solid fa-arrow-right"></i>&nbsp;<a href="{{ route('luutru') }}">Lưu trú</a></h3>
</div>
<section class="wrap d_flex hotel-home">
  <div class="containers">
      <div class="wrap hotel-home__title">
          <h2 class="text--green">Dịch vụ lưu trú {{ $data->name??'' }}</h2>
      </div>
      <div class="wrap hotel-home__content">
          <div class="wrap d_flex hotel-home__content-list">
              @include('web.generals.item_hotel',[
                  'data'=>$hotels??[]
              ])
          </div>
          <div class="pagination">
            {!! $hotels->links('pagination::bootstrap-4') !!}
        </div> 
      </div>
  </div>
</section>
<footer style="height: 100px;">
    <div class="copyright" style="margin-top: 5px; margin-bottom: 5px;">
        <h3 style="margin: 0; font-size:20px"> Website Tra cứu thông tin du lịch</h3>
        <p style="margin: 0;">Huỳnh Tấn Lộc - 110120044</p>
    </div>
</footer>

@endsection
@section('foot')
@endsection


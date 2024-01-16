@extends('web.layouts.app')
@section('content')
<style>
    .category-dropdown {
        border: none;
        width: 550px; /* Độ rộng mong muốn */
        border-radius: 15px; /* Độ cong của góc */
        padding: 8px; /* Khoảng cách bên trong dropdown */
        margin-top: 20px;
    }
    
   
</style>
<div style="width:100%; height:40px">
</div>
    <div class="searchhotel">
        <div class="searchhotel1">
            <form action="{{ route('diadiem') }}" method="GET">
                @csrf
                <div class="search">
                    <input type="text" name="searchTerm" class="search-input" placeholder="Tìm kiếm...">
                    <button class="search-button" type="submit">Tìm kiếm</button>
                  </div>
                  <select id="categoryDropdown" name="category" class="category-dropdown" onchange="window.location.href=this.value;">
                    <option value="" selected>Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ route('diadiem_category', $category->id) }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                
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
                <div class="pagination">
                    {!! $locations->links('pagination::bootstrap-4') !!}
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

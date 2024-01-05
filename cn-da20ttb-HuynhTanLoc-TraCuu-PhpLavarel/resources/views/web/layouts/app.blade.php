<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title_seo??'Home'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/libs/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/libs/owlcarousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/tintuc.css">
    <link rel="stylesheet" href="/css/ds.css">
    <link rel="stylesheet" href="/css/diadiem.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script
    @yield('head')
</head>
<body>
    <div class="wrap profile" id="navbar">
        <div class="containers">
            <div class="profile1">
                <div class="phone">
                    <div class="phone1">
                        <i id="mg1" class="fa-solid fa-envelope"></i>
                        <p class="p2">hloc75770@gmail.com</p>
                    </div>
                    <div class="phone2">
                        <i class="fa-solid fa-phone"></i>
                        <p class="p2">0932341051</p>
                    </div>
                </div>
                <div class="link">
                    <i id="lm1" class="fa-brands fa-facebook-f" href=""><a href="https://www.facebook.com/loccmap"></a></i>
                    <i id="lm2" class="fa-brands fa-instagram"></i>
                </div>
            </div>
        </div>
    </div>
    <header class="wrap d_flex">
        <div class="containers">
            <nav>
                <div class="wrap d_flex nav">
                    <div class="logo">
                        <img src="/image/logo.png" alt="">
                    </div>
                    <div class="links">
                        <ul class="links1">
                            <li id="li1">
                                <a href="/" href="">Trang chủ</a>
                            </li>
                            <li id="li2">
                                <a href="{{ route('diadiem') }}">Địa điểm</a>
                            </li>
                            <li id="li3">
                                <a href="{{ route('amthuc') }}">Ẩm thực</a>
                            </li>
                            <li id="li4">
                                <a href="{{ route('luutru') }}">Dịch vụ</a>
                            </li>
                            <div>
                            </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    @yield('content')
    <script src="/libs/jquery-3.5.1.min.js"></script>
    <script src="/libs/owlcarousel/js/owl.carousel.min.js"></script>
    @yield('foot')
</body>
</html>
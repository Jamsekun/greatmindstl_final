<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Greatmind STL @yield('title')</title>
    <!-- favicon -->        
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/image/logo/logo3.png', Request::secure()) }}">

    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/fontawesome.min.css', Request::secure()) }}" />
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/bootstrap.min.css', Request::secure()) }}" />
    <!-- animate css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/animate.css', Request::secure()) }}" />
    <!-- lightcase css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/lightcase.css', Request::secure()) }}" />
    <!-- slick css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/slick.css', Request::secure()) }}" />
    <!-- swiper css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/swiper.min.css', Request::secure()) }}" />
    <!-- flipclock css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/flipclock.css', Request::secure()) }}" />
    <!-- jqvmap css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/jqvmap.min.css', Request::secure()) }}" />
    <!-- main style css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/style.css', Request::secure()) }}" />
    <!-- responsive css link -->
    <link rel="stylesheet" href="{{ asset('assets/sorteo/css/responsive.css', Request::secure()) }}" />

    @stack('css')
</head>
    <body>
        <div id="preloader"></div>

        <div class="main-light-version">
            <!--  header-section start  -->
            <header class="header-section">
                <div class="header-top">
                    <div class="container">
                        &nbsp;
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="container">
                        <nav class="navbar navbar-expand-xl">
                            <a class="site-logo site-title" href="{{ route('index') }}">
                                <img src="{{ asset('assets/image/logo/logo3.png') }}" width="50" alt="site-logo" style="margin-left: 10px;" />
                            </a>
                            <a class="site-logo site-title" href="https://www.pcso.gov.ph/">
                                <img src="{{ asset('assets/image/logo/logo2.png') }}" width="50" alt="site-logo" style="margin-left: 10px;" />
                            </a>
                            <a class="site-logo site-title" href="https://www.pcso.gov.ph/Games/SmallTownLottery.aspx">
                                <img src="{{ asset('assets/image/logo/logo1.png') }}" width="50" alt="site-logo" style="margin-left: 10px;" />
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="menu-toggle"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav main-menu ml-auto">
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                     <li><a href="{{ route('about') }}">About</a></li>
                                    <li class="menu_has_children">
                                        <a href="#0">Results</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Results</a></li>
                                            <li><a href="#">Latest Winners</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">contacts</a></li>
                                </ul>
                                <div class="header-join-part">
                                    <button type="button" class="cmn-btn" onclick="window.location.href = '{{ route('admin.index') }}'">Login</button>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- header-bottom end -->
            </header>
            <!--  header-section end  -->

            @yield('content')

            <!-- footer-section start -->
            <footer class="footer-section">
                <div class="footer-top border-top border-bottom has_bg_image" data-background="{{ asset('assets/sorteo/img/bg-four.jpg') }}">
                    <div class="footer-top-first">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-5 col-sm-4 text-center text-sm-left">
                                    <a href="home-one.html" class="site-logo"><img src="{{ asset('assets/image/stl/greatmind_logo.png') }}" alt="logo" width="300"></a>
                                </div>
                                <div class="col-lg-6 col-md-7 col-sm-8">
                                    <div class="number-count-part d-flex">
                                        <div class="number-count-item">
                                            <span class="number" id="total-members">0</span>
                                            <p>TOTAL MEMBERS</p>
                                        </div>
                                        <div class="number-count-item">
                                            <span class="number" id="total-winners">0</span>
                                            <p>TOTAL WINNERS</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-top-second">
                        <div class="container">
                            <div class="row justify-content-between">
                                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6">
                                    <div class="footer-widget widget-about">
                                        <h3 class="widget-title">Quick Links</h3>
                                        <ul class="footer-list-menu">
                                            <li><a href="#0">About us</a></li>
                                            <li><a href="#0">Results</a></li>
                                            <li><a href="#0">Latest Winners</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-widget widget-subscribe">
                                        <h3 class="widget-title">Email Us:</h3>
                                        <div class="subscribe-part">
                                            <p>greatmindgamesandamusementcorp@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-8 col-sm-9">
                                <div class="copy-right-text">
                                    <p>© 2019 <a href="#">Greatemind games and amusement corporation</a> - All Rights Reserved.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-3">
                                <ul class="footer-social-links d-flex justify-content-end">
                                    <li>
                                        <a href="#0"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#0"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer-section end -->
        </div>

        <!-- scroll-to-top start -->
        <div class="scroll-to-top">
            <span class="scroll-icon">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </body>

    <script src="{{ asset('assets/sorteo/js/jquery-3.3.1.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/bootstrap.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/flipclock.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/jquery.countdown.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/slick.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/swiper.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/lightcase.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/wow.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/jquery.vmap.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/jquery.vmap.world.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/sorteo/js/main.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/momentjs/moment.min.js', Request::secure()) }}"></script>

    @stack('js')
</html>
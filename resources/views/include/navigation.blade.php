@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp

<header id="yl-header" class="yl-header-main">
    <div class="yl-header-top clearfix">
        <div class="container">
            <div class="yl-brand-logo float-left">
                <a href="{{ route('/') }}">
                    <img src="{{ asset('front_end/img/logo-main.png')}}" alt="{{ env('APP_NAME') }} logo">
                </a>
            </div>
            <div class="yl-header-top-cta float-right clearfix ul-li">
                <ul>
                    <li>
                        <div class="yl-top-cta-text float-right yl-headline">
                            <div class="header-top-cta-content">
                            <form action="{{ route('search') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="text" name="seach_query" required placeholder="Search anything here">
                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="{{ asset('front_end/assets/img/icon/mail.png') }}" alt="{{ env('APP_NAME') }}">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="mailto:{{$site_logo->company_email_1}}">{{$site_logo->company_email_1}}</a>
                                <h3>Mail us</h3>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="{{ asset('front_end/assets/img/icon/call.png') }}" alt="{{ env('APP_NAME') }}">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="tel:{{$site_logo->company_phone_1}}">Requesting a Call:</a>
                                <h3>{{$site_logo->company_phone_1}}</h3>
                            </div>
                        </div>
                    </li>
                    <!--<li>
                        <div class="header-top-cta-content">
                            <div class="yl-top-cta-icon float-left">
                                <img src="assets/img/icon/clock.png" alt="">
                            </div>
                            <div class="yl-top-cta-text float-right yl-headline">
                                <a href="#">Monday - Saturday</a>
                                <h3>24/7</h3>
                            </div>
                        </div>
                    </li>-->
                </ul>
            </div>
            <div class="yl-mobile-menu-wrap">
                <div class="yl-mobile_menu position-relative">
                    <div class="yl-mobile_menu_button yl-open_mobile_menu">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="yl-mobile_menu_wrap">
                        <div class="mobile_menu_overlay yl-open_mobile_menu"></div>
                        <div class="yl-mobile_menu_content">
                            <div class="yl-mobile_menu_close yl-open_mobile_menu">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="m-brand-logo text-center">
                                <a href="{{ route('/') }}">
                                    <img src="{{ asset('front_end/img/logo-white-main.png') }}" alt="{{ env('APP_NAME') }}">
                                </a>
                            </div>
                            <nav class="yl-mobile-main-navigation  clearfix ul-li">
                                <ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">
                                    <li>
                                        <a href="{{ route('/') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">About</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('how-it-work') }}">How it works</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('testimonies') }}">Testimonies</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog') }}">Blog</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faq') }}">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categories') }}">Categories</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}">Contact</a>
                                    </li>
                                    @auth
                                        <li class="dropdown">
                                            <a href="{{ url('/home') }}">Dashboard</a>
                                        </li>
                                    @else
                                        <li class="dropdown">
                                            <a href="#">Account</a>
                                            <ul class="dropdown-menu clearfix">
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                                <li><a href="{{ route('register') }}">Register</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="yl-top-cart-login pt-1">
                                                <span data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user"></i></span>
                                            </div>
                                        </li>
                                    @endauth
                                    <li><div class="yl-top-cart-login">
                                            <span  data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></span>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Mobile-Menu -->
            </div>
        </div>
    </div>
    <div class="yl-header-menu-wrap clearfix">
        <div class="container">
            <div class="yl-main-nav-wrap  float-left">
                <nav class="yl-main-navigation ul-li">
                    <ul id="main-nav" class="navbar-nav text-capitalize clearfix">
                        <li>
                            <a href="{{ route('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li>
                            <a href="{{ route('how-it-work') }}">How it works</a>
                        </li>
                        <li>
                            <a href="{{ route('testimonies') }}">Testimonies</a>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{ route('categories') }}">Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                        @auth
                            <li class="dropdown">
                                <a href="{{ url('/home') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#">Account</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
            <div class="yi-header-social float-right ul-li">
                <ul>
                    <li><a target="_blank" href="{{ $site_logo->facebook_url }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a target="_blank" href="{{ $site_logo->twitter_url }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a target="_blank" href="{{ $site_logo->instagram_url }}"><i class="fab fa-instagram"></i></a></li>
                    <li><a target="_blank" href="{{ $site_logo->youtube_url }}"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="yl-header-cart-login float-right">
                <div class="yl-top-cart-login">
                    <button  data-toggle="modal" data-target="#search"><i class="fas fa-search"></i></button>
                </div>
                @auth
                    
                @else
                    <div class="yl-top-cart-login">
                        <button data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user"></i></button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
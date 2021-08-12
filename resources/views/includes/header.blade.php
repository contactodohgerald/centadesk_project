@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
<body class="theme-primary">

<!-- The social media icon bar -->
<div class="icon-bar-sticky">
    <a href="https://facebook.com/{{ $site_logo->facebook_url }}" class="waves-effect waves-light btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
    <a href="https://twitter.com/{{ $site_logo->twitter_url }}" class="waves-effect waves-light btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
    <a href="https://instagram.com/{{ $site_logo->instagram_url }}" class="waves-effect waves-light btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
    <a href="https://www.youtube.com/{{ $site_logo->youtube_url }}" class="waves-effect waves-light btn btn-social-icon btn-youtube"><i class="fa fa-youtube-play"></i></a>
</div>

<header class="top-bar">
    <div class="topbar">

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6 col-12 d-lg-block d-none">
                    <div class="topbar-social text-center text-md-left topbar-left">
                        <ul class="list-inline d-md-flex d-inline-block">
{{--                            <li class="ml-10 pr-10"><a href="#"><i class="text-white fa fa-question-circle"></i> Ask a Question</a></li>--}}
                            <li class="ml-10 pr-10"><a href="mailto:{{$site_logo->company_email_1}}"><i class="text-white fa fa-envelope"></i>{{$site_logo->company_email_1}}</a></li>
                            <li class="ml-10 pr-10"><a href="phone:{{$site_logo->company_phone_1}}"><i class="text-white fa fa-phone"></i>{{$site_logo->company_phone_1}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-12 xs-mb-10">
                    <div class="topbar-call text-center text-lg-right topbar-right">
                        <ul class="list-inline d-lg-flex justify-content-end">
                            @if (Route::has('login'))
                                <div class="top-right links">
                                    @auth
                                        <li class="mr-10 pl-10">
                                            <a href="{{ url('/home') }}"><i class="text-white fa fa-dashboard d-md-inline-block d-none"></i> Dashboard</a>
                                        </li>
                                    @else
                                        <li class="mr-10 pl-10">
                                            <a href="{{ route('login') }}"><i class="text-white fa fa-sign-in d-md-inline-block d-none"></i> Login</a>
                                        </li>

                                        @if (Route::has('register'))
                                            <li class="mr-10 pl-10">
                                                <a href="{{ route('register') }}"><i class="text-white fa fa-user d-md-inline-block d-none"></i> Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav hidden class="nav-white nav-transparent">
        <div class="nav-header">
            <a href="/" class="brand">
                <img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}"/>
            </a>
            <button class="toggle-bar">
                <span class="ti-menu"></span>
            </button>
        </div>
        <ul class="menu">
            <li class="<?php print @$index?>">
                <a href="/">Home</a>
            </li>
            <li class="<?php print @$about?>">
                <a href="{{route('about')}}">About Us</a>
            </li>
            <li class="dropdown <?php print @$courses?>">
                <a href="#">Courses</a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('list-courses')}}">Courses List</a></li>
                    <li><a href="{{route('categories')}}">Categories</a></li>
                </ul>
            </li>
            <li class="<?php print @$testimonies?>">
                <a href="{{route('testimonies')}}">Testimonies</a>
            </li>
            <li class="<?php print @$how_it_work?>">
                <a href="{{route('how-it-work')}}">How it works</a>
            </li>
            <li  class="<?php print @$blog?>">
                <a href="{{route('blog')}}">Blog</a>
            </li>
            <li class="<?php print @$faq?>">
                <a href="{{route('faq')}}">FAQs</a>
            </li>
            <li class="<?php print @$contact?>">
                <a href="{{route('contact')}}">Contact Us</a>
            </li>
        </ul>
        <div class="wrap-search-fullscreen">
            <div class="container">
                <button class="close-search"><span class="ti-close"></span></button>
                <input type="text" placeholder="Search..." />
            </div>
        </div>
    </nav>
</header>

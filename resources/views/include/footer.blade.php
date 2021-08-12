@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp

<footer id="yl-footer" class="yl-footer-section" data-background="{{ asset('front_end/assets/img/f-bg.jpg') }}">
    <div class="container">
        <div class="yl-footer-content-wrap">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="yl-footer-widget">
                        <div class="yl-footer-logo-widget yl-headline pera-content">
                            <div class="yl-footer-logo">
                                <a href="{{ route('/') }}">
                                    <img src="{{ asset('front_end/img/logo-white-main.png') }}" alt="{{ env('APP_NAME') }} Logo">
                                </a>
                            </div>
                            <p>{{ env('APP_NAME') }} is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. </p>
                            <a class="footer-logo-btn text-center text-uppercase" href="{{ route('about') }}">About us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="yl-footer-widget">
                        <div class="yl-footer-newslatter-widget pera-content">
                            <h3 class="widget-title">About</h3>
                            <p><a href="{{ route('about') }}">About</a></p>
                            <p><a href="{{ route('blog') }}">Blog</a></p>
                            <p><a href="{{ route('how-it-work') }}">How it works</a></p>
                            <p><a href="{{ route('contact') }}">Help and support</a></p>
                            <p><a href="{{ route('terms-of-use') }}">Terms and Conditions</a></p>
                            <p><a href="{{ route('faq') }}">Frequently asked questions</a></p>
                            <p><a href="{{ route('privacy-policy') }}">Privacy & Policy</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="yl-footer-widget">
                        <div class="yl-footer-newslatter-widget pera-content">
                            <h3 class="widget-title">Links</h3>
                            <p><a href="{{ route('affiliate') }}">Affiliate</a></p>
                            <p><a href="{{ route('career') }}">Career</a></p>
                            <p><a href="{{ route('teacher') }}">Teach on {{ env('APP_NAME') }}</a></p>
                            <p><a href="{{ route('testimonies') }}">Testimonies</a></p>
                            <p><a href="{{ route('gallery') }}">Gallery(Events)</a></p>
                            <p><a href="{{ route('list-courses') }}">Courses </a></p>
                            <p><a href="{{ route('register') }}">Accounts </a></p>
                            <div class="yl-footer-social ul-li">
                                <ul>
                                    <li><a target="_blank" href="{{ $site_logo->facebook_url }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="{{ $site_logo->twitter_url }}"><i class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank" href="{{ $site_logo->instagram_url }}"><i class="fab fa-instagram"></i></a></li>
                                    <li><a target="_blank" href="{{ $site_logo->youtube_url }}"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="yl-footer-widget">
                        <div class="yl-footer-info-widget ul-li">
                            <h3 class="widget-title">Official info:</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <a href="#">{{$site_logo->company_address}}</a>
                                </li>
                                <li>
                                    <i class="fas fa-phone"></i><a href="tel:{{$site_logo->company_phone_1}}">{{$site_logo->company_phone_1}}</a>
                                </li>
                            </ul>
                            <div class="office-open-hour">
                                <span>Open Hours: </span>
                                <p>24/7</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="yl-footer-copyright text-center">
            <span>© <?php $d=date('Y'); print $d;?> {{ env('APP_NAME') }}. All rights reserved.</span>
        </div>
    </div>
</footer>

<div class="modal yl-login-modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="yl-modal-header position-relative" data-background="{{ asset('front_end/assets/img/banner/lg-bg.jpg') }}">
                <div class="yl-login-head text-center pera-content">
                    <a href="{{ route('/') }}">
                        <img src="{{ asset('front_end/img/logo-white-main.png') }}" alt="{{ env('APP_NAME') }} Logo">
                    </a>
                    <p>Join {{ env('APP_NAME') }} and transform your life through education</p>
                </div>
            </div>
            <div class="modal-body">
                <div class="yl-modal-signup-login-tab">
                    <div class="yl-faq-tab-btn ul-li">
                        <ul id="tabs" class="nav text-center nav-tabs faq-tab-btn-area">
                            <li class="nav-item"><a href="#" data-target="#login" data-toggle="tab" class="nav-link text-capitalize active">Login</a></li>
                            <li class="nav-item"><a href="#" data-target="#signUp" data-toggle="tab" class="nav-link text-capitalize">Sign Up</a></li>
                        </ul>
                    </div>
                    <div id="tabsContent" class="tab-content">
                        <div id="login" class="tab-pane fade active show">
                            <div class="yl-login-content pera-content text-center">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <input type="email" name="email" required placeholder="Email">
                                    <input type="password" name="password" required placeholder="Password">
                                    <div class="yl-login-label clearfix">
                                        <span><input type="checkbox">Remember me</span>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('forgot-password') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <button type="submit">Submit</button>
                                </form>
                                <p>Don’t have any account? <a href="{{ route('register') }}">Signup</a></p>
                            </div>
                        </div>
                        <div id="signUp" class="tab-pane fade">
                            <div class="yl-sign-up-content pera-content text-center">
                                <form action="{{ route('register_user') }}" method="post">
                                    @csrf
                                    <input type="text" name="referred_id" required placeholder="Referred Id">
                                    <input type="text" name="name" required placeholder="First Name">
                                    <input type="text" name="last_name" required placeholder="Last Name">
                                    <input type="email" name="email" required placeholder="Email address">
                                    <input type="password" name="password" required placeholder="Password">
                                    <input type="password" name="password_confirmation" required placeholder="Confirm password">
                                    <input type="hidden" name="user_type" value="student">
                                    <div class="yl-login-label clearfix">
                                        <span><input type="checkbox">By clicking signup you are agree to our <a href="{{ route('terms-of-use') }}"> terms of service </a></span>
                                    </div>
                                    <button type="submit">Submit</button>
                                </form>
                                <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal yl-login-modal fade" id="search" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="yl-modal-header position-relative" data-background="{{ asset('front_end/assets/img/banner/lg-bg.jpg') }}">
                <div class="yl-login-head text-center pera-content">
                    <a href="{{ route('/') }}">
                        <img src="{{ asset('front_end/img/logo-white-main.png') }}" alt="{{ env('APP_NAME') }}">
                    </a>
                    <p><h3 class="text-white">Search for courses.</h3></p>
                </div>
            </div>
            <div class="modal-body pl-3 pr-3 m-0">
                <div class="yl-modal-signup-login-tab">

                    <div id="tabsContent" class="tab-content">
                        <div id="login" class="tab-pane fade active show">
                            <div class=" pera-content text-center">
                                <div class="course-grid-top-bar">
                                    <div class="yl-course-search position-relative">
                                        <form action="{{ route('search') }}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <input class="form-control" name="seach_query" required type="text" placeholder="Search anything here">
                                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
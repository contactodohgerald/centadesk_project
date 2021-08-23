﻿@php
$users = auth()->user();
$pageTitle = 'Home Area';
$home = 'active';
@endphp
@include('layouts.head')
<style>
    ul.example {
    list-style: none;
    margin: 0;
    padding: 0;
    display: block;
    text-align: center;
    }

    ul.example li { display: inline-block; }

    ul.example li span {
    font-size: 20px;
    font-weight: 200;
    line-height: 60px;
    }

    ul.example li.seperator {
    font-size: 20px;
    line-height: 50px;
    vertical-align: top;
    }

    ul#example li p {
    color: #a7abb1;
    font-size: 18px;
    }
</style>
<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->
    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->
    @php $link = auth()->user()->returnLink() @endphp
    <!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
                    @if(auth()->user()->cac_verification_status === 'no' && auth()->user()->user_type === 'teacher')
                    <div class="col-xl-6 col-lg-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-envelope-o mr-2"></i>
                            Please upload a means of identification for KYC verification
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="col-xl-12 col-lg-12 mb-30">

                        <div class="section3126">
                            @if(auth()->user()->user_type === 'teacher' || auth()->user()->user_type === 'student')
                                <div class="row">
                                    @if(auth()->user()->yearly_subscription_status === 'no')
                                    <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3" id="account_activation_date_counter" style="display: none">
                                        <div class="value_props">
                                            <div class="row">
                                                <input type="hidden" id="counter_date" class="form-control" value="{{ auth()->user()->account_activation_date_counter}}">
                                                <div class="col-xl-12 col-lg-12 col-md-12">
                                                    <h4 class="mb-0">Your {{ env('APP_NAME') }} account will be banned in:</h4>
                                                    <ul id="example" class="example">
                                                        <li><span class="days">00</span><p class="days_text">Days</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="hours">00</span><p class="hours_text">Hours</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3" id="subscription_date_counter" style="display: none">
                                        <div class="value_props">
                                            <div class="row">
                                                <input type="hidden" id="date_counter" class="form-control" value="{{ auth()->user()->subscription_date_counter}}">
                                                <div class="col-xl-12 col-lg-12 col-md-12">
                                                    <h4 class="mb-0">Your {{ env('APP_NAME') }} subscription status will expire in:</h4>
                                                    <ul id="example_2" class="example">
                                                        <li><span class="days">00</span><p class="days_text">Days</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="hours">00</span><p class="hours_text">Hours</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
                                                        <li class="seperator">:</li>
                                                        <li><span class="seconds">00</span><p class="seconds_text">Seconds</p></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            @if($users->privilegeChecker('view_restricted_roles'))
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{$app_overview[0]}} </b></h3>
                                                        <p class="font-poppins">Confirmed Courses</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{$app_overview[2]}} </b></h3>
                                                        <p class="font-poppins">Instructors</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{$app_overview[1]}} </b></h3>
                                                        <p class="font-poppins">Students</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{$app_overview[3]}} </b></h3>
                                                        <p class="font-poppins">Unreplied Tickets</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{number_format($users->calculateTotalAmount('top_up', 'confirmed'))}} ({{$users->getBalanceForView()['data']['currency']}})</b></h3>
                                                        <p class="font-poppins">Confirmed Topup Balance</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="value_props">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4">
                                                    <div class="value_icon mt-20">
                                                        <i class='uil uil-history'></i>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 col-lg-8 col-md-8">
                                                    <div class="value_content">
                                                        <h3><b>{{number_format($users->calculateTotalAmount('withdrawal', 'processing'))}} ({{$users->getBalanceForView()['data']['currency']}})</b></h3>
                                                        <p class="font-poppins">Pending Withdraw Balance</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins"><b>{{number_format($user->calculateUserBalance())}} ({{$user->getBalanceForView()['data']['currency']}})</b></h3>
                                                    <p class="font-poppins">Wallet Balance</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="value_props">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="value_icon mt-20">
                                                    <i class='uil uil-history'></i>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-8 col-md-8">
                                                <div class="value_content">
                                                    <h3 class="font-poppins">{{number_format($user->calculateUserBalance())}} ({{$user->getBalanceForView()['data']['currency']}})</h3>
                                                    <p class="font-poppins">Total Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">

                        <div class="section3125">
                            <h3 class="item_title font-poppins">Live Streams </h3>
                            <a href="/explore/live_streams" class="see150 font-poppins">See all</a>
                            <div class="la5lo1">
                                <div class="owl-carousel live_stream owl-theme">
                                    @foreach ($live_streams as $e)
                                    <div class="item">
                                        <div class="stream_1">
                                            <a href="{{ route('stream_details',['id'=>$e->unique_id]) }}" class="stream_bg">
                                                <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                                <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                                {{-- <p class="font-poppins text-capitalize clamp">{{ $e->title }}</p> --}}
                                                <p class="font-poppins stream_bg_p">Live<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    <div class="section3125 mt-30">
                        <h4 class="item_title font-poppins">Newest Courses</h4>
                        <a href="{{route('explore')}}" class="see150 font-poppins">See all</a>
                        <div class="la5lo1">
                            @if(count($course) > 0)
                            <div class="owl-carousel featured_courses owl-theme">
                                @foreach($course as $key => $each_course)
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                            <img src="{{asset($link.'course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}"" class="img-size">
                                            <div class="course-overlay">
                                                @if ($each_course->is_bestseller == 'yes')
                                                <div class="badge_seller">Bestseller</div>
                                                @endif
                                                <div class="crse_reviews">
                                                    <i class="uil uil-star"></i>{{$each_course->count_review}}
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                            </div>
                                        </a>
                                        <div class="fcrse_content">
                                            <div class="eps_dots more_dropdown">
                                                <a href="#"><i class='uil uil-ellipsis-v'></i></a>
                                                <div class="dropdown-content">
                                                    <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_course->views}} views</span>
                                                <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                            </div>
                                            <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s font-poppins">{{$each_course->name}}3</a>
                                            <a href="javascript:;" class="crse-cate font-poppins">{{$each_course->category->name}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot text-capitalize">By <a href="{{route('view_profile', $each_course->user->unique_id )}}">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                <div class="prce142 font-poppins">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format($each_course->price->amount)}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="section3125 mt-50">
                        <h4 class="item_title font-poppins">Popular Instructors</h4>
                        <a href="{{route('browse_instructor')}}" class="see150 font-poppins">See all</a>
                        <div class="la5lo1">
                            @if(count($instructors) > 0)
                            <div class="owl-carousel top_instrutors owl-theme">
                                @foreach($instructors as $ke => $each_instructors)
                                <div class="item">
                                    <div class="fcrse_1 mb-20">
                                        <div class="tutor_img">
                                            <a href="{{route('view_profile', $each_instructors->unique_id )}}">
                                                <img src="{{asset(auth()->user()->returnLink().'/profile/'.$each_instructors->profile_image)}}" alt="{{env('APP_NAME')}}">
                                            </a>
                                        </div>
                                        <div class="tutor_content_dt">
                                            <div class="tutor150">
                                                <a href="{{route('view_profile', $each_instructors->unique_id )}}" class="tutor_name font-poppins text-capitalize">{{$each_instructors->name}} {{$each_instructors->last_name}}</a>
                                                @if ($each_instructors->verified_badge == 'yes')
                                                <div class="mef78" title="Verified">
                                                    <i class='uil uil-check-circle'></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="tutor_cate font-poppins text-capitalize">{{ $each_instructors->professonal_heading }}
                                                @if ($each_instructors->professonal_heading)
                                                    |
                                                @endif
                                                {{($each_instructors->user_type === 'super_admin')?'Super Admin':$each_instructors->user_type}}</span></div>
                                            <ul class="tutor_social_links">
                                                <li><a target="_blank" href="{{ ($each_instructors->facebook === null)?'https://facebook.com':$each_instructors->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a target="_blank" href="{{ ($each_instructors->twitter === null)?'https://twitter.com':$each_instructors->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                                <li><a target="_blank" href="{{ ($each_instructors->linkedin  === null)?'https://www.linkedin.com':$each_instructors->linkedin  }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a target="_blank" href="{{ ($each_instructors->youtube === null)?'https://www.youtube.com':$each_instructors->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                            <div class="tut1250">
                                                <span class="vdt15">{{$each_instructors->enrolled_users}} Students</span>
                                                <span class="vdt15">{{$each_instructors->count_course}} Courses</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="right_side">
                        <div class="fcrse_2 mb-30">
                            <div class="tutor_img">
                                <a href="{{ route('profile')}}"><img src="{{asset('storage/profile/'.$user->profile_image)}}" alt=""></a>
                            </div>
                            <div class="tutor_content_dt">
                                <div class="tutor150">
                                    <a href="{{ route('profile')}}" class="tutor_name font-poppins text-capitalize">{{ $users->name }} {{ $users->last_name }}</a>
                                    @if ($users->verified_badge == 'yes')
                                    <div class="mef78" title="Verified">
                                        <i class='uil uil-check-circle'></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="tutor_cate text-capitalize font-poppins">{{ $user->professonal_heading }}
                                    @if ($user->professonal_heading)
                                        |
                                    @endif
                                    {{($user->user_type === 'super_admin')?'Super Admin':$user->user_type}}</span></div>
                                    @if($user->user_type != 'student')
                                    <ul class="tutor_social_links">
                                        <li><a target="_blank" href="{{ ($user->facebook === null)?'https://facebook.com':$user->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a target="_blank" href="{{ ($user->twitter === null)?'https://twitter.com':$user->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                        <li><a target="_blank" href="{{ ($user->linkedin  === null)?'https://www.linkedin.com':$user->linkedin  }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a target="_blank" href="{{ ($user->youtube === null)?'https://www.youtube.com':$user->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                    <div class="tut1250">
                                        <span class="vdt15 font-poppins">{{ count($user->enroll_students) }} Students</span>
                                        <span class="vdt15 font-poppins">{{ count($user->courses) }} Courses</span>
                                    </div>
                                @endif
                                <a href="{{ route('profile')}}" class="prfle12link font-poppins">Go To Profile</a>
                            </div>
                        </div>
                        @if($user->user_type != 'student')
                        <div class="fcrse_3">
                            <div class="cater_ttle">
                                <h4 class="font-poppins">Live Streaming</h4>
                            </div>
                            <div class="live_text">
                                <div class="live_icon"><i class="uil uil-kayak"></i></div>
                                <div class="live-content">
                                    <p class="font-poppins">Set up your channel and stream live to your students</p>
                                    <button class="live_link" onclick="window.location.href ='{{ route('create-course') }}'">Get Started</button>
                                    <span class="livinfo font-poppins">Info : This feature only for 'Instructors'.</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    </div>
    <!-- Body End -->

    @include('layouts.e_script')

    @if(auth()->user()->yearly_subscription_status === 'no')
        <script>

            $("#account_activation_date_counter").show();
            let counterDate = $("#counter_date").val();
            $('#example').countdown({
            date: counterDate
            }, function () {
                console.log('Expired!!!');
                $("#account_activation_date_counter").hide();
            });

        </script>

    @else

        <script>

            $("#subscription_date_counter").show();
            let dateCounter = $("#date_counter").val();
            $('#example_2').countdown({
            date: dateCounter
            }, function () {
                console.log('Expired!!!');
                $("#subscription_date_counter").hide();
            });

        </script>

    @endif

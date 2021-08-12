@php
$users = auth()->user();
$pageTitle = 'Course Enrollment';

$appSettings = new \App\Model\AppSettings();
$site_logo = $appSettings->getSingleModel();

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="{{env('APP_NAME', 'CENTADESK')}}">
    <meta name="author" content="{{env('APP_NAME', 'CENTADESK')}}">
    <title>{{env('APP_NAME', 'CENTADESK')}} - {{$pageTitle}}</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('dashboard/images/fav.png')}}">

		<!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  rel="stylesheet"/>
    <link href='{{asset('dashboard/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
    <link href="{{asset('dashboard/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/night-mode.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/jquery-steps.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/datepicker.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet"> --}}


    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/js-snackbar/dist/js-snackbar.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/js-snackbar/dist/site.css')}}"> --}}
    <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('toast/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">

    <!-- Vendor Stylesheets -->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendor/semantic/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/custom-app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/assets/loader.css')}}">

	</head>
    @php $link = auth()->user()->returnLink() @endphp

<body>

	<!-- Header Start -->
	<header class="header clearfix">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="back_link">
						<a href="{{route('view_course', $course->unique_id )}}" class="hde151 font-poppins">Back To {{env('APP_NAME', 'CENTADESK')}}</a>
						<a href="{{route('view_course', $course->unique_id )}}" class="hde152 font-poppins">Back</a>
					</div>
					<div class="ml_item">
						<div class="main_logo main_logo15" id="logo">
							<a href="{{route('home')}}"><img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{ env('APP_NAME') }}"></a>
							<a href="{{route('home')}}"><img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{ env('APP_NAME') }}"></a>
						</div>
					</div>
					<div class="header_right pr-0">
						<ul>
							<li class="ui top right pointing dropdown">
								<a href="#" class="opts_account">
									<img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="">
								</a>
								<div class="menu dropdown_account">
									<div class="channel_my">
										<div class="profile_link">
											<img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="">
											<div class="pd_content">
												<div class="rhte85">
													<h6 class="text-capitalize">{{auth()->user()->name}} {{auth()->user()->last_name}}</h6>
													<div class="mef78" title="Verify">
														<i class='uil uil-check-circle'></i>
													</div>
												</div>
												<span>{{auth()->user()->email}}</span>
											</div>
										</div>
                                        <a href="{{route('profile')}}" class="dp_link_12">View Profile</a>
									</div>
									<div class="night_mode_switch__btn">
										<a href="#" id="night-mode" class="btn-night-mode">
											<i class="uil uil-moon"></i> Night mode
											<span class="btn-night-mode-switch">
												<span class="uk-switch-button"></span>
											</span>
										</a>
									</div>
                                    <a href="{{route('main_settings_page')}}" class="item channel_item">Account Settings</a>
                                    <a class="item channel_item" href="javascript:void(0)" onclick="bringOutModalMain('.logout')">Sign Out</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
	<!-- Body Start -->
	<div class="wrapper _bg4586 _new89">
		<div class="_215b15">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="title125">
							<div class="titleleft">
								<div class="ttl121">
									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
											<li class="breadcrumb-item active font-poppins" aria-current="page">Enrollment Cart</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
						<div class="title126">
							<h2>Course Enrollment </h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb4d25">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="fcrse_1">
							<a href="" class="hf_img">
								<img class="cart_img" src="{{asset($link.'course-img/'.$course->cover_image)}}" alt="">
							</a>
							<div class="hs_content">
								<div class="eps_dots eps_dots10 more_dropdown">
									{{-- <a href="#"><i class='uil uil-times'></i></a> --}}
								</div>
								<a href="" class="crse14s title900 pt-2 font-poppins">{{ucfirst($course->name)}}</a>
                                <a class="_215b04 font-poppins text-capitalize">{{$course->short_caption}}</a>
                                <a href="" class="crse-cate font-poppins text-capitalize">{{$course->category->name}}</a>
								<div class="auth1lnkprce">
									<p class="cr1fot font-poppins text-capitalize">By <a class="" href="{{route('view_profile', $course->user->unique_id )}}">{{$course->user->name}} {{$course->user->last_name}}</a></p>
                                    <div class="prce142 font-poppins">{{auth()->user()->getAmountForView($course->price->amount)['data']['currency'] }} {{number_format($course->price->amount)}}</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="membership_chk_bg rght1528">
								<div class="checkout_title">
									<h4 class="text-capitalize font-poppins">Proceed with enrollment</h4>
									<img src="images/line.svg" alt="">
								</div>
								<div class="order_dt_section">
									<div class="order_title">
										<h2 class="font-poppins">Total</h2>
										<div class="order_price5 font-poppins">{{auth()->user()->getAmountForView($course->price->amount)['data']['currency'] }} {{number_format($course->price->amount)}}</div>
									</div>
                                    <form action="" class="enroll_form">
                                        @csrf
                                    </form>
									<div class="coupon_code ">
										<p class="font-poppins">By clicking enroll, you agree to our terms of usage.</p>
										{{-- <div class="coupon_input">
											<div class="ui search focus mt-15">
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="text" name="couponcode" value="" id="id_coupon_code" required="" maxlength="6" placeholder="Enter Coupon Code">
												</div>
												<button class="code-apply-btn" type="submit">Apply</button>
											</div>
										</div> --}}
									</div>
                                    @if ($enrolled == false)
									<button  class="btn chck-btn22 font-poppins btn-danger" onclick="bringOutModalMain('.enroll_modal')">Enroll</button>
                                    @else
									<button disabled class="btn chck-btn22 btn-primary font-poppins enroll_modal">Already Enrolled</button>
                                    @endif
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        @include('layouts.footer')
    </div>

<!-- Body End -->

@include('layouts.e_script')

<script>
    $(document).ready(function() {

        // process form for creating live stream
        $('.enroll_btn').click(async function(e) {
            e.preventDefault();
            let data = [];
            // basic info
            let enroll = $('.enroll_form').serializeArray();
            // console.log(enroll);
            // return;

            // append to form data object
            let form_data = set_form_data(enroll);
            let returned = await ajaxRequest('/course/enroll/{{ Request::segment(3) }}', form_data);
            // console.log(returned);return;
            validator(returned, '/course/checkout/{{ Request::segment(3) }}');
            removeModalMains('.enroll_modal');
        });

    });
</script>

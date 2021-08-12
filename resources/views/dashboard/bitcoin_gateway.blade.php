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
						<a href="{{route('my_balance')}}" class="hde151 font-poppins">Back To {{env('APP_NAME', 'CENTADESK')}}</a>
						<a href="{{route('my_balance')}}" class="hde152 font-poppins">Back</a>
					</div>
					<div class="ml_item">
						<div class="main_logo main_logo15" id="logo">
							<a href="{{route('home')}}"><img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt=""></a>
							<a href="{{route('home')}}"><img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}" alt=""></a>
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
													<h6>{{auth()->user()->name}} {{auth()->user()->last_name}}</h6>
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
											<li class="breadcrumb-item active font-poppins" aria-current="page">Payment Gateway</li>
										</ol>
									</nav>
								</div>
							</div>
						</div>
						<div class="title126">
							<h2 class="font-poppins">Bitcoin Payment Processing... </h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb4d25">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 m-auto">
						{{-- <div class="certi_form"> --}}
							<div class="sign_form m-auto">
								<form>
                                    <div class="ui search focus float-left">
                                        <h2 class="text-left mb-1">Awaiting Bitcoin Payment
                                            <span style="font-size: 30px;" class="iconify rotate" data-icon="whh:circleloaderthree" data-inline="false"></span>
                                        </h2>
                                        <p class="testtrm145 pt-0">Copy and send the bitcoin eqivalent below, to this payment address.
                                        </p>
                                    </div>
									<div class="ui search focus mt-10">
                                        <div class="testtrm145 form-label">Payment Address <span class="text-danger">*</span> </div>
										<div class="ui left icon input swdh11 swdh19">
											<input class="prompt srch_explore exp no-border-radius" type="text" value="{{ $transaction->btc_payment_address }}" disabled>
										</div>
									</div>
									<div class="ui search focus mt-10">
                                        <div class="testtrm145 form-label">Amount($) <span class="text-danger">*</span> </div>
										<div class="ui left icon input swdh11 swdh19">
											<input class="prompt srch_explore exp no-border-radius" type="text" value="{{ $transaction->amount }}" disabled>
										</div>
									</div>
									<div class="ui search focus mt-10">
                                        <div class="testtrm145 form-label">Bitcoin Equivalent <span class="text-danger">*</span> </div>
										<div class="ui left icon input swdh11 swdh19">
											<input class="prompt srch_explore exp no-border-radius" type="text" value="{{ $transaction->amount_in_btc }}" disabled>
										</div>
									</div>
								</form>
							</div>
						{{-- </div> --}}
					</div>
				</div>
			</div>
		</div>
        @include('layouts.footer')
    </div>

    <div class="modal zoomInUp " id="enroll_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  style="background-color: #333 !important;">
                <div class="modal-header">
                    <h4>Enroll for Course?</h4>
                </div>
                <form class="enroll_form">
                    @csrf
                    <div class="modal-body">
                        <p class="">By clicking continue, your account wallet will be used to pay for this course.</p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm enroll_btn" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Body End -->

@include('layouts.e_script')

<script>
    $(document).ready(function() {


    });
</script>

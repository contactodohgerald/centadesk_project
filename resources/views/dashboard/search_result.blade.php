@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();    

@endphp
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>{{ env('APP_NAME') }} - Search Result</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="{{asset('dashboard/images/fav.png')}}">
		
		<!-- Stylesheets -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
		<link href="{{ asset('dashboard/vendor/unicons-2.0.1/css/unicons.css')}}" rel='stylesheet'>
		<link href="{{ asset('dashboard/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/css/style.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/css/responsive.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/css/night-mode.css')}}" rel="stylesheet">
		
		<!-- Vendor Stylesheets -->
		<link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
		<link href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendor/semantic/semantic.min.css')}}">	
		
	</head> 

<body>
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="back_link">
						<a href="{{route('home')}}" class="hde151">Back To {{ env('APP_NAME') }}</a>
						<a href="{{route('home')}}" class="hde152">Back</a>
					</div>
					<div class="ml_item">
						<div class="main_logo main_logo15" id="logo">
							<a href="{{route('home')}}">
                                <img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{ env('APP_NAME') }} logo">
                            </a>
							<a href="{{route('home')}}">
                                <img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{ env('APP_NAME') }} logo">
                            </a>
						</div>				
					</div>				
					<div class="header_right pr-0">
						<ul>				
							<li class="ui top right pointing dropdown">
								<a href="#" class="opts_account">
									<img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="{{ env('APP_NAME') }}">
								</a>
								<div class="menu dropdown_account">
									<div class="channel_my">
										<div class="profile_link">
											<img src="{{asset(auth()->user()->returnLink().'/profile/'.auth()->user()->profile_image)}}" alt="{{ env('APP_NAME') }}">
											<div class="pd_content">
												<div class="rhte85">
													<h6>{{auth()->user()->name}} {{auth()->user()->last_name}}</h6>
                                                    @if (auth()->user()->verified_badge == 'yes')
                                                    <div class="mef78" title="Verified">
                                                        <i class='uil uil-check-circle'></i>
                                                    </div>
                                                    @endif
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
											<li class="breadcrumb-item active" aria-current="page">Search Results</li>
										</ol>
									</nav>
								</div>
							</div>
							<div class="titleright">						
								<div class="explore_search">
									<div class="ui search focus">
                                        <form action="{{ route('search-result') }}" method="POST">
                                            @csrf
                                            <div class="ui left icon input swdh11 swdh15">
                                                <input class="prompt srch_explore" required type="text" name="search_result" placeholder="Search for Courses, Instructors, more..">
                                                <i class="uil uil-search-alt icon icon2"></i>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
						<div class="title126">	
							<h2>Search Results For - <b>{{ $search }}</b></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sa4d25 mb4d25">
			<div class="container">			
				<div class="row justify-content-between">
                    <div class="col-lg-12">
                        <div class="course_tabs">
                            <nav>
                                <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="true">Courses</a>
                                    <a class="nav-item nav-link" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-selected="false">Categories</a>
                                    <a class="nav-item nav-link" id="nav-instructor-tab" data-toggle="tab" href="#nav-instructor" role="tab" aria-selected="false">Instructors</a>
                                    {{-- <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Reviews</a> --}}
                                </div>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="course_tab_content">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-courses" role="tabpanel">
                                    <h4 class="mhs_title">({{ count($course) }} Results) - Courses</h4>
                                    <div class="row">
                                        @if($course->count() > 0)
                                            @foreach($course as $each_course)
                                            <div class="col-lg-3 col-md-4">
                                                <div class="fcrse_1 mt-30">
                                                    <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                                        <img src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{env('APP_NAME')}}" width="218.5px" height="122.91">
                                                        <div class="course-overlay">
                                                            @if ($each_course->is_bestseller == 'yes')
                                                            <div class="badge_seller">Bestseller</div>
                                                            @endif
                                                            <div class="crse_reviews">
                                                                <i class="uil uil-star"></i>{{$each_course->count_review}}
                                                            </div>
                                                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                            <div class="crse_timer">
                                                                25 hours
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="fcrse_content">
                                                        <div class="eps_dots more_dropdown">
                                                            <a href="javascript:;"><i class="uil uil-ellipsis-v"></i></a>
                                                            <div class="dropdown-content">
                                                                <a href="{{env('BASE_URL')}}{{$each_course->unique_id}}"><span><i class='uil uil-share-alt'></i>Share</span></a>
                                                                <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                                <!--                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                                <span><i class="uil uil-windsock"></i>Report</span>-->
                                                            </div>
                                                        </div>
                                                        <div class="vdtodt">
                                                            <span class="vdt14">{{$each_course->views}} views</span>
                                                            <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                                        </div>
                                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s font-poppins">{{$each_course->name}}</a>
                                                        <a href="javascript:;" class="crse-cate font-poppins">{{$each_course->category->name}}</a>
                                                        <div class="auth1lnkprce">
                                                            <p class="cr1fot">By <a href="{{route('view_profile', $each_course->user->unique_id )}}">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                            <div class="prce142">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format($each_course->price->amount)}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="col-lg-12">
                                                <div class="alert alert-success text-center">
                                                    <h2>No Seach Result Was Returned</h2>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-category" role="tabpanel">
                                    <h4 class="mhs_title">({{ count($course_category_model) }} Results) - Categories</h4>
                                    <div class="la5lo1">
                                        @if(count($course_category_model) > 0)
                                        <div class="owl-carousel top_instrutors owl-theme">
                                            @foreach($course_category_model as $each_category)
                                            <div class="item">
                                                <div class="fcrse_1 mb-20">
                                                    <div class="tutor_img">
                                                        <a href="{{route('category-explore', $each_category->unique_id )}}">
                                                            <img src="{{asset('storage/category_image/'.$each_category->category_image)}}" alt="{{env('APP_NAME')}}">
                                                        </a>
                                                    </div>
                                                    <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <h2>
                                                                <a href="{{route('category-explore', $each_category->unique_id )}}" class="tutor_name font-poppins text-capitalize">{{ucfirst($each_category->name)}}</a>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <div class="col-lg-12">
                                                <div class="alert alert-success text-center">
                                                    <h2>No Seach Result Was Returned</h2>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-instructor" role="tabpanel">
                                    <h4 class="mhs_title">({{ count($instructors) }} Results) - Instructors</h4>

                                    <div class="_14d25">
                                        <div class="row">
                                            @if(count($instructors) > 0)
                                                @foreach($instructors as $each_instructors)
                                                    @if($each_instructors->unique_id == auth()->user()->unique_id)
                                                        @continue
                                                    @endif
                                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                                        <div class="fcrse_1 mt-30">
                                                            <div class="tutor_img">
                                                        <a href="{{route('view_profile', $each_instructors->unique_id )}}">
                                                            <img src="{{asset('storage/profile/'.$each_instructors->profile_image)}}" alt="{{env('APP_NAME')}}">
                                                        </a>
                                                    </div>
                                                            <div class="tutor_content_dt">
                                                        <div class="tutor150">
                                                            <a href="{{route('view_profile', $each_instructors->unique_id )}}" class="tutor_name text-capitalize font-poppins">{{$each_instructors->name}} {{$each_instructors->last_name}}</a>
                                                            @if ($each_instructors->verified_badge == 'yes')
                                                            <div class="mef78" title="Verified">
                                                                <i class='uil uil-check-circle'></i>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="tutor_cate font-poppins">{{$each_instructors->professonal_heading}}</div>
                                                        <ul class="tutor_social_links">
                                                            <li><a href="https://facebook.com/{{ $each_instructors->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="https://twitter.com/{{ $each_instructors->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                                            <li><a href="https://www.linkedin.com/{{ $each_instructors->linkedin }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                                            <li><a href="https://www.youtube.com/{{ $each_instructors->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                                        </ul>
                                                        <div class="tut1250">
                                                            <span class="vdt15">{{count($each_instructors->subscribers)}} Students</span>
                                                            <span class="vdt15">{{count($each_instructors->courses)}} Courses</span>
                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            <div class="col-md-12">
                                                <div class="main-loader mt-50">
                                                    <div class="spinner">
                                                        <div class="bounce1"></div>
                                                        <div class="bounce2"></div>
                                                        <div class="bounce3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-lg-12">
                                                <div class="alert alert-success text-center">
                                                    <h2>No Seach Result Was Returned</h2>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                {{-- <div class="tab-pane fade" id="nav-instuctor" role="tabpanel"> </div> --}}
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
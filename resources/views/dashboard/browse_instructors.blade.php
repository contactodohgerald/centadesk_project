@php
	$pageTitle = 'Browse Instructors Area';
	$instructor = 'active';
@endphp
@include('layouts.head')

<body>
<!-- Header Start -->
@include('layouts.header')
<!-- Header End -->

<!-- Left Sidebar Start -->
@include('layouts.sidebar')
<!-- Left Sidebar End -->

	<!-- Body Start -->
	<div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125">
                            <div class="explore_search">
                                <form action="{{ route('search-result') }}" method="POST">
                                    @csrf
                                    <div class="ui search focus">
                                        <div class="ui left icon input swdh11">
                                            <input class="prompt srch_explore" type="text" name="search_result" required placeholder="Search for Courses, Instructors, more..">
                                            <i class="uil uil-search-alt icon icon2"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
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
                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                        <div class="alert alert-success text-center">No Instructor Was Returned</div>
                                    </div>
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

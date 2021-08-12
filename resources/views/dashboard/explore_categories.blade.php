@php
	$pageTitle = 'Explore Category';
	$explore= 'active';
@endphp
@include('layouts.head')

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
                    <div class="col-xl-12 col-lg-8">
                        <div class="section3125">
                            <div class="explore_search">
                                <div class="ui search focus">
                                    <form action="{{ route('search-result') }}" method="POST">
                                        @csrf
                                        <div class="ui left icon input swdh11">
                                            <input class="prompt srch_explore" type="text" name="search_result" required placeholder="Search for Courses, Instructors, more..">
                                            <i class="uil uil-search-alt icon icon2"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="section3125 mb-15 mt-50">
                            <h4 class="item_title">{{$course_category_model->name}} Categories</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="_14d25">
                            <div class="row">
                                @if($course->count() > 0)
                                    @foreach($course  as $each_course)
                                    <div class="col-lg-3 col-md-4">
                                    <div class="fcrse_1 mt-30">
                                        <a href="{{route('view_course', $each_course->unique_id )}}" class="fcrse_img">
                                            <img src="{{asset($link.'course-img/'.$each_course->cover_image)}}" alt="">
                                            <div class="course-overlay">
<!--                                                <div class="badge_seller">Bestseller</div>-->
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
                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                <div class="dropdown-content">
<!--                                                    <span><i class='uil uil-share-alt'></i>Share</span>-->
                                                    <span onclick="saveCourse('{{$each_course->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
<!--                                                    <span><i class='uil uil-ban'></i>Not Interested</span>
                                                    <span><i class="uil uil-windsock"></i>Report</span>-->
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_course->views}} views</span>
                                                <span class="vdt14">{{$each_course->created_at->diffForHumans()}}</span>
                                            </div>
                                            <a href="{{route('view_course', $each_course->unique_id )}}" class="crse14s">{{$each_course->name}}</a>
                                            <a href="javascript:;" class="crse-cate">{{$each_course->category->name}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot">By <a href="{{route('view_profile', $each_course->user->unique_id )}}">{{$each_course->user->name}} {{$each_course->user->last_name}}</a></p>
                                                <div class="prce142">{{auth()->user()->getAmountForView($each_course->price->amount)['data']['currency'] }} {{number_format(auth()->user()->getAmountForView($each_course->price->amount)['data']['amount'])}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                                @endif
                                <div class="col-md-12">
                                    <div class="main-loader mt-50">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
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

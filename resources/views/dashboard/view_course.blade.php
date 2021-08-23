@php
$users = auth()->user();
$pageTitle = 'Course Details Area';
$Complain = 'active';
$color = '';
$likeColor = '';
$disLikeColor = '';
// if($_SESSION['view_time'] >= $_SESSION['view_time'] + 86400){
//     print 1;
// }else{
//     print 0;
// }
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

    <!-- Video Model Start -->
    <div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <iframe src="https://www.youtube.com/embed/{{$course->intro_video}}" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>

            </div>
        </div>
    </div>
    <!-- Video Model End -->
	<!-- Body Start -->
		<div class="wrapper _bg4586">
			<div class="_215b01">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="section3125">
								<div class="row justify-content-center">
									<div class="col-xl-4 col-lg-5 col-md-6">
										<div class="preview_video">
											<a href="#" class="fcrse_img" data-toggle="modal" data-target="#videoModal" style="height: 300px">
												<img src="{{asset($link.'course-img/'.$course->cover_image)}}" alt="{{ env('APP_NAME') }}" style="height: 100%; width: 100%">
												<div class="course-overlay">
{{--													<div class="badge_seller">Bestseller</div>--}}
													<span class="play_btn1"><i class="uil uil-play"></i></span>
													<span class="_215b02 font-poppins">Preview this course</span>
												</div>
											</a>
										</div>
										<input type="hidden" class="course_unique_id" value="{{$course->unique_id}}">
										<input type="hidden" class="user_unique_id" value="{{auth()->user()->unique_id}}">
										<div class="_215b10">
											<a href="javascript:;" onclick="saveCourse('{{$course->unique_id}}', '{{auth()->user()->unique_id}}')" class="_215b11 font-poppins" title="Save Course">
                                                @if (in_array(auth()->user()->unique_id, $course->user_array_hold))
                                                     <?php
                                                    $color = 'danger';
                                                    $text = 'Course Saved!';
                                                    ?>
                                                @else
                                                    <?php
                                                    $color = '';
                                                    $text = 'Save Course';
                                                    ?>
                                                @endif
												<span><i class="uil uil-heart text-{{$color}}"></i></span>{{$text}}
											</a>
										</div>
                                        <div class="_215b10">
                                            <a href="{{route('course-details', $course->unique_id)}}" class="_215b11 font-poppins" title="Share Course">
                                                <span><i class="uil uil-share-alt"></i></span>Share Course
                                            </a>
                                        </div>
									</div>
									<div class="col-xl-8 col-lg-7 col-md-6">
										<div class="_215b03">
											<h2 class="font-poppins">{{ucfirst($course->name)}}</h2>
											<span class="_215b04 font-poppins text-capitalize">{{$course->short_caption}}</span>
										</div>
										<div class="_215b05 font-poppins">
											<div class="crse_reviews mr-2 rating_ratio font-poppins">
											</div>
											({{count($course->reviews)}} ratings)
										</div>
										<div class="_215b05 font-poppins">
											{{ count($enrolls) }} students enrolled
										</div>
										<div class="_215b05 font-poppins">
											Last updated: {{$course->created_at->diffForHumans()}}
										</div>
                                        <div class="_215b05 font-poppins">
											Rate This Course:
                                            <div class="rating-box mt-20" id="rate"></div>
                                        </div>
                                        <ul class="_215b31">
                                            <li>
                                                <button class="btn_buy">
                                                    <a href="{{route('checkout', $course->unique_id) }}">Enroll Now</a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_215b15 _byt1458">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="user_dt5">
                                <div class="user_dt_left">
                                    <div class="live_user_dt">
                                        <div class="user_img5">
                                            <a href="{{route('view_profile', $course->user->unique_id )}}">
                                                <img src="/storage/profile/{{ $course->user->profile_image }}" alt="{{env('APP_NAME')}}">
                                            </a>
                                        </div>
                                        <div class="user_cntnt">
                                            <a href="{{route('view_profile', $course->user->unique_id )}}" class="_df7852">{{ucfirst($course->user->name)}} {{ucfirst($course->user->last_name)}}</a>
                                            @if ($users->unique_id !== $course->user_id)
                                                @if (in_array(auth()->user()->unique_id, $course->array_of_subscribers))
                                                    <?php $subscribe_text = 'Subscribed'; ?>
                                                @else
                                                    <?php $subscribe_text = 'Subscribe'; ?>
                                                @endif
                                                <button class="subscribe-btn" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$course->user->unique_id}}')">
                                                    {{$subscribe_text}} <i class="uil uil-{{($subscribe_text === 'Subscribed')?'check-circle':''}}"></i></button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="user_dt_right">
                                    <ul>
                                        <li>
                                            <a class="lkcm152"><i class="uil uil-eye text-danger"></i><span>{{$course->views}}</span></a>
                                        </li>
                                        <li>
                                            @if (in_array(auth()->user()->unique_id, $course->likes_user_array))
                                                <?php $likeColor = 'danger'; ?>
                                            @else
                                                <?php $likeColor = ''; ?>
                                            @endif
                                            <a href="javascript:;" class="lkcm152" onclick="likeAndDislikeCourse('like')"><i class="uil uil-thumbs-up text-{{$likeColor}}"></i><span>{{$course->likes}}</span></a>
                                        </li>
                                        <li>
                                            @if (in_array(auth()->user()->unique_id, $course->dislike_user_array))
                                                <?php $disLikeColor = 'danger'; ?>
                                            @else
                                                <?php $disLikeColor = ''; ?>
                                            @endif
                                            <a href="javascript:;" class="lkcm152" onclick="likeAndDislikeCourse('dislike')"><i class="uil uil-thumbs-down text-{{$disLikeColor}}"></i><span>{{$course->dislikes}}</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course_tabs">
                                <nav>
                                    <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
                                        <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Course Url's</a>
                                        <a class="nav-item nav-link" id="nav-subscriptions-tab" data-toggle="tab" href="#nav-enrollments" role="tab" aria-selected="false">Enrollments</a>
                                        <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Reviews</a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_215b17">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="course_tab_content">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                                        <div class="_htg451">
                                            <div class="_htg452 mt-35">
                                                <h3>Description</h3>
                                                <p>{!! $course->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                                        <div class="crse_content">
                                            <h3 class="font-poppins">Course Download Links</h3>
                                            <div class="_112456">
                                                <ul class="accordion-expand-holder">
                                                    <li><span class="_fgr123"> {{count($course->course_download_links)}} links</span></li>
                                                </ul>
                                            </div>
                                            @if ($user_is_enrolled)
                                                @if(count($course->course_download_links) > 0)
                                                <div id="accordion" class="ui-accordion ui-widget ui-helper-reset">
                                                    @foreach($course->course_download_links as $each_course_link)
                                                    <a href="{{$each_course_link}}" class="accordion-header" target="_blank">
                                                        <div class="section-header-left">
                                                            <span class="section-title-wrapper">
                                                                <i class='uil uil-presentation-play crse_icon'></i>
                                                                <span class="section-title-text font-poppins">{{$each_course_link}}</span>
                                                            </span>
                                                        </div>
                                                    </a>
                                                    @endforeach
                                                </div>
                                                @endif
                                            @else
                                            <div class="alert alert-info text-center font-poppins">Course download url's for this course will be displayed when you enroll.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="nav-enrollments" role="tabpanel">
                                        <div class="_htg451">
                                            <div class="_htg452">
                                                <h3>People enrolled to your course</h3>
                                                <div class="row">
                                                    @if(count($course->array_of_enrolled_users) > 0)
                                                    @foreach($course->array_of_enrolled_users as $e)
                                                    <div class="col-lg-3 col-md-4">
                                                        <div class="fcrse_1 mt-30">
                                                            <div class="tutor_img">
                                                                <a href="{{route('view_profile', $e->unique_id )}}">
                                                                    <img src="{{asset($link.'/profile/'.$e->profile_image)}}" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="tutor_content_dt">
                                                                <div class="tutor150">
                                                                    <a href="{{route('view_profile', $e->unique_id )}}" class="tutor_name">{{ucfirst($e->name)}} {{ucfirst($e->last_name)}}</a>
                                                                    <div class="mef78" title="Verified">
                                                                        <i class="uil uil-check-circle"></i>
                                                                    </div>
                                                                </div>
                                                                @if($e->user_type != 'student')
                                                                <div class="tutor_cate">{{$e->professonal_heading}}</div>
                                                                <ul class="tutor_social_links">
                                                                    @if (in_array(auth()->user()->unique_id, $course->array_of_subscribers))
                                                                    <?php $subscribe_text = 'Subscribed'; ?>
                                                                    @else
                                                                    <?php $subscribe_text = 'Subscribe'; ?>
                                                                    @endif
                                                                    <li> <button class="sbbc145" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$e->unique_id}}')">{{$subscribe_text}} <i class="uil uil-{{($subscribe_text === 'Subscribed')?'check-circle':''}}"></i></button></li>
                                                                </ul>
                                                                <div class="tut1250">
                                                                    <span class="vdt15">{{$e->enrolled_users}} Students</span>
                                                                    <span class="vdt15">{{$e->count_course}} Courses</span>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                        <div class="student_reviews">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <div class="reviews_left">
                                                        <h3 class="font-poppins">Student Feedback</h3>
                                                        <div class="total_rating">
                                                            <div class="rating-box">
                                                                <span class="rating-star full-star"></span>
                                                                <span class="rating-star full-star"></span>
                                                                <span class="rating-star full-star"></span>
                                                                <span class="rating-star full-star"></span>
                                                                <span class="rating-star half-star"></span>

                                                                <a href="javascript:;" class="lkcm152" onclick="likeAndDislikeCourse('dislike')"><i class="uil uil-thumbs-down text-{{$disLikeColor}}"></i><span>{{$course->dislikes}}</span></a>
                                                                </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="_rate003">
                                                                <div class="_rate004">
                                                                    <div class="progress progress1">
                                                                        <div class="progress-bar w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <div class="rating-box">
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                    </div>
                                                                    <div class="_rate002">70%</div>
                                                                </div>
                                                                <div class="_rate004">
                                                                    <div class="progress progress1">
                                                                        <div class="progress-bar w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <div class="rating-box">
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                    </div>
                                                                    <div class="_rate002">40%</div>
                                                                </div>
                                                                <div class="_rate004">
                                                                    <div class="progress progress1">
                                                                        <div class="progress-bar w-5" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <div class="rating-box">
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                    </div>
                                                                    <div class="_rate002">5%</div>
                                                                </div>
                                                                <div class="_rate004">
                                                                    <div class="progress progress1">
                                                                        <div class="progress-bar w-2" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <div class="rating-box">
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                    </div>
                                                                    <div class="_rate002">1%</div>
                                                                </div>
                                                                <div class="_rate004">
                                                                    <div class="progress progress1">
                                                                        <div class="progress-bar w-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <div class="rating-box">
                                                                        <span class="rating-star full-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                        <span class="rating-star empty-star"></span>
                                                                    </div>
                                                                    <div class="_rate002">1%</div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    {{-- <div class="review_right">
                                                        <div class="review_right_heading">
                                                            <h3>Reviews</h3>
                                                            <div class="review_search">
                                                                <input class="rv_srch" type="text" placeholder="Search reviews...">
                                                                <button class="rvsrch_btn"><i class='uil uil-search'></i></button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="review_all120 reviewHold">
                                                        @if(count($course->reviews) > 0)
                                                            @foreach($course->reviews as $key => $each_review)
                                                            <div class="review_item">
                                                                <div class="review_usr_dt">
                                                                    <img src="{{asset('storage/profile/'.$each_review->users->profile_image)}}" alt="{{env('APP_NAME')}}">
                                                                    <div class="rv1458">
                                                                        <h4 class="tutor_name1" onmouseover="getRatingsForView('{{$course->unique_id}}', '{{$each_review->users->unique_id}}', '.hold_value{{$key}}')">{{$each_review->users->name}} {{$each_review->users->last_name}}</h4>
                                                                        <span class="time_145">{{$each_review->created_at->diffForHumans()}}</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
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
            </div>
            @include('layouts.footer')
        </div>
        <!-- Body End -->


@include('layouts.e_script')

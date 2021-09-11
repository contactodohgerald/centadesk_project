@php
$pageTitle = 'Profile Page';
$profile = 'active';
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @extends('layouts.sidebar')
    @section('content')
    <!-- Left Sidebar End -->

    @php $link = auth()->user()->returnLink() @endphp

    <!-- Body Start -->
    <div class="wrapper _bg4586">
        <div class="_216b01">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <div class="section3125 rpt145">
                            <div class="row">
                                <div class="col-lg-7">
                                    <a href="#" class="_216b22">
                                        <span><i class="uil uil-windsock"></i></span>Report Profile
                                    </a>
                                    <div class="dp_dt150">
                                        <div class="img148">
                                            <img src="{{asset($link.'/profile/'.$user->profile_image)}}" alt="">
                                        </div>
                                        <div class="prfledt1 ">
                                            <h2 class="text-capitalize">{{ $user->name }} {{ $user->last_name }}</h2>
                                            <span class="text-capitalize">{{ $user->professonal_heading }}
                                                @if ($user->professonal_heading)
                                                |
                                                @endif

                                                {{($user->user_type === 'super_admin')?'Super Admin':$user->user_type}}</span>
                                            <div class="mt-1">
                                                <a target="_blank" href="https://centadesk.com/register?ref={{ ($user->yearly_subscription_status === 'yes')?$user->user_referral_id : '' }}">https://centadesk.com/register?ref={{ ($user->yearly_subscription_status == 'yes')?$user->user_referral_id : '' }}
                                                </a>
                                            </div>
                                            {{-- <span class="text-capitalize">{{($user->user_type === 'super_admin')?'Super Admin':$user->user_type}}</span> --}}
                                        </div>
                                    </div>
                                    <ul class="_ttl120">
                                        <li>
                                            <div class="_ttl121">
                                                <div class="_ttl122">Enrollments</div>
                                                <div class="_ttl123">{{$user->enrolled_users}}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="_ttl121">
                                                <div class="_ttl122">Courses</div>
                                                <div class="_ttl123">{{ count($user->courses) }}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="_ttl121">
                                                <div class="_ttl122">Reviews</div>
                                                <div class="_ttl123">{{count($user->comments_for_instructor)}}</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="_ttl121">
                                                <div class="_ttl122">Subscribers</div>
                                                <div class="_ttl123">{{count($user->subscribe)}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    {{-- <a href="#" class="_216b12">
										<span><i class="uil uil-windsock"></i></span>Report Profile
									</a> --}}
                                    <div class="rgt-145">
                                        <ul class="tutor_social_links">
                                            <li><a target="_blank" href="{{ $user->facebook }}" class="fb"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a target="_blank" href="{{ $user->twitter }}" class="tw"><i class="fab fa-twitter"></i></a></li>
                                            <li><a target="_blank" href="{{ $user->linkedin }}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a target="_blank" href="{{ $user->youtube }}" class="yu"><i class="fab fa-youtube"></i></a></li>
                                            <li><a target="_blank" href="{{ $user->instagram }}" class="ig"><i class="fab fa-instagram"></i></a></li>
                                            <li><a target="_blank" href="{{ $user->whatsapp }}" class="wapp"><i class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                    <ul class="_bty149">
                                        <li>
                                            @if (in_array(auth()->user()->unique_id, $user->array_of_subscribers))
                                            <?php $subscribe_text = 'Subscribed'; ?>
                                            @else
                                            <?php $subscribe_text = 'Subscribe'; ?>
                                            @endif
                                            <button class="subscribe-btn btn500" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$user->unique_id}}')">{{$subscribe_text}} <i class="uil uil-{{($subscribe_text === 'Subscribed')?'check-circle':''}}"></i></button>
                                        </li>
                                        {{-- <li><button class="msg125 btn500">Message</button></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="course_tabs">
                            <nav>
                                <div class="nav nav-tabs tab_crse" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-selected="true">About</a>
                                    <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-selected="false">Courses</a>
                                    <!--									<a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-selected="false">Discussion</a>-->
                                    <a class="nav-item nav-link" id="nav-subscriptions-tab" data-toggle="tab" href="#nav-subscriptions" role="tab" aria-selected="false">Subscribers</a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="_215b17">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="course_tab_content">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                                    <div class="_htg451">
                                        <div class="_htg452">
                                            <h3>About Me</h3>
                                            <p>{{ $user->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                                    <div class="crse_content">
                                        <h3>My courses ({{ count($user->courses) }})</h3>
                                        <div class="_14d25">
                                            <div class="row">
                                                @foreach ($user->courses as $e)
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="fcrse_1 mt-30">
                                                        <a href="{{route('view_course', $e->unique_id )}}" class="fcrse_img">
                                                            <img src="{{asset($link.'/course-img/'.$e->cover_image)}}" width="218.5px" height="122.91">
                                                            <div class="course-overlay">
                                                                @if ($e->is_bestseller == 'yes')
                                                                <div class="badge_seller">Bestseller</div>
                                                                @endif
                                                                <div class="crse_reviews">
                                                                    <i class="uil uil-star"></i>{{$e->count_review}}
                                                                </div>
                                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                                <div class="crse_timer font-poppins">
                                                                    {{$e->created_at->diffForHumans()}}
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="fcrse_content">
                                                            <div class="eps_dots more_dropdown">
                                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                <div class="dropdown-content">
                                                                    <span class="font-poppins" onclick="saveCourse('{{$e->unique_id}}', '{{auth()->user()->unique_id}}') "><i class="uil uil-heart"></i>Save</span>
                                                                </div>
                                                            </div>
                                                            <div class="vdtodt">
                                                                <span class="vdt14">{{$e->views}} views</span>&nbsp;
                                                                <span class="vdt14">{{$e->created_at->diffForHumans()}}</span>
                                                            </div>
                                                            <a href="{{route('view_course', $e->unique_id )}}" class="crse14s  font-poppins">{{ $e->name}}</a>
                                                            <a href="javascript:;" class="crse-cate font-poppins">{{$e->category->name}}</a>
                                                            <div class="auth1lnkprce">
                                                                <p class="cr1fot text-capitalize font-poppins">By <a href="#">{{ $e->user->name }} {{ $e->user->last_name }}</a></p>
                                                                <div class="prce142">{{auth()->user()->getAmountForView($e->price->amount)['data']['currency'] }} {{number_format($e->price->amount)}}</div>
                                                                <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                                    <div class="student_reviews">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="review_right">
                                                    <div class="review_right_heading">
                                                        <h3>Discussions</h3>
                                                    </div>
                                                </div>
                                                @if(auth()->user())
                                                <div class="cmmnt_1526">
                                                    <div class="cmnt_group">
                                                        <div class="img160">
                                                            <img src="{{asset($link.'/profile/'.$user->profile_image)}}" alt="{{env('APP_NAME')}}">
                                                        </div>
                                                        <textarea class="_cmnt001" rows="50" cols="50" id="comments_hold" placeholder="Add a public comment"></textarea>
                                                    </div>
                                                    <button class="cmnt-btn" type="submit" onclick="instructorsComment(this, '{{$user->unique_id}}')">Comment</button>
                                                </div>
                                                @endif
                                                @if(count($user->comments_for_instructor) > 0)
                                                <div class="review_all120">
                                                    @foreach($user->comments_for_instructor as $kkk => $each_comment)
                                                    <div class="review_item">
                                                        <div class="review_usr_dt">
                                                            <img src="{{asset($link.'/profile/'.$each_comment->users->profile_image)}}" alt="">
                                                            <div class="rv1458">
                                                                <h4 class="tutor_name1">{{ucfirst($each_comment->users->name)}} {{ucfirst($each_comment->users->last_name)}}</h4>
                                                                <span class="time_145">{{$each_comment->created_at->diffForHumans()}}</span>
                                                            </div>
                                                            <div class="eps_dots more_dropdown">
                                                                <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                                                                <div class="dropdown-content">
                                                                    <span><i class='uil uil-trash-alt'></i>Delete</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="rvds10">{{$each_comment->comment}}</p>
                                                        <div class="rpt101">
                                                            <a href="javascript:;" class="report155"><i class='uil uil-thumbs-up' onclick="likeAndDislikeMainReview(this, 'like', '{{$each_comment->unique_id}}')"></i>{{count($each_comment->likes)}}</a>
                                                            <a href="javascript:;" class="report155"><i class='uil uil-thumbs-down' onclick="likeAndDislikeMainReview(this, 'dislike', '{{$each_comment->unique_id}}')"></i>{{count($each_comment->dislikes)}}</a>
                                                            <a href="javascript:;" class="report155 ml-3" onclick="replyInstructorsComment(this, '{{$each_comment->unique_id}}')">Reply</a>
                                                        </div>
                                                    </div>
                                                    @if(count($each_comment->each_instructor_comments) > 0)
                                                    @foreach($each_comment->each_instructor_comments as $each_reply)
                                                    <div class="review_reply">
                                                        <div class="review_item">
                                                            <div class="review_usr_dt">
                                                                <img src="{{asset($link.'/profile/'.$each_reply->users->profile_image)}}" alt="{{env('APP_NEW')}}">
                                                                <div class="rv1458">
                                                                    <h4 class="tutor_name1">{{ucfirst($each_reply->users->name)}} {{ucfirst($each_reply->users->last_name)}}</h4>
                                                                    <span class="time_145">{{$each_reply->created_at->diffForHumans()}}</span>
                                                                </div>
                                                                <div class="eps_dots more_dropdown">
                                                                    <a href="javascript:;"><i class="uil uil-ellipsis-v"></i></a>
                                                                    <div class="dropdown-content">
                                                                        <span><i class='uil uil-trash-alt'></i>Delete</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="rvds10">{{$each_reply->comment}}</p>
                                                            <div class="rpt101">
                                                                <a href="javascript:;" class="report155"><i class='uil uil-thumbs-up' onclick="likeAndDislikeMainReview(this, 'like', '{{$each_reply->unique_id}}')"></i>{{count($each_reply->comment_reply_likes)}}</a>
                                                                <a href="javascript:;" class="report155"><i class='uil uil-thumbs-down' onclick="likeAndDislikeMainReview(this, 'dislike', '{{$each_reply->unique_id}}')"></i>{{count($each_reply->comment_reply_dislikes)}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="nav-subscriptions" role="tabpanel">
                                    <div class="_htg451">
                                        <div class="_htg452">
                                            <h3>Subscriptions</h3>
                                            <div class="row">
                                                @if(count($user->subscribe) > 0)
                                                @foreach($user->subscribe as $each_subscribe)
                                                @if($user->unique_id === auth()->user()->unique_id)
                                                @continue
                                                @endif
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="fcrse_1 mt-30">
                                                        <div class="tutor_img">
                                                            <a href="{{route('view_profile', $each_subscribe->users->unique_id )}}">
                                                                <img src="{{asset($link.'/profile/'.$each_subscribe->users->profile_image)}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="tutor_content_dt">
                                                            <div class="tutor150">
                                                                <a href="{{route('view_profile', $each_subscribe->users->unique_id )}}" class="tutor_name">{{ucfirst($each_subscribe->users->name)}} {{ucfirst($each_subscribe->users->last_name)}}</a>
                                                                <div class="mef78" title="Verified">
                                                                    <i class="uil uil-check-circle"></i>
                                                                </div>
                                                            </div>
                                                            @if($each_subscribe->users->user_type != 'student')
                                                            <div class="tutor_cate">{{$each_subscribe->users->professonal_heading}}</div>
                                                            <ul class="tutor_social_links">
                                                                @if (in_array(auth()->user()->unique_id, $user->array_of_subscribers))
                                                                <?php $subscribe_text = 'Subscribed'; ?>
                                                                @else
                                                                <?php $subscribe_text = 'Subscribe'; ?>
                                                                @endif
                                                                <li> <button class="sbbc145" onclick="subscribeTOTeacher(this, '{{auth()->user()->unique_id}}', '{{$each_subscribe->users->unique_id}}')">{{$subscribe_text}} <i class="uil uil-{{($subscribe_text === 'Subscribed')?'check-circle':''}}"></i></button></li>
                                                            </ul>
                                                            <div class="tut1250">
                                                                <span class="vdt15">{{$each_subscribe->enrolled_users}} Students</span>
                                                                <span class="vdt15">{{$each_subscribe->course_count}} Courses</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop
    </div>

    <div class="modal zoomInUp " id="delete_course_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #333 !important;">
                <div class="modal-header">
                    <h4>Delete Course?</h4>
                </div>
                <form class="delete_course_form">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">By clicking continue, this course will be deleted permanently. <br> It can't be recovered after this.</p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm delete_course_btn" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body End -->

    @include('layouts.e_script')
    @include('js_by_page.course_js')

    <script>
        $(document).ready(function() {
            $('.delete_course_modal').click(function(e) {
                e.preventDefault();
                append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
                $('#delete_course_modal').modal('toggle');
            });


            $('.delete_course_btn').click(async function(e) {
                e.preventDefault();
                let delete_course_form = $('.delete_course_form').serializeArray();
                let form_data = set_form_data(delete_course_form);
                let returned = await ajaxRequest('/delete-course/' + delete_course_form[1].value, form_data);
                console.log(returned);
                // return;
                validator(returned, '/view-courses');
            });

        });
    </script>
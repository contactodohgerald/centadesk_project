@php
$users = auth()->user();
$pageTitle = 'Saved Courses Area';
$Course = 'active';
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
                    <div class="col-lg-3 col-md-4 ">
                        <div class="section3125 hstry142">
                            <div class="grp_titles pt-0">
                                <div class="ht_title">
                                    <span class="vdt14">{{count($saved_courses)}} Saved Course(s)</span>
                                </div>
                            </div>
                            <div class="tb_145">
                                <div class="wtch125">
                                </div>
                                <a href="javascript:;" class="rmv-btn font-poppins" onclick="deleteSavedCourse(this, 'all')"><i class='uil uil-trash-alt'></i>Remove all Saved Courses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="_14d25 mb-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mhs_title font-poppins">Courses i saved</h4>
                                    @if (count($saved_courses) > 0)
                                    @foreach($saved_courses as $k => $each_saved_courses)
                                    <div class="fcrse_1 mt-30">
                                        <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="hf_img">
                                            <img src="{{asset($link.'course-img/'.$each_saved_courses->courses->cover_image)}}" alt="{{env('APP_NAME')}}" height="180">
                                            <div class="course-overlay">
                                                <!--                                                    <div class="badge_seller">Bestseller</div>-->
                                                <div class="crse_reviews font-poppins">
                                                    <i class="uil uil-star"></i>{{$each_saved_courses->count_review}}
                                                </div>
                                                <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                <div class="crse_timer font-poppins">
                                                    {{$each_saved_courses->created_at->diffForHumans()}}
                                                </div>
                                            </div>
                                        </a>
                                        <div class="hs_content">
                                            <div class="eps_dots eps_dots10 more_dropdown">
                                                <a href="javascript:;"><i class="uil uil-ellipsis-v"></i></a>
                                                <div class="dropdown-content">
                                                    <span onclick="deleteSavedCourse(this, 'single')"><i class='uil uil-times'></i>Remove</span>
                                                </div>
                                            </div>
                                            <div class="vdtodt">
                                                <span class="vdt14">{{$each_saved_courses->courses->views}} views</span>
                                                <span class="vdt14">{{$each_saved_courses->courses->created_at->diffForHumans()}}</span>
                                            </div>
                                            <input type="hidden" class="saved_course_id" value="{{$each_saved_courses->unique_id}}">
                                            <input type="hidden" class="user_unique_id" value="{{auth()->user()->unique_id}}">
                                            <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="crse14s title900 font-poppins">
                                                <b>{{substr(ucfirst($each_saved_courses->courses->name), 0, 40)}} {{ (strlen($each_saved_courses->courses->name) > 40 )?'...':''}}</b>
                                            </a>
                                            <a href="{{route('view_course', $each_saved_courses->courses->unique_id )}}" class="crse-cate font-poppins">{{$each_saved_courses->courses->short_caption}}</a>
                                            <div class="auth1lnkprce">
                                                <p class="cr1fot text-capitalize">By <a href="{{route('view_profile', $each_saved_courses->courses->user->unique_id )}}">{{$each_saved_courses->users->name}} {{$each_saved_courses->users->last_name}}</a></p>
                                                <div class="prce142">{{auth()->user()->getAmountForView($each_saved_courses->courses->price->amount)['data']['currency'] }} {{number_format($each_saved_courses->courses->price->amount)}}</div>
                                                <button class="shrt-cart-btn" title="cart"><i class="uil uil-shopping-cart-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="fcrse_1 mt-30">
                                        <div class="fcrse_1 mt-30 text-center">
                                            {{-- <div class="alert alert-success text-center"> --}}
                                            <p>
                                            <h6>
                                                No Saved Courses. Browse through our list of Courses and add to your Saved Libary.
                                            </h6>
                                            </p>
                                            {{-- </div> --}}
                                        </div>
                                        {{-- <div class="alert alert-success text-center">No Saved Courses, Browse through our list of Courses and add to your Saved Libary</div> --}}
                                    </div>
                                    @endif
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

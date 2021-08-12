@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Course Details | Choose course categories. Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <div style="background-color: #1c1d1f; padding-bottom: 3.2rem;" class="col-lg-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pt-5">
                    <h4><p class="text-primary"><b>{{ Str::ucfirst($course->category->name) }}</b></p></h4>
                    <div class="yl-section-title yl-headline">
                        <h2 class="text-white"><b>{{ Str::ucfirst($course->name) }}</b></h2>
                        <h5 class="pt-1 text-white">{{ Str::ucfirst($course->short_caption) }}</h5>
                        <p class="pt-4 text-white">
                            <em class="btn-sm btn btn-success text-white" {{ ($course->is_bestseller == 'no')?'hidden':'' }}>Bestseller</em>
                            Rating: {{ $course->count_reviews }}
                                    @for ($i = 1; $i <= $course->count_reviews; $i++)
                                        <i class="fas fa-star text-success"></i>
                                    @endfor
                            ({{count($course->review)}} ratings)
                            {{ count($course->courseEnrollment) }} students </p>
                        <p class="text-white">Created by: <a href="#" class="text-primary"><u>{{ ucfirst($course->user->name) }} {{ ucfirst($course->user->last_name) }}</u></a></p>
                        <p class="text-white"><i class="fa fa-clock"></i> Last updated {{$course->created_at->diffForHumans()}} | <i class="fa fa-user"></i> {{ count($course->courseEnrollment) }} Enrolled | <i class="fa fa-share"></i></p>
                    </div>
                </div>
                <div class="col-lg-4 pt-5 mt-3">
                    <div class="course-details-widget mb-0">
                        <div class="course-widget-wrap ht-y mb-0">
                            <div class="cd-video-widget position-relative">
                                <img class="img-fluid" src="{{asset('storage/course-img/'.$course->cover_image)}}" alt="{{ $course->name }}">
                                <a class="video_box text-center" href="https://www.youtube.com/watch?v={{ $course->intro_video }}"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="cd-course-price bg-dark text-white clearfix p-4 mt-0">
                       <h4> <span>Price: <strong>$ {{number_format($course->course_price)}}</strong></span>
                        <a href="{{route('checkout', $course->unique_id) }}" class="btn btn-sm btn-success">Enroll Now</a></h4>
                    </div>
                </div>
            </div>
        </div>
   </div>

   <section style="margin-top: -80px;" id="course-details" class="course-details-section">
       <div class="container">
           <div class="course-details-content">
               <div class="row">

                   <div class="col-lg-9">
                       <div class="course-details-tab-area">
                           <div class="course-details-tab-wrapper">

                               <div class="course-details-tab-btn clearfix ul-li">
                                   <ul id="tabs" class="nav text-uppercase nav-tabs">
                                       <li class="nav-item"><a href="#" data-target="#overview" data-toggle="tab" class="nav-link text-capitalize active">Overview </a></li>
                                       <li class="nav-item"><a href="#" data-target="#curriculm" data-toggle="tab" class="nav-link text-capitalize">Curriculum  </a></li>
                                       <li class="nav-item"><a href="#" data-target="#instructor" data-toggle="tab" class="nav-link text-capitalize">Instructor</a></li>
                                       <li class="nav-item"><a href="#" data-target="#review" data-toggle="tab" class="nav-link text-capitalize">Reviews </a></li>
                                   </ul>
                               </div>

                               <div class="course-details-tab-content-wrap">
                                   <div id="tabsContent" class="tab-content">
                                       <div id="overview" class="tab-pane fade  active show">
                                           <div class="course-details-overview yl-headline pera-content">
                                               <div class="course-overview-text">
                                                   <h3 class="c-overview-title">Course details</h3>
                                                   <p>{!! $course->description !!}</p>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="curriculm" class="tab-pane fade">
                                           <div class="cd-curriculam-top clearfix">
                                               <h3 class="c-overview-title float-left">Course Curriculum </h3>
                                               <div class="cd-curriculam-time-lesson float-right">
                                                   <span>{{ count($course->download_url) }} Lesson</span>
                                               </div>
                                           </div>
                                           <div class="accordion" id="accordionExample">
                                               <div class="yl-cd-cur-accordion yl-headline pera-content ul-li">
                                                   <div class="yl-cd-cur-accordion-header" id="headingOne">
                                                       <button data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                           <h3>Course Lesson Files   </h3>
                                                           <div class="cd-curriculam-time-lesson float-right">
                                                               <span>{{ count($course->download_url) }} Lesson</span>
                                                           </div>
                                                       </button>
                                                   </div>
                                                   <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                       <div class="yl-cd-cur-accordion-body">
                                                           <ul>
                                                               @if(count($course->download_url) > 0)
                                                                @foreach ($course->download_url as $each_download_link)
                                                                    <li>
                                                                        <i class="far fa-file-pdf"></i><a href="#">{{$each_download_link}}</a>
                                                                    </li>
                                                                @endforeach
                                                               @endif
                                                           </ul>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="instructor" class="tab-pane fade">
                                           <div class="cd-course-instructor yl-headline pera-content clearfix">
                                               <h3 class="c-overview-title">Course Instructors</h3>
                                               <div class="cd-ins-btn text-center float-right">
                                                   <a href="{{ route('instructor-courses', $course->user->unique_id ) }}">All Courses <i class="fas fa-chevron-right"></i></a>
                                                </div>
                                               <div class="cd-course-instructor-img-text clearfix">
                                                   <div class="cd-course-instructor-img float-left">
                                                       <img src="{{asset('storage/profile/'.$course->user->profile_image)}}" alt="{{ env('APP_NAME') }}">
                                                   </div>
                                                   <div class="cd-course-instructor-text">
                                                       <h3><a href="{{ route('instructor-profile', $course->user->unique_id) }}">{{ ucfirst($course->user->name) }} {{ ucfirst($course->user->last_name) }}</a></h3>
                                                       <div class="cd-course-instructor-rate d-flex ul-li">
                                                           <ul>
                                                               <li><i class="fas fa-star"></i></li>
                                                               <li><i class="fas fa-star"></i></li>
                                                               <li><i class="fas fa-star"></i></li>
                                                               <li><i class="fas fa-star"></i></li>
                                                               <li class="unchecked"><i class="fas fa-star"></i></li>
                                                           </ul>
                                                           <span class="cd-ins-review-rate">4.9</span>
                                                           <span class="cd-ins-total-review">(235 review)</span>
                                                       </div>
                                                       <div class="cd-ins-course-student">
                                                           <span><i class="fas fa-list-ul"></i> {{ count($course->user->courses) }} Course</span>
                                                           <span><i class="fas fa-user"></i>  {{ count($course->user->subscribers) }} Students</span>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="cd-ins-details">
                                                   <p>{{$course->user->description}}</p>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="review" class="tab-pane fade">
                                           <div class="cd-course-review-wrap clearfix">
                                               <h3 class="c-overview-title">Reviews</h3>
                                               @if(count($course->review) > 0)
                                               <div class="cd-course-user-comment">
                                                   @foreach($course->review as $each_review)
                                                    <div class="cd-course-review-comment clearfix">
                                                        <div class="cd-course-review-img float-left">
                                                            <img src="{{asset('storage/profile/'.$each_review->users->profile_image)}}" alt="{{env('APP_NAME')}}">
                                                        </div>
                                                        <div class="cd-course-review-text yl-headline pera-content ul-li">
                                                            <div class="cd-course-review-author-rattting clearfix">
                                                                <div class="cd-course-review-author float-left">
                                                                    <h3><a href="#">{{ucfirst($each_review->users->name)}} {{ucfirst($each_review->users->last_name)}}</a></h3>
                                                                    <span>{{$each_review->created_at->diffForHumans()}}</span>
                                                                </div>
                                                                <div class="cd-course-review-rate d-flex float-right">
                                                                    <ul>
                                                                        <li class="unchecked"><i class="fas fa-star"></i></li>
                                                                        @for ($i = 1; $i <= $each_review->rating; $i++)
                                                                        <li><i class="fas fa-star"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                    <span class="cd-ins-review-rate">{{ $each_review->rating }}</span>
                                                                </div>
                                                            </div>
                                                            <p>{{$each_review->review_message}}</p>
                                                        </div>
                                                    </div>
                                                   @endforeach
                                               </div>
                                               @else
                                               <div class="row">
                                                   <div class="col-lg-12">
                                                       <div class="alert alert-success text-center">Course review isn't available at this time</div>
                                                   </div>
                                               </div>
                                               @endif
                                           </div>
                                           {{-- <div class="cd-review-form">
                                               <h3 class="c-overview-title">Add a review</h3>
                                               <form action="#" method="post">
                                                   <div class="cd-comment-input d-flex">
                                                       <div class="cd-comment-input-field">
                                                           <input type="text" name="name" placeholder="Your name *">
                                                       </div>
                                                       <div class="cd-comment-input-field">
                                                           <input type="email" name="email" placeholder="Your Email *">
                                                       </div>
                                                       <div class="cd-comment-input-field">
                                                           <input type="text" name="phone" placeholder="Your Phone *">
                                                       </div>
                                                   </div>
                                                   <textarea name="text" placeholder="Your Review..."></textarea>
                                                   <button type="submit">Submit <i class="fas fa-arrow-right"></i></button>
                                               </form>
                                           </div> --}}
                                       </div>

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3">
                       <div class="course-details-widget">
                           <div class="course-widget-wrap">
                               <div class="cd-course-table-widget">
                                   <div class="cd-course-table-list">
                                       <div class="course-table-item clearfix">
                                           <span class="cd-table-title float-left"><i class="fas fa-users"></i> Max Students  : </span>
                                           <span class="cd-table-valur float-right">{{ count($course->courseEnrollment) }}</span>
                                       </div>
                                       <div class="course-table-item clearfix">
                                           <span class="cd-table-title float-left"><i class="fas fa-user"></i> Instructor : </span>
                                           <span class="cd-table-valur float-right">1</span>
                                       </div>
                                       <div class="course-table-item clearfix">
                                           <span class="cd-table-title float-left"><i class="fas fa-paste"></i> Certificate : </span>
                                           <span class="cd-table-valur float-right">Yes</span>
                                       </div>
                                   </div>
                                   <div class="cd-course-price clearfix">
                                       <span>Price: <strong>$ {{number_format($course->course_price)}}</strong></span>
                                       <a href="{{route('checkout', $course->unique_id) }}">Enroll Now</a>
                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

   <section id="yl-course" class="yl-course-section pt-3 mt-0">
       <div class="container">
           <div class="yl-course-top">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="yl-section-title yl-headline">
                           <h2>Related Courses</h2>
                       </div>
                   </div>

               </div>
           </div>
           <div class="yl-course-filter-wrap">

               <div class="filtr-container-area grid clearfix">
                   <div class="grid-sizer"></div>
                   @if(count($related_course) > 0)
                        @foreach ($related_course as $each_course)
                        <div class="grid-item grid-size-25 business design health">
                            <div class="yl-course-img-text">
                                <div class="yl-course-img position-relative">
                                    <span class="c-price-tag">$ {{number_format($each_course->course_price)}}</span>
                                    <img src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{ $each_course->name }}" class="img-size">
                                    <span class="c-hover-icon"><a href="{{ route('course-details', $each_course->unique_id) }}"><i class="fas fa-plus"></i></a></span>
                                </div>
                                <div class="yl-course-text">
                                    <div class="yl-course-meta">
                                        <a href="{{ route('course-details', $each_course->unique_id) }}"><i class="fas fa-file"></i>{{ count($each_course->download_url) }} Lessons</a>
                                        <a href="{{ route('course-details', $each_course->unique_id) }}"><i class="fas fa-user"></i> {{ count($each_course->courseEnrollment) }} Students</a>
                                    </div>
                                    <div class="yl-course-tilte-head yl-headline ul-li">
                                        <h3><a href="{{ route('course-details', $each_course->unique_id) }}">{{substr(ucfirst($each_course->name), 0, 40)}} {{ (strlen($each_course->name) > 40 )?'...':''}}</a></h3>
                                        <ul>{{ $each_course->count_reviews }}
                                            @for ($i = 1; $i <= $each_course->count_reviews; $i++)
                                                <li><i class="fas fa-star"></i></li>
                                            @endfor
                                        </ul>
                                        <span>({{count($each_course->review)}})</span>
                                    </div>
                                    <div class="yl-course-mentor clearfix">
                                        <div class="yl-c-mentor-img float-left">
                                            <img src="{{asset('storage/profile/'.$each_course->user->profile_image)}}" alt="{{ env('APP_NAME') }}">
                                        </div>
                                        <div class="yl-c-mentor-text">
                                            <h4><a href="{{ route('instructor-profile', $each_course->user->unique_id) }}">{{ ucfirst($each_course->user->name) }} {{ ucfirst($each_course->user->last_name) }}</a></h4>
                                            <span class="btn btn-success btn-sm" {{ ($each_course->is_bestseller == 'no')?'hidden':'' }}>Bestseller</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                   @else
                       <div class="col-lg-12">
                           <div class="alert alert-success text-center">No course is available at this moment</div>
                       </div>
                   @endif

               </div>

               <div class="yl-course-pagination clearfix text-center ul-li mt-5">
                   <ul>
                       <li>
                        <a href="{{$related_course->nextPageUrl()}}">Nxt</a>
                        <a href="#">{{$related_course->currentPage()}}</a>
                        <a href="{{$related_course->previousPageUrl()}}">Prv</a>
                       </li>
                   </ul>
               </div>

           </div>
       </div>
   </section>

   @include('include.footer')


   @include('include.e_script')

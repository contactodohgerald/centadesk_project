@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Courses | Choose course categories. Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')


    <section id="yl-course" class="yl-course-section">
        <div class="container">
            <div class="yl-course-top">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="yl-section-title yl-headline">
                            <h2>All Courses</h2>
                        </div>
                    </div>
 
                </div>
            </div>
            <div class="yl-course-filter-wrap">
 
                <div class="filtr-container-area grid clearfix">
                    <div class="grid-sizer"></div>
                    @if(count($course) > 0)
                         @foreach ($course as $each_course)
                             <div class="grid-item grid-size-25 business design health">
                                 <div class="yl-course-img-text">
                                     <div class="yl-course-img position-relative">
                                         <span class="c-price-tag">$ {{number_format($each_course->course_price)}}</span>
                                         <img src="{{asset('storage/course-img/'.$each_course->cover_image)}}" alt="{{ $each_course->name }}">
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
                            <a href="{{$course->nextPageUrl()}}">Nxt</a>
                            <a href="#">{{$course->currentPage()}}</a>
                            <a href="{{$course->previousPageUrl()}}">Prv</a>
                        </li>
                    </ul>
                </div>
 
            </div>
        </div>
    </section>

    @include('include.affliate')

    <section id="yl-slider" class="yl-slider-section pt-5 pb-5 mt-3">
        <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="yl-section-title yl-headline">
                         <h2>Most Popular Courses</h2>
                     </div>
                 </div>
             </div>
             <div class="yl-department-content">
                 <div id="yl-department-slider-id" class="yl-department-slide owl-carousel">
                     @if(count($courses_list) > 0)
                         @foreach ($courses_list as $each_course_list)
                             <div class="position-relative grid-item grid-size-25 business design health">
                                 <div class="yl-course-img-text">
                                     <div class="yl-course-img position-relative">
                                         <span class="c-price-tag">$ {{number_format($each_course_list->course_price)}}</span>
                                         <img src="{{asset('storage/course-img/'.$each_course_list->cover_image)}}" alt="{{ $each_course_list->name }}">
                                         <span class="c-hover-icon"><a href="course-details"><i class="fas fa-plus"></i></a></span>
                                     </div>
                                     <div class="yl-course-text">
                                         <div class="yl-course-meta">
                                             <a href="{{ route('course-details', $each_course_list->unique_id) }}"><i class="fas fa-file"></i>{{ count($each_course_list->download_url) }} Lessons</a>
                                             <a href="{{ route('course-details', $each_course_list->unique_id) }}"><i class="fas fa-user"></i> {{ count($each_course_list->courseEnrollment) }} Students</a>
                                         </div>
                                         <div class="yl-course-tilte-head yl-headline ul-li">
                                             <h3><a href="{{ route('course-details', $each_course_list->unique_id) }}">{{substr(ucfirst($each_course_list->name), 0, 40)}} {{ (strlen($each_course_list->name) > 40 )?'...':''}}</a></h3>
                                             <ul>{{ $each_course_list->count_reviews }}
                                                 @for ($i = 1; $i <= $each_course_list->count_reviews; $i++)
                                                     <li><i class="fas fa-star"></i></li>
                                                 @endfor
                                             </ul>
                                             <span>({{count($each_course_list->review)}})</span>
                                         </div>
                                         <div class="yl-course-mentor clearfix">
                                             <div class="yl-c-mentor-img float-left">
                                                 <img src="{{asset('storage/profile/'.$each_course_list->user->profile_image)}}" alt="{{ env('APP_NAME') }}">
                                             </div>
                                             <div class="yl-c-mentor-text">
                                                 <h4><a href="{{ route('instructor-profile', $each_course_list->user->unique_id) }}">{{ ucfirst($each_course_list->user->name) }} {{ ucfirst($each_course_list->user->last_name) }}</a></h4>
                                                 <span class="btn btn-success btn-sm" {{ ($each_course_list->is_bestseller == 'no')?'hidden':'' }}>Bestseller</span>
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
             </div>
        </div>
    </section>


   @include('include.footer')
        
   
   @include('include.e_script')
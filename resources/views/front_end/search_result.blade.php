@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Search Results';
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
                <div class="col-lg-12 pt-5">
                    <div class="yl-section-title yl-headline">
                        <h2 class="text-white"><b>Search Result For - {{ $search }}</b></h2>
                    </div>
                </div>
            </div>
        </div>
   </div>

   <section style="margin-top: -80px;" id="course-details" class="course-details-section">
       <div class="container">
           <div class="course-details-content">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="course-details-tab-area">
                           <div class="course-details-tab-wrapper">

                               <div class="course-details-tab-btn clearfix ul-li">
                                   <ul id="tabs" class="nav text-uppercase nav-tabs">
                                       <li class="nav-item"><a href="#" data-target="#courses" data-toggle="tab" class="nav-link text-capitalize active">Courses </a></li>
                                       <li class="nav-item"><a href="#" data-target="#category" data-toggle="tab" class="nav-link text-capitalize">Categories  </a></li>
                                       <li class="nav-item"><a href="#" data-target="#instructor" data-toggle="tab" class="nav-link text-capitalize">Instructors</a></li>
                                       <li class="nav-item"><a href="#" data-target="#blogs" data-toggle="tab" class="nav-link text-capitalize">Blogs </a></li>
                                   </ul>
                               </div>

                               <div class="course-details-tab-content-wrap">
                                   <div id="tabsContent" class="tab-content">
                                       <div id="courses" class="tab-pane fade  active show">
                                           <div class="course-details-overview yl-headline pera-content">
                                               <div class="course-overview-text">
                                                   <h3 class="c-overview-title">({{ count($course) }} Results) - Courses</h3>
                                                   <hr>
                                                   <div class="yl-course-filter-wrap">
                                                       
                                                            @if(count($course) > 0)
                                                            <div class="filtr-container-area grid clearfix">
                                                                <div class="grid-sizer"></div>

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
                                                                                    <h3><a href="{{ route('course-details', $each_course->unique_id) }}">{{ucfirst($each_course->name)}}</a></h3>
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

                                                            @else
                                                                <div class="col-lg-12 mb-5">
                                                                    <div class="alert alert-success text-center">
                                                                        <h2>No Seach Result Was Returned</h2>
                                                                    </div>
                                                                </div>
                                                            @endif
                                        
                                                       
                                                    </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="category" class="tab-pane fade">
                                           <div class="cd-curriculam-top clearfix">
                                               <h3 class="c-overview-title">({{ count($course_category_model) }} Results) - Category</h3>
                                               <hr>
                                           </div>
                                           
                                           <div class="yl-category-content-2">
                                            <div class="row">
                                             @if(count($course_category_model) > 0)
                                                 @foreach ($course_category_model as $each_course_category_model)
                                                     <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                                         <div class="yl-category-innerbox-2 text-center">
                                                             <div class="yl-category-icon">
                                                                 <i class="{{ $each_course_category_model->category_icon }}"></i>
                                                             </div>
                                                             <div class="yl-category-text yl-headline">
                                                                 <h3><a href="{{ route('course-list', $each_course_category_model->unique_id) }}">{{ Str::ucfirst($each_course_category_model->name) }}</a></h3>
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
                                       </div>
                                       <div id="instructor" class="tab-pane fade">
                                           <div class="cd-course-instructor yl-headline pera-content clearfix">
                                               <h3 class="c-overview-title">({{ count($instructors) }} Results) - Instructors</h3>
                                               <hr>

                                               @if (count($instructors) > 0)
                                               @foreach ($instructors as $each_instructors)
                                                <div class="cd-ins-btn text-center float-right">
                                                    <a href="{{ route('instructor-courses', $each_instructors->unique_id ) }}">All Courses <i class="fas fa-chevron-right"></i></a>
                                                </div>
                                                <div class="cd-course-instructor-img-text clearfix">
                                                    <div class="cd-course-instructor-img float-left">
                                                        <img src="{{asset('storage/profile/'.$each_instructors->profile_image)}}" alt="{{ env('APP_NAME') }}">
                                                    </div>
                                                    <div class="cd-course-instructor-text">
                                                        <h3><a href="{{ route('instructor-profile', $each_instructors->unique_id) }}">{{ ucfirst($each_instructors->name) }} {{ ucfirst($each_instructors->last_name) }}</a></h3>
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
                                                            <span><i class="fas fa-list-ul"></i> {{ count($each_instructors->courses) }} Course</span>
                                                            <span><i class="fas fa-user"></i> {{ count($each_instructors->subscribers) }}  Students</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               @endforeach
                                               @else
                                               <div class="col-lg-12 mb-5">
                                                    <div class="alert alert-success text-center">
                                                        <h2>No Seach Result Was Returned</h2>
                                                    </div>
                                                </div>
                                               @endif
                                           </div>
                                       </div>
                                       <div id="blogs" class="tab-pane fade">
                                           <div class="cd-course-review-wrap clearfix">
                                               <h3 class="c-overview-title">({{ count($blogs) }} Results) - Blogs</h3>
                                               <hr>
                                              
                                               <div class="blog-feed-content-wrap">
                                                    
                                                    @if(count($blogs) > 0)
                                                    <div class="row justify-content-center">
                                                        @foreach($blogs as $each_blog)
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="yl-blog-img-text-2 yl-headline pera-content">
                                                                    <div class="yl-blog-img-2 position-relative">
                                                                        <div class="yl-blog-img-warap-2 position-relative">
                                                                            <img src="{{asset('storage/blog_image/'.$each_blog->blog_image)}}" alt="{{env('APP_NAME')}}">
                                                                        </div>
                                                                        <div class="yl-blog-date-2 text-center">
                                                                            <a href="javascript:;"><span>{{$each_blog->created_at->diffForHumans()}}</span></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="yl-blog-text-2">
                                                                        <div class="yl-blog-meta-2 text-uppercase">
                                                                            <a href="javascript:;">BY {{ Str::ucfirst($each_blog->users->name) }} {{ Str::ucfirst($each_blog->users->last_name) }}</a>
                                                                            <a href="javascript:;">{{$each_blog->views}} view</a>
                                                                        </div>
                                                                        <div class="yl-blog-title-text-2">
                                                                            <h3><a href="{{route('blog-details', $each_blog->unique_id )}}">{{$each_blog->blog_title}}</a>
                                                                            </h3>
                                                                            <a class="yl-blog-more text-uppercase" href="{{route('blog-details', $each_blog->unique_id )}}">View more <span>+</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="yl-course-pagination clearfix text-center ul-li">
                                                        <ul>
                                                            <li>
                                                            <a href="{{$blogs->nextPageUrl()}}">Nxt</a>
                                                            <a href="#">{{$blogs->currentPage()}}</a>
                                                            <a href="{{$blogs->previousPageUrl()}}">Prv</a>
                                                            </li>
                                                        </ul>
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

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

  @include('include.footer')
        
   
   @include('include.e_script')
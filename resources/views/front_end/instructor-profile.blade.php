@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Instructors Profile | Make money while learning';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

    <section id="instructor-details" class="instructor-details-section pt-5">
       <div class="container">
           <div class="instructor-details-content position-relative">
               <div class="row">
                   <div class="col-lg-5">
                       <div class="instructor-details-img">
                           <img src="{{asset('storage/profile/'.$users->profile_image)}}" alt="{{ env('APP_NAME') }}">
                       </div>
                   </div>
                   <div class="col-lg-7">
                       <div class="instructor-details-text">
                           <div class="instructor-details-text-top clearfix">
                               <div class="instructor-details-name-social  yl-headline float-left">
                                   <h3>{{ ucfirst($users->name) }} {{ ucfirst($users->last_name) }}</h3>
                                   <span>{{ ucfirst($users->professonal_heading) }}</span>
                                   <div class="instructor-details-social">
                                       <a href="https://facebook.com/{{ $users->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                       <a href="https://twitter.com/{{ $users->twitter }}"><i class="fab fa-twitter"></i></a>
                                       <a href="https://linkedin.com/{{ $users->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                       <a href="https://instagram.com/{{ $users->instagram }}"><i class="fab fa-instagram"></i></a>
                                   </div>
                               </div>
                               <div class="instructor-details-profile float-right">
                                   <span><i class="fas fa-list-ul"></i> {{ count($users->courses) }} Course</span>
                                   <span><i class="fas fa-user"></i> {{ count($users->subscribers) }} Students</span>
                                   <span><i class="fas fa-star"></i> {{ count($users->comments_for_instructor) }} review</span>
                               </div>
                           </div>
                           <div class="instructor-details-content-text pera-content">
                               <p>{{ $users->description }}</p>
                               <div class="btn text-center">
                                   <u>
                                        <a href="https://centadesk.com/register?ref={{ ($users->yearly_subscription_status === 'yes')?$users->user_referral_id : '' }}"> Join {{ ucfirst($users->name) }} {{ ucfirst($users->last_name) }}<i class="fas fa-chevron-right"></i></a>
                                    </u>
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
                           <h2>Popular Course  by: {{ ucfirst($users->name) }} {{ ucfirst($users->last_name) }}</h2>
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
                        <a href="{{$course->nextPageUrl()}}">Nxt</a>
                        <a href="#">{{$course->currentPage()}}</a>
                        <a href="{{$course->previousPageUrl()}}">Prv</a>
                    </li>
                </ul>
            </div>


           </div>
       </div>
   </section>


   @include('include.footer')

   @include('include.e_script')

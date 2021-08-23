@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Centadesk | Teach, Learn and Earn';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="yl-slider" class="yl-slider-section">
      <div id="yl-main-slider" class="yl-main-slider-wrap owl-carousel">

          <div class="slider-main-item position-relative">
            <div class="slider-main-img img-zooming" data-background="{{ asset('front_end/img/centadesk-online-learning-and-multilevel-platform.jpg')}}"></div>
            <div class="slider-overlay"></div>
            <div class="container">
               <div class="slider-main-text yl-headline pera-content">
                  <span style="text-shadow: rgb(0, 0, 0) 1px 1px;">Smooth Progression</span>
                  <h1 style="text-shadow: rgb(0, 0, 0) 1px 1px;" class="text-white">Teach, Learn and Earn with {{ env('APP_NAME') }}.
                  </h1>
                  <p class="text-white" style="text-shadow: rgb(0, 0, 0) 1px 1px;">Earn big time while learning/teaching the latest skills.</p>
                  <div class="slider-main-btn">
                     <a href="{{ route('about') }}"><i class="fas fa-user"></i> About us</a>
                     <a href="{{ route('list-courses') }}"><i class="fas fa-cog"></i> Courses</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="slider-main-item position-relative">
            <div class="slider-main-img img-zooming" data-background="{{ asset('front_end/img/tutor-online-with-centadesk-and-earn.jpg')}}"></div>
            <div class="slider-overlay"></div>
            <div class="container">
               <div class="slider-main-text yl-headline pera-content">
                  <span style="text-shadow: rgb(0, 0, 0) 1px 1px;">Earn in styles</span>
                  <h1 style="text-shadow: rgb(0, 0, 0) 1px 1px;" class="text-white">Become an instructor with {{ env('APP_NAME') }} and start earning.
                  </h1>
                  <p class="text-white" style="text-shadow: rgb(0, 0, 0) 1px 1px;">The system was design to connect students with skill teacher/tutors in different works of life. Earn big doing what you like.</p>
                  <div class="slider-main-btn">
                     <a href="{{ route('register') }}"><i class="fas fa-user"></i> Join Us</a>
                     <a href="{{ route('list-courses') }}"><i class="fas fa-cog"></i> Courses</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="slider-main-item position-relative">
            <div class="slider-main-img img-zooming" data-background="{{ asset('front_end/img/centadesk-online-learning-and-earning.jpg')}}"></div>
            <div class="slider-overlay"></div>
            <div class="container">
               <div class="slider-main-text yl-headline pera-content">
                  <span style="text-shadow: rgb(0, 0, 0) 1px 1px;">You're one step away</span>
                  <h1 style="text-shadow: rgb(0, 0, 0) 1px 1px;" class="text-white">Use our multi-level system to earn massive income.</h1>
                  <p class="text-white" style="text-shadow: rgb(0, 0, 0) 1px 1px;">Grow with {{ env('APP_NAME') }} by joining our affiliate system. Earn massively when you invite your family and friends to join {{ env('APP_NAME') }}.</p>
                  <div class="slider-main-btn">
                     <a href="{{ route('how-it-work') }}"><i class="fas fa-user"></i> Become an Agent</a>
                     <a href="{{ route('list-courses') }}"><i class="fas fa-cog"></i> Courses</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section id="yl-department" class="yl-department-section">
       <div class="container">
           <div class="row">
               <div class="col-lg-6">
                   <div class="yl-section-title yl-headline">
                       <span> Top Categories</span>
                       <h2>Get value learning with {{ env('APP_NAME') }}.</h2>
                   </div>
               </div>
           </div>
           <div class="yl-department-content">
               <div id="yl-department-slider-id" class="yl-department-slide owl-carousel">

                  @if(count($course_category_model) > 0)
                     @foreach ($course_category_model as $each_course_category_model)
                        <div class="yl-department-innerbox position-relative">
                           <div class="yl-department-img">
                              <img src="{{asset('storage/category_image/'.$each_course_category_model->category_image)}}" alt="{{ env('APP_NAME') }}">
                           </div>
                           <div class="yl-department-text-icon">
                              <div class="yl-department-icon float-left">
                                 <i class="{{ $each_course_category_model->category_icon }}"></i>
                              </div>
                              <div class="yl-department-text yl-headline">
                                 <h3><a href="{{ route('course-list', $each_course_category_model->unique_id) }}">{{ Str::ucfirst($each_course_category_model->name) }}</a></h3>
                                 <span>{{ count($each_course_category_model->courses) }} Courses</span>
                              </div>
                           </div>
                           <div class="yl-department-hover-text text-center">
                              <div class="yl-department-icon">
                                 <i class="{{ $each_course_category_model->category_icon }}"></i>
                              </div>
                              <div class="yl-department-text yl-headline">
                                 <h3><a href="{{ route('course-list', $each_course_category_model->unique_id) }}">{{ Str::ucfirst($each_course_category_model->name) }}</a></h3>
                                 <span>{{ count($each_course_category_model->courses) }} Courses</span>
                              </div>
                           </div>
                           <div class="yl-department-more-btn">
                              <a href="{{ route('course-list', $each_course_category_model->unique_id) }}"><i class="flaticon-arrow"></i></a>
                           </div>
                     </div>
                     @endforeach
                   @endif

               </div>
               <div class="yl-department-btn text-center">
                   <a href="{{ route('categories') }}">All Categories <i class="fas fa-chevron-right"></i></a>
               </div>
           </div>
       </div>
   </section>

   @include('include.affliate')

   <section id="yl-course" class="yl-course-section">
       <div class="container">
           <div class="yl-course-top">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="yl-section-title yl-headline">
                           <span>Courses</span>
                           <h2>Subscribe to any of our courses and get a one year free license to earn with {{ env('APP_NAME') }}. </h2>
                       </div>
                   </div>

               </div>
           </div>
           <div class="yl-course-filter-wrap">
            @if(count($course_category_model) > 0)
               <div class="button-group yl-course-filter-btn text-center clearfix">
                   <button class="filter-button is-checked" data-filter="*">All Categories</button>
                   @foreach($course_category_model as $each_category)
                     <button class="filter-button" data-filter=".{{$each_category->name}}">{{ucfirst($each_category->name)}}</button>
                  @endforeach
               </div>
               <div class="filtr-container-area grid clearfix" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
                   <div class="grid-sizer"></div>

                   @foreach($course_category_model as $each_category)
                     @foreach ($each_category->courses as $hji => $each_courses)

                        <div class="grid-item grid-size-25 {{ $each_category->name }}" data-category="{{ $each_category->name }}">
                           <div class="yl-course-img-text">
                              <div class="yl-course-img position-relative">
                                 <span class="c-price-tag">$ {{number_format($each_courses->course_price)}}</span>
                                 <span style="left: 10px;
                                 right: 120px;" class="c-price-tag" {{ ($each_courses->is_bestseller == 'no')?'hidden':'' }}>Bestseller</span>
                                 <img src="{{asset('storage/course-img/'.$each_courses->cover_image)}}" alt="{{ $each_courses->name }}" class="img-size">
                                 <span class="c-hover-icon"><a href="{{ route('course-details', $each_courses->unique_id) }}"><i class="fas fa-plus"></i></a></span>
                              </div>
                              <div class="yl-course-text">
                                 <div class="yl-course-meta">
                                    <a href="{{ route('course-details', $each_courses->unique_id) }}"><i class="fas fa-file"></i>{{ count($each_courses->download_url) }} Lessons</a>
                                    <a href="{{ route('course-details', $each_courses->unique_id) }}"><i class="fas fa-user"></i> {{ count($each_courses->courseEnrollment) }} Students</a>
                                 </div>
                                 <div class="yl-course-tilte-head yl-headline ul-li">
                                    <h3><a href="{{ route('course-details', $each_courses->unique_id) }}"> {{substr(ucfirst($each_courses->name), 0, 40)}} {{ (strlen($each_courses->name) > 40 )?'...':''}}</a></h3>
                                    <ul>{{ $each_courses->count_reviews }}
                                       @for ($i = 1; $i <= $each_courses->count_reviews; $i++)
                                       <li><i class="fas fa-star"></i></li>
                                   @endfor
                                    </ul>
                                    <span>({{count($each_courses->review)}})</span>
                                 </div>
                                 <div class="yl-course-mentor clearfix">
                                    <div class="yl-c-mentor-img float-left">
                                          <img src="{{asset('storage/profile/'.$each_courses->user->profile_image)}}" alt="{{ env('APP_NAME') }}">
                                    </div>
                                    <div class="yl-c-mentor-text">
                                          <h4><a href="{{ route('instructor-profile', $each_courses->user->unique_id) }}">{{ ucfirst($each_courses->user->name) }} {{ ucfirst($each_courses->user->last_name) }}</a></h4>
                                          {{-- <span class="btn btn-success btn-sm" {{ ($each_courses->is_bestseller == 'no')?'hidden':'' }}>Bestseller</span> --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                   @endforeach

               </div>
            @endif
           </div>
       </div>
   </section>

   <section id="yl-about" class="yl-about-section">
      <div class="container">
         <div class="yl-about-content">
            <div class="row">

               <div class="col-lg-6">
                  <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                     <div class="yl-section-title yl-headline">
                        <span>Become an instructor</span>
                        <h2>Teach and earn. Use our platform to connect with students all over the globe.</h2>
                     </div>
                     <div class="yl-about-text pera-content">
                        <p>Become a tutor with {{ env('APP_NAME') }}. Use our platform to build a community of students and earn big time.</p>
                        <p>The steps are quit simple.
                              <br>1. create quality teaching materials.
                              <br>2. get approved and start earning.
                        </p>
                        <div class="yl-about-qoute">
                           <span>Join the dower's and transform your life. "knowledge, you will never know how powerful it is until you take an action." </span>
                           <div class="yl-quote-author yl-headline">
                              <h4><a href="./">peter chris</a></h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

                  <div class="col-lg-6">
                     <div class="yl-about-video-area position-relative wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

                        <div class="yl-video-img text-center">
                              <img src="{{ asset('front_end/img/become-a-tutor-with-centadesk.jpg')}}" alt="About Centadesk">
                        </div>
                        <div class="yl-video-play-btn text-center">
                              <a class="video_box" href="https://www.youtube.com/watch?v=gqtNdcWAyKY">
                                 <i class="fas fa-play"></i>
                                 <span class="video_btn_border border_wrap-1"></span>
                                 <span class="video_btn_border border_wrap-2"></span>
                                 <span class="video_btn_border border_wrap-3"></span>
                              </a>
                        </div>
                     </div>
                  </div>

            </div>
         </div>
      </div>
   </section>


   <section id="yl-testimonial" class="yl-testimonial-section" data-background="{{ asset('front_end/img/centadesk-clients-testimonies.jpg')}}">
      <div class="container">
         <div class="row">
            <div class="col-lg-5">
               <div class="yl-section-title yl-headline">
                  <span>Client’s testimonials</span>
                  <h2>We are Very Happy to Get
                     Our Client’s Reviews.
                  </h2>
               </div>
               <div class="yl-testimonial-content">
                  <div id="yl-testimonial-slide" class="yl-testimonial-area owl-carousel">
                     <div class="yl-testimonial-item-wrap pera-content yl-headline">
                        <p style="text-shadow: rgb(0, 0, 0) 1px 1px;">“It’s a 5/5 star for me. The process is very straightforward and easy. I find the classes more exciting and enlightening than any physical classes I have attended, and I hope to upgrade to a golden agent by the end of the month.
                              ”</p>
                        <div class="yl-testimonial-author">
                           <div class="yl-testimonial-pic float-left">
                              <img src="{{ asset('front_end/img/Aneke-Micheal-Web-Developer.jpg')}}" alt="Aneke-Micheal">
                           </div>
                           <div class="yl-testimonial-text">
                              <div class="yl-testimonial-rate ul-li">
                                 <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                 </ul>
                              </div>
                              <h4><a>Aneke Micheal</a></h4>
                              <span>Student</span>
                           </div>
                        </div>
                     </div>
                     <div class="yl-testimonial-item-wrap pera-content yl-headline">
                        <p style="text-shadow: rgb(0, 0, 0) 1px 1px;">“The mentoring approach is good, and the courses are good and very helpful. The instructors are doing an excellent job of communicating, and the arrangement is very awesome”</p>
                        <div class="yl-testimonial-author">
                           <div class="yl-testimonial-pic float-left">
                              <img src="{{ asset('front_end/img/Ogechukwu-Nwoye.jpg')}}" alt="Ogechukwu Nwoye">
                           </div>
                           <div class="yl-testimonial-text">
                              <div class="yl-testimonial-rate ul-li">
                                 <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                 </ul>
                              </div>
                              <h4><a>Ogechukwu Nwoye</a></h4>
                           </div>
                        </div>
                     </div>
                     <div class="yl-testimonial-item-wrap pera-content yl-headline">
                        <p style="text-shadow: rgb(0, 0, 0) 1px 1px;">“One thing that amazes me about them is how fast they respond to questions. Also i have been making some extra cash Centadesk is bea.”</p>
                        <div class="yl-testimonial-author">
                           <div class="yl-testimonial-pic float-left">
                              <img src="{{ asset('front_end/img/Eze-Daniel-Ifeanyi.jpg')}}" alt="Eze Daniel">
                           </div>
                           <div class="yl-testimonial-text">
                              <div class="yl-testimonial-rate ul-li">
                                 <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                 </ul>
                              </div>
                              <h4><a>Eze Daniel</a></h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section id="yl-registration" class="yl-registration-section position-relative">
      <div class="container">
         <div class="yl-registration-content">
            <div class="row">
               <div class="col-lg-6">
                  <div class="yl-registration-countdown">
                     <div class="yl-section-title yl-headline">
                        <span>Affiliate member</span>
                        <h2>Join our multi-level affiliate program and earn massively.
                        </h2>
                     </div>
                     <div class="yl-registration-countdown-wrap">
                        <div class="coming-countdown ul-li">
                           <ul>
                              <li class="days">
                                 <span class="arch-count-down-number"></span>
                                 <span class="count-unit">Days</span>
                              </li>
                              <li class="hours">
                                 <span class="arch-count-down-number"></span>
                                 <span class="count-unit">Hours</span>
                              </li>
                              <li class="minutes">
                                 <span class="arch-count-down-number"></span>
                                 <span class="count-unit">Minutes</span>
                              </li>
                              <li class="seconds">
                                 <span class="arch-count-down-number"></span>
                                 <span class="count-unit">Seconds</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="yl-registration-text-wrap yl-headline pera-content">
                     <h3>Get up to 35% commission for every referral.                           </h3>
                     <p>We have carefully structure our system and created different ways in which our users can earn. You can build your own community around {{ env('APP_NAME') }}.</p>
                     <a href="{{ route('register') }}">Register Now</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section id="yl-blog" class="yl-blog-section" data-background="{{ asset('front_end/assets/img/blg-bg.jpg')}}">
      <div class="container">
         <div class="yl-blog-content">
            <div class="row">
               <div class="col-lg-6">
                  <div class="yl-section-title yl-headline">
                     <span>Blog</span>
                     <h2>Stay updated with our recent blog posting.
                     </h2>
                  </div>
               </div>
            </div>
            <div id="yl-blog-slider-id" class="yl-blog-slide-wrap owl-carousel">
               @if(count($blogs) > 0)
                  @foreach($blogs as $jj => $each_blog)
                     @if ($jj == 13)
                        @break
                     @endif
                     <div class="yl-blog-img-text">
                        <div class="yl-blog-img text-center position-relative">
                           <img src="{{asset('storage/blog_image/'.$each_blog->blog_image)}}" alt="{{env('APP_NAME')}}">
                           <div class="yl-blog-date">
                              <i class="fas fa-calendar-alt"></i> {{$each_blog->created_at->diffForHumans()}}
                           </div>
                        </div>
                        <div class="yl-blog-text yl-headline pera-content">
                           <div class="yl-blog-meta text-uppercase">
                              <a href="{{route('blog-details', $each_blog->unique_id )}}"><i class="far fa-user"></i> {{ Str::ucfirst($each_blog->users->name) }} {{ Str::ucfirst($each_blog->users->last_name) }}</a>
                           </div>
                           <div class="yl-blog-title">
                              <h3><a href="{{route('blog-details', $each_blog->unique_id )}}">{{substr(ucfirst($each_blog->blog_title), 0, 40)}} {{ (strlen($each_blog->blog_title) > 40 )?'...':''}}</a>
                              </h3>
                              @php $taglessBody = strip_tags($each_blog->blog_message); @endphp
                              <p>{{substr($taglessBody, 0, 120)}}  {{ (strlen($taglessBody) > 120 )?'...':''}} </p>
                              <a class="yl-blog-more text-uppercase" href="{{route('blog-details', $each_blog->unique_id )}}"><b>View more</b> <span>+</span></a>
                           </div>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="alert alert-success text-center">No Blog Post is Available at this time, Please check back at a later time</div>
                     </div>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </section>

   <section id="yl-newslatter" class="yl-newslatter-section">
      <div class="container">
         <div class="yl-newslatter-content">
            <div class="row">
               <div class="col-md-6">
                  <div class="yl-newslatter-text-icon">
                     <div class="yl-newslatter-icon float-left">
                        <i class="flaticon-email"></i>
                     </div>
                     <div class="yl-newslatter-text yl-headline">
                        <h3>Subscribe to a Newsletter!</h3>
                        <span>You will get our update instantly! <img src="assets/img/like.png" alt=""></span>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="yl-newslatter-form position-relative">
                     <form action="#">
                        <input type="email" placeholder="Enter your mail address...">
                        <button>Submit <i class="fas fa-arrow-right"></i></button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>


   @include('include.footer')


   @include('include.e_script')

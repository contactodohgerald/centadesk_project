@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'About Centadesk | Make money while learning';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

    <section id="yl-about" class="yl-about-section">
        <div class="container">
            <div class="yl-about-content">
                <div class="row">

                    <div class="col-lg-6">
                    <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="yl-section-title yl-headline">
                            <span>About Us</span>
                        </div>
                        <div class="yl-about-text pera-content">
                            <p> {{ env('APP_NAME') }} is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge base and interest. The system was design to connect students with skill teacher/tutors in different works of life. Everyone is invited be you a hairstylist, artist, or tech person as long as you have information to pass on.
                            </p>
                            <p>
                                There are laid down rules that govern the platform, and the users are expected to either learn, educate others or both.
                            </p>
                            <p>
                                The platform has a multi-level marketing system that aims at empowering the users of the platform simply by them introducing their friends, colleagues, family members or telling them about the platform and by so doing receives commission from their tuition fees.
                            </p>
                            <div class="yl-about-qoute">
                                <span>Join {{ env('APP_NAME') }} and get up to 35% direct referral commission from purchase made by ur downliners. </span>
                                <div class="yl-quote-author yl-headline">

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="yl-about-video-area position-relative wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

                            <div class="yl-video-img text-center">
                                <img src="{{ asset('front_end/img/become-a-tutor-with-centadesk.jpg') }}" alt="About {{ env('APP_NAME') }}">
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

                    <div class="col-lg-12 mt-0">
                        <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="yl-section-title yl-headline">
                                <span>Membership</span>
                            </div>
                            <div class="yl-about-text pera-content">
                                <p>Participating in {{ env('APP_NAME') }} is not free. To obtain a membership with {{ env('APP_NAME') }} you must enroll/purchase at least one course. Purchasing a course with {{ env('APP_NAME') }} automatically makes you a full member for a period of one year. Obtaining membership through course purchase opens access to earning for any kind of users both students and tutors through the multi-level marketing program.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-0">
                        <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="yl-section-title yl-headline">
                                <span>Learning</span>
                            </div>
                            <div class="yl-about-text pera-content">
                                <p>The sole purpose of {{ env('APP_NAME') }} is to create a platform where skilled persons can be linked to various persons desiring to learn such skill. The platform is very flexible and tutors and student are allowed to communicate directly. This communication can be done through any social media platform desired by the tutor we made this interaction possible since we know in must case going through a study material can be challenging and most time we need guide throughout the learning process so we believe if tutor are allowed easy communication with the student this aim will be achieved and we will have more happy student.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mt-0">
                        <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="yl-section-title yl-headline">
                                <span>Users promise</span>
                            </div>
                            <div class="yl-about-text pera-content">
                                <p><h3>100% satisfaction</h3>
                                    {{ env('APP_NAME') }} ensures that users are satisfied with the platform. The platform teams are vetting all learning contents. We assure you that you will be satisfied with every course purchased.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-0">
                        <div class="yl-about-text-area-content wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="yl-section-title yl-headline">
                                <span>Personalized customer service</span>
                            </div>
                            <div class="yl-about-text pera-content">
                                <p>We tend to be effective, efficient, fast, and reliable when it comes to assisting users. We strive to create a long-term business partnership.<br> Visit help and support for more information.<br>
                                If you are not satisfied, we will listen and make things right when we can.<br>
                                    Please visit our <a href="faq">FAQ</a> section.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    @include('include.footer')


    @include('include.e_script')
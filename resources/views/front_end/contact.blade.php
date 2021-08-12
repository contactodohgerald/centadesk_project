@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Contact Us | Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="contact-content" class="contact-content-section">
       <div class="container">
           <div class="yl-section-title text-center yl-headline yl-title-style-two position-relative">
               <p class="title-watermark">Contact Us</p>
               <span>Get In-touch</span>
               <h2>We are always available 24/7</h2>
           </div>
           <div class="yl-contact-content-wrap">
               <div class="row justify-content-center">
                   <div class="col-lg-4 col-md-6">
                       <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                               <img src="{{ asset('front_end/assets/img/cct-icon1.png')}}" alt="{{ env('APP_NAME') }} logo">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                               <h3>Address</h3>
                               <span>
                                {{$appSettings->company_address}}
                              </span>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                               <img src="{{ asset('front_end/assets/img/cct-icon2.png')}}" alt="{{ env('APP_NAME') }} logo">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                               <h3>Email Us</h3>
                               <span>{{$appSettings->company_email_1}}</span>
                               <span>{{$appSettings->company_email_2}}</span>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-6">
                       <div class="yl-contact-content-inner text-center">
                           <div class="yl-contact-content-icon">
                               <img src="{{ asset('front_end/assets/img/cct-icon3.png')}}" alt="{{ env('APP_NAME') }} logo">
                           </div>
                           <div class="yl-contact-content-text yl-headline">
                               <h3>Phone No</h3>
                               <span>{{$appSettings->company_phone_1}}</span>
                               <span>{{$appSettings->whatsApp_phone}}</span>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="yl-contact-form-wrap yl-headline">
               <h3>Write us a message</h3>
               <form class="yl-contact-form-area" action="{{route('contact-mail')}}" method="post">
                    @csrf
                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <i class="fa fa-envelope-o mr-2"></i>
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @elseif(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <i class="fa fa-envelope-o mr-2"></i>
                            {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                   <div class="yl-contact-form-input d-flex">
                       <input type="text" name="full_name" required placeholder="Your Name*">
                       <input type="email" name="email" required placeholder="Your email*">
                       <input type="text" name="phone" required placeholder="Phone">
                       <input type="text" name="subject" required placeholder="Subject">
                   </div>
                   <textarea name="message" required placeholder="Write your message here*"></textarea>
                   <button type="submit">Submit Now <i class="fas fa-arrow-right"></i></button>
               </form>
           </div>
       </div>
   </section>

   @include('include.footer')


   @include('include.e_script')
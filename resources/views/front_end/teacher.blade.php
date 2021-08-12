@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Become a teacher | Choose course categories. Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="yl-slider" class="yl-slider-section pt-5 pb-5 mt-3">
       <div class="container">
       <div class="row">
           <div class="col-lg-8">
               <div class="yl-section-title yl-headline">
                   <h2>{{ env('APP_NAME') }} - Become a tutor </h2>
               </div>
           </div>
       </div>
       <div class="yl-department-content">
           <div class="row">
           <div class="col-lg-3">
               <img src="{{ asset('front_end/img/become-a-tutor-at-centadesk.jpg') }}" alt="{{ env('APP_NAME') }} affiliate business">
           </div>
           <div class="col-lg-9">
           <p>
               Make extra cash teaching at {{ env('APP_NAME') }}. We made the process simple and short. Create an online video course and earn money by teaching people around the world following this simple steps. <br>

               <p><b>1. Plan your course material</b><br>
                   Think of what you are good at teaching, organise your material.
               </p>

               <p><b>2. Record a video</b><br>
                   Create a professional video where you are teaching
               </p>

               <p><b>3. Build community</b><br>
                   Invite friends and family to subscribe to your courses and make real money.
               </p>

           </p>
           </div>
           </div>
       </div>
       </div>
   </section>

   @include('include.footer')
        
   @include('include.e_script')
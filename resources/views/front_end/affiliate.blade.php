@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Affiliate | Choose course categories. Make money while learning, teaching';
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
                   <h2>{{ env('APP_NAME') }} - Affiliate Business </h2>
               </div>
           </div>
       </div>
       <div class="yl-department-content">
           <div class="row">
           <div class="col-lg-3">
               <img src="{{ asset('front_end/img/affiliate-business.jpg') }}" alt="{{ env('APP_NAME') }} affiliate business">
           </div>
           <div class="col-lg-9">
           <p>
               Make more money with {{ env('APP_NAME') }} when you tell your friends and family about us. We have carefully structured our affiliate program in such a way you can earn in multi-levels with little effort at the comfort of your home.</p>
           <p>
               <h3>The Affiliate - </h3>
           An affiliate shares his/her referral link with friends and family to register on the platform and get paid for every successful registration. This feature is open to anybody registered on the platform and has enrolled for at least one course. Once a person registers and enrolls, the affiliate program will be enabled on his dashboard, and he can start inviting his friends to join.
           <br>
           The affiliate user gets a bonus for each direct referral he/she makes. The affiliate system also has a multi-level system which is up to the 20th generation. This implies that he/she must get paid when his/her downline refers a person. This is also extended to the 20th generation and therefore generating a passive income to the affiliates. Each of this generation has a particular percentage the user get as listed below.<br>

           <b>Earning:</b><br>
           1st = Direct referral 10%<br>
           2nd = 5%<br>
           3rd = 3%<br>
           4th = 2.6%<br>
           5th = 2.4%<br>
           6th = 2.2%<br>
           7th = 2%<br>
           8th = 1.8%<br>
           9th = 1.6%<br>
           10th = 1.4%<br>
           11th = 1.2%<br>
           12th = 1%<br>
           13th = 0.9%<br>
           14th = 0.8%<br>
           15th = 0.7%<br>
           16th = 0.6%<br>
           17th = 0.5%<br>
           18th = 0.4%<br>
           19th = 0.3%<br>
           20th = 0.2%<br>
           Total Payable Commissions = 48.7%

           </p>
           </div>
           </div>
       </div>
       </div>
   </section>

   @include('include.footer')
        
   @include('include.e_script')
@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Career | Choose course categories. Make money while learning, teaching';
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
                   <h2>Career - {{ env('APP_NAME') }}</h2>
               </div>
           </div>
       </div>
       <div class="yl-department-content">
           <div class="row">
               <div class="col-lg-3">
                   <img src="{{ asset('front_end/img/career-with-centadesk.jpg') }}" alt="career with {{ env('APP_NAME') }}">
               </div>
           <div class="col-lg-9">
           <p>Start a career today with {{ env('APP_NAME') }} and have the chance to explore all our earnings potential. With {{ env('APP_NAME') }} you are sure of passive income as long as you play your part well and you can work from anywhere around the world. {{ env('APP_NAME') }} have make available various ways in which users of the platform can make earnings regardless of their membership category. Below are our various openings:</p>
           <p><h3><u>Student Affiliate</u></h3>
               A student member is a person that joined the platform with the mindset to learn or making money using the system. Once payment is made, the student will have access to the affiliate feature. He or she may wish to participate or not in the affiliate business. Still, if he or she decides to participate, the benefits associated with the affiliate business will be entitled to him or her. One can choose to start a career here by working as an affiliate member thereby getting commission for every successful convert.
           </p>
           <p><h3><u>Teacher</u></h3>
               Interested people may wish to list their courses on the platform and get a commission every time users enroll for their courses. A teacher during registration will signify that he or she is a teacher or instructor and after registration is done, he or she will be given an extra feature on his dashboard where he or she can list his/her courses.<br>
               Courses uploaded on the platform belongs to the teacher but will be treated as though owned by the platform. Each time a student join the platform and obtain a membership license by purchasing/subscribing to a teachers course certain percentage will be remitted to the teacher while certain percent goes to the platform and the rest goes back to the systems multi-level program.<br>
               The platform will notify the teacher or instructor each time a student registers for his/her course, and he/she is expected to do a follow-up on the student.<br>
               The platform will vet the teacher’s learning content before they are granted access to be visible on the platform. The teacher can also decide to join the affiliate program by enrolling in a course as membership depends on that.<br><br>

               The teacher will be earning in two ways, which are:<br>
               1.	As an affiliate member when they have to unlock the feature by enrolling in a particular course. Once this is done, the teacher or instructor will have full access to the affiliate package and all benefits as entitled to the affiliate program.<br>

               2.	He or she can earn on the platform if their listed course is enrolled by a student. A teacher get 10% of the subscription fee each time a student gain membership through their course.
           </p>
           <p>
           <h3><u>Agents</u></h3>
               The agent’s member has four stages as the user progress in the platform. To qualify as an agent, the individual ought to have a certain number of direct referrals to unlock this opportunity. The agent, just like every other user, can join the platform either as a student or teacher, and his or her activities will determine if he or she will get to the level of an agent.
               It is important to note that when a teacher becomes an agent, their role as a teacher will still be active.
           </p>
           </div>
           </div>
       </div>
       </div>
   </section>

   @include('include.footer')
        
   @include('include.e_script')
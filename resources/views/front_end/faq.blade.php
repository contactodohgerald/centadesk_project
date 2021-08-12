@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Frequently Asked Questions | Make money while learning';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="faq-main" class="faq-main-section">
       <div class="container">
           <div class="faq-main-content">
               <div class="yl-faq-tab-btn ul-li">
                   <h3>Frequently Asked Questions</h3>
               </div>
               <div class="yl-faq-tab-wrapper">
                   <div id="tabsContent" class="tab-content">
                       <div id="admission" class="tab-pane fade active show">
                           <div class="yl-faq-content-area">
                               <div class="row">
                                   <div class="col-lg-12">
                                       <div class="yl-faq-que-ans">
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>1.	What technical skills does the student require?</h3>
                                               <p>{{ env('APP_NAME') }} is designed to be user-friendly. The necessary skills needed are computer skills to access the programs, including using a keyboard, using the Internet, etc. Most online programs require such on their websites. However, users who do not meet this requirement can be guided.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>2.   Who can benefit from this platform?</h3>
                                               <p>This program is designed to meet various users' needs depending on their professional and educational needs. Examples of users who can benefit from this platform include:<br>
                                                   • Students<br>
                                                   • Teachers/instructors<br>
                                                   • Agents<br>
                                               </p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>3. How do students and teachers interact in an online course?</h3>
                                               <p>The teacher or instructor will be notified when a student enrolls in his/her course. They are required to follow-up on the student and adding them to their WhatsApp or telegram community so that he/she can train the student via sharing his/her learning materials with the student and doing a follow-up to ensure the student gets what he/she wants. Also the course material download links are also available on the platform and students are giving access to communicate directly with the instructors on the platform using the comment section.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>4. What is the duration of membership?</h3>
                                               <p>The membership license of each user is of a 12 months duration; that is, after every one year, the user is to pay a certain amount by simply enrolling in fresh courses, and this will give him or her access to the system benefit for another one year and so on.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>5. Will I make money doing this?</h3>
                                               <p>Yes, you will. All you have to do is purchase a course and start referring people; you will be paid a commission from the tuition fee.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>6. How do I sign up?</h3>
                                               <p> • Create an account using the sign-up bottom<br>
                                                   • Select if you are a teacher or student<br>
                                                   • Fill in the necessary information and submit<br>
                                                   • We will send a confirmation mail to you<br>
                                                   • Confirm and log in to get started<br>
                                                   • Enroll for a course and get a 1 year membership license to earn passive income
                                               </p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>7. How do I make payment?</h3>
                                               <p>Visit a course and click on the buy button to make a purchase; you will be redirected to make payment via payment gateway. Make payment and start receiving your course.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>8. Are students mandated to attend classes at a specific time?</h3>
                                               <p>We offer flexibility for students. Students participate in discussions through WhatsApp, telegram community. It’s useful as taking a physical class.<br>
                                               The instructor can also determine the timing, and he/she is to act conveniently for the students.
                                               </p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>9. Do you offer a free course?</h3>
                                               <p>No, we do not offer free courses. But on special occasions we might choose to make some courses free for our users.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>10. As a teacher, am I to pay to join the platform?</h3>
                                               <p>Yes, you must pay to join the system as your membership to the platform is active only when you subscribe to a course.</p>
                                           </div>
                                           <div class="yl-faq-que-ans-content yl-headline pera-content">
                                               <h3>11. When can I withdraw my commission?</h3>
                                               <p>Affiliate Commissions/Earnings are paid ones a month basically towards the end of every month.</p>
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
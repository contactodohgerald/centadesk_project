@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Categories | Choose course categories. Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section style="border-bottom: solid 1px black;" id="yl-category-2" class="yl-category-section-2 pt-3 mt-3 pb-4">
       <div class="container">
           <div class="yl-section-title text-center yl-headline yl-title-style-two position-relative">
               <form enctype="multipart/form-data" method="post">
                   <div class="input-group">
                       <input class="form-control" type="text" placeholder="Search anything here">
                       <button class="btn btn-default"><i class="fa fa-search"></i></button>
                   </div>
               </form>
           </div>
       </div>
   </section>

   <section id="yl-category-2" class="yl-category-section-2 pt-3 mt-3">
       <div class="container">
           <div class="yl-section-title text-center yl-headline yl-title-style-two position-relative">
               <p class="title-watermark">Categories</p>
               <h3><span class="text-black-50">Top Categories</span></h3>
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
                        <div class="alert alert-success text-center">No categories is available at this moment</div>
                    </div>
                @endif
               </div>
           </div>
       </div>
   </section>

   @include('include.footer')
        
   
   @include('include.e_script')
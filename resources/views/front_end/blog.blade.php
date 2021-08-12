@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Blog Post | Make money while learning';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="yl-blog-feed" class="yl-blog-feed-section">
       <div class="container">
           <div class="blog-feed-content-wrap">
               <div class="row justify-content-center">
                @if(count($blogs) > 0)
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
                                        <h3><a href="{{route('blog-details', $each_blog->unique_id )}}">{{substr(ucfirst($each_blog->blog_title), 0, 40)}} {{ (strlen($each_blog->blog_title) > 40 )?'...':''}}</a>
                                        </h3>
                                        @php $taglessBody = strip_tags($each_blog->blog_message); @endphp
                                        <p>{{substr($taglessBody, 0, 120)}}  {{ (strlen($taglessBody) > 120 )?'...':''}} </p>
                                        <a class="yl-blog-more text-uppercase" href="{{route('blog-details', $each_blog->unique_id )}}">View more <span>+</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-success text-center">No Blog Post is Available at this time, Please check back at a later time</div>
                    </div>
                @endif
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
           </div>
       </div>
   </section>

   @include('include.footer')
        
   
   @include('include.e_script')
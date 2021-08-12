@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Blog Details | Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="yl-blog-details" class="yl-blog-details-section bg-white">
       <div class="container">
           <div class="row">
               <div class="col-lg-9">
                   <div class="yl-blog-details-content">
                       <div class="yl-blog-details-wrap">
                           <div class="yl-blog-details-thumb">
                               <img src="{{asset('storage/blog_image/'.$blog_post->blog_image)}}" alt="{{env('APP_NAME')}}">
                           </div>
                           <div class="yl-blog-details-text yl-headline">
                               <div class="yl-blog-meta-2 text-uppercase">
                                   <a href="javascript:;">BY {{ ucfirst($blog_post->users->name) }} {{ ucfirst($blog_post->users->last_name) }}</a>
                                   <a href="javascript:;">{{$blog_post->created_at->diffForHumans()}}</a>
                                   <a href="javascript:;">{{ count($blog_post->blogComments) }} comments</a>
                               </div>
                               <article>
                                   {!! $blog_post->blog_message !!}
                               </article>                              
                               <div class="yl-post-cat-share clearfix">
                                    @if(count($blog_post->blog_post_tag) > 0)
                                        <div class="yl-post-cat-wrap float-left">
                                            @foreach($blog_post->blog_post_tag as $message)
                                                <a href="javascript:;">{{$message->tag_name}}</a>
                                            @endforeach
                                        </div>
                                   @endif
                                   <div class="yl-blog-list-share float-right">
                                       <span class="blog-share-slug text-uppercase">Share</span>
                                       <a href="#"><i class="fab fa-facebook-f"></i></a>
                                       <a href="#"><i class="fab fa-twitter"></i></a>
                                       <a href="#"><i class="fab fa-behance"></i></a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <hr>
                   <div class="course-details-tab-area">
                        <div class="cd-course-review-wrap clearfix">
                            <h3 class="c-overview-title">{{count($blog_post->blogComments)}} Comments</h3>
                            @if(count($blog_post->blogComments) > 0)
                                <div class="cd-course-user-comment">
                                    @foreach($blog_post->blogComments as $hp => $each_blog_comment)
                                        <div class="cd-course-review-comment clearfix">
                                            <div class="cd-course-review-text yl-headline pera-content ul-li">
                                                <div class="cd-course-review-author-rattting clearfix">
                                                    <div class="cd-course-review-author float-left">
                                                        <h3>{{ucfirst($each_blog_comment->user_name)}}</h3>
                                                        <span>{{$each_blog_comment->created_at->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                                <p>{{$each_blog_comment->message}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-success text-center">Course review isn't available at this time</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="cd-review-form">
                            <h3 class="c-overview-title">Leave a Reply</h3>
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
                            <form action="{{route('blog-comment', $blog_post->unique_id)}}" method="post">
                                @csrf
                                <div class="cd-comment-input d-flex">
                                    <div class="cd-comment-input-field">
                                        <input type="text" name="name" required placeholder="Your name *">
                                    </div>
                                    <div class="cd-comment-input-field">
                                        <input type="email" name="email" required placeholder="Your Email *">
                                    </div>
                                </div>
                                <textarea name="message" required placeholder="Your Message..."></textarea>
                                <button type="submit">Submit <i class="fas fa-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
               </div>

               <div class="col-lg-3">
                   <div class="yl-blog-sidebar">
                       <div class="yl-blog-widget-wrap">
                           <div class="yl-search-widget position-relative">
                               <form action="{{ route('search') }}" method="post">
                                    @csrf
                                   <input type="text" name="seach_query"  placeholder="Search" required>
                                   <button type="submit"><i class="fas fa-search"></i></button>
                               </form>
                           </div>
                       </div>
                       <div class="yl-blog-widget-wrap">
                           <div class="yl-category-widget yl-headline ul-li-block position-relative">
                               <h3 class="widget-title">Category</h3>
                               @if(count($course_category_model) > 0)
                                <ul>
                                    @foreach ($course_category_model as $hn => $each_course_category_model)
                                        @if($hn == 15)
                                            @break
                                        @endif
                                        <li><a href="{{ route('course-list', $each_course_category_model->unique_id) }}">{{ ucfirst($each_course_category_model->name) }}</a></li>
                                    @endforeach
                                </ul>
                               @else
                               <div class="row">
                                   <div class="col-lg-12">
                                       <div class="alert alert-success text-center">No Course Category is available at this time</div>
                                   </div>
                               </div>
                               @endif
                           </div>
                       </div>
                       <div class="yl-blog-widget-wrap">
                           <div class="yl-recent-blog-widget clearfix">
                               <h3 class="widget-title">Recent Posts</h3>
                               @if(count($recentPosts) > 0)
                                @foreach($recentPosts as $r => $each_recent_post)
                                    @if($r == 10)
                                        @break
                                    @endif
                                    <div class="yl-recent-blog-img-text">
                                        <div class="yl-recent-blog-img float-left">
                                            <img src="{{asset('storage/blog_image/'.$each_recent_post->blog_image)}}" alt="{{env('APP_NAME')}}">
                                        </div>
                                        <div class="yl-recent-blog-text">
                                            <span>{{$each_recent_post->created_at->diffForHumans()}}</span>
                                            <h3><a href="{{route('blog-details', $each_recent_post->unique_id )}}">{{substr(ucfirst($each_recent_post->blog_title), 0, 40)}} {{ (strlen($each_recent_post->blog_title) > 40 )?'...':''}}</a></h3>
                                        </div>
                                    </div>
                                @endforeach
                               @else
                               <div class="alert alert-success text-center">No Blog Post is Available at this time, Please check back at a later time</div>
                           @endif
                           </div>
                       </div>

                   </div>
               </div>
           </div>
       </div>
   </section>

   @include('include.footer')
        
   
   @include('include.e_script')
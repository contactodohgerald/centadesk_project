@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Gallery Centadesk | Make money while learning';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

    <section id="yl-photo-gallery" class="yl-course-section pt-5">
       <div class="container">
           <div class="yl-photo-gallery-area">

               <div class="filtr-container-area grid clearfix" data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
                   <div class="grid-sizer"></div>

                   @if (count($galleryModel) > 0)
                   @foreach ($galleryModel as $each_gallery)
                    <div class="grid-item grid-size-33 {{ $each_gallery->gallery_title }}" data-category="{{ $each_gallery->gallery_title }}">
                        <div class="photo-gallery-innerbox">
                            <a class="yl-photo-popup" data-lightbox="roadtrip" href="{{asset('storage/gallery_image/'.$each_gallery->gallery_image)}}"></a>
                            <div class="photo-gallery-img-item position-relative">
                                <img src="{{asset('storage/gallery_image/'.$each_gallery->gallery_image)}}" alt="{{ $each_gallery->gallery_title }}">
                            </div>
                        </div>
                    </div>                       
                   @endforeach
                   @else
                    <div class="col-lg-12">
                        <div class="alert alert-success text-center">No gallery is available at this moment</div>
                    </div>
                   @endif
                  
               </div>
           </div>

           <div class="yl-course-pagination clearfix text-center ul-li mt-5">
               <ul>
                   <li>
                    <a href="{{$galleryModel->nextPageUrl()}}">Nxt</a>
                    <a href="#">{{$galleryModel->currentPage()}}</a>
                    <a href="{{$galleryModel->previousPageUrl()}}">Prv</a>
                   </li>
               </ul>
           </div>

       </div>
   </section>

@include('include.footer')
        
@include('include.e_script')
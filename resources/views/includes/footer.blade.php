@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
<footer class="footer_three">
    <div class="footer-top bg-dark3 pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="widget">
                        <h4 class="footer-title">About</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <p class="text-capitalize mb-20">{{env('APP_NAME')}} is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life. Everyone is invited be you a hairstylist, artist, or tech person as long as you can transfer your knowledge to another person using the platform.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Contact Info</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <ul class="list list-unstyled mb-30">
                            <li> <i class="fa fa-map-marker"></i>{{$site_logo->company_address}}</li>
                            <li> <i class="fa fa-phone"></i> <span>{{$site_logo->company_phone_1}} </span><br><span>{{$site_logo->whatsApp_phone}} </span></li>
                            <li> <i class="fa fa-envelope"></i> <span>{{$site_logo->company_email_1}}</span><br><span>{{$site_logo->company_email_2}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="widget">
                        <h4 class="footer-title mt-20">Newsletter</h4>
                        <hr class="bg-primary mb-4 mt-0 d-inline-block mx-auto w-60">
                        <div class="mb-20">
                            <form class="" action="#" method="post">
                                <div class="input-group">
                                    <input name="email" required="required" class="form-control" placeholder="Your Email Address" type="email">
                                    <div class="input-group-append">
                                        <button name="submit" value="Submit" type="submit" class="btn btn-primary"> <i class="fa fa-envelope"></i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="by-1 bg-dark3 py-10 border-dark">
        <div class="container">
            <div class="text-center footer-links">
                <a href="/" class="btn btn-link">Home</a>
                <a href="{{route('about')}}" class="btn btn-link">About Us</a>
                <a href="{{route('faq')}}" class="btn btn-link">FAQs</a>
                <a href="{{route('blog')}}" class="btn btn-link">Blog</a>
                <a href="{{route('contact')}}" class="btn btn-link">Contact Us</a>
                <a href="{{route('privacy-policy')}}" class="btn btn-link">Privacy Policy</a>
                <a href="{{route('terms-of-use')}}" class="btn btn-link">Terms Of Use</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-dark3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-md-left text-center"> © @php $d = date('Y'); print @$d; @endphp <span class="text-white">{{env('APP_NAME')}}</span>  All Rights Reserved.</div>
                <div class="col-md-6 mt-md-0 mt-20">
                    <div class="social-icons">
                        <ul class="list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
                            <li><a href="https://facebook.com/{{ $site_logo->facebook_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/{{ $site_logo->twitter_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://instagram.com/{{ $site_logo->instagram_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/{{ $site_logo->youtube_url }}" class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

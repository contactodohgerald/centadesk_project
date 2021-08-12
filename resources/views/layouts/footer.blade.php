@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
<footer class="footer mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_bottm">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="fotb_left">
                                <li>
                                    <a href="/">
                                        <div class="footer_logo">
                                            <img src="{{asset('dashboard/images/fav.png')}}" alt="{{env('APP_NAME')}}">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <p>© @php $d=date('Y'); print $d;@endphp <strong>{{env('APP_NAME', 'CENTADESK')}}</strong>. All Rights Reserved.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="edu_social_links">
                                <a target="_blank" href="{{ $site_logo->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                                <a target="_blank" href="{{ $site_logo->twitter_url }}"><i class="fab fa-twitter"></i></a>
                                <a target="_blank" href="{{ $site_logo->instagram_url }}"><i class="fab fa-instagram"></i></a>
                                <a target="_blank" href="{{ $site_logo->youtube_url }}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</footer>

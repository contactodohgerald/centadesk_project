@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
@php $pageTitle = 'Reset Password Area'; @endphp
<!DOCTYPE html>
<html lang="en">

@include('layouts.head_auth')

<body>
<!-- Signup Start -->
<div class="sign_in_up_bg">
    <div class="container">
        <div class="row justify-content-lg-center justify-content-md-center">
            <div class="col-lg-12">
                <div class="main_logo25" id="logo">
                    <a href="/">
                        <img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
                    </a>
                    <a href="/">
                        <img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-md-8">
                <div class="sign_form">
                    <h2>Reset Password</h2>
                    <p class="text-center text-dark">Provide Your Token To Continue.</p>
                    @if (session('success'))
                        <p class="alert alert-success">{{session('success')}}</p>
                    @endif
                    @if (session('error'))
                        <p class="alert alert-warning">{{session('error')}}</p>
                    @endif  
                    <form method="POST" action="{{route('send-reset-code')}}">
                        @csrf

                        <div class="ui search focus mt-15 ">
                            <div class="ui left icon input swdh95 show_before_token_confirm  @php if(Request::segment(3)){ echo 'hidden'; } @endphp">
                                <input id="token_" type="text" onkeyup="verifyToken(this)" class="prompt srch_explore" name="token_" required placeholder="Enter Token">
                                <i class="uil uil-envelope icon icon2"></i>
                            </div>
                            <div class="error_displayer err_token_"></div>
                            @error('token_')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" value="{{$username}}" name="email" class="form-control mb-0" id="email_check" />

                        <div class="ui search focus mt-15  show_after_token_confirm  @php if(!Request::segment(3)){ echo 'hidden'; } @endphp">
                            <div class="ui left icon input swdh95">
                                <input id="password_" type="password" class="prompt srch_explore" name="password_" required  placeholder="New Password">
                                <i class="uil uil-key-skeleton-alt icon icon2"></i>
                            </div>
                            <div class="error_displayer err_password"></div>
                            @error('password_')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="ui search focus mt-15 show_after_token_confirm  @php if(!Request::segment(3)){ echo 'hidden'; } @endphp">
                            <div class="ui left icon input swdh95">
                                <input id="password_confirmation_" type="password" class="prompt srch_explore" name="password_confirmation_" required  placeholder="Confirm Password">
                                <i class="uil uil-key-skeleton-alt icon icon2"></i>
                            </div>
                            <div class="error_displayer err_password_confirmation"></div>
                        </div>

                        <button class="login-btn show_after_token_confirm  @php if(!Request::segment(3)){ echo 'hidden'; } @endphp" type="button" onclick="ResetPassword(this)">Submit</button>
                        
                    </form>
                    <p class="sgntrm145 show_before_token_confirm @php if(Request::segment(3)){ echo 'hidden'; } @endphp">
                        <a href="{{ route('re-send-reset-code', ['username'=>$username]) }}">Resend Password Reset Code</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer_auth')

<!-- Signup End -->

@include('layouts.e_script_auth')

<script>
    $(document).ready(function () {
        showErrors();
    });
</script>

</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:30 GMT -->
</html>

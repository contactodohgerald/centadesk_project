@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
@php $pageTitle = 'Account Activation Area'; @endphp
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
                    <h2>Account Activation</h2>
                    @if (session('success'))
                        <p class="alert alert-success">{{session('success')}}</p>
                    @endif
                    @if (session('error'))
                        <p class="alert alert-warning">{{session('error')}}</p>
                    @endif  
                    <form method="POST" action="{{route('activate_account', ['account-activation', $user_id])}}">
                        @csrf

                        <div class="ui search focus mt-15">
                            <div class="ui left icon input swdh95">
                                <input id="token" type="text" class="prompt srch_explore" name="token" required placeholder="Enter Activation Code">
                                <i class="uil uil-envelope icon icon2"></i>
                            </div>
                            @error('activation_code')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="login-btn" type="submit">Activate Account</button>
                    </form>
                    <p class="sgntrm145">
                        <a href="{{route('send_account_activation_code', [$user_id, 'account-activation'])}}">Resend Code</a>
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

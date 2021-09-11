@php
$appSettings = new \App\Model\AppSettings();
$site_logo = $appSettings->getSingleModel();
@endphp
@php $pageTitle = 'Registration Area'; @endphp
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
                            <img class="logo-inverse" src="/storage/site_logo/{{ $site_logo->site_logo }}}" alt="{{env('APP_NAME')}}">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-8">
                    <div class="sign_form">
                        @if (session('success'))
                        <p class="alert alert-success">{{session('success')}}</p>
                        @endif
                        @if (session('error'))
                        <p class="alert alert-danger">{{session('error')}}</p>
                        @endif
                        <!-- <div class="main-tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a href="#instructor-signup-tab" id="instructor-tab" class="nav-link active" data-toggle="tab">Instructor Sign Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#student-signup-tab" id="student-tab" class="nav-link" data-toggle="tab">Student Sign Up</a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="instructor-signup-tab" role="tabpanel" aria-labelledby="instructor-tab">
                                <p>Sign Up and Explore {{env('APP_NAME')}}</p>
                                <form method="POST" action="{{ route('register_user') }}">
                                    @csrf

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <select name="user_type" id="name" class="prompt srch_explore form-control">
                                                <option value="">Register as:</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="student">Student</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" id="name" required maxlength="64" placeholder="First Name">
                                            <i class="uil uil-info-circle icon icon2"></i>
                                        </div>
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" id="last_name" required maxlength="64" placeholder="Last Name">
                                            <i class="uil uil-info-circle icon icon2"></i>
                                        </div>
                                        @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" required placeholder="Email">
                                            <i class="uil uil-envelope icon icon2"></i>
                                        </div>
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input type="hidden" name="referred_id" value="{{ isset($_GET['ref']) ? $_GET['ref'] : old('referred_id') }}" id="referred_id">
                                            <input class="prompt srch_explore @error('referred_id') is-invalid @enderror" type="text" value="{{ isset($_GET['ref']) ? $_GET['ref'] : old('referred_id') }}" id="referred_id" maxlength="64" placeholder="Referrer Id (optional)" disabled>
                                            <i class="uil uil-airplay icon icon2"></i>
                                        </div>
                                        <!--@error('referred_id')-->
                                        <!--<span class="text-danger" role="alert">-->
                                        <!--    <strong>{{ $message }}</strong>-->
                                        <!--</span>-->
                                        <!--@enderror-->
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}" id="password" required placeholder="Password">
                                            <i class="uil uil-padlock icon icon2"></i>
                                        </div>
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore" type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm Password">
                                            <i class="uil uil-padlock icon icon2"></i>
                                        </div>
                                    </div>

                                    <!-- <input type="hidden" name="user_type" value="teacher"> -->

                                    <button class="login-btn" type="submit">Sign Up Now</button>
                                </form>
                            </div>
                            <!-- <div class="tab-pane fade" id="student-signup-tab" role="tabpanel" aria-labelledby="student-tab">
                                <p>Sign Up and Start Learning!</p>
                                <form method="POST" action="{{ route('register_user') }}">
                                    @csrf

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" id="name" required maxlength="64" placeholder="First Name">
                                            <i class="uil uil-info-circle icon icon2"></i>
                                        </div>
                                        @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" id="last_name" required maxlength="64" placeholder="Last Name">
                                            <i class="uil uil-info-circle icon icon2"></i>
                                        </div>
                                        @error('last_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" id="email" required placeholder="Email">
                                            <i class="uil uil-envelope icon icon2"></i>
                                        </div>
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input type="hidden" name="referred_id" value="{{ isset($_GET['ref']) ? $_GET['ref'] : old('referred_id') }}" id="referred_id">
                                            <input class="prompt srch_explore @error('referred_id') is-invalid @enderror" type="text" name="referred_id" value="{{ isset($_GET['ref']) ? $_GET['ref'] : old('referred_id') }}" id="referred_id" maxlength="64" placeholder="Referrer Id" disabled>
                                            <i class="uil uil-airplay icon icon2"></i>
                                        </div>
                                         @error('referred_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div> -->

                            <!-- <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}" id="password" required placeholder="Password">
                                            <i class="uil uil-padlock icon icon2"></i>
                                        </div>
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="ui search focus mt-15">
                                        <div class="ui left icon input swdh95">
                                            <input class="prompt srch_explore" type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm Password">
                                            <i class="uil uil-padlock icon icon2"></i>
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_type" value="student">

                                    <button class="login-btn" type="submit">Student Sign Up Now</button>
                                </form> -->
                        </div>
                    </div>
                    <p class="mb-0 mt-30">Already have an account? <a href="{{route('login')}}">Log In</a></p>
                </div>

                @include('layouts.footer_auth')

            </div>
        </div>
    </div>
    </div>
    <!-- Signup End -->

    @include('layouts.e_script_auth')

</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_up_steps.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:37 GMT -->

</html>
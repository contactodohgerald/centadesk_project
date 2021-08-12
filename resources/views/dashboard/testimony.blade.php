@php
	$pageTitle = 'Add Testimony';
	$Setting= 'active';
@endphp
@include('layouts.head')

<body>
	<!-- Header Start -->
	@include('layouts.header')
	<!-- Header End -->

	<!-- Left Sidebar Start -->
	@include('layouts.sidebar')
	<!-- Left Sidebar End -->

	<!-- Body Start -->
	<div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-check-circle"></i>Add Testimony</h2>
                    </div>
                </div>
                <div class="row justify-content-xl-center justify-content-lg-center justify-content-md-center">
                    <div class="col-xl-6 col-lg-8 col-md-8">
                        <div class="verification_content">
                            <div class="verification_form">
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
                                <h4>Add Testimony</h4>
                                    <form method="POST" action="{{route('store-testimonies')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="ui search focus mt-30 lbel25">
                                                    <label class="text-dark night-text" for="full_name">User FullName*</label>
                                                    <div class="ui left icon input swdh19">
                                                        <input required class="prompt srch_explore" id="full_name" type="text" placeholder="Enter User FullName" name="full_name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="course_des_textarea mt-30 lbel25">
                                                    <label class="text-dark night-text" for="message">Testimony Message*</label>
                                                    <div class="course_des_bg">
                                                        <div class="textarea_dt">
                                                            <div class="ui form swdh339">
                                                                <div class="field">
                                                                    <textarea rows="5" name="message" id="message" placeholder="Testimony Message" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <button class="verify_submit_btn" type="submit">Submit Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		@include('layouts.footer')

	</div>
	<!-- Body End -->

@include('layouts.e_script')

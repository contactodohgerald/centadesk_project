@php
	$pageTitle = 'KYC Verification';
	$explore= 'active';
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
                        <h2 class="st_title"><i class="uil uil-check-circle"></i>KYC Verification</h2>
                    </div>
                </div>
                <div class="row justify-content-xl-center justify-content-lg-center justify-content-md-center">
                    <div class="col-xl-6 col-lg-8 col-md-8">
                        <div class="verification_content">
                            <img src="{{asset('dashboard/images/verified-account.svg')}}" alt="">
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
                                <h4>KYC Verification</h4>
                                <div class="alert alert-success text-center">We'll send you an email upon successful verification</div>
                                    <form method="POST" action="{{route('update_cac_file')}}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="part_input mt-30 lbel25">
                                        <label class="text-dark night-text">Upload Passport* <small>(jpg, png, jpeg)</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile07" name="cac_passport" required>
                                                <label class="custom-file-label text-dark night-text" for="inputGroupFile07">No Choose</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="part_input mt-30 lbel25">
                                        <label class="text-dark night-text">Upload Document*  <small>(jpg, png, jpeg, pdf, doc)</small></label>
                                        <div class="alert alert-success text-center">Please provide a means of identification, it could be a Valid National id card, Voters Card, Diver's Licence, International Passport</div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile06" name="cac_files" required>
                                                <label class="custom-file-label text-dark night-text" for="inputGroupFile06">No Choose</label>
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

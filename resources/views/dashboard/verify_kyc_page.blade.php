@php
$pageTitle = 'KYCVerifications Area';
$KYC = 'active';
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @extends('layouts.sidebar')
    @section('content')
    <!-- Left Sidebar End -->

    @php $link = auth()->user()->returnLink() @endphp
    @php $base_url = auth()->user()->returnBaseUrl() @endphp

    <!-- Body Start -->
    <div class="wrapper _bg4586">
        <div class="_215b01">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section3125">
                            <div class="row text-right">
                                <div class="col-xl-12 col-lg-12 col-md-12 pull-right mb-5">
                                    <ul class="_215b31">
                                        <li><button class="btn_buy" onclick="verificationRequest(this, 'yes', '{{$kyc->unique_id }}')">Confirm KYC Verification</button></li>
                                        <li><button class="btn_buy" onclick="verificationRequest(this, 'no', '{{$kyc->unique_id }}')">Decline KYC Verification</button></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="strttech120">
                                        <h4>View User Passport</h4>
                                        <a href="https://docs.google.com/viewer?url={{$base_url.$link.'cac-passport/'.$kyc->passport_cac}}" target="_blank">
                                            <button class="Get_btn">View Passport</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="strttech120">
                                        <h4>View means of Identification</h4>
                                        <a href="https://docs.google.com/viewer?url={{$base_url.$link.'cac-file/'.$kyc->file_cac}}" target="_blank">
                                            <button class="Get_btn">View </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @stop
    </div>
    <!-- Body End -->
    @include('layouts.e_script')
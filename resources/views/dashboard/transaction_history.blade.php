@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp

@php $pageTitle = 'Transaction Details Area'; @endphp
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>{{env('APP_NAME', 'CENTADESK')}} - {{$pageTitle}}</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('dashboard/images/fav.png')}}">

    <!-- Stylesheets -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
    <link href='{{asset('dashboard/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
    <link href="{{asset('dashboard/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/responsive.css')}}" rel="stylesheet">

    <!-- Vendor Stylesheets -->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendor/semantic/semantic.min.css')}}">

</head>


<body>

<!-- Header Start -->
<header class="invoice_header clearfix">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="invoice_header_main">
                    <div class="invoice_header_item">
                        <div class="invoice_logo">
                            <a href="{{route('home')}}"><img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}"></a>
                        </div>
                        <p>Transaction Details</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
<!-- Body Start -->
<div class="wrapper _bg4586 _new89 p-0">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="invoice_body">
                    <div class="invoice_dts">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="invoice_title">Available Balance:</h1>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-success text-center">
                                    <h1><b>{{number_format($userDetails->balance)}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Amount ({{$userDetails->getBalanceForView()['data']['currency']}})</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{number_format($transactions->amount)}}</div></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Reference</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{$transactions->reference}}</div></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Action Type</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{$transactions->action_type}}</div></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Status</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{$transactions->status}}</div></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="vhls140">
                                    <h4>Description</h4>
                                    <ul>
                                        <li><div class="vdt-list">{{$transactions->description}}</div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice_table">
                        <div class="table-responsive-md">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td colspan="1"></td>
                                    <td colspan="3">
                                        <div class="user_dt_trans jsk1145">
                                            <p>Date Created </p>
                                            <div class="totalinv2">{{$transactions->created_at}}</div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice_footer">
                        <div class="righttfooter">
                            <a class="print_btn" href="javascript:window.print();">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body End -->

@include('layouts.e_script')
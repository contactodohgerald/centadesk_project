<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Credit Transaction</title>
    <style>

        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>
@php $pointDetails = auth()->user()->returnPointName(); @endphp
<body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<!--<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>-->
<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START CENTERED WHITE CONTAINER -->
                <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">

                                        <div style="width: 160px; margin-left: auto; margin-right: auto;">
                                            <center><img src="{{$settings->logo_url}}" style="width: 100%;"/></center>
                                        </div>
                                        <h3 style="font-family: sans-serif; font-size: 30px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">{{ucwords($settings->site_name)}}</h3>

                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <h4 style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center; color:#800080;">Successful Confirmation and Transfer of {{$pointDetails['name']}} ({{$pointDetails['symbol']}})</h4>

                                    </td>
                                </tr>

                                <tr>
                                    @php 
                                        
                                        $totalAmountRequested = auth()->user()->getAmountForView($request_object->amount);

                                        $totalPointRequested = auth()->user()->getPointValue($totalAmountRequested['data']['amount']);

                                        $totalAmountTransfered = auth()->user()->getAmountForView($request_object->total_amount_sent);

                                        $totalPoint = auth()->user()->getPointValue($totalAmountTransfered['data']['amount']);
                                    @endphp

                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi {{$user_details->name}},</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">A total of  {{$totalPoint}} {{$pointDetails['symbol']}} which is equivalent to {{$totalAmountTransfered['data']['amount']}} {{($totalAmountTransfered['data']['currency'])}} has been transffered to your wallet.</p>
                                        
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> This is due to the confirmation of {{$totalPointRequested}} {{$pointDetails['symbol']}} Request which is equivalent to {{$totalAmountRequested['data']['amount']}} {{($totalAmountRequested['data']['currency'])}} made on the {{auth()->user()->returnFriendlyDate($request_object->created_at)}}</p>
                                        <hr>

                                        @php 
                                            $walletAmountDetails = auth()->user()->getAmountForView($user_details->balance);
                                        @endphp
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><strong>Current Wallet Balance : </strong><span> {{$walletAmountDetails['data']['currency']}}  {{number_format(round($walletAmountDetails['data']['amount']))}}</span></p>

                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please Note: Current Wallet Balance can only be used to enroll into any of {{$settings->site_name}}`s Investment Package.</p>

                                        
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                            <tbody>
                                            <tr>
                                                <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="{{$settings->site_url}}" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Visit Website</a> </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please </p>-->
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks & Regards,</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div class="footer" style="clear: both; Margin-top: 10px; background: #800080; text-align: center; width: 100%;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr align="center">
                            <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                <span style="text-align: center; width: 100%;"><span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">{{$settings->address1}}</span><br>
                                <span class="apple-link" style="color: #fff; font-size: 12px; text-align: center;">{{$settings->address2}}</span></span>
                                <!--<br> Don`t like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #fff; font-size: 12px; text-align: center;">Unsubscribe</a>.-->
                            </td>
                        </tr>
                        <tr align="center">
                            <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #fff; text-align: center;">
                                <span style="text-align: center; width: 100%;">Powered by <a href="{{$settings->site_url}}" style="color: #fff; font-size: 12px; text-align: center; text-decoration: none;">{{$settings->site_name}}</a>.</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
    </tr>
</table>
</body>
</html>
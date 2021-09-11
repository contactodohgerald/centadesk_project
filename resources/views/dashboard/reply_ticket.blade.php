@php
$users = auth()->user();
$pageTitle = 'Create Ticket';
$ticket = 'active';
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
    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-comments"></i> Messages</h2>
                    </div>
                </div>
                <div class="row" id="errorHold"></div>
                <div class="row">
                    <div class="col-8">
                        <div class="all_msg_bg">
                            <div class="row no-gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="chatbox_right">
                                        <div class="chat_header">
                                            <div class="user-status">
                                                <p style="padding-left: 0px" class="user-status-title">
                                                    <span class="bold ">
                                                        <h2 style="margin-top: 0px;" class="text-center">Title: {{$messages[0]['title']}}</h2>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="user-status">
                                                <div class="user-avatar">
                                                    <img src="/storage/profile/{{ $ticket_creator->profile_image }}" alt="">
                                                </div>
                                                <p style="margin-bottom: 0px;" class="user-status-title text-capitalize"><span class="bold">{{ $ticket_creator->name }} {{ $ticket_creator->last_name }}</span></p>
                                                <p class="user-status-title">
                                                    <span style="font-size: 13px;" class="bold">{{ $ticket_creator->email }} </span>
                                                </p>
                                                {{-- <p class="user-status-tag online">Online</p> --}}
                                            </div>
                                        </div>
                                        <div class="messages-line simplebar-content-wrapper2 scrollstyle_4">

                                            <div class="mCustomScrollbar">
                                                @foreach ($messages as $e)
                                                @if ($users['unique_id'] == $e->user_id)
                                                <div class="main-message-box ta-right">
                                                    <div class="message-dt float-right">
                                                        <div class="message-inner-dt float-right">
                                                            <p>{{ $e->message }}</p>
                                                        </div>
                                                        <!--message-inner-dt end-->
                                                        <span class="chat-date text-right">{{ $e->created_at }}</span>
                                                    </div>
                                                    <!--message-dt end-->
                                                </div>
                                                <!--main-message-box end-->
                                                @else
                                                <div class="main-message-box st3">
                                                    <div class="message-dt st3">
                                                        <div class="message-inner-dt">
                                                            <p>{{ $e->message }}</p>
                                                        </div>
                                                        <!--message-inner-dt end-->
                                                        <span>{{ $e->created_at }}</span>
                                                    </div>
                                                    <!--message-dt end-->
                                                </div>
                                                <!--main-message-box end-->
                                                @endif
                                                @endforeach
                                            </div>

                                            {{-- <div class="mCustomScrollbar">
												<div class="main-message-box ta-right">
													<div class="message-dt float-right">
														<div class="message-inner-dt float-right">
															<p>Lorem ipsum </p>
														</div><!--message-inner-dt end-->
														<span class="chat-date text-right">Sat, April 10, 1:08 PM</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box st3">
													<div class="message-dt st3">
														<div class="message-inner-dt">
															<p>Lorem black dolor sit amet</p>
														</div><!--message-inner-dt end-->
														<span>2 minutes ago</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
											</div> --}}
                                        </div>
                                        <div class="message-send-area">
                                            <div class="ui form swdh30">

                                                <form class="reply_ticket_form">
                                                    @csrf
                                                    <div class="field">
                                                        <textarea rows="5" name="message" placeholder="Reply this ticket..."></textarea>
                                                        <button class="save_btn reply_ticket_btn" type="submit">Send Reply</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="table-responsive mt-30">
                            <table class="table ucp-table">
                                <thead class="thead-s">
                                    <tr>
                                        <th class="" scope="col">
                                            <h4>Previous Tickets</h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$prev_tickets->isEmpty())
                                    @foreach ($prev_tickets as $e)
                                    <tr>
                                        <td class="text-capitalize">
                                            <a href="/ticket/reply/{{ $e->unique_id}}">{{ $e->title }}</a>
                                            <p style="font-size: 14px" class="lead text-warning">{{ $e->created_at }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>No Records Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @stop
        </div>
        <!-- Body End -->

        @include('layouts.e_script')
        <script>
            $(document).ready(function() {
                // process form for creating live stream
                $('.reply_ticket_btn').click(async function(e) {
                    e.preventDefault();
                    let data = [];
                    // basic info
                    let reply_ticket = $('.reply_ticket_form').serializeArray();
                    // console.log(reply_ticket);
                    // return;

                    // append to form data object
                    let form_data = set_form_data(reply_ticket);
                    let returned = await ajaxRequest('/ticket/reply/{{ Request::segment(3) }}', form_data);
                    // console.log(returned);return;
                    validator(returned, '/ticket/reply/{{ Request::segment(3) }}');
                });
            });
        </script>
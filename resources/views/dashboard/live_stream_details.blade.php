@php
$users = auth()->user();
	$pageTitle = 'Live Stream';
	$profile = 'active';
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    @php $link = auth()->user()->returnLink() @endphp
	<!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-8 col-lg-8">
						<div class="section3125">
							{{-- <div class="live1452"> --}}
                                <div class="fcrse_3 stream-pad">

									<div class="_215b03">
										<h2 class="text-capitalize font-poppins">{{ $stream->title }}</h2>
									</div>
									<div class="_215b05 mt-2">
										<div class="_215b07">
											<span><i class='uil uil-clock'></i></span>
											{{ $stream->time_to_start }}  GMT+1
											<span class="ml-3"><i class='uil uil-calendar-alt'></i></span>
											{{ $stream->date_to_start }}
										</div>
									</div>
									<div class="_215b05 mt-2">
                                        <div class="_215b07 ">
                                            <span class="ml-1 mr-2">
                                                <b>Status :</b>
                                            </span>
                                            {{-- <span class="text-warning">
                                            </span> --}}

                                            @if ($stream->status == 'live')
                                            <span class="text-success text-capitalize">{{ $stream->status }}</span>
                                            @endif
                                            @if ($stream->status == 'pending')
                                            <span class="text-warning text-capitalize">{{ $stream->status }}</span>
                                            @endif
                                            @if ($stream->status == 'done')
                                            <span class="text-danger text-capitalize">{{ $stream->status }}</span>
                                            @endif
                                        </div>
									</div>
									<div class="_215b05 mt-2">
                                        <div class="_215b07 ">
                                            <span class="ml-1 mr-2">
                                                <b> Streaming Software :</b>
                                            </span>
                                            <span class="text-capitalize">{{ $stream->software }}</span>
                                        </div>
									</div>
									<div class="_215b05 mt-2">
                                        <div class="_215b07 ">
                                            <span class="ml-1 mr-2">

                                                    Last updated {{ $stream->updated_at }}
                                            </span>
                                        </div>
									</div>
									<div class="_215b05">
                                        <div class="_215b05 mt-2">
                                            <div class="_215b07 ">
                                                <span class="ml-1 mr-2 text-dark night-text active">

                                                        {{ $stream->description }}
                                                </span>
                                            </div>
                                        </div>
									</div>
                                </div>
							{{-- </div> --}}
							<div class="user_dt5">
								<div class="user_dt_left">
									<div class="live_user_dt">
										<div class="user_img5">
                                            <a href="{{route('view_profile', $stream->user->unique_id )}}">
                                                <img src="/storage/profile/{{ $stream->user->profile_image }}" alt="{{env('APP_NAME')}}">
                                            </a>
										</div>
										<div class="user_cntnt font-poppins">
                                            <a href="{{route('view_profile', $stream->user->unique_id )}}" class="_df7852">{{ucfirst($stream->user->name)}} {{ucfirst($stream->user->last_name)}}</a>
											<button class="subscribe-btn">Subscribe</button>
										</div>
									</div>
								</div>
								<div class="user_dt_right">
									<ul class="_215b31">
										<li>
                                            <a href="{{ $stream->meeting_url }}">
                                                <button class="btn_adcart">Join Streaming</button>
                                            </a>
                                        </li>
										{{-- <li><button class="btn_buy">Buy Now</button></li> --}}
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4">
						<div class="right_side">
                            <div class="fcrse_3">
                                <div class="cater_ttle">
                                    <h4 class="font-poppins">Live Streaming</h4>
                                </div>
                                <div class="live_text">
                                    <div class="live_icon"><i class="uil uil-kayak"></i></div>
                                    <div class="live-content">
                                        <p class="font-poppins">Set up your channel and stream live to your students</p>
                                        <button class="live_link" onclick="window.location.href = '{{ route('create_live') }}';">Get Started</button>
                                        <span class="livinfo font-poppins">Info : This feature only for 'Instructors'.</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="col-md-12">
                        <div class="section3125 mb-15 mt-50">
                            <h4 class="item_title font-poppins">Live Streams</h4>
                            <a href="/explore/live_streams" class="see150 font-poppins">See all</a>
                            <div class="la5lo1">
                                <div class="owl-carousel live_stream owl-theme">

                                    @foreach ($live_streams as $e)
                                    <div class="item">
                                        <div class="stream_1">
                                            <a href="{{ route('stream_details',['id'=>$e->unique_id]) }}" class="stream_bg">
                                                <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                                <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                                <p class="font-poppins text-capitalize over-flow">{{ $e->title }}</p>
                                                <p class="font-poppins stream_bg_p">Live<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
        @include('layouts.footer')

    </div>

    <div class="modal zoomInUp " id="delete_course_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  style="background-color: #333 !important;">
                <div class="modal-header">
                    <h4>Delete Course?</h4>
                </div>
                <form class="delete_course_form">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">By clicking continue, this course will be deleted permanently. <br> It can't be recovered after this.</p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm delete_course_btn" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Body End -->

    @include('layouts.e_script')

    <script>
        $(document).ready(function () {
            $('.delete_course_modal').click(function(e) {
                e.preventDefault();
                append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
                $('#delete_course_modal').modal('toggle');
            });


        $('.delete_course_btn').click(async function(e) {
            e.preventDefault();
            let delete_course_form = $('.delete_course_form').serializeArray();
            let form_data = set_form_data(delete_course_form);
            let returned = await ajaxRequest('/delete-course/'+delete_course_form[1].value, form_data);
            console.log(returned);
            // return;
            validator(returned, '/view-courses');
        });

        });
    </script>

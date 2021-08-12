@php
	$pageTitle = 'All Active Live Streams';
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
    @php $link = auth()->user()->returnLink() @endphp
	<!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-9 col-lg-8">
						<div class="section3125">
							<h4 class="item_title font-poppins">All Live Streams</h4>
							<div class="la5lo1">

                                {{-- @foreach ($live_streams as $e)
                                <div class="item">
                                    <div class="stream_1">
                                        <a href="{{ $e->meeting_url }}" class="stream_bg ">
                                            <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                            <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                            <p class="font-poppins text-capitalize">{{ $e->title }}</p>
                                            <p class="font-poppins">Live<span></span></p>
                                        </a>
                                    </div>
                                </div>
                                @endforeach --}}

								<div class="row">
                                    @foreach ($live_streams as $e)
									<div class="col-md-3">
										<div class="stream_1 mb-30">
                                            <a href="{{ route('stream_details',['id'=>$e->unique_id]) }}" class="stream_bg">
                                                <img src="/storage/profile/{{ $e->user->profile_image }}" alt="">
                                                <h4 class="font-poppins">{{ $e->user->name }} {{ $e->user->last_name }}</h4>
                                                <p class="font-poppins text-capitalize over-flow">{{ $e->title }}</p>
                                                <p class="font-poppins stream_bg_p">Live<span></span></p>
											</a>
										</div>
									</div>
                                    @endforeach
									{{-- <div class="col-md-3">
										<div class="stream_1 mb-30">
											<a href="live_output.html" class="stream_bg">
												<img src="images/left-imgs/img-1.jpg" alt="">
												<h4>John Doe</h4>
												<p>live<span></span></p>
											</a>
										</div>
									</div> --}}
									<div class="col-md-12">
										<div class="main-loader mt-20">
											<div class="spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4">
						<div class="right_side">
							<div class="fcrse_3">
								<div class="cater_ttle">
									<h4 class="font-poppins">Live Streaming</h4>
								</div>
								<div class="live_text">
									<div class="live_icon"><i class="uil uil-kayak"></i></div>
									<div class="live-content font-poppins">
										<p class="font-poppins">Set up your online meeting with a streaming software, and just share the link with us.</p>
										<button class="live_link" onclick="window.location.href = '/live_stream/create'">Get Started</button>
										<span class="livinfo font-poppins">PS: This feature is only for 'Instructors'.</span>
									</div>
								</div>
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

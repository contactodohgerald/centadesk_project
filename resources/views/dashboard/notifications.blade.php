@php
	$pageTitle = 'Notifications Area';
	$notifications = 'active';
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
						<h2 class="st_title"><i class="uil uil-bell"></i> Notifications <input onclick="checkAll()" type="checkbox" class="mainCheckBox"  title="Select all notifications"/></h2>
					</div>					
				</div>				
				<div class="row">
					<div class="col-12">
						
						<div class="all_msg_bg" id="all_msg_bg">

							@if (count($notification) > 0)

								@foreach ($notification as $each_notification)
									<div class="channel_my item all__noti5">
										<input type="checkbox" class="smallCheckBox" value="{{ $each_notification->unique_id }}">
										<div class="profile_link">
											<img src="{{ asset('storage/profile/'.$each_notification->users->profile_image) }}" alt="{{ env('APP_NAME') }}">
											<div class="pd_content">
												<h6>{{ $each_notification->users->name }} {{ $each_notification->users->last_name }} - {{ $each_notification->notification_type }}</h6>
												<p class="noti__text5">{{ $each_notification->notification_details }}</p>
												<span class="nm_time">{{ $each_notification->created_at->diffForHumans() }}</span>
											</div>							
										</div>							
									</div>
								@endforeach
			
							@else

								<div class="channel_my item all__noti5">
									<div class="profile_link">
										<p>NO Notification For Now</p>					
									</div>							
								</div>
								
							@endif

						</div>

					</div>
				</div>
			</div>
		</div>

		@include('layouts.footer')

	</div>

	<div style="position: fixed; bottom: 50px; right: 30px; z-index: 200" id="sendMailBtns">
		<button type="button" id="deleteNotification" class="btn btn-danger" data-action="selected"  title="Select Notification(s) to be deleted ticking the checkbox on each row and then click this button to proceed">Delete Notification(s)</button>
	</div>
   
	<!-- Body End -->

@include('layouts.e_script')


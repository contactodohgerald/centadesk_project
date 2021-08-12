@php
	$pageTitle = 'Course Price';
	$Price = 'active';
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
						<h2 class="st_title"><i class='uil uil-layers'></i> Course Price</h2>
						<div class="row">
							<div class="col-lg-8 offset-2">
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
								<form action="{{route('store_price')}}" method="POST">
									@csrf
									<div class="row  mt-5">
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="title">Title</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore" type="text" name="title" id="title" maxlength="20" required placeholder="Enter Title">
												<i class="uil uil-desert icon icon2"></i>
												<div class="form-control-counter" data-purpose="form-control-counter">20</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="amount">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore" type="number" name="amount" id="amount" required placeholder="Enter Amount In ({{auth()->user()->getBalanceForView()['data']['currency']}})">
												<i class="uil uil-money-bill icon icon2"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="divider-1"></div>
									</div>
									<div class="col-lg-12">
										<button class="save_btn" type="submit">Save Changes</button>
									</div>
								</div>
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
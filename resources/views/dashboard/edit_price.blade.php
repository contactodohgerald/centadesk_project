@php
$users = auth()->user();
$pageTitle = 'Edit Prices';
$Price = 'active';
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
						<h2 class="st_title"><i class='uil uil-layers'></i> Edit Course Price</h2>
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
								<form class="edit_price_form" method="POST">
									@csrf
									<div class="row  mt-5">
										<div class="col-lg-12">
											<div class="ui search focus mt-30">
												<label class="text-dark night-text" for="title">Title</label>
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="text" name="title" id="title" maxlength="20" required value="{{ $price->title }}" placeholder="Enter Title">
													<i class="uil uil-desert icon icon2"></i>
													<div class="form-control-counter" data-purpose="form-control-counter">20</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="ui search focus mt-30">
												<label class="text-dark night-text" for="amount">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</label>
												<div class="ui left icon input swdh11 swdh19">
													<input class="prompt srch_explore" type="number" name="amount" value="{{ $price->amount }}" id="amount" required placeholder="Enter Amount In ({{auth()->user()->getBalanceForView()['data']['currency']}})">
													<i class="uil uil-money-bill icon icon2"></i>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="divider-1"></div>
										</div>
										<div class="col-lg-12">
											<button class="save_btn edit_price_btn" type="submit">Save Changes</button>
										</div>
									</div>
								</form>
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

	<script>
		$(document).ready(function() {

			$('.edit_price_btn').click(async function(e) {
				e.preventDefault();
				// let data = [];
				// basic info
				let data = $('.edit_price_form').serializeArray();
				// console.log(basic_info); return;

				// append to form data object
				let form_data = set_form_data(data);
				let returned = await ajaxRequest('/update_price/{{ Request::segment(2) }}', form_data);
				// console.log(returned);
				// return;
				validator(returned, '/edit_price/{{ Request::segment(2) }}');
			});
		});
	</script>
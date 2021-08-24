@php
$users = auth()->user();
	$pageTitle = 'Wallet Area';
	$Wallet = 'active';
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
						<h2 class="st_title"><i class="uil uil-wallet"></i>Wallet</h2>
					</div>
					<div class="col-md-12">

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

						@if($users->privilegeChecker('view_restricted_roles'))
						<div class="row">
							<div class="col-lg-6 col-6 text-center">
								<div class="card_dash1">
									<div class="card_dash_center">
										<i class="uil uil-money-bill"></i>
										<h1><b>{{number_format($userDetails->calculateTotalAmount('top_up', 'confirmed'))}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
										<p class="font-poppins">Total Confirmed Topup Balance</p>
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-6 text-center">
								<div class="card_dash1">
									<div class="card_dash_center">
										<i class="uil uil-money-bill"></i>
										<h1><b>{{number_format($userDetails->calculateTotalAmount('withdrawal', 'pending'))}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
										<p class="font-poppins">Total Pending Withdraw Balance</p>
									</div>
								</div>
							</div>
						</div>
						@else
							<div class="card_dash1">
								<div class="card_dash_left1">
									<i class="uil uil-money-bill"></i>
									<h1><b>{{number_format($userDetails->balance)}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
								</div>
								<div class="card_dash_right1">
									<button class="create_btn_dash" onclick="bringOutModalMain('.btc_topup_modal')">TopUp with Bitcoin</button>
								</div>
								<div class="card_dash_right1 mr-2">
									<button class="create_btn_dash" onclick="bringOutModalMain('.accountTopUp')">TopUp with Flutterwave</button>
								</div>
							</div>
						@endif

					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="{{route('transactions_by_date')}}" method="post">
							@csrf
							<h5>Filter With Date</h5>
							<div class="row">
								<div class="form-group col-sm-4">
									<input type="date" class="form-control" required placeholder="Start Date" name="start_date" >
									@error('start_date')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
								<div class="form-group  col-sm-4">
									<input class="form-control" type="date" required placeholder="End Date" name="end_date" >
									@error('start_date')
									<span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
								</div>
								<div class="form-group  col-sm-4">
									<button  class="btn btn-info" type="submit">Proceed</button>
								</div>
								<hr style="color: #fff;" size="10">
							</div>
						</form>
					</div>
					<div class="col-md-12">
						<br>
						<h2 class="text-danger">Transaction(s) ({{$dates}})</h2>
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-wallet"></i>All </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-thumbs-up"></i>Confirmed </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-thumbs-down"></i>Failed </a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												<th class="text-center">
													<input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
												</th>
												@if($users->privilegeChecker('view_restricted_roles'))
												<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount ({{$userDetails->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($transaction) > 0)
												@php $count = 1; @endphp
												@foreach($transaction  as $k => $each_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center sorting_1">
															<input type="checkbox" class="smallCheckBox" value="{{$each_transaction->unique_id}}">
														</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format($each_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{($each_transaction->action_type == 'top_up')?'Top Up':$each_transaction->action_type}}</td>
														@php if($each_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
															}else if($each_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
                                    <div class="d-flex justify-content-center">
                                        {!! $transaction->links() !!}
                                    </div>
								</div>
								<div class="tab-pane fade" id="pills-upcoming-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												<th class="text-center">
													<input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
												</th>
												@if($users->privilegeChecker('view_restricted_roles'))
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount ({{$userDetails->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($successful_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($successful_transaction  as $k => $each_successful_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center sorting_1">
															<input type="checkbox" class="smallCheckBox" value="{{$each_successful_transaction->unique_id}}">
														</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_successful_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format($each_successful_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->action_type}}</td>
														@php if($each_successful_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
															}else if($each_successful_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_successful_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_successful_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_successful_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
                                    <div class="d-flex justify-content-center">
                                        {!! $successful_transaction->links() !!}
                                    </div>
								</div>
								<div class="tab-pane fade" id="pills-my-purchases" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / N</th>
												<th class="text-center">
													<input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
												</th>
												@if($users->privilegeChecker('view_restricted_roles'))
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Amount ({{$userDetails->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Date Created</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($pending_transaction) > 0)
												@php $count = 1; @endphp
												@foreach($pending_transaction  as $k => $each_pending_transaction)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center sorting_1">
															<input type="checkbox" class="smallCheckBox" value="{{$each_pending_transaction->unique_id}}">
														</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_pending_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{number_format($each_pending_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->action_type}}</td>
														@php if($each_pending_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'info';
															}else if($each_pending_transaction->status === 'pending'){
																$status = 'Pending';
																$labelColor = 'warning';
															}else if($each_pending_transaction->status === 'processing'){
																$status = 'Processing';
																$labelColor = 'warning';
															}else if($each_pending_transaction->status === 'failed'){
																$status = 'Failed';
																$labelColor = 'danger';
															}
														@endphp
														<td class="text-center">
															<button class="btn btn-{{$labelColor}}">{{$status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->created_at}}</td>
														<td class="text-center">
															<a target="_blank" href="{{route('transaction_history', $each_pending_transaction->unique_id)}}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
                                    <div class="d-flex justify-content-center">
                                        {!! $pending_transaction->links() !!}
                                    </div>
								</div>
							</div>
							<div style="position: fixed; bottom: 20px; right: 30px; z-index: 200">
								@if($users->privilegeChecker('view_restricted_roles'))
								<button type="button" class="btn btn-danger" id="comfirmTransactionBtn" title="Select Transaction(s) to be comfirm by ticking the checkbox on each row and then click this button to delete">Comfirm Transaction(s)</button>
								@endif
								<button type="button" class="btn btn-danger" id="deleteTransactionBtn" title="Select Transaction(s) to be deleted by ticking the checkbox on each row and then click this button to delete">Delete Transaction(s)</button>
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
<script>
    $(document).ready(function() {

        // process form for creating live stream
        $('.btc_topup_btn').click(async function(e) {
            e.preventDefault();
            let data = [];
            // basic info
            let btc_topup = $('.btc_topup_form').serializeArray();
            // console.log(btc_topup);
            // return;

            // append to form data object
            let form_data = set_form_data(btc_topup);
            let returned = await ajaxRequest('/top_up_btc', form_data);
            // console.log(returned.ref_id);return;
            removeModalMains('.btc_topup_modal')
            validator(returned,'/wallet/bitcoin/gateway/'+returned.ref_id);
        });

    });
</script>

@php
	$pageTitle = 'Funds Withdrawals Area';
	$Withdrawal = 'active';
	$users = auth()->user();
	$user_type = $users->user_type;
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
						<h2 class="st_title"><i class="uil uil-money-withdraw"></i>Funds Withdrawals</h2>
					</div>
					@if($users->privilegeChecker('view_withdrawal_form'))
					<div class="col-md-12">
						<div class="card_dash1">
							<div class="row">
								<div class="col-lg-4">
									<img src="{{asset('dashboard/images/used_images/withdrawal.png')}}" alt="{{env('APP_NAME')}}" class="img-thumbnail">
								</div>
								<div class="col-lg-8">
									<div class="text-center">
										<p>Available Balance</p>
										<h1><b>{{number_format($userDetails->balance)}} ({{$userDetails->getBalanceForView()['data']['currency']}})</b></h1>
									</div>
									@if(Session::has('success_message'))
										<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
											<i class="fa fa-envelope-o mr-2"></i>
											{{ Session::get('success_message') }}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
									@endif
									@if(Session::has('error_message'))
										<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
											<i class="fa fa-envelope-o mr-2"></i>
											{{ Session::get('error_message') }}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
									@endif
									
									<form action="{{route('make_withdrawal')}}" method="post">
										@csrf
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="amount">{{ __('Amount To Be Withdrawn') }} ({{auth()->user()->getBalanceForView()['data']['currency']}})</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore @error('amount') is-invalid @enderror" type="number" name="amount" id="amount" required placeholder="Enter Amount">
												<i class="uil uil-money-withdraw icon icon2"></i>

												@error('amount')
												<span class="invalid-feedback" role="alert">
												 <strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
										<button class="save_btn" type="submit">Request For Withdrawal</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="{{route('withdrawals_by_date')}}" method="post">
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
						<h4 class="text-danger">
							<b>Withdrawal(s) ({{$dates}})</b>
							@if($users->privilegeChecker('view_restricted_roles'))
							<div class="pull-right">
								<a class="btn btn-danger" onclick="makeTransferPayments(this)" href="javascript:;">Make Payment With Flutter Wave</a>
								<a class="btn btn-danger" onclick="markAsPayed(this)" href="javascript:;">Confirm Withdrawals</a>
							</div>
							@endif
						</h4>
					</div>
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>All Withdrawals</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-download-alt"></i>Pending Withdrawals</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-upload-alt"></i>Confirm Withdrawals</a>
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
												<th class="text-center" scope="col">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($users->privilegeChecker('view_restricted_roles'))
												<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
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
														<td class="text-center cell-ta">{{number_format($each_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{$each_transaction->users->bank_code}}</td>
														<td class="text-center cell-ta">{{$each_transaction->users->account_number}}</td>
														<td class="text-center cell-ta">{{$each_transaction->users->account_name}}</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{$each_transaction->action_type}}</td>
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
														<td class="text-center cell-ta">{{$each_transaction->created_at->diffForHumans()}}</td>
														<td class="text-center">
															<a href="{{ route('view-withdrawal-invoice', $each_transaction->unique_id ) }}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
												@else
													<tr>
														<td colspan="11" class="text-center ">No Records Found</td>
													</tr>
												@endif
											</tbody>
										</table>
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
												<th class="text-center" scope="col">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($users->privilegeChecker('view_restricted_roles'))
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
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
														<td class="text-center cell-ta">{{number_format($each_pending_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->users->bank_code}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->users->account_number}}</td>
														<td class="text-center cell-ta">{{$each_pending_transaction->users->account_name}}</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_pending_transaction->users->email}}</td>
														@endif
														<td class="text-center cell-ta">{{$each_pending_transaction->action_type}}</td>
														@php if($each_pending_transaction->status === 'confirmed'){
																$status = 'Confirmed';
																$labelColor = 'success';
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
														<td class="text-center cell-ta">{{$each_pending_transaction->created_at->diffForHumans()}}</td>
														<td class="text-center">
															<a href="{{ route('view-withdrawal-invoice', $each_pending_transaction->unique_id ) }}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
												@else
													<tr>
														<td colspan="11" class="text-center ">No Records Found</td>
													</tr>
											@endif
											</tbody>
										</table>
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
												<th class="text-center" scope="col">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</th>
												<th class="text-center" scope="col">Bank Name</th>
												<th class="text-center" scope="col">Account Number</th>
												<th class="text-center" scope="col">Account Name</th>
												@if($users->privilegeChecker('view_restricted_roles'))
													<th class="text-center" scope="col">Email</th>
												@endif
												<th class="text-center" scope="col">Action Type</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Withdrawal Date</th>
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
														<td class="text-center cell-ta">{{number_format($each_successful_transaction->amount)}}</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->users->bank_code}}</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->users->account_number}}</td>
														<td class="text-center cell-ta">{{$each_successful_transaction->users->account_name}}</td>
														@if($users->privilegeChecker('view_restricted_roles'))
															<td class="text-center cell-ta">{{$each_successful_transaction->users->email}}</td>
														@endif
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
														<td class="text-center cell-ta">{{$each_successful_transaction->created_at->diffForHumans()}}</td>
														<td class="text-center">
															<a href="{{ route('view-withdrawal-invoice', $each_successful_transaction->unique_id ) }}" title="View" class="gray-s"><i class="uil uil-eye"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
												@else
													<tr>
														<td colspan="11" class="text-center ">No Records Found</td>
													</tr>
											@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div style="position: fixed; bottom: 20px; right: 30px; z-index: 200">
								<button type="button" class="btn btn-danger" id="deleteWithdrawBtn" title="Select Withdraw(s) to be deleted by ticking the checkbox on each row and then click this button to delete">Delete Withdraw(s)</button>
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

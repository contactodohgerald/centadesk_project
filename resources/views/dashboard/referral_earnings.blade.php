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

					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>Referal Earnings/Downlines</a>
								</li>
								{{-- <li class="nav-item">
									<a class="nav-link" id="pills-my-purchases-tab" data-toggle="pill" href="#pills-my-purchases" role="tab" aria-controls="pills-my-purchases" aria-selected="false"><i class="uil uil-download-alt"></i>Pending Withdrawals</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-upcoming-courses-tab" data-toggle="pill" href="#pills-upcoming-courses" role="tab" aria-controls="pills-upcoming-courses" aria-selected="false"><i class="uil uil-upload-alt"></i>Confirm Withdrawals</a>
								</li> --}}
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s" >
											<tr>
												<th class="text-center table_th" scope="col">S / N</th>
												<th class="text-center table_th" scope="col">Description</th>
												<th class="text-center table_th" scope="col">No of Downlines</th>
                                                <th class="text-center table_th" scope="col">Percentage Earning</th>
											</tr>
											</thead>


											<tbody>
												@if(count($referral_earnings) > 0)
												@php $count = 1; @endphp
                                                @php $countAdd = 0 @endphp
												@foreach($referral_earnings  as $k => $eachEarningArray)
													<tr class=" downline_opener" title="Click to view details" style="cursor:pointer;">
														<td class="text-center" scope="col">{{$k}}</td>
														<td class="text-center cell-ta">{{$k}} <sup>{{auth()->user()->returnSurfix($k)}}</sup> - Downlines</td>
														<td class="text-center cell-ta">{{count($eachEarningArray)}}</td>
                                                        <td class="text-center cell-ta">{{$eachEarningArray[0]->bonus_details[0]->percentage}}%</td>
													</tr>

                                                        <tr class="hidden downlines">
                                                            <td class="text-center" colspan="4" scope="col">
                                                                <table class="table ucp-table">
                                                                    <thead class="thead-s">
                                                                        <tr>
                                                                            <th class="text-center" scope="col">S / N</th>
                                                                            <th class="text-center" scope="col">Full Name</th>
                                                                            <th class="text-center" scope="col">Email</th>
                                                                            <th class="text-center" scope="col">Number of Referral Earnings From Downline</th>
                                                                            <th class="text-center" scope="col">Total Amount Spent</th>
                                                                            <th class="text-center" scope="col">Total Amount Earned By Referrer</th>
                                                                            <th class="text-center" scope="col"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        @foreach($eachEarningArray as $l => $eachDownlineArray)
                                                                        <tr>

                                                                            <td class="text-center cell-ta" scope="col">{{$countAdd}}</td>
                                                                            <td class="text-center cell-ta" scope="col">{{$eachDownlineArray->name}}</td>
                                                                            <td class="text-center cell-ta" scope="col">{{$eachDownlineArray->email}}</td>
                                                                            <td class="text-center cell-ta" scope="col">{{count($eachDownlineArray->bonus_details)}}</td>
                                                                            <td class="text-center cell-ta" scope="col">{{auth()->user()->getAmountForView($eachDownlineArray->bonus_details->sum('amount_paid'))['data']['currency']}} {{number_format($eachDownlineArray->bonus_details->sum('amount'))}} </td>
                                                                            <td class="text-center cell-ta" scope="col">{{auth()->user()->getAmountForView($eachDownlineArray->bonus_details->sum('amount'))['data']['currency']}}
                                                                            {{number_format($eachDownlineArray->bonus_details->sum('amount'))}}</td>

                                                                            <td class="text-center cell-ta" scope="col">
                                                                                <a href="{{route('referral_details', [auth()->user()->unique_id, $eachDownlineArray->unique_id])}}">Details</a>
                                                                            </td>
                                                                        </tr>
                                                                        @php $countAdd++ @endphp
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
													@php $count++ @endphp
												@endforeach
												@else
													<tr>
														<td colspan="8" class="text-center ">No Records Found</td>
													</tr>
												@endif
											</tbody>
										</table>
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
<style>
    .table_th{
        background-color:#007bff !important;
        color:white !important;
    }
</style>

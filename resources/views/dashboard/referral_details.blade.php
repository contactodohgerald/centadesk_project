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
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>Referal Earnings Details</a>
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
												<th class="text-center table_th" scope="col">Full Name of Downliner</th>
                                                <th class="text-center table_th" scope="col">Enrolled Course</th>
                                                <th class="text-center table_th" scope="col">Downline Position</th>
												<th class="text-center table_th" scope="col">Amount Spent on Course </th>
                                                <th class="text-center table_th" scope="col">Bonus </th>
                                                <th class="text-center table_th" scope="col">Bonus Pecentage</th>
                                                <th class="text-center table_th" scope="col">Date</th>
											</tr>
											</thead>


											<tbody>
												@if(count($bonuses) > 0)
												@php $count = 1; @endphp
                                                @php $countAdd = 0 @endphp
												@foreach($bonuses  as $k => $eachBonusArray)
													<tr class=" downline_opener" title="Click to view details" style="cursor:pointer;">
														<td class="text-center" scope="col">{{$count}}</td>
                                                        <td class="text-center" scope="col">{{$eachBonusArray->referred->name}}</td>
                                                        <td class="text-center" scope="col">{{$eachBonusArray->enrollment->course->name}}</td>
														<td class="text-center cell-ta">{{$eachBonusArray->downline_number}} <sup>{{auth()->user()->returnSurfix($eachBonusArray->downline_number)}}</sup> - Downline</td>
														<td class="text-center cell-ta">
                                                            {{auth()->user()->getAmountForView($eachBonusArray->amount_paid)['data']['currency']}}
                                                            {{number_format($eachBonusArray->amount_paid)}}
                                                        </td>
                                                        <td class="text-center cell-ta">
                                                            {{auth()->user()->getAmountForView($eachBonusArray->amount)['data']['currency']}}
                                                            {{number_format($eachBonusArray->amount)}}
                                                        </td>
                                                        <td class="text-center cell-ta">
                                                            {{$eachBonusArray->percentage}} %
                                                        </td>
                                                        <td class="text-center cell-ta">
                                                            {{$eachBonusArray->created_at}}
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

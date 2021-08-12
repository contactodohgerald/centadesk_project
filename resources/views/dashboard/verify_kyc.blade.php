@php
	$pageTitle = 'KYCVerifications Area';
	$KYC = 'active';
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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>List Of KYCVerifications</h2>
					</div>
				</div>
				<div class="row">
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

						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-all-complains-tab" data-toggle="pill" href="#pills-all-complains" role="tab" aria-controls="pills-all-students" aria-selected="true"><i class="uil uil-auto-flash"></i>All Pending KYCVerifications</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-all-complains" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">S / No</th>
													<th class="text-center" scope="col">Full Name</th>
													<th class="text-center" scope="col">Email</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Date</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											@if(count($kycVerification) > 0)
												@php $count = 1; @endphp
												@foreach($kycVerification  as $k => $each_kycVerification)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_kycVerification->users->name}} {{$each_kycVerification->users->last_name}}</td>
														<td class="text-center cell-ta">{{$each_kycVerification->users->email}}</td>
														<td class="text-center">
															<button class="btn btn-{{($each_kycVerification->status === 'active')?'success':'danger'}}">{{$each_kycVerification->status}}</button>
														</td>
														<td class="text-center cell-ta">{{$each_kycVerification->created_at}}</td>
														<td class="text-center">
															<a href="{{route('verify_kyc_page', $each_kycVerification->unique_id )}}"  title="View Detail" class="gray-s"><i class="uil uil-grid"></i></a>
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

@php
	$pageTitle = 'All Students Area';
	$Users = 'active';
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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>All Students</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-all-students-tab" data-toggle="pill" href="#pills-all-students" role="tab" aria-controls="pills-all-students" aria-selected="true"><i class="uil uil-user"></i>All Students</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-active-students-tab" data-toggle="pill" href="#pills-active-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-check"></i>Active Students</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-inactive-students-tab" data-toggle="pill" href="#pills-inactive-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-circle"></i>In-Active Students</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-all-students" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">S / No</th>
													<th class="text-center" scope="col">Student Name</th>
													<th class="text-center" scope="col">Student Email</th>
													<th class="text-center" scope="col">Student Balance</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											@if(count($all_students) > 0)
												@php $count = 1; @endphp
												@foreach($all_students  as $k => $each_students)
												<tr>
													<td class="text-center" scope="col">{{$count}}</td>
													<td class="text-center cell-ta">{{$each_students->name}} {{$each_students->last_name}}</td>
													<td class="text-center cell-ta">{{$each_students->email}}</td>
													<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_students->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_students->balance)['data']['currency'] }})</td>
													<td class="text-center">
														<button class="btn btn-{{($each_students->status === 'active')?'success':'primary'}}">{{$each_students->status}}</button>
													</td>
													<td class="text-center">
														<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
														<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
														<a href="#" title="Print" class="gray-s"><i class="uil uil-print"></i></a>
													</td>
												</tr>
												@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-active-students" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / No</th>
												<th class="text-center" scope="col">Student Name</th>
												<th class="text-center" scope="col">Student Email</th>
												<th class="text-center" scope="col">Student Balance</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($active_students) > 0)
												@php $count = 1; @endphp
												@foreach($active_students  as $k => $each_active_students)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_active_students->name}} {{$each_active_students->last_name}}</td>
														<td class="text-center cell-ta">{{$each_active_students->email}}</td>
														<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_active_students->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_active_students->balance)['data']['currency'] }})</td>
														<td class="text-center">
															<button class="btn btn-{{($each_active_students->status === 'active')?'success':'primary'}}">{{$each_active_students->status}}</button>
														</td>
														<td class="text-center">
															<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
															<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
															<a href="#" title="Print" class="gray-s"><i class="uil uil-print"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
											@endif
											</tbody>
										</table>
									</div>								
								</div>
								<div class="tab-pane fade" id="pills-inactive-students" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
											<tr>
												<th class="text-center" scope="col">S / No</th>
												<th class="text-center" scope="col">Student Name</th>
												<th class="text-center" scope="col">Student Email</th>
												<th class="text-center" scope="col">Student Balance</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($inactive_students) > 0)
												@php $count = 1; @endphp
												@foreach($inactive_students  as $k => $each_inactive_students)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_inactive_students->name}} {{$each_inactive_students->last_name}}</td>
														<td class="text-center cell-ta">{{$each_inactive_students->email}}</td>
														<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_inactive_students->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_inactive_students->balance)['data']['currency'] }})</td>
														<td class="text-center">
															<button class="btn btn-{{($each_inactive_students->status === 'active')?'success':'primary'}}">{{$each_inactive_students->status}}</button>
														</td>
														<td class="text-center">
															<a href="#" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
															<a href="#" title="Delete" class="gray-s"><i class="uil uil-trash-alt"></i></a>
															<a href="#" title="Print" class="gray-s"><i class="uil uil-print"></i></a>
														</td>
													</tr>
													@php $count++ @endphp
												@endforeach
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
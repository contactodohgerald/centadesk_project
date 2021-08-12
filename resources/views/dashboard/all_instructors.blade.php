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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>All Instructors</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-all-students-tab" data-toggle="pill" href="#pills-all-students" role="tab" aria-controls="pills-all-students" aria-selected="true"><i class="uil uil-user"></i>All Instructors</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-active-students-tab" data-toggle="pill" href="#pills-active-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-check"></i>Active Instructors</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-inactive-students-tab" data-toggle="pill" href="#pills-inactive-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-circle"></i>In-Active Instructors</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-all-students" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">S / No</th>
													<th class="text-center" scope="col">Instructor's Name</th>
													<th class="text-center" scope="col">Instructor's Email</th>
													<th class="text-center" scope="col">Instructor's Balance</th>
													<th class="text-center" scope="col">Status</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											@if(count($all_teacher) > 0)
												@php $count = 1; @endphp
												@foreach($all_teacher  as $k => $each_teacher)
												<tr>
													<td class="text-center" scope="col">{{$count}}</td>
													<td class="text-center cell-ta">{{$each_teacher->name}} {{$each_teacher->last_name}}</td>
													<td class="text-center cell-ta">{{$each_teacher->email}}</td>
													<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_teacher->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_teacher->balance)['data']['currency'] }})</td>
													<td class="text-center">
														<button class="btn btn-{{($each_teacher->status === 'active')?'success':'primary'}}">{{$each_teacher->status}}</button>
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
												<th class="text-center" scope="col">Instructor's Name</th>
												<th class="text-center" scope="col">Instructor's Email</th>
												<th class="text-center" scope="col">Instructor's Balance</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($active_teacher) > 0)
												@php $count = 1; @endphp
												@foreach($active_teacher  as $k => $each_active_teacher)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_active_teacher->name}} {{$each_active_teacher->last_name}}</td>
														<td class="text-center cell-ta">{{$each_active_teacher->email}}</td>
														<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_active_teacher->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_active_teacher->balance)['data']['currency'] }})</td>
														<td class="text-center">
															<button class="btn btn-{{($each_active_teacher->status === 'active')?'success':'primary'}}">{{$each_active_teacher->status}}</button>
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
												<th class="text-center" scope="col">Instructor's Name</th>
												<th class="text-center" scope="col">Instructor's Email</th>
												<th class="text-center" scope="col">Instructor's Balance</th>
												<th class="text-center" scope="col">Status</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
											@if(count($inactive_teacher) > 0)
												@php $count = 1; @endphp
												@foreach($inactive_teacher  as $k => $each_inactive_teacher)
													<tr>
														<td class="text-center" scope="col">{{$count}}</td>
														<td class="text-center cell-ta">{{$each_inactive_teacher->name}} {{$each_inactive_teacher->last_name}}</td>
														<td class="text-center cell-ta">{{$each_inactive_teacher->email}}</td>
														<td class="text-center cell-ta">{{auth()->user()->getAmountForView($each_inactive_teacher->balance)['data']['amount']}} ({{auth()->user()->getAmountForView($each_inactive_teacher->balance)['data']['currency'] }})</td>
														<td class="text-center">
															<button class="btn btn-{{($each_inactive_teacher->status === 'active')?'success':'primary'}}">{{$each_inactive_teacher->status}}</button>
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
    <div class="modal zoomInUp " id="delete_all_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4>Remove Courses?</h4>
                </div>
                <form class="verify_badge_form">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">By clicking continue, this user will recieve a verification badge! </p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm verify_badge_btn" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Body End -->
	<!-- Body End -->

@include('layouts.e_script')

<script>
    $(document).ready(function () {
        $('.verify_badge_modal').click(function(e) {
            e.preventDefault();
            append_id('verify_badge_id', '.verify_badge_form', '#verify_badge_modal', this)
            $('#verify_badge_modal').modal('toggle');
        });


    $('.verify_badge_btn').click(async function(e) {
        e.preventDefault();
        let verify_badge_form = $('.verify_badge_form').serializeArray();
        let form_data = set_form_data(verify_badge_form);
        let returned = await ajaxRequest('/delete-enroll/'+delete_enroll_form[1].value, form_data);
        // console.log(returned);
        // return;
        validator(returned, '/courses/enrolled');
    });


    $('.remove_all').click(async function (e) {
            e.preventDefault();
            let students_to_promote_batch = [];
            let csrf_form = $('.csrf').serializeArray();

            let form_check_box = $('.batch_delete');
            for (let i = 0; i < form_check_box.length; i++) {
                    students_to_promote_batch.push(form_check_box[i].value);
            }
            csrf_form.push({
                    name: "students_to_promote_batch",
                    value: students_to_promote_batch
                });

            let form_data = set_form_data(csrf_form);
            // console.log(students_to_promote_batch);return;

            let returned = await ajaxRequest('/delete-batch', form_data);
            // console.log(response);return;
            validator(returned, '/courses/enrolled');

        });

    });
</script>

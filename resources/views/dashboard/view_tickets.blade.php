@php
	$pageTitle = 'Support Tickets';
	$Course = 'active';
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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>Support Tickets</h2>
					</div>
				</div>
                <div class="row" id="errorHold"></div>
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>All Tickets</a>
								</li>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
									<div class="table-responsive mt-30">
										<table class="table ucp-table">
											<thead class="thead-s">
												<tr>
													<th class="text-center" scope="col">Item No.</th>
													<th class="text-center" scope="col">Title</th>
													<th class="text-center" scope="col">User</th>
													{{-- <th class="text-center" scope="col">Status</th> --}}
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
                                                @if (!$tickets->isEmpty())
                                                @foreach ($tickets as $e)
												<tr>
													<td class="text-center">{{ $loop->iteration }}</td>
													<td class="text-center text-capitalize">{{ $e->title }}</td>
													<td class="text-center">{{ $e->user->name }} {{ $e->user->last_name }}</td>
													<td class="text-center">
                                                        <a href="/ticket/reply/{{ $e->unique_id}}" title="Reply Ticket" class="gray-s"><i class="uil uil-adjust"></i></a>
														<a id="{{ $e->unique_id }}" title="Delete" class="cursor-pointer gray-s delete_course_modal"><i class="uil uil-trash-alt"></i></a>
													</td>
                                                </tr>
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
            @include('layouts.footer')
        </div>
        <div class="modal zoomInUp " id="delete_course_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content"  style="background-color: #333 !important;">
                    <div class="modal-header">
                        <h4>Delete Course?</h4>
                    </div>
                    <form class="delete_course_form">
                        @csrf
                        <div class="modal-body">
                            <p class="text-danger">By clicking continue, this course will be deleted permanently. <br> It can't be recovered after this.</p>
                        </div>
                    </form>
                    <div class="modal-footer no-border">
                        <div class="text-right">
                            <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary btn-sm delete_course_btn" data-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body End -->

        @include('layouts.e_script')

        <script>
            $(document).ready(function () {
                $('.delete_course_modal').click(function(e) {
                    e.preventDefault();
                    append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
                    $('#delete_course_modal').modal('toggle');
                });


            $('.delete_course_btn').click(async function(e) {
                e.preventDefault();
                let delete_course_form = $('.delete_course_form').serializeArray();
                let form_data = set_form_data(delete_course_form);
                let returned = await ajaxRequest('/delete-course/'+delete_course_form[1].value, form_data);
                console.log(returned);
                // return;
                validator(returned, '/view-courses');
            });

            });
        </script>

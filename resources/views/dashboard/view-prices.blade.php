@php
	$users = auth()->user();
	$pageTitle = 'All Pricing';
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
						<h2 class="st_title"><i class="uil uil-book-alt"></i>All Course Pricing</h2>
					</div>
					<div class="col-md-12">
						<div class="card_dash1">
							<div class="card_dash_left1">
								<i class="uil uil-book-alt"></i>
								<h1>Jump Into Price Creation</h1>
							</div>
							<div class="card_dash_right1">
								<a href="{{route('create_price')}}">
									<button class="create_btn_dash">Create Pricing</button>
								</a>
							</div>
						</div>
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
					</div>
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>All Course Pricing</a>
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
													<th class="text-center" scope="col">Amount ({{auth()->user()->getBalanceForView()['data']['currency']}})</th>
													<th class="text-center" scope="col">Date Created</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
											@if(count($priceModel) > 0)
												@php $count = 1; @endphp
												@foreach($priceModel  as $k => $each_priceModel)
												<tr>
													<td class="text-center">{{$count}}</td>
													<td class="text-center">{{ $each_priceModel->title }}</td>
													<td class="text-center">{{number_format($each_priceModel->amount )}}</td>
													<td class="text-center">{{ $each_priceModel->created_at }}</td>
													<td class="text-center">
														<a href="{{route('edit_price', $each_priceModel->unique_id )}}" title="Edit" class="gray-s"><i class="uil uil-edit-alt"></i></a>

														<a id="{{ $each_priceModel->unique_id }}" title="Delete" class="cursor-pointer gray-s deleteCourseModal"><i class="uil uil-trash-alt"></i></a>
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

		<!-- The Modal -->
		<div class="modal delete_course_modal" id="delete_course_modal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title night-text ">Delete Pricing</h4>
						<button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.delete_course_modal')">&times;</button>
					</div>

					<form class="delete_course_form">
						@csrf
						<!-- Modal body -->
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<h4 class=" night-text">By clicking continue, this pricing will be deleted permanently. <br> Every course using this pricing will also be deleted.</h4>
								</div>
							</div>
						</div>
					</form>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button class="btn btn-danger" onclick="removeModalMains('.delete_course_modal')">Close</button>
						<button class="btn btn-primary delete_course_btn">Proceed</button>
					</div>
				</div>
			</div>
		</div>

            @include('layouts.footer')
        </div>
        <!-- Body End -->

@include('layouts.e_script')

<script>
    $(document).ready(function () {

        $('.deleteCourseModal').click(function(e) {
            e.preventDefault();
            append_id('delete_course_id', '.delete_course_form', '#delete_course_modal', this)
            bringOutModalMain('.delete_course_modal')
        });


    $('.delete_course_btn').click(async function(e) {
        e.preventDefault();
        let data = $('.delete_course_form').serializeArray();
        // console.log(data);return;
        let form_data = set_form_data(data);
        let returned = await ajaxRequest('/delete_price/'+data[1].value, form_data);
        // return;
        validator(returned, '/view_price');
    });

    });
</script>

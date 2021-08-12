@php
	$pageTitle = 'Course Category Area';
	$Categories = 'active';
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
						<h2 class="st_title"><i class='uil uil-layers'></i> Course Category</h2>
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
								<form action="{{route('update_category', $course_category->unique_id )}}" method="POST">
									@csrf
									<div class="row  mt-5">
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="name">Category Name</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore" type="text" name="name" id="name" value="{{$course_category->name}}" maxlength="30" required placeholder="Enter Category Name">
												<i class="uil uil-desert icon icon2"></i>
												<div class="form-control-counter" data-purpose="form-control-counter">30</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="category_icon">Category Icon</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore" type="text" name="category_icon" id="category_icon" required placeholder="Enter Category Icon" value="{{$course_category->category_icon}}">
												<i class="uil uil-desert icon icon2"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<label class="text-dark night-text" for="category_image">Category Image</label>
											<div class="ui left icon input swdh11 swdh19">
												<input class="prompt srch_explore" type="file" name="category_image" id="category_image">
												<i class="uil uil-desert icon icon2"></i>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="ui search focus mt-30">
											<div class="ui form swdh30">
												<div class="field">
													<label class="text-dark night-text" for="description">Description</label>
													<textarea required rows="8" name="description" id="description" placeholder="Write a little description the course category">{{$course_category->description}}</textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="divider-1"></div>
									</div>
									<div class="col-lg-12">
										<button class="save_btn" type="submit">Update Changes</button>
									</div>
								</div>
								</form>
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
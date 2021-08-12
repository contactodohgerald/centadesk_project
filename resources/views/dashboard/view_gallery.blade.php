@php
	$pageTitle = 'Gallery/Event List Area';
	$gallery = 'active';
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
						<h2 class="st_title"><i class="uil uil-money-withdraw"></i>Gallery/Event List</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<h4 class="text-danger">
							<div class="pull-right">
								<button class="btn btn-danger" id="delete_gallery">Delete Gallery/Event</button>
							</div>
						</h4>
					</div>
					<div class="col-md-12">
						<div class="my_courses_tabs">
							<ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-my-courses-tab" data-toggle="pill" href="#pills-my-courses" role="tab" aria-controls="pills-my-courses" aria-selected="true"><i class="uil uil-book-alt"></i>All Gallery/Event</a>
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
												<th class="text-center" scope="col">Title</th>
												<th class="text-center" scope="col">Image</th>
												<th class="text-center" scope="col">Created Date</th>
												<th class="text-center" scope="col">Action</th>
											</tr>
											</thead>
											<tbody>
                                                @if(count($galleryModel) > 0)
                                                    @php $count = 1; @endphp
                                                    @foreach($galleryModel as $each_gallery)
                                                        <tr>
                                                            <td class="text-center" scope="col">{{$count}}</td>
                                                            <td class="text-center sorting_1">
                                                                <input type="checkbox" class="smallCheckBox" value="{{$each_gallery->unique_id}}">
                                                            </td>
                                                            <td class="text-center cell-ta">{{$each_gallery->gallery_title}}</td>
                                                            <td class="text-center cell-ta">
                                                                <div class="img"><img src="{{asset('storage/gallery_image/'.$each_gallery->gallery_image)}}" alt="{{$each_gallery->gallery_title}}" width="50" height="50"></div>
                                                            </td>
                                                            <td class="text-center cell-ta">{{$each_gallery->created_at->diffForHumans()}}</td>
                                                            <td class="text-center">
                                                                <a href="{{asset('storage/gallery_image/'.$each_gallery->gallery_image)}}" target="_blank" title="View" class="gray-s"><i class="uil uil-adjust"></i></a>
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

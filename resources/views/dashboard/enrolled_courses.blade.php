@php
$users = auth()->user();
	$pageTitle = 'Enrolled Courses';
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

    @php $link = auth()->user()->returnLink() @endphp

	<!-- Body Start -->
	<div class="wrapper">
    <div class="sa4d25">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-4 ">
						<div class="section3125 hstry142">
							<div class="grp_titles pt-0">
								<div class="ht_title font-poppins">{{ count($enrollments)}} Enrolled Course(s)</div>
								{{-- <a href="#" class="ht_clr">Remove All</a> --}}
							</div>
							<div class="tb_145">
								<div class="wtch125">
									{{-- <span class="vdt14">{{count($courses)}} Courses</span> --}}
								</div>
                                @if (count($enrollments) > 0)
								<a href="javascript:;" class="rmv-btn font-poppins delete_all_modal"><i class='uil uil-trash-alt'></i>Remove All Enrolled Courses</a>
                                @endif

							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="_14d25 mb-20">
							<div class="row">
								<div class="col-md-12">
                                    <h3 class=" font-poppins text-capitalize">Courses i enrolled in</h3>

                                    @if(count($enrollments) > 0)
                                        @foreach($enrollments as $each_enrollment)
                                            <input type="hidden" class="batch_delete" value="{{ $each_enrollment->unique_id }}">
                                            <form action="" class="csrf">
                                                @csrf
                                            </form>
                                            <div class="fcrse_1 mt-30">
                                                <a href="{{route('view_course', $each_enrollment->enroll_course->unique_id )}}" class="hf_img">
                                                    <img src="{{asset($link.'course-img/'.$each_enrollment->enroll_course->cover_image)}}" alt="{{env('APP_NAME')}}"  height="180">
                                                    <div class="course-overlay">
                                                        <div class="crse_reviews">
                                                            <i class="uil uil-star"></i>{{$each_enrollment->enroll_course->count_review}}
                                                        </div>
                                                        <span class="play_btn1"><i class="uil uil-play"></i></span>
                                                        <div class="crse_timer font-poppins">
                                                        {{$each_enrollment->enroll_course->created_at->diffForHumans()}}
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="hs_content">
                                                    <div class="eps_dots eps_dots10 more_dropdown">
                                                        <a href="javascript:;"><i class="uil uil-ellipsis-v"></i></a>
                                                        <div class="dropdown-content">
                                                            <span id="{{ $each_enrollment->unique_id }}" class="delete_enroll_modal"><i class='uil uil-times'></i>Remove</span>
                                                        </div>
                                                    </div>
                                                    <div class="vdtodt">
                                                        <span class="vdt14">{{$each_enrollment->enroll_course->views}} views</span>
                                                        <span class="vdt14">{{$each_enrollment->enroll_course->created_at->diffForHumans()}}</span>
                                                    </div>
                                                    <input type="hidden" class="saved_course_id" value="{{$each_enrollment->enroll_course->unique_id}}">
                                                    <input type="hidden" class="user_unique_id" value="{{auth()->user()->unique_id}}">
                                                    <a href="{{route('view_course', $each_enrollment->enroll_course->unique_id )}}" class="crse14s title900 font-poppins">
                                                        <b>{{substr(ucfirst($each_enrollment->enroll_course->name), 0, 40)}} {{ (strlen($each_enrollment->enroll_course->name) > 40 )?'...':''}}</b>
                                                    </a>
                                                    <a href="{{route('view_course', $each_enrollment->enroll_course->unique_id )}}" class="crse-cate font-poppins">{{$each_enrollment->enroll_course->short_caption}}</a>
                                                    <div class="auth1lnkprce">
                                                        <p class="cr1fot">By <a href="{{route('view_profile', $each_enrollment->creator->unique_id )}}">{{$each_enrollment->creator->name}} {{$each_enrollment->creator->last_name}}</a></p>
                                                        <div class="prce142 font-poppins">{{auth()->user()->getAmountForView($each_enrollment->enroll_course->price->amount)['data']['currency'] }}  {{number_format($each_enrollment->enroll_course->price->amount)}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="fcrse_1 mt-30 text-center">
                                        <h6>
                                            You haven't enrolled for any course. Browse through our Courses, & add to your Enrolled Library.
                                        </h6>
                                    </div>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@include('layouts.footer')

	</div>
    <div class="modal zoomInUp " id="delete_enroll_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Remove Course?</h4>
                </div>
                <form class="delete_enroll_form">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">By clicking continue, You won't have access to this course you enrolled for! </p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm delete_enroll_btn" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal zoomInUp " id="delete_all_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4>Remove Courses?</h4>
                </div>
                <form class="delete_enroll_form">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">By clicking continue, You won't have access to the course(s) you enrolled for! </p>
                    </div>
                </form>
                <div class="modal-footer no-border">
                    <div class="text-right">
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary btn-sm remove_all" data-dismiss="modal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Body End -->

@include('layouts.e_script')

<script>
    $(document).ready(function () {
        $('.delete_enroll_modal').click(function(e) {
            e.preventDefault();
            append_id('delete_enroll_id', '.delete_enroll_form', '#delete_enroll_modal', this)
            $('#delete_enroll_modal').modal('toggle');
        });
        $('.delete_all_modal').click(function(e) {
            e.preventDefault();
            // append_id('delete_enroll_id', '.delete_enroll_form', '#delete_enroll_modal', this)
            $('#delete_all_modal').modal('toggle');
        });


    $('.delete_enroll_btn').click(async function(e) {
        e.preventDefault();
        let delete_enroll_form = $('.delete_enroll_form').serializeArray();
        let form_data = set_form_data(delete_enroll_form);
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

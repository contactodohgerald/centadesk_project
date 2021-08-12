@php
	$pageTitle = 'Create Blog';
	$blogs = 'active';
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
						<h2 class="st_title"><i class='uil uil-newspaper'></i> Create Blog</h2>
						<div class="row">
							<div class="col-lg-8 offset-2">
                                <div class="row  mt-5">
                                    <div class="col-lg-12">
                                        <label class="text-dark night-text" for="tags">Blog Tags</label>
                                        <select name="tags" class="ui hj145 dropdown cntry152 prompt srch_explore tags-select2" id="tags" >
                                            @if(count($blogTagModel) > 0)
                                                @foreach($blogTagModel as $gg => $each_tags)
                                                    <option value="{{$each_tags->unique_id}}">{{$each_tags->tag_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="ui search focus mt-30">
                                            <label class="text-dark night-text" for="title">Title</label>
                                            <div class="ui left icon input swdh11 swdh19">
                                                <input class="prompt srch_explore" type="text" name="title" id="title" maxlength="30" required placeholder="Enter Title">
                                                <i class="uil uil-desert icon icon2"></i>
                                                <div class="form-control-counter" data-purpose="form-control-counter">30</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="view_all_dt">
                                            <div class="view_img_left">
                                                <div id="" class="view__img ">
                                                    <img id="thumbnail_cover_img" src="{{ asset('dashboard/images/courses/add_img.jpg') }}"  alt="your image" />
                                                </div>
                                            </div>
                                            <div class="view_img_right">
                                                <h4>Blog Image</h4>
                                                <p>Upload your blog image here. It must meet our blog image quality standards to be accepted. Important guidelines: 382x382 pixels; .jpg, .jpeg,. gif, or .png.</p>
                                                <div class="upload__input">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="cover_img">
                                                            <label class="custom-file-label text-dark night-text" for="inputGroupFile04">Choose File</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="course_des_textarea mt-30 lbel25">
                                            <label class="text-dark night-text" for="message">Blog Message*</label>
                                            <div class="course_des_bg">
                                                <div class="textarea_dt">
                                                    <div class="ui form swdh339">
                                                        <div class="field">
                                                            <textarea rows="5" name="message" id="message" placeholder="Enter Message" class="message"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="divider-1"></div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button class="save_btn add-new-blog" id="add-new-blogs" type="submit">Save Changes</button>
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


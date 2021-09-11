@php
$users = auth()->user();
$pageTitle = 'Edit Course';
$Course = 'active';
$url = explode('++',$course->course_urls);
use App\Traits\Generics;
// print_r($url);die();
@endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @extends('layouts.sidebar')
    @section('content')
    <!-- Left Sidebar End -->

    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-analysis"></i> Edit Course</h2>
                    </div>
                </div>
                <div class="row" id="errorHold"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="course_tabs_1">
                            <div id="add-course-tab" class="step-app">
                                <ul class="step-steps">
                                    <li class="active">
                                        <a href="#tab_step1">
                                            <span class="number"></span>
                                            <span class="step-name">Basic Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_step2">
                                            <span class="number"></span>
                                            <span class="step-name">Description</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_step3">
                                            <span class="number"></span>
                                            <span class="step-name">Media</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab_step4">
                                            <span class="number"></span>
                                            <span class="step-name">Urls</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="step-content">
                                    <div class="step-tab-panel step-tab-info active" id="tab_step1">
                                        <form class="basic_info">
                                            @csrf
                                            <div class="tab-from-content">
                                                <div class="title-icon">
                                                    <h3 class="title"><i class="uil uil-info-circle"></i>General Information</h3>
                                                </div>
                                                <div class="course__form">
                                                    <div class="general_info10">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="ui search focus mt-30 lbel25">
                                                                    <label class="text-dark night-text">Title*</label>
                                                                    <div class="ui left icon input swdh19">
                                                                        <input class="prompt srch_explore" type="text" placeholder="Enter your course title" name="title" value="{{ $course->name }}">
                                                                        <div class="badge_num">15</div>
                                                                        <div class="err_title error_displayer"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="ui search focus mt-30 lbel25">
                                                                    <label class="text-dark night-text">Category*</label>
                                                                </div>
                                                                <select name="category" class="ui hj145 dropdown cntry152 prompt srch_explore">

                                                                    <option value="">Select</option>
                                                                    @foreach ($category as $e)
                                                                    <option @if ($e->unique_id == $course->category_id)
                                                                        selected="selected"
                                                                        @else @endif value="{{ $e->unique_id }}">{{ $e->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="ui search focus mt-30 lbel25">
                                                                    <label class="text-dark night-text">Very Short Caption*</label>
                                                                    <div class="ui left icon input swdh19">
                                                                        <input class="prompt srch_explore" type="text" placeholder="Summarize in a sentence" value="{{ $course->short_caption }}" name="caption">
                                                                        <div class="badge_num2">15</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="price_course">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="price_title">
                                                                    <h4><i class="uil uil-dollar-sign-alt"></i>Pricing</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-sm-6">
                                                                <div class="mt-30 lbel25">
                                                                    <label class="text-dark night-text">Preferred Currency</label>
                                                                </div>
                                                                <select class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                    <option value="">USD</option>
                                                                    <option value="6">INR</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <div class="mt-30 lbel25">
                                                                    <label class="text-dark night-text">Select*</label>
                                                                </div>
                                                                <select name="pricing" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                    <option value="">-- Select Pricing For Course --</option>
                                                                    @foreach ($pricing as $e)
                                                                    <option @if ($e->unique_id == $course->pricing)
                                                                        selected="selected"
                                                                        @else @endif value="{{ $e->unique_id }}">
                                                    {{ $e->title }}
                                                    </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div> --}}

                                    <div class="price_course">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="price_title">
                                                    <h4><i class="uil uil-dollar-sign-alt"></i>Pricing ({{$users->getAmountForView($e->amount)['data']['currency'] }})</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="mt-30 lbel25">
                                                    <label class="text-dark night-text">Select*</label>
                                                </div>
                                                <select name="pricing" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                    <option value="">-- Select Pricing For Course --</option>
                                                    @foreach ($pricing as $e)
                                                    <option @if ($e->unique_id == $course->pricing)
                                                        selected="selected"
                                                        @else @endif value="{{ $e->unique_id }}">
                                                        {{ $e->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="step-tab-panel step-tab-location" id="tab_step2">
                            <div class="tab-from-content">
                                <div class="title-icon">
                                    <h3 class="title"><i class="uil uil-film"></i>Course Content</h3>
                                </div>
                                <div class="course__form">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="extra_info">
                                                <h4 class="part__title">New Course Content</h4>
                                            </div>
                                            <div class="view_info10">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="course_des_textarea mt-30 lbel25">
                                                            <label class="text-dark night-text">Description*</label>
                                                            <div class="course_des_bg">
                                                                <div class="textarea_dt">
                                                                    <div class="ui form swdh339">
                                                                        <div class="field">
                                                                            <textarea rows="5" name="description" id="course_desc" placeholder="Insert your course part description">
                                                                            {{ $course->description }}
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-tab-panel step-tab-gallery" id="tab_step3">
                            <div class="tab-from-content">
                                <div class="title-icon">
                                    <h3 class="title"><i class="uil uil-image-upload"></i>View</h3>
                                </div>
                                <div class="course__form">
                                    <div class="view_info10">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img">
                                                            <img id="thumbnail_cover_img" src="/storage/course-img/{{ $course->cover_image}} " alt="">
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>Cover Photo</h4>
                                                        <p>Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>
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
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img ytube_video">
                                                            <iframe width="100%" src="https://www.youtube.com/embed/{{ $course->intro_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>Promotional Video</h4>
                                                        <p>Students who watch a well-made promo video are 5X more likely to enroll in your course. We've seen that statistic go up to 10X for exceptionally awesome videos. Put effort into making yours awesome!</p>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="text" value="https://www.youtube.com/embed/{{ $course->intro_video }}" placeholder="Youtube Url to intro video" id="cover_video">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-tab-panel step-tab-amenities" id="tab_step4">
                            <div class="tab-from-content">
                                <div class="title-icon">
                                    <h3 class="title"><i class="uil uil-file-copy-alt"></i>Extra Information</h3>
                                </div>
                                <div class="course__form">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="extra_info">
                                                <h4 class="part__title">Captions</h4>
                                            </div>
                                            <div class="view_info10">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="caption__check mt-30">
                                                            <div class="crse_content">
                                                                <form class="download_urls">
                                                                    @foreach ($url as $e)
                                                                    <div id="" class="ui-accordion ui-widget ui-helper-reset">
                                                                        <a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                                                            <div class="section-header-left">
                                                                                <span class="section-title-wrapper">

                                                                                    <div class="ui left icon input swdh19">
                                                                                        <input class="prompt srch_explore" type="text" placeholder="Enter course url" name="url" value="{{ $e }}">
                                                                                    </div>
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    @endforeach

                                                                </form>
                                                                <!-- <div id="" class="ui-accordion ui-widget ui-helper-reset">
                                                                                <a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                                                                    <div class="section-header-left">
                                                                                        <span class="section-title-wrapper">

                                                                                            <div class="ui left icon input swdh19">
                                                                                                <input class="prompt srch_explore" type="text" placeholder="Enter course url" name="url" value="">
                                                                                            </div>
                                                                                        </span>
                                                                                    </div>
                                                                                </a>
                                                                            </div> -->
                                                            </div>
                                                            <button id="add_more_url" class="btn_add mt-10 ">Add More Download Links?</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="step-footer step-tab-pager">
                            <button data-direction="prev" class="btn btn-default steps_btn">PREVIOUS</button>
                            <button data-direction="next" class="btn btn-default steps_btn">Next</button>
                            <button data-direction="finish" class="btn btn-default steps_btn edit_course_btn">Submit for Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @stop
    <!-- Body End -->

    @include('layouts.e_script')

    <script>
        $(document).ready(function() {

            tinymce.init({
                selector: 'textarea#course_desc',
                plugins: ['link preview anchor'],
                height: 400,
            });
            // create image thumbnail on select
            $('#cover_img').change(function(e) {
                e.preventDefault();
                let cover_img = $('#cover_img').prop('files')[0];
                display_img_thumbnail(this, 'thumbnail_cover_img');
            });

            // create youtube iframe when url is inputted
            $('#cover_video').focusout(function(e) {
                e.preventDefault();
                let url = $(this).val();
                let valid_url = youtube_regex(url);
                if (valid_url !== false) {
                    $('.ytube_video > *').remove();
                    let youtube_iframe = `<iframe width="100%"" src="https://www.youtube.com/embed/${valid_url}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;

                    $(youtube_iframe).appendTo('.ytube_video');
                }
                // console.log(valid_url)
            });

            $('.btn_add').click(function(e) {
                e.preventDefault();
                // console.log('man');return;
                let new_url = `<div id="" class="ui-accordion ui-widget ui-helper-reset">
                                    <a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                        <div class="section-header-left">
                                            <span class="section-title-wrapper">

                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text" placeholder="Enter course url" name="url" value="">
                                                </div>
                                            </span>
                                        </div>
                                    </a>
                                </div>`;
                $(new_url).appendTo('.download_urls');
            });


            $('.edit_course_btn').click(async function(e) {
                e.preventDefault();
                // console.log({{ Request::segment(2) }});return;
                let data = [];
                // basic info
                let basic_info = $('.basic_info').serializeArray();
                // console.log(basic_info); return;
                basic_info.forEach(e => {
                    data.push(e);
                });
                // tiny mce description
                let desc = tinymce.get("course_desc").getContent();
                data.push({
                    name: "desc",
                    value: desc
                });
                // file upload
                let cover_img = $('#cover_img').prop('files')[0];
                data.push({
                    name: "cover_img",
                    value: cover_img
                });

                let cover_video = $('#cover_video').val();
                let valid_url = youtube_regex(cover_video);
                data.push({
                    name: "cover_video",
                    value: valid_url
                });
                // download urls
                let url_array = [];
                let url = $('.download_urls').serializeArray();
                url.forEach(e => {
                    url_array.push(e.value);
                });
                let url_joined = url_array.join('++', url_array);
                data.push({
                    name: "url",
                    value: url_joined
                });

                // append to form data object
                let form_data = set_form_data(data);
                let returned = await ajaxRequest('/edit-course/{{ Request::segment(2) }}', form_data);
                console.log(returned);
                // return;
                validator(returned, '/edit-course/{{ Request::segment(2) }}');
            });
        });
    </script>
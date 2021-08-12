@php
    $pageTitle = 'Create Course';
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
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="course_tabs_1"> --}}
                        <div id="add-course-tab" class="step-app">
                            <form action="create-course" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="step-content">
                                    <div class="step-tab-panel step-tab-info active" id="tab_step1">
                                        <div class="tab-from-content">
                                            <div class="title-icon">
                                                <h3 class="title"><i class="uil uil-info-circle"></i>
                                                    Course Details </h3>
                                            </div>
                                            <div class="course__form">
                                                <div class="general_info10">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="ui search focus mt-30 lbel25">
                                                                <label>Title <span class="text-danger">*</span></label>
                                                                <div class="ui left icon input swdh19">
                                                                    <input class="prompt srch_explore" type="text" placeholder="Enter your course title" name="title" data-purpose="edit-course-title" maxlength="60" id="main[title]" value="">
                                                                    <div class="badge_num">15</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="mt-30 lbel25">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                            </div>
                                                            <select name="category" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                <option value="">Select</option>
                                                                @foreach ($category as $e)
                                                                <option value="{{ $e->unique_id }}">{{ $e->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="course_des_textarea mt-30 lbel25">
                                                                <label>Course Description*</label>
                                                                <div class="course_des_bg">
                                                                    <div class="textarea_dt">
                                                                        <div class="ui form swdh339">
                                                                            <div class="field">
                                                                                <textarea rows="5" name="description" id="id_course_description" placeholder="Insert your course description"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="price_course">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="price_title">
                                                                <h4><i class="uil uil-dollar-sign-alt"></i>Pricing</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-3 col-sm-6">
                                                            <div class="mt-30 lbel25">
                                                                <label>Preferred Currency</label>
                                                            </div>
                                                            <select class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                <option value="">USD</option>
                                                                <option value="6">INR</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="mt-30 lbel25">
                                                                <label>Select*</label>
                                                            </div>
                                                            <select class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                <option value="">-- Select Pricing For Course --</option>
                                                                @foreach ($pricing as $e)
                                                                <option value="{{ $e->unique_id }}">{{ $e->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="step-tab-panel step-tab-gallery" id="tab_step2">
                                        <div class="tab-from-content">
                                            <div class="title-icon">
                                                <h3 class="title"><i class="uil uil-image-upload"></i>
                                                    Media
                                                </h3>
                                            </div>
                                            <div class="course__form">
                                                <div class="view_info10">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="view_all_dt">
                                                                <div class="view_img_right">
                                                                    <h4>Cover Image</h4>
                                                                    <div class="upload__input">
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                                                <label class="custom-file-label" for="inputGroupFile04">No Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="view_all_dt">
                                                                <div class="view_img_right">
                                                                    <h4>Cover Image</h4>
                                                                    <div class="upload__input">
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="inputGroupFile04">
                                                                                <label class="custom-file-label" for="inputGroupFile04">No Choose file</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-40">
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-default steps_btn">Submit for Review</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="step-footer step-tab-pager">
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
    <!-- Body End -->

    @include('layouts.e_script')

@php
$pageTitle = 'Create Blog Tag';
$blogs = 'active';
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class='uil uil-newspaper'></i> Create Blog Tag</h2>
                        <div class="row">
                            <div class="col-lg-8 offset-2">
                                <div class="course__form">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="view_info10">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="caption__check mt-30">
                                                            <div class="crse_content">
                                                                <form class="download_urls">
                                                                    <div id="" class="ui-accordion ui-widget ui-helper-reset">
                                                                        <a href="javascript:void(0)" class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                                                            <div class="section-header-left">
                                                                                <span class="section-title-wrapper">
                                                                                    <span class="ui left icon input swdh19">
                                                                                        <input class="prompt srch_explore" type="text" placeholder="Enter Blog Tag" name="blog-tag">
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <button id="add_more_url" class="btn_add mt-10 ">Add More Fields?</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button class="save_btn" id="save_blog_tag" type="submit">Save Changes</button>
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

        @stop
    </div>
    <!-- Body End -->

    @include('layouts.e_script')
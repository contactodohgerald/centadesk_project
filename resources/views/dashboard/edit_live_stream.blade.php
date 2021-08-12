@php
$users = auth()->user();
$pageTitle = 'Edit Live Stream';
$live = 'active';
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
                <div class="row justify-content-md-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="section3125 stream_tabs">
                            <ul class="nav nav-tabs slive_tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="add-streaming-tab" href="" role="tab" aria-selected="true">Edit Live Stream</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="add-straming" role="tabpanel">
                                    <div class="add_stream_content">
                                        <div class="row" id="errorHold"></div>
                                        <h4 class="strm_title font-poppins">Update the details about your upcoming live stream!</h4>
                                        {{-- <div class="sf475 font-poppins">Use a live-streaming software like Zoom, and just share the link with us. </div> --}}
                                        <div class="live_form">
                                            <form class="edit_live_stream_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $live_stream->unique_id }}">
                                                <div class="group-form">
                                                    <label class="text-dark night-text">Stream Caption<span class="text-danger">*</span></label>
                                                    <input class="_dlor1" type="text" name="title" placeholder="Short caption about the theme of your stream" value="{{ $live_stream->title }}">
                                                    {{-- <button class="_6tf7s" type="submit" value="1">Copy</button> --}}
                                                </div>
                                                <div class="group-form">
                                                    <label class="text-dark night-text">Stream URL<span class="text-danger">*</span></label>
                                                    <input class="_dlor1" type="text" name="meeting_url" placeholder="Paste in the link to your live stream" value="{{ $live_stream->meeting_url }}">
                                                </div>
                                                <div class="group-form">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                    <label class="text-dark night-text">Streaming Software<span class="text-danger">*</span></label>
                                                    <input class="_dlor1" type="text" name="software" placeholder="What software will you use" value="{{ $live_stream->software }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                    <label class="text-dark night-text">Passcode</label>
                                                    <input class="_dlor1" type="text" name="passcode" placeholder="" value="{{ $live_stream->passcode }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <label class="text-dark night-text">Description<span class="text-danger">*</span></label>

                                                    <div class="ui search focus">
                                                        <div class="ui form swdh30">
                                                            <div class="field">
                                                                <textarea rows="5" name="description" placeholder="Give a short description about what the live stream is about...">{{ $live_stream->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="text-dark night-text">Status<span class="text-danger">*</span></label>
                                                            <select name="status" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                <option value="">Is your live stream currently live?</option>
                                                                <option @if ($live_stream->status == "live")
                                                                    selected="selected"
                                                                    @else @endif value="live">
                                                                    Live
                                                                </option>
                                                                <option @if ($live_stream->status == "pending")
                                                                    selected="selected"
                                                                    @else @endif value="pending">
                                                                    Pending
                                                                </option>
                                                                <option @if ($live_stream->status == "done")
                                                                    selected="selected"
                                                                    @else @endif value="done">
                                                                    Done
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-dark night-text">Privacy<span class="text-danger">*</span></label>
                                                            <select name="privacy" class="ui hj145 dropdown cntry152 prompt srch_explore">
                                                                <option value="">Is your live stream for everyone?</option>
                                                                <option @if ($live_stream->privacy == "public")
                                                                    selected="selected"
                                                                    @else @endif value="public">Public</option>
                                                                <option @if ($live_stream->privacy == "private")
                                                                    selected="selected"
                                                                    @else @endif value="private">Private</option>
                                                            </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="group-form">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="text-dark night-text">Date Scheduled<span class="text-danger">*</span> </label>
                                                            <input class="_dlor1" type="date" name="date_to_start" placeholder="Paste in the link to your live stream" value="{{ $live_stream->date_to_start }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-dark night-text">Time To Start<span class="text-danger">*</span> </label>
                                                            <input class="_dlor1" type="time" name="time_to_start" placeholder="Paste in the link to your live stream" value="{{ $live_stream->time_to_start }}">
                                                            <button class="_6tf7s" type="" value="1">GMT+1</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <button class="_145d1 edit_live_stream_btn">
                                                <i class='uil uil-video '></i>Update Stream</button>
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
        <script>
            $(document).ready(function() {
                // process form for creating live stream
                $('.edit_live_stream_btn').click(async function(e) {
                    e.preventDefault();
                    let data = [];
                    // basic info
                    let edit_live_stream = $('.edit_live_stream_form').serializeArray();
                    // console.log(edit_live_stream);
                    // return;

                    // append to form data object
                    let form_data = set_form_data(edit_live_stream);
                    let returned = await ajaxRequest('/live/edit', form_data);
                    // console.log(returned);return;
                    validator(returned, '/live_stream/edit/{{ Request::segment(3) }}');
                });

            });
        </script>

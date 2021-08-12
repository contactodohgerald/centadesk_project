<!-- Modal -->
<div class="modal fade profile-pix-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: #080E32 !important;" >
            <div class="modal-header" style="background-color: #080E32 !important;">
                <h5  class="modal-title" style="color:white !important; ">Update Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="contactForm" method="POST" action="{{route('uploadUserImage')}}" class="log-form" enctype="multipart/form-data">
                @csrf

                <div class="modal-body" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center" style="color:white !important; ">Update Image</h3>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="image">{{ __('Choose Image') }}</label>
                                        <input type="file" id="image" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror"  data-error="Your Profile Image" value="{{ old('profile_image') }}"  />
                                        @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn guoBtn">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade logoutModal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Do you really want to sign out
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn guoBtn" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
{{--
<div class="modal fade logout" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  style="background: #080E32 !important;">
            <div class="modal-header" style="background-color: #080E32 !important;">
                <h5  class="modal-title" style="color:white !important; ">Log Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center" style="color:white;">Are You Sure You Want To Logout?</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <a class="btn guoBtn" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
--}}

<!-- Modal -->
{{--
<div class="modal fade walletTopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: #080E32; !important;" >
            <div class="modal-header" style="background-color:#080E32; !important;">
                <h5  class="modal-title" style="color:white !important; ">Add Funds To Wallet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="account_topUp">{{ __('Account TopUp') }}</label>
                                        <input type="number" id="account_topUp" name="account_topUp" class="form-control @error('account_topUp') is-invalid @enderror" required data-error="Account Top Up" value="{{ old('account_topUp') }}"  />
                                        @error('account_topUp')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="triggerTopup()" class="btn guoBtn">TopUp</button>
                </div>
        </div>
    </div>
</div>--}}

<div class="modal fade proof-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #080E32 !important;">
            <div class="modal-header" style="background-color: #080E32 !important;">
                <h5  class="modal-title" style="color:white !important; ">Upload Proof of Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="contactForm" method="POST" action="{{route('upload_payment_proof')}}" class="log-form" enctype="multipart/form-data">
                @csrf

                <div class="modal-body" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <input type="hidden" id="transactionIdHolder" name="transactionIdHolder" />
                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="image">{{ __('Choose Image') }}</label>
                                        <input type="file" id="image_name" name="image_name" class="form-control @error('image_name') is-invalid @enderror"  data-error="Your Profile Image" value="{{ old('image_name') }}"  />
                                        @error('image_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class=" form-group">
                                        <label for="image">{{ __('Transaction Description') }} <small>(Optional, not more than 100 words)</small></label>
                                        <textarea name="add_narrations" class="form-control @error('add_narrations') is-invalid @enderror">{{ old('add_narrations') }}</textarea>
                                        @error('add_narrations')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn guoBtn">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade testmony-update" id="testmony-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #152036 !important;">
            <div class="modal-header" style="background-color: #080E32 !important;">
                <h5  class="modal-title" style="color:white !important; ">Testimony</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--<form id="contactForm" method="POST" action="{{route('upload_payment_proof')}}" class="log-form" enctype="multipart/form-data">
                @csrf--}}

                <div class="modal-body" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="alert alert-info">
                                        @php $appSetting = new \App\Models\AppSettings(); @endphp
                                        @php $settings = $appSetting->getSingleModel(); @endphp
                                        Tell Us how you feel about <strong>{{ucwords($settings->site_name)}}</strong>, Our Services.  And How <strong>{{ucwords($settings->site_name)}}</strong> has touched your life. You can also make a video, upload to youtube and drop the link on the field for video below.
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="video_link">{{ __('Drop URL for Video Uploaded to youtube') }}</label>
                                        <input style="border-color:white;" type="text" id="video_link" name="video_link" class="form-control @error('video_link') is-invalid @enderror" />
                                        <div class="err_video_link error_carrier">

                                        </div>
                                    </div>
                                </div>

                                @if(auth()->user()->type_of_user !== 'user')
                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="full_name">{{ __('Please Add Your Full Name') }}</label>
                                        <input style="border-color:white;" type="text" id="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror" />
                                        <div class="err_full_name error_carrier">

                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-12">
                                    <div class=" form-group">
                                        <label for="image">{{ __('Say Something About ') }}{{ucwords($settings->site_name)}}</label>
                                        <textarea style="border-color:white;" id="testimony" name="testimony" class="form-control @error('testimony') is-invalid @enderror" value="{{ old('testimony') }}" placeholder="What do you have to say about {{ucwords($settings->site_name)}}" ></textarea>
                                        <div class="err_testimony error_carrier">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="createTestimony(this)" class="btn guoBtn">Submit</button>
                </div>
            {{--</form>--}}
        </div>
    </div>
</div>


<div class="modal fade playVideo" id="testmony-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #080E32 !important;">
            <div class="modal-header" style="background-color: #080E32 !important;">
                <h5  class="modal-title" style="color:white !important; ">Testimony Videos</h5>
                <button type="button" onclick="closeVideo()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--<form id="contactForm" method="POST" action="{{route('upload_payment_proof')}}" class="log-form" enctype="multipart/form-data">
                @csrf--}}

            <div class="modal-body" >
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12" id="videoHolder">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeVideo()" data-dismiss="modal">Close</button>
                {{--<button type="button" onclick="createTestimony(this)" class="btn guoBtn">Submit</button>--}}
            </div>
            {{--</form>--}}
        </div>
    </div>
</div>

@php
$users = auth()->user();
	$pageTitle = 'Settings Area';
	$Setting = 'active';
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
						<h2 class="st_title"><i class='uil uil-cog'></i> Account Settings</h2>
						<div class="setting_tabs">
							<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="pills-account-tab" data-toggle="pill" href="#pills-account" role="tab" aria-selected="true">Profile</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-bank-account-tab" data-toggle="pill" href="#pills-bank-account" role="tab" aria-selected="false">Bank Account</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-bitcoin-wallet-tab" data-toggle="pill" href="#pills-bitcoin-wallet" role="tab" aria-selected="false">Bitcoin Wallet</a>
								</li>
							</ul>
						</div>
						<div class="tab-content" id="pills-tabContent">
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

							<div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
                                <div class="row" id="errorHold"></div>
								<div class="account_setting">
									<h4>Your CentaDesk Account</h4>
                                    <p>This is your public presence on CentaDesk. You need a account to upload your paid courses, <br> comment on courses, purchased by students, or earning.</p>
                                        <div class="basic_profile">
                                            <div class="basic_ptitle">
                                                <h4>Profile Image</h4>
                                                {{-- <p>Select a portrait image</p> --}}
                                            </div>
                                            <div class="basic_form">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row mt-30">
                                                            <div class="col-lg-3">
                                                                <div style="width: 100%;" class="view_img_left">
                                                                    <div class="view__img">
                                                                        <img id="thumbnail_cover_img" class="round_img" src="/storage/profile/{{ $user->profile_image }}" width="150px" height="160px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9 col-xl-6">
                                                                <form class="user_img_form">
                                                                    @csrf
                                                                    <span class="btn btn-default img-span">Choose Image</span>
                                                                    <input type="file" id="user_profile_img" name="file" class="upload-img-form">
                                                                    <button class="save_btn upload_img_btn" type="submit">Update Photo</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="row">


                                                            <div class="col-lg-4">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="first_name" value="{{ $user->name }}" placeholder="First name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="other_names" value="{{ $user->last_name }}" placeholder="Other names">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="divider-1"></div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
								</div>
								<div class="account_setting">
                                    <form class="update_profile_form">
                                        @csrf
                                        <div class="basic_profile">
                                            <div class="basic_ptitle">
                                                <h4>Personal Profile</h4>
                                                <p>Tell us about yourself</p>
                                            </div>
                                            <div class="basic_form">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="first_name" value="{{ $user->name }}" placeholder="First name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="other_names" value="{{ $user->last_name }}" placeholder="Other names">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon input swdh11 swdh19">
                                                                        <input class="prompt srch_explore" type="text" name="headline" value="{{ $user->professonal_heading }}" placeholder="Professional Headline">
                                                                        <div class="form-control-counter" data-purpose="form-control-counter">15</div>
                                                                    </div>
                                                                    <div class="help-block">Add a professional headline like, "Engineer at Cursus" or "Architect."</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui form swdh30">
                                                                        <div class="field">
                                                                            <textarea rows="10" name="description" placeholder="Describe yourself in not less than 50 characters...">{{ $user->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="help-block">Explain about yourself or your company here. Your accomplishments can be written here also.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="divider-1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="basic_profile1">
                                            <div class="basic_ptitle">
                                                <h4>Social Media Presence</h4>
                                            </div>
                                            <div class="basic_form">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://facebook.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="facebook" value="{{ $user->facebook }}" placeholder="Facebook Profile">
                                                                    </div>
                                                                    <div class="help-block">Enter your Facebook username (e.g. johndoe).</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://twitter.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="twitter" value="{{ $user->twitter }}"  placeholder="Twitter Profile">
                                                                    </div>
                                                                    <div class="help-block">Enter your Twitter username (e.g. johndoe).</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://www.linkedin.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="linkedin" value="{{ $user->linkedin }}" placeholder="Linkedin Profile">
                                                                    </div>
                                                                    <div class="help-block">Enter your LinkedIn Username.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://www.youtube.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="youtube" value="{{ $user->youtube }}" placeholder="Youtube Profile">
                                                                    </div>
                                                                    <div class="help-block">Enter your Youtube Username.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://www.instagram.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="instagram" value="{{ $user->instagram }}" placeholder="Instagram Profile">
                                                                    </div>
                                                                    <div class="help-block">Enter your Instagram Username.</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="ui search focus mt-30">
                                                                    <div class="ui left icon labeled input swdh11 swdh31">
                                                                        <div class="ui label lb12">
                                                                            https://www.whatsapp.com/
                                                                        </div>
                                                                        <input class="prompt srch_explore" type="text" name="whatsapp" value="{{ $user->whatsapp }}" placeholder="Whatsapp Number">
                                                                    </div>
                                                                    <div class="help-block">Enter your Whatsapp number.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
									<button class="save_btn update_profile_btn" type="submit">Save Changes</button>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-bank-account" role="tabpanel" aria-labelledby="pills-bank-account-tab">
								<div class="account_setting">
									<form action="{{route('update_bank_account' )}}" method="POST">
										@csrf
										<div class="basic_profile">
											<div class="basic_ptitle">
												<h4>Bank Account Update</h4>
											</div>
											<div class="basic_form">
												<div class="row">
													<div class="col-lg-8">
														<div class="row">
															<div class="col-lg-12">
																<div class="ui search focus mt-30 lbel25">
																	<label class="text-dark night-text" for="bank_code">Select Bank</label>
																</div>
																<select name="bank_code" id="bank_code" class="ui hj145 dropdown cntry152 prompt srch_explore">
																	<option value="">Select</option>
																	@foreach($bankCodesModel as $eachBankCodesModel)
																		<option {{($eachBankCodesModel->bank_name == auth()->user()->bank_code)?'selected':''}} value="{{$eachBankCodesModel->bank_name}}">{{$eachBankCodesModel->bank_name}} ({{$eachBankCodesModel->country}})</option>
																	@endforeach
																</select>
															</div>
															<div class="col-lg-6">
																<div class="ui search focus mt-30">
																	<label class="text-dark night-text" for="account_name">Bank Account Name</label>
																	<div class="ui left icon input swdh11 swdh19">
																		<input class="prompt srch_explore" type="text" name="account_name" id="account_name" required placeholder="Enter Bank Account Name" value="{{$user->account_name}}">
																		<i class="uil uil-money-bill icon icon2"></i>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="ui search focus mt-30">
																	<label class="text-dark night-text" for="bank_account">Bank Account Number</label>
																	<div class="ui left icon input swdh11 swdh19">
																		<input class="prompt srch_explore" type="number" name="bank_account" id="bank_account" required placeholder="Enter Bank Number" value="{{$user->account_number}}">
																		<i class="uil uil-money-withdraw icon icon2"></i>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<button class="save_btn" type="submit">Save Changes</button>
									</form>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-bitcoin-wallet" role="tabpanel" aria-labelledby="pills-bitcoin-wallet-tab">
								<div class="account_setting">
									<form action="{{route('update_wallet_address' )}}" method="POST">
										@csrf
										<div class="basic_profile">
											<div class="basic_form">
												<div class="nstting_content">
													<div class="row">
														<div class="col-lg-6">
															<div class="ui search focus mt-30">
																<label class="text-dark night-text" for="bit_coin_wallet">Bitcoin Wallet Address</label>
																<div class="ui left icon input swdh11 swdh19">
																	<input class="prompt srch_explore" type="text" name="bit_coin_wallet" id="bit_coin_wallet" required placeholder="Enter Address for recieving payment" value="{{$user->wallet_address}}">
																	<i class="uil uil-bitcoin icon icon2"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<button class="save_btn" type="submit">Save Changes</button>
									</form>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-privacy" role="tabpanel" aria-labelledby="pills-privacy-tab">
								<div class="account_setting">
									{{-- <h4>Enrollment</h4> --}}
									<p>Enter percentage to be removed from payments made to teachers.</p>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="ui search focus">
                                                            <label class="text-dark night-text" for="bit_coin_wallet">Course Enrollment Percentage</label>
                                                            <div class="ui left icon input swdh11 swdh19">
                                                                <input class="prompt srch_explore" type="number" name="enrollment_percentage" id="wallet" placeholder="Enter percentage to pay teachers" value="">
                                                                <i class="uil uil-receipt icon icon2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
									<button class="save_btn" type="submit">Save Changes</button>
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
    $(document).ready(function () {

            // process form for creating course
            $('.update_profile_btn').click(async function(e) {
                e.preventDefault();
                let data = [];
                // basic info
                let update_profile = $('.update_profile_form').serializeArray();
                // console.log(update_profile); return;

                // append to form data object
                let form_data = set_form_data(update_profile);
                let returned = await ajaxRequest('personal-details', form_data);
                    // console.log(returned);return;
                validator(returned, 'main_settings_page');
            });


        $('.upload_img_btn').click(async function (e) {
            e.preventDefault();
            let data = [];
            let user_img = $('#user_profile_img').prop('files')[0];
            let user_img_form = $('.user_img_form').serializeArray();
            let img_data = {name:"profile_img", value:user_img};

            user_img_form.forEach(e => {
                data.push(e);
            });
            data.push(img_data);
            // console.log(data);return;
            let form_data = set_form_data(data);
            let returned = await ajaxRequest('profile/photo', form_data);
            // console.log(returned);return;
                validator(returned, 'main_settings_page');
        });
    });
</script>

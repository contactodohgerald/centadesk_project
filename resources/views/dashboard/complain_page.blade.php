@php
    $appSettings = new \App\Model\AppSettings();
    $site_logo = $appSettings->getSingleModel();
@endphp
@php
	$pageTitle = 'Complain Page Area';
@endphp
		<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:30 GMT -->
@include('layouts.head_auth')

<body>
	
	<!-- Body Start -->
	<div class="sign_in_up_bg">		
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-md-12">
					<div class="cmtk_group">
						<div class="ct-logo">
							<a href="/">
								<img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
							</a>
						</div>
						<div class="cmtk_dt">
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

									<div class="alert alert-danger text-center">
										<h2>Your Account Is Inactive,  Please Contact Administration For Account Activation </h2>
									</div>

									<form method="POST" action="{{ route('create_complain') }}">
										@csrf

										<select class="ui hj145 dropdown cntry152 prompt srch_explore" name="reasons" required>
											<option value="account_activation">Account Activation</option>
										</select>

										<div class="ui search focus mt-15">
											<div class="ui left icon input swdh95">
												<input class="prompt srch_explore" type="email" name="email" id="email"  placeholder="Email" required>
												<i class="uil uil-envelope icon icon2"></i>
											</div>
										</div>

										<div class="ui search focus mt-15">
											<div class="ui form swdh30">
												<div class="field">
													<textarea rows="5" name="description" id="id_about" placeholder="Write a little description ..." required></textarea>
												</div>
											</div>
											<div class="help-block">Your reason should have at least 100 characters.</div>
										</div>

										@if(Session::has('success_message'))
											<button class="login-btn">
												<a  href="/">Back To Home</a>
											</button>
										@elseif(Session::has('error_message'))
											<button class="login-btn" type="submit">Request Account Activation</button>
										@else
											<button class="login-btn" type="submit">Request Account Activation</button>
										@endif

									</form>
								</div>
							</div>
						</div>
						@include('layouts.footer_auth')
					</div> 	
				</div>	
			</div>	
		</div>		
	</div>	
	<!-- Body End -->

@include('layouts.e_script_auth')

</body>

<!-- Mirrored from gambolthemes.net/html-items/cursus_demo_f12/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Aug 2020 17:44:30 GMT -->
</html>
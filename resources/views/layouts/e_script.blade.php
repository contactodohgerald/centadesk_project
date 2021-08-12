@php
$appSettings = new \App\Model\AppSettings();
$site_logo = $appSettings->getSingleModel();

@endphp
@include('basic_urls')

@include('modal')

@php $users = auth()->user(); @endphp

<script src="{{asset('dashboard/js/vertical-responsive-menu.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('dashboard/vendor/semantic/semantic.min.js')}}"></script>
<script src="{{asset('dashboard/js/custom.js')}}"></script>
<script src="{{asset('dashboard/js/night-mode.js')}}"></script>

<script src="{{asset('dashboard/js/jquery-steps.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/p30snmkpddqjkl8e3opkw77vsoof02ejprxp8evgfn1aprm8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

<script src="{{asset('dashboard/js/datepicker.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('dashboard/custom/custom-tinymce.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script> --}}
<!-- <script src="{{asset('dashboard/custom/validatorClass.js')}}"></script> -->
<script src="{{asset('dashboard/assets/loader.js')}}"></script>

<!-- Snackbar toaster -->
<script src="{{ asset('dashboard/custom/js-snackbar/dist/js-snackbar.js') }}"></script>
<script src="{{ asset('dashboard/custom/js-snackbar/dist/site.js') }}"></script>
<!-- Snackbar toaster -->

<script src="{{asset('dashboard/custom/Basic-function.js')}}"></script>
<script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('summernote/summernote.min.js')}}"></script>
<script src="{{asset('summernote/summernote-active.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="{{asset('toast/jquery.toast.js')}}"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script src="{{asset('countdown-plugin/jquery.countdown.min.js')}}"></script>

@include('js_files.js_by_page')

<script type="text/javascript">
    function closeErrorCarrierBox(a) {
        // console.log('yh')
        $(a).addClass('hidden');
    }

    $(document).ready(function() {

       // getAllNotification(userUniqueId);

        $('#add-course-tab').steps({
            // onFinish: function() {
            //     // alert('Wizard Completed');
            // }
        });


        function showErrors() {
            var selected = $(".invalid-feedback");
            for (let i = 0; i < selected.length; i++) {
                if ($(selected[i]).find('strong').text() !== '') {
                    $(selected[i]).css({
                        'display': 'block'
                    });
                }
            }
        }
    });

    async function getAllNotification(user_unique_id){
        let dataHold = '';
        let returnData = await getRequest(baseUrl+'api/getAllNotification/'+user_unique_id);
        let {notification_data, error_code} = returnData;

        if (notification_data.length > 0){
            for (let i = 0; i < notification_data.length; i++){
                let {title, link, notification_type, notification_details, created_at, users, dates} = notification_data[i];

                dataHold += `
                    <div class="channel_my item all__noti5">
                        <div class="profile_link">
                            <img src="{{ asset('storage/profile/${users.profile_image}') }}" alt="{{ env('APP_NAME') }}">
                            <div class="pd_content">
                                <h6>${users.name} ${users.last_name} - ${notification_type}</h6>
                                <p class="noti__text5">${notification_details}</p>
                                <span class="nm_time">${dates}</span>
                            </div>
                        </div>
                    </div>
                `;

            }4
        }else {
            dataHold += `
                <div class="channel_my item all__noti5">
                    <div class="profile_link">
                        <p>NO Notification For Now</p>
                    </div>
                </div>
            `;
        }

        $("#all_msg_bg").html(dataHold);

    }
</script>

<!-- The Modal -->
<div class="modal logout" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark night-text">Sign Out</h4>
                <button type="button" class="close" data-dismiss="myModal" onclick="removeModalMains('.logout')">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center text-dark night-text">Are You Sure You Want To Sign Out?</h3>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="removeModalMains('.logout')">Close</button>
                <a class="btn btn-primary " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal accountTopUp" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark night-text">Account TopUp</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.accountTopUp')">&times;</button>
            </div>

            <form action="{{route('top_up' )}}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ui search focus mt-30">
                                <label for="topUpAmount" class="text-dark night-text">Enter Amount In ({{$users->getBalanceForView()['data']['currency']}})</label>
                                <input class="form-control" type="number" name="topUpAmount" id="topUpAmount" required placeholder="Enter Amount" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="removeModalMains('.accountTopUp')">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal zoomInUp btc_topup_modal" id="btc_topup_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark night-text">Enroll for Course?</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.btc_topup_modal')">&times;</button>
            </div>
            <form class="btc_topup_form">
                @csrf
                <div class="modal-body">
                    <div class="ui search focus mt-30">
                        <label for="topUpAmount" class="text-dark night-text">Enter Amount In ({{$users->getBalanceForView()['data']['currency']}})</label>
                        <input class="form-control" type="number" name="topUpAmount" id="topUpAmount" required placeholder="Enter Amount" autofocus>
                    </div>
                </div>
            </form>
            <div class="modal-footer no-border">
                <div class="text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeModalMains('.btc_topup_modal')">Close</button>
                    <button type="submit" class="btn btn-primary btc_topup_btn">Proceed</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal zoomInUp enroll_modal" id="enroll_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark night-text">Enroll for Course?</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.enroll_modal')">&times;</button>
            </div>
            <form class="enroll_form">
                @csrf
                <div class="modal-body">
                    <p class="text-dark night-text">By clicking continue, your account wallet will be used to pay for this course.</p>
                </div>
            </form>
            <div class="modal-footer no-border">
                <div class="text-right">
                    <button class="btn btn-danger btn-sm" data-dismiss="modal" onclick="removeModalMains('.enroll_modal')">Cancel</button>
                    <button class="btn btn-primary btn-sm enroll_btn" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal notification-access-modal" id="notification-access-modal">
    <div class="modal-dialog">
        <div class="modal-content" >

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-dark night-text">Allow Push Notification</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.notification-access-modal')">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 offset-5">
                        <img src="/storage/site_logo/{{ $site_logo->site_logo }}" alt="{{env('APP_NAME')}}">
                    </div>
                    <div class="col-md-12 center">
                        <h4 class="text-dark night-text">{{env('APP_NAME')}} would want to send you push notification, so that you could always keep track of your notifications.</h4>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeModalMains('.notification-access-modal')">Close</button>
                <button type="submit" class="btn btn-primary" onclick="updateUserWebFCMKey(this, '{{auth()->user()->unique_id}}')">Grant Permission</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>

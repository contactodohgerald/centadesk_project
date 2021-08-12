<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="{{env('APP_NAME', 'CENTADESK')}}">
    <meta name="author" content="{{env('APP_NAME', 'CENTADESK')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME', 'CENTADESK')}} - {{$pageTitle}}</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('dashboard/images/fav.png')}}">

    <!-- Stylesheets -->
    {{-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  rel="stylesheet"/>
    <link href='{{asset('dashboard/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
    <link href="{{asset('dashboard/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/night-mode.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/jquery-steps.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('summernote/summernote.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet"> --}}


    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/js-snackbar/dist/js-snackbar.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/js-snackbar/dist/site.css')}}"> --}}
    <link href="{{asset('dashboard/css/instructor-dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/css/instructor-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('toast/jquery.toast.css')}}" rel="stylesheet">

    <!-- Vendor Stylesheets -->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/vendor/semantic/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/custom/custom-app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/assets/loader.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('dashboard/assets/bootstrap-v4.5.0/css/bootstrap.min.css')}}"> --}}


</head>

<!-- Insert this script at the bottom of the HTML, but before you use any Firebase services -->

<!-- Add the entire Firebase JavaScript SDK -->
{{-- <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase.js"></script>

<script>
    console.log(firebase);
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyCEgCLRwhOGVHEBK2h-3T9_Oo5S2Mxz2Ps",
        authDomain: "centadesk-c7f3e.firebaseapp.com",
        projectId: "centadesk-c7f3e",
        storageBucket: "centadesk-c7f3e.appspot.com",
        messagingSenderId: "138970709402",
        appId: "1:138970709402:web:eabc07ae6c5085fcc2ce23",
        measurementId: "G-1W8LNZ601C"
        
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    const messaging = firebase.messaging();

    if (Notification.permission === "denied" || Notification.permission === 'default') {

        setTimeout(function () {
            bringOutModalMain('.notification-access-modal');
        }, 5000);
    }else{

        document.getElementById('noti_man').style.display = 'none';
    }

    function askPermission() {

        return new Promise(function (resolve, reject) {

            messaging
                .requestPermission()
                .then(function () {

                    // get the token in the form of promise
                    return messaging.getToken()
                })
                .then(function(token) {

                    resolve(token);

                }).catch(function (err) {
                reject(err)
            });

        })


    }

    async function updateUserWebFCMKey(a, user_id) {
        $(a).text('Loading...').attr({'disabled':true});

        let andriod_token = '';
        let ios_token = '';

        let web_token = await askPermission();

        let postData = await postRequest(baseUrl+"api/updateUserFCMKeys/"+user_id,  {andriod_fcm_key:andriod_token, ios_fcm_key:ios_token, web_fcm_key:web_token});
        let {error_code, success_message, error_message} = postData;
        if(error_code == 0){
            $(a).text('Saved Successfully').attr({'disabled':false});
            showValidatorToaster(success_message, 'success');
            myIndexDb.set('web_fcm_key',{fcm_key:web_token}, 'centadesk_db', 'contact_tb');
            setTimeout(function () {
                location.reload();
            }, 2000);
        }else {
            showValidatorToaster(error_message, 'warning');
        }

    }
</script> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@include('mdincludes.head')
<body>

@include('mdincludes.sidebar')
<!-- Start Welcome area -->
<div class="all-content-wrapper">

@include('mdincludes.header')

@yield('content')

@include('mdincludes.footer')

</div>
<!-- jquery
    ============================================ -->
<script src="{{asset('mdash/jquery.js')}}"></script>
{{--<script src="{{asset('mdash/js/vendor/jquery-1.12.4.min.js')}}"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
<script>
    $(document).ready(function () {
        if($(".smallCheckBox")){
            $(".smallCheckBox").prop('checked', false);
        }
    });
</script>
<!--copy-->
<script src="{{asset('mdash/js_2/coppier/clipboard.min.js')}}"></script>

@include('js_files.js_by_page')
{{--@include('js_files.modal')--}}
{{--<script src="{{asset('js/custom/jquery.js')}}" ></script>--}}
<!-- bootstrap JS
    ============================================ -->
<script src="{{asset('mdash/js/bootstrap.min.js')}}"></script>
<!-- wow JS
    ============================================ -->
<script src="{{asset('mdash/js/wow.min.js')}}"></script>
<!-- price-slider JS
    ============================================ -->
<script src="{{asset('mdash/js/jquery-price-slider.js')}}"></script>
<!-- meanmenu JS
    ============================================ -->
<script src="{{asset('mdash/js/jquery.meanmenu.js')}}"></script>
<!-- owl.carousel JS
    ============================================ -->
<script src="{{asset('mdash/js/owl.carousel.min.js')}}"></script>
<!-- sticky JS
    ============================================ -->
<script src="{{asset('mdash/js/jquery.sticky.js')}}"></script>
<!-- scrollUp JS
    ============================================ -->
<script src="{{asset('mdash/js/jquery.scrollUp.min.js')}}"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
<script src="{{asset('mdash/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('mdash/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
<!-- metisMenu JS
    ============================================ -->
<script src="{{asset('mdash/js/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('mdash/js/metisMenu/metisMenu-active.js')}}"></script>
<!-- sparkline JS
    ============================================ -->
<script src="{{asset('mdash/js/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('mdash/js/sparkline/jquery.charts-sparkline.js')}}"></script>
<!-- calendar JS
    ============================================ -->
<script src="{{asset('mdash/js/calendar/moment.min.js')}}"></script>
<script src="{{asset('mdash/js/calendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('mdash/js/calendar/fullcalendar-active.js')}}"></script>
<!-- float JS
    ============================================ -->
<script src="{{asset('mdash/js/flot/jquery.flot.js')}}"></script>
<script src="{{asset('mdash/js/flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('mdash/js/flot/curvedLines.js')}}"></script>
<script src="{{asset('mdash/js/flot/flot-active.js')}}"></script>
<!-- plugins JS
    ============================================ -->
<script src="{{asset('mdash/js/plugins.js')}}"></script>

<!--summer note-->
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    (function ($) {
        "use strict";

        $('#summernote').summernote({
            //placeholder: 'Enter News Here!',
            tabsize: 1,
            height: 300
        });
    })(jQuery);

</script>

<!-- main JS
    ============================================ -->
<script src="{{asset('mdash/js/main.js')}}"></script>

<!-- Custom Scripts -->

<script src="{{asset('mdash/js_2/custom/generics.js')}}" ></script>
<script src="{{asset('mdash/js_2/custom/requestHandler.js')}}" ></script>
<script src="{{asset('mdash/js_2/custom/logoutScript.js')}}" ></script>



<!--sweet alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




</body>

</html>

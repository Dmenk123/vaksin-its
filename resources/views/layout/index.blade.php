
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.png">

    <title>myITS Vaksin</title>

    <!-- vendor css -->
    <link href="{{asset('assets/template_web/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template_web/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template_web/lib/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template_web/lib/prismjs/themes/prism-vs.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template_web/lib/animate.css/animate.min.css')}}" rel="stylesheet">


    <!-- DashForge CSS -->
    <link href="{{asset('assets/template_web/css/dashforge.css')}}" rel="stylesheet">

    <link href="{{asset('assets/template_web/css/dashforge.customs.css')}}" rel="stylesheet">
    <link href="{{asset('assets/template_web/css/skin.light.css')}}" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<!-- <body class="hold-transition sidebar-mini sidebar-collapse"> -->
{{-- <body class="layout-top-nav"> --}}

<body>
@include('layout.sidebar')

@yield('content')


{{-- <div class="modal fade effect-scale" id="chgRoleUser" tabindex="-1" role="dialog" aria-labelledby="chgRoleUserLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h5 class="tx-montserrat tx-medium" id="chgRoleUserLabel">Hak Akses</h5>
            <p class="tx-color-02">Hak akses Anda saat ini: <b>User </b>.</p>
            <select class="form-control" id="menu">
                <option selected="selected">Select One</option>
                <option value="../beranda/index.html">Pegawai</option>
                <option value="../beranda/index-admin.html">Admin</option>
            </select>
            <div class="mg-t-20 d-flex justify-content-end">
                <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batal</button>
                <input class="btn btn-its tx-montserrat tx-semibold mg-l-5 mg-lg-l-10" type="button" id="goBtn" value="Ganti">
            </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- jQuery -->
<script src="{{asset('assets/template_web/lib/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/template_web/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('assets/template_web/lib/feather-icons/feather.min.js')}}"></script>

<script src="{{asset('assets/template_web/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/template_web/lib/js-cookie/js.cookie.js')}}"></script>

<script src="{{asset('assets/template_web/js/dashforge.js')}}"></script>
<script src="{{asset('assets/template_web/js/dashforge.aside.js')}}"></script>

<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<!-- page script -->

<!-- Script base -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //canvas menu
    $(function(){
        'use strict'

        $('.off-canvas-menu').on('click', function(e){
            e.preventDefault();
            var target = $(this).attr('href');
            $(target).addClass('show');
        });

        $('.off-canvas .close').on('click', function(e){
            e.preventDefault();
            $(this).closest('.off-canvas').removeClass('show');
        })

        $(document).on('click touchstart', function(e){
            e.stopPropagation();
            if(!$(e.target).closest('.off-canvas-menu').length) {
            var offCanvas = $(e.target).closest('.off-canvas').length;
            if(!offCanvas) {
                $('.off-canvas.show').removeClass('show');
            }
            }
        });
    });

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //allow focus menu
    $(document).on('click', '.allow-focus', function (e) {
        e.stopPropagation();
    });

    //file name input
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    //script sementara untuk beralih role
    var goBtn = document.getElementById("goBtn");
    var menu = document.getElementById("menu");

    goBtn.onclick = function() {
        window.location = menu.value;
    }
</script>

@yield('js')
</body>
</html>

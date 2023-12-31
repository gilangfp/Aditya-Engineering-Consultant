<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>AEC || {{ $title }}</title>

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('vendor/adminbsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('vendor/adminbsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('vendor/adminbsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('vendor/adminbsb/plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('vendor/adminbsb/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('vendor/adminbsb/css/themes/all-themes.css') }}" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('vendor/adminbsb/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}"
        rel="stylesheet" />
    
     
    {{-- EXTENSION TEMPLATE --}}
    <!-- form select ex -->
    <link rel="stylesheet" href="{{ asset('vendor/adminbsb/extension/bootstrap-select.min.js') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminbsb/extension/select-bootstrap-select.min.css') }}">
    {{-- sweetsAlert --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/adminbsb/extension/sweetalert2.min.css') }}"> --}}
    @yield("css")

</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('templates.navbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('templates.leftbar')
        <!-- #END# Left Sidebar -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                @yield('container')
            </div>
        </div>
    </section>



    <!-- Jquery Core Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('vendor/adminbsb/js/admin.js') }}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('vendor/adminbsb/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('vendor/adminbsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">

    <!-- Jquery DataTable Plugin Js -->

    <!-- Custom Js -->
    <script src="{{ asset('vendor/adminbsb/js/demo.js') }}"></script>
    
    
    {{-- <script src="{{ asset('vendor/adminbsb/js/pages/forms/basic-form-elements.js') }}"></script> --}}

    {{-- EXTENSION --}}
    {{-- sweetsAlert
    <script src="{{ asset('vendor/adminbsb/extension/sweetalert2.min.js') }}"></script>
    <script>
        Swal.fire(
            'The Internet?',
            'That thing is still around?',
            'question'
        )
    </script> --}}
    

    @yield("scripts")

</body>

</html>

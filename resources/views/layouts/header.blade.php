<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->

    <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

      <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->

    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('plugins/chart.js/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/chart.js/Chart.css') }}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2-container .select2-selection--single {
            height: 30px;
        }
        .select2-search--dropdown .select2-search__field {
            padding: 0px;
        }
        .select2-results .select2-results__option {
            font-size: 13px;
        }
        .custom-control-label{
            cursor: pointer;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini" style="overflow-x: clip;">
  
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <span class="text-dark float-left mr-3" id="current_time"></span>
                        <div class="custom-control custom-switch switch-primary switch-md float-right">
                            @if(!empty(CheckTime()) && CheckTime()->is_active==1)
                            <input type="checkbox" value="1" id="switch-s1" class="custom-control-input" checked>
                            <label class="custom-control-label " for="switch-s1" id="user_clock" style="cursor:pointer;" title="Clock In"></label>
                            @else 
                            <input type="checkbox" value="0" id="switch-s1" class="custom-control-input">
                            <label class="custom-control-label " for="switch-s1" id="user_clock" style="cursor:pointer;" title="Clock In"></label>
                            @endif
                        </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">{{ Auth::user()->name ?? 'not found'}}
                        <i class="far fa-user"></i>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                        <!-- <div class="dropdown-divider"></div> -->
                        <a href="{{ route('admin.profile') }}" class="dropdown-item">
                            <i class="fas fa-user-alt mr-2"></i> Profile
                            <span class="float-right text-muted text-sm"></span>
                        </a>

                        <a href="{{ route('admin.logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        

        <!-- /.navbar -->

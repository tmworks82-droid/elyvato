<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="bidding, elyvato, Marketing Service Provider Marketplace, Video Editing, Content writing, gigs, Ai Development, marketplace, peopleperhour, proposals, sell services">
<meta name="description" content="Elyvato - Marketing Service Provider Marketplace">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('user/css/ace-responsive-menu.css')}}">
<link rel="stylesheet" href="{{asset('user/css/menu.css')}}">
<link rel="stylesheet" href="{{asset('user/css/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('user/css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('user/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('user/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('user/css/slider.css')}}">
<link rel="stylesheet" href="{{asset('user/css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('user/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('user/css/style.css')}}">
<link rel="stylesheet" href="{{asset('user/css/ud-custom-spacing.css')}}">
<link rel="stylesheet" href="{{asset('user/css/dashbord_navitaion.css')}}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


<!-- Title -->
<title>@yield('title')</title>
<!-- Favicon -->
<link href="{{asset('front/images/logo_head.png')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{asset('front/images/logo_head.png')}}" sizes="128x128" rel="shortcut icon" />
<!-- Apple Touch Icon -->
<link href="{{asset('user/images/logo_head.png')}}" sizes="60x60" rel="apple-touch-icon">
<link href="{{asset('user/images/logo_head.png')}}" sizes="72x72" rel="apple-touch-icon">
<link href="{{asset('user/images/logo_head.png')}}" sizes="114x114" rel="apple-touch-icon">
<link href="{{asset('user/images/logo_head.png')}}" sizes="180x180" rel="apple-touch-icon">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<div class="wrapper">
  <div class="preloader"></div>

  <!-- Main Header Nav -->
  <header class="header-nav nav-innerpage-style menu-home4 dashboard_header main-menu">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
      <div class="container-fluid pr30 pr15-xs pl30 posr menu_bdrt1">
        <div class="row align-items-center justify-content-between">
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-start d-flex align-items-center">
              <div class="dashboard_header_logo position-relative me-2 me-xl-5">
                <a href="{{url('user/dashboard')}}" class="logo"><img src="{{asset('front/images/logo_head.png')}}" alt="" style="    width: 100px;
    height: 28px;
"></a>
              </div>
              <div class="fz20 ml90">
                <a href="#" class="dashboard_sidebar_toggle_icon vam"><img src="{{asset('user/images/dashboard-navicon.svg')}}" alt=""></a>
              </div>
              <a class="login-info d-block d-xl-none ml40 vam" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span class="flaticon-loupe"></span></a>
              <div class="ml40 d-none d-xl-block">
                <div class="search_area dashboard-style">
                  <input type="text" class="form-control border-0" placeholder="What service are you looking for today?">
                  <label><span class="flaticon-loupe"></span></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-auto">
            <div class="text-center text-lg-end header_right_widgets">
              <ul class="dashboard_dd_menu_list d-flex align-items-center justify-content-center justify-content-sm-end mb-0 p-0">
                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-notification"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt10 pb15">
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-1.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your resume</p>
                          <p class="text mb-0">updated!</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-2.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You changed</p>
                          <p class="text mb-0">password</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-3.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your account has been</p>
                          <p class="text mb-0">created successfully</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-4.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You applied for a job </p>
                          <p class="text mb-0">Front-end Developer</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center">
                        <img src="{{asset('user/images/resource/notif-5.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your course uploaded</p>
                          <p class="text mb-0">successfully</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-mail"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt20 pb15">
                      <div class="notif_list d-flex align-items-start bdrb1 pb25 mb10">
                        <img class="img-2" src="{{asset('user/images/testimonials/testi-1.png')}}" alt="">
                        <div class="details ml15">
                          <p class="dark-color fw500 mb-2">Ali Tufan</p>
                          <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                          <p class="mb-0 text-thm">4 hours ago</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-start mb25">
                        <img class="img-2" src="{{asset('user/images/testimonials/testi-2.png')}}" alt="">
                        <div class="details ml15">
                          <p class="dark-color fw500 mb-2">Ali Tufan</p>
                          <p class="text mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                          <p class="mb-0 text-thm">4 hours ago</p>
                        </div>
                      </div>
                      <div class="d-grid">
                        <a href="#" class="ud-btn btn-thm w-100">View All Messages<i class="fal fa-arrow-right-long"></i></a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="d-none d-sm-block">
                  <a class="text-center mr5 text-thm2 dropdown-toggle fz20" type="button" data-bs-toggle="dropdown" href="#"><span class="flaticon-like"></span></a>
                  <div class="dropdown-menu">
                    <div class="dboard_notific_dd px30 pt10 pb15">
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-1.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your resume</p>
                          <p class="text mb-0">updated!</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-2.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You changed</p>
                          <p class="text mb-0">password</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-3.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your account has been</p>
                          <p class="text mb-0">created successfully</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center bdrb1 pb15 mb10">
                        <img src="{{asset('user/images/resource/notif-4.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">You applied for a job </p>
                          <p class="text mb-0">Front-end Developer</p>
                        </div>
                      </div>
                      <div class="notif_list d-flex align-items-center">
                        <img src="{{asset('user/images/resource/notif-5.png')}}" alt="">
                        <div class="details ml10">
                          <p class="text mb-0">Your course uploaded</p>
                          <p class="text mb-0">successfully</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="user_setting">
                  <div class="dropdown">
                    <a class="btn" href="#" data-bs-toggle="dropdown">
                      <img src="{{asset('user/images/resource/user.png')}}" alt="user.png">
                    </a>
                    <div class="dropdown-menu">
                      <div class="user_setting_content">
                        <p class="fz15 fw400 ff-heading mb10 pl30">Start</p>
                        <a class="dropdown-item active" href="{{url('user/dashboard')}}"><i class="flaticon-home mr10"></i>Dashboard</a>
                        <!-- <a class="dropdown-item" href="page-dashboard-proposal.html"><i class="flaticon-document mr10"></i>My Proposals</a>
                        <a class="dropdown-item" href="page-dashboard-message.html"><i class="flaticon-chat mr10"></i>Message</a>
                        <a class="dropdown-item" href="page-dashboard-invoice.html"><i class="flaticon-receipt mr10"></i>Invoice</a>
                        <a class="dropdown-item" href="page-dashboard-payouts.html"><i class="flaticon-dollar mr10"></i>Payouts</a>
                        <a class="dropdown-item" href="page-dashboard-statement.html"><i class="flaticon-web mr10"></i>Statements</a>
                        <p class="fz15 fw400 ff-heading mt30 pl30">Organize and Manage</p>
                        <a class="dropdown-item" href="page-dashboard-manage-service.html"><i class="flaticon-presentation mr10"></i>Manage Services</a>
                        <a class="dropdown-item" href="page-dashboard-manage-jobs.html"><i class="flaticon-briefcase mr10"></i>Manage Jobs</a>
                        <a class="dropdown-item" href="page-dashboard-favorites.html"><i class="flaticon-content mr10"></i>Manage Project</a>
                        <p class="fz15 fw400 ff-heading mt30 pl30">Account</p> -->
                        <a class="dropdown-item" href="{{url('user-profiles')}}"><i class="flaticon-photo mr10"></i>My Profile</a>
                        <a class="dropdown-item" href="#"><i class="flaticon-logout mr10"></i>Logout</a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- Search Modal -->
  <div class="search-modal">
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-xmark"></i></button>
          </div>
          <div class="modal-body">
            <div class="popup-search-field search_area">
              <input type="text" class="form-control border-0" placeholder="What service are you looking for today?">
              <label><span class="far fa-magnifying-glass"></span></label>
              <button class="ud-btn btn-thm" type="submit">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Nav  -->
  <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
      <div class="header bdrb1">
        <div class="menu_and_widgets">
          <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
            <a class="mobile_logo" href="#"><img src="{{asset('user/images/header-logo3.svg')}}" alt=""></a>
            <div class="right-side text-end">
              <a class="" href="page-login.html">join</a>
              <a class="menubar ml30" href="#menu"><img src="{{asset('user/images/mobile-dark-nav-icon.svg')}}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="posr"><div class="mobile_menu_close_btn"><span class="far fa-times"></span></div></div>
      </div>
    </div>
    <!-- /.mobile-menu -->
    <nav id="menu" class="">
      <ul>
        <li><span>Home</span>
          <ul>
            <li><a href="{{('user/dashboard')}}">Home</a></li>

          </ul>
        </li>
        <li><span>Browse Jobs</span>
          <ul>
            <li><span>Services</span>
              <ul>
                <li><a href="#">Service</a></li>
               
              </ul>
            </li>
        
          </ul>
        </li>
        <li><span>Users</span>
          <ul>
            <li><span>Dashboard</span>
              
            </li>
            
          </ul>
        </li>
                <!-- Only for Mobile View -->
      </ul>
    </nav>
  </div>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="bidding, elyvato, Marketing Service Provider Marketplace, Video Editing, Content writing, gigs, Ai Development, marketplace, peopleperhour, proposals, sell services">
<meta name="description" content="Elyvato - Marketing Service Provider Marketplace">
<meta name="CreativeLayers" content="ATFN">
<!-- css file -->
<link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/ace-responsive-menu.css')}}">
<link rel="stylesheet" href="{{asset('front/css/menu.css')}}">
<link rel="stylesheet" href="{{asset('front/css/fontawesome.css')}}">
<link rel="stylesheet" href="{{asset('front/css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('front/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slider.css')}}">
<link rel="stylesheet" href="{{asset('front/css/style.css')}}">
<link rel="stylesheet" href="{{asset('front/css/ud-custom-spacing.css')}}">
<link rel="stylesheet" href="{{asset('front/css/magnific-popup.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
<!-- Title -->
<title>Elyvato | @yield('title')</title>
<!-- Favicon -->
<link href="{{asset('front/images/icons/final-logo-elyvato.png')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link rel="icon" href="{{asset('front/images/icons/favicon 32x32.png')}}" type="image/x-icon">
<!-- Apple Touch Icon -->
<link href="{{asset('front/images/icons/final-logo-elyvato.png')}}" sizes="60x60" rel="apple-touch-icon">
<link href="{{asset('front/images/icons/final-logo-elyvato.png')}}" sizes="72x72" rel="apple-touch-icon">
<link href="{{asset('front/images/icons/final-logo-elyvato.png')}}" sizes="114x114" rel="apple-touch-icon">
<link href="{{asset('front/images/icons/final-logo-elyvato.png')}}" sizes="180x180" rel="apple-touch-icon">

 <style>
     

        /* The main card container, acting as the green frame */
        .custom-card-frame {
            background-color: #104531;
            border-radius: 1.5rem; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            /* max-width: 320px;  */
            width: 100%;
            padding: 1.5rem;
            box-sizing: border-box;
        }

        /* Styling for the card title */
        /* ////////// */

        .card-img-custom {
            width: 100%;
            height: auto;
            object-fit: cover;
        }


        /* search  filter*/

        .search-result-item {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .search-result-item a {
            text-decoration: none;
            color: #333;
        }

   .text-muted,.search-result-item{
    background: white;
    padding: 6px;
    border-radius: 5px;
   }


   /* .center_size{
    margin-left: 18px;
   } */



/* @media (max-width: 425px) {
  .owl-item { 
    margin-right: 0px !important;
    margin-left:32px !important
  }
} */

/* 
@media (max-width: 425px) and (max-height: 850px) {
  .owl-item {
    margin-right: 0px !important;
    margin-left:32px !important
  }
} */
  </style>

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Elyvato",
    "alternateName": "Elyvato",
    "url": "https://elyvato.com/",
    "logo": "https://elyvato.com/front/images/icons/favicon%2032x32.png",
    "sameAs": [
      "https://www.instagram.com/elevato.tsre/",
      "https://www.linkedin.com/company/elyvato/"
    ]
  }
  </script>
</head>
<body>
<div class="wrapper ovh">
  <div class="preloader"></div>

  <!-- Main Header Nav -->
  <!-- <header class="header-nav nav-homepage-style stricky main-menu border-0 stricky-fixed slideInDown animated"> -->
  <header class="header-nav nav-innerpage-style main-menu fixed-top">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
      <div class="container posr">
        <div class="row align-items-center justify-content-between">
          <div class="col-auto px-0 px-xl-2">
            <div class="d-flex align-items-center justify-content-between">
              <div class="logos">
                <!-- <a class="header-logo logo1" href="{{url('/')}}"><img src="{{asset('front/images/logo_head.png')}}" alt="Header Logo" style="width:144px;"></a> -->
                <a class="header-logo logo2" href="{{url('/')}}"><img src="{{asset('front/images/icons/elyvato-logo-1857.png')}}" alt="Header Logo" style="width:144px;"></a>
              </div>
              <div class="home1_style at-home2">
                <div id="mega-menu">
                  <div class="text-center"><a class="btn-mega fw500 text-dark" href="{{ route('all-service') }}">
                     Services</a></div>
                  <ul class="menu ps-0">
                    @foreach (Service() as $service)

                    <li> <a class="dropdown" href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">
                       {{-- <span class="menu-icn flaticon-developer"></span> --}}
                        <span class="menu-title">   {{$service->name}}</span> </a>
                      <div class="drop-menu d-flex justify-content-between row">

                        @foreach ($service->subservices as $subservice)
                        
                        <a class="" href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
                         {{-- <span class="menu-icn flaticon-developer"></span> --}}
                          <span class="menu-title">{{ $subservice->name }}</span>
                      </a>

                        @endforeach
                      </div>
                    </li>
                    @endforeach

                  </ul>
                </div>
              </div>
              <!-- Responsive Menu Structure-->
              <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                <!-- <li class="visible_list"> <a class="list-item" href="{{url('/')}}"><span class="title">Home</span></a>

                </li> -->
                {{-- <li class="visible_list"> <a class="list-item" href="#"><span class="title">Browse Jobs</span></a>
                  <ul >
                    <li> <a href="#"><span class="title">Services</span></a>
                      <ul>
                        <li><a href="{{url('front-service')}}">Service v1</a></li>
                    
                      </ul>
                    </li>
                    
                  </ul>
                </li> --}}
                
                <li> <a class="list-item ps-1" href="{{ url('about') }}">About</a></li>
                <li> <a class="list-item" href="{{route('blog')}}">Blog</a></li>
                <li> <a class="list-item" href="{{url('contact')}}">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-auto pe-0 pe-xl-3">
            <div class="d-flex align-items-center">
              <a class="login-info mx15-xl mx30" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><span class="flaticon-loupe"></span></a>
              {{-- <a class="login-info mx15-xl mx30" href="page-become-seller.html"><span class="d-none d-xl-inline-block">Become a</span> Seller</a> --}}

              @if(Auth::check())
                    <a class="login-info mr15-xl mr30" href="{{ url('user/dashboard') }}">Dashboard</a>
                @else
                    <a class="login-info mr15-xl mr30" href="{{ url('login') }}">Sign in</a>
                    <a class="ud-btn add-joining bdrs50 text-thm2 btn-thm" href="{{ url('register') }}">Register</a>
                @endif
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
              <input type="text" class="form-control border-0" id="serviceSearchInput" placeholder="What service are you looking for today?">
              <label><span class="far fa-magnifying-glass"></span></label>
            </div>
             <div id="serviceResults" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="hiddenbar-body-ovelay"></div>

  <!-- Mobile Nav  -->
  <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
      <div class="header bdrb1">
        <div class="menu_and_widgets">
          <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
            <a class="mobile_logo" href="{{ url('/') }}"><img style="width:113px;" src="{{asset('front/images/icons/final-logo-elyvato.png')}}" alt=""></a>
            <div class="right-side text-end">
              <a class="" href="{{url('login')}}">SignIn</a>
              <a class="menubar ml30" href="#menu"><img  style="width:28px;" src="{{asset('front/images/mobile-dark-nav-icon.svg')}}" alt=""></a>
            </div>
          </div>
        </div>
        <div class="posr"><div class="mobile_menu_close_btn"><span class="far fa-times"></span></div></div>
      </div>
    </div>
    <!-- /.mobile-menu -->
    <nav id="menu" class="">
      <ul>
        <li><span><a href="{{url('/')}}">Home</a></li></span>

        </li>
        <li><span>Services</span>
          <ul>
            
              @foreach (Service() as $service)
              <li>
                <span><a class="dropdown" href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">
                {{$service->name}}
                </a>
              </span>
              <div class="drop-menu d-flex justify-content-between row" style="overflow: scroll;">

                @foreach ($service->subservices as $subservice)
                  <span> <a style="margin-left: 18px;  font-weight: 500;" href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">{{$subservice->name}}</a>  </span>
                @endforeach                                
                 
              </div>
            </li>
            @endforeach
          </ul>
        </li>
        <li><span><a href="#">Portfolio</a></li></span>
        <li><span><a href="{{url('/about')}}">About</a></li></span>
        <li><span><a href="{{url('contact')}}">Contact</a></li></span>
        <li><span><a href="{{url('login')}}">Sign In</a></li></span>
        <li><span><a href="{{url('register')}}">Register</a></li></span>
        
        <!-- Only for Mobile View -->
      </ul>
    </nav>
  </div>


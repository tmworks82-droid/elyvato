@extends('layouts.front.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <style>
        /* The slider itself - hides overflowing content */
        .logo-slider {
            overflow: hidden;
            position: relative;
            /* Creates a subtle fade effect on the sides */
            -webkit-mask-image: linear-gradient(to right, #00000000, #000000 15%, #000000 85%, #00000000);
            mask-image: linear-gradient(to right, #00000000, #000000 15%, #000000 85%, #00000000);
        }

        /* The track that holds and animates the logos */
        .logo-track {
            display: flex;
            /* Adjust width: (Number of logos including duplicates) * (width per logo) */
            width: calc(200px * 12);
            /* 6 original logos + 6 duplicates */
            animation: scroll 30s linear infinite;
        }

        /* Pause the animation on hover */
        .logo-track:hover {
            animation-play-state: paused;
        }

        /* Styling for each logo slide */
        .partner-slide {
            width: 200px;
            /* Set a fixed width for each slide */
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Styling for the brand images */
        .partner-slide img {
            max-width: 100%;
            height: 50px;
            /* Uniform height for all logos */
            object-fit: contain;
            /* filter: grayscale(100%); */
            /* Makes logos uniform,
                     removes color opacity: 0.6; */
            transition: filter 0.3s, opacity 0.3s;
        }

        /* Add color and full opacity on hover */
        .partner-slide:hover img {
            filter: invert;
            opacity: 1;
        }

        /* The keyframe animation for the infinite scroll */
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                /* Moves the track to the left by the width of the original set of logos */
                transform: translateX(calc(-200px * 6));
            }
        }

        .testimonial-style1 {
            background: #35754b;
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            height: 500px;
            padding: 40px 30px;
            /* match testimonial-color padding if required */
            box-sizing: border-box;
        }

        .testimonial-logo {
             margin-bottom: 20px;
            /*display: flex;
            justify-content: flex-start; */

            /* margin-bottom: 20px; */
            /* height: 50px; */
            /* width: 100%;
            display: flex ;
            justify-content: flex-start;
            align-items: center;
            overflow: hidden; */
        }

        .testimonial-logo img {
            /* width: 104px; */
           
            width: 154px !important;
            height: 58px;
            /* display: block; */
        }

        .testimonial-content {
            /* flex-grow: 1; */
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            margin-bottom: 0px;
            /* consistent spacing to h3 */
        }

        .t_content {
            color: white;
            margin: 0;
            font-size: 1rem;
            line-height: 1.6;
        }

        .title {
            margin-bottom: 10px;
        }


        .clickable-li {
            cursor: pointer;
        }

        .btnStyle {
            float: right;
            border: 1px solid #2c5843;
        }

        .resizeImg {
            height: 34px;
        }

        /* .enterprize {
            border-radius: 6px;
            
            max-height: 534px;
            width: 100%;
            object-fit: cover;
        } */

        .enterprize {
            border-radius: 6px;
            width: 100%;
            max-height: 400px; 
            object-fit: cover;
            object-position: center;
            display: block;
            margin: 0 auto;
        }

        .our_talent{
            border-radius: 6px;
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            object-position: center;
            display: block;
            margin: 0 auto;
        }

        .brand-img {
           
            /* max-height: 100%;
            max-width: 100%; */
            object-fit: contain;
        }

        @media (min-width: 768px) {
            .enterprise-img-col {
                display: flex;
                align-items: center;
            }
            }



            .card .text {
                white-space: inherit;
                width: fit-content;
                margin: 0 auto;
                font-size: 16px; /* or adjust */
                }
    </style>
    <!-- Home Banner Style V1 -->
    <section class="hero-home2 pb100-xs">
        <div class="container">
            <div class="row mb0-xl">
                <div class="col-xl-7">
                    <div class="pr30 pr0-lg mb30-md position-relative">
                        <h1 class="animate-up-1 mb25 text-white fs-2">Elevated content, delivered expertly! </h1>
                        <p class="text-white animate-up-2">Your business is now our responsibility <br class="d-none d-lg-block"> Access elite talent, dedicated support & assured project success</p>
            
                        <div
                            class="advance-search-tab bgc-white p10 bdrs4-sm bdrs60 banner-btn position-relative zi1 animate-up-3 mt30">
                            <div class="row">
                                <div class="col-md-5 col-lg-6 col-xl-6">
                                    <div class="advance-search-field mb10-sm">
                                        <form class="form-search position-relative">
                                            <div class="box-search">
                                                <span class="icon far fa-magnifying-glass"></span>
                                                <input class="form-control" type="text" name="search"
                                                    placeholder="What are you looking for?" autocomplete="off">
                                                <div class="search-suggestions">
                                                    <h6 class="fz14 ml30 mt25 mb-3">Popular Search</h6>

                                                    <div class="box-suggestions">
                                                        <ul class="px-0 m-0 pb-4">
                                                            @php
                                                                $subserviceCount = 0;
                                                            @endphp
                                                              @foreach (Service() as $service)
                                                                @foreach ($service->subservices as $subservice)
                                                                    @if ($subserviceCount < 5)
                                                                        <li class="clickable-li"
                                                                            data-url="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
                                                                            <div class="info-product">
                                                                                <span class="item_title">{{ $subservice->name }}</span>
                                                                            </div>
                                                                        </li>
                                                                    @php $subserviceCount++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($subserviceCount >= 5)
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-3">
                                    <div class="bselect-style1 bdrl1 bdrn-sm">
                                        <select class="selectpicker" data-width="100%" id="categorySelect">
                                            <option value="">Choose Category</option>
                                            @foreach (Service() as $service)
                                                <option value="{{ route('service-sow-list', ['slug' => $service->slug]) }}">
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-2 col-xl-3">
                                    <div class="text-center text-xl-start">
                                        <button class="ud-btn btn-thm w-100 bdrs60" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt20 animate-up-4">
                            <div class="col-xl-9">
                                <div class="row justify-content-between">
                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">1</div>
                                                </li>
                                                <li><span>M</span></li>
                                            </ul>
                                            <p class="text-white mb-0"> Content Delivered
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero pe-0">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">10</div>
                                                </li>
                                                <li><span>K+</span></li>
                                            </ul>
                                            <p class="text-white mb-0">Freelancers Contributed</p>
                                        </div>
                                    </div>


                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <li>
                                                    <div class="timer">100</div>
                                                </li>
                                                <li><span>+</span></li>
                                            </ul>
                                            <p class="text-white mb-0">Successful Projects</p>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-3 funfact_one at-home2-hero">
                                        <div class="details">
                                            <ul class="ps-0 mb-0 d-flex">
                                                <!-- <li>
                                                             <div class="timerr">Top 1%</div>
                                                         </li> -->
                                                <li><span>Top 1%</span></li>
                                            </ul>

                                            <p class="text-white mb-0">Top-tier Talent</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 d-none d-xl-block position-relative mt45">
                    <img src="{{ asset('front/images/about/about_male.png') }}" loading="lazy" alt="About Male"
                        class="animate-up-1 main-img-home2">
                    <div class="home2-hero-content position-relative">
                        <div
                            class="iconbox-small1 d-none d-xl-flex wow fadeInRight default-box-shadow4 bounce-x animate-up-1">
                            <span class="icon flaticon-review"></span>
                            <div class="details pl20">
                                <h6 class="mb-1">Proof of quality</h6>
                                <p class="text fz13 mb-0">Only the best make the cut</p>
                            </div>
                        </div>

                        <div
                            class="iconbox-small2 d-none d-xl-flex wow fadeInLeft default-box-shadow4 bounce-y animate-up-2">
                            <span class="icon flaticon-review"></span>
                            <div class="details pl20">
                                <h6 class="mb-1">Safe and secure</h6>
                                <p class="text fz13 mb-0">End-to-end protection</p>
                            </div>
                        </div>
                        {{--<img src="{{ asset('front/images/about/happy-client.png') }}" alt=""
                            class="bounce-x bdrs16 img-1 default-box-shadow4">--}}
                    </div>
                </div>

                <div class="container">
                    <div class="row wow fadeInUp">
                        <div class="col-lg-12">
                            <div class="main-title text-center mtrust pt-4">
                                <h2 class="text-light fs-4 mb-3 pt-0 pt-lg-5">Trusted by the world’s best</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row wow fadeInUp">
                        <div class="col-lg-12 trusted">
                            <!-- Integrated Logo Slider -->
                            <div class="logo-slider">
                                <div class="logo-track">
                                    <!-- Add your brand logos here -->
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/appyhigh.png') }}" alt="Partner 1">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/bhutani.png') }}" alt="Partner 2">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/bigo.png') }}"
                                            alt="Partner 3">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/byte.png') }}"
                                            alt="Partner 4">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/corteva.png') }}" alt="Partner 5">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/dow.png') }}"
                                            alt="Partner 6">
                                    </div>

                                    <!-- Duplicate the logos for a seamless loop effect -->
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/dupot.png') }}" alt="Partner 1">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/js.png') }}"
                                            alt="Partner 2">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/like.png') }}"
                                            alt="Partner 3">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/moj.png') }}"
                                            alt="Partner 4">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/mxplayer.png') }}" alt="Partner 5">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/organic.png') }}" alt="Partner 6">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/ripik-logo.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/rizzle.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/share.png') }}" alt="Partner 6">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/terriv.png') }}" alt="Partner 6">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/ticktok.png') }}" alt="Partner 6">
                                    </div>
                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/tiki.png') }}"
                                            alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/trelll.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/ucbrowser.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/ucnews.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg"
                                            src="{{ asset('front/images/partners/watchit.png') }}" alt="Partner 6">
                                    </div>

                                    <div class="partner-slide">
                                        <img class="wa m-auto resizeImg" src="{{ asset('front/images/partners/zili.png') }}"
                                            alt="Partner 6">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>

    <!-- Our Partners -->
    {{-- <section class="our-partners" style="padding: 49px 0;">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-12">
                    <div class="main-title text-center">
                        <h6>Trusted by the world’s best</h6>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp">
                <div class="col-lg-12">
                    <!-- Integrated Logo Slider -->
                    <div class="logo-slider">
                        <div class="logo-track">
                            <!-- Add your brand logos here -->
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/appyhigh.png')}}"
                                    alt="Partner 1">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/bhutani.png')}}" alt="Partner 2">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/bigo.png')}}" alt="Partner 3">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/byte.png')}}" alt="Partner 4">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/corteva.png')}}" alt="Partner 5">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/dow.png')}}" alt="Partner 6">
                            </div>

                            <!-- Duplicate the logos for a seamless loop effect -->
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/dupot.png')}}" alt="Partner 1">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/js.png')}}" alt="Partner 2">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/like.png')}}" alt="Partner 3">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/moj.png')}}" alt="Partner 4">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/mxplayer.png')}}"
                                    alt="Partner 5">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/organic.png')}}" alt="Partner 6">
                            </div>
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/ripik-logo.png')}}"
                                    alt="Partner 6">
                            </div>
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/rizzle.png')}}" alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/share.png')}}" alt="Partner 6">
                            </div>
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/terriv.png')}}" alt="Partner 6">
                            </div>
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/ticktok.png')}}" alt="Partner 6">
                            </div>
                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/tiki.png')}}" alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/trelll.png')}}" alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/ucbrowser.png')}}"
                                    alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/ucnews.png')}}" alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/watchit.png')}}" alt="Partner 6">
                            </div>

                            <div class="partner-slide">
                                <img class="wa m-auto" src="{{asset('front/images/partners/zili.png')}}" alt="Partner 6">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Need something -->
    <section class="our-features section-padding">
        <div class="container wow fadeInUp">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h2>Need something done?</h2>
                        <p class="text">We don’t chase talent. We host it. Choose, assign, pay, done.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 need-marg">
                    <div class="iconbox-style1 at-home5 p-4 text-center card-style card mb-2 mb-md-0 shadow-sm">
                        <div class="icon before-none"><span class="flaticon-cv"></span></div>
                        <div class="details">
                            <h4 class="title mt10 mb-3">Pick a Service </h4>
                            <p class="text mb-0">Browse top gigs - no fluff, just results <br class="d-none d-xxl-block">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 need-marg">
                    <div class="iconbox-style1 at-home5 p-4 text-center card card-style mb-2 mb-md-0 shadow-sm">
                        <div class="icon before-none"><span class="flaticon-web-design"></span></div>
                        <div class="details">
                            <h4 class="title mt10 mb-3"> Our Team Will Contact you</h4>
                            <p class="text mb-0">Access through us - assured quality everytime</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 need-marg">
                    <div class="iconbox-style1 at-home5 p-4 text-center card-style card mb-2 mb-md-0 shadow-sm">
                        <div class="icon before-none"><span class="flaticon-secure"></span></div>
                        <div class="details">
                            <h4 class="title mt10 mb-3">Pay Commitment Money</h4>
                            <p class="text mb-0">Deal upfront - zero surprises or hidden fee</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="iconbox-style1 at-home5 p-4 text-center card-style card mb-2 mb-md-0 shadow-sm">
                        <div class="icon before-none"><span class="flaticon-customer-service"></span></div>
                        <div class="details">
                            <h4 class="title mt10 mb-3">No Delay, No Sway</h4>
                            <p class="text mb-0"> Execution begins the very same day</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Services -->
    {{-- here popular services testimonials --}}
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">
                <div class="col-lg-12">
                    <div class="main-title">
                        <a class="ud-btn  btn-size btnStyle d-none d-sm-inline-block" href="{{ url('services') }}">View All Services</a>
                        <h2 class="title">Offered by us</h2>
                        <p class="paragraph">Most viewed all-time top-selling services .</p>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="navi_pagi_bottom_center slider-4-grid owl-carousel owl-theme">
                        @foreach (Service() as $servi)
                            <div class="item mb-3 center_size">

                                <!--here new card -->
                                <div class="custom-card-frame">
                                    <a href="{{ route('service-sow-list', ['slug' => $servi->slug]) }}">
                                        <!-- Title positioned inside the green frame -->
                                        <h5 class="card-title-custom text-light">{{ $servi->name }}</h5>

                                        <div class="image-content-area">
                                            <img src="{{ asset($servi->service_icon) }}" class="card-img-custom" loading="lazy"
                                                alt="A stylized graphic of a video editing interface on a computer monitor."
                                                onerror="this.onerror=null;this.src='https://placehold.co/400x300/fcebe4/333?text=Image+Not+Found';">
                                        </div>
                                    </a>
                                </div>
                                <!--end here -->
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end here --}}

    <!-- CTA Banner -->
    <!-- <section class="cta-banner-about2 before-none at-home2 position-relative py-0">
                 <div class="container position-relative">
                     <div class="row align-items-center">
                         <div class="col-lg-6 col-sm-6 col-xl-6 mb100-md">
                             <div class="mb30">
                                 {{-- <h5 class="text-thm">For clients</h5> --}}
                                 <h2 class="title">OUR TALENT</h2>
                             </div>
                             <p class="text textStyle">You aspire beyond the average – and so do we. <br class="d-none d-lg-block"> Elyvato is where India's top 1% of content & marketing professionals reside, the sharpest minds meticulously selected and continuously trained for unparalleled service delivery. Unlike open marketplaces, we ensure every creative solution you receive is from a proven expert, not just a freelancer. Connect with a curated league of extraordinary skill, ready to elevate your projects with consistent results.</p>

                             <a class="ud-btn btn-thm bdrs90 default-box-shadow2 mt15 mb30-sm  btn-size"
                                 href="{{ url('services') }}">View All Services</a>
                         </div>
                         <div class="col-lg-6 col-xl-6 col-sm-6">
                             <img class="home2-cta-img"   src="{{ asset('front/images/about/Talent_section__.jpg') }}" loading="lazy" alt="Talent Image">
                         </div>
                     </div>
                 </div>

             </section> -->

    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">

                <div class="col-md-6 col-sm-6">
                    <div class="feature-content p-3">
                        <h2> OUR TALENT</h2>
                        <p class="text textStyle">You aspire beyond the average – and so do we. <br
                                class="d-none d-lg-block"> Elyvato is where India's top 1% of content & marketing
                            professionals reside, the sharpest minds meticulously selected and continuously trained for
                            unparalleled service delivery. Unlike open marketplaces, we ensure every creative solution you
                            receive is from a proven expert, not just a freelancer. Connect with a curated league of
                            extraordinary skill, ready to elevate your projects with consistent results.</p>

                             <div class="list-style1">
                            <ul class="mb-0">
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i> Elite talent for high-stakes roles.
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i>Custom workflows, zero bottlenecks.
                                </li>
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i>Dedicated support from brief to delivery.
                                </li>
                                <li class="text-black fw500 mb-0"><i class="far fa-check dark-color bgc-white"></i>Ready to build smarter ?
                                </li>
                            </ul>
                        </div>


                        <a href="{{ url('services') }}"
                            class="ud-btn btn-thm bdrs90 default-box-shadow2 mt15 mb30-sm btn-size">
                            View All Services </a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 enterprise-img-col">
                    <img src="{{ url('front/images/about/Talent_section__.jpg') }}" alt="Enterprise Image" loading="lazy"
                        class="img-fluid our_talent">
                </div>
            </div>

        </div>
    </section>



    <!-- talent by category -->
    {{-- <section class="pb-0 pt0">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-9">
                    <div class="main-title2">
                        <h2 class="title">Browse talent by category</h2>
                        <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-start text-lg-end mb-4">
                        <a class="ud-btn btn-light-thm bdrs90" href="{{url('all-service')}}">All Category<i
                                class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="dots_none slider-dib-sm slider-5-grid vam_nav_style owl-theme owl-carousel">
                        <div class="item">
                            <div class="feature-style1 mb30 bdrs16">
                                <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                        src="{{asset('front/images/listings/category-1.jpg')}}" alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">1.853 skills</h6>
                                        <h5 class="text">Development & <br class="d-none d-lg-block">IT</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-style1 mb30 bdrs16">
                                <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                        src="{{asset('front/images/listings/category-2.jpg')}}" alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">1.853 skills</h6>
                                        <h5 class="text">Design & <br class="d-none d-lg-block">Creative</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-style1 mb30 bdrs16">
                                <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                        src="{{asset('front/images/listings/category-3.jpg')}}" alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">1.853 skills</h6>
                                        <h5 class="text">Digital <br class="d-none d-lg-block">Marketing</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-style1 mb30 bdrs16">
                                <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                        src="{{asset('front/images/listings/category-4.jpg')}}" alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">1.853 skills</h6>
                                        <h5 class="text">Writing & <br class="d-none d-lg-block">Translation</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="feature-style1 mb30 bdrs16">
                                <div class="feature-img bdrs16 overflow-hidden"><img class="w-100"
                                        src="{{asset('front/images/listings/category-5.jpg')}}" alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">1.853 skills</h6>
                                        <h5 class="text">Music & <br class="d-none d-lg-block">Audio</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Highest Rated Freelancers -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">
                <div class="col-md-6 col-sm-6 order-2 order-md-1">
                    <img src="{{ url('front/images/about/business_section_.jpg') }}" alt="Enterprise Image" loading="lazy"
                        class="img-fluid enterprize">
                </div>

                <div class="col-md-6 col-sm-6 order-1 order-md-2">
                    <div class="feature-content p-3">
                        <h2> ENTERPRISE</h2>
                        <p class="text textStyle">For enterprises navigating complex operations, vast data, and high-traffic
                            volumes, Elyvato offers a superior content partnership.</p>
                        <div class="list-style1">
                            <ul class="mb-0">
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i> Our
                                    commitment to quality assurance defines every interaction.
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i>Your dedicated
                                    account manager oversees every step.
                                </li>
                                <li class="text-black fw500"><i class="far fa-check dark-color bgc-white"></i>We provide
                                    end-to-end talent and project control.
                                </li>
                                <li class="text-black fw500 mb-0"><i class="far fa-check dark-color bgc-white"></i>Our
                                    platform allows you to do it all in one place.
                                </li>
                            </ul>
                        </div>
                        <a href="{{ url('services') }}"
                            class="ud-btn btn-thm bdrs90 default-box-shadow2 mt15 mb30-sm btn-size">
                            View All Services </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
        {{-- bgc-thm3 remove this class --}}
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-md-center">
                <div class="col-md-6 col-lg-4 col-xl-12">
                    <div class="testimonial-slider2 mb15 navi_pagi_bottom_center slider-3-grid owl-carousel owl-theme wow fadeInUp"
                        data-wow-delay="300ms">
                        <div class="item">
                            <div
                                class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35 testimonial-color">
                                <div class="testimonial-logo">
                                    
                                    <img class="brand-img" src="/front/images/partners/syngenta.png" alt="Syngenta Logo" />
                                </div>
                                <div class="testimonial-content">
                                    <h2 class="t_content fs-5">
                                        “Working with TMW has been an absolute pleasure. Their team's expertise, dedication,
                                        and innovative approach have consistently exceeded our expectations.”
                                    </h2>
                                </div>
                                <h3 class="title text-thm text-light fs-6">-Vishal Phadke, Digital Marketing Manager,
                                    Syngenta</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6 class="text-light">11 days</h6>
                                        <small class="text-light">to post, hire & onboard talent</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div
                                class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35 testimonial-color">
                                <div class="testimonial-logo">
                                    
                                    <img class="brand-img" src="/front/images/partners/laminar.png" alt="laminar Logo" />
                                </div>
                                <div class="testimonial-content">
                                    <h2 class="t_content fs-5">
                                        “Choosing TMW for our business outsourcing needs has been a gamechanger. Their
                                        dedication to consumer satisfaction signifies the precision of work.”
                                    </h2>
                                </div>
                                <h3 class="title text-thm text-light fs-6">-Kumar Shorav, Co-founder, Laminar Global</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6 class="text-light">50% faster</h6>
                                        <small class="text-light">launch of projects</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div
                                class="testimonial-style1 default-box-shadow1 position-relative bdrs16 mb35 testimonial-color">
                                <div class="testimonial-logo">
                                    <img class="brand-img" src="/front/images/partners/avanta.png" alt="Aivanta Logo" />
                                </div>
                                <div class="testimonial-content">
                                    <h2 class="t_content fs-5">
                                        “TMW is simply outstanding. Their expertise, dedication, and innovative approach
                                        have elevated our business to new heights.”
                                    </h2>
                                </div>
                                <h3 class="title text-thm text-light fs-6">-Karan Ahuja, Co-founder, AiVanta</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6 class="text-light">50% faster</h6>
                                        <small class="text-light">launch of projects</small>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
<script>


    document.querySelectorAll('.clickable-li').forEach(function (li) {
        li.addEventListener('click', function () {
            const url = li.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });



    document.getElementById('categorySelect').addEventListener('change', function () {
        const url = this.value;
        if (url) {
            window.location.href = url;
        }
    });

</script>
@endsection
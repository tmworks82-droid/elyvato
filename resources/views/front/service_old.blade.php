 @extends('layouts.front.app')
@section('title') {{$title}} @endsection

 @section('content')
<link rel="stylesheet" href="{{asset('front/css/magnific-popup.css')}}">

<section class="categories_list_section overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="listings_category_nav_list_menu">
              <ul class="mb0 d-flex ps-0">
                <li><a href="{{url('services')}}" class="active">All Categories</a></li>
                 @foreach (Service() as $service)
                    <li><a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{$service->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Breadcumb Sections -->
    <section class="breadcumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <div class="breadcumb-list">
                <a class="text-dark" href="{{url('/')}}">Home</a>
                <a class="text-dark" href="{{url('services')}}">Services</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @php
      $breadcrumbs = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Services', 'url' => url('services')],
      ];
    @endphp

    <x-breadcrumb-schema :breadcrumbs="$breadcrumbs" />

      <!-- Breadcumb Sections -->

      <!-- Listings All Lists -->
    <section class="pt10 pb90">
      
      <div class="container">
        <div class="row align-items-center mb20">
        <h1 class="fs-1">{{$title}}</h1>
        </div>
        <div class="row">
          @if(!empty($services))
          @foreach($services as $servi)
          <div class="col-sm-6 col-xl-3 mt-3">
            
            <!--here new card -->
                <div class="custom-card-frame">
                    <a href="{{ route('service-sow-list', ['slug' => $servi->slug]) }}">
                    <!-- Title positioned inside the green frame -->
                    <h5 class="card-title-custom text-light">{{$servi->name}}</h5>
                    
                    <!-- The inner content area with the light background -->
                    <div class="image-content-area">
                        <img src="{{asset(''.$servi->service_icon)}}" 
                             class="card-img-custom" 
                             alt="A stylized graphic of a video editing interface on a computer monitor."
                             onerror="this.onerror=null;this.src='https://placehold.co/400x300/fcebe4/333?text=Image+Not+Found';">
                    </div>
                    </a>
                </div>
            <!--end here -->
          </div>
          @endforeach
          @else
          No Service Listed
          @endif
        
        </div>
        <div class="row">
          <div class="mbp_pagination mt30 text-center">
            @if ($services->hasPages())
              <ul class="page_navigation">
                {{-- Dynamic pagination here (see above block) --}}
              </ul>
        
              <p class="mt10 mb-0 pagination_page_count text-center">
                {{ ($services->currentPage() - 1) * $services->perPage() + 1 }}
                –
                {{ min($services->currentPage() * $services->perPage(), $services->total()) }}
                of {{ $services->total() }} SOW available
              </p>
            @endif
          </div>
        </div>

      </div>
    </section>

 @endsection
@section('scripts')
 <script>
    $(document).ready(function() {
    // alert('run');
        $('.header-nav.nav-homepage-style').addClass('stricky-fixed');
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 90) {
            $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
        } else {
            $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
        }
    });

</script>

 @endsection

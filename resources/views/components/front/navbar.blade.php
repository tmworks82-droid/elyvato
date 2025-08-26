<nav class="navbar sticky-lg-top border-bottom navbar-expand-lg bg-white py-3" itemscope
  itemtype="http://schema.org/SiteNavigationElement">
  {{-- Navbar content --}}
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('front/assets/images/elyvato-header-logo.png') }}" alt="Elyvato Logo" height="35">
      <span class="visually-hidden">Elyvato</span>
    </a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>  


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      {{--<ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 gap-2 gap-lg-3 d-none d-lg-flex">--}}
      <ul class="navbar-nav ms-1 me-auto mb-2 mb-lg-0 gap-1 gap-lg-0 d-none d-lg-flex">
        <li class="nav-item dropdown adropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="/services" role="button"
            aria-expanded="false" data-bs-auto-close="outside" itemprop="url">
            <span itemprop="name">Services</span> <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            @foreach (Service() as $service)

          <li class="dropend">
            <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
            href="{{ route('service-sow-list', ['slug' => $service->slug]) }}" role="button" aria-expanded="false"
            itemprop="url"><i class="{{$service->icon}} me-2"></i><span
              itemprop="name">{{strtoupper($service->name)}}</span>
            @if(!empty($service->subservices) && count($service->subservices) > 0)
          <i class="ri-arrow-drop-right-line ms-auto"></i>
        @endif
            </a>
            @if(!empty($service->subservices) && count($service->subservices) > 0)
          

          <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
            @php
          $totalSubservices = $service->subservices;
          $totalCount = $totalSubservices->count();

          // Split into two halves
          $half = ceil($totalCount / 2);
          $firstHalf = $totalSubservices->slice(0, $half);
          $secondHalf = $totalSubservices->slice($half);
        @endphp

            <!-- First Div -->
            <div>
              @foreach ($firstHalf as $subservice)
          <li class="px-2">
          <a class="dropdown-item rounded"
            href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
            {{ $subservice->name }}
          </a>
          </li>
          @endforeach
            </div>

            <!-- Second Div -->
            <div>
              @foreach ($secondHalf as $subservice)
          <li class="px-2">
          <a class="dropdown-item rounded"
            href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
            {{ $subservice->name }}
          </a>
          </li>
          @endforeach
            </div>
            </ul>
        @endif
          </li>
      @endforeach



          </ul>
        </li>
        
        <li class="nav-item dropdown adropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="{{route('instant.hire.list')}}" role="button"
            aria-expanded="false" data-bs-auto-close="outside" itemprop="url">
            <span itemprop="name">Instant Hire</span> <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            @foreach (Hiretalent() as $talent)
             
                  <li class="dropend">
                    @if($talent->is_available==1)
                      <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
                      href="{{route('instant.hire.booking',$talent->slug)}}" role="button" aria-expanded="false"
                      itemprop="url"> <img src="{{url((string) $talent->icon)}}" alt="{{$talent->name}}"><span
                        itemprop="name" class="m-1">{{strtoupper($talent->name)}} </small>                    
                      </a>
                    @else
                      <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
                    href="{{route('comming.soon')}}" role="button" aria-expanded="false"
                    itemprop="url"> <img src="{{url((string) $talent->icon)}}" alt="{{$talent->name}}">
                    <span itemprop="name" class="m-1">{{strtoupper($talent->name)}} </small>                    
                    </a>
                    @endif
                  </li>
                
      @endforeach



          </ul>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/about" itemprop="url"><span itemprop="name">About</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog" itemprop="url"><span itemprop="name">Blog</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('case.index')}}" itemprop="url"><span itemprop="name">Case Study</span></a>
        </li>
        

        <li class="nav-item dropdown nav-search-highlight" style="margin-left:20px;">
           <form id="submitFOrm" method="GET" action="{{ url('services') }}">
          <div class="input-group border searchdiv" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="input-group-text  border-0 bg-white" id="basic-addon1">
            <i class="ri-search-2-line"></i>
          </span>
         
          <input type="text" name="search" class="form-control border-0 navbar-search-modal-input focus-shadow-none ps-0 pe-2 py-2 text-sm  form-control focus-shadow-none"
            id="serviceSearchInput" placeholder="Search" aria-label="Search"
            aria-describedby="basic-addon1" autocomplete="off">
            <button class="btn rounded-2 mb-0 btn-main" type="button" id="searchButton">
                                <i class="ri-search-2-line me-1"></i></button>
                               
        </div>
        
        <ul class="dropdown-menu" id="serviceResults">
          @foreach(Service()->take(5) as $service)
          <li class="px-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;"
            href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{$service->name}}</a></li>
        @endforeach
        </ul>
        </form>
         
        </li>
      </ul>
      {{-- mobile navigation --}}
      <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0 gap-2 gap-lg-3 d-block d-lg-none">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false" data-bs-auto-close="outside">
            Services <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            @foreach (Service() as $service)
          <li class="dropend">
            <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
            href="{{ route('service-sow-list', ['slug' => $service->slug]) }}" role="button"
            data-bs-toggle="dropdown" aria-expanded="false"><i
              class="{{$service->icon}} me-2"></i>{{$service->name}} <i
              class="ri-arrow-drop-right-line ms-auto"></i></a>
            {{--<ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
            @foreach ($service->subservices->chunk(4) as $chunk)
            <div>
              @foreach($chunk as $subservice)
              <li class="px-2"><a class="dropdown-item rounded"
                href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">{{
                $subservice->name }}</a></li>
              @endforeach
            </div>
            @endforeach
            </ul>--}}

            <ul class="dropdown-menu shadow-sm border border-light-subtle" aria-labelledby="dropdownMenuB">
            @php
          $totalSubservices = $service->subservices;
          $totalCount = $totalSubservices->count();

          // Split into two halves
          $half = ceil($totalCount / 2);
          $firstHalf = $totalSubservices->slice(0, $half);
          $secondHalf = $totalSubservices->slice($half);
        @endphp

            <!-- First Div -->
            <div>
              @foreach ($firstHalf as $subservice)
          <li class="px-2">
          <a class="dropdown-item rounded"
            href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
            {{ $subservice->name }}
          </a>
          </li>
          @endforeach
            </div>

            <!-- Second Div -->
            <div>
              @foreach ($secondHalf as $subservice)
          <li class="px-2">
          <a class="dropdown-item rounded"
            href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
            {{ $subservice->name }}
          </a>
          </li>
          @endforeach
            </div>
            </ul>

          </li>

      @endforeach

          </ul>
        </li>
        
        <li class="nav-item dropdown adropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false" data-bs-auto-close="outside">
            <span itemprop="name">Instant Hire</span> <i class="ri-arrow-drop-down-line ms-1"></i>
          </a>
          <ul class="dropdown-menu px-2 shadow-sm border border-light-subtle">
            @foreach (Hiretalent() as $talent)
              @if($talent->is_available==1)
                  <li class="dropend">
                    <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
                    href="{{route('instant.hire.booking',$talent->slug)}}" role="button" aria-expanded="false"
                    itemprop="url"> <img src="{{url((string) $talent->icon)}}" alt="icon"><span
                      itemprop="name" class="m-1">{{strtoupper($talent->name)}}</span>
                    
                    </a>
                  </li>
                  @else
                  <li class="dropend">
                    <a class="rounded dropdown-item mb-2 dropdown-toggle d-flex align-items-center"
                    href="{{route('comming.soon')}}" role="button" aria-expanded="false"
                    itemprop="url"> <img src="{{url((string) $talent->icon)}}" alt="{{$talent->name}}"><span
                      itemprop="name" class="m-1">{{strtoupper($talent->name)}}</span>
                    
                    </a>
                  </li>
                 @endif
      @endforeach



          </ul>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('case.index') }}">Case Study</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
      </ul>
      <!-- <div class="d-flex align-items-start ms-3 ms-lg-0 align-items-lg-center flex-column flex-lg-row gap-3 gap-lg-4">
        
      </div> -->
      <div class="d-flex align-items-start ms-3 ms-lg-0 align-items-lg-center flex-column flex-lg-row gap-3 gap-lg-4">
        {{-- search button --}}
        {{--<button class="navbar-search-btn p-0 d-flex align-items-center" type="button" data-bs-toggle="modal"
          data-bs-target="#navSearchModal">
          <i class="ri-search-2-line me-1 me-lg-0"></i><span class="d-inline d-lg-none">Search</span>
        </button>--}}
        

        @if(Auth::check())
      <a class="btn btn-main" href="{{ url('user/dashboard') }}">Dashboard</a>
    @else
      {{-- sign in link --}}
      <a class="nav-link" href="/login">Sign In</a>
      {{-- register button --}}
      <a class="btn btn-main" href="/register">Register</a>

    @endif
    
      </div>
    </div>
    
      <button class="btn nav-search-highlight-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
      <i class="ri-search-2-line"></i>
    </button>

  </div>
</nav>




{{-- navbar search modal --}}


 <div class="offcanvas offcanvas-start nav-search-highlight-btn" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="input-group border searchdiv mb-3">
          <span class="input-group-text  border-0 bg-white" id="basic-addon1">
            <i class="ri-search-2-line"></i>
          </span>
          <input type="text" class="form-control border-0 navbar-search-modal-input focus-shadow-none p-3 py-2  form-control focus-shadow-none"
            id="mobileServiceSearchInput" placeholder="Search" aria-label="Search"
            aria-describedby="basic-addon1" autocomplete="off">
        </div>
        
        <ul class="list-unstyled" id="mobileserviceResults">
             @foreach(Service()->take(5) as $service)
          <li class="p-2"><a class="dropdown-item rounded mb-2" style="text-wrap: pretty;"
              href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{$service->name}}</a></li>
          @endforeach
          </ul>
      </div>
    </div>
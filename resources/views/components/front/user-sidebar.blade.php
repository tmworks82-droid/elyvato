{{-- desktop navigation --}}

<div class="w-100 border rounded-2 p-3 admin-sidebar d-none d-lg-block">
  {{-- sidebar profile card --}}
  <div class="mb-3 pb-3 border-bottom">
    <div class="text-center">
      <div class="mb-3 position-relative">

        <a href="{{ route('user.profiles') }}" type="button" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Edit Profile">
          @if(!empty(GetProfile(Auth::user()->id)))
            <img src="{{  asset(GetProfile(Auth::user()->id))}}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="80" height="80">
        @else
          <img src="{{ url('front/assets/images/default_dp.png')}}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="80" height="80">
        @endif
        </a>

      </div>
      <p class="fw-bold mb-1">{{Auth::user()->name}}</p>
    </div>
  </div>

  {{-- sidebar navigation --}}
  <div class="admin-sidebar-nav">
    <ul class="list-unstyled mb-0">
        <li>
            <a href="{{url('user/dashboard')}}" class="{{ Request::is('user/dashboard') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-dashboard-fill"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{url('booking-list')}}" class="{{ Request::is('booking-list') ? 'active' : '' }} {{  Request::is('booking-details/*') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i> My Bookings</a>
        </li>
        
        <li>
            <a href="{{route('user.subscription.booking')}}" class="{{ Request::is('user/subscription-booking') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i> Subscription Bookings</a>
        </li>
        
        <li>
            <a href="{{url('payment-list')}}" class="{{ Request::is('payment-list') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-wallet-line"></i> Payments</a>
        </li>
        <li>
            <a href="{{route('user.profiles')}}" class="{{ Request::is('user/profiles') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-user-3-line"></i> Profile</a>
        </li>
        <li>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-flex align-items-center gap-2 text-danger"><i class="ri-logout-circle-r-line"></i> Sign Out</a>
        </li>
    </ul>
  </div>
</div>

{{-- off canvas or mobile navigation --}}

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    {{-- sidebar profile card --}}
    <div class="mb-3 pb-3 border-bottom">
      <div class="text-center">
        <div class="mb-3 position-relative">
          <img src="{{  GetProfile(Auth::user()->id)}}" alt="User name" class="rounded-circle" width="80" height="80">
        </div>
        <p class="fw-bold mb-1">{{Auth::user()->name}}</p>
        
      </div>
    </div>
    {{-- sidebar navigation --}}
    <div class="admin-sidebar-nav">
      <ul class="list-unstyled mb-0">
          <li>
            <a href="/user/dashboard" class="{{ Request::is('user/dashboard') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-dashboard-fill"></i> Dashboard</a>
        </li>
        <li>
            <a href="/user/bookings" class="{{ Request::is('user/bookings') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i> My Bookings</a>
        </li>
        <li>
            <a href="/user/payments" class="{{ Request::is('user/payments') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-wallet-line"></i> Payments</a>
        </li>
        <li>
            <a href="/user/profile" class="{{ Request::is('user/profile') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-user-2-line"></i> Profile</a>
        </li>
        
        <li>
            <a href="/login" class="d-flex align-items-center gap-2 text-danger"><i class="ri-logout-circle-r-line"></i> Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</div>
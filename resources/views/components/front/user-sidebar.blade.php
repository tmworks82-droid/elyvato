{{-- desktop navigation --}}
<style>
.profile-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 80px;
    height: 80px;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
}
.profile-img:hover + .profile-overlay,
.profile-overlay:hover {
    opacity: 1;
}
</style>

<div class="w-100 border rounded-2 p-3 admin-sidebar d-none d-lg-block">
  {{-- sidebar profile card --}}
  <div class="mb-3 pb-3 border-bottom">
    <div class="text-center">
      {{-- <div class="mb-3 position-relative">

        <a href="{{ route('user.profiles') }}" type="button" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Edit Profile">
          @if(!empty(GetProfile(Auth::user()->id)))
            <img src="{{  asset(GetProfile(Auth::user()->id))}}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="80" height="80">
        @else
          <img src="{{ url('front/assets/images/default_dp.png')}}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="80" height="80">
        @endif
        </a>
      </div> --}}

      <div class="mb-3 position-relative d-inline-block" style="width: 80px; height: 80px;">
        <!-- Profile Image -->
        <img src="{{ !empty(GetProfile(Auth::user()->id)) ? asset(GetProfile(Auth::user()->id)) : url('front/assets/images/default_dp.png') }}"
            alt="{{ Auth::user()->name }}"
            class="rounded-circle border profile-img"
            width="80" height="80"
            style="object-fit: cover; cursor: pointer;">

        <!-- Camera Overlay -->
        <div class="profile-overlay d-flex align-items-center justify-content-center rounded-circle">
            <i class="ri-camera-line text-white fs-4"></i>
        </div>

        <!-- Hidden File Input -->
        <input type="file" id="profileImageInput" class="d-none" accept="image/*">
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
        
        @if(Auth::user()->type=='user')
        <li>
            <a href="{{route('user.tasks.list')}}" class="{{ Request::is('task-lists') ? 'active' : '' }} {{  Request::is('task-lists/*') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i>Task List</a>
        </li>
        @else

        <li>
            <a href="{{url('booking-list')}}" class="{{ Request::is('booking-list') ? 'active' : '' }} {{  Request::is('booking-details/*') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i> My Bookings</a>
        </li>
        
        <li>
            <a href="{{route('user.subscription.booking')}}" class="{{ Request::is('user/subscription-booking') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i> Subscription Bookings</a>
        </li>
        
        <li>
            <a href="{{url('payment-list')}}" class="{{ Request::is('payment-list') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-wallet-line"></i> Payments</a>
        </li>

        @endif

        <li>
            <a href="{{route('user.profiles')}}" class="{{ Request::is('user/profiles') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-user-3-line"></i> Profile</a>
        </li>

        @if(Auth::user()->type=='user')

        <li>
            <a href="{{route('user.payment.setting')}}" class="{{ Request::is('user/payment-setting') ? 'active' : '' }} {{  Request::is('user/payment-setting/*') ? 'active' : '' }} d-flex align-items-center gap-2"><i class="ri-calendar-check-line"></i>Payment Setting</a>
        </li>

        @endif
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
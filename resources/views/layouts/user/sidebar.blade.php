<div class="dashboard__sidebar d-none d-lg-block">
    <div class="dashboard_sidebar_list">
        <p class="fz15 fw400 ff-heading pl30">Start</p>

        <div class="sidebar_list_item">
            <a href="{{url('user/dashboard')}}" class="items-center {{ request()->is('user/dashboard') ? '-is-active' : '' }}"><i class="flaticon-home mr15"></i>Dashboard</a>
        </div>

        <div class="sidebar_list_item">
            <a href="{{url('booking-list')}}" class="items-center {{ request()->is('booking-list*') ? '-is-active' : '' }}"><i class="flaticon-document mr15"></i>My Booking</a>
        </div>

        <div class="sidebar_list_item">
            <a href="#" class="items-center"> <i class="flaticon-chat mr15"></i> Message</a>
        </div>

        <div class="sidebar_list_item">
            {{-- <a href="page-dashboard-reviews.html" class="items-center"> <i class="flaticon-review-1 mr15"> </i> Reviews</a> --}}
        </div>

        <div class="sidebar_list_item">
            <a href="#" class="items-center"> <i class="flaticon-receipt mr15"></i> Invoice </a>
        </div>

        <div class="sidebar_list_item">
            <a href="{{url('payment-list')}}" class="items-center  {{ request()->is('payment-list*') ? '-is-active' : '' }}"> <i class="flaticon-dollar mr15"></i> Payments</a>
        </div>

        {{-- <div class="sidebar_list_item">
            <a href="page-dashboard-manage-project.html" class="items-center">
                <i class="flaticon-content mr15"></i>Manage Project</a>
        </div> --}}

        <p class="fz15 fw400 ff-heading pl30 mt30">Account</p>

        <div class="sidebar_list_item ">
            <a href="{{route('user.profiles')}}" class="items-center"><i class="flaticon-photo mr15"></i>My Profile</a>
        </div>

        <div class="sidebar_list_item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="items-center">
                <i class="flaticon-logout mr15"></i>Logout
            </a>
        </div>
    </div>
</div>

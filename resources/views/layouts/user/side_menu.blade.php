  <div class="col-lg-12">
              <div class="dashboard_navigationbar d-block d-lg-none">
                <div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10"></i> Dashboard Navigation</button>
                  <ul id="myDropdown" class="dropdown-content">
                    <li><p class="fz15 fw400 ff-heading mt30 pl30">Start</p></li>
                    <li><a href="{{url('user/dashboard')}}"><i class="flaticon-home mr10"></i>Dashboard</a></li>
                    <li><a href="{{url('booking-list')}}"><i class="flaticon-document mr10"></i>My Booking</a></li>
                    <li><a href="#"><i class="flaticon-chat mr10"></i>Message</a></li>
                    <li><a href="#"><i class="flaticon-receipt mr10"></i>Invoice</a></li>
                    <li><a href="{{url('payment-list')}}"><i class="flaticon-dollar mr10"></i>Payments</a></li>
                    
                    <li><a href="#"><i class="flaticon-web mr10"></i>Statements</a></li>

                    <li><p class="fz15 fw400 ff-heading mt30 pl30">Account</p></li>
                    <li class="active"><a href="{{route('user.profiles')}}"><i class="flaticon-photo mr10"></i>My Profile</a></li>
                    <li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="items-center">
                <i class="flaticon-logout mr15"></i>Logout
            </a></li>
                  </ul>
                </div>
              </div>
            </div>

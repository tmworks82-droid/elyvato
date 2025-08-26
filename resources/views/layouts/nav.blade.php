<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

      <!-- <img src="{{ URL::asset('') }}" alt="City Cab" class="brand-image img-circle elevation-3" style="opacity: .8" width= "163px;"> -->
   <Style>
       .badge-notification {
      position: relative;
      /*top: -10px;*/
      
      background-color: red;
      color: white;
      border-radius: 50%;
      padding:4px 4px;
      font-size: 10px;
      font-weight: bold;
      line-height: 1;
    }
   </Style>
      <p style="margin-left: 25%; color: #FFFFFF; margin-top: 2%;">Elyvato Content</p>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name ?? 'not found'}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(auth()->user()->hasPermission('manage_dashboard'))
            <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('dashboard') || request()->is('dasboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          @endif

          @if(auth()->user()->hasPermission('task_list'))
            <li class="nav-item {{ request()->is('task-list') ? 'menu-open' : '' }}">
              <a href="{{ route('task.list') }}" class="nav-link {{ request()->is('task-list') || request()->is('task-list') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Task List
                </p>
              </a>
            </li>
          @endif
          
             @if(auth()->user()->hasPermission('projects'))
            <li class="nav-item {{ request()->is('projects')  || request()->is('booking') || request()->is('payments') || request()->is('projects-details') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('projects') || request()->is('booking/*') || request()->is('payments/*') || request()->is('projects-details') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Projects 
                  <i class="right fas fa-angle-left"></i>
                </p>
                @if(BookingNotification()>0)
                <span class="badge-notification">new</span>
                @endif
                
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('booking') }}" class="nav-link {{ request()->is('booking')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    
                      <p> Bookings @if(BookingNotification()>0)
                    <span class="badge-notification">{{BookingNotification()}}</span>
                    @endif </p>
                      
                  </a>
                  
                </li>

                <li class="nav-item">
                  <a href="{{ url('projects') }}" class="nav-link {{ request()->is('projects')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Project</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('payments') }}" class="nav-link {{ request()->is('payments')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                      <p> Payments </p>
                  </a>
                </li>

              </ul>
            </li>
          @endif
          


          @if(auth()->user()->hasPermission('manage_users'))
            <li class="nav-item {{ request()->is('admin_user')
                    || request()->is('admin_user/*')
                    || request()->is('users')
                    || request()->is('users/*')
                    || request()->is('role')
                    || request()->is('role/*')
                    || request()->is('permission')
                    || request()->is('permission/*')
                    || request()->is('permission_role')
                    || request()->is('permission_role/*')
                    || request()->is('service')
                    || request()->is('service/*')
                    || request()->is('subServices')
                    || request()->is('subServices/*')
                    || request()->is('statement*')
                    || request()->is('statement/*')
                    || request()->is('initial-payment-setting*')
                    || request()->is('initial-payment-setting/*')
                    || request()->is('workflow*')
                    || request()->is('user-profile/*')
                    || request()->is('create-user-profile*')
                    || request()->is('gst-rate/*')
                    || request()->is('gst-rate')
               
                    || request()->is('currency*')
                    || request()->is('currency/*')
                    || request()->is('country*')
                    || request()->is('country/*')
                    || request()->is('create-sub-services*')
                    || request()->is('create-sub-services/*')
                    || request()->is('create-statement*')
                    || request()->is('create-statement/*')
                    || request()->is('state*')
                    || request()->is('state/*')
                    || request()->is('city*')
                    || request()->is('city/*')
                    
                    || request()->is('case-study')
                    || request()->is('case-study/*')
                    || request()->is('blogs')
                    || request()->is('blogs/*')
                    || request()->is('create-blog')
                    || request()->is('create-blog/*')
                    || request()->is('edit-blog')
                    || request()->is('edit-blog/*')
                    || request()->is('faq') 
                    || request()->is('faq/*') 
                    || request()->is('create-faq/*') 
                    || request()->is('create-faq') 
                    || request()->is('edit-faq/*')
                    || request()->is('edit-faq')
                    || request()->is('hire-talent/*') 
                    || request()->is('hire-talent')
                    || request()->is('edit-hire-talent/*') 
                    || request()->is('edit-hire-talent')
                    || request()->is('create-hire-talent/*') 
                    || request()->is('create-hire-talent')


                    ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('admin_user')
                    || request()->is('admin_user/*')
                    || request()->is('users')
                    || request()->is('users/*')
                    || request()->is('role')
                    || request()->is('role/*')
                    || request()->is('permission')
                    || request()->is('permission/*')
                    || request()->is('permission_role')
                    || request()->is('permission_role/*')
                    || request()->is('service')
                    || request()->is('service/*')
                    || request()->is('subServices')
                    || request()->is('subServices/*')
                    || request()->is('statement/*')
                    || request()->is('statement')
                    || request()->is('initial-payment-setting')
                    || request()->is('initial-payment-setting/*')
                    || request()->is('user-profile')
                    || request()->is('create-user-profile/*')
                    || request()->is('gst-rate')
                    || request()->is('gst-rate/*')
                    
                    || request()->is('currency/*')
                    || request()->is('country/*')
                    || request()->is('create-sub-services/*')
                    || request()->is('create-statement/*')
                    || request()->is('state/*')
                    || request()->is('city/*')
                    || request()->is('case-study/')
                    || request()->is('case-study/*')
                    || request()->is('blogs/')
                    || request()->is('blogs/*')
                     || request()->is('create-blog')
                    || request()->is('create-blog/*')
                    || request()->is('edit-blog')
                    || request()->is('edit-blog/*')
                    || request()->is('faq') 
                    || request()->is('faq/*') 
                    || request()->is('create-faq/*') 
                    || request()->is('create-faq') 
                    || request()->is('edit-faq/*')
                    || request()->is('edit-faq')
                    || request()->is('hire-talent/*') 
                    || request()->is('hire-talent')
                    || request()->is('edit-hire-talent/*') 
                    || request()->is('edit-hire-talent')
                    || request()->is('create-hire-talent/*') 
                    || request()->is('create-hire-talent')


                    ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Masters
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin_user.index') }}" class="nav-link {{ request()->is('admin_user') || request()->is('admin_user/*') || request()->is('case-study/*') || request()->is('case-study/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Users</p>
                  </a>
                </li>



                {{-- <li class="nav-item">
                  <a href="{{ url('users') }}" class="nav-link {{ request()->is('users')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Users</p>
                  </a>
                </li> --}}


                <li class="nav-item">
                  <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('role') || request()->is('role/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('permission.index') }}" class="nav-link {{ request()->is('permission') || request()->is('permission/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permission</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('permission_role.index') }}" class="nav-link {{ request()->is('permission_role') || request()->is('permission_role/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role Permission</p>
                  </a>
                </li>
          @endif


       {{-- here services  --}}

       @if(auth()->user()->hasPermission('services'))
            <li class="nav-item {{ request()->is('service') || request()->is('service/*') || request()->is('create-sub-services/*') || request()->is('subServices') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('service') || request()->is('service/*') || request()->is('create-sub-services') || request()->is('subServices') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Services Setting
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ url('service') }}" class="nav-link {{ request()->is('service')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Service</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ url('subServices') }}" class="nav-link {{ request()->is('subServices')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                      <p>Sub-Service</p>
                  </a>
                </li>

              </ul>
            </li>
          @endif

       {{-- here end services  --}}
       

          @if(auth()->user()->hasPermission('setting'))
            <li class="nav-item {{ request()->is('initial-payment-setting') || request()->is('statement/*') || request()->is('statement') || request()->is('gst-rate/*') || request()->is('gst-rate') || request()->is('currency') || request()->is('create-statement') || request()->is('case-study/*') || request()->is('case-study') || request()->is('blogs/*') || request()->is('blogs') || request()->is('blogs/*') || request()->is('blogs') || request()->is('create-blog/*') || request()->is('create-blog') || request()->is('edit-blog/*') || request()->is('edit-blog') || request()->is('faq') || request()->is('create-faq') || request()->is('edit-faq/*') || request()->is('hire-talent/*') || request()->is('hire-talent') || request()->is('edit-hire-talent/*') 
                    || request()->is('edit-hire-talent')
                    || request()->is('create-hire-talent/*') 
                    || request()->is('create-hire-talent')
                    ? 'menu-open' : '' }}">

              <a href="#" class="nav-link {{ request()->is('initial-payment-setting') || request()->is('statement') || request()->is('gst-rate/*')  || request()->is('create-statement') || request()->is('case-study/*') || request()->is('case-study') || request()->is('blogs/*') || request()->is('blogs')  ||  request()->is('faq') || request()->is('create-faq') || request()->is('edit-faq/*') || request()->is('hire-talent/*') || request()->is('hire-talent')  || request()->is('edit-hire-talent/*') 
                    || request()->is('edit-hire-talent')
                    || request()->is('create-hire-talent/*') 
                    || request()->is('create-hire-talent')
                    ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">

                @if(auth()->user()->hasPermission('show_initial_payment_setting'))
                  <li class="nav-item">
                    <a href="{{ url('initial-payment-setting') }}" class="nav-link {{ request()->is('initial-payment-setting')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Initial Payment Settings</p>
                    </a>
                  </li>
                  @endif

                  @if(auth()->user()->hasPermission('statement'))
                  <li class="nav-item">
                    <a href="{{ url('statement') }}" class="nav-link {{ request()->is('statement')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Statement Of Works</p>
                    </a>
                  </li>
                @endif

                  @if(auth()->user()->hasPermission('show_gst_rate'))
                  <li class="nav-item">
                    <a href="{{ url('gst-rate') }}" class="nav-link {{ request()->is('gst-rate')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>GST Rates</p>
                    </a>
                  </li>
                  @endif

                  @if(auth()->user()->hasPermission('faq'))
                  <li class="nav-item">
                    <a href="{{ url('faq') }}" class="nav-link {{ request()->is('faq') || request()->is('create-faq') || request()->is('edit-faq/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Faq</p>
                    </a>
                  </li>
                  @endif

                  @if(auth()->user()->hasPermission('case-study'))
                  <li class="nav-item">
                    <a href="{{ url('case-study') }}" class="nav-link {{ request()->is('case-study')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Case Study</p>
                    </a>
                  </li>
                  @endif

                  @if(auth()->user()->hasPermission('blog'))
                  <li class="nav-item">
                    <a href="{{ route('post.blog') }}" class="nav-link {{ request()->is('blogs') || request()->is('create-blog') || request()->is('edit-blog/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Blog</p>
                    </a>
                  </li>
                  @endif
                  
                  @if(auth()->user()->hasPermission('hire_talent'))
                  <li class="nav-item">
                    <a href="{{ route('admin.hire.talent') }}" class="nav-link {{ request()->is('hire-talent') || request()->is('create-hire-talent') || request()->is('edit-hire-talent/*')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Hire Talent</p>
                    </a>
                  </li>
                  @endif
                  

                  @if(auth()->user()->hasPermission('store_currency'))
                  <li class="nav-item">
                    <a href="{{ url('currency') }}" class="nav-link {{ request()->is('currency')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Currency Setting</p>
                    </a>
                  </li>
                  @endif

              </ul>
            </li>
            @endif

            {{-- // here email setting  --}}

            {{-- @if(auth()->user()->hasPermission('services'))
            <li class="nav-item {{ request()->is('service') || request()->is('service/*') || request()->is('create-sub-services/*') || request()->is('subServices') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('service') || request()->is('service/*') || request()->is('create-sub-services') || request()->is('subServices') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Email Setting
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ url('service') }}" class="nav-link {{ request()->is('service')  ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Email Template</p>
                  </a>
                </li>

              </ul>
            </li>
          @endif --}}

          @if(auth()->user()->hasPermission('manage_location'))
            <li class="nav-item {{ request()->is('state') || request()->is('state/*') || request()->is('city/*') || request()->is('city') || request()->is('country') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->is('state') || request()->is('state/*') || request()->is('city/*') || request()->is('city') || request()->is('country') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Location
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('state.index') }}" class="nav-link {{ request()->is('state') || request()->is('state/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>State</p>
                  </a>
                </li>

                {{--<li class="nav-item">
                  <a href="{{ route('city.index') }}" class="nav-link {{ request()->is('city') || request()->is('city/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>City</p>
                  </a>
                </li>--}}

                <li class="nav-item">
                  <a href="{{ route('country') }}" class="nav-link {{ request()->is('country') || request()->is('country/*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Country</p>
                  </a>
                </li>

              </ul>
            </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

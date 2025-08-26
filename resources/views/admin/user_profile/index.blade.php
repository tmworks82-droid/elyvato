@php
    $page_name = 'User Profile';
    $routeUrl = 'statement';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'ElyvatoContent| '.$page_name.' list')
<style>
    
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d12323;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #4CAF50; /* Green for "live" */
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }} page</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">{{ $page_name }}</li>
              </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    
    



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
          @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_name }} data</h3>
                    @if(auth()->user()->hasPermission('create_'.$permission))
                      <a class="float-right" href="{{url('create-user-profile')}}" >
                          <button type="button" class="btn btn-block btn-primary btn-sm">Add New</button>
                      </a>
                    @endif
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Company Name</th>
                      <th>GST Number</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Country</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($profiles) && count($profiles) > 0)
                      @foreach($profiles as $profile)
                        <tr>
                          <td>{{ $profile->user->name ?? 'N/A' }}</td>
                          <td>{{ $profile->company_name }}</td>
                          <td>{{ $profile->gst_number }}</td>
                          <td>{{ $profile->city }}</td>
                          <td>{{ $profile->state }}</td>
                          <td>{{ $profile->country }}</td>
                          <td>
                            @if($profile->is_active == '1')
                              <span class="badge bg-success">Active</span>
                            @else
                              <span class="badge bg-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('/user-profiles/edit/' . $profile->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ url('/user-profiles/delete/' . $profile->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this profile?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="8" class="text-center">No records found.</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                   
                </ul>

                
              </div>
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          
        </div>
        
        
        
        








      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->




        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
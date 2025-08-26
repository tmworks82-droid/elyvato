@php
    $page_name = 'Create User profile';
    $routeUrl = 'create-statement';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'City Cab Dashboard | '.$page_name.' list')
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">{{ $page_name }}</li>
              <li class="breadcrumb-item active">Create New</li>
      
            </ol>
            

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
          
        <section class="content">
    

      <div class="container mt-4">
        <div class="card">
          <div class="card-header bg-info text-white">
            <h3 class="card-title">Add Service</h3>
          </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
              <form method="POST" action="{{ route('store.user.profile') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $profiles->id ?? '' }}">
            
                <div class="row">
                    <!-- User Dropdown -->
                    <div class="mb-3 col-md-4">
                        <label for="user_id" class="form-label">User</label>
                        <select class="form-select form-control" id="user_id" name="user_id" required>
                            <option value="">Select User</option>
                            @if(!empty($user) && count($user) > 0)
                                @foreach($user as $u)
                                    <option value="{{ $u->id }}" {{ isset($profiles) && $profiles->user_id == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
            
                    <!-- Company Name -->
                    <div class="mb-3 col-md-4">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required value="{{ $profiles->company_name ?? '' }}">
                    </div>
            
                    <!-- GST Number -->
                    <div class="mb-3 col-md-4">
                        <label for="gst_number" class="form-label">GST Number</label>
                        <input type="text" class="form-control" id="gst_number" name="gst_number" value="{{ $profiles->gst_number ?? '' }}">
                    </div>
            
                    <!-- Address Line 1 -->
                    <div class="mb-3 col-md-4">
                        <label for="address_line1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" id="address_line1" name="address_line1" value="{{ $profiles->address_line1 ?? '' }}">
                    </div>
            
                    <!-- Address Line 2 -->
                    <div class="mb-3 col-md-4">
                        <label for="address_line2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="address_line2" name="address_line2" value="{{ $profiles->address_line2 ?? '' }}">
                    </div>
            
                    <!-- City -->
                    <div class="mb-3 col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ $profiles->city ?? '' }}">
                    </div>
            
                    <!-- State -->
                    <div class="mb-3 col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{ $profiles->state ?? '' }}">
                    </div>
            
                    <!-- Country -->
                    <div class="mb-3 col-md-4">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $profiles->country ?? '' }}">
                    </div>
            
                    <!-- Pincode -->
                    <div class="mb-3 col-md-4">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" id="pincode" name="pincode" value="{{ $profiles->pincode ?? '' }}">
                    </div>
            
                    <!-- Industry Type -->
                    <div class="mb-3 col-md-4">
                        <label for="industry_type" class="form-label">Industry Type</label>
                        <input type="text" class="form-control" id="industry_type" name="industry_type" value="{{ $profiles->industry_type ?? '' }}">
                    </div>
            
                    <!-- Is Active -->
                    <div class="mb-3 col-md-4">
                        <label for="is_active" class="form-label">Is Active</label>
                        <select class="form-select form-control" id="is_active" name="is_active">
                            <option value="1" {{ isset($profiles) && $profiles->is_active == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ isset($profiles) && $profiles->is_active == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            
                <button type="submit" name="button" value="save user profile" class="btn btn-primary mt-3">Save Profile</button>
            </form>
            
      </div>
        </div>
      </div>

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

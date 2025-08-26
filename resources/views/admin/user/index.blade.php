@php
    $page_name = 'User';
    $routeUrl = 'users';
    $permission = 'user';
@endphp
@extends('layouts.main')

@section('title', 'Elyvato Content  Admin Dashboard | Manage your complete requirements of ElyvatoContent')

@section('content')

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="card-title">{{ $page_name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $page_name }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
    <!-- Main content -->
<section class="content">
  <div class="container mt-4">
    <div class="card">
      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif


      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Create User</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
          @csrf
          <div class="row">
            <!-- Name -->
            <div class="mb-3 col-md-4">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Email -->
            <div class="mb-3 col-md-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="mb-3 col-md-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Role -->
            <div class="mb-3 col-md-4">
              <label for="role" class="form-label">Role</label>
            
              <select class="form-select form-control" id="role" name="role" required>
                @if(!empty($role))
                @foreach($role as $ro)
                <option value="{{$ro->id}}">{{$ro->name}}</option>
                @endforeach
                @endif
              </select>
            </div>

            <!-- Phone -->
            <div class="mb-3 col-md-4">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <!-- Company Name -->
            <div class="mb-3 col-md-4">
              <label for="company_name" class="form-label">Company Name</label>
              <input type="text" class="form-control" id="company_name" name="company_name">
            </div>

            <!-- Is Active -->
            <div class="mb-3 col-md-4">
              <label for="is_active" class="form-label">Is Active</label>
              <select class="form-select form-control" id="is_active"  name="is_active" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>

          <button type="submit" name="button" value="save user" class="btn btn-success mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<div class="row">
  <div class="col-md-12">
 
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $page_name }} data</h3>
        </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Role</th>
              <th>Phone</th>
              <th>Company Name</th>
              <th>Status</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
     
    </div>
    <!-- /.card -->

    
  </div>
  <!-- /.col -->
  
</div>
     
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('scripts')

  

<script>
       
    </script>


@endpush

<!-- <script src="{{ URL::asset('jquery/js/jquery-3.6.0.min.js') }}"></script> -->





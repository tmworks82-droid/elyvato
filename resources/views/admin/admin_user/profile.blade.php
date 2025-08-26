@php
$page_name = 'Profile';

$permission = 'profile';
@endphp

@extends('layouts.main')
@section('title', 'User Elyvato Dashboard | '.$page_name.' list')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Update Profile</li>
                        <!-- <li class="breadcrumb-item active">Create New</li> -->
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Admin User</h3>
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

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif


                        <form action="{{ route('update.profile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- /.card-header -->
                            <div class="row card-body">
                                {{-- <div class="col-sm-4 form-group">
                      <label>Select Role</label>
                      <select class="form-control select2 select2-danger" name="role_id" id="role_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option value="" >Select Role</option>
                          @foreach($roles as $item)
                                <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
                                @endforeach
                                </select>
                            </div> --}}

                            <div class="col-sm-4 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Enter name">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter email">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Mobile:</label>
                                <input type="number" class="form-control" id="mobile" name="mobile" value="{{ Auth::user()->mobile }}" placeholder="Enter mobile">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Profile Picture:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

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
                                <select class="form-control" name="city" id="city">
                                    <option value="">Select City</option>
                                    @foreach($city as $item)
                                    <option value="{{ $item->name }}" {{ (isset($profiles->city) && $profiles->city == $item->id) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- State -->
                            <div class="mb-3 col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-control" name="state" id="state">
                                    <option value="">Select State</option>
                                    @foreach($state as $item)
                                    <option value="{{ $item->name }}" {{ (isset($profiles->state) && $profiles->state == $item->id) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Country -->
                            <div class="mb-3 col-md-4">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-control" name="country" id="country">
                                    <option value="">Select Country</option>
                                    @foreach($country as $item)
                                    <option value="{{ $item->name }}" {{ (isset($profiles->country) && $profiles->country == $item->id) ? 'selected' : '' }}>
                                        {{ $item->country_name }}
                                    </option>
                                    @endforeach
                                </select>
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


                            <div class="col-sm-4 form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter password">
                            </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" name="button" value="update user profile" class="btn btn-primary">Submit</button>
                    </div>

                    </form>
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
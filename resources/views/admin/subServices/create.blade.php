@php
    $page_name = 'Sub Service';
    $routeUrl = 'service';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'Elyvato Dashboard | '.$page_name.' list')
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
            <h3 class="card-title">Add SubService</h3>
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
        <form method="POST" action="{{ route('subservices.store') }}" enctype="multipart/form-data">
          @csrf
          @if(!empty($subservice))
          <input type="hidden" name="id" value="{{ $subservice->id }}">
        @endif
          <div class="row">
            <!-- Service (dropdown from Services) -->
           <!-- Service Dropdown -->

            <div class="mb-3 col-md-4">
              <label for="service_id" class="form-label">SubService</label>
              <select class="form-select form-control" id="service_id" name="service_id" required>
                <option value="">Select Service</option>
                @if(!empty($service))
                  @foreach($service as $ser)
                    <option value="{{ $ser->id }}"
                      {{ (!empty($subservice) && $subservice->service_id == $ser->id) ? 'selected' : '' }}>
                      {{ $ser->name }}
                    </option>
                  @endforeach
                @endif
              </select>
            </div>

            <!-- Subservice Name -->
            <div class="mb-3 col-md-4">
              <label for="name" class="form-label">Subservice Name</label>
              <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $subservice->name ?? '') }}" required>
            </div>

            <div class="mb-3 col-md-4">
              <label for="image" class="form-label">SubService Image (400x400)</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg">
              @if(!empty($subservice->subservice_icon))
                <img src="{{ asset($subservice->subservice_icon) }}" alt="Service Image" width="100">
              @endif
            </div>

            <!-- Description -->
            <div class="mb-3 col-md-4">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $subservice->description ?? '') }}</textarea>
            </div>

            <div class="mb-3 col-md-4">
              <label class="form-label d-block">Is Active</label>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="active" value="1"
                  {{ (isset($subservice) && $subservice->is_active == 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Active</label>
              </div>

              <div class="form-check form-check-inline">

                <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0"
                  {{ (isset($subservice) && $subservice->is_active == 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="inactive">Inactive</label>
              </div>
            </div>

          </div>

          <button type="submit" name="button" value="save subservice" class="btn btn-dark mt-3">Save Subservice</button>
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

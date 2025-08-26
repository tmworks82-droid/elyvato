@php
    $page_name = 'Statement';
    $routeUrl = 'create-statement';
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

        <form method="POST" action="{{route('initial-payment-settings.store') }}">
            @csrf
              <input type="hidden" name="id" value="{{$setting->id ?? ''}}">

            <div class="row">
              <!-- Minimum Percentage -->
              <div class="mb-3 col-md-4">
                <label for="min_percentage" class="form-label">Minimum Percentage</label>
                <input type="number" class="form-control" id="min_percentage" name="min_percentage"
                      value="{{ old('min_percentage', $setting->min_percentage ?? '') }}"
                      step="0.01" required>
              </div>

              <!-- Maximum Percentage -->
              <div class="mb-3 col-md-4">
                <label for="max_percentage" class="form-label">Maximum Percentage</label>
                <input type="number" class="form-control" id="max_percentage" name="max_percentage"
                      value="{{ old('max_percentage', $setting->max_percentage ?? '') }}"
                      step="0.01" required>
              </div>

              <!-- Is Active -->
              <div class="mb-3 col-md-4">
                <label for="is_active" class="form-label">Is Active</label>
                <select class="form-select form-control" id="is_active" name="is_active" required>
                  <option value="1" {{ old('is_active', $setting->is_active ?? '') == '1' ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ old('is_active', $setting->is_active ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>
            <button type="submit" name="save initial payment setting " class="btn btn-info mt-3">Save Settings</button>
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

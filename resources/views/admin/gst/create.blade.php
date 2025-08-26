@php
    $page_name = 'Gst Rate';
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
                <form method="POST" action="{{ route('gst-rates.store') }}">
                  @csrf
              <input type="hidden" name="id" value="{{$gst->id ??''}}">
                  <div class="row mb-3">
                      <div class="col-md-4">
                          <label for="rate" class="form-label">Rate</label>
                          <input type="number" step="0.01" class="form-control" id="rate" name="rate" value="{{$gst->rate ??''}}" placeholder="Enter GST rate" required>
                      </div>
                      
                      <div class="col-md-6">
                          <label for="description" class="form-label">Description</label>
                          <textarea name="description" id="description" cols="80" rows="3" >{{$gst->description ??''}}</textarea>
                      </div>

                      <div class="col-md-4">
                          <label for="is_active" class="form-label">Is Active</label>
                          <select class="form-select form-control" id="is_active" name="is_active" required>
                            <option value="1" {{ old('is_active', $gst->is_active ?? '') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $gst->is_active ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                          </select>
                      </div>
                  </div>
                  <button type="submit" name="button" value="save gst" class="btn btn-primary">Submit</button>
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

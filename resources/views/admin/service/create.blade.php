@php
    $page_name = 'Service Create';
    $routeUrl = 'service';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'Service Create | '.$page_name.' list')
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
            <form method="POST" action="{{ route($routeUrl.'.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- Name -->
                <div class="mb-3 col-md-4">
                  <label for="name" class="form-label">Service Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>


                <div class="mb-3 col-md-4">
                    <label for="image" class="form-label">Service Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" required>
                  </div>

                  <div class="mb-3 col-md-4">
                    <label for="image" class="form-label">Service Image (400x400)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg" required>
                  </div>

                <!-- Description -->
                <div class="mb-3 col-md-4">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3 col-md-4">
                  <label class="form-label d-block">Is Active</label>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_active" id="active" value="1"
                      >
                    <label class="form-check-label" for="active">Active</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0"
                      >
                    <label class="form-check-label" for="inactive">Inactive</label>
                  </div>
                </div>

                <!-- SEO Title -->
                <div class="mb-3 col-md-6">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control"
                        value="{{ old('seo_title', $statement->seo_title ?? '') }}" required>
                </div>

                 <!-- Meta Description -->
                <div class="mb-3 col-md-6">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" required>{{ old('meta_description', $statement->meta_description ?? '') }}</textarea>
                </div>


              </div>

              <button type="submit" name="button" value="save service" class="btn btn-primary mt-3">Save Service</button>
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
@push('scripts')
<script>
  $('#name').on('input', function () {
        let titleVal = $(this).val();
      $('#seo_title').val(titleVal);
      
    });

     $('#description').on('input', function () {
        let titleVal = $(this).val();
      $('#meta_description').val(titleVal);
      
    });

</script>
@endpush
@php
    $page_name = 'Case Study Create';
    $routeUrl = 'case.study';
    $permission = 'case-study';
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
            <h3 class="card-title">Add Case Study</h3>
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
                <!-- Title -->
                 @if(!empty($CaseStudy))
                    <input type="hidden" name="id" value="{{$CaseStudy->id}}">
                 @endif
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $CaseStudy->title ?? '') }}" required>
                </div>

                <!-- Slug -->
                <div class="mb-3 col-md-6">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control"
                        value="{{ old('slug', $CaseStudy->slug ?? '') }}" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="slug" class="form-label">Project Type</label>
                    <input type="text" name="project_type" id="project_type" class="form-control"
                        value="{{ old('slug', $CaseStudy->project_type ?? '') }}" required>
                </div>

                <!-- Featured Image -->
                <div class="mb-3 col-md-6">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                    @if(isset($CaseStudy) && !empty($CaseStudy->featured_image))
                        <img src="{{ asset( $CaseStudy->featured_image) }}" alt="Image" class="mt-2" width="100">
                    @endif
                </div>

                <div class="mb-3 col-md-4">
                     <label for="is_featured" class="form-label">Is Featured</label>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="is_featured" id="is_featured" value="{{ old('slug', $CaseStudy->is_featured ?? '') }}" @if(!empty($CaseStudy->is_featured) && $CaseStudy->is_featured==1) checked @endif>
                      <label class="form-check-label" for="is_featured">Yes</label>
                    </div>

                  </div>

              <button type="submit" name="button" value="save case-study" class="btn btn-primary mt-3">Save</button>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace('content');
</script>
@endpush

@php
    $page_name = 'Blog Create';
    $routeUrl = 'blog';
    $permission = 'blog';
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
            <h3 class="card-title">Add Blog</h3>
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
                 @if(!empty($blog))
                    <input type="hidden" name="id" value="{{$blog->id}}">
                 @endif
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $blog->title ?? '') }}" required>
                </div>

                <!-- Slug -->
                {{--<div class="mb-3 col-md-6">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control"
                        value="{{ old('slug', $blog->slug ?? '') }}" required>
                </div>--}}
               @php
                // Check if $blog exists and has 'category', else default to empty array
                $selectedCategories = [];
            
                if (isset($blog) && !empty($blog->category)) {
                    $selectedCategories = is_array($blog->category) 
                        ? $blog->category 
                        : json_decode($blog->category, true);
                }
            @endphp
            
            <!-- Category -->
            <div class="mb-3 col-sm-6">
                <label class="form-label d-block">Select Categories/Services</label>
            
                @foreach(Service() as $item)
                    <div class="form-check">
                        <input class="form-check-input"
                            type="checkbox"
                            name="category[]"
                            value="{{ $item->id }}"
                            id="service_{{ $item->id }}"
                            {{ in_array($item->id, $selectedCategories) ? 'checked' : '' }}>
                        <label class="form-check-label" for="service_{{ $item->id }}">
                            {{ $item->name }}
                        </label>
                    </div>
                    <br>
                @endforeach
            </div>


                <!-- Featured Image -->
                <div class="mb-3 col-md-6">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                    @if(!empty($blog) && !empty($blog->featured_image ))
                        <img src="{{ asset( $blog->featured_image) }}" alt="Image" class="mt-2" width="100">
                    @endif
                </div>

                <!-- SEO Title -->
                <div class="mb-3 col-md-6">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control"
                        value="{{ old('seo_title', $blog->seo_title ?? '') }}" required>
                </div>
                
                <div class="mb-3 col-md-6">
                  <label class="form-label d-block">Is Active</label>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="active" value="1"
                    @if(!empty($blog) && $blog->is_active == 1) checked @endif required>
                <label class="form-check-label" for="active">Active</label>
            </div>
            
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0"
                    @if(!empty($blog) && $blog->is_active == 0) checked @endif required>
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
        </div>
                

                <!-- Meta Description -->
                <div class="mb-3 col-md-6">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" required>{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                </div>

                    <!-- Content -->
                    <div class="mb-3 col-sm-12">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $blog->content ?? '') }}</textarea>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace('content');
</script>
@endpush

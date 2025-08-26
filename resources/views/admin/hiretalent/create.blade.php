@php
    $page_name = 'Hire Talent Create';
   
    $permission = 'hire_talent';
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
            <form method="POST" action="{{ route('store.hire.talent') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <!-- Title -->
                 @if(!empty($hiretalent))
                    <input type="hidden" name="id" value="{{$hiretalent->id}}">
                 @endif
                <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('title', $hiretalent->name ?? '') }}" required>
                </div>


                 <div class="mb-3 col-md-6">
                    <label for="featured_image" class="form-label"> Icon</label>
                    <input type="file" name="icon" id="icon" class="form-control">
                    @if(isset($hiretalent) && !empty($hiretalent->icon))
                        <img src="{{ asset( $hiretalent->icon) }}" alt="icon" class="mt-2" width="100">
                    @endif
                </div>
                
                <!-- Featured Image -->
                <div class="mb-3 col-md-6">
                    <label for="featured_image" class="form-label"> Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if(isset($hiretalent) && !empty($hiretalent->image))
                        <img src="{{ asset( $hiretalent->image) }}" alt="Image" class="mt-2" width="100">
                    @endif
                </div>

                <div class="mb-3 col-md-3">
                <label for="is_active" class="form-label mt-2">Is Active</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" 
                           name="is_active" id="is_active_yes" value="1"
                           {{ old('is_active', $hiretalent->is_active ?? 1) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active_yes">Yes</label>
                </div>
            
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" 
                           name="is_active" id="is_active_no" value="0"
                           {{ old('is_active', $hiretalent->is_active ?? 1) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active_no">No</label>
                </div>
            </div>
            
            <div class="mb-3 col-md-3">
                <label for="is_available" class="form-label mt-2">Is Available</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" 
                           name="is_available" id="is_available" value="1"
                           {{ old('is_available', $hiretalent->is_available ?? 1) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available">Yes</label>
                </div>
            
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" 
                           name="is_available" id="is_available_no" value="0"
                           {{ old('is_available', $hiretalent->is_available ?? 1) == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_available_no">No</label>
                </div>
            </div>
            

                  
                  <div class="mb-3 col-md-12">
                    <label for="featured_image" class="form-label">Content</label> <br>
                    <textarea name="content" id="content" rows="4" cols="50">
                        {{$hiretalent->content ?? ''}}
                    </textarea>
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


<script>

    // CKEDITOR.replace('content');
</script>
@endpush

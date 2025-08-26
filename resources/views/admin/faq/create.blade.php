@php
    $page_name = 'Faq Create';
    $routeUrl = 'faq';
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
            <h3 class="card-title">Add Faq</h3>
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
                    @if(!empty($faqs) && $faqs->id)
                        <input type="hidden" name="id" value="{{ $faqs->id }}">
                    @endif

                 <div class="mb-3 col-sm-12">
                    <label for="page_name" class="form-label">Select Faq Page</label>
                    <select name="page_name" id="page_name" class="form-select form-control" required>
                        <option value="contact-us" {{ (isset($faqs) && $faqs->page_name == 'contact-us') ? 'selected' : '' }}>Contact Us</option>
                        <option value="blog" {{ (isset($faqs) && $faqs->page_name == 'blog') ? 'selected' : '' }}>Blog</option>
                        <option value="about" {{ (isset($faqs) && $faqs->page_name == 'about') ? 'selected' : '' }}>About</option>
                        <option value="gig-details" {{ (isset($faqs) && $faqs->page_name == 'gig-details') ? 'selected' : '' }}>Gig Details</option>
                    </select>
                  </div>

                    <!-- Question -->
                    <div class="mb-3 col-sm-12">
                        <label for="question" class="form-label">Question </label>
                        <input type="text" class="form-control" id="question" name="question" value="{{ isset($faqs) ? $faqs->question : '' }}" required>
                    </div>

                    <!-- Answer -->
                    <div class="mb-3 col-sm-12">
                        <label for="description" class="form-label">Answer</label>
                        <textarea class="form-control" id="description" name="answer" rows="3">{{ isset($faqs) ? $faqs->answer : '' }}</textarea>
                    </div>


                <div class="mb-3 col-md-4">
                  <label class="form-label d-block">Is Active</label>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_active" id="active" value="1"
                      {{ (isset($faqs) && $faqs->is_active == 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0"
                      {{ (isset($faqs) && $faqs->is_active == 0) ? 'checked' : '' }}>
                    <label class="form-check-label" for="inactive">Inactive</label>
                  </div>
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

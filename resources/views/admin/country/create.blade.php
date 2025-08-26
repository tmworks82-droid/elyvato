@php
    $page_name = 'City';
    $routeUrl = 'city';
    $permission = 'city';
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create {{ $page_name }}</h3>
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
                <form id="countryForm" action="{{route('store.country')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ old('title', $country->id ?? '') }}">
                        <!-- Country Name -->
                        <div class="mb-3 col-4">
                          <label for="country_name" class="form-label">Country Name</label>
                          <input type="text" name="country_name" id="country_name" class="form-control" value="{{ old('title', $country->country_name ?? '') }}" required>
                        </div>
                  
                        <!-- Country Image -->
                        <div class="mb-3 col-4">
                          <label for="image" class="form-label">Country Image</label>
                          <input type="file" name="image" id="image" class="form-control" accept="image/*">
                          @if(isset($country) && $country->image)
                          <img src="{{ asset('upload/' . $country->image) }}" width="60" class="mt-2">
                             @endif
                        </div>
                
                        <!-- Currency -->
                        <div class="mb-3 col-4">
                          <label for="currency" class="form-label">Currency</label>
                          <input type="text" name="currency" id="currency" class="form-control" value="{{ old('currency', $country->currency ?? '') }}" required>
                        </div>
                  
                        <!-- Title -->
                        <div class="mb-3 col-4">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" name="title" id="title" value="{{ old('title', $country->title ?? '') }}" class="form-control">
                        </div>
                  

                        <!-- Country Code -->
                        <div class="mb-3 col-4">
                          <label for="country_code" class="form-label">Country Code</label>
                          <input type="text" name="country_code" id="country_code" class="form-control" value="{{ old('country_code', $country->country_code ?? '') }}" required>
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Country</button>
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

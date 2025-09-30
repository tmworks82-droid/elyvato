@php
  $page_name = 'Enquiry';
  $routeUrl = 'faq';
  $permission = 'enquiry';
@endphp

@extends('layouts.main')
@section('title', 'Service | ' . $page_name . ' list')

@section('content')
  <style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #d12323;
      -webkit-transition: .4s;
      transition: .4s;
    }


    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: #fff;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
    background-color: #4CAF50;
    /* Green for "live" */
    }

    input:focus+.slider {
    box-shadow: 0 0 1px #4CAF50;
    }

    input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $page_name }} page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ $page_name }}</li>
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
        @if(session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
      @endif
        @if(session('error'))
      <div class="alert alert-danger">
      {{ session('error') }}
      </div>
      @endif
        <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $page_name }} data</h3>
        

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
          <thead>
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Service</th>
            <th>Message</th>
            </tr>
          </thead>
          <tbody>
            @php $i=1; @endphp
        @forelse($contacts as $index => $contact)
        <tr>
         
        <td>{{ $i++ }}</td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->phone }}</td>
        <td>{{ $contact->service->title ?? '' }}</td>
        <td>{{ $contact->message}}</td>
        
        </tr>
        @empty
        <tr>
        <td colspan="5">No FAQs found.</td>
        </tr>
        @endforelse
          </tbody>
          </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
          @php
      $results = $contacts;
      $previousPage = $results->currentPage() > 1 ? $results->currentPage() - 1 : null;
      $nextPage = $results->hasMorePages() ? $results->currentPage() + 1 : null;
      @endphp

          <ul class="pagination pagination-sm m-0 float-right">
          @if ($previousPage)
        <li class="page-item">
        <a class="page-link" href="?page={{ $previousPage }}">&laquo;</a>
        </li>
      @endif

          @for ($i = 1; $i <= $results->lastPage(); $i++)
        <li class="page-item {{ $i == $results->currentPage() ? 'active' : '' }}">
        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
        </li>
      @endfor

          @if ($nextPage)
        <li class="page-item">
        <a class="page-link" href="?page={{ $nextPage }}">&raquo;</a>
        </li>
      @endif
          </ul>
        </div>

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
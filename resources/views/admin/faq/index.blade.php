@php
  $page_name = 'Faq';
  $routeUrl = 'faq';
  $permission = 'faq';
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
          @if(auth()->user()->hasPermission('create_' . $permission))
        <a class="float-right" href="{{ route($routeUrl . '.create') }}">
        <button type="button" class="btn btn-block btn-primary btn-sm">Add New</button>
        </a>
      @endif

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
          <thead>
            <tr>
            <th>#</th>
            <th>Page Name</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($faqs as $index => $faq)
        <tr>
        <td>{{ $faqs->firstItem() + $index }}</td>
        <td>{{ ucfirst(str_replace('-', ' ', $faq->page_name)) }}</td>
        <td>{{ $faq->question }}</td>
        <td>{{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 50) }}</td>
        <td>
          <!-- Replace with actual route names -->
          <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </td>
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
      $results = $faqs;
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
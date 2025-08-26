@php
    $page_name = 'Dashboard';
    $routeUrl = 'dashboard';
    $permission = 'dashboard';
@endphp
@extends('layouts.main')

@section('title', 'Elyvato Content  Admin Dashboard | Manage your complete requirements of ElyvatoContent')

@section('content')
  <style>
    .alert-container {
      position: relative;
      display: inline-block;
    }

    .badge-notification {
      position: absolute;
      top: -10px;
      
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 5px 10px;
      font-size: 14px;
      font-weight: bold;
      line-height: 1;
    }
  </style>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="card-title">{{ $page_name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $page_name }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
  
      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">

        @if($booking>0)
            <div class="">
                <div class="alert alert-warning mb-0">
                  <strong>Notification.</strong>You have new bookings awaiting your attention.
                </div>
                <div class="badge-notification">{{$booking}}</div>
          </div>
        @endif


        </div>
        <div class="card-body" style="background:#f4f4f6">
          <div class="row">
          <div class="col-sm-3">
              
      </div>
      
            <div class="col-md-12 col-12">
               <div class="card"> 
                <div class="card-header"> 
                  <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Elyvato Content</h3>
                   <div class="card-tools"> 
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i>
                   </button> 
                  </div> 
                </div> 
                <div class="card-body">
                <div class="chart-container">
                  <!-- Labels Section -->
                  <div class="chart-labels">
                    
                  </div>

                  <!-- Chart Section -->
                  <div class="chart-area">
                      <canvas id="pieChart"></canvas>
                  </div>
              </div>
                </div> <!-- /.card-body --> 
              </div>
            </div>
            
          </div><!-- lead row end -->
        
      </div>
      <!-- /.card body-->
    </div> <!-- /.card -->


    </section>
    <!-- /.content -->
     
  </div>
  <!-- /.content-wrapper -->
@endsection

@push('scripts')
         <script>
    // Pass Laravel route to JS
    window.toggleClockUrl = "{{ url('toggle-clock') }}";
</script>


@endpush

<!-- <script src="{{ URL::asset('jquery/js/jquery-3.6.0.min.js') }}"></script> -->





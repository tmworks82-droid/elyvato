@php
    $page_name = 'Currency';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'ElyvatoContent| '.$page_name.' list')
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

    input:checked + .slider {
        background-color: #4CAF50; /* Green for "live" */
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
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
@section('content')
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
            <div class="col-sm-12">
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
                    <div class="card-body">
                    <form id="currencyForm" action="{{route('store.currency')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label>Currency Name</label>
                                <input type="text" name="currency_name" id="currency_name" class="form-control">
                            </div>
                        <div class="col-sm-4 mb-3">
                            <label>Currency Code</label>
                            <input type="text" name="currency_code" id="currency_code" class="form-control" required>
                        </div>
                
                        <div class="col-sm-4 mb-3">
                            <label>Currency Symbol</label>
                            <input type="text" name="currency_symbol" id="currency_symbol" class="form-control" required>
                        </div>
                
                        
                
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
          <div class="col-md-12">
          
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Currency Name</th>
                            <th>Currency Code</th>
                            <th>Currency Symbol</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencies as $currency)
                        <tr>
                            <td>{{ $currency->currency_name }}</td>

                            <td>{{ $currency->currency_code }}</td>
                            <td>{{ $currency->currency_symbol }}</td>
                            <td>
                                <button class="btn btn-sm bg-warning" onclick="Edit('{{ $currency->currency_name }}','{{ $currency->currency_code }}', '{{ $currency->currency_symbol }}',  '{{ $currency->id }}')">Edit</button>

                                <form action="{{ route('currencies.destroy', $currency->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
              </table>
              
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                   
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
@push('scripts')

<script>
    function Edit(name,code,symbol,id){
      $('#currency_name').val(name);
      $('#currency_code').val(code);
      $('#currency_symbol').val(symbol);
      $('#id').val(id);

      // Optional: Scroll smoothly to the form
    $('html, body').animate({
        scrollTop: $("#currencyForm").offset().top
    }, 500);

    }
</script>

@endpush
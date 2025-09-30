@php
    $page_name = 'Support Department';
    $permission = 'support_department';
@endphp

@extends('layouts.main')
@section('title', 'ElyvatoContent| ' . $page_name . ' list')
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Form -->
                                <form id="departmentForm" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Department Name:</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                                    </div>
                                    <input type="hidden" name="id" id="id">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                                </form>
                                <div id="response"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                {{-- here new  --}}

                <div class="card tab-pane fade show active" id="project-tab-1">
                    <div class="container-fluid mt-4">
                        <!-- Tabs Navigation -->
                        <div class="card-header">
                            <h3 class="card-title">{{ $page_name }}</h3>
                            
                        </div>

                                <div class="card">
                                   
                                    <div class="card-body">
                                        

                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Created On</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                  @if(!empty($departments) && count($departments)>0)
                                                  @foreach($departments as $department)
                                                  <tr>
                                                    <td>{{$department->name}}</td>
                                                    <td>{{formatDateReadable($department->created_at)}}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="Edit(`{{$department->id}}`,`{{$department->name}}`)">Edit</button>
                                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{$department->id}}">Delete</button>
                                                    </td>
                                                  </tr>
                                                  @endforeach
                                                  @else
                                                  <tr>
                                                    <td>Not Found</td>
                                                    @endif
                                                  </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>

                <!-- Bootstrap JS for tabs (make sure this is included once in your layout) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
          
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

        
        $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
            var projectId = $(this).data('id'); 
            $('#project_id').val(projectId); 
        });

        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("due_date").setAttribute('min', today);
        });


        // here is department save

        $(document).ready(function() {

            $('#departmentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = $(this).serialize(); 

                $.ajax({
                    url: "{{ route('save.support.department') }}", 
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status==true){
                             // close modal
                            $('#departmentForm')[0].reset();
                             $.toast({
                                heading: 'Success',
                                text: response.msg,
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                            }).then(function() {
                                window.location.reload();
                            });
                        }else{
                            $.toast({
                                heading: 'Error',
                                text: response.msg || 'Something went wrong!',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position: 'top-right'
                            });
                        }
                    },
                    error: function(xhr) {
                        // Error handling
                        alert('Something went wrong!');
                        console.log(xhr.responseText); // for debugging
                    }
                });
            });

     // Event listener for delete button
        $('.delete-btn').click(function(){
            
            var recordId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this record?')) {
                
                $.ajax({
                    url: '/delete-record/' + recordId, 
                    type: 'DELETE',
                    data: {
                        
                        _token: '{{ csrf_token() }}', 
                    },
                    success: function(response) {
                        
                        $('#row-' + recordId).remove();
                        
                         $.toast({
                                heading: 'Success',
                                text: 'Record deleted successfully!',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                            }).then(function() {
                                window.location.reload();
                            });
                    },
                    error: function() {
                        $.toast({
                                heading: 'warning',
                                text: 'Error deleting faild!',
                                showHideTransition: 'slide',
                                icon: 'danger',
                                position: 'top-right',
                            })
                    }
                });
            }
        });

        });


        function Edit(id,name){
            $('#name').val(name);
            $('#id').val(id);
        }


</script>
@endpush

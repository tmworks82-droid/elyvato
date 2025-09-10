@php
    $page_name = 'Freelance List';
    $permission = 'freelance';
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
                    <div class="col-md-12">

                        <!-- /.card -->
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
                                                        <th>Email</th>
                                                        <th>Mobile</th> 
                                                        <th>Is Hired</th>
                                                        <th>Created On</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @if (!empty($freelancers) && count($freelancers) > 0)
                                                        @foreach ($freelancers as $freelancer)
                                                            <tr>
                                                                <td>{{ $freelancer->name }}</td>
                                                                <td> {{ $freelancer->email }} </td>
                                                                <td>{{$freelancer->mobile}}</td>
                                                                <td>
                                                                    @if($freelancer->is_hired=='yes')
                                                                        <span class="badge badge-success">Hired</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Not Hired</span>
                                                                    @endif
                                                                </td>
                                                                
                                                                <td> {{ \Carbon\Carbon::parse($freelancer->created_at)->format('M j, Y') }} </td>
                                                                <td>
                                                                    <a href="{{ route('talent.rating', $freelancer->id) }}" class="btn btn-sm bg-warning"> <i class="fas fa-solid fa-eye"></i></a>
                                                                  
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>

                <!-- Bootstrap JS for tabs (make sure this is included once in your layout) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                {{-- here end  --}}

                {{-- here task details modal  --}}

                <!-- Task Details Modal -->
                <div class="modal fade" id="taskDetailsModal" tabindex="-1" role="dialog"
                    aria-labelledby="taskDetailsLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="taskDetailsLabel">Task Details <span class="badge badge-success btn_status"></span> </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <small class="text-muted">
                                        By <strong> <span id="taskTitle"></span> </strong> <span id="taskBy"></span>
                                    </small>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Assigned</label>
                                                <input type="text" class="form-control" id="taskAssignee" readonly>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Due Date</label>
                                                <input type="text" id="taskDueDate" class="form-control"  readonly>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Description</label>
                                                <textarea class="form-control" rows="5" id="taskDescription" readonly>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <h6>Quick actions</h6>
                                            <div class="d-flex flex-column">
                                                <input type="hidden" name="id" id="task_id">

                                                <button class="btn btn-outline-primary btn-sm mb-2 mark_as_complete" name="button" value="Mark Completed Task">Mark Complete</button>

                                                <button class="btn btn-outline-danger btn-sm mb-2 delete-task-btn" data-type="review" data-task-id="{{ $task->id ?? '' }}"  name="button" value="Request for Review">Request for Review</button>
                                               @if(auth()->user()->hasPermission('delete_task'))
                                                    <button class="btn btn-outline-danger btn-sm delete-task-btn" data-type="delete" name="button" value="Delete Task" data-task-id="{{ $task->id ?? '' }}">Delete</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <strong>Comments:</strong>
                                    <div id="comment-list" class="mt-3">

                                    </div>
                                    <h6>Comments</h6>
                                    <div class="media mt-2">
                                        <div class="media-body">
                                            <textarea id="commit-comment" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                                            <button name="button" id="commit-btn" class="btn btn-sm btn-info float-right mt-2" value="comment in task" data-task-id="{{ $task->id ?? '' }}">Commit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

        // When "Create Milestone" button is clicked
        $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
            var projectId = $(this).data('id'); // get data-id value
            $('#project_id').val(projectId); // set into hidden input
        });


        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("due_date").setAttribute('min', today);
        });


        $(document).on('change', '#project_status', function() {
            //alert('run');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let status = $(this).val();
            let projectId = $(this).data('id');

            $.ajax({
                url: "{{ url('/projects/update-status') }}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: status,
                    id: projectId
                },
                success: function(response) {
                    $.toast({
                        heading: 'Success',
                        text: response.success,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    })
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error updating status.');
                }
            });
        });

        // here is milstone save

        $(document).ready(function() {

            $('#milestoneForm').on('submit', function(e) {
                e.preventDefault(); // prevent normal form submit

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = $(this).serialize(); // get form data

                $.ajax({
                    url: "{{ route('milestone.store') }}", // your Laravel route
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // for Laravel CSRF protection
                    },
                    success: function(response) {
                        // Success actions
                        // $('#milestoneModal').modal('hide'); // close modal
                        // $('#milestoneForm')[0].reset(); // clear form

                        if(response.status==true){

                            $('#milestoneModal').modal('hide'); // close modal
                            $('#milestoneForm')[0].reset();

                             $.toast({
                                heading: 'Success',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                            })

                        }else{
                            $.toast({
                                heading: 'Error',
                                text: response.message || 'Something went wrong!',
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
        });

        // here create a task
        $('#taskForm').submit(function(e) {
            e.preventDefault(); // stop the form from submitting normally

            var formData = new FormData(this);
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $.ajax({
                url: "{{ route('task.create') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                beforeSend: function() {
                    // Optionally, you can disable the submit button to prevent multiple clicks
                    $('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function(response) {
                    // Close modal, reset form, show success message
                    $('#taskForm')[0].reset();
                    $('#taskModal').modal('hide'); // If your modal ID is taskModal
                    $.toast({
                        heading: 'Success',
                        text: response.success,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    });
                    setTimeout(function () {
                            location.reload();
                        }, 2000);
                },
                error: function(xhr) {
                    // Handle errors
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "Something went wrong!\n";

                    if (errors) {
                        $.each(errors, function(key, value) {
                            errorMessage += value + "\n";
                        });
                    }

                    alert(errorMessage);
                },
                complete: function() {
                    // Enable button again
                    $('button[type="submit"]').prop('disabled', false).text('Save Task');
                }
            });
        });

        // asssign Account manager here
        $('#accountManagerForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('assign.accountmanager') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#accouintmanagerModal').modal('hide');

                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                        // Optionally reload part of page or table
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    alert(errorMessage);
                }
            });
        });

        // asssign employee here
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('assign.employee') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#EmployeeModal').modal('hide');
                        // alert(response.message);

                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                        // Optionally reload part of page or table
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value + '\n';
                    });
                    alert(errorMessage);
                }
            });
        });

        // here show task details modal

        $(document).ready(function () {
            $('.view-task-btn').click(function () {
                let taskId = $(this).data('id');
                let button=$(this).val();
                $("#task_id").val(taskId);

                //  alert(taskId);

                $.ajax({
                    url: '{{ route('task.details') }}',
                    method: 'GET',
                    data: { id: taskId,button:button },
                    success: function ( response ) {
                        $('#taskTitle').text(response.title);
                        $('#taskBy').text('By ' + response.created_by);
                        $('#taskAssignee').val(response.assignee);
                        $( '#taskDueDate' ).val(response.due_date);
                        $('#taskDescription').val(response.description);
                        $('.btn_status').text(response.status);

                        const c = response.task_history;

                        // console.log(c);

                        $('#comment-list').empty();  // Add to top of the list

                        let html = '';

                        c.forEach(function(item){
                            html += `
                                <div class="card mb-2">
                                    <div class="card-body p-2">
                                        <p class="mb-1">${item.comment}</p>
                                        <small class="text-muted">By: ${item.created_by?.name || 'Unknown'} | ${item.updated_on}</small>
                                    </div>
                                </div>
                            `;
                        });

                        $('#comment-list').prepend(html);  // here list comments in the list
                        $('#commit-comment').val('');      // Clear textarea
                    },
                    error: function () {
                        alert('Failed to fetch task data.');
                    }
                });
            });


            // here marked as completed

           // Global AJAX setup for CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.mark_as_complete').click(function () {
            let taskId = $("#task_id").val();
            let button=$(this).val();

            $.ajax({
                url: '{{ route('marked.complete') }}',
                method: 'POST',
                data: { id: taskId,button:button },
                success: function (response) {
                    if(response.status==true){
                            $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }else{
                        $.toast({
                            heading: 'faild',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right',
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function () {
                    alert('Failed to update.');
                }
            });
        });

        });

        // here commint
    $(document).on('click', '#commit-btn', function () {
            let comment = $('#commit-comment').val();
            let taskId = $(this).data('task-id');
            let button=$(this).val();

            if (comment.trim() === '') {
                alert('Please enter a comment.');
                return;
            }

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/task-history/commit', // Laravel route
            method: 'POST',
            data: {
                task_id: taskId,
                comment: comment,
                button:button,
                is_commit: 'yes',
                tsk_status: 'committed',
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function (response) {
                // alert('Comment committed!');
                if(response.status==true){
                    $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                }
                $('#commit-comment').val(''); // clear textarea
            },
            error: function () {
                alert('Failed to save comment.');
            }
        });
    });

// here delte task

$(document).on('click', '.delete-task-btn', function () {
    let taskId = $(this).data('task-id');
    let type = $(this).data('type');
    let button=$(this).val();

    if (!confirm('Are you sure you want to proceed '+ type)) return;

    $.ajax({
        url: '/task-history/delete',
        method: 'POST',
        data: {
            task_id: taskId,type:type,button:button,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            if(response.status==true){
                $.toast({
                    heading: 'Success',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right',
                });
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        },
        error: function () {
            alert('Failed to delete.');
        }
    });
});



// request milestone payment
$(document).on('click', '.request_milestone', function () {
    let dataId = $(this).data('id');
    button=$(this).val();

    // alert(dataId);
    if (!confirm('Are you sure you want to Send Payment request ?')) return;

    $.ajax({
        url: '/milestone/request',  // Adjust this route if needed
        method: 'POST',
        data: {
            id: dataId,button:button,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if(response.status==true){
                $.toast({
                    heading: 'Success',
                    text: response.message,
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right',
                });
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        },
        error: function () {
            alert('Failed to request.');
        }
    });
});


</script>
@endpush

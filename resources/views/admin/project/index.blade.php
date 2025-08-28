@php
    $page_name = 'My Projects';
    $permission = 'project';
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



    .project-link {
        font-weight: bold;
        /* Bold for unvisited links */
        color: #2e2e39;
        /* Color for unvisited links */
        text-decoration: none;
        /* Remove underline */
    }

    .project_link_visited {
        font-weight: normal;
        /* Normal weight for visited links */

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
                        <h1>{{ $page_name }}</h1>
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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card">

                            <!-- Filter Header -->
                            <form method="GET" action="{{ route('projects') }}" class="flex space-x-4">
                                @csrf
                                <div class="row flex justify-end items-center space-x-4 p-4">
                                    <!-- Service Dropdown -->
                                    <div class="col-sm-3 form-group">
                                        <select name="service_id" class="border rounded p-2 fomrm-control">
                                            <option value="">All Services</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}"
                                                    {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        <!-- Sub-Service Dropdown (optional dynamic via AJAX) -->
                                        <select name="sub_service_id" class="border p-2 rounded form-control">
                                            <option value="">All Sub-Services</option>
                                            @foreach ($sub_services as $sub_service)
                                                <option value="{{ $sub_service->id }}"
                                                    {{ request('sub_service_id') == $sub_service->id ? 'selected' : '' }}>
                                                    {{ $sub_service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        <!-- Status Filter -->
                                        <select name="status" class="border p-2 rounded form-control">
                                            <option value="">All Status</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="completed"
                                                {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="not_started"
                                                {{ request('status') == 'not_started' ? 'selected' : '' }}>Not Started
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        <select name="account_manager" class="border p-2 rounded form-control">
                                            <option value="">Account Manager</option>
                                            @foreach ($account_manager as $manager)
                                                <option value="{{ $manager->id }}">
                                                    {{ $manager->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        <select name="employee" class="border p-2 rounded form-control">
                                            <option value="">Employee</option>
                                            @foreach ($employeeUser as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ request('employee') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button class="btn btn-md btn-warning mt-3">Filter</button>
                                </div>
                            </form>

                            <div class="card-header">
                                <h3 class="card-title"> {{ $page_name }} data </h3>
                                {{-- <button type="button" class="btn btn-success btn-sm open-task-modal float-right"  data-toggle="modal" data-target="#taskModal">
                      Create Task
                    </button> --}}

                                <button class="btn btn-sm bg-warning create_project float-right" data-id="id"
                                    data-toggle="modal" data-target="#create_project_modal">
                                    Create Project
                                </button>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer Info</th>
                                            <th>Project Info</th>
                                            <th>Price</th>
                                            <th>Initial Paid Amount</th>
                                            <th>Booked On</th>
                                            <th>Booking Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 1;
                                        @endphp

                                        @foreach ($projects as $project)
                                            <tr>
                                                <td> {{ $k++ }}</td>
                                                <td>
                                                    @if ($project->is_visited == 'no')
                                                        <a href="{{ url('projects-details', $project->id) }}"
                                                            class="project-link" data-type="project"
                                                            data-id="{{ $project->id }}"> <span
                                                                class="badge badge-info">{{ GetUser($project->created_by)->name ?? GetUser($project->created_by)->username }}
                                                            </span> </a>
                                                    @else
                                                        <a href="{{ url('projects-details', $project->id) }}"> <span
                                                                class="badge badge-info">{{ GetUser($project->booking->user_id)->name ?? GetUser($project->booking->user_id)->username }}</span>
                                                        </a>
                                                    @endif
                                                    ({{ GetUser($project->booking->user_id)->mobile }})
                                                </td>

                                                <td>
                                                    @if ($project->is_visited == 'no')
                                                        <a href="{{ url('projects-details', $project->id) }}"
                                                            target="_blank" class="project-link" data-type="project"
                                                            data-id="{{ $project->id }}">
                                                            @if (!empty($project->booking->sow))
                                                                {{ $project->booking->sow->service->name ?? 'no service' }}
                                                                -> {{ $project->booking->sow->subservice->name ?? 'N/A' }}
                                                                <br> {!! trimWords($project->booking->sow->description) !!}
                                                            @else
                                                                {{ $project->booking->hireTalent->name }}
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a href="{{ url('projects-details', $project->id) }}"
                                                            target="_blank" class="project_link_visited">
                                                            @if (!empty($project->booking->sow))
                                                                {{ $project->booking->sow->service->name }} ->
                                                                {{ $project->booking->sow->subservice->name }} <br>
                                                                {!! trimWords($project->booking->sow->description) !!}
                                                            @else
                                                                {{ $project->booking->hireTalent->name }}
                                                            @endif
                                                        </a>
                                                    @endif
                                                </td>

                                                <td>{{ $project->booking->total_price ?? 'NA' }}</td>
                                                <td>{{ $project->booking->initial_paid_amount ?? 'NA' }}</td>
                                                <td>{{ formatDateReadable($project->booking->created_on) ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($project->booking->booking_type == 'predefined_gig')
                                                        <span class="badge badge-info">Predefined Gig</span>
                                                    @elseif($project->booking->booking_type == 'custom_gig')
                                                        <span class="badge badge-info">Custom Gig</span>
                                                    @else
                                                        <span class="badge badge-info">Instant Hire</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($project->project_status == 'not_started')
                                                        <span class="badge badge-warning">Not Started</span>
                                                    @elseif($project->project_status == 'active')
                                                        <span class="badge badge-info">Active</span>
                                                    @else
                                                        <span class="badge badge-success">Completed</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <select name="project_status" id="project_status" class="project-status" data-id="{{ $project->id }}"> --}}
                                                    <select name="project_status" class="project-status"
                                                        data-id="{{ $project->id }}">
                                                        <option value="not_started"
                                                            {{ $project->project_status == 'not_started' ? 'selected' : '' }}>
                                                            Not Started</option>
                                                        <option value="active"
                                                            {{ $project->project_status == 'active' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="completed"
                                                            {{ $project->project_status == 'completed' ? 'selected' : '' }}>
                                                            Completed</option>

                                                    </select>

                                                    {{-- <button type="button" class="btn btn-primary btn-sm float-right" data-id="{{$project->id}}" data-toggle="modal" data-target="#milestoneModal">
                            Create Milestone
                          </button> --}}
                                                    {{-- <a href="{{url('projects-details', $project->id)}}" class="btn btn-sm btn-warning"> <i class="fas fa-solid fa-eye"></i> </a> --}}
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

                <!-- Milestone Modal -->
                <div class="modal fade" id="milestoneModal" tabindex="-1" role="dialog"
                    aria-labelledby="milestoneModalLabel" aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="milestoneModalLabel">Create Milestone</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form id="milestoneForm" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" id="project_id">

                                <div class="modal-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <!-- Due Date -->
                                    <div class="mb-3">
                                        <label class="form-label">Due Date</label>
                                        <input type="date" name="due_date" id="due_date" class="form-control"
                                            required>
                                    </div>

                                    <!-- Amount -->
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="number" name="amount" class="form-control" step="0.01"
                                            required>
                                    </div>


                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-response">Save Milestone</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>


                <!-- Task Create Modal -->
                <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="taskForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="taskModalLabel">Create Task</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- Hidden Milestone ID -->
                                    <input type="hidden" name="milestone_id" id="task_milestone_id">
                                    
                                    <div class="form-group">
                                        <label for="milestone_id">Select Milestone</label>
                                        <select name="milestone_id" id="milestone_id" class="form-control" required>
                                            <option value="">Select Milestone</option>
                                            @if (!empty($milestone) && count($milestone))
                                                @foreach ($milestone as $mil)
                                                    <option value="{{ $mil->id }}">{{ $mil->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Assign To -->
                                    <div class="form-group">
                                        <label for="assign_to">Assign To</label>
                                        <select name="assign_to" id="assign_to" class="form-control" required>
                                            <option value="">Select User</option>
                                            @if (!empty($users) && count($users))
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Title -->
                                    <div class="form-group">
                                        <label for="task_title">Title</label>
                                        <input type="text" name="title" id="task_title" class="form-control"
                                            required>
                                    </div>

                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="task_description">Description</label>
                                        <textarea name="description" id="task_description" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>

                                            <option value="todo">Todo</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="submitted">Submitted</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>

                                    <!-- Progress -->
                                    <div class="form-group">
                                        <label for="progress">Progress (%)</label>
                                        <input type="number" name="progress" id="progress" class="form-control"
                                            min="0" max="100" value="0" required>
                                    </div>

                                    <!-- Submitted for Review -->
                                    <div class="form-group">
                                        <label for="submitted_for_review">Submitted for Review</label>
                                        <select name="submitted_for_review" id="submitted_for_review"
                                            class="form-control" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Task</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </form>
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


    <div class="modal fade" id="create_project_modal" tabindex="-1" role="dialog"
        aria-labelledby="create_project_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_project_modal">Create New Project <span
                            class="badge badge-success btn_status"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="create_project_form">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Booking </label>
                                        <select name="booking" id="booking" class="form-control" required>
                                            <option value="">Select Booking</option>
                                            @foreach ($bookings as $booking)
                                                <option value="{{ $booking->id }}">{{ $booking->booking_id }} (
                                                    {{ GetUser($booking->user_id)->username }} )</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Select Account Manager </label>
                                        <select name="account_manager" id="account_manager" class="form-control"
                                            required>
                                            <option value="">Select Manager</option>
                                            @foreach ($account_manager as $manager)
                                                <option value="{{ $manager->id }}">
                                                    {{ $manager->name }}
                                                </option>
                                            @endforeach
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Select Employee </label>
                                        <select name="employee" id="employee" class="form-control" required>
                                            <option value="">Select Employee</option>
                                            @foreach ($employeeUser as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Project Status </label>
                                        <select name="project_status" id="project_status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="not_started">Not Started</option>
                                            <option value="active">Active</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="5" name="project_description" id="project_description">
                                                </textarea>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" value="create a new project"
                                class="btn btn-md btn-warning float-right btn-create">Create Project</button>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


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


        $(document).on('change', '.project-status', function() {
            const status = $(this).val();
            const projectId = $(this).data('id');

            if (!status || !projectId) {
                alert('Invalid data');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/projects/update-status') }}",
                method: 'POST',
                data: {
                    status: status,
                    id: projectId
                },
                success: function(response) {
                    $.toast({
                        heading: 'Success',
                        text: 'Project status updated to ' + status,
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                        afterShown: function() {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    });
                },
                error: function() {
                    alert('Error updating project status.');
                }
            });
        });



        // here create project 
        $('#create_project_form').on('submit', function(e) {
            e.preventDefault();

            let $btn = $('.btn-create');
            $btn.prop('disabled', true).text('Processing...');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('create.project.details') }}",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {

                    if (response.success == true) {


                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',

                            afterShown: function() {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        })
                        $btn.prop('disabled', false).text('Create Project');

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: response.message || 'Something went wrong!',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right'
                        });
                        $btn.prop('disabled', false).text('Create Project');
                    }

                },
                error: function(xhr) {
                    // Error handling
                    alert('Something went wrong!');
                    console.log(xhr.responseText); // for debugging
                    $btn.prop('disabled', false).text('Create Project');
                }
            });
        });


        // here is milstone save

        $(document).ready(function() {

            $('#milestoneForm').on('submit', function(e) {
                e.preventDefault(); // prevent normal form submit

                let $btn = $('.btn-response');
                $btn.prop('disabled', true).text('Processing...');

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
                        $('#milestoneModal').modal('hide'); // close modal
                        $('#milestoneForm')[0].reset(); // clear form

                        $.toast({
                            heading: 'Success',
                            text: response.success,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                            afterShown: function() {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }

                        }) // success alert
                        // Optional: Reload data table, or refresh part of page
                    },
                    error: function(xhr) {
                        // Error handling
                        alert('Something went wrong!');
                        console.log(xhr.responseText); // for debugging
                        $btn.prop('disabled', false).text('Save Milestone');
                    }
                });

            });

        });

        // here create a task
        $('#taskForm').submit(function(e) {
            e.preventDefault(); // stop the form from submitting normally


            var formData = new FormData(this);

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
                    })

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


        // here bold and unbold text 

        $(document).ready(function() {
            // When a link with class 'project-link' is clicked
            $('.project-link').on('click', function(e) {
                e.preventDefault(); // Prevent the default action (opening the link)

                var linkId = $(this).data('id'); // Get the project ID from data-id
                var type = $(this).data('type');
                var link = $(this);
                // Send an AJAX request to update the 'is_visited' field
                $.ajax({
                    url: '/update-booking-visited', // URL to handle the update
                    method: 'POST', // HTTP Method
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        linkId: linkId,
                        type: type // Sending the project ID
                    },
                    success: function(response) {
                        // Handle the response (you can apply the visited class here if needed)
                        if (response.success == true) {
                            link.removeClass('project-link').addClass('project_link_visited');

                        }
                    },
                    error: function() {
                        alert("An error occurred while updating the booking.");
                    }
                });

                // Optionally open the link in a new tab or perform other actions
                window.open($(this).attr('href'), '_blank');
            });
        });
    </script>
@endpush

@php
    $page_name = 'Projects';
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

                        {{-- <div class="card">
                            <!-- Filter Header -->
                            <div class="card-header">
                                <h3 class="card-title">{{ $page_name }} details</h3>

                                <button type="button" class="btn btn-warning btn-sm float-right ml-2"
                                    data-id="{{ $project->id }}" data-toggle="modal" data-target="#milestoneModal">
                                    Create Milestone
                                </button>

                                <button type="button" class="btn btn-success btn-sm open-task-modal float-right ml-2"
                                    data-toggle="modal" data-target="#taskModal">
                                    Create Task
                                </button>

                                <button type="button" class="btn btn-info btn-sm float-right ml-2"
                                    data-id="{{ $project->id }}" data-toggle="modal" data-target="#EmployeeModal">
                                    Add Employee
                                </button>
                                @if (Auth::user('admin')->id == 1 || Auth::user('admin')->id == 2)
                                    <button type="button" class="btn btn-primary btn-sm float-right ml-2"
                                        data-id="{{ $project->id }}" data-toggle="modal"
                                        data-target="#accouintmanagerModal">
                                        Add Account Manager
                                    </button>
                                @endif
                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-2">
                                        <strong>Account Manager:</strong> {{ $project->accountManager->name ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Employee:</strong> {{ $project->employee->name ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Project Price:</strong> {{ $project->booking->total_price ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Initial Price:</strong>
                                        {{ $project->booking->initial_paid_amount ?? 'N/A' }}
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 mb-2">
                                        <strong>SOW Name:</strong> {{ $project->booking->statementOfWork->title ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>SOW Min Price:</strong>
                                        {{ $project->booking->statementOfWork->min_price ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>SOW Max Price:</strong>
                                        {{ $project->booking->statementOfWork->max_price ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>SOW Estimated Time:</strong>
                                        {{ $project->booking->statementOfWork->estimated_time ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>SOW Description:</strong>
                                        {!! $project->booking->statementOfWork->description ?? 'N/A' !!}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Service:</strong>
                                        {{ $project->booking->statementOfWork->service->name ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Sub Service:</strong>
                                        {{ $project->booking->statementOfWork->subservice->name ?? 'N/A' }}
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <strong>Started At:</strong>
                                        {{ $project->started_at ? \Carbon\Carbon::parse($project->started_at)->format('d M Y') : 'N/A' }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <strong>Completed At:</strong>
                                        {{ $project->completed_at ? \Carbon\Carbon::parse($project->completed_at)->format('d M Y') : 'N/A' }}
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <strong>Status:</strong> @if($project->project_status=='Not_started') Not Started @elseif($project->project_status=='active') Active @else Completed @endif
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">

                                </ul>
                            </div>
                        </div> --}}

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

                {{-- here new  --}}

                <div class="card tab-pane fade show active" id="project-tab-1">
                    <div class="container-fluid mt-4">
                        <!-- Tabs Navigation -->
                        <div class="card-header">
                            <h3 class="card-title">{{ $page_name }} details</h3>
                            <button type="button" class="btn btn-warning btn-sm float-right ml-2"
                                data-id="{{ $project->id }}" data-toggle="modal" data-target="#milestoneModal">
                                Create Milestone
                            </button>

                            {{-- <button type="button" class="btn btn-success btn-sm open-task-modal float-right ml-2"
                                    data-toggle="modal" data-target="#taskModal">
                                    Create Task
                                </button> --}}

                            {{-- <button type="button" class="btn btn-info btn-sm float-right ml-2"
                                    data-id="{{ $project->id }}" data-toggle="modal" data-target="#EmployeeModal">
                                    Add Employee
                                </button>

                                @if (Auth::user('admin')->id == 1 || Auth::user('admin')->id == 2)
                                  <button type="button" class="btn btn-primary btn-sm float-right ml-2"
                                      data-id="{{ $project->id }}" data-toggle="modal"
                                      data-target="#accouintmanagerModal">
                                      Add Account Manager
                                  </button>
                                @endif --}}
                        </div>

                        <ul class="nav nav-tabs" id="projectTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#detail" type="button" role="tab">
                                    Detail
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments"
                                    type="button" role="tab">
                                    Payments
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" id="tasklist-tab" data-bs-toggle="tab" data-bs-target="#tasklist"
                                    type="button" role="tab">
                                    Tasklist
                                </button>
                            </li>

                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content mt-3">

                            <!-- Detail Tab -->
                            <div class="tab-pane fade show active" id="detail" role="tabpanel"
                                aria-labelledby="detail-tab">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="row mb-3">

                                            <div class="col-md-12 mb-2">
                                                <strong>Project Details:</strong>
                                                <div style="height: 200px; overflow-y: auto; border-bottom: 1px solid #c3c3c3;">
                                                    @if (!empty($project->booking->statementOfWork->description))
                                                        {!! $project->booking->statementOfWork->description ?? 'N/A' !!}
                                                    @else
                                                     @if (!empty($project->description))
                                                     {!! $project->description !!}
                                                     @else
                                                    <a href="#" class="" data-id="{{ $project->id }}"
                                                        data-toggle="modal" data-target="#addproject_details">
                                                        Update Details
                                                    </a>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-2 ">
                                                <strong>Account Manager:</strong>
                                                {{ $project->accountManager->name ?? 'N/A' }}
                                                @if (Auth::user('admin')->id == 1 || Auth::user('admin')->id == 2)
                                                    <a href="#" class="" data-id="{{ $project->id }}"
                                                        data-toggle="modal" data-target="#accouintmanagerModal">
                                                        @if (!empty($project->account_manager_id))
                                                            (Update Manager)
                                                        @else
                                                            (Add Manager)
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="col-md-4 mb-2"><strong>Employee:</strong>
                                                {{ $project->employee->name ?? 'N/A' }}
                                                @if (auth()->user()->hasPermission('assign_employee'))

                                                    <a href="#" data-id="{{ $project->id }}" data-toggle="modal"
                                                        data-target="#EmployeeModal">
                                                        @if (!empty($project->employee_id))
                                                            (Update Employee)
                                                        @else
                                                            (Add Employee)
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="col-md-4 mb-2"><strong>Project Price:</strong>
                                                {{ $project->booking->total_price ?? 'N/A' }}
                                            </div>

                                            <div class="col-md-4 mb-2"><strong>Initial Price:</strong>
                                                {{ $project->booking->initial_paid_amount ?? 'N/A' }}
                                            </div>

                                            <div class="col-md-4 mb-2"><strong>SOW Name:</strong>
                                                {{ $project->booking->statementOfWork->title ?? 'N/A' }}</div>
                                            <div class="col-md-4 mb-2"><strong>SOW Min Price:</strong>
                                                {{ $project->booking->statementOfWork->min_price ?? 'N/A' }}</div>
                                            <div class="col-md-4 mb-2"><strong>SOW Max Price:</strong>
                                                {{ $project->booking->statementOfWork->max_price ?? 'N/A' }}</div>
                                            <div class="col-md-4 mb-2"><strong>Estimated Time:</strong>
                                                {{ $project->booking->statementOfWork->estimated_time ?? 'N/A' }}</div>
                                            <!-- <div class="col-md-4 mb-2"><strong>Description:</strong>
                                                {{ $project->booking->statementOfWork->description ?? 'N/A' }}</div> -->
                                            <div class="col-md-4 mb-2"><strong>Service:</strong>
                                                {{ $project->booking->statementOfWork->service->name ?? 'N/A' }}</div>
                                            <div class="col-md-4 mb-2"><strong>Sub Service:</strong>
                                                {{ $project->booking->statementOfWork->subservice->name ?? 'N/A' }}</div>
                                            <div class="col-md-4 mb-2"><strong>Started At:</strong>
                                                {{ $project->started_at ? \Carbon\Carbon::parse($project->started_at)->format('d M Y') : 'N/A' }}
                                                
                                            </div>
                                            <div class="col-md-4 mb-2"><strong>Completed At:</strong>
                                                {{ $project->completed_at ? \Carbon\Carbon::parse($project->completed_at)->format('d M Y') : 'N/A' }}
                                            </div>
                                            <div class="col-md-4 mb-2"><strong>Status:</strong>
                                                <span class="badge badge-success"> @if($project->project_status=='Not_started') Not Started @elseif($project->project_status=='active') Active @else Completed @endif
                                                </span>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">About the Client</h6>
                                                <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>{{$project->booking->user->name}}</p>
                                                <p class="mb-1"><i class="bi bi-flag-fill me-1 text-danger"></i> {{$project->booking->user->email}} ({{$project->booking->user->mobile}})</p>
                                                {{-- <div class="mb-2">
                                                    <span class="text-warning">★★★★★</span> <strong>5.0</strong> <small>(4
                                                        reviews)</small>
                                                </div> --}}
                                                <p class="mb-2 text-muted"><i class="bi bi-calendar me-1"></i> Member Registered
                                                    {{ formatDateReadable($project->booking->user->created_at)}}</p>

                                                {{-- <h6 class="fw-bold mt-4 mb-2">Client Engagement</h6>
                                                <a href="#" class="text-decoration-none text-primary small">Upgrade
                                                    your membership to see client engagement</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Payments Tab -->
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                <div class="row mt-4">
                                    <!-- Left Side: Payment Summary & Milestones -->
                                    <div class="col-md-8">
                                        <!-- Payment Summary -->
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title">Payment Summary</h5>
                                                <div class="row text-center">
                                                    @if (!empty($project->booking->payments))
                                                        @foreach ($project->booking->payments as $payment)
                                                            <div class="col">
                                                                {{-- <p class="mb-1">Requested</p> --}}

                                                                <h6>{{ $payment->amount }}</h6>
                                                            </div>
                                                            <div class="col">
                                                                {{-- <p class="mb-1">Paid</p> --}}
                                                                <h6>
                                                                    <span
                                                                        class="badge badge-success">{{ $payment->status }}</span>

                                                                </h6>
                                                            </div>
                                                            <div class="col">
                                                                {{-- <p class="mb-1">Type</p> --}}
                                                                {{-- <h6>{{ $payment->payment_type }}</h6> --}}
                                                                <h6>{{ $payment->created_at }}</h6>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Milestone Payments -->
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="card-title mb-0">Milestone Payments</h5>
                                                </div>

                                                <!-- Milestone Table -->
                                                <div class="table-responsive">
                                                    <table class="table table-bordered align-middle">
                                                        <thead>
                                                            <tr>
                                                                <th>Due Date</th>
                                                                <th>Title</th>
                                                                <th>Description</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Created On</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if (!empty($milestone) && count($milestone) > 0)
                                                                @foreach ($milestone as $mile)
                                                                    <tr>
                                                                        <td>{{ $mile->due_date }}</td>
                                                                        <td>{{ $mile->title }}</td>
                                                                        <td>{{ $mile->description }}</td>
                                                                        <td>{{ $mile->amount }}</td>
                                                                        <td>
                                                                            <span class="badge badge-success">{{ ucwords(str_replace('_', ' ', $mile->status)) }}</span>
                                                                        </td>
                                                                        <td>{{ $mile->created_on }}</td>
                                                                        <td>
                                                                            @if($mile->status=='pending')
                                                                            <input type="button" class="btn btn-sm btn-primary request_milestone" data-id="{{ $mile->id }}" value="Milestone Payment Request">
                                                                            @else 
                                                                            <span class="badge badge-success">{{ ucwords(str_replace('_', ' ', $mile->status)) }}</span>
                                                                            @endif
                                                                            </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <!-- Created Milestones (Empty State) -->
                                                                <div class="text-center text-muted mt-4">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/742/742751.png"
                                                                        alt="No milestones" width="64">
                                                                    <p class="mt-2">No created milestones yet.</p>
                                                                </div>
                                                            @endif
                                                            <!-- More milestones can go here -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Side: Client & Info -->
                                    <div class="col-md-4">
                                        <!-- Client Info -->
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <h6 class="text-muted">The Client</h6>
                                                <h6 class="mb-0">{{$project->booking->user->name}}</h6>
                                                <small class="text-muted">{{$project->booking->user->email}} ({{$project->booking->user->mobile}})</small>

                                                <div class="mt-2">
                                                    <button class="btn btn-outline-primary btn-sm">Chat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tasklist Tab -->
                            <div class="tab-pane fade" id="tasklist" role="tabpanel" aria-labelledby="tasklist-tab">
                                <div class="card">
                                 
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">Task List</h5>

                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#taskModal">+Add Task</button>

                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Due Date</th>
                                                        {{-- <th>Description</th> --}}
                                                        <th>Status</th>
                                                        {{-- <th>Progress</th> --}}
                                                        <th>Assign To</th>
                                                        <th>Milestone</th>
                                                        <th>Created On</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @if (!empty($tasks) && count($tasks) > 0)
                                                        @foreach ($tasks as $task)
                                                            <tr>
                                                                <td>{{ $task->title }}
                                                                    {{-- <button href="#" class="btn btn-sm bg-success ml-1" data-toggle="modal" data-target="#taskModal">
                                                                         +Add Task
                                                                     </button> --}}

                                                                    {{-- <span class="badge badge-success" data-toggle="modal"
                                                                        data-target="#taskModal">+Add Task</span> --}}

                                                                </td>
                                                                <td> {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                                                </td>
                                                                {{-- <td>{{$task->description}}</td> --}}
                                                                <td>
                                                                    <span class="badge badge-success">{{ ucfirst($task->status) }}</span>
                                                                </td>
                                                                {{-- <td>{{ $task->progress }}</td> --}}
                                                                <td> {{ GetUser($task->assigned_to)->name }} </td>
                                                                <td> {{ $task->milestone->title }} </td>
                                                                <td> {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                                                </td>
                                                                <td>
                                                                    <!-- Example Button -->
                                                                <button class="btn btn-sm bg-warning view-task-btn"
                                                                    data-id="{{ $task->id }}"
                                                                    data-toggle="modal"
                                                                    data-target="#taskDetailsModal">
                                                                    <i class="fas fa-solid fa-eye"></i>
                                                                </button>
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
                    </div>
                </div>

                <!-- Bootstrap JS for tabs (make sure this is included once in your layout) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                {{-- here end  --}}

                <!-- Milestone Modal -->
                <div class="modal fade" id="milestoneModal" tabindex="-1" role="dialog"
                    aria-labelledby="milestoneModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="milestoneModalLabel">Create Milestone</h5>
                                {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                </button> --}}

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                </button>

                            </div>

                            <form id="milestoneForm" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">

                                <div class="modal-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" required>
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
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button type="submit" name="button" value="create milestone" class="btn btn-primary btn-response">Save Milestone</button>

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
                                    <div class="row">
                                        <!-- Title -->
                                        <div class="form-group col-sm-12">
                                            <label for="task_title">Title</label>
                                            <input type="text" name="title" id="task_title" class="form-control"
                                                required>
                                        </div>

                                        <!-- Hidden Milestone ID -->
                                        <input type="hidden" name="milestone_id" id="task_milestone_id">

                                        <div class="form-group col-sm-6">
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
                                        <div class="form-group col-sm-6">
                                            <label for="assign_to">Assign To</label>
                                            <select name="assign_to" id="assign_to" class="form-control" required>
                                                <option value="">Select User</option>
                                                @if (!empty($users) && count($users))
                                                    @foreach ($users as $u)
                                                        <option value="{{ $u->id }}">{{ $u->name }} ({{$u->role->name}})</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group col-sm-6">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="todo">Todo</option>
                                                <option value="in_progress">In Progress</option>
                                                <option value="submitted">Submitted</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="task_title">Due Date</label>
                                            <input type="date" name="due_date" id="due_date" class="form-control"
                                                required>
                                        </div>

                                        <!-- Progress -->
                                        {{-- <div class="form-group col-sm-6">
                                            <label for="progress">Progress (%)</label>
                                            <input type="number" name="progress" id="progress" class="form-control"
                                                min="0" max="100" value="0" required>
                                        </div>

                                        <!-- Submitted for Review -->
                                        <div class="form-group col-sm-6">
                                            <label for="submitted_for_review">Submitted for Review</label>
                                            <select name="submitted_for_review" id="submitted_for_review"
                                                class="form-control" required>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div> --}}

                                        <!-- Description -->
                                        <div class="form-group col-sm-12">
                                            <label for="task_description">Description</label>
                                            <textarea name="description" id="task_description" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="button" value="create task" class="btn btn-primary btn-response">Save Task</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            

                <div class="modal fade" id="addproject_details" tabindex="-1" role="dialog"
                    aria-labelledby="addproject_details" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addproject_details">Update Project Details</h5>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button> --}}

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                </button>

                            </div>

                            <form id="add_project_details" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">

                                <div class="modal-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label> <br>
                                        
                                                       
                                        <textarea rows="8" class="form-control" cols="25" name="description" id="description"> {{$project->description}}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button name="button"  value="Update Project description" type="submit"  class="btn btn-primary btn-save">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                {{-- here account manager modal  --}}

                <div class="modal fade" id="accouintmanagerModal" tabindex="-1" role="dialog"
                    aria-labelledby="accountmangerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="accountmangerModalLabel">Add Account MAnager</h5>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button> --}}

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                </button>

                            </div>

                            <form id="accountManagerForm" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">

                                <div class="modal-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Account Manager</label>
                                        <select name="assign_to_accont_manager" id="assign_to_accont_manager"
                                            class="form-control" required>
                                            <option value="">Select Account Manager</option>
                                            @if (!empty($account_manager) && count($account_manager))
                                                @foreach ($account_manager as $manager)
                                                    <option value="{{ $manager->id }}"
                                                        @if ($project->account_manager_id == $manager->id) selected @endif>
                                                        {{ $manager->name }} ({{$manager->username}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button name="button" id="button-ac" value="Add account manager" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="EmployeeModal" tabindex="-1" role="dialog"
                    aria-labelledby="EmployeeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="EmployeeModalLabel">Add Employee</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                </button>

                            </div>

                            <form id="employeeForm" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">

                                <div class="modal-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label">Add Employee</label>
                                        <select name="assign_employee" id="assign_employee" class="form-control"
                                            required>
                                            <option value="">Select Employee</option>
                                            @if (!empty($employee) && count($employee))
                                                @foreach ($employee as $emp)
                                                    <option value="{{ $emp->id }}"
                                                        @if ($project->employee_id == $emp->id) selected @endif>
                                                        {{ $emp->name }} ({{$emp->username}})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="button" id="button-emp" value="Add Employee" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

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
                                                
                                                @if (auth()->user()->hasPermission('mark_complete'))
                                                <button class="btn btn-outline-primary btn-sm mb-2 mark_as_complete" name="button" value="Mark Completed Task">Mark Complete</button>
                                                @endif
                                                @if (auth()->user()->hasPermission('reminder_mail'))
                                                <button class="btn btn-outline-primary btn-sm mb-2 reminder_mail" name="button" value="reminder mail Task">Reminder Mail</button>
                                                @endif
                                                 @if (auth()->user()->hasPermission('request_review'))
                                                <button class="btn btn-outline-danger btn-sm mb-2 delete-task-btn" data-type="review" data-task-id="{{ $task->id ?? '' }}"  name="button" value="Request for Review">Request for Review</button>
                                                @endif
                                                
                                                @if (auth()->user()->hasPermission('delete_task'))
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
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>

  CKEDITOR.replace('description');
  
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
    
               let $btn = $('.btn-response');
               $btn.prop('disabled', true).text('Processing...');
            
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
                                
                                 afterShown: function () {
                                    setTimeout(function () {
                                        location.reload(); 
                                    }, 2000);
                                }
                            })
                            $btn.prop('disabled', false).text('Save Milestone');

                        }else{
                            $.toast({
                                heading: 'Error',
                                text: response.message || 'Something went wrong!',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position: 'top-right'
                            });
                            $btn.prop('disabled', false).text('Save Milestone');
                        }
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


            let $btn = $('.btn-response');
            $btn.prop('disabled', true).text('Processing...');
               
               
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
                     $btn.prop('disabled', false).text('Save Task');
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
            
            let $btn = $('#button-ac');
            $btn.prop('disabled', true).text('Processing...');
            
            $.ajax({
                url: '{{ route('assign.accountmanager') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $btn.prop('disabled', false).text('Save');
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
                    $btn.prop('disabled', false).text('Save');
                    alert(errorMessage);
                }
            });
        });

        // asssign employee here
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();
            
            let $btn = $('#button-emp');
            $btn.prop('disabled', true).text('Processing...');
            

            $.ajax({
                url: '{{ route('assign.employee') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#EmployeeModal').modal('hide');
                        // alert(response.message);
                        $btn.prop('disabled', false).text('Save');

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
                    $btn.prop('disabled', false).text('Save');
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
            
            let $btn = $('.mark_as_complete');
               $btn.prop('disabled', true).text('Processing...');

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
                    $btn.prop('disabled', true).text('Request For Payment');
                }
            });
        });


 // here send reminder mail 

 $('.reminder_mail').click(function () {
            let $btn = $(this);
            let taskId = $("#task_id").val();
            let button=$(this).val();
                $btn.prop('disabled', true).html('Processing...');

            $.ajax({
                url: '{{ route('reminder.mail') }}',
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
        
        let $btn = $('#commit-btn');
               $btn.prop('disabled', true).text('Processing...');
            let comment = $('#commit-comment').val();
            let taskId = $(this).data('task-id');
            let button=$(this).val();

            if (comment.trim() === '') {
                alert('Please enter a comment.');
                 $btn.prop('disabled', false).text('Commit');
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
                $btn.prop('disabled', false).text('Commit');
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
                $btn.prop('disabled', false).text('Commit');
            }
        });
    });

// here delte task

$(document).on('click', '.delete-task-btn', function () {
    let taskId = $(this).data('task-id');
    let type = $(this).data('type');
    let button=$(this).val();
    let $btn = $('.delete-task-btn');
    $btn.prop('disabled', true).text('Processing...');

    if (!confirm('Are you sure you want to ' + type +' this task comment?')) return;

    $.ajax({
        url: '/task-history/delete',
        method: 'POST',
        data: {
            task_id: taskId,type:type,button:button,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
        $btn.prop('disabled', false).text('Delete Task');
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
            $btn.prop('disabled', false).text('Delete Task');
        }
    });
});



// request milestone payment
$(document).on('click', '.request_milestone', function () {
    let dataId = $(this).data('id');
    button=$(this).val();
        let $btn = $('.request_milestone');
         $btn.prop('disabled', true).text('Processing...');

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
            $btn.prop('disabled', true).text('Request Milestone Payment ');
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
              $btn.prop('disabled', true).text('Request Milestone Payment ');
        }
    });
});

// here update project details 

 $('#add_project_details').on('submit', function(e) {
            e.preventDefault();
            
              let $btn = $('.btn');
               $btn.prop('disabled', true).text('Processing...');

            $.ajax({
                url: "{{ route('update.project.details') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addproject_details').modal('hide');
                        $btn.prop('disabled', false).text('Save');

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
                    $btn.prop('disabled', false).text('Save');
                    alert(errorMessage);
                }
            });
        });


</script>
@endpush

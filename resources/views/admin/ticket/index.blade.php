@php
    $page_name = 'Ticket List';
    $permission = 'ticket';
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
                                                        <th>User Info</th>
                                                        <th>TicketID</th>
                                                        <th>Created On</th>
                                                        <th>Ticket Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($tickets) && count($tickets)>0)
                                                    @foreach($tickets as $ticket)
                                                    <tr>
                                                        <td>{{$ticket->user->name ?? $ticket->user->username}} <br> {{$ticket->user->mobile}} <br> {{$ticket->user->email}}</td>
                                                        <td> <a href="{{route('admin.ticket.reply.page',$ticket->id)}}" target="_blank"> {{$ticket->ticket_id}} </a> </td>
                                                        
                                                        <td>{{formatDateReadable($ticket->created_at)}}</td>
                                                        <td>
                                                            @if($ticket->ticket_close=='close')
                                                             <span class="badge badge-danger">{{ucfirst($ticket->ticket_close)}}</span> 
                                                             @else
                                                             <span class="badge badge-success">{{ucfirst($ticket->ticket_close)}}</span> 
                                                             @endif
                                                            </td>
                                                        <td>
                                                            <a href="{{route('admin.ticket.reply.page',$ticket->id)}}" class="btn btn-sm btn-warning">
                                                                Reply
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="5">No Tickets Found!</td>
                                                    </tr>
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

 </script>

@endpush

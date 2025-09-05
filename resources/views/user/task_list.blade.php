@php
    $title = 'Task - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp


@extends('layouts.front.user-app')

@section('pageContent')
    <style>
        th {
            font-weight: 600;
        }
    </style>
    {{-- header --}}
    <div class="mb-3 mb-lg-4">
        <div class="d-flex gap-3 flex-wrap">
            <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line"></i>
            </button>
            <h1 class="fw-bold mb-0">My Tak List</h1>
        </div>
    </div>

    {{-- Task list --}}
    <div class="overflow-x-hidden">

        <div class="border rounded-2 p-3">
            <div class="table-responsive">
                <table class="table table-bordered text-sm mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-light">Title</th>
                            <th scope="col" class="bg-light">Due Date</th>
                            <th scope="col" class="bg-light">Description</th>
                            <th scope="col" class="bg-light">Status</th>
                            <th scope="col" class="bg-light">Assign To </th>
                            <th scope="col" class="bg-light">Milestone</th>
                            <th scope="col" class="bg-light">Created On</th>
                            <th scope="col" class="bg-light">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (!empty($tasks) && count($tasks) > 0)
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>

                                    <td> {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                    </td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        <span class="badge badge-success">{{ $task->status }}</span>
                                    </td>
                                    
                                    <td> {{ GetUser($task->assigned_to)->name }} </td>
                                    <td> {{ $task->milestone->title }} </td>
                                    <td> {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                    </td>
                                    
                                    <td>
                                        <!-- Example Button -->
                                        <button class="btn btn-sm bg-warning view-task-btn" data-id="{{ $task->id }}"
                                            data-bs-toggle="modal" data-bs-target="#taskDetailsModal">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">No task found.</td>
                                </tr>   
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination Section -->
        <div class="mt-3 d-flex gap-3 flex-wrap justify-content-between align-items-center">
            @if ($tasks->hasMorePages())
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $tasks->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link text-sm focus-shadow-none"
                                href="{{ $tasks->previousPageUrl() ?? '#' }}">Previous</a>
                        </li>

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                            <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link text-sm focus-shadow-none"
                                    href="{{ $tasks->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$tasks->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link text-sm focus-shadow-none"
                                href="{{ $tasks->nextPageUrl() ?? '#' }}">Next</a>
                        </li>
                    </ul>
                </nav>
            @endif

            <p class="mb-0 text-sm">
                Showing
                <span class="text-muted">{{ $tasks->firstItem() }} - {{ $tasks->lastItem() }}</span>
                of
                <span class="text-muted">{{ $tasks->total() }}</span>.
            </p>
        </div>
    </div>


    <!-- Task Details Modal -->
    <div class="modal fade" id="taskDetailsModal" tabindex="-1" aria-labelledby="taskDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskDetailsLabel">Task Details <span
                            class="badge bg-success btn_status"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <small class="text-muted">
                            By <strong><span id="taskTitle"></span></strong> <span id="taskBy"></span>
                        </small>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Assigned</label>
                                    <input type="text" class="form-control" id="taskAssignee" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Due Date</label>
                                    <input type="text" id="taskDueDate" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="5" id="taskDescription" readonly></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-4">
                                <h6>Quick actions</h6>
                                <div class="d-flex flex-column">
                                    <input type="hidden" name="id" id="task_id">
                                    <button class="btn btn-outline-primary btn-sm mb-2 mark_as_complete" name="button"
                                        value="Mark Completed Task">Mark Complete</button>
                                    <button class="btn btn-outline-danger btn-sm mb-2 delete-task-btn" data-type="review"
                                        data-task-id="{{ $task->id ?? '' }}" name="button"
                                        value="Request for Review">Request for Review</button>
                                    @if (auth()->user()->hasPermission('delete_task'))
                                        <button class="btn btn-outline-danger btn-sm delete-task-btn" data-type="delete"
                                            name="button" value="Delete Task"
                                            data-task-id="{{ $task->id ?? '' }}">Delete</button>
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
                        <div class="d-flex mt-2">
                            <div class="flex-grow-1">
                                <textarea id="commit-comment" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                                <button name="button" id="commit-btn" class="btn btn-sm btn-info float-end mt-2"
                                    value="comment in task" data-task-id="{{ $task->id ?? '' }}">Commit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.view-task-btn').click(function() {
                alert('run');
                let taskId = $(this).data('id');
                let button = $(this).val();
                $("#task_id").val(taskId);

                //  alert(taskId);

                $.ajax({
                    url: '{{ route('user.task.details') }}',
                    method: 'GET',
                    data: {
                        id: taskId,
                        button: button
                    },
                    success: function(response) {
                        $('#taskTitle').text(response.title);
                        $('#taskBy').text('By ' + response.created_by);
                        $('#taskAssignee').val(response.assignee);
                        $('#taskDueDate').val(response.due_date);
                        $('#taskDescription').val(response.description);
                        $('.btn_status').text(response.status);

                        const c = response.task_history;

                        // console.log(c);

                        $('#comment-list').empty(); // Add to top of the list

                        let html = '';

                        c.forEach(function(item) {
                            html += `
                                <div class="card mb-2">
                                    <div class="card-body p-2">
                                        <p class="mb-1">${item.comment}</p>
                                        <small class="text-muted">By: ${item.created_by?.name || 'Unknown'} | ${item.updated_on}</small>
                                    </div>
                                </div>
                            `;
                        });

                        $('#comment-list').prepend(html); // here list comments in the list
                        $('#commit-comment').val(''); // Clear textarea
                    },
                    error: function() {
                        alert('Failed to fetch task data.');
                    }
                });
            });

        })
    </script>
@endsection

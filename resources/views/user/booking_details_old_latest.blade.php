@extends('layouts.user.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            @include('layouts.user.side_menu')

            <div class="col-lg-12">
                <div class="dashboard_title_area">
                    <h2> Booking Details</h2>
                    <p class="text">Your Booking Details</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <!-- Tabs Navigation -->

                <ul class="nav nav-tabs mb-3" id="bookingTabs" role="tablist">
                     <li class="nav-item active" role="presentation">
                                <button class="nav-link active" id="call-tab" data-bs-toggle="tab" data-bs-target="#booking-call"
                                    type="button" role="tab" aria-controls="booking-call" aria-selected="true">Booking
                                    Call</button>
                            </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="live-tab" data-bs-toggle="tab" data-bs-target="#live"
                            type="button" role="tab" aria-controls="live" aria-selected="false">Live Booking
                            Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project"
                            type="button" role="tab" aria-controls="project" aria-selected="false">Project
                            Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="milestone-tab" data-bs-toggle="tab" data-bs-target="#milestone"
                            type="button" role="tab" aria-controls="milestone" aria-selected="false">Milestone</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="task-tab" data-bs-toggle="tab" data-bs-target="#task" type="button"
                            role="tab" aria-controls="task" aria-selected="false">Task</button>
                    </li>
                </ul>

                {{-- @dd($booking); --}}

                <!-- Tabs Content -->
                <div class="tab-content" id="bookingTabsContent">
                    {{-- Live Booking Details Tab --}}
                    <div class="tab-pane fade" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                            <div class="packages_table table-responsive">
                                <table class="table table-bordered table-striped align-middle mb-0">
                                    <thead class="table" style="background:#dff6f2">
                                        <tr>
                                            <th>SOW Name</th>
                                            <th>Initial Payment %</th>
                                            <th>Initial Paid Amount</th>
                                            <th>Total Amount</th>
                                            <th>Booking Status</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <a
                                                            href="{{ route('user.booking.details', ['id' => encrypt($booking->id)]) }}">
                                                            <h6 class="mb-1">
                                                                {{ $booking->statementOfWork->title ?? 'N/A' }}</h6>
                                                            <small class="text-muted d-block">
                                                                <i
                                                                    class="flaticon-30-days me-1 text-primary"></i>{{ formatDateReadable($booking->created_at) }}
                                                            </small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $booking->statementOfWork->initial_payment_percentage ?? 'N/A' }}%</td>
                                            <td>{{ $booking->initial_paid_amount ?? 'N/A' }}</td>
                                            <td><span class="badge bg-success">{{ $booking->total_price ?? 'N/A' }}</span>
                                            </td>
                                            <td>
                                                @if ($booking->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($booking->payment_status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span
                                                        class="badge bg-success">{{ ucfirst($booking->payment_status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- @dd(); --}}
                     {{-- here calls booking  --}}
                     <div class="tab-pane fade show active" id="booking-call" role="tabpanel" aria-labelledby="call-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle mb-0">
                                        <thead class="table" style="background:#f0f0f0">
                                            <tr>
                                                <th>Scheduled Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if(!empty($booking->firstCall))

                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($booking->firstCall->scheduled_at)->format('d M Y, h:i A') }}
                                                        </td>
                                                        <td><span class="badge bg-info">{{ ucfirst($booking->firstCall->status) }}</span>
                                                        </td>
                                                       <td>  @if($booking->firstCall->status !='pending')
                                                        <button type="button" class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#meetingModal">
                                                            Show Meeting Details
                                                            </button>
                                                         @else loading.. @endif</td>
                                                    </tr>
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No call bookings
                                                        found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    {{-- Project Details Tab --}}
                    <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                        <div class="ps-widget bgc-white bdrs4 p30 mb30">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Project Info</th>
                                        <th>Price</th>
                                        <th>Booked On</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td> <a href="{{ url('projects-details', $booking->id) }}" target="_blank">
                                                {{ $booking->statementOfWork->service->name }} ->
                                                {{ $booking->statementOfWork->subservice->name }} <br>
                                                {{ trimWords($booking->statementOfWork->description) }}
                                            </a>
                                        </td>

                                        <td>{{ $booking->initial_paid_amount ?? 'NA' }}</td>
                                        <td>{{ $booking->created_on ?? 'N/A' }}</td>

                                        <td>
                                            <span class="badge bg-success">{{ $booking->project->project_status??'NA' }}</span>
                                        </td>
                                        <td>{{ $booking->project->created_on ?? 'N/A' }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Milestone Tab --}}
                    <div class="tab-pane fade" id="milestone" role="tabpanel" aria-labelledby="milestone-tab">
                        <div class="ps-widget bgc-white bdrs4 p30 mb30">

                            {{-- Add milestone data here --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if (!empty($booking->project->milestones) && count($booking->project->milestones) > 0)
                                        @foreach ($booking->project->milestones as $milestone)
                                            <tr>
                                                <td>
                                                    {{ $milestone->due_date }}
                                                </td>

                                                <td>{{ $milestone->title ?? 'NA' }}</td>
                                                <td>{{ $milestone->description ?? 'N/A' }}</td>
                                                <td>{{ $milestone->amount ?? 'N/A' }}</td>

                                                <td>

                                                    <span class="badge bg-info">{{ $milestone->status }}</span>

                                                </td>
                                                <td>{{ $milestone->created_on ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($milestone->status == 'request_payment')
                                                        <button class="btn btn-sm bg-warning milestone-payment-btn"
                                                            data-id="{{ $milestone->id }}"
                                                            data-sow_id="{{ $booking->sow_id }}"
                                                            data-price="{{ $milestone->amount }}"
                                                            data-booking_id="{{ $booking->id }}">Pay
                                                            ₹{{ $milestone->amount }}</button>
                                                    @elseif($milestone->status == 'completed')
                                                        <span class="badge bg-info">{{ $milestone->status }}</span>
                                                    @else
                                                        ---
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Task Tab --}}
                    <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="task-tab">
                        <div class="ps-widget bgc-white bdrs4 p30 mb30">
                            <h6>Task list will be loaded here...</h6>
                            {{-- Add your task management info here --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Due Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($booking->project->milestones) && count($booking->project->milestones) > 0)
                                        @foreach ($booking->project->milestones as $milestone)
                                            @if (!empty($milestone->tasks) && count($milestone->tasks) > 0)
                                                @foreach ($milestone->tasks as $task)
                                                    <tr>
                                                        <td>{{ $task->title }}</td>
                                                        <td>{{ $task->due_date }}</td>
                                                        <td>{{ $task->description }}</td>
                                                        <td><span class="badge bg-info">{{ $task->status }}</span></td>
                                                        <td>{{ $task->created_on }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
<!-- Modal -->
<div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-white border-0 rounded-3" style="background: #1e5738;
">
      <div class="modal-header border-0">
        <h3 class="modal-title text-light"  id="meetingModalLabel">Meeting Details</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <label class="fw-semibold mb-2">Meeting Link</label>
        <div class="input-group mb-4">
          <input type="text" class="form-control text-dark border-0" value="{{$booking->firstCall->call_link}}">
          <button class="btn btn-secondary text-white" type="button">Copy</button>
        </div>

        <label class="fw-semibold mb-2">Note</label>
        <div class=" text-white p-3 rounded">

          <textarea name="" id="" cols="20" rows="3">{{$booking->firstCall->notes}} </textarea>
        </div>
      </div>

      <div class="modal-footer border-0">
        <a href="{{$booking->firstCall->call_link}}" target="_blank" class="btn btn-primary">Join Now</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.milestone-payment-btn', function(e) {
            e.preventDefault();

            let mileston_id = $(this).data('id');
            let booking_id = $(this).data('booking_id');
            let sow_id = $(this).data('sow_id');
            let price = $(this).data('price');

            // Optional: Confirm payment
            Swal.fire({
                title: 'Are you sure?',
                text: `Proceed to pay ₹${price}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Pay Now',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    createRazorpayOrderAndPay(sow_id, price, mileston_id,
                    booking_id); // Reuse global function
                }
            });
        });




        function createRazorpayOrderAndPay(sow_id, price, mileston_id, booking_id) {
            PleaseWait();
            // alert('run');
            $.ajax({
                url: "{{ route('razorpay.order.create') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    price: price
                },
                success: function(orderData) {
                    Swal.close();

                    let options = {
                        key: orderData.razorpay_key,
                        amount: orderData.amount,
                        currency: orderData.currency,
                        name: "Elyvato",
                        description: "Milestone Payment",
                        order_id: orderData.order_id,
                        handler: function(response) {
                            storeMilestonePayment(response, sow_id, price, mileston_id, booking_id);
                        },
                        theme: {
                            color: "#528FF0"
                        }
                    };

                    let rzp = new Razorpay(options);
                    rzp.open();
                },
                error: function() {
                    Swal.close();
                    Swal.fire("Error", "Failed to create order.", "error");
                }
            });
        }

        function storeMilestonePayment(response, sow_id, price, mileston_id, booking_id) {
            PleaseWait();

            $.ajax({
                url: "{{ route('user.milestone.payment') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    mileston_id: mileston_id,
                    booking_id: booking_id,
                    sow_id: sow_id,
                    price: price,
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature
                },
                success: function(res) {
                    Swal.close();
                    Swal.fire("Success", res.message, "success").then(() => {
                        window.location.reload();
                    });
                },
                error: function() {
                    Swal.close();
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        }
    </script>
@endsection

@php
    $title = 'Bookings - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp


@extends('layouts.front.user-app')

@section('pageContent')
<style>
    th{
            font-weight: 600;
    }
</style>
{{-- header --}}
<div class="mb-3 mb-lg-4">
    <div class="d-flex gap-3 flex-wrap">
        <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="ri-menu-2-line"></i>
        </button>
        <h1 class="fw-bold">Booking Detail</h1>
    </div>
    <p class="mb-0">Logo Design - Basic</p>
</div>

{{-- bookings list --}}
<div class="overflow-x-hidden">
    <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bcall-tab" data-bs-toggle="tab" data-bs-target="#bcall-tab-pane" type="button" role="tab" aria-controls="bcall-tab-pane" aria-selected="true">Booking Call</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="lb-details-tab" data-bs-toggle="tab" data-bs-target="#lb-details-tab-pane" type="button" role="tab" aria-controls="lb-details-tab-pane" aria-selected="false">Live Booking Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="project-details-tab" data-bs-toggle="tab" data-bs-target="#project-details-tab-pane" type="button" role="tab" aria-controls="project-details-tab-pane" aria-selected="false">Project Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="milestone-tab" data-bs-toggle="tab" data-bs-target="#milestone-tab-pane" type="button" role="tab" aria-controls="milestone-tab-pane" aria-selected="false">Milestones</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="task-tab" data-bs-toggle="tab" data-bs-target="#task-tab-pane" type="button" role="tab" aria-controls="task-tab-pane" aria-selected="false">Tasks</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="team-tab" data-bs-toggle="tab" data-bs-target="#team-tab-pane" type="button" role="tab" aria-controls="team-tab-pane" aria-selected="false">Team</button>
        </li>
    </ul>
    <div class="tab-content mt-2" id="myTabContent">
        <div class="tab-pane fade show active" id="bcall-tab-pane" role="tabpanel" aria-labelledby="bcall-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-sm mb-0">
                        <thead>
                            <tr>
                            <th scope="col" class="bg-light">Schedule Time</th>
                            <th scope="col" class="bg-light">Call Status</th>
                            <th scope="col" class="bg-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($booking->firstCall))
                            <tr>
                                <td>{{formatDateReadable($booking->firstCall->scheduled_at)}}</td>
                                <td>
                                    @if($booking->firstCall->status=='pending')
                                    <span class="badge text-bg-info">An account manager will reach out to you soon.</span>
                                    @else
                                    <span class="badge text-bg-info">{{ ucfirst($booking->firstCall->status) }}</span>
                                    @endif
                                </td>
                                <td>

                               
                                    @if($booking->firstCall->status =='scheduled')
                                    
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#meetingModal"><i class="ri-hand"></i> Show Meeting Details </button>
                                    @elseif($booking->firstCall->status=='completed')
                                    <span class="badge text-bg-success">Completed</span>

                                    @else
                                    <span class="badge text-bg-warning">....</span>
                                    @endif
                                </td>
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
        </div>
        <div class="tab-pane fade" id="lb-details-tab-pane" role="tabpanel" aria-labelledby="lb-details-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-sm mb-0">
                        <thead>
                            <tr>
                            <th scope="col" class="bg-light">Gig Name</th>
                            <!--<th scope="col" class="bg-light">Initial Payment %</th>-->
                            <th scope="col" class="bg-light">Initial Paid Amount</th>
                            <th scope="col" class="bg-light">Total Amount</th>
                            <th scope="col" class="bg-light">Booking Status</th>
                            <th scope="col" class="bg-light">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td>
                                    {{ $booking->statementOfWork->title ?? $booking->booking_id }}
                                    <p class="mb-0 text-sm text-secondary">
                                        {{ formatDateReadable($booking->created_on) }}
                                    </p>
                                </td>
                                {{--<td>{{ $booking->statementOfWork->initial_payment_percentage ?? 'N/A' }}%</td>--}}
                                <td>₹ {{ $booking->initial_paid_amount ?? 'N/A' }}</td>
                                <td>₹ {{ $booking->total_price ?? 'N/A' }}</td>
                                <td>
                                    @if ($booking->status == 'pending')
                                        <span class="badge text-bg-warning">Pending</span>
                                    @else
                                        <span class="badge text-bg-success">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->payment_status == 'pending')
                                        <span class="badge text-bg-warning">Pending</span>
                                    @else
                                        <span class="badge text-bg-success">{{ ucfirst($booking->payment_status) }}</span>
                                    @endif
                                </td>
                            </tr>      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="project-details-tab-pane" role="tabpanel" aria-labelledby="project-details-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-sm mb-0">
                        <thead>
                            <tr>
                            <th scope="col" class="bg-light">Project Info</th>
                            <th scope="col" class="bg-light">Price</th>
                            <th scope="col" class="bg-light">Booked On</th>
                            <th scope="col" class="bg-light">Status</th>
                            <th scope="col" class="bg-light">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if(!empty($booking->project))
                            <tr>
                                <td>{{ $booking->statementOfWork->service->name ?? 'No service' }} ->
                                                {{ $booking->statementOfWork->subservice->name ?? 'No service' }} <br>
                                                {!! trimWords($booking->statementOfWork->description ?? 'No service')!!}
                                                </td>
                                <td>₹ {{ $booking->initial_paid_amount ?? 'NA' }}</td>
                                <td>{{ $booking->created_on ?? 'N/A' }}</td>
                                <td>
                                    @if ($booking->project->project_status == 'not_started')
                                        <span class="badge text-bg-light">Not Started</span>
                                    @elseif ($booking->project->project_status == 'active')
                                        <span class="badge text-bg-warning">{{ $booking->project->project_status??'NA' }}</span>
                                    @else
                                        <span class="badge text-bg-success">{{ $booking->project->project_status ??'NA'}}</span>
                                    
                                    @endif
                                </td>
                                <td>{{ $booking->project->created_on ?? 'N/A' }}</td>
                            </tr>  
                            @else
                            No Projects!
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="milestone-tab-pane" role="tabpanel" aria-labelledby="milestone-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-sm mb-0">
                        <thead>
                            <tr>
                            <th scope="col" class="bg-light">#</th>
                            <th scope="col" class="bg-light">Due Date</th>
                            <th scope="col" class="bg-light">Title</th>
                            <th scope="col" class="bg-light">Description</th>
                            <th scope="col" class="bg-light">Amount</th>
                            <th scope="col" class="bg-light">status</th>
                            <th scope="col" class="bg-light">Created</th>
                            <th scope="col" class="bg-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if (!empty($booking->project->milestones) && count($booking->project->milestones) > 0)
                            @php $i=1; @endphp
                                @foreach ($booking->project->milestones as $milestone)
                            <tr>
                                <th scope="row">{{ $i++}}</th>
                                <td>{{ $milestone->due_date }}</td>
                                <td>{{ $milestone->title ?? 'NA' }}</td>
                                <td>{{ $milestone->description ?? 'N/A' }}</td>
                                <td>₹ {{ $milestone->amount ?? 'N/A' }}</td>
                                <td>
                                    @if ( $milestone->status == 'pending')
                                        <span class="badge text-bg-warning">Pending</span>
                                    @elseif($milestone->status == 'request_payment')
                                        <span class="badge text-bg-info">Payment Request</span>
                                    @else
                                        <span class="badge text-bg-success">{{ $milestone->status }}</span>
                                    @endif
                                </td>
                                <td>{{ formatDateReadable($milestone->created_on)}}</td>
                                <td>

                                    @if ($milestone->status == 'request_payment')
                                        <button class="btn btn-sm btn-accent milestone-payment-btn"
                                            data-id="{{ $milestone->id }}"
                                            data-sow_id="{{ $booking->sow_id }}"
                                            data-price="{{ $milestone->amount }}"
                                            data-booking_id="{{ $booking->id }}">Pay
                                            ₹{{ $milestone->amount }}</button>
                                    @elseif($milestone->status == 'completed')
                                        <span class="badge text-bg-info">{{ $milestone->status }}</span>
                                    @else
                                        ---
                                    @endif

                                </td>
                            </tr>                    
                            @endforeach
                             @else
                                 </tr> 
                                 <td colspan="4">
                                    No Data Found!
                                 </td> 
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="task-tab-pane" role="tabpanel" aria-labelledby="task-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-sm mb-0">
                        <thead>
                            <tr>
                            <th scope="col" class="bg-light">#</th>
                            <th scope="col" class="bg-light">Title</th>
                            <th scope="col" class="bg-light">Due Date</th>
                            <th scope="col" class="bg-light">Description</th>
                            <th scope="col" class="bg-light">status</th>
                            <th scope="col" class="bg-light">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if(!empty($booking->project->milestones) && count($booking->project->milestones) > 0)
                            @php $i=1; @endphp
                                @foreach ($booking->project->milestones as $milestone)
                                    @if (!empty($milestone->tasks) && count($milestone->tasks) > 0)
                                        @foreach ($milestone->tasks as $task)
                                        <tr>
                                            <th scope="row">{{ $i++}}</th>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->due_date }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>
                                                @if ($task->status == 'Pending')
                                                    <span class="badge text-bg-warning">Pending</span>
                                                @else
                                                    <span class="badge text-bg-success">{{ucfirst($task->status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{ $task->created_on }}</td>
                                        </tr>                    
                                        @endforeach
                                    @endif
                                @endforeach
                                 @else
                                 </tr> 
                                 <td colspan="4">
                                    No Task Found!
                                 </td> 
                                </tr>
                                        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="team-tab-pane" role="tabpanel" aria-labelledby="team-tab" tabindex="0">
            <div class="border rounded-2 p-3">
                <div class="row">

                                    

                                @if(!empty($booking))
                                    <div class="col-sm-4">
                                        <div class="card shadow-sm rounded" style="max-width: 350px; border: none;">

                                            {{-- Top Section --}}
                                            <div class="d-flex align-items-center p-3">
                                                <img src="{{ asset(GetProfile($booking->assign_to) ?? 'front/assets/images/default_dp.png') }}"
                                                    alt="Profile"
                                                    class="rounded-circle me-3"
                                                    width="60" height="60">

                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 fw-bold">{{ GetUser($booking->assign_to)->name ?? 'No Name' }}</h6>

                                                     @php 
                                                            $user_id=GetUser($booking->assign_to)->role_id ?? 0;
                                                            @endphp
                                                            <small>{{ getRoleNamebyId($user_id)->name ?? 'No One assign'}}</small>
                                                </div>
                                            </div>

                                            {{-- Divider Line --}}
                                            <hr class="my-0">

                                            {{-- Footer Section: Bio --}}
                                            <div class="card-footer bg-white border-0 px-3 py-2">
                                                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                                    {{ \Illuminate\Support\Str::words(UserProfile($booking->assign_to)->bio ?? 'No bio available.', 30) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                     @if(!empty($booking->project->milestones) && count($booking->project->milestones) > 0)
                            @php $i=1; @endphp
                                @foreach ($booking->project->milestones as $milestone)
                                    @if (!empty($milestone->tasks) && count($milestone->tasks) > 0)
                                        @foreach ($milestone->tasks as $task)
                                            <div class="col-sm-4">
                                                <div class="card shadow-sm rounded" style="max-width: 350px; border: none;">

                                                    {{-- Top Section --}}
                                                    <div class="d-flex align-items-center p-3">
                                                        <img src="{{ asset(GetProfile($task->assigned_to) ?? 'front/asset/images/default-profile.png') }}"
                                                            alt="Profile"
                                                            class="rounded-circle me-3"
                                                            width="60" height="60">

                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0 fw-bold">{{ GetUser($task->assigned_to)->name ?? 'No Name' }}</h6>
                                                            @php 
                                                            $user_id=GetUser($task->assigned_to)->role_id
                                                            @endphp
                                                            <small>{{ getRoleNamebyId($user_id)->name}}</small>


                                                            {{-- Rating --}}
                                                            @php $rating = getUserRating($task->assigned_to); @endphp
                                                            <div class="text-warning mt-1" style="font-size: 0.9rem;">
                                                                {!! $rating['stars'] !!}
                                                                <span class="text-muted">{{ $rating['text'] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Divider Line --}}
                                                    <hr class="my-0">

                                                    {{-- Footer Section: Bio --}}
                                                    <div class="card-footer bg-white border-0 px-3 py-2">
                                                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                                            {{ \Illuminate\Support\Str::words(UserProfile($task->assigned_to)->bio ?? 'No bio available.', 30) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                    @endif
                                    @endforeach 
                                    @endif
                </div>

            </div>
        </div>

    </div>
</div>




<!-- here new modal  -->
 <div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="bookingModalLabel">Meeting Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		
			<div class="input-group">
                <input
                    type="text"
                    class="form-control focus-shadow-none"
                    id="meetingLink"
                    value="{{ $booking->firstCall->call_link }}"
                    readonly>
            
                <button class="btn btn-secondary text-white" 
                        type="button" 
                        id="copyBtn" 
                        title="Copy link">
                    Copy
                </button>
            </div>



            <div class="mb-3 mt-3">
				<label for="formDate" class="text-sm text-muted mb-1">Note</label>
				
                <textarea class="form-control w-100 focus-shadow-none" name="" id="" cols="20" rows="3" readonly>{{$booking->firstCall->notes}} </textarea>
			</div>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{$booking->firstCall->call_link}}" target="_blank" class="btn btn-main">Join Now</a>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        
       const copyBtn = document.getElementById("copyBtn");
    const meetingLink = document.getElementById("meetingLink");

    copyBtn.addEventListener("click", function () {
        // Copy text
        navigator.clipboard.writeText(meetingLink.value).then(function () {
            // Change title to "Copied!"
            copyBtn.setAttribute("title", "Copied!");
            
            // Optional: also change button text
            copyBtn.innerText = "Copied!";

            // Reset back after 2 seconds
            setTimeout(() => {
                copyBtn.setAttribute("title", "Copy link");
                copyBtn.innerText = "Copy";
            }, 2000);
        });
    });
    
    
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
                         image: "https://elyvato.com/front/assets/images/elyvato-header-logo.png",
                        order_id: orderData.order_id,
                        handler: function(response) {
                            storeMilestonePayment(response, sow_id, price, mileston_id, booking_id);
                        },
                        theme: {
                            color: "#8c32f6"
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

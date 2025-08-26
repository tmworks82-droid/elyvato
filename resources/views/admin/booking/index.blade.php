@php
    $page_name = 'Bookings';

    $permission = 'booking';
@endphp

@extends('layouts.main')
@section('title', 'Elyvato Content| ' . $page_name . ' list')
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
    font-weight: bold; /* Bold for unvisited links */
    color: #2e2e39; /* Color for unvisited links */
    text-decoration: none; /* Remove underline */
}

.project_link_visited {
    font-weight: normal; /* Normal weight for visited links */

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
                        <h1>{{ $page_name }} page </h1>
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
                            <div class="card-header">
                                <h3 class="card-title">{{ $page_name }} data</h3>
                            </div>
                            <div class="card">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="predefined-tab" data-toggle="tab" href="#predefined"
                                            role="tab" aria-controls="predefined" aria-selected="true">
                                       
                                            Predefined
                                            Booking 
                                            @if( $predefinedBookings->where('is_visited', 'no')->count())
                                          <span class="badge-notification">{{$predefinedBookings->where('is_visited', 'no')->count()}}</span>
                                       @endif
                                            </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tab" data-toggle="tab" href="#custom" role="tab"
                                            aria-controls="custom" aria-selected="false">
                                            
                                            Custom Booking @if( $customBookings->where('is_visited', 'no')->count())
                                          <span class="badge-notification">{{$customBookings->where('is_visited', 'no')->count()}}</span>
                                       @endif
                                            </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="instant-tab" data-toggle="tab" href="#instantHire" role="tab"
                                            aria-controls="instant" aria-selected="false">
                                            
                                            Instant Hire Booking
                                            @if( $instantHire->where('is_visited', 'no')->count())
                                          <span class="badge-notification">{{$instantHire->where('is_visited', 'no')->count()}}</span>
                                       @endif
                                            </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content pt-3">

                                    <!-- Predefined Booking -->
                                    <div class="tab-pane fade show active" id="predefined" role="tabpanel"
                                        aria-labelledby="predefined-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Gig</th>
                                                    <th>Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Initial %</th>
                                                    <th>Total Price</th>
                                                    <th>Paid</th>
                                                    <th>Status</th>
                                                    <th>Subscription Status</th>
                                                    <th>Created On</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                
                                                @foreach ($predefinedBookings as $booking)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                       
                                                        <td> 
                                                        @if(!empty($booking->assign_to))
                                                        @if($booking->is_visited=='no')
                                                            <a href="{{ url('booking-calls', $booking->id) }}" class="project-link" data-type="booking" data-id="{{$booking->id}}">{{ $booking->user->username ?? 'Name' }}</a>
                                                            @else 
                                                            <a href="{{ url('booking-calls', $booking->id) }}">{{ $booking->user->username ?? 'Name' }}</a>
                                                            @endif 
                                                        @else
                                                        <span class="badge badge-warning text-light booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                data-target="#assign_to_manager" style="cursor:pointer">Booking not assign</span>

                                                        @endif
                                                        </td>
                                                        
                                                        <td>{{ $booking->statementOfWork->title ?? 'N/A' }}</td>
                                                        <td>
                                                           
                                                            @if($booking->status=='pending')

                                                            <span class="badge badge-warning text-light">Pending</span>
                                                                @elseif($booking->payment_status=='paid')
                                                                <span
                                                                class="badge badge-info text-light">Paid</span>
                                                                @elseif($booking->payment_status=='in_progress')
                                                                <span class="badge badge-info text-light">In Progress</span>

                                                                @elseif($booking->payment_status=='success')
                                                                <span class="badge badge-success text-light">Success</span>

                                                                @else
                                                                <span
                                                                class="badge badge-danger text-light">Cancelled</span>
                                                                @endif

                                                        </td>
                                                        <td>
                                                                @if($booking->payment_status=='success')
                                                                    <span class="badge badge-success">Success</span>
                                                                    @else
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @endif
                                                        </td>
                                                        <td>{{ $booking->initial_payment_percentage }}%</td>
                                                        <td>{{ $booking->total_price }}</td>
                                                        <td>{{ $booking->initial_paid_amount }}</td>
                                                        <td>
                                                            @if ($booking->is_active == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($booking->booking_subscription=='yes')
                                                            <span class="badge badge-success">Yes</span>
                                                            @if($booking->booking_subscription_status=='live')
                                                            <span class="badge badge-success">{{ucfirst($booking->booking_subscription_status)}}</span>
                                                            @else 
                                                            <span class="badge badge-danger">Yes({{ ucfirst($booking->booking_subscription_status)}}</span>
                                                            @endif
                                                            @else 
                                                            <span class="badge badge-dark text-light">No</span>
                                                            @endif
                                                            </td>
                                                        
                                                        <td>{{ formatDateReadable($booking->created_at) }}</td>
                                                        <td> 
                                                           @php 
                                                              $call=\App\Models\Call::where('booking_id',$booking->id)->first();
                                                            @endphp
                                                        @if(!empty($call))
                                                         @if($call->status=='pending')
                                                        
                                                            <button class="btn btn-sm bg-warning booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                data-target="#assign_to_manager">Assign</button>
                                                            @else
                                                                <span class="badge badge-success">{{ ucfirst($call->status) }}</span>
                                                        @endif
                                                        @endif
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Custom Booking -->
                                    <div class="tab-pane fade" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>SOW</th>
                                                    <th>Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Initial %</th>
                                                    <th>Total Price</th>
                                                    <th>Paid</th>
                                                    <th>Status</th>
                                                    <th>Created On</th>
                                                    <th>Action</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach ($customBookings as $booking)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                             @if(!empty($booking->assign_to))
                                                                @if($booking->is_visited=='no')
                                                                 <a href="{{ url('booking-calls', $booking->id) }}" class="project-link" data-type="booking" data-id="{{$booking->id}}">{{ $booking->user->username ?? 'Name' }}</a>
                                                                @else 
                                                                <a href="{{ url('booking-calls', $booking->id) }}">{{ $booking->user->username ?? 'Name' }}</a>
                                                                @endif
                                                            @else
                                                            <span class="badge badge-warning text-light booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                    data-target="#assign_to_manager" style="cursor:pointer">Booking not assign</span>
    
                                                            @endif
                                                            
                                                        </td>
                                                        <td>{{ $booking->statementOfWork->title ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge badge-warning">{{ ucfirst($booking->status) }}</span>

                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-warning">{{ ucfirst($booking->payment_status) }}</span>
                                                        </td>
                                                        <td>{{ $booking->initial_payment_percentage }}%</td>
                                                        <td>{{ $booking->total_price }}</td>
                                                        <td>{{ $booking->initial_paid_amount }}</td>
                                                        <td>
                                                            @if ($booking->is_active == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @endif
                                                        </td>
                                                      
                                                        <td>{{ formatDateReadable($booking->created_at) }}</td>
                                                        <td>
                                                            
                                                             @php 
                                                              $call=\App\Models\Call::where('booking_id',$booking->id)->first();
                                                            @endphp
                                                        @if(!empty($call))
                                                         @if($call->status=='pending')
                                                        
                                                            <button class="btn btn-sm bg-warning booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                data-target="#assign_to_manager">Assign</button>
                                                            @else
                                                                <span class="badge badge-success">{{ ucfirst($call->status) }}</span>
                                                        @endif
                                                      
                                                        @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!--instant hire -->
                                    
                                     <div class="tab-pane fade" id="instantHire" role="tabpanel" aria-labelledby="instant-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Talent Name</th>
                                                    <th>Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Initial %</th>
                                                    <th>Total Price</th>
                                                    <th>Paid</th>
                                                    <th>Status</th>
                                                    <th>Created On</th>
                                                    <th>Action</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach ($instantHire as $booking)
                                                
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                             @if(!empty($booking->assign_to))
                                                                @if($booking->is_visited=='no')
                                                                 <a href="{{ url('booking-calls', $booking->id) }}" class="project-link" data-type="booking" data-id="{{$booking->id}}">{{ $booking->user->username ?? 'Name' }} ({{ $booking->user->mobile ?? 'Name' }})</a>
                                                                @else 
                                                                <a href="{{ url('booking-calls', $booking->id) }}">{{ $booking->user->username ?? 'Name' }} ({{ $booking->user->mobile ?? 'Name' }})</a>
                                                                @endif
                                                             @else
                                                            <span class="badge badge-warning text-dark booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                    data-target="#assign_to_manager" style="cursor:pointer">Booking not assign </span>
                                                                    <span class="booking-ids text-bold">{{ $booking->user->username ?? 'Name' }} ({{ $booking->user->mobile ?? 'Name' }})</span>
                                                                    
    
                                                            @endif
                                                            
                                                        </td>
                                                        <td>{{ $booking->hireTalent->name ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge badge-warning">{{ ucfirst($booking->status) }}</span>

                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge badge-warning">{{ ucfirst($booking->payment_status) }}</span>
                                                        </td>
                                                        <td>{{ $booking->initial_payment_percentage }}%</td>
                                                        <td>{{ $booking->total_price }}</td>
                                                        <td>{{ $booking->initial_paid_amount }}</td>
                                                        <td>
                                                            @if ($booking->is_active == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @endif
                                                        </td>
                                                      
                                                        <td>{{ formatDateReadable($booking->created_at) }}</td>
                                                        <td>
                                                            
                                                             @php 
                                                              $call=\App\Models\Call::where('booking_id',$booking->id)->first();
                                                            @endphp
                                                        @if(!empty($call))
                                                         @if($call->status=='pending')
                                                        
                                                            <button class="btn btn-sm bg-warning booking-ids" data-id="{{ $booking->id }}" data-toggle="modal"
                                                                data-target="#assign_to_manager">Assign</button>
                                                            @else
                                                                <span class="badge badge-success">{{ ucfirst($call->status) }}</span>
                                                        @endif
                                                      
                                                        @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
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

              <div class="modal fade" id="assign_to_manager" tabindex="-1" role="dialog" aria-labelledby="assign_to_manager"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="assign_to_manager">Assign Booking</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="assign_booking_to" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Title -->
                                <div class="mb-3">
                                    <input type="hidden" id="booking_id" name="booking_id">

                                    <label class="form-label">Assign To</label>
                                    <select name="assign_to" class="form-control" id="assign_to">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="button" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // alert('run');
            
            $('.booking-ids').on('click', function() {
                var bookingId = $(this).data('id'); 
                // alert('Booking ID: ' + bookingId);
                $('#booking_id').val(bookingId);
            });

            $('#assign_booking_to').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                // alert('run');
            
                $.ajax({
                    url: "{{ route('mannual.assign.booking') }}",     
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    
                    success: function(response) {
                        if (response.success) {

                            $('#assign_booking_to')[0].reset(); 

                            $('#assign_to_manager').modal('hide'); 
                            $.toast({
                                heading: 'Success',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);

                        } else {
                            alert("Error!", response.message, "error")
                        }
                    },
                    error: function(xhr) {
                        alert("Oops!", "Something went wrong!", "error");
                    }
                });
            });
        });



            // here bold and unbold text 
    
$(document).ready(function () {
    // When a link with class 'project-link' is clicked
    $('.project-link').on('click', function (e) {
        e.preventDefault(); // Prevent the default action (opening the link)
        
        var linkId = $(this).data('id'); // Get the project ID from data-id
        var type=$(this).data('type');
        var link = $(this);
        // Send an AJAX request to update the 'is_visited' field
        $.ajax({
            url: '/update-booking-visited',  // URL to handle the update
            method: 'POST', // HTTP Method
            data: {
                _token: '{{ csrf_token() }}',  // CSRF token for security
                linkId: linkId,
                type:type// Sending the project ID
            },
            success: function(response) {
                // Handle the response (you can apply the visited class here if needed)
                if(response.success==true) {
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
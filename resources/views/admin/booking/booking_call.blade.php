@php
    $page_name = 'Bookings Call';

    $permission = 'booking_call';
@endphp

@extends('layouts.main')
@section('title', 'Elyvato Content| ' . $page_name . ' list')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.13.18/jquery.timepicker.min.css">

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
                                @if (!empty($custom_booking))
                                    <button class="btn btn-sm btn-info float-right m-1" data-toggle="modal"
                                        data-target="#viewrequirement">View Custome Requirement</button>
                              
                                @php
                                  $project= App\Models\Project::where('booking_id',$custom_booking->booking_id)->first();
                                @endphp
                                @if(!empty($project))
                                <a href="#" class="btn btn-warning btn-sm float-right m-1" data-id="{{ $project->id }}"
                                                        data-toggle="modal" data-target="#addproject_details">
                                                        Add Project Requirement
                                    </a>
                                    @endif
                                  @endif
                                                    
                            </div>
                            <div class="card">
                                <!-- Nav tabs -->
                                <!-- Tab panes -->
                                <div class="tab-content pt-3">

                                    <!-- Predefined Booking -->
                                    <div class="tab-pane fade show active" id="predefined" role="tabpanel"
                                        aria-labelledby="predefined-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Customer Info</th>
                                                    <th>Schedule Time</th>
                                                    <th>Call Link</th>
                                                    <th>Status </th>
                                                    <th>Created On</th>
                                                    <th>Notes</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>{{ GetUser($call_booking->created_by)->username ??'No Username' }} ({{ GetUser($call_booking->created_by)->mobile }})</td>
                                                    <td> {{ formatDateReadable($call_booking->scheduled_at) ?? 'N/A' }} </td>
                                                    
                                                    <td>
                                                        @if($call_booking->status !=='pending')
                                                         <a href="{{ $call_booking->call_link }}" target="_blank">
                                                                <span class="badge badge-info"> Meet Link
                                                                <i class="fas fa-link"></i></span>
                                                                </a>
                                                           @else
                                                           N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">{{ UCfirst($call_booking->status) }}</span>
                                                    </td>
                                                    <td>{{ formatDateReadable($call_booking->created_on) }}</td>
                                                    <td>{{ $call_booking->notes }}</td>

                                                    <td>
                                                        @if ($call_booking->status == 'pending')
                                                            <button class="btn btn-sm bg-warning" data-toggle="modal"
                                                                data-target="#sechdul_call"> Schedule Call</button>
                                                        @elseif($call_booking->status == 'scheduled')
                                                            <button class="btn btn-sm bg-success mark-completed-btn"
                                                                data-bookingType="@if (!empty($custom_booking)) custome_booking @else predefine @endif"
                                                                data-type="completed"
                                                                data-id="{{ $call_booking->id }}">Meeting Done
                                                                </button>
                                                                
                                                            <button class="btn btn-sm bg-danger mark-completed-btn"
                                                                data-type="cancelled"
                                                                data-id="{{ $call_booking->id }}">Cacelled</button>
                                                                
                                                        @elseif($call_booking->status == 'completed')
                                                            <span class="badge badge-info"> Completed</span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                                {{ $call_booking->status }}</span>
                                                               <button class="btn btn-sm bg-warning" data-toggle="modal"
                                                                data-target="#re_sechduleCall"> Re-schedule</button>
                                                        @endif
                                                    </td>
                                                </tr>

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

            <div class="modal fade" id="sechdul_call" tabindex="-1" role="dialog" aria-labelledby="sechdul_call"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="sechdul_call">Schedule a call</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                        </div>

                        <form id="sechduleCall" method="POST">
                            @csrf
                            <input type="hidden" name="call_id" id="call_id" value="{{ $call_booking->id }}">

                            <div class="modal-body">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label class="form-label">Meet Link</label>
                                    <input type="text" name="call_link" id="call_link" class="form-control"
                                        placeholder=" Meet link here...">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Note</label> <br>
                                    <textarea name="note" id="note" cols="60" rows="3" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="button" class="btn btn-primary call-schedule">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            
            
            <!--re-schedule call -->
            
              <div class="modal fade" id="re_sechduleCall" tabindex="-1" role="dialog" aria-labelledby="re_sechduleCall"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="re_sechduleCall">Re-Schedule a call</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="re-sechduleCall" method="POST">
                            @csrf
                           
                            <input type="hidden" name="booking_id" id="id" value="{{ $call_booking->booking_id }}">

                            <div class="modal-body">
                                <!-- Title -->
                                <div class="mb-3">
                                        <label class="form-label"> Date</label>
                                        <input type="date" name="date" id="date" class="form-control" required="" min="2025-08-23">
                                </div>
                                
                            <div class="mb-3">
                              <label class="form-label">Time</label>
                              <select name="time" id="time" class="form-control" required></select>
                            </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Meet Link</label>
                                    <input type="text" name="call_link" id="call_link" class="form-control"
                                        placeholder=" Meet link here...">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Note</label> <br>
                                    <textarea name="note" id="note" cols="60" rows="3" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="button" class="btn btn-primary call-schedule">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="addproject_details" tabindex="-1" role="dialog"
                                aria-labelledby="addproject_details" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addproject_details">Note Project Required</h5>
                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button> --}}
            
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                            </button>
            
                                        </div>
            
                                        <form id="add_project_details" method="POST">
                                            @csrf
                                            <input type="hidden" name="project_id" id="project_id" value="{{ $project->id ?? 0 }}">
            
                                            <div class="modal-body">
                                                <!-- Title -->
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label> <br>
                                                    
                                                                   
                                                    <textarea rows="8" class="form-control" cols="25" name="description" id="description"> {{$project->description?? 'No description'}}</textarea>
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

    <div class="modal fade" id="viewrequirement" tabindex="-1" role="dialog" aria-labelledby="viewrequirementLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg rounded">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="viewrequirementLabel">Custom Booking Requirement</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        style="opacity: 1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="font-weight-bold">Name:</label>
                            <p class="mb-0 text-dark"> {{ GetUser($custom_booking->user_id ?? '')->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="font-weight-bold">Service:</label>
                            <p class="mb-0 text-dark">{{ ServiceNmae($custom_booking->service_id ?? '')->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">Subservice:</label>
                            <p class="mb-0 text-dark">
                                {{ SubServiceNmae($custom_booking->subservice_id ?? '')->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Cost:</label>
                            <p class="mb-0 text-success"><strong>₹{{ $custom_booking->cost_amount ?? '0.00' }}</strong>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="font-weight-bold">Description:</label>
                            <div class="bg-light p-3 rounded text-dark" style="min-height: 100px;">
                                {!! nl2br(e($custom_booking->brief_description ?? 'No description provided.')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


@endsection
@push('scripts')
  <!-- jQuery -->
   <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>-->
        <!--<script src="https://cdn.rawgit.com/mugifly/jquery-simple-datetimepicker/72933bbe/jquery.simple-dtpicker.js"></script>-->
        <!--<link href="https://cdn.rawgit.com/mugifly/jquery-simple-datetimepicker/72933bbe/jquery.simple-dtpicker.css" rel="stylesheet" />-->

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script>
        
   CKEDITOR.replace('description');
         
$(function(){
  let start = 7 * 60;        // 7:00 AM in minutes
  let end   = 23 * 60 + 30;  // 11:30 PM in minutes

  for(let mins = start; mins <= end; mins += 30){
    let h = Math.floor(mins/60);
    let m = mins % 60;
    let ampm = h >= 12 ? 'PM' : 'AM';
    let displayH = (h % 12) || 12;
    let displayM = m < 10 ? '0'+m : m;
    let display = displayH + ':' + displayM + ' ' + ampm;
    let value   = (h<10?'0':'')+h+':' + (m<10?'0':'')+m;

    $('#time').append(new Option(display, value));
  }
});

         
        $(document).ready(function() {
            // alert('run');
            $('#sechduleCall').on('submit', function(e) {
                e.preventDefault();
                
                 let $btn = $('.call-schedule');    
                $btn.prop('disabled', true).html('Processing....');

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('booking.callschedule') }}", // Replace with your actual route
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $btn.prop('disabled', false).html('Save');
                        if (response.success) {

                            $('#sechduleCall')[0].reset(); // Optional: reset the form

                            $('#sechdul_call').modal('hide'); // If your modal ID is taskModal
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
                            $btn.prop('disabled', false).html('Save');

                        }
                    },
                    error: function(xhr) {
                        alert("Oops!", "Something went wrong!", "error");
                        $btn.prop('disabled', false).html('Save');

                    }
                });
            });
     
        
        // re-schedule call here 
         $('#re-sechduleCall').on('submit', function(e) {
                e.preventDefault();
                
                 let $btn = $('.call-schedule');    
                $btn.prop('disabled', true).html('Processing....');

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('re.callschedule') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $btn.prop('disabled', false).html('Save');
                        if (response.success) {

                            $('#re-sechduleCall')[0].reset(); // Optional: reset the form

                            $('#re_sechduleCall').modal('hide'); // If your modal ID is taskModal
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
                            $btn.prop('disabled', false).html('Save');

                        }
                    },
                    error: function(xhr) {
                        alert("Oops!", "Something went wrong!", "error");
                        $btn.prop('disabled', false).html('Save');

                    }
                });
            });
        });



        $(document).on('click', '.mark-completed-btn', function(e) {
            e.preventDefault();

            let bookingType = $(this).data('data-bookingtype');
            let type = $(this).data('type');
            let callId = $(this).data('id');


            Swal.fire({
                title: 'Are you sure?',
                text: "You want to mark this call as " + type + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '{{ route('call.booking.status') }}', // adjust route name
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            call_id: callId,
                            type: type,
                            bookingType: bookingType
                        },
                        success: function(response) {
                            if (response.success) {

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

                                // Optionally update button or reload
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function() {
                            Swal.fire("Oops!", "Something went wrong.", "error");
                        }
                    });
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

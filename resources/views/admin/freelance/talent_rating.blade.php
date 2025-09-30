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
                        <div class="card card-primary">

                            <div class="card-header">
                                <h3 class="card-title">Freelancer Info</h3>

                                @if ($freelancer->is_hired == 'yes')
                                    <span class="badge badge-warning float-right">Hired</span>
                                @else
                                    <span class="badge badge-danger float-right">Not Hired</span>
                                @endif

                            </div>

                            <div class="card-body row">
                                <div class="col-sm-3">
                                    <strong><i class="fas fa-user mr-1"></i> Name</strong>
                                    <p class="text-muted">{{ $freelancer->name ?? $freelancer->username }}</p>
                                </div>

                                {{-- <hr> --}}
                                <div class="col-sm-3">
                                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                    <p class="text-muted">{{ $freelancer->email }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
                                    <p class="text-muted">{{ $freelancer->mobile }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-info-circle mr-1"></i> Bio</strong>
                                    <p class="text-muted">{{ $freelancer->profile->bio ?? 'No bio added ' }}</p>
                                    </p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                    <p class="text-muted">{{ $freelancer->profile->address_line1 ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-city mr-1"></i> City</strong>
                                    <p class="text-muted">{{ $freelancer->profile->city ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-flag mr-1"></i> State</strong>
                                    <p class="text-muted">{{ $freelancer->profile->state ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-globe mr-1"></i> Country</strong>
                                    <p class="text-muted">{{ $freelancer->profile->country->country_name ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-building mr-1"></i> Company</strong>
                                    <p class="text-muted">{{ $freelancer->profile->company_name ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-user-tie mr-1"></i> Talent</strong>
                                    <p class="text-muted">{{ $freelancer->profile->talent->name ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-briefcase mr-1"></i> Experience</strong>
                                    <p class="text-muted">{{ $freelancer->profile->years_experience ?? '0' }} Years</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-graduation-cap mr-1"></i> Qualification</strong>
                                    <p class="text-muted">{{ $freelancer->profile->highest_qualification ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-language mr-1"></i> Languages</strong>
                                    <p class="text-muted">{{ $freelancer->profile->languages_spoken ?? '-' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-file-invoice mr-1"></i> GST</strong>
                                    <p class="text-muted">{{ $freelancer->profile->gst_number ?? 'Not Provided' }}</p>
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-certificate mr-1"></i> Certification</strong>

                                    @if (!empty($freelancer->profile->certification_file))
                                        <a href="{{ url($freelancer->profile->certification_file) }}"
                                            target="_blank">View</a>
                                    @else
                                        <p class="text-muted">Not Uploaded</p>
                                    @endif
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-briefcase mr-1"></i> Portfolio</strong>
                                    @if (!empty($freelancer->profile->portfolio_file))
                                        <a href="{{ url($freelancer->profile->portfolio_file) }}" target="_blank">View</a>
                                    @else
                                        <p class="text-muted">Not Uploaded</p>
                                    @endif
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-file-alt mr-1"></i> Rate Card</strong>
                                    @if (!empty($freelancer->profile->rate_card_file))
                                        <a href="{{ url($freelancer->profile->rate_card_file) }}" target="_blank">View</a>
                                    @else
                                        <p class="text-muted">Not Uploaded</p>
                                    @endif
                                </div>

                                <div class="col-sm-3">
                                    <strong><i class="fas fa-user-circle mr-1"></i> Profile Picture</strong>

                                    @if (!empty($freelancer->profile->image))
                                        <img src="{{ url($freelancer->image) }}" alt="Profile Picture"
                                            width="60" height="60" class="rounded-circle">
                                    @else
                                        <p class="text-muted">Not Uploaded</p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Skills Evaluation</h3>
                            </div>

                            <form id="talent_rating_form" method="POST" action="#">
                                @csrf

                                <div class="card-body">
                                    <input type="hidden" name="user_id" value="{{ $freelancer->id }}">

                                    <div class="form-group">
                                        <label for="creative">Creative</label>
                                        <input type="number" class="form-control" id="creative" name="creative"
                                            placeholder="Rate 1-5" min="1" max="5"
                                            value="{{ $freelancer->profile->creative ?? '' }}" step="any" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="understanding">Understanding</label>
                                        <input type="number" class="form-control" id="understanding"
                                            name="understanding" placeholder="Rate 1-5" min="1" max="5"
                                            step="any" value="{{ $freelancer->profile->understanding ?? '' }}"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tech_knowledge">Tech Knowledge</label>
                                        <input type="number" class="form-control" id="tech_knowledge"
                                            name="tech_knowledge" placeholder="Rate 1-5" min="1" max="5"
                                            step="any" value="{{ $freelancer->profile->tech_knowledge ?? '' }}"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="final">Final Score</label>
                                        <input type="number" class="form-control bg-light" step="any"
                                            id="final" name="final_score" placeholder="Auto-calculated"
                                            min="1" max="5"
                                            value="{{ $freelancer->profile->final_score ?? '' }}">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-save">Save Evaluation</button>
                                    @if (
                                        !empty($freelancer->profile->creative) &&
                                            !empty($freelancer->profile->understanding) &&
                                            !empty($freelancer->profile->tech_knowledge) &&
                                            !empty($freelancer->profile->final_score))
                                        <button type="submit" class="btn btn-info float-right hire_freelancer"
                                            data-id="{{ $freelancer->id }}">Hire Freelancer</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card card-success shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-university mr-2"></i> Bank Details
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Bank Name:</dt>
                                    <dd class="col-sm-8">{{ $freelancer->bankDetails->bank_name ?? 'Not Updated' }}</dd>
                                    <dt class="col-sm-4">Account No:</dt>
                                    <dd class="col-sm-8">{{ $freelancer->bankDetails->account_no ?? 'Not Updated' }}</dd>

                                    <dt class="col-sm-4">IFSC Code:</dt>
                                    <dd class="col-sm-8">{{ $freelancer->bankDetails->ifsc_code ?? 'Not Updated' }}</dd>

                                    <dt class="col-sm-4">Status:</dt>
                                    <dd class="col-sm-8">
                                        @if(!empty($freelancer->bankDetails->status))
                                        @if($freelancer->bankDetails->status=='verified')
                                        <span class="badge badge-success">{{ $freelancer->bankDetails->status ?? 'Not Updated' }}</span>
                                       @elseif($freelancer->bankDetails->status=='rejected')
                                        <span class="badge badge-danger">{{ $freelancer->bankDetails->status ?? 'Not Updated' }}</span>
                                        @else
                                        <span class="badge badge-warning">{{ $freelancer->bankDetails->status ?? 'Not Updated' }}</span>
                                        @endif
                                        @else 
                                          Not Updated
                                        @endif
                                    </dd>
                                </dl>

                                <!-- Checkbook / Cancelled Cheque Preview -->
                                <div class="row">
                                <div class="text-center mb-3 col-sm-3">
                                    <label class="d-block font-weight-bold">Cancelled Cheque</label>
                                    @if(!empty($freelancer->bankDetails->cancelled_check_image))
                                    <a href="{{ url($freelancer->bankDetails->cancelled_check_image) }}" target="_blank">
                                        <img src="{{ url($freelancer->bankDetails->cancelled_check_image ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                    </a>
                                    @else 
                                    Not Updated
                                    @endif
                                </div> 
                                
                                @if (!empty($freelancer->bankDetails->gov_id_type) && $freelancer->bankDetails->gov_id_type == 'passport')
                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Passport Front</strong>
                                        @if (!empty($freelancer->bankDetails->passport_front))
                                            <a href="{{ url($freelancer->bankDetails->passport_front) }}"
                                                target="_blank">
                                                <img src="{{ url($freelancer->bankDetails->passport_front ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>

                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Passport Back</strong>
                                        @if (!empty($freelancer->bankDetails->passport_back))
                                            <a href="{{ url($freelancer->bankDetails->passport_back) }}"
                                                target="_blank">
                                            <img src="{{ url($freelancer->bankDetails->passport_back ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>

                                @endif
                                @if (!empty($freelancer->bankDetails->gov_id_type) && $freelancer->bankDetails->gov_id_type == 'driving_license')

                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Driving License</strong>
                                        @if (!empty($freelancer->bankDetails->driving_license))
                                            <a href="{{ url($freelancer->bankDetails->driving_license) }}"
                                                target="_blank">
                                                <img src="{{ url($freelancer->bankDetails->driving_license ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>

                                @endif
                                @if (!empty($freelancer->bankDetails->gov_id_type) && $freelancer->bankDetails->gov_id_type == 'aadhaar')
                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Aadhar Front</strong>
                                        @if (!empty($freelancer->bankDetails->aadhaar_front))
                                            <a href="{{ url($freelancer->bankDetails->aadhaar_front) }}"
                                                target="_blank">
                                            <img src="{{ url($freelancer->bankDetails->aadhaar_front ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Aadhar Back</strong>
                                        @if (!empty($freelancer->bankDetails->aadhaar_back))
                                            <a href="{{ url($freelancer->bankDetails->aadhaar_back) }}"
                                                target="_blank">
                                            <img src="{{ url($freelancer->bankDetails->aadhaar_back ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>
                                @endif
                                @if (!empty($freelancer->bankDetails->gov_id_type) && $freelancer->bankDetails->gov_id_type == 'pan')
                                    <div class="col-sm-3">
                                        <strong><i class="fas fa-file-alt mr-1"></i> Pan Card</strong>
                                        @if (!empty($freelancer->bankDetails->pan))
                                            <a href="{{ url($freelancer->bankDetails->pan) }}" target="_blank">
                                            <img src="{{ url($freelancer->bankDetails->pan ?? 'Not Updated') }}"
                                            alt="Cancelled Cheque" class="img-fluid img-thumbnail"
                                            style="max-height: 50px;">
                                            </a>
                                        @else
                                            <p class="text-muted">Not Uploaded</p>
                                        @endif
                                    </div>
                                @endif
                              
                                </div>

                                @if(!empty($freelancer->bankDetails))
                                <!-- Action Buttons -->
                                <div class="text-center">
                                    <button class="btn btn-success btn-sm mr-2 update-status" data-type="approved"
                                        data-id="{{ $freelancer->bankDetails->id ?? '' }}">
                                        <i class="fas fa-check-circle"></i> Approve
                                    </button>
                                    
                                    <button class="btn btn-danger btn-sm update-status" data-type="disapproved"
                                        data-id="{{ $freelancer->bankDetails->id ?? '' }}">
                                        <i class="fas fa-times-circle"></i> Disapprove
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <!-- /.col -->
                </div>

                <!-- Bootstrap JS for tabs (make sure this is included once in your layout) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
        // $(document).ready(function() {

        //     // Select all the individual rating inputs
        //     const ratingInputs = $('#creative, #understanding, #tech_knowledge');

        //     // Select the final score input
        //     const finalInput = $('#final');

        //     // --- FUNCTIONALITY 1: Calculate the average and update the 'Final Score' ---
        //     // When the user types in 'creative', 'understanding', or 'tech_knowledge'
        //     ratingInputs.on('input', function() {
        //         let total = 0;
        //         let count = 0;

        //         // Loop through each of the rating inputs
        //         ratingInputs.each(function() {
        //             let value = parseFloat($(this).val());
        //             // Check if the value is a valid number and greater than 0
        //             if (!isNaN(value) && value > 0) {
        //                 total += value;
        //                 count++;
        //             }
        //         });

        //         // Calculate the average, but only if at least one field has a rating
        //         if (count > 0) {
        //             let average = total / count;
        //             // Set the final score, rounded to 2 decimal places
        //             finalInput.val(average.toFixed(2));
        //         } else {
        //             // If all fields are empty, clear the final score
        //             finalInput.val('');
        //         }
        //     });


        //     // --- FUNCTIONALITY 2: Distribute the 'Final Score' to other fields ---
        //     // When the user types directly into the 'Final Score' field
        //     finalInput.on('input', function() {
        //         let finalValue = $(this).val();
        //         // Update all the individual rating inputs with the new final score
        //         ratingInputs.val(finalValue);
        //     });

        // });

        $(document).ready(function() {
            const ratingInputs = $('#creative, #understanding, #tech_knowledge');
            const finalInput = $('#final');

            // --- FUNCTIONALITY 1: Calculate the average when any rating changes ---
            ratingInputs.on('input', function() {
                let total = 0;
                let count = 0;
                ratingInputs.each(function() {
                    let value = parseFloat($(this).val());

                    if (!isNaN(value)) {
                        total += value;
                        count++;
                    }
                });
                if (count > 0) {
                    let average = total / count;
                    finalInput.val(average.toFixed(2));
                } else {
                    finalInput.val('');
                }
            });

            // --- FUNCTIONALITY 2: Distribute equally when Final Score is entered ---
            finalInput.on('input', function() {
                let finalScore = parseFloat($(this).val());

                if (isNaN(finalScore) || finalScore < 1 || finalScore > 5) {
                    ratingInputs.val('');
                    return;
                }

                // Divide final score equally into 3 fields
                let equalValue = (finalScore / 3).toFixed(2);

                $('#creative').val(equalValue);
                $('#understanding').val(equalValue);
                $('#tech_knowledge').val(equalValue);
            });
        });






        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("due_date").setAttribute('min', today);
        });



        // here is udpate hire talent rating form

        $(document).ready(function() {

            $('#talent_rating_form').on('submit', function(e) {
                e.preventDefault();
                var btn = $('.btn-save').prop('disabled', true);
                btn.text('Processing...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('update.talent.rating') }}",
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        btn.prop('disabled', false);
                        btn.text('Save Evaluation');

                        if (response.success == true) {
                            $('#talent_rating_form')[0].reset();

                            $.toast({
                                heading: 'Success',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'top-right',
                                hideAfter: 2000, // toast visible for 2 seconds
                                afterHidden: function() {
                                    location.reload();
                                }
                            });

                        } else {
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


            // here hire a freelancer /
            $('.hire_freelancer').on('click', function(event) {

                event.preventDefault();

                let freelancerId = $(this).data('id');
                let button = $(this);

                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('update.hire.talent.rating') }}",
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        freelancer_id: freelancerId
                    },
                    beforeSend: function() {

                        button.prop('disabled', true).text('Hiring...');
                    },
                    success: function(response) {

                        console.log(response);

                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                            hideAfter: 2000, // toast visible for 2 seconds
                            afterHidden: function() {
                                location.reload();
                            }
                        });


                        button.text('Hired!').removeClass('btn-info').addClass('btn-success');
                    },
                    error: function(xhr) {

                        console.error(xhr.responseText);
                        alert('An error occurred. Please try again.');

                        button.prop('disabled', false).text('Hire Freelancer');
                    }
                });
            });

        });


        // here update status of bank details
        $(document).on('click', '.update-status', function() {
            let id = $(this).data('id');
            let status = $(this).data('type');

            $.ajax({
                url: "{{ route('bank-details.update-status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function(response) {
                    if (response.success==true) {
                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                            hideAfter: 3000, 
                            afterHidden: function() {
                                location.reload();
                            }
                        });
                    }else{
                        
                        alert('Something went wrong while updating.');
                    }
                },
                error: function() {
                    toastr.error("Something went wrong. Please try again!");
                }
            });
        });
    </script>
@endpush

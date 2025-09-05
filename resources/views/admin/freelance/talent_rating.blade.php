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
                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Freelancer Info</h3>
                            </div>
                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i> Name</strong>
                                <p class="text-muted">{{$freelancer->name ?? $freelancer->username}}</p>
                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted">{{$freelancer->email}}</p>
                                <hr>

                                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
                                <p class="text-muted">{{$freelancer->mobile}}</p>
                                <hr>

                                <strong><i class="fas fa-info-circle mr-1"></i> Bio</strong>
                                <p class="text-muted">{{$freelancer->profile->bio ?? 'No bio added '}}</p>
                                </p>
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
                                            placeholder="Rate 1-5" min="1" max="5" step="any" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="understanding">Understanding</label>
                                        <input type="number" class="form-control" id="understanding" name="understanding"
                                            placeholder="Rate 1-5" min="1" max="5" step="any" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tech_knowledge">Tech Knowledge</label>
                                        <input type="number" class="form-control" id="tech_knowledge" name="tech_knowledge"
                                            placeholder="Rate 1-5" min="1" max="5" step="any" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="final">Final Score</label>
                                        <input type="number" class="form-control bg-light" step="any" id="final"
                                            name="final_score" placeholder="Auto-calculated" min="1" max="5">
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

            // Define the maximum possible score
            const MAX_SCORE = 5;

            const ratingInputs = $('#creative, #understanding, #tech_knowledge');
            const finalInput = $('#final');

            // --- FUNCTIONALITY 1: Calculate the average (No change here) ---
            ratingInputs.on('input', function() {
                let total = 0;
                let count = 0;
                ratingInputs.each(function() {
                    let value = parseFloat($(this).val());
                    if (!isNaN(value) && value > 0) {
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

            // --- FUNCTIONALITY 2: Distribute the 'Final Score' (Updated Logic) ---
            finalInput.on('input', function() {
                let finalScore = parseFloat($(this).val());

                // 1. Validate the input against the new MAX_SCORE
                if (isNaN(finalScore) || finalScore < 1 || finalScore > MAX_SCORE) {
                    ratingInputs.val('');
                    return;
                }

                // 2. Calculate the total sum needed
                let targetSum = finalScore * 3;
                let creativeScore, understandingScore, techKnowledgeScore;

                // 3. Distribute the sum using MAX_SCORE as the limit
                let creativeAttempt = targetSum - 2;
                creativeScore = Math.min(MAX_SCORE, Math.max(1, creativeAttempt));

                let remainingForTwo = targetSum - creativeScore;
                let understandingAttempt = remainingForTwo - 1;
                understandingScore = Math.min(MAX_SCORE, Math.max(1, understandingAttempt));

                techKnowledgeScore = targetSum - creativeScore - understandingScore;

                // 4. Set the values for the three rating inputs
                $('#creative').val(creativeScore.toFixed(2));
                $('#understanding').val(understandingScore.toFixed(2));
                $('#tech_knowledge').val(techKnowledgeScore.toFixed(2));
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
                            }).then(function() {
                                location.reload();
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
                            }).then(function() {
                                location.reload();
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
    </script>
@endpush

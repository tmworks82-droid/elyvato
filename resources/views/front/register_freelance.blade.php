@php
    $title = $title;
    $metaDescription =
        'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/front/assets/images/elyvato-header-logo.png';
@endphp


@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 258px;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #ccc;
            background: #fff;
            transition: 0.2s;
            margin-bottom: 12px;
        }

        .social-btn img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 4px;
        }

        .google-btn {
            border: 1px solid #dadce0;
        }

        .facebook-btn {
            background-color: #1877f2;
            color: white;
            border: none;
        }

        .social-btn:hover {
            opacity: 0.9;
        }

        a:hover {
            color: #000000 !important;
        }
    </style>
@endsection
@section('pageContent')
    {{-- ============================= breadcrumb section ============================= --}}
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="d-none">
        <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="https://elyvato.com" itemprop="item">
                    <span itemprop="name">Home</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="#" class="breadcrumb-nlink" itemprop="item">
                    <span itemprop="name">Register As Freelance</span>
                </a>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </nav>

    {{-- ============================= Hire card section ============================= --}}
    <section class="section-padding-top section-padding-bottom bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7">
                    <div class="text-center d-flex flex-column gap-3 mb-3 mb-md-4">
                        <h1 class="fs-3 fw-bold mb-0">Register </h1>
                        <p class="mb-0">Enter your details</p>
                    </div>
                    @if (session('success'))
                        <div
                            style="background-color: #d4edda; color: #155724; padding: 10px 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card bg-white">
                        <div class="card-body p-3 p-md-4">
                            <h5 class="card-title mb-2 text-center">We're glad to see you!</h5>
                            <p class="mb-3 mb-md-4 text-center">Already have an account? <a href="/login">Login!</a></p>
                            <form id="freelancerForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="step1">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Your Name" required>
                                        <label for="name">Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                        <label for="email">Email Address</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" name="phone" id="phone"
                                            placeholder="Phone Number" required>
                                            <label for="email">Mobile</label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-main">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#googlebtn').click(function() {
            PleaseWait();
        });
        $('#facebookbtn').click(function() {
            PleaseWait();
        });


        document.getElementById('showPasswordToggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = this;

            // Toggle password visibility
            const isPasswordVisible = passwordInput.type === 'text';
            passwordInput.type = isPasswordVisible ? 'password' : 'text';

            // Toggle icon class
            toggleIcon.classList.toggle('ri-eye-line', isPasswordVisible);
            toggleIcon.classList.toggle('ri-eye-off-line', !isPasswordVisible);

        });



        $('#user_login_form').on('submit', function(e) {
            e.preventDefault();
            PleaseWait();
            let $btn = $('.btn-login');
            $btn.prop('disabled', true).text('Processing...');


            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('user_login') }}", // Define this route in web.php
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false, // hide Done button
                        timer: 3000, // auto close after 3 sec
                        timerProgressBar: true, // show timer bar
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = response.url;
                    });


                },
                error: function(xhr) {
                    Swal.close();
                    let errorText = 'Invalid credentials.';

                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        // validation errors
                        errorText = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.status === 401 && xhr.responseJSON.message) {
                        // wrong email/password
                        errorText = xhr.responseJSON.message;
                    } else if (xhr.status === 429 && xhr.responseJSON.message) {
                        // throttle block
                        errorText = xhr.responseJSON.message;
                    }

                    Swal.fire('Login Failed', errorText, 'error');
                    $btn.prop('disabled', false).text('Sign In');
                }
            });
        });
    </script>

    <script>

        $(document).ready(function() {
            $("#nextBtn").click(function() {
                $("#step1").hide();
                $("#step2").show();
            });

            $("#backBtn").click(function() {
                $("#step2").hide();
                $("#step1").show();
            });
        });

        // here register as freelance js 

        // AJAX submit
        $("#freelancerForm").on("submit", function(e) {
            e.preventDefault();
        PleaseWait();
            let formData = new FormData(this); 

            $.ajax({
                url: "{{ route('freelancers.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                
                    $("button[type=submit]").prop("disabled", true).text("Submitting...");
                
                },
                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        title: response.message,
                        icon: "success",
                        confirmButtonText: "Done", 
                        // draggable: true
                        timer: 5000, // Auto close in 5 sec
                        timerProgressBar: true, // shows a small timer bar
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.reload(); 
                    });

                    console.log(response);
                   
                    $("#freelancerForm")[0].reset();
                    $("#step2").hide();
                    $("#step1").show();
                },
                error: function(xhr) {
                    Swal.close();

                     Swal.fire({
                        title: response.message,
                        icon: "warning",
                        confirmButtonText: "Ok", 
                        draggable: true
                    }).then(function() {
                        window.location.reload();
                    });

                    console.error(xhr.responseText);
                },
                complete: function() {
                    $("button[type=submit]").prop("disabled", false).text("Submit");
                }
            });
        });
    </script>
@endsection

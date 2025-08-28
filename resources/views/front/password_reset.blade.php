@php
    $title = 'Forgot Password - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')

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
                <span itemprop="name">Forgot Password</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
    </ol>
</nav>

{{-- ============================= login card section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7">
                <div class="text-center d-flex flex-column gap-3 mb-3 mb-md-4">
                    <h1 class="fs-3 fw-bold mb-0">Reset Password</h1>
                    <p class="mb-0">Enter new password and udpate.</p>
                </div>
                <div class="card bg-white">
                    <div class="card-body p-3 p-md-4">
                        <p class="mb-3 mb-md-4">Choose a strong password. The password must be atleast 8 characters and must include alpha numberic characters.</p>
                        <form action="{{ route('password.reset') }}" method="POST">
                            @csrf
                             <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                            <div class="form-floating position-relative mb-3 mb-lg-4">
                                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                                    <i class="ri-eye-line cursor-pointer" id="showPasswordToggle"></i>
                                </span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                            
                            <div class="form-floating position-relative mb-3 mb-lg-4">
                                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                                    <i class="ri-eye-line cursor-pointer" id="showPasswordToggle"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password">
                                <label for="password">Confirm Password</label>
                            </div>

                            <button class="btn btn-main btn-md-large w-100" type="submit">Reset Password </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
    <script>
        document.getElementById('showPasswordToggle').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = this;

            // Toggle password visibility
            const isPasswordVisible = passwordInput.type === 'text';
            passwordInput.type = isPasswordVisible ? 'password' : 'text';

            // Toggle icon class
            toggleIcon.classList.toggle('ri-eye-line', isPasswordVisible);
            toggleIcon.classList.toggle('ri-eye-off-line', !isPasswordVisible);
        });

             $(document).ready(function() {
             // alert('run');
             $('.header-nav.nav-homepage-style').addClass('stricky-fixed');
         });

         $(window).scroll(function() {
             if ($(this).scrollTop() > 90) {
                 $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
             } else {
                 $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
             }
         });

     
     //  forgot password 
    $(document).ready(function () {
        $('#forgot_password').submit(function (e) {
            e.preventDefault(); // prevent default form submission
        PleaseWait();
            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: "{{ route('send.otp') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                beforeSend: function () {
                    $('#otp-message').html('<span style="color: blue;">Processing...</span>');
                },
                success: function (response) {
                    Swal.close();
                    $('#otp-message').html('<span style="color: green;">' + response.message + '</span>');
                    // optionally redirect to OTP page
                    
                },
                error: function (xhr) {
                    Swal.close();
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).map(err => err[0]).join('<br>');
                        $('#otp-message').html('<span style="color: red;">' + msg + '</span>');
                    } else {
                        $('#otp-message').html('<span style="color: red;">Something went wrong. Try again.</span>');
                    }
                }
            });
        });
    });

    </script>
@endsection
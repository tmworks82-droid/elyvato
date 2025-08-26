@php
    $title = 'Login - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <span itemprop="name">Login</span>
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
                    <h1 class="fs-3 fw-bold mb-0">Sign In</h1>
                    <p class="mb-0">Enter your login credentials for accessing Elevate Dashboard.</p>
                </div>
                @if (session('success'))
                                <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
                                    {{ session('error') }}
                                </div>
                            @endif
                <div class="card bg-white">
                    <div class="card-body p-3 p-md-4">
                        <h5 class="card-title mb-2">We're glad to see you again!</h5>
                        <p class="mb-3 mb-md-4">Don't have an account? <a href="/register">Register!</a></p>
                        <form id="user_login_form" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control focus-shadow-none" name="email" id="email" placeholder="name@example.com">
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating position-relative mb-3 mb-lg-4">
                                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                                    <i class="ri-eye-line cursor-pointer" id="showPasswordToggle"></i>
                                </span>
                                <input type="password" class="form-control focus-shadow-none" name="password" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>

                            <div class="mb-3 mb-lg-4 d-flex gap-2 justify-content-between align-items-center flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input focus-shadow-none" name="remember" type="checkbox" value="" id="checkDefault">
                                    <label class="form-check-label" for="checkDefault">
                                        Remember me
                                    </label>
                                </div>
                                <a href="/forgot/password">Forget password?</a>
                            </div>
                            <!-- <input type="submit" class="btn btn-main btn-md-large w-100" value="Sign In" /> -->
                             <button class="btn btn-main btn-md-large w-100 btn-login" type="submit">Sign In</button>
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



                $('#user_login_form').on('submit', function(e) {
            e.preventDefault();
            
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

            // Swal.fire({
            //     title: 'Success!',
            //     text: response.message,
            //     icon: 'success',
            //     confirmButtonText: 'Done',
            //     confirmButtonColor: '#f97a00',  
            //     allowOutsideClick: false             
            // }).then(() => {
            //     window.location.href = response.url;
            // });
            
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                showConfirmButton: false,   // hide Done button
                timer: 3000,                // auto close after 3 sec
                timerProgressBar: true,     // show timer bar
                allowOutsideClick: false
            }).then(() => {
                window.location.href = response.url;
            });


            },
            error: function(xhr) {
                let errorText = 'Invalid credentials.';
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                errorText = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                }
                Swal.fire('Login Failed', errorText, 'error');
                 $btn.prop('disabled', false).text('Sign In');
            }
            });
        });

    </script>
@endsection
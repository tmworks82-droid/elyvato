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
                    <h1 class="fs-3 fw-bold mb-0">Forgot Password</h1>
                    <p class="mb-0">No worries! Enter your registered email below and follow the email instructions.</p>
                </div>
                <div class="card bg-white">
                    <div class="card-body p-3 p-md-4">
                        <p class="mb-3 mb-md-4">Please enter your registered email address below. We'll send you a Link to reset your password.</p>
                        <form id="forgot_password" method="POST">
                            @csrf
                            <div id="otp-message" class="mt-2"></div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control focus-shadow-none" name="email" id="email" placeholder="name@example.com" required>
                                <label for="email">Email address</label>
                            </div>

                            <input type="submit" id="send_otp_btn" class="btn btn-main btn-md-large w-100" value="Reset" />
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
            
            let $btn = $('#send_otp_btn');

            $btn.prop('disabled', true);
            $btn.text('Processing...'); 

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
                    $('#otp-message').html('<span style="color: green;">' + response.message + '</span>');
                    // optionally redirect to OTP page

                    $btn.prop('disabled', false);
                    $btn.text('Rest'); 
                    
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).map(err => err[0]).join('<br>');
                        $('#otp-message').html('<span style="color: red;">' + msg + '</span>');
                        $btn.prop('disabled', false);
                    $btn.text('Rest'); 
                    } else {
                        $('#otp-message').html('<span style="color: red;">Something went wrong. Try again.</span>');
                        $btn.prop('disabled', false);
                    $btn.text('Rest'); 
                    }
                }
            });
        });
    });

</script>

 @endsection
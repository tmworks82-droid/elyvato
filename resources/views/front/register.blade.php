@php
    $title = 'Register - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')
@section('styles')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">-->
@endsection
@section('pageContent')

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
        color: #dadce0;
        border: none;
    }
    .social-btn:hover {
        opacity: 0.9;
        color:#fff !important;
    }

    a:hover {
        color: #000000 !important;
    }    
</style>

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
                <span itemprop="name">Register</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
    </ol>
</nav>

{{-- ============================= Register card section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7">
                <div class="text-center d-flex flex-column gap-3 mb-3 mb-md-4">
                    <h1 class="fs-3 fw-bold mb-0">Register</h1>
                    <p class="mb-0">Enter your details and create account to start hiring the talent.</p>
                </div>
                <div class="card bg-white">
                    <div class="card-body p-3 p-md-4">
                        <h5 class="card-title mb-2">Let's create your account!</h5>
                        <p class="mb-3 mb-md-4">Already have an account? <a href="/login">Sign In!</a></p>
                        <form id="registerForm">
                            @csrf
                           
                            <div class="form-floating mb-3">
                                <!-- <input type="email" class="form-control focus-shadow-none" name="email" id="email" placeholder="name@website.com"> -->
                               <input 
                                  type="email" 
                                  class="form-control focus-shadow-none" 
                                  name="email" 
                                  id="email" 
                                  placeholder="name@website.com" 
                                  required  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|in|net|org|co\.in|edu)$">

                                <label for="email">Email Address*</label>
                            </div>
                            <div class="form-floating mb-3">

                                <input 
                                  type="text" 
                                  name="mobile"
                                  id="phone"
                                  class="form-control" 
                                  placeholder="Phone Number" 
                                  maxlength="10" 
                                  inputmode="numeric"
                                  
                                  oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                />

                                <label for="phone">Phone Number*</label>
                            </div>
                            <button class="btn btn-main btn-md-large w-100 btn-submin" type="submit">Create Account</button>
                        </form>
                         <div class="hr_content mb20 text-center">
                             <hr><span class="hr_top_text">OR</span>
                         </div>
                         
                          <div class="d-md-flex justify-content-around">
                            <!-- Google Button -->

                            <a class="social-btn google-btn" href="{{ route('social.redirect','google') }}" id="googlebtn">
                              <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google"> Continue with Google
                            </a>
                            <a class="social-btn facebook-btn" href="{{ route('facebook.login') }}">
                              <img src="https://www.svgrepo.com/show/452196/facebook-1.svg" id="facebookbtn" alt="Facebook"> Continue with Facebook
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')

<script>

$('document').ready(function(){
    



     $('#googlebtn').click(function(){
        PleaseWait();
    });
     $('#facebookbtn').click(function(){
        PleaseWait();
    });

})



const emailInput = document.getElementById("email");

emailInput.addEventListener("invalid", function () {
  this.setCustomValidity("Please enter a valid email address (e.g., yourname@example.com).");
});

emailInput.addEventListener("input", function () {
  this.setCustomValidity("");
});


        
// Here load city
$('#state').on('change', function() {
  var stateID = $(this).val();
  if (stateID) {
    $.ajax({
      url: "{{ url('get-cities') }}", // URL included here
      type: 'GET',
      data: { state_id: stateID }, // Include the state_id in the request
      dataType: 'json',
      success: function(data) {
        $('#city').empty().append('<option value="">Select City</option>');
        $.each(data, function(key, city) {
          $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
        });
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  } else {
    $('#city').empty().append('<option value="">Select City</option>');
  }
});

// register here

$('#registerForm').on('submit', function(e) {
  e.preventDefault();
  
  PleaseWait();

  let $btn = $('.btn-submin');
    $btn.prop('disabled', true).text('Processing...');

// alert('run');
  var formData = new FormData(this);

  $.ajax({
    url: "{{ url('registeration') }}",
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
        Swal.close();
      if (response.success) {
        Swal.fire({
            title: response.message,
            icon: "success",
            confirmButtonText: "Done", 
            // draggable: true
            timer: 5000, // Auto close in 5 sec
            timerProgressBar: true, // shows a small timer bar
            allowOutsideClick: false
        }).then(function() {
            Swal.fire({
            title: "🎉 Thank You!",
            html: "You have successfully registered!",
            icon: "success",
            confirmButtonText: "Great, Let's Go 🚀",
            confirmButtonColor: "#f97a00",
            backdrop: `rgba(0,0,0,0.6)`,
            allowOutsideClick: false,
            customClass: {
                popup: 'animated fadeInDown',
                title: 'swal2-title-custom',
                confirmButton: 'swal2-confirm-custom'
            }
        }).then((result) => {
        
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "{{ url('login') }}";
                }
            });
        });

      } else {
        // alert(response.message || 'Registration failed. Please try again.');
          Swal.fire({
              title: response.message,
              icon: "warning",
              confirmButtonText: "Ok", 
              draggable: true
          }).then(function() {
              window.location.href = "{{ url('login') }}";
          });
        $btn.prop('disabled', false).text('Register');
      }
      $('.swal2-title').css('font-size', '1.5em');
    },
   error: function(xhr, status, error) {
       Swal.close();
    let errorMessages = '';

    if (xhr.responseJSON && xhr.responseJSON.errors) {
        $.each(xhr.responseJSON.errors, function(field, messages) {
            // messages is an array, so join with <br> if multiple
            errorMessages += messages.join('<br>') + '<br>';
        });

        Swal.fire({
            title: "All fields are required",
            html: errorMessages,
            icon: "error",
            confirmButtonText: "Ok"
        });
        $btn.prop('disabled', false).text('Register');
    } else {
        // fallback error
        Swal.fire({
            title: "Error",
            text: "Something went wrong",
            icon: "error",
            confirmButtonText: "Ok"
        });
    }
    $btn.prop('disabled', false).text('Register');
}

  });
});



    </script>
@endsection
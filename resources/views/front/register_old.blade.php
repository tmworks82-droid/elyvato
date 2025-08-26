 @extends('layouts.front.app')
@section('title') {{$title}} @endsection

 @section('content')
     <!-- Our SignUp Area -->
     <section class="bgc-thm4 our-register">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                     <div class="main-title text-center">
                         <h2 class="title">Register</h2>
                         <h3 class="paragraph fs-5 mb-4">Give your visitor a smooth online experience with a solid UX design</h6>
                     </div>
                 </div>
             </div>
             <div class="row wow fadeInRight" data-wow-delay="300ms">
                 <div class="col-xl-6 mx-auto">
                     <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                        <form id="registerForm">
                            @csrf
                            <div class="mb30">
                                <h4>Let's create your account!</h4>
                                <p class="text mt20">Already have an account? <a href="{{url('user-login')}}" class="text-thm">Sign
                                        in!</a></p>
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Display Name</label>
                                <input type="text" name="name" class="form-control" placeholder="ali">
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="alitf">
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="alitfn58@gmail.com">
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Phone Number</label>
                                <input type="number" name="mobile" class="form-control" placeholder="+91xxxxxx35">
                            </div>
                            <div class="mb15">
                                <label class="form-label fw500 dark-color">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="*******">
                            </div>

                            <!-- Additional Fields -->
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Company or Business Name</label>
                                <input type="text" name="company_name" class="form-control" placeholder="e.g. Acme Corp">
                            </div>

                            <div class="mb25">
                               <label for="work_strength" class="form-label">Team Size / Work Strength</label>
                                <input type="number" class="form-control" id="work_strength" name="work_strength" placeholder="e.g. 25">
                            </div>
                            <div class="mb25">
                                <label for="role_designation" class="form-label">Select Your Role</label>
                                <select class="form-control" id="role_designation" name="role_designation">
                                <option value="">-- Select Role --</option>
                                @foreach($role_designation as $designation)
                                <option value="{{$designation->id}}">{{$designation->title}}</option>
                               @endforeach
                                </select>
                            </div>

                            <div class="mb25">
                                <label class="form-label fw500 dark-color">GST Number</label>
                                <input type="text" name="gst_number" class="form-control" placeholder="GSTIN1234...">
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Address Line 1</label>
                                <input type="text" name="address" class="form-control" placeholder="123 Main Street">
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Country</label>
                                <select name="country" id="country" class="form-control">
                                    @foreach ($country as $co)
                                        <option value="{{$co->id}}">{{$co->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">State</label>
                                <select name="state" id="state" class="form-control">
                                    @foreach ($State as $sta)
                                        <option value="{{$sta->id}}">{{$sta->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color ">City</label>
                                <select name="city" id="city" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color ">Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Pincode</label>
                                <input type="text" name="pin_code" class="form-control" placeholder="123456">
                            </div>
                            
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Industry Type</label>
                                <input type="text" name="industry_type" class="form-control" placeholder="IT, Marketing, etc.">
                            </div>

                            <div class="d-grid mb20">
                                <button class="ud-btn btn-thm default-box-shadow2" type="submit">Create Account <i
                                        class="fal fa-arrow-right-long"></i></button>
                            </div>
                         </form>
                         {{--<div class="hr_content mb20">
                             <hr><span class="hr_top_text">OR</span>
                         </div>
                         <div class="d-md-flex justify-content-between">
                             <button class="ud-btn btn-fb fz14 fw400 mb-2 mb-md-0" type="button"><i
                                     class="fab fa-facebook-f pr10"></i> Continue Facebook</button>
                             <button class="ud-btn btn-google fz14 fw400 mb-2 mb-md-0" type="button"><i
                                     class="fab fa-google"></i> Continue Google</button>
                             <button class="ud-btn btn-apple fz14 fw400" type="button"><i class="fab fa-apple"></i>
                                 Continue Apple</button>
                         </div>--}}

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
      if (response.success) {
        Swal.fire({
        title: response.message,
        icon: "success",
        draggable: true
        }).then(function() {
        window.location.href = "{{ url('user-login') }}";
        });
      } else {
        alert(response.message || 'Registration failed. Please try again.');
      }
    },
    error: function(xhr, status, error) {
      console.error(error);
      alert('Something went wrong. Please check your data and try again.');
    }
  });
});


</script>
 @endsection

@php
    $title = 'Profile - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp

@extends('layouts.front.user-app')

@section('pageContent')

    {{-- header --}}
    <div class="mb-3 mb-lg-4">
        <div class="d-flex gap-3 flex-wrap">
            <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line"></i>
            </button>
            <h1 class="fw-bold mb-0">My Profile</h1>
        </div>
    </div>
     @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


    {{-- profile details --}}
    <div class="overflow-x-hidden mb-3 mb-lg-4">
        <h2 class="fs-4 fw-bold mb-3 w-full pb-3 border-bottom">Profile Details</h2>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="profileForm" class="form-style1" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" name="username" id="username"
                            value="{{ Auth::user()->username }}" placeholder="John">
                        <label for="username">Username *</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="email" class="form-control focus-shadow-none" name="email" id="email"
                            value="{{ Auth::user()->email }}" placeholder="name@website.com">
                        <label for="email">Email Address *</label>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mb-3">
                <div class="col-md">
                 <div class="form-floating">
    <input type="tel" 
           class="form-control focus-shadow-none" 
           name="mobile" 
           id="phone"
           value="{{ substr(Auth::user()->mobile, -10) }}" 
           placeholder="1234567890"
           maxlength="10" 
           pattern="[0-9]{10}" 
           oninput="this.value=this.value.replace(/[^0-9]/g,'');">
    <label for="phone">Phone Number *</label>
</div>



                </div>
                <div class="col-md">
                    <div class="input-group">
                        <label class="btn btn-outline-secondary mb-0" style="padding: 1rem .75rem;">
                            Profile Picture
                            <input type="file" id="profile_picture" name="profile" hidden onchange="updateFileName(this)">
                        </label>
                        <input type="text" class="form-control focus-shadow-none" id="file-name-display"
                            value="No file chosen" readonly>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" name="company_name" id="company_name"
                            value="{{ $profile->company_name ?? '' }}" placeholder="ABC">
                        <label for="company_name">Company Name *</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="role" id="role" class="form-select focus-shadow-none">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @if(Auth::user()->role_id == $role->id) selected @endif>
                                    {{ucfirst($role->name)}}</option>
                            @endforeach
                        </select>
                        <label for="role">User Role *</label>
                    </div>
                </div>

            </div>

            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">

                        <select name="role_designation" id="role_designation" name="role_designation"
                            class="form-select focus-shadow-none">
                            @if(!empty($role_designation) && count($role_designation) > 0)
                                @foreach($role_designation as $designation)
                                    <option value="{{$designation->id}}" @if(!empty($profile->role_designation))
                                    @if($profile->role_designation == $designation->id) selected @endif @endif>
                                        {{$designation->title}} </option>
                                @endforeach
                            @endif
                        </select>
                        <label for="role"> Role Designation *</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">


                        <select name="work_strength" id="work_strength" class="form-select focus-shadow-none">
                            <option value="">Select Work Strength</option>

                            <option value="1-10" {{ $profile->work_strength == '1-10' ? 'selected' : '' }}>1 to 10</option>
                            <option value="10-100" {{ $profile->work_strength == '10-100' ? 'selected' : '' }}>10 to 100
                            </option>
                            <option value="100+" {{ $profile->work_strength == '100+' ? 'selected' : '' }}>100+</option>
                        </select>


                        <label for="work_strength">Work Strength</label>

                    </div>
                </div>

            </div>
            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" name="gst_number" id="gst_number"
                            value="{{ $profile->gst_number ?? '' }}" placeholder="GSTIN123456..">
                        <label for="gst_number">GSTIN Number</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" name="address_line1" id="address_line1"
                            value="{{ $profile->address_line1 ?? '' }}" placeholder="123 Street">
                        <label for="address_line1">Address Line 1 *</label>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" name="address_line2" id="address_line2"
                            value="{{ $profile->address_line2 ?? '' }}" placeholder="Near XYZ">
                        <label for="address_line2">Address Line 2</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <select name="country" id="country" class="form-select focus-shadow-none">
                            @foreach ($country->take(1) as $val)
                                <option value="{{ $val->id }}" @if ($val->id == 1) selected @endif>
                                    {{ $val->country_name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="country">Country*</label>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mb-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" id="pincode" name="pincode"
                            value="{{ $profile->pincode ?? '' }}" placeholder="123456">
                        <label for="pin_code">Pin Code*</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        {{--<select name="state" id="state" class="form-select focus-shadow-none">
                            @foreach ($state as $stat)
                            <option value="{{ $stat->id }}" @if ($profile->city ?? '' == $stat->id) selected @endif>
                                {{ $stat->name }}</option>
                            @endforeach
                        </select>--}}

                        <input type="text" id="state" name="state" class="form-control focus-shadow-noner"
                            placeholder="State" value="{{ $profile->state ?? ''}}" readonly />

                        <label for="state">State*</label>
                    </div>
                </div>

            </div>
            <div class="row gap-3 mb-3">
                {{--<div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" id="pin_code" name="pincode"
                            value="{{ $profile->pincode ?? '' }}" placeholder="123456">
                        <label for="pin_code">Pin Code*</label>
                    </div>
                </div>--}}

                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" id="city" name="city" class="form-control focus-shadow-noner"
                            value="{{ $profile->city ?? '' }}" placeholder="City" readonly />
                        <label for="city">City</label>
                    </div>
                </div>

                <div class="col-md">
                    {{--<div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" id="industry_type" name="industry_type"
                            value="{{ $profile->industry_type ?? '' }}">
                        <label for="industry_type">Industry Type*</label>
                    </div>--}}

                    <div class="form-floating">
                        <select class="form-select focus-shadow-none" id="industry_type" name="industry_type">

                            <option value="IT & Software" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'IT & Software') ? 'selected' : '' }}>IT & Software</option>
                            <option value="Agriculture" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Agriculture') ? 'selected' : '' }}>Agriculture</option>
                            <option value="Textile & Apparel" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Textile & Apparel') ? 'selected' : '' }}>Textile & Apparel
                            </option>
                            <option value="Automobile" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Automobile') ? 'selected' : '' }}>Automobile</option>
                            <option value="Healthcare" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Healthcare') ? 'selected' : '' }}>Healthcare</option>
                            <option value="Banking" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Banking') ? 'selected' : '' }}>Banking</option>
                            <option value="Real Estate" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Real Estate') ? 'selected' : '' }}>Real Estate</option>
                            <option value="E-Commerce" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'E-Commerce') ? 'selected' : '' }}>E-Commerce</option>
                            <option value="Energy & Power" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Energy & Power') ? 'selected' : '' }}>Energy & Power
                            </option>
                            <option value="Entertainment" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Entertainment') ? 'selected' : '' }}>Entertainment</option>
                            <option value="Others" {{ (isset($profile->industry_type_select) && $profile->industry_type_select == 'Others') ? 'selected' : '' }}>Others</option>
                        </select>
                        <label for="industry_type_select">Industry Type*</label>
                    </div>

                </div>
            </div>

            <button class="btn btn-main" type="submit" value="Update Profile">Update Profile </button>
        </form>
    </div>

    {{-- seperater --}}

    <div class="py-3 py-lg-5 text-center">
        <i class="ri-separator fs-1 text-main"></i>
    </div>

    {{-- password update --}}
    <div class="overflow-x-hidden">
        <h2 class="fs-4 fw-bold mb-3 w-full pb-3 border-bottom">Change Password</h2>
        <form id="changePasswordForm" method="POST" action="{{ route('user.changePassword') }}">
            @csrf
            <!-- old password -->
            <!-- Old Password -->
            <div class="form-floating position-relative mb-3 mb-lg-4">
                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                    <i class="ri-eye-line cursor-pointer toggle-password" data-target="old_password"></i>
                </span>
                <input type="password" class="form-control focus-shadow-none" id="old_password" name="old_password"
                    placeholder="Old Password" autocomplete="old-password" required>
                <label for="old_password">Old Password</label>
            </div>

            <!-- New Password -->
            <div class="form-floating position-relative mb-3 mb-lg-4">
                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                    <i class="ri-eye-line cursor-pointer toggle-password" data-target="new_password"></i>
                </span>
                <input type="password" class="form-control focus-shadow-none" name="new_password" id="new_password"
                    placeholder="New Password" autocomplete="new-password" required>
                <label for="new_password">New Password</label>
            </div>

            <!-- Confirm New Password -->
            <div class="form-floating position-relative mb-3 mb-lg-4">
                <span class="position-absolute password-show-btn h-100 d-flex align-items-center">
                    <i class="ri-eye-line cursor-pointer toggle-password" data-target="new_password_confirmation"></i>
                </span>
                <input type="password" class="form-control focus-shadow-none" name="new_password_confirmation"
                    id="new_password_confirmation" placeholder="Confirm New Password" autocomplete="new-password" required>
                <label for="new_password_confirmation">Confirm New Password</label>
            </div>


            <button type="submit" class="btn btn-main" value="Change Password">Change Password </button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

        document.getElementById('pincode').addEventListener('blur', function () {
            let pin = this.value;
            if (pin.length === 6) {
                fetch(`https://api.postalpincode.in/pincode/${pin}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data[0].Status === "Success") {
                            const postOffice = data[0].PostOffice[0];
                            document.getElementById('city').value = postOffice.District;
                            document.getElementById('state').value = postOffice.State;
                        } else {
                            alert("Invalid PIN code");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Error fetching location");
                    });
            }
        });


        document.querySelectorAll('.toggle-password').forEach(function (toggleIcon) {
            toggleIcon.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const isVisible = input.type === 'text';

                input.type = isVisible ? 'password' : 'text';

                // Update icon
                this.classList.toggle('ri-eye-line', isVisible);
                this.classList.toggle('ri-eye-off-line', !isVisible);
            });
        });
        function updateFileName(input) {
            const fileName = input.files.length ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name-display').value = fileName;
        };


        function highlightMandatoryFields(fieldIds = []) {
            fieldIds.forEach(function (id) {
                const $field = $('#' + id);


                if ($field.val().trim() === '') {

                    $field.addClass('is-invalid');


                    if ($field.next('.invalid-feedback').length === 0) {
                        $field.after('<div class="invalid-feedback">This field is required.</div>');
                    }
                } else {

                    $field.removeClass('is-invalid');


                    $field.next('.invalid-feedback').remove();
                }
            });
        }


        // here update profile code  

        $(document).ready(function () {

            $('input').on('keyup', function () {
                highlightMandatoryFields(['username', 'email', 'phone', 'company_name', 'role', 'role_designation', 'address_line1', 'country', 'state', 'pin_code', 'industry_type']);
            });

            $('#state').on('change', function () {
                // alert('run');
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        url: '/get-cities/' + stateID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('#city').empty();
                            $('#city').append('<option value="">Select City</option>');
                            $.each(data, function (key, value) {
                                $('#city').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                            $('#city').selectpicker('refresh'); // Refresh bootstrap select
                        }
                    });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $('#city').selectpicker('refresh');
                }
            });
        });

        // here update ,profile

        $(document).ready(function () {
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                // var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('user.update_user_profile') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status == true) {
                            // Swal.fire("Success", response.message, "success");

                            Swal.fire({
                                title: "Success",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });


                        } else {
                            Swal.fire("Faild", response.message, "error");
                            // alert('run');
                            highlightMandatoryFields(['username', 'email', 'phone', 'company_name', 'role', 'role_designation', 'address_line1', 'country', 'state', 'pin_code', 'industry_type']);

                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Something went wrong!", "error");
                        highlightMandatoryFields(['username', 'email', 'phone', 'company_name', 'role', 'role_designation', 'address_line1', 'country', 'state', 'pin_code', 'industry_type']);

                    }
                });
            });
        });


        // change password

        $(document).ready(function () {
            $('#changePasswordForm').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{route('user.changePassword')}}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire("Success", response.message, "success");
                        $('#changePasswordForm')[0].reset();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let msg = xhr.responseJSON.message || 'Something went wrong';
                        if (errors) {
                            msg = Object.values(errors).flat().join('\n');
                        }
                        Swal.fire("Error", msg, "error");
                    }
                });
            });
        });

    </script>
@endsection
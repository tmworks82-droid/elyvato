@extends('layouts.user.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            @include('layouts.user.side_menu');

            <div class="col-lg-9">
                <div class="dashboard_title_area">
                    <h2>My Profile</h2>
                    <p class="text">Lorem ipsum dolor sit amet, consectetur.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="bdrb1 pb15 mb25">
                        <h5 class="list-title">Profile Details</h5>
                    </div>

                    <div class="col-xl-7">
                        <div class="profile-box d-sm-flex align-items-center mb30">
                            <div class="profile-img mb20-sm">
                                <img class="w-50 rounded-circle wa-xs" src="{{ asset($profile->image ?? '') }}"
                                    alt="">
                            </div>
                            {{-- <div class="profile-content ml20 ml0-xs">
                                <div class="d-flex align-items-center my-3">
                                    <a href="#" class="tag-delt text-thm2"><span
                                            class="flaticon-delete text-thm2"></span></a>
                                    <a href="#" class="upload-btn ml10">Upload Images</a>
                                </div>
                                <p class="text mb-0">Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are
                                    .jpg & .png</p>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <form id="profileForm" class="form-style1" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ Auth::user()->username }}" placeholder="i will">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Email Address</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                            placeholder="i will" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Phone Number</label>
                                        <input type="text" class="form-control" name="mobile"
                                            value="{{ Auth::user()->mobile }}" placeholder="i will" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Profile</label>
                                        <input type="file" class="form-control" name="profile">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Company Name</label>
                                        <input type="text" class="form-control" name="company_name"
                                            value="{{ $profile->company_name ?? '' }}" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw500 mb10">Role</label>
                                                <input type="text" class="form-control" value="{{ $role->name }}"
                                                    placeholder="i will" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">GST No:</label>
                                        <input type="text" class="form-control" value="{{ $profile->gst_number ?? '' }}"
                                            name="gst_number" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Address Line 1</label>
                                        <input type="text" class="form-control" value="{{ $profile->address_line1 ??'' }}"
                                            name="address_line1" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Address Line 2</label>
                                        <input type="text" class="form-control" value="{{ $profile->address_line2?? '' }}"
                                            name="address_line2" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10"
                                                name="state">Country</label>
                                            <div class="bootselect-multiselect">
                                                <select class="selectpicker" name="country" id="country">
                                                    @foreach ($country as $val)
                                                        <option value="{{ $val->id }}"
                                                            @if ($profile->city??'' == $val->id) selected @endif>
                                                            {{ $val->country_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10"
                                                name="state">State</label>
                                            <div class="bootselect-multiselect">
                                                <select class="selectpicker" name="state" id="state">
                                                    @foreach ($state as $stat)
                                                        <option value="{{ $stat->id }}"
                                                            @if ($profile->city ?? '' == $stat->id) selected @endif>
                                                            {{ $stat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <div class="form-style1">
                                            <label class="heading-color ff-heading fw500 mb10" name="city">City</label>
                                            <div class="bootselect-multiselect">
                                                <select class="selectpicker" name="city" id="city">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Pin Code</label>
                                        <input type="text" class="form-control" name="pincode"
                                            value="{{ $profile->pincode ?? '' }}" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Industry Type</label>
                                        <input type="text" class="form-control" name="industry_type"
                                            value="{{ $profile->industry_type ?? '' }}" placeholder="i will">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="text-start">
                                        <button class="ud-btn btn-thm" type="submit">Save<i
                                                class="fal fa-arrow-right-long"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                <div class="bdrb1 pb15 mb25">
                    <h5 class="list-title">Change password</h5>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <form id="changePasswordForm" method="POST" action="{{ route('user.changePassword') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Old Password</label>
                                        <input type="password" name="old_password" class="form-control"
                                            placeholder="********">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">New Password</label>
                                        <input type="password" name="new_password" class="form-control"
                                            placeholder="********">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10">Confirm New Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            placeholder="********">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-start">
                                        <button type="submit" class="ud-btn btn-thm">Change Password <i
                                                class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#state').on('change', function() {
                alert('run');
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        url: '/get-cities/' + stateID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#city').empty();
                            $('#city').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
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

        $(document).ready(function() {
            $('#profileForm').on('submit', function(e) {
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
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire("Success", response.message, "success");
                        } else {
                            Swal.fire("Faild", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error", "Something went wrong!", "error");
                    }
                });
            });
        });


        // change password

        $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{route('user.changePassword')}}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire("Success", response.message, "success");
                        $('#changePasswordForm')[0].reset();
                    },
                    error: function(xhr) {
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

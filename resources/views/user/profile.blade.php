@php
    $title = 'Profile - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp

@extends('layouts.front.user-app')
<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
<style>
    /* Progress Bar Styling */

    .progress-container {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        max-width: 100%;
        margin: 56px;
    }

    /* This is the gray background line of the progress bar */
    .progress-container .progress {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        /* Make it slimmer */
        height: 2px;
        /* Changed from 4px to 2px */
        width: 100%;
        background-color: #e0e0e0;
        /* Gray background */
        z-index: -1;
        border-radius: 1px;
        /* Slight roundness for the line */
    }

    /* This is the actual colored bar that fills up */
    .progress-container .progress-bar {
        /* Use your custom color */
        background-color: #f97a00 !important;
        /* Your custom color */
        height: 100%;
        /* Should match the height of .progress */
        transition: width 0.4s ease;
        border-radius: 1px;
    }

    /* Styling for the numbered steps (circles) */
    .progress-step {
        width: 2rem;
        height: 2rem;
        background-color: #dcdcdc;
        /* Inactive step color */
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        transition: background-color 0.4s ease;
        z-index: 1;
        /* Ensure steps are above the progress line */
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.7);
        /* Adds a white ring around the step */
    }

    /* Color for the active step */
    .progress-step.active {
        background-color: #f97a00;
        /* Your custom color for the active step */
    }

    /* Text label below the steps */
    .progress-step::after {
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #6c757d;
        white-space: nowrap;
        /* Prevent text from wrapping */
    }

    /* Hide all form steps by default */
    .form-step {
        display: none;
    }

    /* Show the active form step */
    .form-step.active {
        display: block;
    }

    /* Make sure thumbnail images are visible */
    .dz-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dropzone {
        border: 2px dashed #007bff;
        border-radius: 5px;
        background: #f9f9f9;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }
</style>
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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- profile details --}}
    
    <div class="overflow-x-hidden mb-3 mb-lg-4">
        <h2 class="fs-4 fw-bold mb-3 w-full pb-3 border-bottom">Profile Details</h2>

        @if (Auth::user()->type == 'user')

            <div class="progress-container mb-5">
                <div class="progress-step active" data-title="Basic Info">1</div>
                <div class="progress-step" data-title="Company Details">2</div>
                <div class="progress-step" data-title="Address & Location">3</div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100">
                    </div>
                </div>
            </div>

            <form id="freelancerProfileForm" class="form-style1" method="post" enctype="multipart/form-data"
                action="{{ route('freelance.user.update_user_profile') }}">
                @csrf

                <div class="form-step active" id="step-1">
                    <h4 class="text-center mb-4">Personal & Location Info</h4>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="username" id="username"
                                    value="{{ Auth::user()->username }}" placeholder="John Doe" required>
                                <label for="username">Name (Username) *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ Auth::user()->email }}" placeholder="name@example.com" required>
                                <label for="email">Email Address *</label>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" name="mobile" id="phone"
                                    value="{{ substr(Auth::user()->mobile, -10) }}" placeholder="1234567890" required>
                                <label for="phone">Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="gst_number" id="gst_number"
                                    value="{{ $profile->gst_number ?? '' }}" placeholder="GSTIN (Optional)">
                                <label for="gst_number">GSTIN Number (Optional)</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="address_line1" id="address_line1"
                                    value="{{ $profile->address_line1 ?? '' }}" placeholder="123 Street" required>
                                <label for="address_line1">Address *</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="pincode" name="pincode"
                                    value="{{ $profile->pincode ?? '' }}" placeholder="123456" required>
                                <label for="pincode">Pin Code *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="city" name="city" class="form-control"
                                    value="{{ $profile->city ?? '' }}" placeholder="City" readonly required>
                                <label for="city">City *</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="state" name="state" class="form-control"
                                    placeholder="State" value="{{ $profile->state ?? '' }}" readonly required>
                                <label for="state">State *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="country" id="country" class="form-select" required>
                                    @foreach ($country->take(1) as $val)
                                        <option value="{{ $val->id }}"
                                            @if ($val->id == 1) selected @endif>
                                            {{ $val->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="country">Country *</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-next">Next →</button>
                         {{-- <button class="btn btn-main btn-next" type="submit" value="Update Profile">Next → </button> --}}
                    </div>
                </div>

                <div class="form-step" id="step-2">
                    <h4 class="text-center mb-4 mt-4">Professional Details</h4>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control focus-shadow-none" name="company_name"
                                        id="company_name" value="{{ $profile->company_name ?? '' }}" placeholder="ABC">
                                    <label for="company_name">Agency Name </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="talent_definition" id="talent_definition" class="form-select" required>
                                    <option value="">Select your talent...</option>
                                    @if (!empty(Hiretalent()) && count(Hiretalent()) > 0)
                                        @foreach (Hiretalent() as $talent)
                                            <option value="{{ $talent->id }}"
                                                @if (!empty($profile->talent_definition)) @if ($profile->talent_definition == $talent->id) selected @endif
                                                @endif>
                                                {{ ucfirst($talent->name) }} </option>
                                        @endforeach
                                    @endif
                                </select>

                                <label for="talent_definition">Define your talent *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="years_experience" id="years_experience"
                                    value="{{ $profile->years_experience ?? '' }}" placeholder="e.g., 5" min="0"
                                    required>
                                <label for="years_experience">Total Experience *</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="highest_qualification"
                                    id="highest_qualification" value="{{ $profile->highest_qualification ?? '' }}"
                                    placeholder="e.g., Bachelor's Degree" required>
                                <label for="highest_qualification">Highest Qualification *</label>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3 mb-3">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="languages_spoken" id="languages_spoken"
                                    value="{{ $profile->languages_spoken ?? '' }}" placeholder="e.g., English, Hindi"
                                    required>
                                <label for="languages_spoken">Languages you speak *</label>
                            </div>
                        </div>


                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-prev">← Previous</button>
                        <button type="button" class="btn btn-primary btn-next">Next →</button>
                        {{-- <button class="btn btn-main btn-next" type="submit" value="Update Profile">Next → </button> --}}
                    </div>
                </div>

                <div class="form-step" id="step-3">
                    <h4 class="text-center mb-4 mt-4">Final Details</h4>
                    <div class="row g-3 mb-3">
                        <!-- Certification -->

                        <!-- Certification -->
                        <div class="col-md-3">
                            <label for="certification_file" class="form-label">Any Certification</label>
                            <div class="dropzone" id="certification-dropzone">
                                <div class="dz-message">Drop file here or click to upload</div>
                            </div>
                            <input type="hidden" name="certification_file" id="certification_file">
                            
                        </div>

                        <!-- Portfolio -->
                        <div class="col-md-3">
                            <label for="portfolio_file" class="form-label">Portfolio</label>
                            <div class="dropzone" id="portfolio-dropzone">
                                <div class="dz-message">Drop file here or click to upload</div>
                            </div>
                            <input type="hidden" name="portfolio_file" id="portfolio_file">
                            <div class="form-text">Attaching a portfolio increases selection chances.</div>
                            
                        </div>

                        <!-- Rate Card -->
                        <div class="col-md-3">
                            <label for="rate_card_file" class="form-label">Rate Card</label>
                            <div class="dropzone" id="ratecard-dropzone">
                                <div class="dz-message">Drop file here or click to upload</div>
                            </div>
                            <input type="hidden" name="rate_card_file" id="rate_card_file">
                          
                        </div>

<!-- Government ID Dropdown -->
<div class="col-md-6">
    <label for="gov_id_type" class="form-label">Government ID</label>
    <select name="gov_id_type" id="gov_id_type" class="form-select">
        <option value="">-- Select ID Type --</option>
        <option value="passport" {{ $profile->gov_id_type == 'passport' ? 'selected' : '' }}>Passport</option>
        <option value="driving_license" {{ $profile->gov_id_type == 'driving_license' ? 'selected' : '' }}>Driving License</option>
        <option value="aadhaar" {{ $profile->gov_id_type == 'aadhaar' ? 'selected' : '' }}>Aadhaar</option>
        <option value="pan" {{ $profile->gov_id_type == 'pan' ? 'selected' : '' }}>PAN</option>
    </select>
</div>

<!-- Passport Front -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'passport' ? '' : 'd-none' }}" id="passport-front-field">
    <label class="form-label">Passport Front</label>
    <div class="dropzone" id="passport-front-dropzone"></div>
    <input type="hidden" name="passport_front" id="passport_front"
           value="{{ $profile->passport_front ?? '' }}">
</div>

<!-- Passport Back -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'passport' ? '' : 'd-none' }}" id="passport-back-field">
    <label class="form-label">Passport Back</label>
    <div class="dropzone" id="passport-back-dropzone"></div>
    <input type="hidden" name="passport_back" id="passport_back"
           value="{{ $profile->passport_back ?? '' }}">
</div>

<!-- Driving License -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'driving_license' ? '' : 'd-none' }}" id="dl-field">
    <label class="form-label">Driving License</label>
    <div class="dropzone" id="dl-dropzone"></div>
    <input type="hidden" name="driving_license" id="driving_license"
           value="{{ $profile->driving_license ?? '' }}">
</div>

<!-- Aadhaar Front -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'aadhaar' ? '' : 'd-none' }}" id="aadhaar-front-field">
    <label class="form-label">Aadhaar Front</label>
    <div class="dropzone" id="aadhaar-front-dropzone"></div>
    <input type="hidden" name="aadhaar_front" id="aadhaar_front"
           value="{{ $profile->aadhaar_front ?? '' }}">
</div>

<!-- Aadhaar Back -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'aadhaar' ? '' : 'd-none' }}" id="aadhaar-back-field">
    <label class="form-label">Aadhaar Back</label>
    <div class="dropzone" id="aadhaar-back-dropzone"></div>
    <input type="hidden" name="aadhaar_back" id="aadhaar_back"
           value="{{ $profile->aadhaar_back ?? '' }}">
</div>

<!-- PAN -->
<div class="col-md-3 gov-field {{ $profile->gov_id_type == 'pan' ? '' : 'd-none' }}" id="pan-field">
    <label class="form-label">PAN</label>
    <div class="dropzone" id="pan-dropzone"></div>
    <input type="hidden" name="pan" id="pan"
           value="{{ $profile->pan ?? '' }}">
</div>






                    </div>
                    <button class="btn btn-main" type="submit" value="Update Profile">Update Profile </button>
                </div>
                
            </form>
        {{-- </div> --}}

@else
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
                    <input type="tel" class="form-control focus-shadow-none" name="mobile" id="phone"
                        value="{{ substr(Auth::user()->mobile, -10) }}" placeholder="1234567890" maxlength="10"
                        pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <label for="phone">Phone Number *</label>
                </div>
            </div>

            <div class="col-md">
                <div class="input-group">
                    <label class="btn btn-outline-secondary mb-0" style="padding: 1rem .75rem;">
                        Profile Picture
                        <input type="file" id="profile_picture" name="profile" hidden
                            onchange="updateFileName(this)">
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
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @if (Auth::user()->role_id == $role->id) selected @endif>
                                {{ ucfirst($role->name) }}</option>
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
                        @if (!empty($role_designation) && count($role_designation) > 0)
                            @foreach ($role_designation as $designation)
                                <option value="{{ $designation->id }}"
                                    @if (!empty($profile->role_designation)) @if ($profile->role_designation == $designation->id) selected @endif
                                    @endif>
                                    {{ $designation->title }} </option>
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

                        <option value="1-10" {{ $profile->work_strength == '1-10' ? 'selected' : '' }}>1 to 10
                        </option>
                        <option value="10-100" {{ $profile->work_strength == '10-100' ? 'selected' : '' }}>10 to
                            100
                        </option>
                        <option value="100+" {{ $profile->work_strength == '100+' ? 'selected' : '' }}>100+
                        </option>
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
                    {{-- <select name="state" id="state" class="form-select focus-shadow-none">
                            @foreach ($state as $stat)
                            <option value="{{ $stat->id }}" @if ($profile->city ?? '' == $stat->id) selected @endif>
                                {{ $stat->name }}</option>
                            @endforeach
                        </select> --}}

                    <input type="text" id="state" name="state" class="form-control focus-shadow-noner"
                        placeholder="State" value="{{ $profile->state ?? '' }}" readonly />

                    <label for="state">State*</label>
                </div>
            </div>

        </div>
        <div class="row gap-3 mb-3">
            {{-- <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" id="pin_code" name="pincode"
                            value="{{ $profile->pincode ?? '' }}" placeholder="123456">
                        <label for="pin_code">Pin Code*</label>
                    </div>
                </div> --}}

            <div class="col-md">
                <div class="form-floating">
                    <input type="text" id="city" name="city" class="form-control focus-shadow-noner"
                        value="{{ $profile->city ?? '' }}" placeholder="City" readonly />
                    <label for="city">City</label>
                </div>
            </div>

            <div class="col-md">
                {{-- <div class="form-floating">
                        <input type="text" class="form-control focus-shadow-none" id="industry_type" name="industry_type"
                            value="{{ $profile->industry_type ?? '' }}">
                        <label for="industry_type">Industry Type*</label>
                    </div> --}}

                <div class="form-floating">
                    <select class="form-select focus-shadow-none" id="industry_type" name="industry_type">

                        <option value="IT & Software"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'IT & Software' ? 'selected' : '' }}>
                            IT & Software</option>
                        <option value="Agriculture"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Agriculture' ? 'selected' : '' }}>
                            Agriculture</option>
                        <option value="Textile & Apparel"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Textile & Apparel' ? 'selected' : '' }}>
                            Textile & Apparel
                        </option>
                        <option value="Automobile"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Automobile' ? 'selected' : '' }}>
                            Automobile</option>
                        <option value="Healthcare"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Healthcare' ? 'selected' : '' }}>
                            Healthcare</option>
                        <option value="Banking"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Banking' ? 'selected' : '' }}>
                            Banking</option>
                        <option value="Real Estate"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Real Estate' ? 'selected' : '' }}>
                            Real Estate</option>
                        <option value="E-Commerce"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'E-Commerce' ? 'selected' : '' }}>
                            E-Commerce</option>
                        <option value="Energy & Power"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Energy & Power' ? 'selected' : '' }}>
                            Energy & Power
                        </option>
                        <option value="Entertainment"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Entertainment' ? 'selected' : '' }}>
                            Entertainment</option>
                        <option value="Others"
                            {{ isset($profile->industry_type_select) && $profile->industry_type_select == 'Others' ? 'selected' : '' }}>
                            Others</option>
                    </select>
                    <label for="industry_type_select">Industry Type*</label>
                </div>

            </div>
        </div>

        <button class="btn btn-main" type="submit" value="Update Profile">Update Profile </button>
    </form>
    @endif
    

    {{-- seperater --}}

    <div class="py-3 py-lg-5 text-center">
        <i class="ri-separator fs-1 text-main"></i>
    </div>

    
    {{-- password update --}}
    {{-- <div class="overflow-x-hidden mt-4"> --}}
        <h2 class="fs-4 fw-bold mb-3 w-full pb-3 border-bottom">Change Password</h2>
        <form id="changePasswordForm" method="POST" action="{{ route('user.changePassword') }}">
            @csrf
            <!-- old password -->

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
                    id="new_password_confirmation" placeholder="Confirm New Password" autocomplete="new-password"
                    required>
                <label for="new_password_confirmation">Confirm New Password</label>
            </div>

            <button type="submit" class="btn btn-main" value="Change Password">Change Password </button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Dropzone JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <script>

        Dropzone.autoDiscover = false;

function initDropzone(selector, hiddenInputId, uploadUrl, existingFile) {
    let dz = new Dropzone(selector, {
        url: uploadUrl,
        paramName: "file",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        maxFiles: 1,
        maxFilesize: 5,
        addRemoveLinks: true,
        acceptedFiles: "image/*,application/pdf",
        previewsContainer: selector,
        init: function () {
            let dropzoneInstance = this;

           
            if (existingFile) {
                let mockFile = { name: existingFile.name, size: existingFile.size || 12345 };
                dropzoneInstance.emit("addedfile", mockFile);

                // If image → show thumbnail
                if (existingFile.url.match(/\.(jpg|jpeg|png|gif)$/i)) {
                    dropzoneInstance.emit("thumbnail", mockFile, existingFile.url);
                }

                dropzoneInstance.emit("complete", mockFile);
                document.getElementById(hiddenInputId).value = existingFile.path;
                dropzoneInstance.files.push(mockFile);
            }

         
            this.on("success", function (file, response) {
                document.getElementById(hiddenInputId).value = response.filepath;
            });

            // ✅ On remove
            this.on("removedfile", function () {
                document.getElementById(hiddenInputId).value = "";
            });
        }
    });

    return dz;
}

// Initialize with existing files from Blade
initDropzone(
    "#certification-dropzone",
    "certification_file",
    "{{ route('freelance.upload.certification') }}",
    @json(!empty($profile->certification_file) ? [
        'name' => basename($profile->certification_file),
        'url' => asset($profile->certification_file),
        'path' => $profile->certification_file
    ] : null)
);

initDropzone(
    "#portfolio-dropzone",
    "portfolio_file",
    "{{ route('freelance.upload.portfolio') }}",
    @json(!empty($profile->portfolio_file) ? [
        'name' => basename($profile->portfolio_file),
        'url' => asset($profile->portfolio_file),
        'path' => $profile->portfolio_file
    ] : null)
);

initDropzone(
    "#ratecard-dropzone",
    "rate_card_file",
    "{{ route('freelance.upload.ratecard') }}",
    @json(!empty($profile->rate_card_file) ? [
        'name' => basename($profile->rate_card_file),
        'url' => asset($profile->rate_card_file),
        'path' => $profile->rate_card_file
    ] : null)
);


// here new 
Dropzone.autoDiscover = false;


function initDropzone(selector, hiddenInputId, uploadUrl, existingFile) {
    return new Dropzone(selector, {
        url: uploadUrl,
        paramName: "file",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/*,application/pdf",
        previewsContainer: selector,
        init: function () {
            let dz = this;

            // Show existing file if available
            if (existingFile) {
                let mockFile = { name: existingFile.name, size: existingFile.size || 12345 };
                dz.emit("addedfile", mockFile);

                // If it's an image → show thumbnail
                if (existingFile.url.match(/\.(jpg|jpeg|png|gif)$/i)) {
                    dz.emit("thumbnail", mockFile, existingFile.url);
                }

                dz.emit("complete", mockFile);
                document.getElementById(hiddenInputId).value = existingFile.path;
                dz.files.push(mockFile);
            }

            // On new upload
            this.on("success", function (file, response) {
                document.getElementById(hiddenInputId).value = response.filepath;
            });

            // On remove
            this.on("removedfile", function () {
                document.getElementById(hiddenInputId).value = "";
            });
        }
    });
}

// Initialize Passport
initDropzone(
    "#passport-front-dropzone",
    "passport_front",
    "{{ route('freelance.upload.passport.front') }}",
    @json(!empty($profile->passport_front) ? [
        'name' => basename($profile->passport_front),
        'url' => asset($profile->passport_front),
        'path' => $profile->passport_front
    ] : null)
);


initDropzone(
    "#passport-back-dropzone",
    "passport_back",
    "{{ route('freelance.upload.passport.back') }}",
    @json(!empty($profile->passport_back) ? [
        'name' => basename($profile->passport_back),
        'url' => asset($profile->passport_back),
        'path' => $profile->passport_back
    ] : null)
);


// Initialize Driving License
initDropzone(
    "#dl-dropzone",
    "driving_license",
    "{{ route('freelance.upload.driving.license') }}",
    @json(!empty($profile->driving_license) ? [
        'name' => basename($profile->driving_license),
        'url' => asset($profile->driving_license),
        'path' => $profile->driving_license
    ] : null)
);


// Toggle fields based on dropdown
document.getElementById("gov_id_type").addEventListener("change", function () {
    // Hide all gov id fields first
    document.querySelectorAll(".gov-field").forEach(el => el.classList.add("d-none"));

    if (this.value === "passport") {
        document.getElementById("passport-front-field").classList.remove("d-none");
        document.getElementById("passport-back-field").classList.remove("d-none");
    } else if (this.value === "driving_license") {
        document.getElementById("dl-field").classList.remove("d-none");
    } else if (this.value === "aadhaar") {
        document.getElementById("aadhaar-front-field").classList.remove("d-none");
        document.getElementById("aadhaar-back-field").classList.remove("d-none");
    } else if (this.value === "pan") {
        document.getElementById("pan-field").classList.remove("d-none");
    }
});


// here upload adahr pan 

Dropzone.autoDiscover = false;

function initDropzone(selector, hiddenInputId, uploadUrl, existingFile) {
    return new Dropzone(selector, {
        url: uploadUrl,
        paramName: "file",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: "image/*,application/pdf",
        previewsContainer: selector,
        init: function () {
            let dz = this;

            if (existingFile) {
                let mockFile = { name: existingFile.name, size: existingFile.size || 12345 };
                dz.emit("addedfile", mockFile);
                if (existingFile.url.match(/\.(jpg|jpeg|png|gif)$/i)) {
                    dz.emit("thumbnail", mockFile, existingFile.url);
                }
                dz.emit("complete", mockFile);
                document.getElementById(hiddenInputId).value = existingFile.path;
                dz.files.push(mockFile);
            }

            this.on("success", function (file, response) {
                document.getElementById(hiddenInputId).value = response.filepath;
            });
            this.on("removedfile", function () {
                document.getElementById(hiddenInputId).value = "";
            });
        }
    });
}

// Aadhaar Front
initDropzone(
    "#aadhaar-front-dropzone",
    "aadhaar_front",
    "{{ route('freelance.upload.aadhaar.front') }}",
    @json(!empty($profile->aadhaar_front) ? [
        'name' => basename($profile->aadhaar_front),
        'url'  => asset($profile->aadhaar_front),
        'path' => $profile->aadhaar_front
    ] : null)
);

// Aadhaar Back
initDropzone(
    "#aadhaar-back-dropzone",
    "aadhaar_back",
    "{{ route('freelance.upload.aadhaar.back') }}",
    @json(!empty($profile->aadhaar_back) ? [
        'name' => basename($profile->aadhaar_back),
        'url'  => asset($profile->aadhaar_back),
        'path' => $profile->aadhaar_back
    ] : null)
);

// PAN
initDropzone(
    "#pan-dropzone",
    "pan",
    "{{ route('freelance.upload.pan') }}",
    @json(!empty($profile->pan) ? [
        'name' => basename($profile->pan),
        'url'  => asset($profile->pan),
        'path' => $profile->pan
    ] : null)
);




        // end heree passpot 

        // here progress bar code

        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            if (input.files && input.files.length > 0) {
                fileNameDisplay.value = input.files[0].name;
            } else {
                fileNameDisplay.value = 'No file chosen';
            }
        }


        $(document).ready(function() {
            let currentStep = 0;
            const formSteps = $(".form-step");
            const progressSteps = $(".progress-step");

            // Function to show a specific step
            function showStep(stepIndex) {
                formSteps.removeClass("active");
                $(formSteps[stepIndex]).addClass("active");
                updateProgressBar(stepIndex);
            }

            // Function to update the progress bar
            function updateProgressBar(stepIndex) {
                progressSteps.each(function(idx, step) {
                    if (idx <= stepIndex) {
                        $(step).addClass("active");
                    } else {
                        $(step).removeClass("active");
                    }
                });

                const progress = (stepIndex / (progressSteps.length - 1)) * 100;
                $(".progress-bar").css("width", progress + "%");
            }

            // "Next" button click handler
            $(".btn-next").on("click", function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    if (currentStep < formSteps.length) {
                        showStep(currentStep);
                    }
                }
            });

            // "Previous" button click handler
            $(".btn-prev").on("click", function() {
                currentStep--;
                if (currentStep >= 0) {
                    showStep(currentStep);
                }
            });

            // Function to validate the current step
            function validateStep(stepIndex) {
                let isValid = true;
                const currentStepFields = $(formSteps[stepIndex]).find("input[required], select[required]");

                currentStepFields.each(function() {
                    if ($(this).val().trim() === "") {
                        isValid = false;
                        $(this).addClass("is-invalid"); // Add Bootstrap's invalid class
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

                if (!isValid) {
                    alert("Please fill out all required fields marked with *");
                }

                return isValid;
            }

            // Initialize the form
            showStep(currentStep);
        });

        // end 
        document.getElementById('pincode').addEventListener('blur', function() {
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


        document.querySelectorAll('.toggle-password').forEach(function(toggleIcon) {
            toggleIcon.addEventListener('click', function() {
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
            fieldIds.forEach(function(id) {
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

        $(document).ready(function() {

            $('input').on('keyup', function() {
                highlightMandatoryFields(['username', 'email', 'phone', 'company_name', 'role',
                    'role_designation', 'address_line1', 'country', 'state', 'pin_code',
                    'industry_type'
                ]);
            });

            $('#state').on('change', function() {
                // alert('run');
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
                            highlightMandatoryFields(['username', 'email', 'phone',
                                'company_name', 'role', 'role_designation',
                                'address_line1', 'country', 'state', 'pin_code',
                                'industry_type'
                            ]);

                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error", "Something went wrong!", "error");
                        highlightMandatoryFields(['username', 'email', 'phone', 'company_name',
                            'role', 'role_designation', 'address_line1', 'country',
                            'state', 'pin_code', 'industry_type'
                        ]);

                    }
                });
            });

            // here freelancer update profile 

            $('#freelancerProfileForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                // var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('freelance.user.update_user_profile') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == true) {

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
                            highlightMandatoryFields(['username', 'email', 'phone',

                                'address_line1', 'country', 'state', 'pin_code',
                                'industry_type'
                            ]);

                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error", "Something went wrong!", "error");
                        highlightMandatoryFields(['username', 'email', 'phone', 'address_line1',
                            'country',
                            'state', 'pin_code', 'industry_type'
                        ]);
                    }
                });
            });

        });

        // here add bank details form 

        $('#update_bank_details').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('update.bank.details') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == true) {

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
                        highlightMandatoryFields(['username', 'email', 'phone',
                            'role', 'role_designation',
                            'address_line1', 'country', 'state', 'pin_code',
                            'industry_type'
                        ]);

                    }
                },
                error: function(xhr) {
                    Swal.fire("Error", "Something went wrong!", "error");
                    highlightMandatoryFields(['username', 'email', 'phone',
                        'role', 'role_designation', 'address_line1', 'country',
                        'state', 'pin_code', 'industry_type'
                    ]);
                }
            });
        });


        // end here bank 


        // change password

        $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('user.changePassword') }}",
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

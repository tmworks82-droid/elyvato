@php
    $title = 'Payments - Elyvato';
    $robotsMeta = 'noindex, nofollow';
@endphp

@extends('layouts.front.user-app')

@section('pageContent')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
<style>
    th{
            font-weight: 600;
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

    {{-- header --}}

    <div class="mb-3 mb-lg-4">
        <div class="d-flex gap-3 flex-wrap">
            <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line"></i>
            </button>
            <h1 class="fw-bold mb-0">Payment Setting</h1>
        </div>
    </div>

    
    <div class="overflow-x-hidden">
    <form  id="bankDetailsForm" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

        @if(empty($bank_detail) || $bank_detail->status=='rejected')  

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="account_no" class="form-label">Account Number</label>
                <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Enter account number" value="{{$bank_detail->account_no ?? ''}}"  required>
            </div>

            <div class="col-md-6">
                <label for="ifsc_code" class="form-label">IFSC/MICR Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code" value="{{$bank_detail->ifsc_code ?? ''}}" class="form-control" placeholder="Enter IFSC code" required>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-6">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter bank name" value="{{$bank_detail->bank_name ?? ''}}" required>
            </div>

            <div class="col-md-4">
                <label for="cancelled_check_image" class="form-label">Upload Cancelled Cheque</label>
                <div class="dropzone" id="cancelled-check-dropzone">
                    <div class="dz-message">Drop file here or click to upload</div>
                </div>
                <input type="hidden" name="cancelled_check_image" id="cancelled_check_image"
                    value="{{ $bank_detail->cancelled_check_image ?? '' }}">
            </div>

            <!-- Government ID Dropdown -->
<div class="col-md-6">
    <label for="gov_id_type" class="form-label">Government ID</label>
    <select name="gov_id_type" id="gov_id_type" class="form-select">
        <option value="">-- Select ID Type --</option>
        <option value="passport" {{ $bank_detail->gov_id_type == 'passport' ? 'selected' : '' }}>Passport</option>
        <option value="driving_license" {{ $bank_detail->gov_id_type == 'driving_license' ? 'selected' : '' }}>Driving License</option>
        <option value="aadhaar" {{ $bank_detail->gov_id_type == 'aadhaar' ? 'selected' : '' }}>Aadhaar</option>
        <option value="pan" {{ $bank_detail->gov_id_type == 'pan' ? 'selected' : '' }}>PAN</option>
    </select>
</div>

<!-- Passport Front -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'passport' ? '' : 'd-none' }}" id="passport-front-field">
    <label class="form-label">Passport Front</label>
    <div class="dropzone" id="passport-front-dropzone"></div>
    <input type="hidden" name="passport_front" id="passport_front"
           value="{{ $bank_detail->passport_front ?? '' }}">
</div>

<!-- Passport Back -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'passport' ? '' : 'd-none' }}" id="passport-back-field">
    <label class="form-label">Passport Back</label>
    <div class="dropzone" id="passport-back-dropzone"></div>
    <input type="hidden" name="passport_back" id="passport_back"
           value="{{ $bank_detail->passport_back ?? '' }}">
</div>

<!-- Driving License -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'driving_license' ? '' : 'd-none' }}" id="dl-field">
    <label class="form-label">Driving License</label>
    <div class="dropzone" id="dl-dropzone"></div>
    <input type="hidden" name="driving_license" id="driving_license"
           value="{{ $bank_detail->driving_license ?? '' }}">
</div>

<!-- Aadhaar Front -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'aadhaar' ? '' : 'd-none' }}" id="aadhaar-front-field">
    <label class="form-label">Aadhaar Front</label>
    <div class="dropzone" id="aadhaar-front-dropzone"></div>
    <input type="hidden" name="aadhaar_front" id="aadhaar_front"
           value="{{ $bank_detail->aadhaar_front ?? '' }}">
</div>

<!-- Aadhaar Back -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'aadhaar' ? '' : 'd-none' }}" id="aadhaar-back-field">
    <label class="form-label">Aadhaar Back</label>
    <div class="dropzone" id="aadhaar-back-dropzone"></div>
    <input type="hidden" name="aadhaar_back" id="aadhaar_back"
           value="{{ $bank_detail->aadhaar_back ?? '' }}">
</div>

<!-- PAN -->
<div class="col-md-3 gov-field {{ $bank_detail->gov_id_type == 'pan' ? '' : 'd-none' }}" id="pan-field">
    <label class="form-label">PAN</label>
    <div class="dropzone" id="pan-dropzone"></div>
    <input type="hidden" name="pan" id="pan"
           value="{{ $bank_detail->pan ?? '' }}">
</div>


        </div>

        <button type="submit" class="btn btn-main">Save Bank Details</button>
        @else
        <h4 class="mb-3">Your Bank Details (Status: <span class="badge text-primary text-capitalize">{{$bank_detail->status}}</span>)</h4>
         <div class="row mb-3">
            <div class="col-md-6">
                <label for="account_no" class="form-label">Account Number</label>
                <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Enter account number" value="{{$bank_detail->account_no ?? ''}}"  disabled>
            </div>

            <div class="col-md-6">
                <label for="ifsc_code" class="form-label">IFSC/MICR Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code" value="{{$bank_detail->ifsc_code ?? ''}}" class="form-control" placeholder="Enter IFSC code" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter bank name" value="{{$bank_detail->bank_name ?? ''}}" disabled>
            </div>

            <div class="col-md-4">
                <label for="cancelled_check_image" class="form-label">Uploaded Cancelled Cheque</label>
               
                <a href="{{url($bank_detail->cancelled_check_image ?? '')}}" target="_blank">
                <img src="{{ url($bank_detail->cancelled_check_image ?? '') }}" alt="checkbook" width="100" height="100" >
                </a>
            </div>
            
               
                @if($bank_detail->gov_id_type=='pan')
                <div class="col-md-4">
                <label for="cancelled_check_image" class="form-label">Pan Card</label> <br>
                    <a href="{{url($bank_detail->pan)}}">
                    <img src="{{url($bank_detail->pan)}}" width="100" height="100" alt="">
                    </a>
                
            </div>
            @endif

            
                @if($bank_detail->gov_id_type=='aadhaar')
                    <div class="col-md-4">
                    <label for="cancelled_check_image" class="form-label">Aadhaar Front</label> <br>
                    <a href="{{url($bank_detail->aadhaar_front)}}" target="_blank">
                        <img src="{{url($bank_detail->aadhaar_front)}}" width="100" height="100" alt="">
                        </a>
                    </div>
                @endif

                @if($bank_detail->gov_id_type=='aadhaar')
                    <div class="col-md-4">
                    <label for="cancelled_check_image" class="form-label">Aadhaar Back</label> <br>
                    <a href="{{url($bank_detail->aadhaar_back)}}">
                        <img src="{{url($bank_detail->aadhaar_back)}}" width="100" height="100" alt="">
                    </a>
                    </div>
                @endif
            
                @if($bank_detail->gov_id_type=='driving_license')
                    <div class="col-md-4">
                    <label for="driving_licese" class="form-label">Driving License</label> <br>
                    <a href="{{url($bank_detail->driving_license)}}">
                        <img src="{{url($bank_detail->driving_license)}}" width="100" height="100" alt="">
                        </a>
                    </div>
                @endif

                @if($bank_detail->gov_id_type=='passport')
                <div class="col-md-4">
                 <label for="driving_licese" class="form-label">Passport Front</label> <br>
                 <a href="{{url($bank_detail->passport_front)}}" target="_blank">
                    <img src="{{url($bank_detail->passport_front)}}" width="100" height="100" alt="">
                    </a>
                </div>
                @endif

                @if($bank_detail->gov_id_type == 'passport')
                <div class="col-md-4">
                    <label for="driving_licese" class="form-label">Passport Back</label> <br>
                    <a href="{{url($bank_detail->passport_back)}}" target="_blank">
                        <img src="{{url($bank_detail->passport_back)}}" width="100" height="100" alt="">
                    </a>
                </div>
                @endif

        </div>
        @endif

    </form>
</div>


@endsection

@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
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


Dropzone.autoDiscover = false;

initDropzone(
    "#cancelled-check-dropzone",
    "cancelled_check_image",
    "{{ route('freelance.upload.cancelled.check') }}",
    @json(!empty($bank_detail->cancelled_check_image) ? [
        'name' => basename($bank_detail->cancelled_check_image),
        'url' => asset($bank_detail->cancelled_check_image),
        'path' => $bank_detail->cancelled_check_image
    ] : null)
);

function initDropzone(selector, hiddenInputId, uploadUrl, existingFile) {
    return new Dropzone(selector, {
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
            let dz = this;

            // Show existing file if available
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

            // On upload success
            this.on("success", function (file, response) {
                document.getElementById(hiddenInputId).value = response.filepath;
            });

            // On file remove
            this.on("removedfile", function () {
                document.getElementById(hiddenInputId).value = "";
            });
        }
    });
}

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
    @json(!empty($bank_detail->aadhaar_front) ? [
        'name' => basename($bank_detail->aadhaar_front),
        'url'  => asset($bank_detail->aadhaar_front),
        'path' => $bank_detail->aadhaar_front
    ] : null)
);

// Aadhaar Back
initDropzone(
    "#aadhaar-back-dropzone",
    "aadhaar_back",
    "{{ route('freelance.upload.aadhaar.back') }}",
    @json(!empty($bank_detail->aadhaar_back) ? [
        'name' => basename($bank_detail->aadhaar_back),
        'url'  => asset($bank_detail->aadhaar_back),
        'path' => $bank_detail->aadhaar_back
    ] : null)
);

// PAN
initDropzone(
    "#pan-dropzone",
    "pan",
    "{{ route('freelance.upload.pan') }}",
    @json(!empty($bank_detail->pan) ? [
        'name' => basename($bank_detail->pan),
        'url'  => asset($bank_detail->pan),
        'path' => $bank_detail->pan
    ] : null)
);


// here is udpate bank details

 $('#bankDetailsForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('update.bank.details') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.success){
                    
                    $('#bankDetailsForm')[0].reset();

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

                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value + "\n";
                });
                // alert("Error:\n" + errorMessage);
                Swal.fire({
                    title: "error",
                    text: errorMessage,
                    icon: "warning",
                    confirmButtonText: "OK"
                })
            }
        });
    });

 
</script>

{{-- here is new dropzone start  --}}
<script>
Dropzone.autoDiscover = false;

// Generic init function
function initDropzone(selector, hiddenInputId, uploadUrl, existingFile) {
    let el = document.querySelector(selector);
    if (!el) return;

    // Destroy if already attached
    if (el.dropzone) {
        el.dropzone.destroy();
    }

    return new Dropzone(el, {
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

            // Preload existing file
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

            // On upload success
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

// -------- Initialize Dropzones --------

// Passport
initDropzone(
    "#passport-front-dropzone",
    "passport_front",
    "{{ route('freelance.upload.passport.front') }}",
    @json(!empty($bank_detail->passport_front) ? [
        'name' => basename($bank_detail->passport_front),
        'url' => asset($bank_detail->passport_front),
        'path' => $bank_detail->passport_front
    ] : null)
);

initDropzone(
    "#passport-back-dropzone",
    "passport_back",
    "{{ route('freelance.upload.passport.back') }}",
    @json(!empty($bank_detail->passport_back) ? [
        'name' => basename($bank_detail->passport_back),
        'url' => asset($bank_detail->passport_back),
        'path' => $bank_detail->passport_back
    ] : null)
);

// Driving License
initDropzone(
    "#dl-dropzone",
    "driving_license",
    "{{ route('freelance.upload.driving.license') }}",
    @json(!empty($bank_detail->driving_license) ? [
        'name' => basename($bank_detail->driving_license),
        'url' => asset($bank_detail->driving_license),
        'path' => $bank_detail->driving_license
    ] : null)
);

// Aadhaar
initDropzone(
    "#aadhaar-front-dropzone",
    "aadhaar_front",
    "{{ route('freelance.upload.aadhaar.front') }}",
    @json(!empty($bank_detail->aadhaar_front) ? [
        'name' => basename($bank_detail->aadhaar_front),
        'url' => asset($bank_detail->aadhaar_front),
        'path' => $bank_detail->aadhaar_front
    ] : null)
);

initDropzone(
    "#aadhaar-back-dropzone",
    "aadhaar_back",
    "{{ route('freelance.upload.aadhaar.back') }}",
    @json(!empty($bank_detail->aadhaar_back) ? [
        'name' => basename($bank_detail->aadhaar_back),
        'url' => asset($bank_detail->aadhaar_back),
        'path' => $bank_detail->aadhaar_back
    ] : null)
);

// PAN
initDropzone(
    "#pan-dropzone",
    "pan",
    "{{ route('freelance.upload.pan') }}",
    @json(!empty($bank_detail->pan) ? [
        'name' => basename($bank_detail->pan),
        'url' => asset($bank_detail->pan),
        'path' => $bank_detail->pan
    ] : null)
);

// -------- Dropdown toggle --------
document.getElementById("gov_id_type").addEventListener("change", function () {
    // Hide all fields
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
</script>

@endsection
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

        </div>
        @endif

    </form>
</div>


@endsection

@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
$(document).ready(function () {
 

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

@endsection
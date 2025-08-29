@php
    $page_name = 'Statement Of Work';
    $routeUrl = 'create-statement';
    $permission = 'service';
@endphp

@extends('layouts.main')
@section('title', 'Elyvato Dashboard | '.$page_name.' list')
@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">{{ $page_name }}</li>
              <li class="breadcrumb-item active">Create New</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

        <section class="content">


      <div class="container mt-4">
        <div class="card">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <div class="card-header bg-info text-white">
            <h3 class="card-title">Add SOW</h3>
          </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">

        <form method="POST" action="{{ route('save.statement-work') }}"  enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="id" value="{{ $statement->id ?? '' }}">
          <input type="hidden" id="preselected_subservice" value="{{ old('subservice_id', $statement->subservice_id ?? '') }}">


          <div class="row">
            <div class="mb-3 col-md-4">
            <label for="service_id" class="form-label">Service</label>
            <select class="form-select form-control" id="service_id" name="service_id" required>
                <option value="">Select Service</option>
                @if(!empty($service) && count($service) > 0)
                @foreach($service as $ser)
                    <option value="{{ $ser->id }}" {{ (old('service_id', $statement->service_id ?? '') == $ser->id) ? 'selected' : '' }}>
                    {{ $ser->name }}
                    </option>
                @endforeach
                @endif
            </select>
            </div>

            <div class="mb-3 col-md-4">
                <label for="subservice_id" class="form-label">Subservice</label>
                <select class="form-select form-control" id="subservice_id" name="subservice_id" required>
                    <option value="">Select Subservice</option>
                </select>
            </div>

            <!-- Title -->
            <div class="mb-3 col-md-4">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="{{ old('title', $statement->title ?? '') }}" required>
            </div>

            <!-- Price Range -->
            <div class="mb-3 col-md-4">
              <label for="min_price" class="form-label">Min Price</label>
              <input type="number" class="form-control" id="min_price" name="min_price" step="0.01" placeholder="Enter min price" value="{{ old('min_price', $statement->min_price ?? '') }}">
            </div>

            <div class="mb-3 col-md-4">
              <label for="max_price" class="form-label">Max Price</label>
              <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Enter max price" step="0.01" value="{{ old('max_price', $statement->max_price ?? '') }}">
            </div>

            <div class="mb-3 col-md-4">
              <label for="max_price" class="form-label">Offer Price</label>
              <input type="number" class="form-control" id="offer_price" name="offer_price" placeholder="Enter max price" step="0.01" value="{{ old('offer_price', $statement->offer_price ?? '') }}">
            </div>

            <!-- Estimated Time -->
            <div class="mb-3 col-md-4">
              <label for="estimated_time" class="form-label">Estimated Time</label>
              <input type="text" class="form-control" id="estimated_time" name="estimated_time" placeholder="Enter estimate time" value="{{ old('estimated_time', $statement->estimated_time ?? '') }}">
            </div>

            <div class="mb-3 col-md-4">
              <label for="file_type" class="form-label">Files Formate</label>
              <select name="file_type" id="file_type" class="form-control">
                <option value="">Select File Type</option>
                <option value="image">Image</option>
                <option value="video">Video</option>
              </select>
            </div>

            {{-- here file  --}}

            <!-- Image Input -->
            <div class="mb-3 file-input-group col-md-4" id="image_input" style="display: none;">

              <label class="form-label d-flex justify-content-between">
                Image Files
              </label>

              <div class="input-group" id="image_input_group">
                <input type="file" class="form-control mb-2" name="image_path[]" accept="image/pdf*">
                <button type="button" class="btn btn-success" id="add_image_input">+</button>
              </div>
              
            </div>

            <!-- Audio Input -->
            <div class="mb-3 file-input-group col-md-4" id="audio_input" style="display: none;">
              <label class="form-label d-flex justify-content-between">
                Audio Files
              </label>

              <div class="input-group" id="audio_input_group">
                <input type="file" class="form-control" name="audio_path[]" accept="audio/*">
                <button type="button" class="btn btn-sm btn-success" id="add_audio_input">+</button>
              </div>

            </div>

            <!-- Video Input -->
            <div class="mb-3 file-input-group col-md-4" id="video_input" style="display: none;">
              <label class="form-label d-flex justify-content-between">
                Video Link
              </label>

              <div class="input-group" id="video_input_group">
                <input type="text" class="form-control" placeholder="Past here video link" name="video[]" accept="video/*">
                <button type="button" class="btn btn-sm btn-success" id="add_video_input">+</button>
              </div>
            </div>

            {{-- here end files  --}}

            <!-- featured  -->

            <div class="mb-3 col-md-4">
              <label class="form-label d-block">Featured</label>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="featured" id="featured" value="yes"
                  {{ (isset($statement) && $statement->featured == 'yes') ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">Yes</label>
               
              </div>
              <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="featured" id="no" value="no"
                  {{ (isset($statement) && $statement->featured == 'no') ? 'checked' : '' }} checked>
                <label class="form-check-label" for="no">No</label>
                </div>
            </div>
            
            <!--is subscription -->
            <div class="mb-3 col-md-4">
              <label class="form-label d-block">Subscription (Yes/No)</label>
            
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="subscription" id="sub_active" value="yes"
                  {{ (isset($statement) && $statement->is_subscription == 'yes') ? 'checked' : '' }}>
                <label class="form-check-label" for="sub_active">Yes</label>
              </div>
            
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="subscription" id="sub_inactive" value="no"
                  {{ (isset($statement) && $statement->is_subscription == 'no') ? 'checked' : '' }}>
                <label class="form-check-label" for="sub_inactive">No</label>
              </div>
            </div>
            
            <div class="mb-3 col-md-4" id="subscription_time_wrapper" style="display: none;">
              <label for="subscription_time" class="form-label">Subscription Time</label>
              <select class="form-select form-control" id="subscription_time" name="subscription_time">
                <option value="">Subs Time</option>
                <option value="monthly" {{ (isset($statement) && $statement->subscription_time == 'monthly') ? 'selected' : '' }}>Monthly</option>
                <option value="weekly" {{ (isset($statement) && $statement->subscription_time == 'weekly') ? 'selected' : '' }}>Weekly</option>
                <option value="biweekly"  {{ (isset($statement) && $statement->subscription_time == 'biweekly') ? 'selected' : '' }}>Biweekly</option>
              </select>
            </div>

            
            
            
            <!-- Is Active -->
            <div class="mb-3 col-md-4">
              <label class="form-label d-block">Is Active</label>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="active" value="1"
                  {{ (isset($statement) && $statement->is_active == 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Active</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0"
                  {{ (isset($statement) && $statement->is_active == 0) ? 'checked' : '' }}>
                <label class="form-check-label" for="inactive">Inactive</label>
              </div>
            </div>

            

            <!-- Description -->
            <div class="mb-3 col-md-12">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $statement->description ?? '') }}</textarea>
            </div>

                <!-- SEO Title -->
                <div class="mb-3 col-md-6">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control"
                        value="{{ old('seo_title', $statement->seo_title ?? '') }}" required>
                </div>

                 <!-- Meta Description -->
                <div class="mb-3 col-md-6">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" required>{{ old('meta_description', $statement->meta_description ?? '') }}</textarea>
                </div>

          </div>

          <button type="submit" name="button" value="Save Statement of works" class="btn btn-success mt-3">Save Statement of Work</button>
        </form>

      </div>
        </div>
      </div>

    </section>
    <!-- /.content -->

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
  

    CKEDITOR.replace('description');

    CKEDITOR.instances.description.on('change', function () {
        // get HTML from CKEditor
        let htmlData = CKEDITOR.instances.description.getData();

        // convert to plain text
        let plainText = $('<div>').html(htmlData).text();

        // only update if meta_description is empty
        // if ($('#meta_description').val().trim() === '') {
            $('#meta_description').val(plainText);
        // }
    });

     // --- Title to SEO Title ---
    $('#title').on('input', function () {
        let titleVal = $(this).val();
      $('#seo_title').val(titleVal);
      
    });

    $(document).ready(function() {
    $('#min_price').on('input', function() {
        let min = parseFloat($(this).val());
        if (!isNaN(min)) {
            let max = Math.ceil(min * 1.05); // add 5% and round up
            $('#max_price').val(max);
        }
    });

    $('#max_price').on('input', function() {
        let max = parseFloat($(this).val());
        if (!isNaN(max)) {
            let min = Math.floor(max * 0.95); // subtract 5% and round down
            $('#min_price').val(min);
        }
    });


});



  $(document).ready(function() {
  // Show the correct input group based on selected file type
  $('#file_type').on('change', function() {
    $('.file-input-group').hide();
    var selected = $(this).val();

    if (selected === 'image') {
      $('#image_input').show();
    }else if (selected === 'pdf') {
      $('#image_input').show();
    }   
    else if (selected === 'audio') {
      $('#audio_input').show();
    } else if (selected === 'video') {
      $('#video_input').show();
    }
  });


  function createInput(name, accept = '', type = 'file') {
    // alert(placeholder);

  return `
    <div class="input-group mb-2">
      <input type="${type}" class="form-control" name="${name}"  ${accept ? `accept="${accept}"` : ''}>
      <button type="button" class="btn btn-danger remove-input">−</button>
    </div>
  `;
}

// Add more image inputs (type="file")
$('#add_image_input').click(function() {
  $('#image_input_group').append(createInput('image_path[]', 'image/*', 'file'));
});

// Add more audio inputs (type="file")
$('#add_audio_input').click(function() {
  $('#audio_input_group').append(createInput('audio_path[]', 'audio/*', 'file'));
});

// Add more video inputs (type="text")
$('#add_video_input').click(function() {
  $('#video_input_group').append(createInput('video[]', '', 'text'));
});

// Remove input when − button is clicked
$(document).on('click', '.remove-input', function() {
  $(this).closest('.input-group').remove();
});

});

// add files

$('#addFilesForm').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ route('allfiles.store') }}", // adjust route name
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#addFilesForm')[0].reset();
            $('.file-input-group').hide();

            $.toast({
                      heading: 'Success',
                      text: response.message,
                      showHideTransition: 'slide',
                      icon: 'success',
                      position: 'top-right',
                  })
            location.reload();
        },
        error: function(xhr) {
            alert('Upload failed: ' + xhr.responseJSON.message);
        }
    });
});

  </script>

<script>

  $(document).ready(function () {
    let subserviceDropdown = $('#subservice_id');
    let serviceDropdown = $('#service_id');
    let preselectedSubservice = $('#preselected_subservice').val();
    // alert(serviceDropdown);
    function loadSubservices(serviceId, selectedSubId = null) {
        subserviceDropdown.html('<option value="">Select Subservice</option>');

        if (serviceId) {
            $.ajax({
                url: '{{ route("get-subservices") }}',
                type: 'GET',
                data: { service_id: serviceId },
                success: function (response) {
                    $.each(response, function (key, subservice) {
                        let selected = (selectedSubId && selectedSubId == subservice.id) ? 'selected' : '';
                        subserviceDropdown.append('<option value="' + subservice.id + '" ' + selected + '>' + subservice.name + '</option>');
                    });
                }
            });
        }
    }

    // On service change
    serviceDropdown.change(function () {
        let serviceId = $(this).val();
        loadSubservices(serviceId);
    });

    // If editing (preselected subservice exists)
    if (serviceDropdown.val() && preselectedSubservice) {
        loadSubservices(serviceDropdown.val(), preselectedSubservice);
    }
});


 $(document).ready(function () {
    function toggleSubscriptionTime() {
      const selected = $('input[name="subscription"]:checked').val();
      if (selected === 'yes') {
        $('#subscription_time_wrapper').show();
      } else {
        $('#subscription_time_wrapper').hide();
        $('#subscription_time').val('');
      }
    }

    // Initial check on page load (in case it's pre-filled)
    toggleSubscriptionTime();

    // On change
    $('input[name="subscription"]').on('change', toggleSubscriptionTime);
  });
  

</script>

@endpush

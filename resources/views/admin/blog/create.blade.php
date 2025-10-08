@php
    $page_name = 'Blog Create';
    $routeUrl = 'blog';
    $permission = 'blog';
@endphp

@extends('layouts.main')
@section('title', 'Service Create | ' . $page_name . ' list')
@section('content')
<style>
    #content {
    min-height: 60px; 
    height: 60px;     
}
</style>
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
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Add Blog</h3>
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
                        <form method="POST" action="{{ route($routeUrl . '.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                @if (!empty($blog))
                                    <input type="hidden" name="id" value="{{ $blog->id }}">
                                @endif
                                <div class="mb-3 col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title', $blog->title ?? '') }}" required>
                                </div>

                                <!-- Slug -->
                                {{-- <div class="mb-3 col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                            value="{{ old('slug', $blog->slug ?? '') }}" required>
                                    </div> --}}
                                @php
                                    // Check if $blog exists and has 'category', else default to empty array
                                    $selectedCategories = [];

                                    if (isset($blog) && !empty($blog->category)) {
                                        $selectedCategories = is_array($blog->category)
                                            ? $blog->category
                                            : json_decode($blog->category, true);
                                    }
                                @endphp

                                <!-- Category -->
                                <div class="mb-3 col-sm-6">
                                    <label class="form-label d-block">Select Categories/Services</label>

                                    @foreach (Service() as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="category[]"
                                                value="{{ $item->id }}" id="service_{{ $item->id }}"
                                                {{ in_array($item->id, $selectedCategories) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service_{{ $item->id }}">
                                                {{ $item->name }}
                                            </label>
                                        </div>
                                        <br>
                                    @endforeach
                                </div>


                                <!-- Featured Image -->
                                <div class="mb-3 col-md-6">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                                    @if (!empty($blog) && !empty($blog->featured_image))
                                        <img src="{{ asset($blog->featured_image) }}" alt="Image" class="mt-2"
                                            width="100">
                                    @endif
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label class="form-label d-block">Is Active</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="active"
                                            value="1" @if (!empty($blog) && $blog->is_active == 1) checked @endif required>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_active" id="inactive"
                                            value="0" @if (!empty($blog) && $blog->is_active == 0) checked @endif required>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>

                             <div class="mb-3 col-md-3">
    <label class="form-label d-block">Is Footer</label>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="footer_status" id="yes"
            value="1" @if (!empty($blog) && $blog->footer_status == 1) checked @endif required>
        <label class="form-check-label" for="yes">Yes</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="footer_status" id="no"
            value="0" @if (!empty($blog) && $blog->footer_status == 0) checked @endif required>
        <label class="form-check-label" for="no">No</label>
    </div>
</div>

<div class="mb-3 col-md-6" id="footerTitleBox">
    <label for="footer_title" class="form-label">Footer Title</label>
    <input type="text" name="footer_title" id="footer_title" class="form-control"
        value="{{ old('footer_title', $blog->footer_title ?? '') }}">
</div>





                                <!-- Content -->
                                <div class="mb-3 col-sm-12">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $blog->content ?? '') }}</textarea>
                                </div>

                                <!-- SEO Title -->
                                <div class="mb-3 col-md-6">
                                    <label for="seo_title" class="form-label">SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title" class="form-control"
                                        value="{{ old('seo_title', $blog->seo_title ?? '') }}" required>
                                </div>

                                <!-- Meta Description -->
                                <div class="mb-3 col-md-6">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" required>{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                </div>

                            </div>


                            <button type="submit" name="button" value="save service" class="btn btn-primary mt-3">Save
                                Service</button>
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
    {{-- <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>

    <script>


        ClassicEditor
    .create(document.querySelector('#content'))
    .then(editor => {
       
        const descriptionEditor = editor;

        descriptionEditor.model.document.on('change:data', function() {
            
            let htmlData = descriptionEditor.getData();

            let plainText = $('<div>').html(htmlData).text();

            let wordArray = plainText.split(/\s+/); 
            if (wordArray.length > 200) {
                wordArray = wordArray.slice(0, 200); 
            }
 
            $('#meta_description').val(wordArray.join(' '));
        });
    })
    .catch(error => {
        console.error(error);
    });


        // --- Title to SEO Title ---
        $('#title').on('input', function() {
            let titleVal = $(this).val();

            // only update if seo_title is empty
            // if ($('#seo_title').val().trim() === '') {
            $('#seo_title').val(titleVal);
            // }
        });
  

        // here show hide footer title 
document.addEventListener("DOMContentLoaded", function() {
    const yesRadio = document.getElementById("yes");
    const noRadio = document.getElementById("no");
    const footerTitleBox = document.getElementById("footerTitleBox");
    const footerTitleInput = document.getElementById("footer_title");

    function toggleFooterInput() {
        if (yesRadio.checked) {
            footerTitleBox.style.display = "block";
            footerTitleInput.required = true;
        } else {
            footerTitleBox.style.display = "none";
            footerTitleInput.required = false;
            footerTitleInput.value = ""; // clear value if hidden
        }
    }

    yesRadio.addEventListener("change", toggleFooterInput);
    noRadio.addEventListener("change", toggleFooterInput);

    // Run once on page load (important for edit mode)
    toggleFooterInput();
});
</script>


@endpush

@php
    $title = 'Blog - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')

@section('pageContent')

{{-- ============================= hero section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h1 class="mb-2 fw-bold">{{$category->name}}</h1>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0 justify-content-center" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com" itemprop="item">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com/blog" itemprop="item">
                                <span itemprop="name">Blog</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>

                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="#" class="breadcrumb-nlink" itemprop="item">
                                <span itemprop="name">{{$category->name}}</span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>
                    </ol>
                </nav>
               <p>{{$category->description}}</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================= blog list with sidebar section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row">
            @if(!empty($blogs) && count($blogs)>0)
            <div class="col-lg-8 pe-lg-5 mb-4 mb-lg-0" id="blogs-list">
                <h2 class="mb-3 fw-bold">Posts under {{ $category->name }}</h2>
                        
                @foreach ($blogs as $blog)
                
                    <div class="px-2">
                        <a href="{{ route('blog.single.page', $blog->slug) }}" class="row mb-3 mb-lg-4 p-2 p-lg-3 rounded-2 blog-list-post-card border">
                            <div class="col-sm-4 px-0 rounded-2">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset($blog->featured_image ?? 'front/images/shoots.jpg') }}" alt="{{ $blog->name }}" class="object-fit-cover rounded-2">
                                </div>
                            </div>
                            <div class="col-sm-8 ps-lg-4 py-2 py-lg-3 d-flex flex-column justify-content-between">
                                <div>
                                    <p class="mb-3 badge text-bg-dark w-fit-content">{{ $category->name }}</p>
                                    <h2 class="text-dark fw-bold fs-3 mb-3">{{ $blog->title }}</h2>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                    <p class="mb-0 text-dark">by {{GetUser($blog->created_by)->name}}</p>
                                    <p class="mb-0 d-flex align-items-center gap-2 text-accent">Read more <i class="ri-arrow-right-line"></i></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                    @if ($blogs->hasMorePages())
                        <div class="text-center">
                            <button id="load-more-btn" class="btn btn-outline-main"
                                    data-next-page="{{ $blogs->currentPage() + 1 }}">
                                <span class="d-flex align-items-center gap-2">
                                    Load More 
                                    <i class="ri-restart-line"></i>
                                </span>
                            </button>
                        </div>
                    @endif

            </div>
            <div class="col-lg-4">
                <div class="sticky-lg-top-90">
                    <div class="border border-main p-3 rounded-2 bg-main-light mb-3">
                        <h2 class="fs-5 fw-bold mb-3">Advertisement</h2>
                        <img src="{{ asset('front/assets/images/home-testimonial.jpg') }}" alt="Advertisement" class="w-100 img-fluid rounded-2">
                    </div>
                    <div class="border p-3 rounded-2">
                        <h2 class="fs-5 fw-bold mb-3">Post Categories</h2>
                       
                         <div class="d-flex flex-wrap gap-2">
                          @php
    $displayedCategories = []; // Array to track already displayed categories
@endphp

@foreach ($blogs as $blog)
    @php
        // Ensure category is an array
        $categories = is_string($blog->category) ? json_decode($blog->category, true) : (is_array($blog->category) ? $blog->category : []);
    @endphp

    @if (!empty($categories))
        @foreach ($categories as $cate)
            @if (!in_array($cate, $displayedCategories))  <!-- Check if category already displayed -->
                @php
                    $displayedCategories[] = $cate; // Add to displayed list
                    $category = getServiceNamebyId($cate); // Get category details
                @endphp
                   
                <a href="{{ route('blog.single.page',  $category->slug) }}" class="btn btn-main">
                    {{ $category->name }}
                </a>
            @endif
        @endforeach
    @endif
@endforeach

                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning" role="alert">
                No Posts Found!
                </div>
            @endif
        </div>
    </div>
</section>


@endsection
@section('scripts')
<script>
      $(document).ready(function () {
        $('#load-more-btn').on('click', function () {
            let button = $(this);
            let nextPage = button.data('next-page');
			 let originalHtml = '<span class="d-flex align-items-center gap-2">Load More <i class="ri-restart-line"></i></span>';

            $.ajax({
                url: '?page=' + nextPage,
                type: 'GET',
                beforeSend: function () {
                    button.prop('disabled', true).text('Loading...');
                },
                success: function (response) {
                    // Parse the returned HTML and get new items
                    let newItems = $(response).find('#blogs-list').html();
                    $('#blogs-list').append(newItems);

                    // Update next page
                    let newNextPage = nextPage + 1;
                    let hasMore = $(response).find('#load-more-btn').length > 0;

                    if (hasMore) {
                        button.data('next-page', newNextPage);
                        button.html(originalHtml);
                        button.prop('disabled', false);
                    } else {
                        button.remove(); // No more pages
                    }
                },
                error: function () {
                    button.text('Try Again').prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection
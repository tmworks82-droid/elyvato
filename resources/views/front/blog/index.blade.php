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
                <h1 class="mb-2 fw-bold">Your Go-To Hub for Content Creation Tips & Strategy Wins</h1>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-4 mb-md-5">
                    <ol class="breadcrumb mb-0 justify-content-center" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com" itemprop="item">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="#" class="breadcrumb-nlink" itemprop="item">
                                <span itemprop="name">Blog</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>
                <div class="row justify-content-center px-2">
					<form class="col-lg-8 bg-body border rounded-2 position-relative p-2">
                        <div class="input-group dropdown home-hero-search-dropdown">
                            <input id="blogSearchInput" class="form-control focus-shadow-none border-0 me-1" type="text" placeholder="Search Blog" autocomplete="off">
                            <button class="btn rounded-2 mb-0 hero-search-btn" type="button">
                                <i class="ri-search-2-line me-1"></i> Search
                            </button>
                            <ul id="searchResults" class="dropdown-menu mt-5" style="width: auto;"></ul>
                        </div>
                    </form>

				</div>
            </div>
        </div>
    </div>
</section>

{{-- ============================= blog category section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <h2 class="mb-3 fs-4 fw-bold">Blog Categories</h2>
        <div class="row blog-archive-category-card-container">
           
           
            @php
    $displayedCategories = [];  // Initialize an empty array to store displayed categories
@endphp

@foreach ($blogs as $blog)
    @php
        // Decode only if it's a string, fallback to empty array if failed
        $categories = is_string($blog->category) ? json_decode($blog->category, true) : (is_array($blog->category) ? $blog->category : []);
    @endphp

    @if (!empty($categories))
        @foreach ($categories as $cate)
            @if (!in_array($cate, $displayedCategories))  <!-- Check if the category has already been displayed -->
                @php
                    $displayedCategories[] = $cate;  // Add the category to the displayed list
                @endphp

                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="blog-archive-category-card overflow-hidden rounded-2">
                        <a href="{{ route('blog.single.page', getServiceNamebyId($cate)->slug) }}" class="ratio ratio-4x3 position-relative">
                            <img src="{{ asset(getServiceNamebyId($cate)->service_icon) }}" alt="{{ getServiceNamebyId($cate)->name }}" class="object-fit-cover img-fluid rounded-2">
                            <div class="position-absolute blog-archive-category-card-tag">
                                <p class="mb-0 badge text-bg-dark text-wrap" style="max-width:146px;">{{ getServiceNamebyId($cate)->name }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endforeach




        </div>
    </div>
</section>

{{-- ============================= blog list with sidebar section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row" id="blogs-list">
            <div     class="col-lg-8 pe-lg-5 mb-4 mb-lg-0">
                <h2 class="mb-3 fw-bold">Our Blog</h2>
                @if(!empty($blogs) && count($blogs) > 0)
                @foreach($blogs as $blog)
                    <div class="px-2">
                        <a href="{{ route('blog.single.page', $blog->slug) }}" class="row mb-3 mb-lg-4 p-2 p-lg-3 rounded-2 blog-list-post-card border">
                            <div class="col-sm-4 px-0 rounded-2">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset($blog->featured_image ?? 'front/images/shoots.jpg') }}" alt="{{ $blog->title }}" class="object-fit-cover rounded-2">
                                </div>
                            </div>
                            <div class="col-sm-8 ps-lg-4 py-2 py-lg-3 d-flex flex-column justify-content-between">
                                <div class="d-flex gap-2 align-items-center flex-wrap mb-3">
                                    @php
                                        $categories = is_string($blog->category) ? json_decode($blog->category, true) : (is_array($blog->category) ? $blog->category : []);
                                    @endphp
                                    @foreach($categories as $cate)
                                        <p class="mb-0 badge text-bg-dark w-fit-content">{{ getServiceNamebyId($cate)->name }}</p>
                                    @endforeach
                                    
                                </div>
                                <h2 class="text-dark fw-bold fs-3 mb-3">{{ $blog->title }}</h2>
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


                @endif
            </div>
            <div class="col-lg-4">
                <div class="sticky-lg-top-90">
                    <div class="border border-main p-3 rounded-2 bg-main-light mb-3">
                        <!-- <h2 class="fs-5 fw-bold mb-3">Advertisement</h2> -->
                        <img src="{{ asset('front/assets/images/home-testimonial.jpg') }}" alt="Advertisement" class="w-100 img-fluid rounded-2">
                    </div>
                    <div class="border p-3 rounded-2">
                        <h2 class="fs-5 fw-bold mb-3">Post Categories</h2>
                        
                         <div class="d-flex flex-wrap gap-2">

                      @php
                            $displayedCategories = [];  // Initialize an empty array to store displayed categories
                        @endphp
                        
                        @foreach ($blogs as $blog)
                            @php
                                $categories = is_string($blog->category) ? json_decode($blog->category, true) : (is_array($blog->category) ? $blog->category : []);
                            @endphp
                        
                            @if (!empty($categories))
                                @foreach ($categories as $cate)
                                    @if (!in_array($cate, $displayedCategories))  <!-- Check if the category has already been displayed -->
                                        @php
                                            $displayedCategories[] = $cate;  // Add the category to the displayed list
                                        @endphp
                        
                                        <a href="{{ route('blog.single.page', getServiceNamebyId($cate)->slug) }}" class="btn btn-main">
                                            {{ getServiceNamebyId($cate)->name }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


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
                    // $('#blogs-list').append(newItems);
                    $('#blogs-list').html(newItems);
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


    // here blog serach  

    $(document).ready(function () {
    $('#blogSearchInput').on('keyup', function () {
        let query = $(this).val();

        if (query.length >= 2) {
            $.ajax({
                url: "{{ route('blog.search') }}",
                type: "GET",
                data: { q: query },
                success: function (res) {
                    let dropdown = $('#searchResults');
                    dropdown.empty();

                    if (res.length > 0) {
                        dropdown.addClass('show');
                        res.forEach(function (blog) {
                            dropdown.append(
                                `<li class="px-2"><a class="dropdown-item rounded mb-2 text-wrap" href="/blog/${blog.slug}">${blog.title}</a></li>`
                            );
                        });
                    } else {
                        dropdown.addClass('show').append(`<li class="px-2"><span class="dropdown-item text-muted">No results found</span></li>`);
                    }
                }
            });
        } else {
            $('#searchResults').removeClass('show').empty();
        }
    });

    // Optional: Hide dropdown on outside click
    $(document).click(function (e) {
        if (!$(e.target).closest('#blogSearchInput').length) {
            $('#searchResults').removeClass('show').empty();
        }
    });
});

</script>
@endsection
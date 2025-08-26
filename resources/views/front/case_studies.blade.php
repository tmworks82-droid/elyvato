@php
    $title = 'Case Studies - Elyvato';
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
                <h1 class="mb-2 fw-bold fs-2">Connecting Brands to India’s Most Skilled Freelancers.
Need Company names</h1>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 justify-content-center" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com" itemprop="item">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="#" class="breadcrumb-nlink" itemprop="item">
                                <span itemprop="name">Case Studies</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- ============================= case study section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row" style="row-gap: 30px;" id="case-list">
            
            @foreach ($caseStudy as $case)
                <div class="col-md-6 col-lg-4">
                    <div class="overflow-hidden rounded-2">
                        <div class="ratio ratio-4x3 mb-3">
                            <img src="{{ asset($case->featured_image )}}" alt="{{ $case->name }}" class="object-fit-cover w-100 rounded-4">
                        </div>
                        <div class="px-2">
                            <p class="mb-2 fw-semibold text-accent">{{ $case->project_type }}</p>
                            <h2 class="fs-5 fw-bold">{{ $case->title }}</h2>
                        </div>
                    </div>
                </div>
            @endforeach

                @if ($caseStudy->hasMorePages())
                    <div class="text-center">
                        <button id="load-more-btn" class="btn btn-outline-main"
                                data-next-page="{{ $caseStudy->currentPage() + 1 }}">
                            <span class="d-flex align-items-center gap-2">
                                Load More 
                                <i class="ri-restart-line"></i>
                            </span>
                        </button>
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
                    let newItems = $(response).find('#case-list').html();
                    // $('#case-list').append(newItems);
                     $('#case-list').html(newItems);

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
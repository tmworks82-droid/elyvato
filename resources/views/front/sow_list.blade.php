@php
    $title = $title . ' - Elyvato';
    $metaDescription =
        $service_data->meta_description ??
        'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = asset($service_data->service_icon) ?? '/images/tmw-team.JPG';
@endphp

@extends('layouts.front.app')

@section('pageContent')

    {{-- ============================= breadcrumb section ============================= --}}

    <section class="pt-4">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="https://elyvato.com" itemprop="item">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="https://elyvato.com/{{ $serviceSlug }}" itemprop="item">
                            <span itemprop="name">{{ $servicename }}</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li>
                    @if (!empty($subServiceSlug))
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="https://schema.org/ListItem">
                            <a href="https://elyvato.com/{{ $serviceSlug }}/{{ $subServiceSlug }}" class="breadcrumb-nlink"
                                itemprop="item">
                                <span itemprop="name">{{ $sub_servicename }}</span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>
                    @endif

                </ol>
            </nav>
        </div>
    </section>

    {{-- ============================= service cards with tabs section ============================= --}}
    <section class="pt-4 section-padding-bottom">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-3 mb-md-4">
                <div class="col">
                    <h1 class="fw-bold mb-2">{{ $name }}</h1>

                </div>
            </div>

            {{-- filter system --}}
            <div class="d-flex align-items-center flex-wrap gap-2 gap-lg-3 mb-4 mb-md-5">
                <div class="dropdown">
                    <button class="btn btn-filter border dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" data-bs-auto-close="outside">
                        Delivery Time
                    </button>
                    <div class="dropdown-menu p-3 border shadow-sm service-filter-menu">
                        <div class="form-check mb-1">
                            <input class="form-check-input focus-shadow-none" type="radio" name="delivery_time"
                                id="radioDefault1" value="2" {{ request('delivery_time') == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radioDefault1">Up to 2 days</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input focus-shadow-none" type="radio" name="delivery_time"
                                id="radioDefault2" value="3" {{ request('delivery_time') == '3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radioDefault2">Up to 3 days</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input focus-shadow-none" type="radio" name="delivery_time"
                                id="radioDefault3" value="5" {{ request('delivery_time') == '5' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radioDefault3">Up to 5 days</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input focus-shadow-none" type="radio" name="delivery_time"
                                id="radioDefault4" value="6" {{ request('delivery_time') == '6' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radioDefault4">Up to 6 days</label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input focus-shadow-none" type="radio" name="delivery_time"
                                id="radioDefault5" value="7" {{ request('delivery_time') == '7' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radioDefault5">Up to 7 days</label>
                        </div>
                        <button type="button" class="btn btn-main mt-3" id="applyDeliveryTime">Apply Filter</button>
                    </div>

                </div>
                <div class="dropdown">
                    <button class="btn btn-filter border dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" data-bs-auto-close="outside">
                        Budget
                    </button>
                    <div class="dropdown-menu p-3 border shadow-sm service-filter-menu">
                        <div class="range-slider">
                            <div class="slider-track" id="sliderTrack"></div>
                            {{-- <input type="range" id="minRange" min="2000" max="100000" value="2000" step="500">
                        <input type="range" id="maxRange" min="2000" max="100000" value="100000" step="500"> --}}

                            <input type="range" id="minRange" min="1000" max="100000" step="500"
                                value="{{ request('budget_min', 1000) }}">

                            <input type="range" id="maxRange" min="2000" max="100000" step="500"
                                value="{{ request('budget_max', 100000) }}">
                        </div>
                        <div class="range-values">
                            {{-- <span id="minVal">2000</span>
                        <span id="maxVal">100000</span> --}}

                            <span id="minVal">{{ request('budget_min', 2000) }}</span>
                            <span id="maxVal">{{ request('budget_max', 100000) }}</span>

                        </div>

                        <button class="btn btn-main mt-3" id="applyBudgetSlider">Apply Filter</button>
                    </div>
                </div>
                <a href="#" id="resetFilter" class="btn btn-main d-flex align-items-center">
                    Reset Filter <i class="ri-reset-left-line ms-1"></i>
                </a>

            </div>
            {{-- gigs list --}}
            <div class="row service-cards" id="sow-list">

                @if (!empty($sowList) && count($sowList) > 0)
                    @foreach ($sowList as $sow)
                        <div class="col-md-6 col-lg-4">
                            <div class="h-100 bg-white border border-bg-tertiary rounded service-card d-flex flex-column">

                                @php
                                    $fileShown = false;
                                @endphp

                                @foreach ($sow->allFiles as $files)
                                    @if (!$fileShown && $files->file_type == 'image')
                                        <div class="service-card-image-box rounded-top">
                                            <img src="{{ asset($files->image_path) }}" alt="{{ $sow->name }}"
                                                class="img-fluid service-card-image">
                                        </div>
                                        @php $fileShown = true; @endphp
                                    @elseif (!$fileShown && $files->file_type == 'video')
                                        @php
                                            $VideoId = null;

                                            if ($files->file_type === 'video') {
                                                preg_match('/embed\/([^"?&]+)/', $files->video, $matches);
                                                $VideoId = $matches[1] ?? null;
                                            }
                                        @endphp
                                        <div class="service-card-image-box rounded-top">
                                            <!-- <img src="{{ asset('front/assets/images/graphic-design.jpg') }}" alt="{{ $sow->name }}" class="img-fluid service-card-image"> -->
                                            <img src="https://img.youtube.com/vi/{{ $VideoId }}/hqdefault.jpg"
                                                alt="YouTube Thumbnail" class="img-fluid service-card-image">
                                        </div>
                                        @php $fileShown = true; @endphp
                                    @endif
                                @endforeach


                                {{-- <div class="service-card-image-box rounded-top">
                            <img src="{{ asset('front/assets/images/graphic-design.jpg') }}" alt="{{ $sow->name }}" class="img-fluid service-card-image">
                </div> --}}

                                <div class="service-card-content p-4 d-flex flex-column flex-grow-1">
                                    <div class="mb-4">

                                        <h3 class="fw-bold fs-4 mb-3">

                                            @if (isset($subServiceSlug))
                                                @php
                                                    $sowId = App\Models\StatementOfWork::where(
                                                        'slug',
                                                        $sow->slug,
                                                    )->first();
                                                    $subService = App\Models\SubService::where(
                                                        'id',
                                                        $sowId->subservice_id,
                                                    )->first();
                                                    $subServiceSlug = $subService->slug;
                                                @endphp

                                                <a
                                                    href="{{ route('sow.details.sub', [$serviceSlug, $subServiceSlug, $sow->slug]) }}">
                                                    {{ $sow->title }}
                                                </a>
                                            @else
                                                @php
                                                    $sowId = App\Models\StatementOfWork::where(
                                                        'slug',
                                                        $sow->slug,
                                                    )->first();
                                                    $subService = App\Models\SubService::where(
                                                        'id',
                                                        $sowId->subservice_id,
                                                    )->first();
                                                    $subServiceSlug = $subService->slug;
                                                @endphp

                                                <a
                                                    href="{{ route('sow.details.sub', [$serviceSlug, $subServiceSlug, $sow->slug]) }}">
                                                    {{ $sow->title }}
                                                </a>
                                            @endif

                                        </h3>
                                        <p class="mb-0">
                                            {{ \Illuminate\Support\Str::words(strip_tags(html_entity_decode($sow->description)), 25, '...') }}
                                        </p>
                                    </div>
                                    <div class="mt-auto border-top pt-3">

                                        @if (auth()->check())
                                            <a href="{{ route('post.custom.requirement', $sow->slug) }}"
                                                class="service-card-link d-inline-flex align-items-center text-sm link-text">
                                                Post Custom Requirement
                                                <i class="ri-login-box-line"></i>
                                            </a>
                                        @else
                                            <a href="{{ url('login') }}"
                                                class="service-card-link d-inline-flex align-items-center text-sm link-text">
                                                Login for Custom Requirement
                                                <i class="ri-login-box-line"></i>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning" role="alert">
                        No Gig List Found !
                    </div>
                @endif

                @if ($sowList->hasMorePages())
                    <div class="text-center mt-4">
                        <button id="load-more-btn" class="btn btn-outline-main"
                            data-next-page="{{ $sowList->currentPage() + 1 }}">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const minRange = document.getElementById('minRange');
        const maxRange = document.getElementById('maxRange');
        const sliderTrack = document.getElementById('sliderTrack');
        const minVal = document.getElementById('minVal');
        const maxVal = document.getElementById('maxVal');
        const applyBtn = document.getElementById('applyBudgetSlider');
        const max = parseInt(minRange.max);

        // Update slider color and values
        function updateSlider() {
            let min = parseInt(minRange.value);
            let maxV = parseInt(maxRange.value);

            // Prevent visual overlap
            if (min > maxV) {
                [min, maxV] = [maxV, min];
            }

            const percent1 = (min / max) * 100;
            const percent2 = (maxV / max) * 100;

            sliderTrack.style.background =
                `linear-gradient(to right, #dee2e6 ${percent1}%, #f97a00 ${percent1}%, #f97a00 ${percent2}%, #dee2e6 ${percent2}%)`;

            minVal.textContent = min;
            maxVal.textContent = maxV;
        }

        // Listen to input changes
        minRange.addEventListener('input', updateSlider);
        maxRange.addEventListener('input', updateSlider);

        // Initial update on page load
        window.addEventListener('load', updateSlider);

        // On click of Apply Filter button
        applyBtn.addEventListener('click', function() {
            const min = minRange.value;
            const max = maxRange.value;

            const url = new URL(window.location.href);
            url.searchParams.set('budget_min', min);
            url.searchParams.set('budget_max', max);

            window.location.href = url.toString();
        });



        //   deliver time filter 

        document.getElementById('applyDeliveryTime').addEventListener('click', function() {
            const selected = document.querySelector('input[name="delivery_time"]:checked');
            if (selected) {
                const url = new URL(window.location.href);
                url.searchParams.set('delivery_time', selected.value);
                window.location.href = url.toString();
            }
        });

        //   rest filter 

        document.getElementById('resetFilter').addEventListener('click', function(e) {
            e.preventDefault();

            const url = new URL(window.location.href);

            // List all filter params you want to reset
            url.searchParams.delete('budget_min');
            url.searchParams.delete('budget_max');
            url.searchParams.delete('delivery_time');

            window.location.href = url.toString();
        });

        $(document).ready(function() {
            $('#load-more-btn').on('click', function() {
                let button = $(this);
                let nextPage = button.data('next-page');
                let originalHtml =
                    '<span class="d-flex align-items-center gap-2">Load More <i class="ri-restart-line"></i></span>';

                button.html(
                    '<span class="d-flex align-items-center gap-2">Loading... <i class="ri-loader-4-line ri-spin"></i></span>'
                    );
                button.prop('disabled', true);

                $.ajax({
                    url: '?page=' + nextPage,
                    type: 'GET',
                    success: function(response) {
                        let newItems = $(response).find('#sow-list').html();
                        // $('#sow-list').append(newItems);
                        $('#sow-list').html(newItems);

                        let newNextPage = nextPage + 1;
                        let hasMore = $(response).find('#load-more-btn').length > 0;

                        if (hasMore) {
                            button.data('next-page', newNextPage);
                            button.html(originalHtml);
                            button.prop('disabled', false);
                        } else {
                            button.remove(); // Remove button if no more pages
                        }
                    },
                    error: function() {
                        button.html(
                            '<span class="d-flex align-items-center gap-2">Try Again <i class="ri-restart-line"></i></span>'
                            );
                        button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection

@php
    $title = 'Services - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
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
                    <a href="#" class="breadcrumb-nlink" itemprop="item">
                        <span itemprop="name">Services</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ============================= service cards with tabs section ============================= --}}
<section class="pt-4 section-padding-bottom">
	<div class="container">
		<div class="row justify-content-between align-items-center mb-3">
			<div class="col">
				<h1 class="fw-bold mb-2">Services for Your Content Needs</h1>
				<p class="mb-0">Most viewed all-time top-selling services offered by Elyvato.</p>
			</div>
		</div>
        <div class="d-flex align-items-center flex-wrap gap-2 gap-lg-3 mb-4 mb-md-5">
			
			@foreach (Service() as $category)
				<a href="{{ route('service-sow-list', ['slug' => $category->slug]) }}" class="btn btn-filter border">{{ $category->name }}</a>
			@endforeach
		</div>
		<div class="row service-cards">
			
         @if(!empty($services) && count($services)>0)
			@foreach ($services as $ser)
			<div class="col-md-6 col-lg-4 col-xl-3">
				<div class="h-100 bg-white border border-bg-tertiary rounded service-card d-flex flex-column">
					<div class="service-card-image-box rounded-top">
						<img src="{{asset($ser->service_icon)}}" alt="{{ $ser->name }}" class="img-fluid service-card-image">
					</div>
					<div class="service-card-content p-4 d-flex flex-column flex-grow-1">
						<div class="mb-4">
							<h3 class="fw-bold mb-3">
								<a href="{{ route('service-sow-list', $ser->slug) }}">
									@php
                                        $name = $ser->name; 
                                        $splitIndex = strpos($name, ' ');  

                                        if ($splitIndex !== false) {
                                            $firstPart = substr($name, 0, $splitIndex);  // Everything before the first space
                                            $secondPart = substr($name, $splitIndex + 1);  // Everything after the first space
                                        } else {
                                            $firstPart = $name;  // If no space found, show the whole name in the first part
                                            $secondPart = '';
                                        }
                                    @endphp

                                    {{ $firstPart }}<br>
                                    {{ $secondPart }}
								</a>
							</h3>
							<p class="mb-0">{{ $ser->description }}</p>
						</div>
						
						<div class="mt-auto">
							<a href="{{ route('service-sow-list', $ser->slug) }}" class="service-card-link d-inline-flex align-items-center">View Services <i class="ri-arrow-right-line"></i></a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
            @else
            <div class="alert alert-warning" role="alert">
                  No Service Found !
                </div>
            @endif

			@if ($services->hasMorePages())
				<div class="text-center">
					<button id="load-more-btn" class="btn btn-outline-main"
							data-next-page="{{ $services->currentPage() + 1 }}">
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
                    let newItems = $(response).find('#service-list').html();
                    // $('#service-list').append(newItems);
					 $('#service-list').html(newItems);

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
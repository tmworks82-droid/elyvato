@php
    $title = 'Hire Top Freelancers in Minutes - Elyvato';
    $metaDescription = 'Explore Elyvato - Seamlessly connect with vetted creatives - from editors to writers - exactly when you need them.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com/instant/hire';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')

@section('pageContent')

 <style>

        /* --- Modal Styles --- */

        /* Adjust modal width to better fit the image */
        .modal-dialog {
            max-width: 405px; /* Adjusted for a better fit for the square image */
        }
        
        /* Ensure the modal body has no padding to let the image fit snugly */
        .modal-body {
            padding: 0;
        }
        
        /* Make the modal content background white */
        .modal-content {
            background-color: #fff;
            border-radius: 0.5rem;
        }

    </style>
    
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
                        <span itemprop="name">Instant Hire</span>
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
				<h1 class="fw-bold mb-2">Hire Top Freelancers in Minutes</h1>
				<p class="mb-0">Access top-tier editors, designers, and writers without the wait.</p>
			</div>
		</div>
        <div class="d-flex align-items-center flex-wrap gap-2 gap-lg-3 mb-4 mb-md-5">
		
			@foreach ($instanthire as $hire)
            @if($hire->is_available==1)
				<a href="{{route('instant.hire.booking',$hire->slug)}}" class="btn btn-filter border">{{ strtoupper($hire->name) }}</a>
                @else
				<a href="#" class="btn btn-filter border" data-bs-toggle="modal" data-bs-target="#comingSoonModal">{{ strtoupper($hire->name) }}</a>

                @endif
			@endforeach
		</div>
		<div class="row service-cards">
			

			@foreach ($instanthire as $hire)
			<div class="col-md-6 col-lg-4 col-xl-3">
				<div class="h-100 bg-white border border-bg-tertiary rounded service-card d-flex flex-column">
					<div class="service-card-image-box rounded-top">
						<img src="{{ url($hire->image) }}" alt="{{ $hire->name }}" class="img-fluid service-card-image">
					</div>
					<div class="service-card-content p-4 d-flex flex-column flex-grow-1">
						<div class="mb-4">
							<h3 class="fw-bold mb-3">
                                @if($hire->is_available==1)
								<a href="{{route('instant.hire.booking',$hire->slug)}}" style="word-wrap:break-word">
								
									
										@php
                                        $name = $hire->name; 
                                        $splitIndex = strpos($name, ' ');  

                                        if ($splitIndex !== false) {
                                            $firstPart = substr($name, 0, $splitIndex);  // Everything before the first space
                                            $secondPart = substr($name, $splitIndex + 1);  // Everything after the first space
                                        } else {
                                            $firstPart = $name;  // If no space found, show the whole name in the first part
                                            $secondPart = '';
                                        }
                                    @endphp

                                    {{ strtoupper($firstPart) }}<br>
                                    {{ strtoupper($secondPart) }}
								</a>
                                @else

                                <a href="#" style="word-wrap:break-word" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
								
									
										@php
                                        $name = $hire->name; 
                                        $splitIndex = strpos($name, ' ');  

                                        if ($splitIndex !== false) {
                                            $firstPart = substr($name, 0, $splitIndex);  // Everything before the first space
                                            $secondPart = substr($name, $splitIndex + 1);  // Everything after the first space
                                        } else {
                                            $firstPart = $name;  // If no space found, show the whole name in the first part
                                            $secondPart = '';
                                        }
                                    @endphp

                                    {{ strtoupper($firstPart) }}<br>
                                    {{ strtoupper($secondPart) }}
								</a>

                                @endif
							</h3>
							<p class="mb-0">{{ $hire->content}}</p>
						</div>
						<div class="mt-auto">
							<a href="#" class="service-card-link d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Explore More <i class="ri-arrow-right-line"></i></a>
						</div>
					</div>
				</div>
			</div>
			@endforeach

            

		</div>
	</div>
</section>

<div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
         
          <div class="modal-body">
              <button type="button" class="btn-close" style="float:right;" data-bs-dismiss="modal" aria-label="Close"></button>
            <!-- Use an <img> tag for reliability. img-fluid makes it responsive. -->
            <img src="{{url('front/assets/images/instant/commingsoon.png')}}" class="img-fluid" style="border-radius: 8px;" alt="Coming Soon">
          </div>
        </div>
      </div>
    </div>

@endsection
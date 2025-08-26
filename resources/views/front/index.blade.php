@php
    $title = 'Elyvato - Your Scalable Content Marketing Partner';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = 'front/images/tmw-team.JPG';
@endphp



@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection


@extends('layouts.front.app')

@section('pageContent')
    <style>
		.owl-dots .owl-dot:nth-child(n+4) {
  display: none !important;
}

	</style>
	

	<style>
		/* here calender css  */

		.calendar {
			width: 90%;
			color: black;
			max-width: 800px;
			background: white;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			padding: 20px;
			border-radius: 10px;
		}

		.calendar-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.calendar-weekdays,
		.calendar-days {
			display: grid;
			grid-template-columns: repeat(7, 1fr);
			margin-top: 10px;
		}

		.calendar-weekdays div {
			font-weight: bold;
			text-align: center;
			padding: 5px;
			background: #eee;
			border: 1px solid #ddd;
		}

		.calendar-days div {
			height: 80px;
			padding: 5px;
			border: 1px solid #eee;
			position: relative;
		}

		.calendar-days .event {
			background: #e1f5fe;
			padding: 3px;
			font-size: 10px;
			margin-top: 3px;
			border-left: 3px solid #039be5;
		}


		.calendar-days .today {
			background-color: #f6c89eff;
			border: 2px solid #f97a00;
			border-radius: 6px;
		}

		.calendar-days .disabled {
			color: #aaa;
			background-color: #f8f9fa;
			pointer-events: none;
			opacity: 0.6;
		}

		.calendar-days .selected {
			background-color: #8c32f6;
			color: white;
			border-radius: 6px;
			border: 2px solid #f97a00;
		}
	</style>
	
<img src="{{ asset('front/assets/images/pattern-a.svg') }}" alt="hero pattern" class="header-pattern-left position-absolute">

{{-- ============================= breadcrumb section ============================= --}}
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="d-none">
  <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="https://elyvato.com" itemprop="item">
            <span itemprop="name">Home</span>
        </a>
        <meta itemprop="position" content="1" />
    </li>
  </ol>
</nav>

{{--------banner ---}}

{{--<div class="container rounded-1 ">
    <img src="https://elyvato.com/front/assets/images/home-freelancer.jpg" class="img-fluid w-100 mt-3
    " alt="elyvato banner" style="height: 500px; border-radius:5px;">
</div>--}}

{{-- ============================= hero section ============================= --}}
<section class="section-padding-top section-padding-bottom home-hero">
	<div class="container py-md-3 py-lg-5">
		<div class="row align-items-center">
			<div class="col-lg-7 pe-lg-5">
				<h1 class="fw-bold mb-3 mb-md-4">Freelance Marketplace for Smart Hiring</h1>
				<p class="mb-3 mb-md-5"> Where businesses connect with India's elite & AI-trained freelance talent - creative, dependable, and globally aligned. Unlike others, we take full ownership of quality. Behind every project is a system that ensures consistency, timeliness, and results you can truly count on.</p>
				<div class="mb-4 mb-md-5">
				    
				   
					<form class="col-md-10 bg-body border rounded-2 position-relative p-2" method="GET" action="{{ url('services') }}">
						<div class="input-group dropdown home-hero-search-dropdown">
							<input class="form-control focus-shadow-none border-0 me-1" id="SearchInputs" name="search" type="text" placeholder="What are you looking for?" data-bs-toggle="dropdown" aria-expanded="false" autocomplete="off">
							<button class="btn rounded-2 mb-0 btn-main"><i class="ri-search-2-line me-1"></i> Search</button>
							<ul class="dropdown-menu mt-2" id="serviceResult">
								@foreach(Service() as $service)
								 <li class="px-2"><a class="dropdown-item rounded mb-2" href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{$service->name}}</a></li>
								@endforeach
							</ul> 
						</div>
					</form>
				</div>
				<div class="row home-hero-stats">
					<div class="col-sm-6 d-flex align-items-center mb-3 mb-sm-0">
						<i class="ri-focus-2-line fs-2 me-3 text-main"></i>
						<div>
							<h3 class="fs-5 fw-semibold">Proven Success</h3>
							<p class="mb-0">100% delivery rate across 1,000+ projects and 100,000+ content pieces.</p>
						</div>
					</div>
					<div class="col-sm-6 d-flex align-items-center">
						<i class="ri-user-2-line fs-2 me-3 text-main"></i>
						<div>
							<h3 class="fs-5 fw-semibold">Elite Talent, On Demand</h3>
							<p class="mb-0">Work with the top 1% of creatives vetted, reliable, and ready when you are.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 position-relative mt-3 mt-lg-0">
				<img src="{{ asset('front/assets/images/home-hero.png') }}" alt="elevated content delivered expertly" class="w-100 img-fluid">
				<div class="floating-vertical d-none d-lg-inline-block bg-accent rounded-4 position-absolute start-0 mb-md-4 ms-md-n5 p-3" style="bottom: -40px;">
					<div class="d-flex align-items-center">
						<h6 class="text-white fw-bold fs-5 mb-0 me-2">100%</h6>
						<ul class="mb-0 ps-0 list-unstyled d-flex align-items-center">
							
							<li class="home-hero-csr-image-box">
								<img class="rounded-circle" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="30" height="30">
							</li>

							<li class="home-hero-csr-image-box">
								<img class="rounded-circle" src="{{ asset('front/assets/images/avatar/user-2.jpg') }}" alt="avatar" width="30" height="30">
							</li>

							<li class="home-hero-csr-image-box">
								<img class="rounded-circle" src="{{ asset('front/assets/images/avatar/user-3.jpg') }}" alt="avatar" width="30" height="30">
							</li>

							<li class="home-hero-csr-image-box">
								<img class="rounded-circle" src="{{ asset('front/assets/images/avatar/user-4.jpg') }}" alt="avatar" width="30" height="30">
							</li>

							<li class="home-hero-csr-image-box m-0">
								<img class="rounded-circle" src="{{ asset('front/assets/images/avatar/user-5.jpg') }}" alt="avatar" width="30" height="30">
							</li>

						</ul>
					</div>
					<p class="text-white mb-0 mt-2">Client Satisfaction Rate</p>
				</div>
				<div class="floating-horizontal home-hero-pw-card d-none d-lg-inline-block bg-dark rounded-4 position-absolute mb-md-4 ms-md-n5 p-3">
					<div class="d-flex align-items-center">
						<div class="me-2 home-hero-pq-card-icon-box d-flex align-items-center justify-content-center">
							<i class="ri-shake-hands-line fs-2 text-white"></i>
						</div>
						<div>
							<h6 class="text-white fw-bold fs-5 mb-0 me-2">Proof of quality</h6>
							<p class="text-white mb-0 mt-2">Only the best make the cut</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- ============================= client slider section ============================= --}}
<section class="section-padding-top section-padding-bottom">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-md-5 col-lg-3 mb-3 mb-md-0">
				<h2 class="fs-4 fw-bold">Chosen by 100+ Businesses</h2>
			</div>
			<div class="col-12 col-md-7 col-lg-9">
				{{-- @php
					$clients = [
						'appyhigh',
						'bhutani',
						'bigo',
						'byte',
						'corteva',
						'dow',
						'dupot',
						'js',
						'like',
						'moj',
						'mxplayer',
						'organic',
						'ripik-logo',
						'rizzle',
						'share',
						'terriv',
						'ticktok',
						'tiki',
						'trelll',
						'ucbrowser',
						'ucnews',
						'watchit',
						'zili'
					]
				@endphp  --}}


						<!-- these logo is missing : 'Payoneer',  -->
         
				@php 
				$clients = [
					    'dow',
					    'DuPont',
					    'Syngenta',
					    'Flipkart',
						'NDTV',
						'HT-Digital-Streams',
					    'mxplayer',
						'share',
						'bigo',
						
						
						'DailyHunt'.
						'Josh',
						
						'ShareIt',
						'Advanta',
						'corteva',
						'Times-Internet'

					]

				@endphp
				<div class="client-slider owl-carousel">
					@foreach ($clients as $k=>$client)
						<div class="item">
							<img src="{{ asset('front/assets/images/client/' . $client . '.png')}}" alt="{{ $client }}" @if($k==0 || $k==7) style="filter:grayscale(100%) brightness(0.2);" @endif @if($k==6) style="filter:grayscale(100%) brightness(0.9);" @endif  @if($k==8) style="filter:grayscale(100%) brightness(0.4);" @endif @if($k==4) style="filter:grayscale(5%) brightness(10.0);" @endif class="{{$k}}  kimg-fluid client-slider-image w-100">
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

{{-- ============================= stats and information with process section ============================= --}}
<section class="section-padding-top section-padding-bottom">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 pe-lg-5 mb-3 mb-lg-0">
				<div class="row">
					<div class="col-md-6 mb-3 mb-md-0 d-none d-md-block">
						<img src="{{ asset('front/assets/images/freelancer-process.png') }}" alt="freelancer process" class="img-fluid rounded">
						<figure class="text-end me-3 mt-n3">
							<svg class="fill-accent" width="106px" height="96px" viewBox="0 0 106 96" style="enable-background:new 0 0 106 96;" xml:space="preserve">
								<path d="M104.7,50.4c0,0.1-0.1,0.4-0.3,0.7c0.1,0.1,0.2,0.1,0.4,0.2c0.1,0.3,0.5,0.6,0.3,1c-0.2,0.4,0.4,0.7-0.1,1 c0.1,0.7-0.4,1.3-0.8,1.8c-0.3,0.5-0.4,1.1-0.9,1.5c-0.4,0.4-0.6,0.9-1,1.4c-0.3,0-0.5,0-0.9,0c0.1,0.2,0.1,0.4,0.2,0.6 c-0.1,0.1-0.2,0.3-0.4,0.5c0.1,0.3,0.2,0.6,0.3,1c-0.2,0.2-0.3,0.4-0.5,0.6c0.1,0,0.3,0.1,0.5,0.2c-0.3,0.2-0.5,0.3-0.7,0.5 c0,0.1,0.1,0.1,0.2,0.2c-0.7,0.3-1.4-0.4-2.2-0.1c-0.5,0.4-0.9,1.1-1.6,1.4c-0.3,0.1,0,0.6-0.5,0.6c-0.2,0,0,0.6-0.5,0.4 c-0.2,0.5-0.6,0.7-1,1.1c-0.3,0.3-0.6,0.6-0.8,1c-0.2,0.3-0.4,0.6-0.6,0.9c-0.2,0.3-0.4,0.5-0.6,0.8c-0.1,0.2-0.1,0.6-0.3,0.8 c-0.2,0.1-0.4,0.3-0.5,0.6c-0.2-0.1-0.4-0.2-0.5-0.3c-0.5,0.2-0.9,0.4-1.4-0.1v-1.2c-0.9-0.5-1.8-0.9-2.2-2.1c0-0.4-0.1-0.9,0.2-1.3 c-0.5-1-0.1-1.9,0.4-2.8c0.6-1.1,1.4-1.9,2.3-2.8c-0.5-0.8-1.1-1.6-1.6-2.4c-0.3-0.6-0.7-1.2-0.7-1.8c0-0.7-0.2-1.4,0.2-2.1 c0.2-0.3,0-0.8,0.2-1.2c0.1-0.2,0.2-0.5,0.4-0.7c0.1-0.1,0.1-0.3,0.2-0.7c0.2-0.2,0.7-0.4,0.7-0.7c0.1-0.5,0.8-0.3,0.8-0.9 c0.2,0.1,0.2,0.2,0.3,0.3c0.3-0.1,0.6-0.2,0.9-0.3c0.1,0.2,0.2,0.4,0.3,0.6c-0.2,0.4-0.5,0.9-0.8,1.4c0.6-0.1,1-0.1,1.4-0.1 c0.2,0.2,0.2,0.2,0.3,0.3c-0.2,0.3-0.3,0.6-0.5,1c0.4,0,0.6,0.1,1,0.1c-0.1,0.4-0.2,0.8-0.3,1.2c-0.1,0.1-0.3,0.3-0.5,0.4 c0.1,0.1,0.1,0.2,0.2,0.2c0.1-0.1,0.3-0.2,0.5-0.3c0.1,0.2,0.1,0.3,0.1,0.4c-0.3,0.2-0.6,0.3-1,0.5c0.2,0.1,0.3,0.1,0.5,0.2 c-0.3,0.3-0.5,0.5-0.8,0.8c0.4,0.3,0.7,0.6,1.1,0.9c0.6,0.1,1-0.1,1.4-0.5c1-0.9,2.1-1.6,3.1-2.5c1-0.9,2.1-1.8,2.8-3 c0.2-0.3,0.5-0.5,0.7-0.7h1.2c0.1,0.1,0.2,0.2,0.3,0.4c-0.1,0.4-0.3,0.8-0.4,1.2c0.4-0.1,0.7-0.2,1-0.3 C104.4,50,104.5,50.1,104.7,50.4"></path>
								<path d="M33,74.2c-0.4,0.1-0.7,0.2-1.1,0.3c0.1-0.2,0.2-0.3,0.2-0.5c-0.3-0.4-0.6-0.7-1.1-0.7c0-0.2-0.1-0.3-0.1-0.4H30 c-0.1-0.1-0.2-0.1-0.2-0.2c-0.1-0.4-0.2-0.9-0.4-1.3c-0.3-0.4-0.2-0.9-0.2-1.3c0-0.3,0.1-0.7,0.2-1c0.3-1.2,0.8-2.4,1.4-3.5 c0.4-0.7,0.8-1.3,1.2-2c0.4-0.6,1-1.2,1.4-1.8c-0.1-0.1-0.3-0.2-0.4-0.3c-1.5-0.9-2.8-2-4-3.2c-0.6-0.6-0.6-1.4-0.7-2.1 c-0.1-0.3,0-0.6,0-0.9c0.3-0.6,0.9-0.6,1.5-0.9c0.2,0.4,0.4,0.7,0.6,1.1c0,0,0.1-0.1,0.2-0.2c0.1,0.1,0.2,0.2,0.3,0.3 c0.2,0.7,0.8,1,1.4,1.3c1.2,0.6,2.4,1.2,3.7,1.8c0.3-0.3,0.6-0.8,1-1c0.4-0.2,0.4-0.9,1-0.8c-0.1-0.1-0.2-0.2-0.2-0.3 c0.2-0.1,0.4-0.3,0.7-0.5c0.1-0.2,0.2-0.5,0.3-0.8c0.2,0,0.4,0,0.6,0c-0.1-0.1-0.2-0.2-0.3-0.3c0.5-0.1,0.5-0.6,0.8-0.8 c0.3-0.3,0.5-0.7,0.8-1.1c0.1,0,0.1,0.1,0.3,0.2c0.1-0.1,0.1-0.3,0.2-0.4c0.1,0.1,0.2,0.1,0.3,0.2c0.1-0.8,0.6-1.4,1.1-2 c0.5-0.6,0.9-1.3,1.7-1.7c0.1,0.1,0.2,0.2,0.4,0.3c-0.3,0.6-0.6,1.2-1.3,1.5v0.9c0.2,0,0.3,0,0.3-0.1c0.1-0.2,0.2-0.5,0.3-0.6 c0.5-0.4,1-0.8,1.5-1.3c0,0.4,0.1,0.7,0.1,1c-0.2,0.1-0.3,0.1-0.4,0.2c0,0,0.1,0.1,0.1,0.1c0.3-0.1,0.5-0.1,0.9-0.2 c0.1,0.2,0.2,0.4,0.3,0.6c-0.1,0.1-0.1,0.2-0.2,0.2c0,0.3,0.4,0.6,0.1,1c-0.1-0.1-0.2-0.2-0.2-0.2c0,0.1-0.1,0.1-0.1,0.2 c0,0.1,0.1,0.3,0.2,0.4c-0.1,0.6-0.5,1-0.9,1.3c-0.4,0.4-0.8,0.7-1.4,1.1c0.2,0.1,0.4,0.2,0.6,0.3c-0.1,0.2-0.2,0.4-0.3,0.6 c0,0.1,0.1,0.1,0.2,0.3c-0.2,0-0.5,0.1-0.7,0.1c0.1,0.2,0.1,0.4,0.2,0.6h-0.8c-0.1,0.3-0.3,0.5-0.4,0.8c0.1,0.1,0.2,0.2,0.3,0.3 c-0.2,0-0.4,0.1-0.7,0.1c0.1,0.2,0.1,0.4,0.2,0.6c-0.2,0-0.4,0.1-0.7,0.1c0.1,0.2,0.1,0.4,0.3,0.7c-0.3-0.1-0.5-0.2-0.8-0.3 c-0.1,0.2-0.2,0.5-0.4,0.7c0,0.1,0.1,0.2,0.1,0.2c0.1,0,0.2,0,0.3,0.1c0.3,0.2,0.4,0.6,0.8,0.8c0.4,0.2,0.5,0.6,0.8,0.9 c0.2,0.3,0.4,0.5,0.3,0.9c0,0.1,0.1,0.3,0.2,0.4c-0.1,0.1-0.1,0.2-0.3,0.4c-0.3,0-0.5,0.4-1.1,0.2c-1-0.4-2-0.7-3-0.8 c-0.1,0-0.1-0.1-0.2-0.2c-0.3,0.3-0.6,0.7-1,1.1c0,0,0,0.2,0,0.4c-0.2,0-0.4,0.1-0.7,0.1c0.2,0.3,0.4,0.5,0.6,0.9 c-0.3-0.1-0.4-0.1-0.7-0.2c0,0.1-0.1,0.2-0.2,0.3c0.1,0.4,0,0.6-0.4,0.8c-0.1,0.5-0.2,0.9-0.4,1.3c-0.2,0.1-0.3,0.1-0.4,0.2L36,69 c-0.3,0.3-0.7,0.5-1,0.8c-0.2,0.3-0.3,0.7-0.5,1.1c0,0,0.1,0.1,0.2,0.3c-0.2,0.3-0.5,0.5-0.7,0.8c0.1,0.1,0.2,0.2,0.3,0.3 c-0.2,0.2-0.3,0.4-0.5,0.6v0.7C33.4,73.7,33.2,74,33,74.2"></path>
								<path d="M60.7,78.7c0.5,0.6,0.5,0.6,1.2,0.3c0,0.2,0,0.4,0.1,0.5c0,0.1,0.1,0.2,0.2,0.3C62.1,79.9,62,80,62,80 c0.2,0.1,0.3,0.1,0.6,0.3c-0.3,0.4-0.5,0.7-0.7,1.1c0.3,0.6-0.3,0.7-0.4,1c-0.1,0.5-0.7,0.6-0.7,1.1c0,0.6-0.6,0.6-0.9,1 c-0.2,0.3-0.6,0.5-0.7,0.9c0.1,0.2,0.2,0.3,0.3,0.5c-0.3,0.2-0.6,0.4-0.9,0.5l-0.7,0.3c-0.2,0.3-0.4,0.5-0.7,0.8v0.2 c-0.7,0.5-1.4,1-2.2,1.6c0.2,0.1,0.4,0.2,0.6,0.3c-0.3,0.4-0.6,0.9-1,1.3c0.9,0.3,1.7,0.6,2.5,0.9c-0.1,0.2-0.2,0.3-0.2,0.5 c0.4,0.1,0.7,0.3,1.1,0.4v0.5c0.3,0.2,0.5,0.4,0.7,0.6c0,0.3,0,0.5,0,0.8l0.4,0.4l-1,0.9c-0.2,0.3-0.5,0.2-0.8,0 c-0.1-0.1-0.2-0.1-0.3-0.1c-1.2,0-2.2-0.4-3.3-0.8c-0.8-0.3-1.5-0.7-2.3-1c-0.2,0.2-0.6,0.4-0.6,0.8c-0.5,0.1-0.9,0.2-1.4,0.3 c-0.2-0.2-0.4-0.4-0.6-0.6c0.1-0.1,0.1-0.2,0.3-0.3c-0.1-0.2-0.2-0.5-0.3-0.6c-0.3,0.1-0.7,0.1-1,0.1c-0.2-0.3-0.3-0.6-0.5-0.9 c-0.1,0.1-0.1,0.1-0.1,0.1c-0.2-0.3-0.5-0.5-0.8-0.9c0.1-0.8-0.4-1.7-0.3-2.7c0-0.2-0.1-0.5-0.3-0.7c-0.7-0.6-0.7-1.5-1-2.3 c-0.1-0.3-0.2-0.7-0.3-1c0-0.6-0.1-1.1,0-1.7c0.2-0.9,0.3-1.8,1.3-2.1c0.3-0.1,0.7-0.1,1.1-0.2v1.8c0.4-0.2,0.6-0.4,1-0.7 c0.1,0.2,0.1,0.3,0.2,0.5c0.1,0,0.1-0.1,0.2-0.1v1c0.2-0.1,0.3-0.2,0.5-0.2c0.5,0.4,0.5,1,0.4,1.5c0.2,0.1,0.3,0.1,0.5,0.2 c-0.1,0.2-0.2,0.5-0.3,0.8c0.1,0,0.2,0,0.2,0c0.1-0.1,0.1-0.2,0.2-0.2c1-0.4,1.5-1.4,2.4-1.7c0.2-0.7,0.9-0.9,1.4-1.3 c0.4-0.5,1.1-0.8,1.6-1.2c0.5-0.4,0.8-1.1,1.5-1.3c0.4-0.8,1.1-1.4,1.9-1.9c0-0.6,0.7-0.6,0.7-1.2h1c0.1,0.1,0.2,0.2,0.3,0.3 c-0.5,0.2-0.7,0.7-1,1.2c0.7,0.1,1.1-0.7,1.7-0.3C61.1,78.5,61,78.6,60.7,78.7"></path>
								<path d="M58.1,66.7c-0.1-0.5,0.7-0.6,0.3-1.1c-0.1,0.1-0.2,0.2-0.2,0.2c0,0-0.1-0.1-0.1-0.1c-0.1-0.6-0.1-1.1,0.3-1.5 c0.4-0.5,0.9-1,1.3-1.5c0.1-0.2,0.2-0.4,0.3-0.6c-0.2-0.5-0.5-1.1-0.7-1.6c-0.3-0.6-0.3-1.2-0.5-1.8c-0.2-0.3,0.2-0.9,0.2-1.2 c-0.1-0.4-0.4-0.8,0-1.2c0-1.1,0.8-1.8,1.4-2.6h1.9c0.1,0.1,0.2,0.2,0.4,0.4c-0.3,0.4-0.6,0.7-0.9,1.1c0,0.1,0.1,0.3,0.2,0.5 c0.1,0,0.3,0.1,0.4,0c0.3-0.3,0.7-0.2,1-0.2c0.1,0.3,0.2,0.5,0.3,0.7c-0.2,0.2-0.3,0.4-0.6,0.8c0.4,0.1,0.7,0.1,1,0.1v1.1 c0.8,0,0.8-0.9,1.5-0.9c0.3-0.4,0.7-0.8,1.1-1.1c0.4-0.4,0.9-0.8,1.3-1.3c0.4-0.4,0.8-0.8,1.1-1.2c0.4-0.4,0.7-0.9,0.9-1.2 c0.5-0.2,0.7-0.3,1.1-0.4c0.1,0.2,0.3,0.3,0.3,0.5c0,0.1-0.1,0.3-0.2,0.5c-0.1,0.2-0.2,0.3-0.2,0.6c0.3-0.1,0.7-0.3,1-0.4 c0.2,0.4,0.4,0.8,0.7,1.4c0,0,0,0.2,0,0.4c0,0.2,0.1,0.3,0.2,0.5c0,0.1-0.1,0.2-0.2,0.4c0.1,0.1,0.2,0.2,0.3,0.3 c-0.7,1-1.2,2.1-2,3.1c-0.6,0.9-0.5,0.9-1,1.2c0.1,0.1,0.1,0.2,0.2,0.2c-0.9,1-1.8,2-2.7,3v0.4c0.7,0.5,1.4,0.9,2.1,1.3 c-0.1,0.2-0.2,0.3-0.3,0.5c0.3,0.2,0.5,0.7,1,0.5c0.1,0.2,0.2,0.4,0.3,0.6c-0.1,0.1-0.1,0.2-0.3,0.4c0.3,0.3,0.5,0.5,0.8,0.8 c-0.1,0.3-0.2,0.5-0.3,0.8c0.1,0.1,0.2,0.3,0.2,0.4c0,0.1-0.1,0.2-0.1,0.2c-0.1,0.1-0.3,0.1-0.4,0.2c-0.5,0.5-0.6,0.6-1.2,0.4 c-0.8-0.3-1.6-0.4-2.4-0.8c-1-0.5-1.8-1.2-2.8-1.9c-0.4,0.3-0.9,0.7-1.3,1.2c-0.4,0.5-1,0.8-1.8,1.1c0.1-0.2,0.2-0.3,0.3-0.5 c-0.5,0.1-0.9,0.2-1.3,0.3l-0.1-0.1c0.3-0.2,0.5-0.4,0.8-0.6l-0.4-0.4h-0.8c-0.1-0.3-0.2-0.5-0.4-0.9h-0.9 C58.3,67.2,58.2,66.9,58.1,66.7"></path>
								<path d="M63,44.6c-0.4,0.1-0.7,0.2-1.2,0.3c-0.5-0.4-1.1-0.8-1.7-1.2c-0.7-0.5-1.4-1.2-2.2-1.5 c-0.2-0.1-0.4-0.1-0.7-0.2c-0.3-0.5-0.4-1.4-1.3-1.3c-0.4-0.4-0.5-1.1-1.1-1.1c-0.2-0.4-0.3-0.8-0.6-1c-1.2-1.1-2.1-2.5-2.9-4.2 c-0.1-0.5-0.1-1.2-0.2-1.9c-0.2-1.1,0.4-2,1.3-2.6c0.3-0.2,0.4-0.5,0.8-0.5c0.3,0,0.6-0.1,1-0.2c0.1,0.1,0.3,0.2,0.5,0.4 c-0.3,0.5-0.9,0.9-1,1.6c0.7,0.2,1-0.6,1.7-0.6c0.1,0.1,0.2,0.2,0.4,0.3c-0.3,0.4-0.4,0.6-0.7,1.1c0.5-0.2,0.8-0.2,1-0.3 c0.3-0.4,0.8-0.6,1.2-1.1c0.3-0.4,0.7-0.8,1.2-1.1c0.7-0.4,1.2-1.1,1.8-1.6c0.9-0.7,1.8-1.6,2.8-2.2c0.4-0.2,0.7-0.7,1-1 c0.3-0.3,0.8-0.5,0.9-0.9h1.5v1c0,0-0.2,0.2-0.4,0.4c0.2,0,0.4-0.1,0.6-0.1c0.2,0,0.4-0.1,0.7-0.2c0,0.7,0,1.4,0.5,1.8 c-0.1,0.1-0.2,0.2-0.3,0.4c0.2,0.1,0.3,0.2,0.7,0.4c-0.4,0.1-0.5,0.1-0.6,0.2c0.1,0.1,0.1,0.3,0.2,0.4c0,0.1,0,0.3,0,0.4 c-0.4,0.6-0.8,1.1-1.3,1.8c-0.1,0-0.3,0-0.5,0.1c0.1,0.1,0.1,0.2,0.2,0.3c-0.1,0.2-0.1,0.3-0.2,0.5c-1,0-1,1-1.6,1.4 c0.1,0.2,0.2,0.3,0.2,0.3c-0.4,0.4-0.8,0.8-1.2,1.2c0,0,0,0,0,0c-0.2,0.2-0.4,0.4-0.6,0.6c-0.1,0-0.1-0.1-0.2-0.1V35 c-0.1-0.1-0.2-0.2-0.4-0.3c0,0.3,0.1,0.4,0.1,0.7c-0.3,0.4-0.6,0.8-1,1.3c-0.2-0.1-0.3-0.2-0.4-0.3c-0.4,0.5-0.8,1-1.2,1.5 c0.2,0.1,0.3,0.2,0.5,0.3c-0.2,0.3-0.4,0.5-0.5,0.7c0,0.1,0,0.2,0.1,0.2c0.7,0.8,1.5,1.5,2,2.3C62.6,42.3,63.4,43.3,63,44.6"></path>
								<path d="M78.7,28.3c0.1-0.1,0.1-0.1,0.2-0.2c0-0.1-0.1-0.1-0.1-0.2c-0.3-0.3-0.7-0.5-0.9-0.8c-0.2-0.3-0.5-0.5-0.7-0.7 c-0.3-0.3-0.7-0.8-0.7-1.2c0-0.7-0.1-1.4,0.1-2.2c0.3-1.3,1-2.3,1.9-3.2c1.1-1.1,2.3-2.3,3.5-3.5c-0.5-0.4-0.5-1.1-1.2-1.3 c-0.3-0.6-0.6-1.2-0.9-1.8c-0.3-0.5-0.2-1.1-0.2-1.7c0-0.4,0-0.8,0-1.2c0.4-0.5,0.8-1,1.1-1.4h1.9c-0.3,0.5-0.6,1-0.8,1.4 c0.7,0.5,1-0.6,1.6-0.3c0.4,0.5-0.3,0.8-0.6,1.3c0.4-0.1,0.7-0.2,1-0.2c0.2,0.5,0.1,1-0.2,1.5c0.2,0.1,0.3,0.1,0.5,0.2 c0.1,0.1-0.1,0.2-0.2,0.4c0.2,0.3,0.4,0.6,0.7,1c1.9-2,4.2-3.3,5.7-5.5h1.1c-0.1,0.4-0.2,0.7-0.3,1.1c0.3-0.1,0.6-0.2,0.9-0.3v0.9 c0.2,0,0.3,0.1,0.4,0.1c0,0.1,0.1,0.1,0.1,0.2c0,0.1,0,0.2,0,0.3c0.2,1.2-0.4,2.1-1,3c-0.7,1-1.4,1.8-2.2,2.8c0.6,0.7,1.4,1,2.2,1.6 c0,0.1,0,0.3,0.1,0.5c0.2,0.3,0.5,0.5,0.6,0.8c0.2,0.7,0.7,1.4,0.4,2.3c-0.1,0-0.3,0.1-0.5,0.2c-0.2,0.1-0.4,0.2-0.6,0.2 c-0.3-0.3-1-0.2-0.9-0.8c-0.7-0.2-1.3-0.4-1.9-0.5c-0.1-0.2-0.3-0.4-0.4-0.7h-1.2c0-0.1-0.1-0.2-0.1-0.4c-0.5-0.4-0.8,0.1-1.1,0.1 c-0.4,0.4-0.7,0.8-1,1.1c-0.1-0.1-0.2-0.1-0.3-0.2c-0.1,0.2-0.3,0.4-0.5,0.6c0,0,0,0,0.1,0.2c-0.5,0.1-0.6,0.7-0.8,1.1 c-0.2-0.1-0.3-0.2-0.5-0.3c0,0.2-0.1,0.4-0.1,0.6c-0.1,0-0.2,0-0.4,0.1c0,0.5-0.1,1-0.8,0.9c-0.2,0.3-0.6,0.6-0.6,0.8 c0.1,0.7-0.5,1-0.7,1.6c-0.1,0.7-0.1,0.7,0.1,1.1c-0.5,0.4-1,0.7-1.7,0.8C78.9,28.5,78.8,28.4,78.7,28.3"></path>
								<path d="M12.6,15.5c-0.3,0-0.5,0.1-0.7,0.1c0.1,0.1,0.2,0.2,0.3,0.4c-0.3,0.5-0.8,0.8-1.2,1.3l0.2,0.2 c-0.3,0.2-0.6,0.5-0.8,0.6c-0.1,0.4,0.2,0.8-0.3,1c0.4,0.3,0.8,0.5,1.2,0.8c1.2,0.8,2.5,1.5,3.4,2.6c0.6,0.6,1.1,1.2,1.1,2.1 c0,0.2,0.2,0.3,0.3,0.5c-0.3,0.2-0.7,0.4-1.1,0.7c-2.3-1.3-4.6-2.5-6.7-4.2c-0.2,0.1-0.5,0.2-0.5,0.3c-0.2,0.7-0.7,1.2-1.2,1.6 c-0.1,0.1,0,0.2-0.1,0.3c-0.2,0-0.4,0-0.7,0.1C6,24.1,6,24.2,6.1,24.5c-0.4,0.4-0.8,0.9-0.9,1.6c-0.1,0.4-0.5,0.7-0.8,1.2v2.5 c-0.2,0-0.4,0-0.6,0c0,0.1-0.1,0.3-0.1,0.4H2.8c-0.1-0.4-0.2-0.7-0.4-1.1c-0.2,0.1-0.4,0.2-0.7,0.3c-0.1-0.2-0.1-0.3-0.1-0.4 c-0.1,0-0.1-0.1-0.2-0.1c-0.5,0.1-0.8-0.3-0.9-0.6c-0.2-1-0.9-2.1-0.3-3.2c0-1.1,0.7-2,1.1-2.9c0.1-0.3,0.7-0.3,0.5-0.8 c-0.1-0.2,0.3-0.6,0.5-0.9c0.2-0.3,0.4-0.5,0.6-0.8c0.2-0.3,0.5-0.5,0.8-0.8c0.2-0.2,0.4-0.5,0.6-0.8c-1.4-1-2.2-2.5-3.2-3.9 c-0.3-1.3-0.8-2.6-0.6-4.2c0.3-0.4,0.7-0.8,1.2-1.3c0.5,0.1,1-0.2,1.5,0.3c-0.3,0.4-0.6,0.8-0.9,1.2c0.1,0.1,0.2,0.2,0.2,0.2 C3.1,10.6,3.4,9.7,4,9.9c0.1,0.2,0.2,0.4,0.3,0.6c-0.2,0.1-0.4,0.3-0.7,0.4C3.8,11,3.9,11.1,4,11.2c0.3-0.3,0.6-0.3,1,0.1 c0,0.3,0.2,0.6-0.2,0.9c0.2,0.1,0.3,0.1,0.5,0.3C5.1,12.7,5,13,4.8,13.2c0.2,0.1,0.3,0.1,0.6,0.2c-0.3,0.1-0.4,0.1-0.6,0.2 c0,0.2,0,0.4,0.1,0.6c0.4,0.6,0.9,1.1,1.4,1.8c0.3-0.3,0.5-0.4,0.7-0.6c1.2-1.2,2.3-2.5,3.8-3.4c0-0.4,0.4-0.4,0.6-0.6 c0.2-0.3,0.5-0.5,0.6-0.7h0.8c-0.3,0.5-0.9,0.8-0.7,1.5c0.5-0.3,1-0.6,1.6-0.9c-0.1,0.3-0.1,0.6-0.1,0.9c0.2,0.1,0.5,0.3,0.8,0.4 c-0.1,0.2-0.2,0.3-0.2,0.5c0.1,0,0.2,0,0.3,0.1c0,0,0.1,0.1,0,0.1c-0.3,0.4-0.6,0.7-0.8,1.1C13.4,14.8,12.9,15.1,12.6,15.5"></path>
								<path d="M33.3,27c0.9-1.1,1.7-2,2.4-3c0.7-0.9,1.3-1.8,1.9-2.8c-0.1-0.1-0.1-0.2-0.3-0.3c0.2-0.2,0.4-0.4,0.6-0.7h0.7 c0.3,0.3,0.5,0.7,0.8,0.8c0.4,0.1,0.4,0.4,0.6,0.7c0.5,0.8,0.9,1.6,0.5,2.7c-0.3,0.6-0.5,1.3-0.8,1.9c-0.1,0.2-0.1,0.4-0.2,0.7 l-0.6,0.6v0.7c-0.4,0.8-0.8,1.5-1.2,2.2c0.6,0.4,1.1,0.8,1.6,1.1c1.1,0.7,1.9,1.5,2.5,2.7c0.1,0.3,0.2,0.5,0.3,0.9 c0,0.1-0.1,0.3-0.2,0.5c-0.2,0.1-0.5,0.2-0.7,0.3c-0.5-0.2-1-0.3-1.4-0.5c-0.4-0.2-0.9-0.4-1.3-0.6c-0.1-0.7-0.8-0.4-1.1-0.8 c-0.3-0.4-0.8-0.5-1.3-0.8c-1.5,1.5-2.8,3.1-4,4.9c-0.1,0.1-0.1,0.3-0.1,0.5c-0.5,0.4-1,0.3-1.5,0v-0.4c-0.7-0.4-1.3-0.8-2-1.2 c-0.3-0.4-0.2-1-0.4-1.5c-0.2-0.5,0-1-0.1-1.4c0.7-1.7,1.6-3.1,2.9-4.4v-0.8c-0.7-0.5-1.2-1.3-1.6-2.1c-0.2-0.3-0.2-0.6-0.2-0.9 c-0.1-0.6-0.4-1.2-0.3-1.9c0-1.3,0.8-2.2,2-2.6c0.8-0.3,1.5-0.1,2.3-0.2c-0.4,0.9-1.5,0.8-2.1,1.6c1.1,0,1.7-1.1,2.8-0.9 c0,0.3-0.1,0.5-0.1,0.8c0.2,0.1,0.5,0.2,0.8,0.3v1.4c-0.3,0.5-0.6,1-0.9,1.5C33.2,26.3,33.3,26.6,33.3,27"></path>
								<path d="M52.3,13c-0.4,0.5-0.8,1-1.2,1.6V16c-0.4,0.2-0.8,0.3-1.2,0.5c-0.5-0.5-0.7-1.2-0.9-1.8 c-0.2,0.1-0.4,0.2-0.7,0.3c-0.2-0.3-0.5-0.6-0.7-1c-0.4-1-0.4-2.1-0.4-3.2c0.2-0.4,0.4-0.8,0.6-1.3c-0.3,0-0.6,0-0.7-0.1 c-0.7-0.7-1.5-1.5-2.1-2.3c-0.4-0.4-0.7-0.9-0.9-1.4c-0.2-0.8-0.2-1.6-0.3-2.4c0.3-0.5,0.6-1,1.1-1.4c0.4-0.4,1-0.5,1.6-0.8 c0.1,0.2,0.3,0.3,0.4,0.5c-0.1,0.1-1.2,1.1-1.2,1.1c0.1,0.1,0.2,0.2,0.3,0.3c0.5-0.4,1-0.8,1.8-0.5c-0.2,0.3-0.4,0.5-0.6,0.9 c0.4-0.1,0.6-0.2,0.9-0.3c0.1,0.2,0.3,0.4,0.5,0.7c-0.3,0.3-0.6,0.6-0.9,0.9c0.2,0,0.3,0.1,0.5,0.1c-0.3,0.4-0.1,1-0.8,1.2 C48,6.5,48.7,7,49.5,7.5c2.5-2.1,4.9-4.1,7.4-6.1H58c-0.2,0.4-0.3,0.7-0.5,1c0.3,0.2,0.6,0,0.9-0.2c0.8,0.8,1,1.8,0.9,2.8 c-0.3,0.4-0.7,0.9-1.1,1.4c0,0,0.1,0.1,0.2,0.2c-0.2,0-0.4,0.1-0.6,0.1c0.1,0.1,0.2,0.2,0.2,0.2h-0.4c-0.8,1.5-2.1,2.4-3,3.8 c1.3,0.7,2.8,1.3,4.2,2.1c0,0.2,0.1,0.4,0.1,0.7c0.2-0.2,0.3-0.3,0.4-0.4c0.6,0.1,0.5,0.7,1,1c0.4,0.2,0.7,0.8,1,1.2v1.3 c-0.1,0.1-0.2,0.2-0.4,0.4c-1.2-0.1-2.1-0.8-3.2-1.3c0,0-0.1,0.1-0.1,0.1c-0.7-0.2-1.2-1-2-0.9c-0.4-0.5-1.1-0.6-1.6-0.9 C53.5,13.7,53,13.3,52.3,13"></path>
								<path d="M85.2,31c0.2,0.1,0.4,0.2,0.7,0.4c-0.1,0.4-0.1,0.7-0.2,1.2c0.2,0.3,0.3,0.8,0.9,1c0.3-0.4,0.4-0.8,0.9-1 c0.3-0.1,0.6-0.6,0.8-1c0.3-0.4,0.7-0.6,0.9-1.1c0.2-0.4,0.6-0.6,0.9-1c0.3-0.4,0.5-0.8,0.7-1.2h1.3c0.1,0.4,0.2,0.7-0.2,1.1 c0.4,0,0.6,0,0.9,0c0.1,0.5,0.2,1,0.3,1.5c-0.2,0.1-0.3,0.1-0.5,0.2c0,0.1,0,0.2,0.1,0.3c0.3,0.8,0.3,1-0.3,1.6 c-0.3,0.3-0.4,0.6-0.3,0.9c0.2,0.4-0.3,0.2-0.1,0.6c-0.2-0.2-0.3-0.3-0.5-0.4v0.6c-0.2,0-0.4,0.1-0.7,0.1v0.6 c-0.3,0.3-0.5,0.5-0.7,0.7c0.4,0.4,0.8,0.7,1.1,1v0.9c0.2,0.2,0.5,0.5,0.8,0.8c-0.1,0.1-0.1,0.2-0.2,0.4c0.1,0.2,0.3,0.5,0.5,0.9 c-0.2,0.5-0.5,1-0.7,1.4h-0.9c-1.1-0.6-2.2-1.2-3.2-1.8c-0.2,0.3-0.3,0.5-0.5,0.7c-0.2-0.1-0.3-0.2-0.6-0.3v1.1 c-0.3-0.1-0.6-0.2-1-0.4c0.2,0.3,0.2,0.3,0.3,0.5c-0.2,0.2-0.4,0.4-0.8,0.7c-0.1-0.4-0.1-0.7-0.2-1c0.2-0.1,0.3-0.1,0.5-0.2 c0-0.1,0-0.2,0.1-0.3c-0.1,0-0.3-0.1-0.4-0.1c0-0.2,0.1-0.4,0.2-0.7c-0.2,0.2-0.3,0.3-0.3,0.3c-0.5-0.1-0.9-0.2-1.4-0.3 c-0.1-0.1-0.2-0.3-0.3-0.5c0.1-0.3,0.2-0.7,0.3-1.1c0.2,0,0.5,0.1,0.8,0.1c0,0,0-0.1,0-0.1c-0.3-0.1-0.6-0.3-0.8-0.4 c0.2-0.3,0.3-0.6,0.5-0.9c-0.7-1.3-1.6-2.5-2-3.8c-0.3-0.9,0.1-1.9,0.2-2.8c0.1-0.7,0.7-1.2,1.4-1.6c0.1-0.1,0.2-0.1,0.3-0.2h1.1 c0.2,0.2,0.3,0.3,0.4,0.4c-0.2,0.2-0.4,0.4-0.6,0.6v0.7c0.2-0.1,0.5-0.1,0.8-0.2c0.1,0.1,0.3,0.3,0.5,0.4 C85.6,30.6,85.4,30.8,85.2,31"></path>
								<path d="M17.3,42.6c0.1,0.1,0.2,0.2,0.4,0.4c-0.7,0.6-1.4,1.2-2.1,1.8c0,0,0,0.1,0,0.1c0.1,0,0.3,0,0.4-0.1 c0.2-0.2,0.4-0.4,0.6-0.4c0.5-0.3,1-0.5,1.4-0.8c0.4,0.3,0.1,0.6-0.1,1c0.3-0.1,0.4-0.2,0.6-0.2c0.1,0.1,0.2,0.2,0.3,0.3 c0,0.5,0,0.9,0,1.4c-0.1,0.1-0.3,0.3-0.4,0.4c0,0.1,0,0.1,0.1,0.2c0.3,0.2,0.5,0.4,0.8,0.6c0.3,0.2,0.7,0.2,0.7,0.7 c0,0.1,0.1,0.1,0.2,0.2c0.2,0.2,0.5,0.3,0.7,0.5c0.2,0.2,0.3,0.5,0.5,0.8c0,0.2,0,0.5,0,0.8c-0.2,0.2-0.4,0.4-0.5,0.5 c-1.4-0.5-2.8-1-4.2-1.5c-0.3,0.2-0.6,0.3-1,0.5c0,0,0,0,0-0.1c-0.3,0.3-0.6,0.6-1,1c0,0.1,0,0.3,0,0.5c-0.6,0.6-1.2,1.2-1.7,1.7 c-0.3,0.8-0.1,1.6-1.2,1.7c-0.2-0.3-1-0.4-0.8-1.2c-0.2-0.1-0.5-0.1-0.8-0.2c-0.1,0-0.2,0.1-0.3,0.2c-0.3-0.3-0.5-0.6-0.9-1 c-0.1-0.7-0.2-1.6-0.3-2.6c0.9-1,1.9-2,2.8-3.1c-0.4-0.2-0.8-0.4-1.1-0.7c-0.4-0.3-0.6-0.6-1-1c0.1-0.3,0.2-0.6,0.3-0.9 c-0.2-0.1-0.3-0.1-0.5-0.2v-0.8c0.1-0.1,0.1-0.1,0.2-0.2c0.3-0.1,0.7-0.1,1.1-0.2c1.1,0.6,2.3,1.3,3.5,2C15.4,44,16.1,43,17.3,42.6"></path>
							</svg>
						</figure>
					</div>
					<div class="col-md-6">
						<div class="row home-process-stat-cards">
							<div class="col-6">
								<div class="home-process-stat-card h-100 p-4 bg-main text-white rounded text-center">
									<h3 class="fw-bold fs-2">10+</h3>
									<p class="mb-0">Years of Experience</p>
								</div>
							</div>
							<div class="col-6">
								<div class="home-process-stat-card h-100 p-4 bg-accent text-white rounded text-center">
									<h3 class="fw-bold fs-2">1K</h3>
									<p class="mb-0">Happy Customers</p>
								</div>
							</div>
							<div class="col-12 mt-3 mb-3 mb-md-0">
								<img src="{{ asset('front/assets/images/team-process.png') }}" alt="team process" class="w-100 img-fluid rounded">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<h2 class="fw-bold mb-3">Quick Match to Top Professionals</h2>
				<p>Looking to hire? Elyvato connects you with top-vetted freelance talent within hours not days. Our platform is built for speed, reliability, and quality, ensuring you get the right expert for your project without delays. Simply pick a service, and our team will connect with you directly. Once you pay the commitment amount, your project kicks off no delay, no sway. Scale faster, hire smarter, and grow your business with Elyvato’s expert-driven, on-demand hiring solutions.</p>
				<ul class="list-unstyled mb-4">
					<li class="d-flex align-items-center gap-2 mb-1"><i class="ri-verified-badge-fill text-main"></i> Pick a Service</li>
					<li class="d-flex align-items-center gap-2 mb-1"><i class="ri-verified-badge-fill text-main"></i> Our Team Will Contact You</li>
					<li class="d-flex align-items-center gap-2"><i class="ri-verified-badge-fill text-main"></i> Pay Commitment Money</li>
					<li class="d-flex align-items-center gap-2"><i class="ri-verified-badge-fill text-main"></i> No Delay, No Sway</li>
				</ul>
				<a href="{{url('services')}}" class="btn btn-main">Pick a Service</a>
			</div>
		</div>
	</div>
</section>

{{-- ============================= services section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
	<div class="container">
		<div class="row align-items-center justify-content-between mb-3">
			<div class="col-lg-8">
				<h2 class="fw-bold mb-2">Services for Your Content Needs</h2>
				<p>Most viewed all-time top-selling services.</p>
			</div>
			<!--<div class="col-lg-4 text-lg-end text-center">-->
			<!--	<button type="button"-->
			<!--		class="btn btn-md-large btn-main w-100 d-flex align-items-center gap-2 justify-content-center"-->
			<!--		data-bs-toggle="modal" data-bs-target="#bookingModal"><i class="ri-phone-line"></i>Instant-->
			<!--		Hire</button>-->
			<!--</div>-->
			<div class="col-lg-4 text-lg-end text-center">
				<!--<button  class="btn btn-main" data-bs-toggle="modal" data-bs-target="#bookingModal">Instant Hire <i class="ri-bard-line"></i></button>-->
				<a href="{{route('instant.hire.booking')}}"  class="btn btn-main">Instant Hire <i class="ri-bard-line"></i></a>
				<a href="{{ url('services') }}" class="btn btn-main">View All Services</a>
			</div>
		</div>
		<div class="mb-3 mb-lg-5 d-flex d-sm-none d-lg-flex home-service-category-cards">

			@foreach (Service()->take(8) as $service)
			<div class="home-service-category-card-container d-flex">
				<a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}" class="w-100 h-100 bg-white border rounded-2 p-3 p-lg-3 home-service-category-card">
					<i class="{{ $service->icon }} fs-3 mb-2"></i>
					<p class="fw-medium mb-0 text-sm">{{$service->name}}</p>
				</a>
			</div>				
			@endforeach
		</div>

		<div class="mb-3 mb-lg-5 d-none d-sm-flex d-lg-none home-service-category-cards">

			@foreach (Service()->take(9) as $service)
			<div class="home-service-category-card-container d-flex">
				<a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}" class="w-100 h-100 bg-white border rounded-2 p-3 p-lg-3 home-service-category-card">
					<i class="{{ $service->icon }} fs-3 mb-2"></i>
					<p class="fw-medium mb-0 text-sm">{{$service->name}}</p>
				</a>
			</div>				
			@endforeach
		</div>

		<div class="row service-cards">
			

			@foreach ($sows as $sow)
			<div class="col-md-6 col-lg-3">
				<div class="h-100 bg-white border border-bg-tertiary rounded service-card d-flex flex-column">
					{{--<div class="service-card-image-box rounded-top">
						<img src="{{ asset('front/assets/images/graphic-design.jpg') }}" alt="{{ $sow->title }}" class="img-fluid service-card-image">
					</div>--}}

					@php
                        $fileShown = false;
                    @endphp

                    @foreach ($sow->allFiles as $files)
                        @if (!$fileShown && $files->file_type == 'image')
                            <div class="service-card-image-box rounded-top">
                                <img src="{{ asset($files->image_path) }}" alt="{{ $sow->name }}" class="img-fluid service-card-image">
                            </div>
                            @php $fileShown = true; @endphp
							

                        @elseif (!$fileShown && $files->file_type == 'video')
						@php
								$VideoId = null;

								if ($files->file_type === 'video') {
									// Works for watch?v=, youtu.be/, and embed/
									preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([^\s"&?\/]+)/', $files->video, $matches);
									$VideoId = $matches[1] ?? null;
								}
							@endphp
                            <div class="service-card-image-box rounded-top">
                                <!-- <img src="{{ asset('front/assets/images/video-editing.jpg') }}" alt="{{ $sow->name }}" class="img-fluid service-card-image"> -->
                              <img 
    src="https://img.youtube.com/vi/{{ $VideoId }}/hqdefault.jpg" 
    data-fallback="https://img.youtube.com/vi/{{ $VideoId }}/hqdefault.jpg" 
    alt="YouTube Thumbnail" 
    class="img-fluid service-card-image youtube-thumb">	

							</div>
                            @php $fileShown = true; @endphp
                        @endif
                    @endforeach

					<div class="service-card-content p-4 d-flex flex-column flex-grow-1">
						<div class="mb-4">
								@php 
									
									$Service=App\Models\Service::where('id',$sow->service_id)->first();
									$subService=App\Models\SubService::where('id',$sow->subservice_id)->first();
									
								@endphp
							<h3 class="fw-bold fs-4 mb-3">

								<a href="{{ route('sow.details.sub',[$Service->slug,$subService->slug,$sow->slug]) }}">
									{{ $sow->title}}
								</a>
							</h3>
							<p class="mb-0">{{ \Illuminate\Support\Str::words(strip_tags($sow->description), 25, '...') }}</p>
						</div>
						<div class="mt-auto border-top pt-3">
							<!-- <a href="#" class="service-card-link d-inline-flex align-items-center text-sm link-text">
                                Login for Custom Requirement 
                                <i class="ri-login-box-line"></i> 
                            </a> -->

							@if(auth()->check())
                                <a href="{{ route('post.custom.requirement', $sow->slug) }}" class="service-card-link d-inline-flex align-items-center text-sm link-text">
                                     Post Custom Requirement 
                                    <i class="ri-login-box-line"></i> 
                                </a>
                            @else

                            <a href="{{ url('login') }}" class="service-card-link d-inline-flex align-items-center text-sm link-text">
                                Login for Custom Requirement 
                                <i class="ri-login-box-line"></i> 
                            </a>
                            @endif

						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

{{-- ============================= our talent section ============================= --}}
<section class="section-padding-top section-padding-bottom">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 order-lg-2 mb-3 mb-md-4 mb-lg-0">
				<img src="{{ asset('front/assets/images/home-freelancer.jpg') }}" alt="Our Talent" class="img-fluid rounded-2">
			</div>
			<div class="col-lg-6 pe-lg-5">
				<h2 class="mb-3 fw-bold">Our Talent</h2>
				<p>Elyvato is where India's top 1% of content & marketing professionals reside, the sharpest minds meticulously selected and continuously trained for unparalleled service delivery. Unlike open marketplaces, we ensure every creative solution you receive is from a proven expert, not just a freelancer. Connect with a curated league of extraordinary skill, ready to elevate your projects with consistent results.</p>
				<ul class="ps-0 mb-4">
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> Elite talent for high-stakes roles.</li>
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> Custom workflows, zero bottlenecks.</li>
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> Dedicated support from brief to delivery.</li>
					<li class="d-flex align-items-center gap-2"><i class="ri-check-double-line"></i> Ready to build smarter ?</li>
				</ul>
				<a href="{{ url('services') }}" class="btn btn-main">View All Services</a>
			</div>
		</div>
	</div>
</section>

{{-- ============================= enterprise section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-3 mb-md-4 mb-lg-0">
				<img src="{{ asset('front/assets/images/home-enterprise.jpg') }}" alt="Enterprise" class="img-fluid rounded-2">
			</div>
			<div class="col-lg-6 ps-lg-5">
				<h2 class="mb-3 fw-bold">Enterprise</h2>
				<p>For enterprises navigating complex operations, vast data, and high-traffic volumes, Elyvato offers a superior content partnership.</p>
				<ul class="ps-0 mb-4">
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> Our commitment to quality assurance defines every interaction.</li>
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> Your dedicated account manager oversees every step.</li>
					<li class="d-flex align-items-center mb-1 gap-2"><i class="ri-check-double-line"></i> We provide end-to-end talent and project control.</li>
					<li class="d-flex align-items-center gap-2"><i class="ri-check-double-line"></i> Our platform allows you to do it all in one place.</li>
				</ul>
				<a href="{{ url('services') }}" class="btn btn-main">View All Services</a>
			</div>
		</div>
	</div>
</section>

{{-- ============================= testimonials section ============================= --}}

{{-- ============================= testimonials section ============================= --}}
<section class="section-padding-top section-padding-bottom home-hero">
	<div class="container py-md-3 py-lg-5">
		<div class="row align-items-center">
			<div class="col-lg-7 pe-lg-5">
				<h1 class="fw-bold mb-3 mb-md-4">Trusted by Brands That Demand the Best</h1>
				<p class="fs-5 fw-semibold mb-3 mb-md-4">Client success isn't just our goal - it's our track record.</p>
				<div class="row">
					<div class="testimonial-slider owl-carousel">
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Elyvato has completely changed the way we handle content production. Seamless and reliable!</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By — Priya Kapoor</p>
											<p class="mb-0 text-sm">Marketing Head, D2C Brand</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Finally, a platform that actually understands how the Indian content market works. Love it!</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Ramesh Vaidya.</p>
											<p class="mb-0 text-sm">Freelancer</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">We got top-tier video scripts within 48 hours. Quality was better than what we’ve paid 3x for earlier.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Aarti Joshi.</p>
											<p class="mb-0 text-sm"> Creative Director</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">What Fiverr couldn’t deliver in 5 days, Elyvato gave me in 24 hours — and better.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Nikhil Jain. </p>
											<p class="mb-0 text-sm">Founder, Media Startup</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">I’ve used UpWork, Refrens, and Freelancer. Elyvato beats them on support, cost, and output.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Sneha Mehra.</p>
											<p class="mb-0 text-sm">Content Strategist</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Their managed delivery is a game changer. I don’t have to chase 10 people anymore.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Aditya Khanna</p>
											<p class="mb-0 text-sm">Digital Lead</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">From script to subtitles, we got everything done in 3 languages. Smoothest workflow we’ve seen.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Karishma Rawat.</p>
											<p class="mb-0 text-sm">OTT Content Team</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Impressed by the platform's speed and the quality of the talent. Didn’t expect this level at these prices.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Vikram Iyer.</p>
											<p class="mb-0 text-sm">Founder, Bootstrapped SaaS</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">As a freelancer, Elyvato actually pays on time. That’s rare. And the project briefs are super clear.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Divya S.</p>
											<p class="mb-0 text-sm">Content Writer</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">We got a fully localized product video for Amazon in 72 hours. No follow-ups needed.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Tushar Goyal.</p>
											<p class="mb-0 text-sm"> Ecom Seller</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">I handed off an entire blog series to them and they nailed voice, research, and tone. Total win.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Meenakshi Dubey.</p>
											<p class="mb-0 text-sm">Content Lead</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Elyvato is what Indian content services needed. Reliable people, accountable delivery.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Siddharth Malhotra.</p>
											<p class="mb-0 text-sm">Co-founder, AdTech Firm</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Our explainer video project was handled end-to-end, and it looked premium.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Aakash Sinha.</p>
											<p class="mb-0 text-sm">Founder, Fintech App</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Tried them for one project — ended up giving them 5 more. Elyvato delivers.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Juhi Patel.</p>
											<p class="mb-0 text-sm">Social Media Manager</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Super impressed by the voiceover quality. Turnaround could be faster, but worth it.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Ankush Taneja.</p>
											<p class="mb-0 text-sm">YouTuber</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										
									</ul>
									<!-- Content -->
									<p class="fw-medium">Had a minor revision request but the team was quick and polite. Very professional.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Reena Mishra.</p>
											<p class="mb-0 text-sm">Podcast Host</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Great delivery and UI, though onboarding could be smoother for first-time users.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Mohit Arora.</p>
											<p class="mb-0 text-sm">Startup Founder</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">High-quality copy at 1/3rd the price of what we usually pay. Will definitely use again.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Shalini Nair</p>
											<p class="mb-0 text-sm">Brand Manager</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">The team understood our niche very well. A few delays, but final content was spot on.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Zoya Rahman.</p>
											<p class="mb-0 text-sm">Health Blogger</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">First project went well. Minor hiccup in TAT but they made up for it with quality.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Harshit Sharma.</p>
											<p class="mb-0 text-sm">Freelancer</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Pretty solid platform. Good curation of talent. Could use more payment options though.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Ritu Malhotra.</p>
											<p class="mb-0 text-sm"> Founder, D2C Skincare Brand</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Support team is very responsive. Got quick revisions. UX can be improved a bit.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Rahul Dandekar.</p>
											<p class="mb-0 text-sm">Ad Agency Associate</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Got exactly what I wanted. Slightly pricey for small creators, but quality justifies it.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Snehal Borkar.</p>
											<p class="mb-0 text-sm">Travel Influencer</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Video editors were top-notch. Only reason for 4 stars is a slight lag in preview delivery.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Yusuf Qureshi.</p>
											<p class="mb-0 text-sm">Content Consultant</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Did a complete rebranding with Elyvato’s help. Smoothest process I’ve experienced.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Nidhi Agarwal.</p>
											<p class="mb-0 text-sm"> Fashion Brand Owner</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">They actually listen. The account manager made sure nothing slipped through.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Mayank Tiwari.</p>
											<p class="mb-0 text-sm"> B2B SaaS CMO</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Rare to find a team that balances quality, price, and professionalism like this.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Ananya Sen.</p>
											<p class="mb-0 text-sm">Growth Consultant</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">From thumbnails to titles to metadata — got my entire YouTube channel audit done fast.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Raghav Purohit.</p>
											<p class="mb-0 text-sm">Creator, Finance Niche</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">As someone who’s worked on both client and freelancer side, Elyvato nails both.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div> --}}
										<div>
											<p class="mb-0">By Tanya Dsouza.</p>
											<p class="mb-0 text-sm">Ex-Agency Lead, Now Freelancer</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">TMW is hands down the most versatile agency we’ve worked with. Great pricing, even better delivery.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Terrence Lam.</p>
											<p class="mb-0 text-sm">CEO, TerreVive Solutions (HK)</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Project was wrapped up 3 days ahead of schedule. Super impressed with speed and quality.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Lisa Chang.</p>
											<p class="mb-0 text-sm">Product Head</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">TMW team was always available. Super reliable, especially for startups like ours.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Donny Singh </p>
											<p class="mb-0 text-sm">APT Consultancy (Canada)</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Just told Ratnendra the goal—he cracked the entire growth strategy. Genius stuff.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Israel Ayala.</p>
											<p class="mb-0 text-sm">Content Head, CCM INT</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">TMW already knew what we needed. Their experience in community products shows.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Steve Zhou</p>
											<p class="mb-0 text-sm">Sr. BD Manager, BIGO</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">One of the few teams that actually exceeds expectations. Always a pleasure!</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										{{--<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>--}}
										<div>
											<p class="mb-0">By Vishal Phadke</p>
											<p class="mb-0 text-sm">Digital Marketing Manager, Syngenta</p>
										</div>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
			<div class="col-lg-5 position-relative mt-3 mt-lg-0">
				<img src="{{ asset('front/assets/images/home-testimonial.jpg') }}" alt="elyvato client testimonials" class="w-100 img-fluid rounded-2">
				<div class="floating-horizontal home-testimonial-floating-card d-none d-lg-inline-block bg-accent rounded-4 position-absolute mb-md-4 ms-md-n5 px-3 py-2">
					<div class="d-flex align-items-center">
						<div class="me-2 home-testimonial-floating-card-icon-box d-flex align-items-center justify-content-center">
							<img src="{{ asset('front/assets/images/avatar/user-6.jpg') }}" alt="User Testimonial" class="img-fluid w-100 h-100 rounded-circle">
						</div>
						<div>
							<p class="text-white mb-0">Best logo design service <br/> provided for my gaming brand 🔥</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

{{--<section class="section-padding-top section-padding-bottom home-hero">
	<div class="container py-md-3 py-lg-5">
		<div class="row align-items-center">
			<div class="col-lg-7 pe-lg-5">
				<h1 class="fw-bold mb-3 mb-md-4">Trusted by Brands That Demand the Best</h1>
				<p class="fs-5 fw-semibold mb-3 mb-md-4">Client success isn't just our goal - it's our track record.</p>
				<div class="row">
					<div class="testimonial-slider owl-carousel">
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">The best Bootstrap theme we've ever used - it's easy to customize and comes with all the features we need.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>
										<p class="mb-0">By Dennis Barrett</p>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">The best Bootstrap theme we've ever used - it's easy to customize and comes with all the features we need.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>
										<p class="mb-0">By Dennis Barrett</p>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="card bg-transparent border-0 h-100">
								<div class="card-body p-0">
									<!-- Rating star -->
									<ul class="list-unstyled mb-2">
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-fill text-warning"></i></li>
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">The best Bootstrap theme we've ever used - it's easy to customize and comes with all the features we need.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										<div class="flex-shrink-0 me-2">
											<img class="arounded" src="{{ asset('front/assets/images/avatar/user-1.jpg') }}" alt="avatar" width="40" height="40">
										</div>
										<p class="mb-0">By Dennis Barrett</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 position-relative mt-3 mt-lg-0">
				<img src="{{ asset('front/assets/images/home-testimonial.jpg') }}" alt="elyvato client testimonials" class="w-100 img-fluid rounded-2">
				<div class="floating-horizontal home-testimonial-floating-card d-none d-lg-inline-block bg-accent rounded-4 position-absolute mb-md-4 ms-md-n5 px-3 py-2">
					<div class="d-flex align-items-center">
						<div class="me-2 home-testimonial-floating-card-icon-box d-flex align-items-center justify-content-center">
							<img src="{{ asset('front/assets/images/avatar/user-6.jpg') }}" alt="User Testimonial" class="img-fluid w-100 h-100 rounded-circle">
						</div>
						<div>
							<p class="text-white mb-0">Best logo design service <br/> provided for my gaming brand 🔥</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>--}}

{{-- ============================= footer cta section ============================= --}}
<section class="position-relative footer-cta section-padding-bottom">
	<div class="container position-relative">
		<div class="footer-cta-content rounded position-relative overflow-hidden p-4 p-sm-5">
			<img src="{{ asset('front/assets/images/pattern-plane.svg') }}" alt="footer cta background pattern" class="footer-cta-plane-pattern">
			<div class="row align-items-center">
				<div class="col-lg-6 mb-3 mb-lg-0">
					<h2 class="text-white fw-bold mb-3">Let's talk about your brand content goals</h2>
					<a href="{{ url('services') }}" class="btn btn-dark">Pick a Service</a>
				</div>
				<div class="col-lg-5 col-xl-4 ms-auto text-lg-end">
					<ul class="list-group mb-0">
						<li class="list-group-item ps-0 mb-0">
							<div class="text-white fw-normal d-flex align-items-center justify-content-lg-end">
								<i class="ri-customer-service-2-line me-2"></i> Call on: +(91) 92899 57538
						  </div>
						</li>
						<li class="list-group-item ps-0 mb-0">
							<div class="text-white fw-normal d-flex align-items-center justify-content-lg-end">
								<i class="ri-mail-line me-2"></i> Email: support@elyvato.com
						  </div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

{{-- Instant Hire process modal   --}}

<!-- Modal -->
	<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="bookingModalLabel">Schedule Your Instant Hire Call</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<div class="marquee-wrapper mb-2">
						<div class="marquee-text">
							<p class=" fw-medium mb-0">
							Schedule your Premium⭐ Instant Hire call for just INR 9! The best part? This amount is completely adjustable against your total project cost.
							</p>
						</div>
						<input type="hidden" name="selected_date" id="selectedDateInput">
					</div>
					
					<div class="mb-3">
						<div class="calendar">
							<div class="calendar-header">
								<i id="prev" class="fas fa-angle-left"></i>
								<h2 id="monthYear"></h2>
								<i id="next" class="fas fa-angle-right"></i>
							</div>
							<div class="calendar-weekdays">
								<div>Sun</div>
								<div>Mon</div>
								<div>Tue</div>
								<div>Wed</div>
								<div>Thu</div>
								<div>Fri</div>
								<div>Sat</div>
							</div>
							<div class="calendar-days" id="calendarDays"></div>
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="time-picker" class="text-sm text-muted mb-1">Select a Time Slot</label>
						<div class="input-group">
							<select id="timeSlot" name="time_slot" class="form-select focus-shadow-none">
								<option value="">Select a time slot</option>
							</select>
						</div>
					</div>

					@if(!Auth::check())
						<div class="form-floating mb-3">
							<input type="email" class="form-control focus-shadow-none" name="email" id="email"
								placeholder="name@example.com" required>
							<label for="email">Email address</label>
						</div>

						<div class="form-floating mb-3">
							<input type="mobile" class="form-control focus-shadow-none" name="mobile" id="mobile"
								placeholder="123456789" required>
							<label for="email">Phone Number</label>
						</div>

					@endif
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

					<button type="button" data-id="0" data-price="9"
						class="btn btn-main proceed-booking-btn">Hire Now</button>
				</div>
			</div>
		</div>
			<input type="hidden" id="isLoggedIn" value="{{ Auth::check() ? '1' : '0' }}">
	</div>
	
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function(){
            $('.client-slider').owlCarousel({
                loop: true,
                margin: 40,
                nav: false,
				dots: false,
				lazyLoad: true,
				autoplay: true,
				autoplaySpeed: 2200,
				autoplayTimeout: 2200,
				autoplayHoverPause: false,
				slideTransition: 'linear',
				mouseDrag: false,
				touchDrag: false,
    			responsiveClass:true,
                responsive: {
                    0: {
                        items: 2
                    },
                    500: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1024: {
                        items: 5
                    }
                }
            });
			$('.testimonial-slider').owlCarousel({
                loop: true,
                margin: 40,
                nav: false,
				dots: true,
				lazyLoad: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
    			responsiveClass:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    }
                }
            });
        });



$(document).ready(function () {
    $('#SearchInputs').on('keyup', function () {
        let query = $(this).val();

        if (query.length >= 2) {
            $.ajax({
                url: "{{ route('ajax.search.services') }}",
                type: "GET",
                data: { query: query },
                success: function (res) {
                    $('#serviceResult').css({
                        'background-color': 'white',
                        'padding': '6px',
                        'border-radius': '6px'
                    });
                    $('#serviceResult').html(res.html);  
                }
            });
        } else {
            
            $.ajax({
                url: "{{ route('ajax.default.services') }}",  
                type: "GET",
                success: function (res) {
                    $('#serviceResult').css({
                        'background-color': 'white',
                        'padding': '6px',
                        'border-radius': '6px'
                    });
                    $('#serviceResult').html(res.html);  
                }
            });
        }
    });
});


 document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.youtube-thumb').forEach(function(img) {
            img.onerror = function() {
                const fallback = img.getAttribute('data-fallback');
                if (fallback) {
                    img.src = fallback;
                }
            };
        });
    });
    
    
    // here calendaer and booking  start 
    
//     document.addEventListener('DOMContentLoaded', function () {
// 			flatpickr("#formDate", {
// 				dateFormat: "Y-m-d",
// 				minDate: "today",
// 				defaultDate: "today",
// 				allowInput: false
// 			});
// 		});


		// here start new booking js 

		const calendarDays = document.getElementById("calendarDays");
		const monthYear = document.getElementById("monthYear");
		const prev = document.getElementById("prev");
		const next = document.getElementById("next");

		let currentDate = new Date();

		const events = {
			//   "2025-06-11": ["Employment (Semi...)"],
		};

		let selectedDate = null;

		function renderCalendar(date) {
			const year = date.getFullYear();
			const month = date.getMonth();
			const today = new Date();
			today.setHours(0, 0, 0, 0);

			const firstDay = new Date(year, month, 1);
			const lastDay = new Date(year, month + 1, 0);
			const startDay = firstDay.getDay();

			monthYear.innerText = date.toLocaleString("default", { month: "long", year: "numeric" });
			calendarDays.innerHTML = "";

			for (let i = 0; i < startDay; i++) {
				calendarDays.innerHTML += `<div></div>`;
			}

			for (let day = 1; day <= lastDay.getDate(); day++) {
				const dateObj = new Date(year, month, day);
				const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
				const dayEvents = events[dateStr] || [];

				let classes = [];
				if (dateObj.getTime() < today.getTime()) {
					classes.push('disabled');
				}
				if (
					dateObj.getDate() === today.getDate() &&
					dateObj.getMonth() === today.getMonth() &&
					dateObj.getFullYear() === today.getFullYear()
				) {
					classes.push('today');
				}
				if (selectedDate === dateStr) {
					classes.push('selected');
				}

				let html = `<div class="${classes.join(' ')}" data-date="${dateStr}"><strong>${day}</strong>`;
				dayEvents.forEach(e => {
					html += `<div class="event">${e}</div>`;
				});
				html += `</div>`;

				calendarDays.innerHTML += html;
			}

			attachDateClickListeners();
		}

		function attachDateClickListeners() {
			const dateDivs = document.querySelectorAll("#calendarDays div:not(.disabled)");
			const bookedSlots = @json($bookedSlots);

			dateDivs.forEach(div => {
				div.addEventListener("click", function () {
					selectedDate = this.getAttribute("data-date");
					document.getElementById("selectedDateInput").value = selectedDate;
					renderCalendar(currentDate);
					// alert(selectedDate);
					// alert(bookedSlots);
					generateTimeSlots(1, 23, 30, selectedDate, bookedSlots); //  added params
				});
			});
		}


		prev.addEventListener("click", () => {
			currentDate.setMonth(currentDate.getMonth() - 1);
			renderCalendar(currentDate);
		});

		next.addEventListener("click", () => {
			currentDate.setMonth(currentDate.getMonth() + 1);
			renderCalendar(currentDate);
		});

		renderCalendar(currentDate);

		// here is time slot list 


		document.addEventListener("DOMContentLoaded", function () {
			const bookedSlots = @json($bookedSlots);
        //   console.log(bookedSlots);
			const today = new Date().toISOString().split('T')[0];
			selectedDate = today;
			document.getElementById("selectedDateInput").value = today;
			generateTimeSlots(1, 23, 30, today, bookedSlots);
		});


		function generateTimeSlots(startHour = 1, endHour = 23, interval = 30, selectedDate = null, bookedSlots = []) {
			const select = document.getElementById("timeSlot");
			select.innerHTML = '<option value="">Select a time slot (IST)</option>';

			const now = new Date();
			const isToday = selectedDate === now.toISOString().split("T")[0];

			for (let hour = startHour; hour <= endHour; hour++) {
				for (let min = 0; min < 60; min += interval) {
					const timeObj = new Date();
					timeObj.setHours(hour, min, 0, 0);

					// const timeValue = timeObj.toTimeString().slice(0, 5); // "HH:MM"
					// const timeValue = String(hour).padStart(2, '0') + ':' + String(min).padStart(2, '0');

					const hourStr = String(hour).padStart(2, '0');
					const minStr = String(min).padStart(2, '0');
					const timeValue = `${hourStr}:${minStr}`; // "14:30"

					const display = timeObj.toLocaleTimeString([], {
						hour: '2-digit',
						minute: '2-digit',
						hour12: false
					});

					// const fullDateTime = `${selectedDate} ${timeValue}:00`;
					const fullDateTime = `${selectedDate} ${hourStr}:${minStr}:00`;

					const option = document.createElement("option");
					option.value = timeValue;
					//  alert(fullDateTime);
				// 	console.log("Checking fullDateTime:", fullDateTime);
				// 	console.log("bookedSlots includes:", bookedSlots.includes(fullDateTime));
					// Disable if it's past time today
					if (isToday && new Date(`${selectedDate}T${timeValue}`) <= now) {
						option.disabled = true;
						// option.textContent = `${display} (Past)`;
						option.textContent = `${display}`;
					}
					// Disable if already booked
					else if (bookedSlots.includes(fullDateTime)) {
						//alert('run');
						option.disabled = true;
						option.textContent = `${display} (Not Available)`;
					}
					// Else normal
					else {
						option.textContent = display;
					}

					select.appendChild(option);
				}
			}
		}
    
    
    // here proceed hire 
    
    	$(document).on('click', '.proceed-booking-btn', function (e) {
			e.preventDefault();

            let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
    
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			let time = $('#timeSlot').val();
			let day = $('#selectedDateInput').val();
			//  alert(day); 
			//  alert(time);
			let isLoggedIn = $('#isLoggedIn').val();
			
			let price = $(this).data('price');

			if (isLoggedIn == 0) {

				let email = $('#email').val();  // Get email
				let mobile = $('#mobile').val();  // Get mobile

				// Basic validation
				if (!email || !mobile) {
					Swal.fire("Missing Info", "Please complete your details by entering your email ID and contact information.", "warning");
				        $btn.prop('disabled', false).text('Book Now');
				} else {
					RegisteUsername(email, mobile, price, time, day);
				}

			} else {
				createRazorpayOrder(price, time, day, isLoggedIn); // Call the order function
			}

		});

		// register user if not login 

		function RegisteUsername(email, mobile, price, time, day) {
		    let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
            
            PleaseWait();
            
			$.ajax({
				url: "{{ url('registeration') }}",
				type: 'POST',
				data: {
					email: email,
					mobile: mobile
				},
				success: function (response) {
				    Swal.close();
					if(response.success) {
						  let userId = response.data?.user_id || null;
						//   alert('run razorpay now 1');

						// Swal.fire("Success", response.message, "success");

						// Swal.fire("Success", res.message, "success").then(() => {
						// 	createRazorpayOrder(sow_id, price, time, day, userId);
						// });

						Swal.fire({
							title: "Info",
							text: response.message,
							icon: "success",
							confirmButtonText: "Processing...", // Change button text here
							timer: 3000,
    						timerProgressBar: true,
						}).then(() => {
							createRazorpayOrder(price, time, day, userId);
						});


						// callback(true, userId); // Continue to Razorpay
					} else {
						if (response.message === "Your account already registered.") {
						  let userId = response.data?.user_id || null;
							// Swal.fire("Info", response.message, "info");
							// alert('run razorpay now 2');

							// Swal.fire("Info", response.message, "success").then(() => {
							// 	createRazorpayOrder(sow_id, price, time, day, userId);
							// });

							Swal.fire({
								title: "Info",
								text: response.message,
								icon: "success",
								confirmButtonText: "PleaseWait...",  // Change button text here
								timer: 3000,
								timerProgressBar: true,
							}).then(() => {
								createRazorpayOrder(price, time, day, userId);
							});
						
							// callback(true, UserId); // Still proceed to Razorpay
						} else {
				// 			alert('run razorpay now 3');
							Swal.fire("Error", response.message || "Registration failed.", "error");
							callback(false);
							
							$btn.prop('disabled', false).text('Book Now');
						}
					}
				},
				error: function (xhr, status, error) {
					console.error(error);
					Swal.fire("Error", "Something went wrong. Try again.", "error");
					callback(false);
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}

		//  STEP 1: Call this to begin the Razorpay process
		function createRazorpayOrder(price, time, day, user_id) {
			PleaseWait();

            let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');
            
			$.ajax({
				url: "{{ route('razorpay.order.create') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					price: price
				},
				success: function (orderData) {
					Swal.close();

					let options = {
						key: orderData.razorpay_key,
						amount: orderData.amount,
						currency: orderData.currency,
						name: "Elyvato",
						description: "Call Sechdule Payment",
						image: "https://elyvato.com/front/assets/images/elyvato-header-logo.png",
						order_id: orderData.order_id,
						handler: function (response) {
							storeBooking(response, price, time, day, user_id); 
						},
						theme: {
							color: "#8c32f6"
						}
					};

					let rzp = new Razorpay(options);
					rzp.open();
				},
				error: function () {
					Swal.close();
					Swal.fire("Error", "Failed to create order.", "error");
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}



		// STEP 2: Call this after Razorpay success
		function storeBooking(response, price, time, day, user_id) {
			PleaseWait();
			
			let $btn = $('.proceed-booking-btn');
            $btn.prop('disabled', true).text('Processing...');

			$.ajax({
				url: "{{ route('user.proceed.hire') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					
					price: price,
					time: time,
					day: day,
					user_id:user_id,
					razorpay_payment_id: response.razorpay_payment_id,
					razorpay_order_id: response.razorpay_order_id,
					razorpay_signature: response.razorpay_signature
				},
				success: function (res) {
					Swal.close();
					Swal.fire("Success", res.message, "success").then(() => {
						window.location.href = "{{ url('/booking-list') }}";
					});
				},
				error: function () {
					Swal.close();
					Swal.fire("Error", "Technical error!", "error");
					$btn.prop('disabled', false).text('Book Now');
				}
			});
		}
		
</script>
@endsection
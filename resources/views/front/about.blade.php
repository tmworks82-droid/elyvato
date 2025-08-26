@php
    $title = 'About Us - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection

@extends('layouts.front.app')

@section('pageContent')
<style>
	.owl-dots {
		display: flex;
		justify-content: center;
		position: absolute;
		bottom: 10px;
		width: 100%;
	}

.owl-dot:nth-child(n+4) {
    display: none;  /* Hide all dots starting from the 4th one */
}
</style>

{{-- ============================= breadcrumb section ============================= --}}
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="d-none">
    <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="https://elyvato.com" itemprop="item">
                <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>

        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="#" class="breadcrumb-nlink" itemprop="item">
                <span itemprop="name">About</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
    </ol>
</nav>

{{-- ============================= hero section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2 mb-3 mb-md-0">
                <img src="{{ asset('front/assets/images/enterprices_about.jpg')}}" alt="About Elyvato" class="w-100 img-fluid rounded-2">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold mb-3 mb-md-4">About Elyvato</h1>
				<p class="mb-0">At Elevayto, we're a collective of elite, passionate professionals who deeply understand the power of great content. With experience serving over 100+ clients across startups, agencies, and global brands, we've seen firsthand the challenges in finding reliable, high-quality talent fast. That's the gap we're solving. Elevayto ensures faster, smarter, and more efficient hiring. Whether it's content, design, marketing, or development, connects businesses with India's top freelance talent-vetted, dependable, and globally aligned. We don't just offer freelancers, we deliver outcomes you can count on.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================= information section ============================= --}}
<section class="section-padding-top section-padding-bottom">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 pe-lg-5 mb-3 mb-lg-0">
				<div class="row">
					<div class="col-md-6 mb-3 mb-md-0 d-none d-md-block">
						<img src="{{ asset('front/assets/images/freelancer-process2.png') }}" alt="freelancer process" class="img-fluid rounded">
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
								<img src="{{ asset('front/assets/images/team-process2.png') }}" alt="team process" class="w-100 img-fluid rounded">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<h2 class="fw-bold mb-3 mb-md-4">Join The Trusted, Leading Business Solution</h2>
				<p class="mb-2">At Elyvato, we understand that businesses need more than just freelancers — they need accountability, quality, and speed. That’s why we’ve built a homegrown content marketplace where you can find pre-vetted, skilled professionals who deliver on time and meet your exact standards.</p>
				<p class="mb-2">Our platform is designed to make your life easier. We bridge you to India’s top creators, writers, developers, and designers, while ensuring seamless processes, transparent pricing, and secure payments. You get assured quality, clear communication, and a system that works for your deadlines and expectations.</p>
			</div>
		</div>
	</div>
</section>

{{-- ============================= mission section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2 mb-3 mb-md-0">
                <img src="{{ asset('front/assets/images/home-enterprise2.png')}}" alt="About Elyvato" class="w-100 img-fluid rounded-2">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3 mb-md-4">Our Mission</h2>
				<p class="mb-2">At Elyvato, we believe content is more than just text and visuals — it's the driving force behind every successful business. In a world where attention is fleeting and quality is non-negotiable, we’re building a platform that redefines how content is created, managed, and delivered.</p>
				<p class="mb-2">With a deep focus on speed, reliability, and local relevance, Elyvato provides an end-to-end solution for all your content needs — from strategy to execution. Our curated network of skilled professionals, proven processes, and commitment to excellence make us the trusted partner for brands that demand results.</p>
				<p class="mb-2">Choose Elyvato — where your search for dependable, high-quality content ends, and your growth journey begins.</p>
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
							<img src="{{ asset('front/assets/images/client/' . $client . '.png')}}" alt="{{ $client }}" @if($k==0 || $k==7) style="filter:grayscale(100%) brightness(0.2);" @endif @if($k==6) style="filter:grayscale(100%) brightness(0.9);" @endif  @if($k==8) style="filter:grayscale(100%) brightness(0.4);" @endif @if($k==4) style="filter:grayscale(5%) brightness(10.0);" @endif  class="{{ $k }} img-fluid client-slider-image w-100">
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
{{-- ============================= Testimonials section ============================= --}}
<section class="py-lg-2">
    <div class="container">
        <div class="row about-testimonial-section px-4 py-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="h-100 d-flex flex-column justify-content-between gap-3">
					<h2 class="text-white">
						<span class="mb-2 fw-semibold fs-5">Innovate.</span><br/>
						<span class="mb-2 fw-semibold fs-4">Elevate.</span><br/>
						<span class="mb-2 fw-semibold fs-3">Succeed.</span>
					</h2>
					<div class="d-inline">
						<a href="{{ url('services') }}" class="btn btn-outline-light">View All Services</a>
					</div>
				</div>
            </div>
            <div class="col-md-6">
				<div class="p-3 p-lg-4 rounded-2 border bg-white">
					<h3 class="fs-4 fw-bold mb-3">Here our customers experience</h3>
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
									</ul>
									<!-- Content -->
									<p class="fw-medium">The team understood our niche very well. A few delays, but final content was spot on.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										
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
									</ul>
									<!-- Content -->
									<p class="fw-medium">Video editors were top-notch. Only reason for 4 stars is a slight lag in preview delivery.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
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
										<li class="d-inline me-0"><i class="ri-star-half-fill text-warning"></i></li>
									</ul>
									<!-- Content -->
									<p class="fw-medium">Elyvato understood the requirements quickly and gave us practical solutions. It is only possible when the team is already expert with community product strategy</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										
										<div>
											<p class="mb-0">By Steve Zhou.</p>
											<p class="mb-0 text-sm"> Senior BD Manager, BIGO</p>
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
									<p class="fw-medium">Elyvato team is being run by a bunch of responsible and professional people. They've been available for me 24x7. It's a go-to company for startups like us.</p>
								</div>

								<div class="card-footer border-0 bg-transparent p-0">
									<!-- Avatar -->
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0">By Donny Singh</p>
											<p class="mb-0 text-sm">APT Consultancy, Canada</p>
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
        </div>
    </div>
</section>
{{-- ============================= faqs section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xl-8">
                <h2 class="fw-semibold mb-3 mb-lg-4 fs-4 text-center">Frequently Asked Questions</h2>
				<div class="accordion" id="faqaccordion" itemscope itemtype="https://schema.org/FAQPage">
						

					<div class="accordion" id="faqaccordion">
						@foreach ($faqs as $index => $faq)
							@php
								$hash = chr(97 + $index); // a, b, c...
								$isFirst = $index === 0;
							@endphp
							<div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
								<h3 class="accordion-header" id="heading{{ $hash }}">
									<button class="accordion-button {{ $isFirst ? '' : 'collapsed' }} fw-semibold"
											type="button"
											data-bs-toggle="collapse"
											data-bs-target="#collapse{{ $hash }}"
											aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
											aria-controls="collapse{{ $hash }}"
											itemprop="name">
										{{ $faq->question }}
									</button>
								</h3>
								<div id="collapse{{ $hash }}"
									class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
									aria-labelledby="heading{{ $hash }}"
									data-bs-parent="#faqaccordion"
									itemscope itemprop="acceptedAnswer"
									itemtype="https://schema.org/Answer">
									<div class="accordion-body" itemprop="text">
										{{ $faq->answer }}
									</div>
								</div>
							</div>
						@endforeach
					</div>
                </div>
            </div>
        </div>
    </div>
</section>

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

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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
                    }
                }
            });
        });

		
    </script>
@endsection

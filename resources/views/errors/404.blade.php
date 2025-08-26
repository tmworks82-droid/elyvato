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

{{-- ============================= 404 page ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="ratio ratio-16x9">
                    <img src="{{ asset('front/assets/images/404-01.png')}}" alt="Nothing Found" class="h-100 object-fit-contain">
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold mb-3 mb-md-4">404</h1>
				<h2 class="mb-2 fs-4 text-main fw-bold">Something went wrong.</h2>
				<p class="mb-3 mb-md-4">We couldn't find the page you are looking for.</p>
                <a href="/" class="btn btn-main">
                    <span class="d-flex align-items-center gap-2">Return to Home <i class="ri-corner-up-left-fill"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection


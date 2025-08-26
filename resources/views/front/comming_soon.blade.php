@php
    $title = $title;
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
     $featuredImage = '/front/assets/images/elyvato-header-logo.png';
@endphp




@extends('layouts.front.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    
 <style>
        /* * Basic Reset & Global Styles
         */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #000000ff;
            /* overflow: hidden; Prevents scrollbars from appearing */
        }

        /* * Main container for centering content
         * Uses Flexbox to perfectly center the content both vertically and horizontally.
         */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100%;
            padding: 0 20px;
        }

        /* * Content styling
         */
        .content {
            max-width: 600px;
            animation: fadeIn 2s ease-in-out;
        }

        h1 {
            font-size: 3rem; /* Responsive font size */
            font-weight: 700;
            margin-bottom: 1rem;
            color: #000000ff;
            letter-spacing: 2px;
        }

        p {
            font-size: 1.2rem; /* Responsive font size */
            line-height: 1.6;
            margin-bottom: 0;
            color: #000000ff;
        }

        /* * Media query for smaller screens
         * Adjusts font sizes for better readability on mobile devices.
         */
        @media (max-width: 600px) {
            h1 {
                font-size: 2.5rem;
            }
            p {
                font-size: 1rem;
            }
        }

        /* * Simple fade-in animation for the content
         */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

@endsection
@section('pageContent')



{{-- ============================= login card section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="content">
            <h1>Comming Soon</h1>
            <h3>Your Next Hire is Moments Away</h3>
            <p>We're putting the final touches on our new Instant Hire platform. Get ready for a seamless, faster way to connect with top talent. The future of recruitment is almost here!</p>
        <a href="{{url('/')}}" class="btn btn-main mt-5 mb-5">Go Back</a>
        </div>
        
    </div>
</section>


@endsection

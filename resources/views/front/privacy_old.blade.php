@php
    $title = 'Privacy Policy - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.app')

@section('pageContent')

{{-- ============================= hero section ============================= --}}
<section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h1 class="mb-2 fw-bold">Privacy Policy</h1>
                <h2 class="fs-4 fw-medium text-muted mb-3">Last updated on July 2025</h2>
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
                                <span itemprop="name">Privacy Policy</span>
                            </a>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

{{-- ============================= Content section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xl-8">
                <h2 class="fs-4 fw-bold mb-2">Introduction</h2>
                <p class="mb-2">At Elyvato, we are fully committed to safeguarding your privacy and ensuring that your personal information is protected. This Privacy Policy explains how we collect, use, store, and disclose your personal data when you use our website, mobile applications, and associated services.</p>
                <p class="mb-3 mb-lg-4">By accessing or using our platform, you agree to the terms described in this policy.</p>
                <h2 class="fs-4 fw-bold mb-2">1. Information We Collect</h2>
                <p class="mb-2">We collect information to provide you with seamless service and ensure the platform operates effectively. The types of information we collect include:</p>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li><b>Personal Information:</b> Full name, email address, phone number, billing address, profile picture, date of birth, etc.</li>
                    <li><b>Professional Information:</b> Skills, work experience, portfolio, certifications, languages spoken</li>
                    <li><b>Technical Information:</b> IP address, browser type, device information, login timestamps, geographic location.</li>
                    <li><b>Usage Data:</b> Pages visited, time spent on the platform, interactions with other users, communication logs.</li>
                    <li><b>Cookies and Tracking:</b> We use cookies and similar tracking technologies to improve your experience, analyze traffic, and deliver personalized content.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">2. How We Use Your Information</h2>
                <p class="mb-2">Your information is used to:</p>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>Facilitate seamless project assignments between clients and freelancers.</li>
                    <li>Process payments securely and efficiently.</li>
                    <li>Provide customer support and address queries.</li>
                    <li>Send important platform updates, promotional offers, and policy changes.</li>
                    <li>Prevent fraud, identity theft, and unauthorized access.</li>
                    <li>Improve our services through analytics and user feedback.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">3. Information Sharing</h2>
                <p class="mb-2">We <b>never sell your personal data</b> to third parties. We may share your information with:</p>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>Payment gateways and financial service providers for processing transactions.</li>
                    <li>Third-party service providers for technical support, analytics, and fraud detection.</li>
                    <li>Law enforcement or regulatory bodies if required by Indian law.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">4. Data Protection & Security</h2>
                <p class="mb-3 mb-lg-4">We employ strong security protocols, including SSL encryption, secure servers, and periodic security audits. However, no system is completely immune from risks. We encourage users to maintain secure passwords and report suspicious activities.</p>
                <h2 class="fs-4 fw-bold mb-2">5. User Rights</h2>
                <p class="mb-2">You have the right to:</p>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>Request access to your stored data.</li>
                    <li>Update or correct your information.</li>
                    <li>Request account deletion (subject to regulatory and contractual obligations).</li>
                </ul>
                <p class="mb-3 mb-lg-4">For such requests, please write to us at <b>support@elyvato.com</b>.</p>
                <h2 class="fs-4 fw-bold mb-2">6. Updates to this Policy</h2>
                <p class="mb-0">We may update this Privacy Policy from time to time. Any changes will be notified to you via email or platform notifications. Continued use of the platform after such changes constitutes your acceptance of the new policy.</p>
            </div>
        </div>
    </div>
</section>


@endsection

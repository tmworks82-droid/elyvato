@php
    $title = 'Terms of Services - Elyvato';
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
                <h1 class="mb-2 fw-bold">Terms of Services</h1>
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
                                <span itemprop="name">Terms of Services</span>
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
                <p class="mb-3 mb-lg-4">Welcome to Elyvato. By using our website, mobile apps, or services, you agree to the following terms and conditions. Please read them carefully.</p>
                <h2 class="fs-4 fw-bold mb-2">1. User Eligibility</h2>
                <p class="mb-3 mb-lg-4">You must be at least <b>15 years old</b> to use our platform. By creating an account, you confirm that all information provided is accurate and up-to-date.</p>
                <h2 class="fs-4 fw-bold mb-2">2. Account Responsibilities</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>You are solely responsible for maintaining the confidentiality of your login credentials.</li>
                    <li>You agree to be held accountable for all activities that occur under your account.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">3. Platform Rules</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>All projects, payments, and communications must occur within Elyvato.</li>
                    <li>Direct transactions outside the platform are strictly prohibited and may lead to account termination.</li>
                    <li>You may not upload or share any content that is unlawful, abusive, defamatory, discriminatory, or infringes upon intellectual property rights.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">4. Payment and Fees</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>All payments must be made via the platform's approved payment methods.</li>
                    <li>Freelancers will receive payments after the platform’s service fee and applicable taxes (such as GST) are deducted.</li>
                    <li>Payment timelines will be governed by our escrow and release policies.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">5. Dispute Resolution</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>In case of a disagreement between a freelancer and a client, <b>Elyvato</b> offers a structured dispute resolution process.</li>
                    <li>Both parties are required to participate in good faith.</li>
                    <li>If unresolved, the matter will be referred to binding arbitration under the <b>Arbitration and Conciliation Act, 1996 (India)</b>.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">6. Intellectual Property</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>Unless otherwise agreed, all work produced by freelancers is transferred to the client upon full payment.</li>
                    <li>Freelancers retain the right to display completed work in their portfolios unless the client specifically requests confidentiality.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">7. Termination of Services</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li>We reserve the right to suspend or terminate any account that violates our policies, terms, or applicable Indian laws.</li>
                    <li>Users can voluntarily close their accounts by contacting customer support.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">8. Limitation of Liability</h2>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li><b>Elyvato</b> is not liable for any direct, indirect, incidental, or consequential damages arising from the use of the platform.</li>
                    <li>We do not guarantee project outcomes or payment fulfillment beyond the agreed platform processes.</li>
                </ul>
                <h2 class="fs-4 fw-bold mb-2">9. Governing Law & Jurisdiction</h2>
                <ul class="mb-2 ps-3">
                    <li>These terms are governed by the laws of <b>India</b>.</li>
                    <li>Any disputes will fall under the exclusive jurisdiction of the courts in New Delhi, India.</li>
                </ul>
                <p class="mb-0">For any questions related to these terms, please contact us at support@elyvato.com</p>
            </div>
        </div>
    </div>
</section>


@endsection

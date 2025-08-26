@php
    $title = 'Privacy Policy - Elyvato';
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
                                <span itemprop="name">Privacy  Policy</span>
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
            {{--<div class="col-md-10 col-lg-9 col-xl-8">
                <h2 class="fs-4 fw-bold mb-2">Introduction</h2>
                <p class="mb-2">At Elyvato, we are fully committed to safeguarding your privacy and ensuring the protection of your personal information. This Privacy Policy outlines how we collect, use, store, and disclose your data when you access our website, mobile applications, and associated services (“Platform”).</p>
                <p class="mb-3 mb-lg-4">By using our platform, you consent to the practices described in this policy.</p>
                <h2 class="fs-4 fw-bold mb-2">1. Information We Collect</h2>

                <p class="mb-2">To provide seamless service, we may collect the following types of information:
                </p>
                <ul class="mb-3 mb-lg-4 ps-3">
                    <li><b>Personal Information:</b> Name, email address, phone number, billing address, profile picture, date of birth, etc.</li>
                    <li><b>Professional Information:</b> Skills, certifications, experience, portfolio links, language proficiencies.</li>
                    <li><b>Technical Information:</b>  IP address, browser type, device ID, OS details, login timestamps, geographic location.</li>
                    <li><b>Usage Data:</b> User interactions, time spent on platform, projects viewed, communication logs.</li>
                    <li><b>Cookies and Tracking:</b> We use cookies and similar tools to enhance user experience, analyze performance, and deliver personalized services.</li>
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
            </div>--}}

            <div class="col-md-10 col-lg-9 col-xl-8">
    <h2 class="fs-4 fw-bold mb-2">Privacy Policy</h2>
    <p class="mb-2">At Elyvato, we are fully committed to safeguarding your privacy and ensuring the protection of your personal information. This Privacy Policy outlines how we collect, use, store, and disclose your data when you access our website, mobile applications, and associated services (“Platform”).</p>
    <p class="mb-3 mb-lg-4">By using our platform, you consent to the practices described in this policy.</p>

    <h2 class="fs-4 fw-bold mb-2">1. Information We Collect</h2>
    <p class="mb-2">To provide seamless service, we may collect the following types of information:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li><b>Personal Information:</b> Name, email address, phone number, billing address, profile picture, date of birth, etc.</li>
        <li><b>Professional Information:</b> Skills, certifications, experience, portfolio links, language proficiencies.</li>
        <li><b>Technical Information:</b> IP address, browser type, device ID, OS details, login timestamps, geographic location.</li>
        <li><b>Usage Data:</b> User interactions, time spent on platform, projects viewed, communication logs.</li>
        <li><b>Cookies & Tracking Technologies:</b> We use cookies and similar tools to enhance user experience, analyze performance, and deliver personalized services.</li>
    </ul>
    <p class="mb-3 mb-lg-4">For a detailed explanation of cookies, refer to our Cookies Policy.</p>

    <h2 class="fs-4 fw-bold mb-2">2. Legal Basis for Processing</h2>
    <p class="mb-2">We collect and process your data under one or more of the following legal grounds:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Your explicit consent (e.g., newsletter signup, marketing communication).</li>
        <li>To fulfill our contractual obligations (e.g., project transactions).</li>
        <li>Our legitimate business interests, such as platform improvement and fraud detection.</li>
        <li>Compliance with legal obligations, such as tax and audit requirements.</li>
    </ul>

    <h2 class="fs-4 fw-bold mb-2">3. How We Use Your Information</h2>
    <p class="mb-2">We use your data to:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Facilitate secure, efficient project assignments.</li>
        <li>Verify your identity and ensure profile authenticity.</li>
        <li>Process payments and generate invoices.</li>
        <li>Send important updates, feature alerts, and policy revisions.</li>
        <li>Offer customer support and resolve complaints.</li>
        <li>Analyze user behavior to improve platform functionality.</li>
        <li>Prevent abuse, identity theft, and fraudulent activities.</li>
    </ul>

    <h2 class="fs-4 fw-bold mb-2">4. Information Sharing</h2>
    <p class="mb-2">We do not sell your personal data. We may share your information with:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Payment processors and financial institutions to complete transactions.</li>
        <li>Third-party vendors (analytics, infrastructure providers) bound by strict confidentiality.</li>
        <li>Legal authorities when required by applicable Indian laws or court orders.</li>
    </ul>

    <h2 class="fs-4 fw-bold mb-2">5. Children’s Privacy</h2>
    <p class="mb-3 mb-lg-4">Our platform is not intended for individuals under 18 years of age. We do not knowingly collect personal data from minors. If we learn that a child has submitted personal information, we will delete it promptly.</p>

    <h2 class="fs-4 fw-bold mb-2">6. Data Retention & Deletion</h2>
    <p class="mb-2">We retain your data only as long as necessary to:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Fulfill contractual or legal obligations.</li>
        <li>Provide access to your account and transaction history.</li>
        <li>Comply with applicable laws (e.g., tax or audit requirements).</li>
    </ul>
    <p class="mb-3 mb-lg-4">Data will be permanently deleted after 180 days of account inactivity or upon a verified deletion request, subject to regulatory obligations.</p>

    <h2 class="fs-4 fw-bold mb-2">7. User Rights</h2>
    <p class="mb-2">As a user, you have the right to:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Access your stored data.</li>
        <li>Correct or update inaccurate information.</li>
        <li>Request account deletion.</li>
        <li>Withdraw consent for data processing at any time.</li>
    </ul>
    <p class="mb-3 mb-lg-4">To exercise these rights, email: <a href="mailto:support@elyvato.com">support@elyvato.com</a> with the subject line “Data Request – [Your Name]”.</p>

    <h2 class="fs-4 fw-bold mb-2">8. Data Security</h2>
    <p class="mb-3 mb-lg-4">We use advanced industry standards, including:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>SSL encryption</li>
        <li>Role-based access controls</li>
        <li>Secure server infrastructure</li>
        <li>Regular penetration tests and data audits</li>
    </ul>
    <p class="mb-3 mb-lg-4">Despite our efforts, no system is entirely risk-free. We recommend users use strong passwords and avoid sharing login credentials.</p>

    <h2 class="fs-4 fw-bold mb-2">9. Automated Decision-Making & Profiling</h2>
    <p class="mb-3 mb-lg-4">Elyvato may use automated systems to assign projects, recommend freelancers, or flag suspicious activity. These processes are designed to optimize efficiency but do not make legally binding decisions without human oversight.</p>

    <h2 class="fs-4 fw-bold mb-2">10. Third-Party Links</h2>
    <p class="mb-3 mb-lg-4">Our platform may contain links to third-party websites or services. We are not responsible for the privacy practices of these external sites. Please review their respective privacy policies before sharing personal information.</p>

    <h2 class="fs-4 fw-bold mb-2">11. Cookies Policy</h2>
    <p class="mb-2">We use cookies to remember user preferences, track platform performance, and personalize content. Users can manage or disable cookies through browser settings.</p>
    <p class="mb-3 mb-lg-4">For a full list of cookies and their functions, visit our <a href="/cookies-policy">Cookies Policy Page</a>.</p>

    <h2 class="fs-4 fw-bold mb-2">12. Grievance Redressal & Complaints</h2>
    <p class="mb-3 mb-lg-4">If you have concerns regarding data usage or privacy violations, you can contact our Grievance Officer:</p>
    <p class="mb-3 mb-lg-4">Grievance team/Data Protection Team<br>
    Email: <a href="mailto:grievance@elyvato.com">grievance@elyvato.com</a><br>
    Address: TMW Pvt. Ltd., 302, H-160, Sector 63, Noida, UP – 201309, India</p>
    <p class="mb-3 mb-lg-4">Complaints will be acknowledged within 48 hours and resolved within 30 days as per Indian IT Rules.</p>

    <h2 class="fs-4 fw-bold mb-2">13. Data Breach Notification</h2>
    <p class="mb-3 mb-lg-4">In the event of a data breach that may affect your personal information, we will notify impacted users within 72 hours of detection, along with actionable instructions to mitigate risk.</p>

    <h2 class="fs-4 fw-bold mb-2">14. User Responsibilities</h2>
    <p class="mb-3 mb-lg-4">As a user, you are responsible for:</p>
    <ul class="mb-3 mb-lg-4 ps-3">
        <li>Providing accurate and updated information.</li>
        <li>Maintaining the confidentiality of your account credentials.</li>
        <li>Reporting suspicious activities immediately.</li>
    </ul>

    <h2 class="fs-4 fw-bold mb-2">15. Updates to this Policy</h2>
    <p class="mb-0">We may update this policy periodically. Users will be notified via email or dashboard alerts. Continued use of Elyvato after such changes implies acceptance of the revised policy.</p>

    <p class="mb-3 mb-lg-4">If you have questions, please contact us at <a href="mailto:support@elyvato.com">support@elyvato.com</a>.</p>
    <p class="mb-3 mb-lg-4">Effective Date: July 24, 2025</p>
</div>


        </div>
    </div>
</section>


@endsection

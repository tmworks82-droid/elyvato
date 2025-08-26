@php
    $title = 'Contact - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')

@section('pageContent')

{{-- ============================= hero and form section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xl-8">
                <div class="ratio ratio-16x9 contact-hero-image-wrapper z-n1">
                    <img src="{{ asset('front/assets/images/team-process.png')}}" alt="contact elyvato" class="w-100 object-fit-cover rounded-2">
                </div>
                <div class="z-1 px-2 px-md-3 px-lg-5">
                    <div class="bg-white rounded-2 border shadow-sm p-3 p-md-4 p-lg-5">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a href="https://elyvato.com" itemprop="item">
                                        <span itemprop="name">Home</span>
                                    </a>
                                    <meta itemprop="position" content="1" />
                                </li>
                                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a href="#" class="breadcrumb-nlink" itemprop="item">
                                        <span itemprop="name">Contact</span>
                                    </a>
                                    <meta itemprop="position" content="2" />
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-3 fs-3 fw-bold">Keep In Touch With Elyvato Team</h1>
                        <p class="pb-3 pb-md-5 mb-3 mb-md-5 border-bottom">You can reach us anytime via <span class="text-accent">support@elyvato.com</span></p>
                          <div id="formMsg"></div>
                        <form id="contactForm">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control focus-shadow-none" name="name" id="name" placeholder="John">
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control focus-shadow-none" name="email" id="email" placeholder="name@website.com">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control focus-shadow-none" name="phone" id="phone" placeholder="1234567890">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="mb-3">
                               
                                <label for="service" class="text-sm text-muted mb-1">Service</label>
                                <select class="form-select focus-shadow-none" id="service" name="service">
                                    @foreach (Service() as $index => $category)
                                        <option value="{{ $index }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="message" name="message" style="height:100px"></textarea>
                                <label for="message">Message</label>
                            </div>
                             <div class="g-recaptcha" data-sitekey="6LdE8IwrAAAAAJzn_hILFenKmsO99WDOMzVRt1Wf"></div>

                            <input type="submit" class="btn btn-main btn-md-large mt-4" value="Send Message"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================= Contact info cards section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4 mb-3 mb-lg-0">
                <div class="h-100 border rounded-2 p-3 p-lg-4 bg-light">
                    <i class="ri-map-pin-line text-main fs-3"></i>
                    <h2 class="fs-5 fw-bold mt-3 mb-3 mb-lg-4">Office Address</h2>
                    <p class="mb-2 fw-bold">India</p>
                    <p class="mb-0">302, BSI Business Park, H-160, Sector 63, Noida, India, 201301</p>
                </div>
            </div>
            
            <div class="col-md-5 col-lg-4 mb-3 mb-lg-0">
                <div class="h-100 border rounded-2 p-3 p-lg-4 bg-light">
                    <i class="ri-mail-unread-line text-main fs-3"></i>
                    <h2 class="fs-5 fw-bold mt-3 mb-3 mb-lg-4">Email Us</h2>
                    <p class="mb-2">We're working hard and aim to respond to all inquiries within 24 hours.</p>
                    <p class="mb-0 text-accent">support@elyvato.com</p>
                </div>
            </div>
            
            <div class="col-md-5 col-lg-4">
                <div class="h-100 border rounded-2 p-3 p-lg-4 bg-light">
                    <i class="ri-phone-line text-main fs-3"></i>
                    <h2 class="fs-5 fw-bold mt-3 mb-3 mb-lg-4">Call Us</h2>
                    <p class="mb-2">Let's connect for a quick call and work toward a common goal!</p>
                    <p class="mb-0 text-accent">+(91) 92899 57538</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================= map location section ============================= --}}
<section class="w-100 overflow-hidden">
    <iframe class="contact-page-map" loading="lazy" src="https://maps.google.com/maps?q=Noida%2C%20Uttar%20Pradesh%2C%20India&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near" title="Noida, Uttar Pradesh, India" aria-label="Noida, Uttar Pradesh, India" style="width: 100%; height: 400px; border: 0;" allowfullscreen="">
    </iframe>
</section>


{{-- ============================= contact faqs section ============================= --}}
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

@endsection
@section('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        

        // here save contact us.
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('contact.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#formMsg').html('<p class="alert alert-success" role="alert">' + response.message + '</p>');
                    $('#contactForm')[0].reset();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let msg = '<ul style="color:red;">';
                    $.each(errors, function(key, value) {
                        msg += '<li>' + value[0] + '</li>';
                    });
                    msg += '</ul>';
                    $('#formMsg').html(msg);
                }
            });
        });
    </script>
@endsection

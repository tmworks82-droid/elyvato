@extends('layouts.front.app')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <!-- Breadcumb Sections -->

<section class="breadcumb-section wow fadeInUp mt40">
  <div class="cta-commmon-v1 cta-banner bgc-thm2 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
    <img class="left-top-img wow zoomIn" src="images/vector-img/left-top.png" alt="">
    <img class="right-bottom-img wow zoomIn" src="{{ asset('images/vector-img/right-bottom.png') }}" alt="">
    <div class="container">
      <div class="row">
        <div class="col-xl-5">
          <div class="position-relative wow fadeInUp" data-wow-delay="300ms">
            <h2 class="text-white">Contact us</h2>
            <p class="text mb0 text-white">
              We’d love to hear from you! For support, partnership, or general inquiries, please reach out to us:
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@php
  $breadcrumbs = [
    ['name' => 'Home', 'url' => url('/')],
    ['name' => 'Contact Us', 'url' => url('contact')],
  ];
@endphp

<x-breadcrumb-schema :breadcrumbs="$breadcrumbs" />


    <!-- Our Contact Info -->
    <section class="pt-0">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-6">
                    <div class="position-relative mt40">
                        <div class="main-title">
                            <h4 class="form-title mb25">Keep In Touch With Us.</h4>
                            <p class="text">Alternatively, you can fill out the contact form below, and our team will get back to you within 24-48 hours</p>
                        </div>
                        <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-tracking"></span></div>
                            <div class="details">
                                <h5 class="title">Address</h5>
                                <p class="mb-0 text">302, BSI Business Park, H-160, Sector 63, Noida, India, 201301</p>
                            </div>
                        </div>
                        <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-call"></span></div>
                            <div class="details">
                                <h5 class="title">Phone</h5>
                                <p class="mb-0 text">+(91) 92899 57538</p>
                            </div>
                        </div>
                        <div class="iconbox-style1 contact-style d-flex align-items-start mb30">
                            <div class="icon flex-shrink-0"><span class="flaticon-mail"></span></div>
                            <div class="details">
                                <h5 class="title">Email</h5>
                                <p class="mb-0 text">support@elyvato.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-page-form default-box-shadow1 bdrs8 bdr1 p50 mb30-md bgc-white">
                        <div id="formMsg"></div>

                        <h4 class="form-title mb25">Tell us about yourself</h4>
                        <p class="text mb30">We are always here to help you build and grow.</p>
                        <form id="contactForm" class="form-style1">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="John">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="John@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Service</label>
                                        <select name="service" id="service" class="form-control">
                                            @foreach (Service() as $service)
                                                <option value="{{ $service->name }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw500 mb10" for="">Messages</label>
                                        <textarea name="message" id="message" cols="30" rows="6" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <button type="submit" class="ud-btn btn-thm">Send Messages<i
                                                class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Map -->
    <section class="p-0 wow fadeInUp" data-wow-delay="300ms">
        <div class="mx-auto maxw1700 bdrs16 position-relative mx20-lg">
            <iframe class="contact-page-map" loading="lazy"
                src="https://maps.google.com/maps?q=Noida%2C%20Uttar%20Pradesh%2C%20India&t=m&z=14&output=embed&iwloc=near"
                title="Noida, Uttar Pradesh, India" aria-label="Noida, Uttar Pradesh, India"
                style="width: 100%; height: 400px; border: 0;" allowfullscreen>
            </iframe>

        </div>
    </section>

    <!-- Faq -->
    <section class="pb70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-title text-center">
                        <h2 class="title">Frequently Asked Questions</h2>
                        <!-- <p class="paragraph mt10">Lorem ipsum dolor sit amet, consectetur.</p> -->
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-8 mx-auto">
                    <div class="ui-content">
                        <div class="accordion-style1 faq-page">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item active">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne"> How can I contact the support team?</button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">You can reach us via email at <strong>support@Elyvato.com</strong>  or call us at <strong>+91 92899 57538.</strong>  We aim to respond within 24-48 business hours.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">What should I do if I face a technical issue?</button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">If you experience any technical glitches or payment issues, please write to us at <strong>support@elyvato.com </strong> with detailed screenshots and account information. Our team will prioritize your request.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">Where is your office located?</button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">Our head office is located at Noida, India. We primarily operate online but welcome visits by prior appointment.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">How long does it take to receive a response?</button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">We usually respond to all queries within 24-48 hours (working days). For urgent concerns, please mark your email as "High Priority" in the subject line.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">Do you offer customer support in regional languages?</button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">Currently, we offer support in English and Hindi. We are working to add support for more regional languages soon to make our platform even more accessible.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
  $faq = [
    [
      'question' => 'How can I contact the support team?',
      'answer' => 'You can reach us via email at <strong>support@Elyvato.com</strong> or call us at <strong>TMW NUMBER WA WALA DAALO.</strong> We aim to respond within 24-48 business hours.'
    ],
    [
      'question' => 'What should I do if I face a technical issue?',
      'answer' => 'If you experience any technical glitches or payment issues, please write to us at <strong>support@elyvato.com</strong> with detailed screenshots and account information. Our team will prioritize your request.'
    ],
    [
      'question' => 'Where is your office located?',
      'answer' => 'Our head office is located at Noida, India. We primarily operate online but welcome visits by prior appointment.'
    ],
    [
      'question' => 'How long does it take to receive a response?',
      'answer' => 'We usually respond to all queries within 24-48 hours (working days). For urgent concerns, please mark your email as "High Priority" in the subject line.'
    ],
    [
      'question' => 'Do you offer customer support in regional languages?',
      'answer' => 'Currently, we offer support in English and Hindi. We are working to add support for more regional languages soon to make our platform even more accessible.'
    ],
  ];
@endphp

<x-faq-schema :faq="$faq" />


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // alert('run');
            $('.header-nav.nav-homepage-style').addClass('stricky-fixed');
        });

        $(window).scroll(function() {
            if ($(this).scrollTop() > 90) {
                $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
            } else {
                $('.header-nav.nav-homepage-style').addClass('stricky-fixed slideInDown');
            }
        });

        // here save contact us.
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('contact.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#formMsg').html('<p style="color:green;">' + response.message + '</p>');
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

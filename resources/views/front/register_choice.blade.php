@php
    $title = 'Register - Elyvato';
    $metaDescription = 'Explore Elyvato - your scalable content marketing partner for videos, creatives, and performance-driven brand storytelling.';
    $robotsMeta = 'index, follow';
    $canonical = 'https://elyvato.com';
    $featuredImage = '/images/tmw-team.JPG';
@endphp




@extends('layouts.front.app')
@section('styles')
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">-->
@endsection
@section('pageContent')

<style>



 .role-body {
    background: #8c32f6;
    transition: background-color 0.3s ease;
  }

  /* When the whole card is hovered */
  .role-card:hover .role-body {
    background-color: #8c32f6 !important;
  }


.btn-submin {
  background-color: transparent;   /* default (outline look) */
  color: #fff;
  border: 2px solid #fff;
  transition: all 0.3s ease;
}

.btn-submin:hover {
  background-color: #f97a00;  /* orange background on hover */
  border-color: #f97a00;      /* match border with background */
  color: #fff;                /* keep text white */
}


 .role-card {
    overflow: hidden; /* prevents zoom from spilling out */
  }

  .role-img {
    transition: transform 0.4s ease;
  }

  .role-card:hover .role-img {
    transform: scale(0.9); /* zoom effect */
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
                <span itemprop="name">Register</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
    </ol>
</nav>

{{-- ============================= Register card section ============================= --}}
{{-- <section class="section-padding-top section-padding-bottom bg-light">
    <div class="container">
       <div class="row justify-content-center">
  <div class="col-sm-6">
    <div class=" bg-white">
      <div class="card-body p-4 text-center">

        <h4 class="mb-4">Join as a client or freelancer</h4>

        <div class="d-flex justify-content-center gap-3 mb-4">
          <!-- Client Option -->
          <label class="option-card">
            <input type="radio" name="role" value="client" checked>
            <div class="option-content">
              <i class="bi bi-briefcase mb-2" style="font-size:24px;"></i>
              <p class="mb-0 fw-bold">Register as a client, hire for work</p>
            </div>
          </label>

          <!-- Freelancer Option -->
          <label class="option-card">
            <input type="radio" name="role" value="freelancer">
            <div class="option-content">
              <i class="bi bi-laptop mb-2" style="font-size:24px;"></i>
              <p class="mb-0 fw-bold">Register as a freelancer</p>
            </div>
          </label>
        </div>

        <!-- Join Button -->
        <a id="joinLink" href="/register" class="btn btn-main btn-lg w-50">
          Join as a Client
        </a>

        <p class="mt-3 mb-0">
          Already have an account?
          <a href="/login" class=" fw-bold">Log In</a>
        </p>

      </div>
    </div>
  </div>
</div>
    </div>
</section> --}}


<section class="section-padding-top section-padding-bottom bg-light">
  <div class="container">
    <div class="row justify-content-center g-4">
      
      <!-- Client Card -->
      <div class="col-md-4">
        <div class="card h-60 shadow-lg border-0 rounded-3 overflow-hidden role-card">
          <a href="/register">
          <img src="{{url('upload/profile/client.png')}}" class="card-img-top role-img" style="height: 368px;" alt="Client" loading="lazy">
          </a>
          <div class="card-body text-white role-body">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-briefcase fs-3 me-2"></i>
              <h5 class="card-title mb-0">I’m a Client</h5>
            </div>
            <p class="card-text">Register as a client, hire for work.</p>
            <a href="/register" class="btn btn-outline-light btn-md-large w-100 btn-submin">Join as client</a>
          </div>
        </div>
      </div>
      {{-- "background: #8c32f6; --}}
      <!-- Freelancer Card -->
      <div class="col-md-4">
        <div class="card h-60 shadow-lg border-0 rounded-3 overflow-hidden role-card">
          <a href="{{route('register.freelancer')}}">
          <img src="{{url('upload/profile/freelancer.png')}}" class="card-img-top h-60 role-img" style="height: 368px;" alt="Freelancer" loading="lazy">
          </a>
          <div class="card-body text-white role-body">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-laptop fs-3 me-2"></i>
              <h5 class="card-title mb-0">I’m a Freelancer</h5>
            </div>
            <p class="card-text">Register as a freelancer</p>
            <a href="{{route('register.freelancer')}}" class="btn btn-outline-light btn-md-large w-100 btn-submin">Join as freelancer</a>
          </div>
        </div>
      </div>
      
    </div>

    {{-- ============================= faqs section ============================= --}}
<section class="section-padding-top section-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9 col-xl-8 mt-4">
                <h2 class="fw-semibold mb-3 mb-lg-4 fs-4 text-center ">Frequently Asked Questions</h2>
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

  </div>
</section>


@endsection

@section('scripts')

@endsection
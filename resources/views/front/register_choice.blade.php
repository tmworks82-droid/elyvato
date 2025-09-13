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

.option-card {
  border: 2px solid #ccc;
  border-radius: 8px;
  padding: 20px 15px;
  text-align: center;
  cursor: pointer;
  width: 220px;
  transition: all 0.2s;
}
.option-card input {
  display: none;
}
.option-card:hover {
  border-color: #f97a00;
}
.option-card input:checked + .option-content {
  border: 2px solid #f97a00;
  border-radius: 8px;
  background-color: #f8fff8;
}
.option-content {
  padding: 10px;
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
<section class="section-padding-top section-padding-bottom bg-light">
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
</section>


@endsection

@section('scripts')

<script>


document.querySelectorAll('input[name="role"]').forEach(radio => {
  radio.addEventListener('change', function() {
    let joinLink = document.getElementById('joinLink');
    if (this.value === 'client') {
      joinLink.textContent = "Join as a Client";
      joinLink.href = "/register"; // Client register page
      joinLink.classList.add("btn-main");
    } else {
      joinLink.textContent = "Join as a Freelancer";
      joinLink.href = "{{route('register.freelancer')}}"; // Freelancer register page
      joinLink.classList.add("btn-main");
    }
  });
});

    </script>
@endsection
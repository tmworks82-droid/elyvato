<div class="footer section-padding-top section-padding-bottom bg-tr-dark text-light position-relative">
    <div class="container section-padding-bottom footer-widgets">
        <div class="row g-4 justify-content-between">
			<div class="col-lg-3">
				<img class="footer-logo" src="{{ asset ('assets/images/elyvato-footer-logo.png')}}" alt="elyvato logo" height="35">
				<p class="mt-4 mb-2">
                    Elyvato is your end-to-end content marketplace - combining speed, quality, and local relevance to help brands grow. From strategy to delivery, we make content that works.
                </p>
			</div>
			<div class="col-lg-8 col-xxl-7">
				<div class="row g-4">
					<div class="col-6 col-md-4">
						<h6 class="mb-2 mb-md-4">Company</h6>
						<ul class="nav footer-nav flex-column">
							<li class="nav-item"><a class="nav-link" href="/">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="/about">About</a></li>
							<li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
							<li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
						</ul>
					</div>

					<!-- Link block -->
					<div class="col-6 col-md-4">
						<h6 class="mb-2 mb-md-4">Services</h6>
						<ul class="nav footer-nav flex-column">
							@php
							$serviceLinks = [
								['name' => 'Graphic Design', 'url' => '/gig-list'],
								['name' => 'Video Editing', 'url' => '/gig-list'],
								['name' => 'Animation & Vfx', 'url' => '/gig-list'],
								['name' => 'Shoots', 'url' => '/gig-list'],
								['name' => 'Content Writing', 'url' => '/gig-list'],
							];
							@endphp
							@foreach ($serviceLinks as $serviceLink)
								<li class="nav-item">
									<a class="nav-link" href="{{ $serviceLink['url'] }}">{{ $serviceLink['name'] }}</a>
								</li>
							@endforeach
						</ul>
					</div>

					<!-- Link block -->
					<div class="col-md-4">
						<!-- Social buttons -->
						<h6 class="mb-2 mb-md-4">Follow on</h6>

						<ul class="list-inline mb-0 mt-3">
							<li class="list-inline-item"> <a class="btn btn-xs btn-footer-social" href="https://www.instagram.com/elevato.tsre/" target="_blank" title="instagram"><i class="ri-instagram-line"></i></a> </li>
							<li class="list-inline-item"> <a class="btn btn-xs btn-footer-social" href="https://www.linkedin.com/company/elyvato/" target="_blank" title="linkedin"><i class="ri-linkedin-line"></i></a> </li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Widget 2 END -->
		</div>
    </div>
    <div class="container section-padding-top">
        <div class="row g-4 justify-content-between">
            <div class="col-md-6 order-md-2 d-flex flex-column flex-md-row justify-content-md-end gap-2 gap-md-4 footer-legal-links">
                <a href="/terms-of-services">Terms of Services</a>
                <a href="/privacy-policy">Privacy Policy</a>
            </div>
			<div class="col-md-6">
                © Elyvato. 2025 All rights reserved.
            </div>
		</div>
    </div>
    <img src="{{ asset('assets/images/pattern-a.svg') }}" alt="background pattern" class="position-absolute footer-pattern-right">
    <img src="{{ asset('assets/images/pattern-b.svg') }}" alt="background pattern" class="position-absolute footer-pattern-left">
</div>


{{-- bootstrap scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

{{-- custom js --}}
<script src="{{ asset('assets/user/js/admin.js') }}"></script>
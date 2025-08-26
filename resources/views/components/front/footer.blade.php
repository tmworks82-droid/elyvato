<div class="footer section-padding-top section-padding-bottom bg-tr-dark text-light position-relative">
    <div class="container section-padding-bottom footer-widgets">
        <div class="row g-4 justify-content-between">
			<div class="col-lg-3">
				<img class="footer-logo" src="{{ asset ('front/assets/images/elyvato-footer-logo.png')}}" alt="elyvato logo" height="35">
				<p class="mt-4 mb-2">
                    Elyvato is your end-to-end content marketplace - combining speed, quality, and local relevance to help brands grow. From strategy to delivery, we make content that works.
                </p>
			</div>
			<div class="col-lg-8 col-xxl-7">
				<div class="row g-4">
					<div class="col-6 col-md-4">
						<h6 class="mb-2 mb-md-4">Company</h6>
						<ul class="nav footer-nav flex-column">
							<li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="{{url('about')}}">About</a></li>
							<li class="nav-item"><a class="nav-link" href="{{url('blog')}}">Blog</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ url('instant/hire') }}">Instant Hire</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('case.index') }}">Case Studies</a></li>
							<li class="nav-item"><a class="nav-link" href="{{url('contact')}}">Contact</a></li>
						</ul>
					</div>

					<!-- Link block -->
					<div class="col-6 col-md-4">
						<h6 class="mb-2 mb-md-4">Services</h6>
						<ul class="nav footer-nav flex-column">
							
							@foreach (Service()->take(5) as $service)
								<li class="nav-item">
									<a class="nav-link" href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{ $service->name}}</a>
								</li>
							@endforeach
						</ul>
					</div>

					<!-- Link block -->
					<div class="col-md-4">
						<!-- Social buttons -->
						<h6 class="mb-2 mb-md-4">Follow on</h6>

						<ul class="list-inline mb-0 mt-3">
							<li class="list-inline-item"> <a class="btn btn-xs btn-footer-social" href="https://www.instagram.com/elyvato_world/" target="_blank" title="instagram"><i class="ri-instagram-line"></i></a> </li>
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
                <a href="{{url('/terms-of-services')}}">Terms of Services</a>
                <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
            </div>
			<div class="col-md-6">
                © Elyvato. 2025 All rights reserved.
            </div>
		</div>
    </div>
    <img src="{{ asset('front/assets/images/pattern-a.svg') }}" alt="background pattern" class="position-absolute footer-pattern-right">
    <img src="{{ asset('front/assets/images/pattern-b.svg') }}" alt="background pattern" class="position-absolute footer-pattern-left">
</div>


{{-- bootstrap scripts --}}
<script src="{{asset('front/js/jquery-3.6.4.min.js')}}"></script>
<!-- <script src="{{asset('front/js/jquery-migrate-3.0.0.min.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
<script src="{{ asset('front/assets/js/sweetalert2@11.js') }}"></script>
{{-- custom js --}}

<script src="{{ asset('front/assets/js/main.js') }}"></script>
<script>
	
function PleaseWait() {
    Swal.fire({
        title: "Processing request...",
        html: "Please wait...",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                if (Swal.getTimerLeft) {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                }
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });
}

// $(document).ready(function () {
//     $('#serviceSearchInput').on('keyup', function () {
//         let query = $(this).val();

//         if (query.length >= 2) {
//             $.ajax({
//                 url: "{{route('ajax.search.services')}}",
//                 type: "GET",
//                 data: { query: query },
//                 success: function (res) {
//                     $('#serviceResults').css({
//                         'background-color': 'white',
//                         'padding': '6px',
//                         'border-radius': '6px'
//                     });
//                     $('#serviceResults').html(res.html);
//                 }
//             });
//         } else {
//             $('#serviceResults').html('');
//         }
//     });
// });


$(document).ready(function () {
    $('#serviceSearchInput, #mobileServiceSearchInput').on('keyup', function () {
        let query = $(this).val();

        if (query.length >= 2) {
            $.ajax({
                url: "{{ route('ajax.search.services') }}",
                type: "GET",
                data: { query: query },
                success: function (res) {
                    $('#serviceResults').css({
                        'background-color': 'white',
                        'padding': '6px',
                        'border-radius': '6px'
                    });
                    $('#serviceResults, #mobileserviceResults').html(res.html);  // Update with search results
                }
            });
        } else {
            // When input is empty or backspace is pressed, show the default services
            $.ajax({
                url: "{{ route('ajax.default.services') }}",  // Route to get default services
                type: "GET",
                success: function (res) {
                    $('#serviceResults').css({
                        'background-color': 'white',
                        'padding': '6px',
                        'border-radius': '6px'
                    });
                    $('#serviceResults').html(res.html);  // Reload default services
                }
            });
        }
    });
});



 $(document).ready(function () {
    $('#searchButton').on('click', function () {
      var searchValue = $('#serviceSearchInput').val().trim();

      if (searchValue !== '') {
        $('#submitFOrm').submit();
      } else {
        alert('Please enter something to search.');
      }
    });
  });

</script>
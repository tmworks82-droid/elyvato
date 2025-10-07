<div class="footer section-padding-top section-padding-bottom bg-tr-dark text-light position-relative">
    <div class="container section-padding-bottom footer-widgets">
        <div class="row justify-content-between">

            <div class="col-lg-12 col-xxl-12">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <img class="footer-logo" src="{{ asset('front/assets/images/elyvato-footer-logo.png') }}"
                            alt="elyvato logo" height="35">
                        <p class="mt-4 mb-2">
                            Elyvato is your end-to-end content marketplace - combining speed, quality, and local
                            relevance to help brands grow. From strategy to delivery, we make content that works.
                        </p>

                        <h5 class="mb-2 mb-md-4 mt-5">Locations</h5>
                        <ul class="list-inline mb-0 mt-3">
                            <p>
                                 <img src="{{url('front/images/us.jpg')}}" alt="us flag" style="width:24px; margin-right: 8px;"> USA - HQ<br>
                            </p>
                           
                           Elyvato Global LLC <br> 7901 4th Street North, Suite 300 <br>
                            St. Petersburg, Florida 33702 <br>
                            United States
                        </ul>

                        
                        <ul class="list-inline mb-0 mt-3">
                            <p>
                                 <img src="{{url('front/images/india.png')}}" alt="us flag" style="width:30px; margin-right: 8px;"> India<br>
                            </p>

                          BSI Business Park, H-block, 160, 3rd <br> Floor, 302, Sector-63, Noida, Uttar <br> Pradesh-201301
                        </ul>

                    </div>

                    <div class="col-2 col-md-2">
                        <h6 class="mb-2 mb-md-4">Company</h6>
                        <ul class="nav footer-nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('blog') }}">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('instant/hire') }}">Instant Hire</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('case.index') }}">Case Studies</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('contact') }}">Contact</a></li>
                            @if (Auth::check())
                                <li class="nav-item"><a class="nav-link" href="{{ route('raise.ticket') }}">Help</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Link block -->
                    <div class="col-2 col-md-2">
                        <h6 class="mb-2 mb-md-4">Services</h6>
                        <ul class="nav footer-nav flex-column">

                            @foreach (Service()->take(12) as $service)
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-3 col-md-3">
                        <h6 class="mb-2 mb-md-4">Hire Talent</h6>
                        <ul class="nav footer-nav flex-column">

                            @foreach (Hiretalent()->take(12) as $talent)
                                @php
                                    $words = explode(' ', $talent->name);
                                    $short = implode(' ', array_slice($words, 0, 4));
                                @endphp

                                @if ($talent->is_available == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" title="{{ $talent->name }}"
                                            href="{{ route('instant.hire.booking', $talent->slug) }}">
                                            {{ $short }}</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('comming.soon') }}">{{ $short }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <!-- Link block -->
                    <div class="col-md-2">
                        <!-- Social buttons -->
                        <h6 class="mb-2 mb-md-4">Blog</h6>

                        <ul class="nav footer-nav flex-column">
                            @foreach (Blog() as $blog)
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('blog.single.page', $blog->slug) }}">{{ $blog->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="mb-2 mb-md-4">Our Resources</h6>
                        <div class="d-flex flex-wrap gap-2 our_resources" style="color:#ffffff80; font-size:small;">
                            @foreach (Service() as $service)
                                @if (!empty($service->subservices) && count($service->subservices) > 0)
                                    @foreach ($service->subservices as $subservice)
                                        <a class="nav-link p-0"
                                            href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
                                            @php
                                                $words = explode(' ', $subservice->name);
                                                $short = implode(' ', array_slice($words, 0, 3));
                                            @endphp
                                            {{ $short }}
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- Widget 2 END -->
        </div>
    </div>
    <div class="container section-padding-top">
        <div class="row g-4 justify-content-between">
            <div class="col-md-6 order-md-2 d-flex flex-column flex-md-row justify-content-md-end gap-2 gap-md-4 footer-legal-links">
               {{--<form action="{{ route('setCurrency') }}" method="POST">
                    @csrf
                    <select name="currency" id="currency" onchange="this.form.submit()">
                        <option value="INR" {{ session('currency') == 'INR' ? 'selected' : '' }}>INR-₹</option>
                        <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>USD-$</option>
                        <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>GBP-£</option>
                    </select>
                </form>--}}

                <ul class="list-inline mb-0">
                            <li class="list-inline-item"> <a class="btn btn-xs btn-footer-social"
                                    href="https://www.instagram.com/elyvato_world/" target="_blank" title="instagram"><i
                                        class="ri-instagram-line"></i></a> </li>
                            <li class="list-inline-item"> <a class="btn btn-xs btn-footer-social"
                                    href="https://www.linkedin.com/company/elyvato/" target="_blank" title="linkedin"><i
                                        class="ri-linkedin-line"></i></a> </li>
                        </ul>
                <a href="{{ url('/terms-of-services') }}">Terms of Services</a>
                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
            </div>
            <div class="col-md-6">
                © Elyvato. 2025 All rights reserved.
            </div>
        </div>
    </div>
    <img src="{{ asset('front/assets/images/pattern-a.svg') }}" alt="background pattern"
        class="position-absolute footer-pattern-right">
    <img src="{{ asset('front/assets/images/pattern-b.svg') }}" alt="background pattern"
        class="position-absolute footer-pattern-left">
</div>


{{-- bootstrap scripts --}}
<script src="{{ asset('front/js/jquery-3.6.4.min.js') }}"></script>
<!-- <script src="{{ asset('front/js/jquery-migrate-3.0.0.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
</script>
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




    $(document).ready(function() {
        $('#serviceSearchInput, #mobileServiceSearchInput').on('keyup', function() {
            let query = $(this).val();

            if (query.length >= 2) {
                $.ajax({
                    url: "{{ route('ajax.search.services') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(res) {
                        $('#serviceResults').css({
                            'background-color': 'white',
                            'padding': '6px',
                            'border-radius': '6px'
                        });
                        $('#serviceResults, #mobileserviceResults').html(res
                            .html); // Update with search results
                    }
                });
            } else {
                // When input is empty or backspace is pressed, show the default services
                $.ajax({
                    url: "{{ route('ajax.default.services') }}", // Route to get default services
                    type: "GET",
                    success: function(res) {
                        $('#serviceResults').css({
                            'background-color': 'white',
                            'padding': '6px',
                            'border-radius': '6px'
                        });
                        $('#serviceResults').html(res.html); // Reload default services
                    }
                });
            }
        });
    });



    $(document).ready(function() {
        $('#searchButton').on('click', function() {
            var searchValue = $('#serviceSearchInput').val().trim();

            if (searchValue !== '') {
                $('#submitFOrm').submit();
            } else {
                alert('Please enter something to search.');
            }
        });
    });



    $(document).ready(function() {
        // alert('run');
        // Click image or overlay → open file input
        $(".profile-img, .profile-overlay").on("click", function() {

            $("#profileImageInput").click();
        });

        // On file select → auto upload
        $("#profileImageInput").on("change", function() {
            let formData = new FormData();
            formData.append("profile_image", this.files[0]);
            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('user.profile.upload') }}", // 👈 create this route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        location.reload(); // reload to show updated image
                    } else {
                        alert("Upload failed!");
                    }
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        });
    });
</script>

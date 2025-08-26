<!-- Our Footer -->
    <section class="footer-style1 at-home6 home2-footer-radius pt-5 pb-0">
      <div class="container">
      
        <div class="row pb-4">

        <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Company</h5>
              <div class="link-list">
                <a href="{{('/')}}">Home</a>
                <a href="{{ url('about') }}">About</a>
                <a href="{{ route('blog') }}">Blog</a>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Services</h5>
              <div class="link-list">

                @foreach (Service() as $service)
                <a href="{{ route('service-sow-list', ['slug' => $service->slug]) }}">{{ $service->name }}</a>
                @endforeach
                  
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Category</h5>
              <div class="link-list">
                @php
                    $subserviceCount = 0;
                @endphp

                @foreach (Service() as $service)
                    @foreach ($service->subservices as $subservice)
                        @if ($subserviceCount < 5)
                            <a href="{{ route('sub-service-sow', ['serviceSlug' => $service->slug, 'subserviceSlug' => $subservice->slug]) }}">
                                {{ $subservice->name }}
                            </a>
                            @php $subserviceCount++; @endphp
                        @endif
                    @endforeach
                    @if ($subserviceCount >= 5)
                        @break
                    @endif
                @endforeach

              </div>
            </div>
          </div>
          
          <div class="col-sm-6 col-lg-3">
            <div class="link-style1 mb-4 mb-sm-5">
              <h5 class="text-white mb15">Support</h5>
              <ul class="ps-0">
                <li><a href="{{url('contact')}}">Contact</a></li>
                <li><a href="{{url('terms-of-services')}}">Terms Of Services</a></li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
              </ul>
                
            </div>
            <div class="social-widget">
                  <div class="social-style1">
                    <a class="text-white me-2 fw500 fz17" href="#">Follow us</a> <br>
                    <a href="https://www.instagram.com/elevato.tsre/" target="_blank"><i class="fab fa-instagram list-inline-item" title="Instagram"></i></a>
                    <a href="https://www.linkedin.com/company/elyvato/"  target="_blank"><i class="fab fa-linkedin-in list-inline-item" title="Linkdin"></i></a>
                  </div>
              </div>
          </div>

          <!-- <div class="col-sm-6 col-lg-3">
            <div class="social-widget text-center text-md-end">
              
            </div>
          </div> -->

          {{-- <div class="col-sm-6 col-lg-3">
            <div class="footer-widget">
              <div class="footer-widget mb-4 mb-sm-5">
                <div class="mailchimp-widget">
                  <h5 class="title text-white mb20">Subscribe</h5>
                  <div class="mailchimp-style1">
                    <input type="email" class="form-control bdrs4" placeholder="Your email address">
                    <button type="submit">Send</button>
                  </div>
                </div> 
              </div>
              <div class="app-widget mb-4 mb-sm-5">
                <h5 class="title text-white mb20">Apps</h5>
                <div class="row mb-4 mb-lg-5">
                  <div class="col-lg-12">
                    <a class="app-list d-flex align-items-center mb10" href="#">
                      <i class="fab fa-apple fz17 mr15"></i>
                      <h6 class="app-title fz15 fw400 mb-0">iOS App</h6>
                    </a>
                    <a class="app-list d-flex align-items-center" href="#">
                      <i class="fab fa-google-play fz15 mr15"></i>
                      <h6 class="app-title fz15 fw400 mb-0">Android App</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
      <div class="container white-bdrt1 py-4">
        <div class="row">
          <div class="col-md-6">
            <div class="text-center text-lg-start">
              <p class="copyright-text mb-0 text-white-light ff-heading">
                  &copy; Elyvato. <?php echo date("Y"); ?>  All rights reserved.
              </p>

            </div>
          </div>
          <div class="col-md-6">
            <div class="footer_bottom_right_btns text-center text-lg-end">
              <ul class="p-0 m-0">
                
                <!-- <li class="list-inline-item">
                  <select class="selectpicker show-tick">
                    <option>US$ USD</option>
                    <option>Euro</option>
                    <option>Pound</option>
                  </select>
                </li> -->
                <!-- <li class="list-inline-item">
                  <select class="selectpicker show-tick">
                    <option>English</option>
                    <option>Frenc</option>
                    <option>Italian</option>
                    <option>Spanish</option>
                    <option>Turkey</option>
                  </select>
                </li> -->
              
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <a class="scrollToHome at-home2" href="#"><i class="fas fa-angle-up"></i></a>

</div>
<!-- Wrapper End -->
<script src="{{asset('front/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('front/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('front/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('front/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('front/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/owl.js')}}"></script>
<script src="{{asset('front/js/jquery.counterup.js')}}"></script>
<script src="{{asset('front/js/pricing-table.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom script for all pages -->
<script src="{{asset('front/js/script.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

  $(document).ready(function() {
    $('.owl-stage').addClass('mb-4');
   // $('.owl-item').css('margin-left', '0px');

});


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


// here search ajax services  

 $(document).ready(function () {
        $('#serviceSearchInput').on('keyup', function () {
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
                            'border-radius':'6px'
                        });
                        $('#serviceResults').html(res.html);
                    }
                });
            } else {
                $('#serviceResults').html('');
            }
        });
    });

</script>
@yield('scripts')
</body>

</html>

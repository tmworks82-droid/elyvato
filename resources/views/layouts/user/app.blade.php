    @include('layouts.user.header')

    <div class="dashboard_content_wrapper">
        <div class="dashboard dashboard_wrapper pr30 pr0-xl">
            @include('layouts.user.sidebar')
            <div class="dashboard__main pl0-md">

                @yield('content')

                @include('layouts.user.footer')
            </div>
        </div>
    </div>
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
    </div>
    <!-- Wrapper End -->
<script src="{{asset('user/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('user/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('user/js/popper.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('user/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('user/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('user/js/chart.min.js')}}"></script>
<script src="{{asset('user/js/chart-custome.js')}}"></script>
<script src="{{asset('user/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('user/js/dashboard-script.js')}}"></script>
<!-- Custom script for all pages -->
<script src="{{asset('user/js/script.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>
@yield('scripts')
</body>

</html>
    @stack('scripts')

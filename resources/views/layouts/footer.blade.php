

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
    <strong>Copyright &copy; {{ date('Y') }}</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




<!-- jQuery -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ URL::asset('dist/js/demo.js') }}"></script> -->

<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<!-- <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
{{-- <script src="{{ URL::asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chart.js/Chart.bundle.js') }}"></script>
<script src="{{ URL::asset('plugins/chart.js/Chart.js') }}"></script>
<script src="{{ URL::asset('plugins/chart.js/Chart.js') }}"></script>
<script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script> --}}


<!-- Toast JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->


<script type="text/javascript">
    $(function () {
      
        //Initialize Select2 Elements
        $('.select2').select2()


        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon      


        //Date range picker
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                  cancelLabel: 'Clear'
            },
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });
        

    });



startTime();

function startTime() {
    const today = new Date();
    let h = today.getHours() > 12 ? today.getHours() - 12 : today.getHours();
    h = h < 10 ? "0" + h : h;
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    let am_pm = today.getHours() >= 12 ? "pm" : "am";
    if (document.getElementById('current_time')) {
        document.getElementById('current_time').innerHTML = h + ":" + m + ":" + s + ' ' + am_pm;
        setTimeout(startTime, 1000);
    }
} //end of function

function checkTime(i) {
    if (i < 10) { i = "0" + i }; // add zero in front of numbers < 10
    return i;
} //end of function



    
    $(document).ready(function(){


       $(function () {
    $('#switch-s1').on('change', function () {
        const isActive = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{url('toggle-clock')}}",
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                is_active: isActive
            }
        })
        .done(function (response) {
            $.toast({
                heading: 'Success',
                text: response.message,
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right'
            });

            setTimeout(function () {
                location.reload();
            }, 2000);
        })
        .fail(function (xhr) {
            console.warn('Status:', xhr.status);
            console.error(xhr.responseText);

            $.toast({
                heading: 'Error',
                text: 'Something went wrong. Please try again.',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right'
            });
        });
    });
});


    })


</script>


</body>
</html>
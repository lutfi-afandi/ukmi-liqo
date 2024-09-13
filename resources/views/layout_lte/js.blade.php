<!-- jQuery -->
<script src="{{ asset('template_lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('template_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template_lte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('template_lte/plugins/toastr/toastr.min.js') }}"></script>

<!-- datatable -->
<script src="{{ asset('template_lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template_lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template_lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template_lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('template_lte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('template_lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    setTimeout(function() {
        document.getElementById('alert').innerHTML = '';
    }, 2500);
</script>
@stack('js')

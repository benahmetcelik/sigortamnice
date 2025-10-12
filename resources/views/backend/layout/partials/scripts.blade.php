@include('backend.layout.partials.footer')
<!-- ========== Footer End ========== -->

</div>
<!-- ==================================================== -->
<!-- End Page Content -->
<!-- ==================================================== -->

</div>
<!-- END Wrapper -->

<!-- Vendor Javascript (Require in all Page) -->
<script src="{{asset('backend')}}/assets/js/vendor.js"></script>

<!-- App Javascript (Require in all Page) -->
<script src="{{asset('backend')}}/assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>



<script>
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        @if(session('success'))
        Toast.fire({
            icon: "success",
            title: "{{session('success')}}"
        });
        @endif

        @if(session('error'))
        Toast.fire({
            icon: "error",
            title: "{{session('error')}}"
        });
        @endif

</script>
@yield('scripts')
</body>

</html>

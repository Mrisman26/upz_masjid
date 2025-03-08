    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" assets />
    </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js')}}"></script>

    <!-- Include Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Pilih RT/RW",
                allowClear: true
            });
        });

        // Tutup notifikasi otomatis setelah 5 detik
        setTimeout(function () {
            $(".alert").fadeOut("slow");
        }, 5000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let jumlahMuzakiInput = document.querySelector('input[name="jumlah_muzaki"]');
            let zakatBerasInput = document.querySelector('input[name="zakat_fitrah_beras"]');
            let zakatUangInput = document.querySelector('input[name="zakat_fitrah_uang"]');
            let infaqInput = document.querySelector('input[name="infaq"]');

            function updateZakat() {
                let jumlahMuzaki = parseInt(jumlahMuzakiInput.value) || 0;
                zakatBerasInput.value = (jumlahMuzaki * 3.25).toFixed(2); // 3.25 liter per muzaki
                zakatUangInput.value = (jumlahMuzaki * 32500).toFixed(0); // Rp 32.000 per muzaki
                infaqInput.value = (jumlahMuzaki * 5000).toFixed(0); // Rp 5.000 per muzaki
            }

            jumlahMuzakiInput.addEventListener("input", updateZakat);
        });
    </script>

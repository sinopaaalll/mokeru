<?php
if ($this->session->flashdata('success')) { ?>
    <script>
        var successMessage = <?php echo json_encode($this->session->flashdata('success')); ?>;
        $(document).ready(function() {
            iziToast.success({
                title: 'Success!',
                message: successMessage,
                position: 'topRight'
            });
        });
    </script>
<?php } else if ($this->session->flashdata('warning')) { ?>
    <script>
        var warningMessage = <?php echo json_encode($this->session->flashdata('warning')); ?>;
        $(document).ready(function() {
            iziToast.warning({
                title: 'Opps!',
                message: warningMessage,
                position: 'topRight'
            });
        });
    </script>
<?php } else if ($this->session->flashdata('error')) { ?>
    <script>
        var errorMessage = <?php echo json_encode($this->session->flashdata('error')); ?>;
        $(document).ready(function() {
            iziToast.error({
                title: 'Error!',
                message: errorMessage,
                position: 'topRight'
            });
        });
    </script>
<?php } ?>

<script>
    $(document).ready(function() {

        // Menghentikan tautan dari navigasi langsung
        $('.btn-hapus').on('click', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');

            // Menampilkan dialog konfirmasi SweetAlert
            swal({
                title: "Yakin, data akan dihapus?",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Jika pengguna mengkonfirmasi logout, arahkan ke URL logout
                    window.location.href = href;
                }
            });
        });

    });
</script>
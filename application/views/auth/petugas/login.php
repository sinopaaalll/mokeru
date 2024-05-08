<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>MoKeRu &mdash; Login Petugas</title>


    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/img/Logo1.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/Logo1.png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('') ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('') ?>assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5 pt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="text-center mb-5">
                            <h2>MoKeRu</h2>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="mx-auto">Login Petugas</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="number" name="nik" id="nik" class="form-control <?= form_error('nik') ? "is-invalid" : "" ?>" value="<?= set_value('nik') ?>" placeholder="Ketikkan nik" autofocus>
                                        <?= form_error('nik', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control <?= form_error('password') ? "is-invalid" : "" ?>" value="<?= set_value('password') ?>" placeholder="Ketikkan password">
                                        <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            You are not an petugas? <a href="<?= base_url('home') ?>">Back</a>
                        </div>

                        <div class="simple-footer mt-5">
                            Hak Cipta &copy; PT. DSV SOLUTION INDONESIA.
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('') ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url('') ?>assets/modules/popper.js"></script>
    <script src="<?= base_url('') ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url('') ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('') ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url('') ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url('') ?>assets/js/stisla.js"></script>
    <script src="<?= base_url('') ?>assets/modules/sweetalert/sweetalert.min.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url('') ?>assets/js/scripts.js"></script>
    <script src="<?= base_url('') ?>assets/js/custom.js"></script>

    <?php
    if ($this->session->flashdata('success')) { ?>
        <script>
            var successMessage = <?php echo json_encode($this->session->flashdata('success')); ?>;
            $(document).ready(function() {
                swal({
                    title: 'Berhasil!',
                    text: successMessage,
                    icon: 'success'
                });
            });
        </script>
    <?php } else if ($this->session->flashdata('warning')) { ?>
        <script>
            var warningMessage = <?php echo json_encode($this->session->flashdata('warning')); ?>;
            $(document).ready(function() {
                swal({
                    title: 'Opps!',
                    text: warningMessage,
                    icon: 'warning'
                });
            });
        </script>
    <?php } else if ($this->session->flashdata('error')) { ?>
        <script>
            var errorMessage = <?php echo json_encode($this->session->flashdata('error')); ?>;
            $(document).ready(function() {
                swal({
                    title: 'Gagal!',
                    text: errorMessage,
                    icon: 'error'
                });
            });
        </script>
    <?php } ?>
</body>

</html>
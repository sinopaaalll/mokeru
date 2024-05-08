<?php $this->load->view('layouts/petugas/head') ?>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">

            <?php $this->load->view('layouts/petugas/topbar') ?>

            <?php $this->load->view('layouts/petugas/navbar') ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <div class="section-header-back">
                            <a href="<?= base_url('petugas/pekerjaan') ?>" class="btn btn-icon"><span class="fas fa-arrow-left"></span></a>
                        </div>
                        <h1><?= $title ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= base_url('petugas/pekerjaan') ?>">Pekerjaan</a></div>
                            <div class="breadcrumb-item"><?= $title ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title"><?= $title ?></h2>
                        <p class="section-lead">Ceklis semua tugas dan unggah foto sesudah dibersihkan.</p>

                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <form action="<?= base_url('petugas/pekerjaan/proses_task/' . $pekerjaan->id) ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="d-block">Tugas</label>
                                                <?php foreach ($tugas as $key => $item) { ?>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="tugas">
                                                        <label class="form-check-label" for="tugas">
                                                            <?= $item->nama ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block">Sesudah</label>
                                                <div id="image-preview" class="image-preview">
                                                    <label for="image-upload" id="image-label">Pilih Foto</label>
                                                    <input type="file" name="image" id="image-upload" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" disabled><span class="fa fa-check"></span> Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <?php $this->load->view('layouts/petugas/footer') ?>

        </div>
    </div>

    <?php $this->load->view('layouts/petugas/script') ?>
    <?php $this->load->view('layouts/petugas/alert') ?>
    <script>
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false, // Default: false
                success_callback: null // Default: null
            });

            $('.form-check-input').change(function() {
                // Periksa apakah semua checkbox tugas telah dicentang
                var allChecked = $('.form-check-input:checked').length === <?= count($tugas) ?>;

                // Periksa apakah file telah dipilih
                var fileSelected = $('#image-upload').get(0).files.length > 0;

                // Aktifkan tombol submit jika semua task tercentang dan file dipilih
                $('button[type="submit"]').prop('disabled', !(allChecked && fileSelected));
            });

            // Ketika ada perubahan pada input file
            $('#image-upload').change(function() {
                // Periksa apakah semua checkbox tugas telah dicentang
                var allChecked = $('.form-check-input:checked').length === <?= count($tugas) ?>;

                // Periksa apakah file telah dipilih
                var fileSelected = $(this).get(0).files.length > 0;

                // Aktifkan tombol submit jika semua task tercentang dan file dipilih
                $('button[type="submit"]').prop('disabled', !(allChecked && fileSelected));
            });

        })
    </script>

</body>

</html>
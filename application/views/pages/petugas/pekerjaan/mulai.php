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
                        <p class="section-lead">Unggah foto sebelum dibersihkan.</p>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <form action="<?= base_url('petugas/pekerjaan/proses_mulai/' . $ruangan_id) ?>" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div id="image-preview" class="image-preview">
                                                    <label for="image-upload" id="image-label">Pilih Foto</label>
                                                    <input type="file" name="image" id="image-upload" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><span class="fa fa-upload"></span> Upload</button>
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

        })
    </script>

</body>

</html>
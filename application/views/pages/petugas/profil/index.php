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
                        <h1><?= $title ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item"><?= $title ?></div>
                        </div>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Hi, <?= $petugas->nama ?></h2>
                        <p class="section-lead">
                            Change information about yourself on this page.
                        </p>

                        <div class="row mt-sm-4">
                            <div class="col-12 col-md-12 col-lg-5">
                                <div class="card profile-widget">
                                    <div class="profile-widget-header">
                                        <img alt="image" src="<?= base_url('assets/uploads/petugas/' . $petugas->foto) ?>" class="rounded-circle profile-widget-picture">

                                    </div>
                                    <div class="profile-widget-description">
                                        <div class="profile-widget-name"><?= $petugas->nama ?> <div class="text-muted d-inline font-weight-normal">
                                                <div class="slash"></div><?= $petugas->bagian ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Profil</h4>
                                    </div>

                                    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="nik">NIK *</label>
                                                <input type="text" name="nik" id="nik" class="form-control <?= form_error('nik') ? "is-invalid" : "" ?>" value="<?= $petugas->nik ?>" readonly>
                                                <?= form_error('nik', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama *</label>
                                                <input type="text" name="nama" id="nama" class="form-control <?= form_error('nama') ? "is-invalid" : "" ?>" value="<?= $petugas->nama ?>" autofocus>
                                                <?= form_error('nama', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Kata Sandi *</label>
                                                <input type="password" name="password" id="password" class="form-control <?= form_error('password') ? "is-invalid" : "" ?>" value="<?= set_value('password') ?>">
                                                <input type="hidden" name="old_password" value="<?= $petugas->password ?>">
                                                <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Foto</label>
                                                <input type="file" name="foto" id="foto" class="form-control">
                                                <input type="hidden" name="old_foto" value="<?= $petugas->foto ?>">
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
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

</body>

</html>
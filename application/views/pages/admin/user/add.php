<!-- HEAD -->
<?php $this->load->view('layouts/admin/head') ?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- TOPBAR -->
            <?php $this->load->view('layouts/admin/topbar') ?>

            <!-- SIDEBAR -->
            <?php $this->load->view('layouts/admin/sidebar') ?>


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <div class="section-header-back">
                            <a href="<?= base_url('admin/user') ?>" class="btn btn-icon"><span class="fas fa-arrow-left"></span></a>
                        </div>
                        <h1>Tambah <?= $title ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="<?= base_url('admin/' . strtolower($title)) ?>"><?= $title ?></a></div>
                            <div class="breadcrumb-item">Tambah <?= $title ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">*= Kolom tidak boleh kosong</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-sm-12 col-md-6 ">
                                                <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="nama">Nama *</label>
                                                        <input type="text" name="nama" id="nama" class="form-control <?= form_error('nama') ? "is-invalid" : "" ?>" placeholder="Ketikkan nama" value="<?= set_value('nama') ?>" autofocus>
                                                        <?= form_error('nama', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username *</label>
                                                        <input type="text" name="username" id="username" class="form-control <?= form_error('username') ? "is-invalid" : "" ?>" placeholder="Ketikkan username" value="<?= set_value('username') ?>">
                                                        <?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password *</label>
                                                        <input type="password" name="password" id="password" class="form-control <?= form_error('password') ? "is-invalid" : "" ?>" placeholder="Ketikkan password" value="">
                                                        <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass_conf">Konfirmasi Password *</label>
                                                        <input type="password" name="pass_conf" id="pass_conf" class="form-control <?= form_error('pass_conf') ? "is-invalid" : "" ?>" placeholder="Ketikkan konfirmasi password" value="">
                                                        <?= form_error('pass_conf', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role">Role *</label>
                                                        <select name="role" id="role" class="form-control <?= form_error('role') ? "is-invalid" : "" ?>">
                                                            <option value="" selected disabled>--PILIH--</option>
                                                            <option value="admin" <?= set_value('role') == 'admin' ? "selected" : "" ?>>Admin</option>
                                                            <option value="manager" <?= set_value('role') == 'manager' ? "selected" : "" ?>>Manager</option>
                                                        </select>
                                                        <?= form_error('role', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto">Foto</label>
                                                        <input type="file" name="foto" id="foto" class="form-control">
                                                    </div>
                                                    <div class=" form-group">
                                                        <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- FOOTER -->
            <?php $this->load->view('layouts/admin/footer') ?>


        </div>
    </div>

    <!-- SCRIPT -->
    <?php $this->load->view('layouts/admin/script') ?>

</body>

</html>
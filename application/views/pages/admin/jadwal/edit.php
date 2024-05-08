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
                            <a href="<?= base_url('admin/jadwal') ?>" class="btn btn-icon"><span class="fas fa-arrow-left"></span></a>
                        </div>
                        <h1>Edit <?= $title ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="<?= base_url('admin/' . strtolower($title)) ?>"><?= $title ?></a></div>
                            <div class="breadcrumb-item">Edit <?= $title ?></div>
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
                                            <div class="col-sm-12 col-md-6">
                                                <form action="" method="post" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="petugas">Petugas *</label>
                                                        <select name="petugas[]" id="petugas" class="form-control select2" multiple="">
                                                            <?php foreach ($petugas as $p) {
                                                                $selected = in_array($p->id, $selected_petugas) ? 'selected' : '';
                                                                echo "<option value='$p->id' $selected>$p->nik &mdash; $p->nama</option>";
                                                            } ?>
                                                        </select>
                                                        <?= form_error('petugas[]', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hari">Hari *</label>
                                                        <select name="hari" id="hari" class="form-control <?= form_error('hari') ? "is-invalid" : "" ?>">
                                                            <option value="">Pilih Hari</option>
                                                            <?php foreach ($days as $key => $day) { ?>
                                                                <option value="<?= $key + 1 ?>" <?= ($jadwal->hari == $key + 1) ? 'selected' : '' ?>><?= $day ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?= form_error('hari', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="jam_mulai">Jam mulai *</label>
                                                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control <?= form_error('jam_mulai') ? "is-invalid" : "" ?>" placeholder="Ketikkan jam_mulai" value="<?= $jadwal->jam_mulai ?>">
                                                                <?= form_error('jam_mulai', '<div class="invalid-feedback">', '</div>') ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="jam_selesai">Jam selesai *</label>
                                                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control <?= form_error('jam_selesai') ? "is-invalid" : "" ?>" placeholder="Ketikkan jam_selesai" value="<?= $jadwal->jam_selesai ?>">
                                                                <?= form_error('jam_selesai', '<div class="invalid-feedback">', '</div>') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" form-group">
                                                        <button type="submit" class="btn btn-success"><span class="fa fa-save"></span> Ubah</button>
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
<!-- HEAD -->
<?php $this->load->view('layouts/admin/head') ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>

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
                            <a href="<?= base_url('admin/barang_masuk') ?>" class="btn btn-icon"><span class="fas fa-arrow-left"></span></a>
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
                                                <form action="" method="post" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="tgl">Tanggal *</label>
                                                        <input type="date" name="tgl" id="tgl" class="form-control <?= form_error('tgl') ? "is-invalid" : "" ?>" value="<?= date('Y-m-d') ?>" autofocus>
                                                        <?= form_error('tgl', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="barang">Barang *</label>
                                                        <select name="barang" id="barang" class="form-control select2 <?= form_error('barang') ? "is-invalid" : "" ?>">
                                                            <?php foreach ($barang as $p) { ?>
                                                                <option value="<?= $p->id ?>" <?= form_error('barang') ? "selected" : "" ?>><?= $p->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?= form_error('barang', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="qty">Qty *</label>
                                                        <input type="number" name="qty" id="qty" class="form-control <?= form_error('qty') ? "is-invalid" : "" ?>" value="<?= set_value('qty') ?>">
                                                        <?= form_error('qty', '<div class="invalid-feedback">', '</div>') ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ket">Keterangan</label>
                                                        <textarea name="ket" id="ket" class="form-control"></textarea>
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
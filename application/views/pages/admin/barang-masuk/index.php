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
                        <h1><?= $title ?></h1>
                        <div class="section-header-button">
                            <a href="<?= base_url('admin/barang_masuk/create') ?>" class="btn btn-primary">Tambah</a>
                        </div>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="<?= base_url('admin/' . strtolower($title)) ?>"><?= $title ?></a></div>
                            <div class="breadcrumb-item">Data <?= $title ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped" id="dataTables">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                foreach ($barang_masuk as $item) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <th><?= date('d/m/Y', strtotime($item->tgl)) ?></th>
                                                        <td><?= $item->nama ?></td>
                                                        <td><?= $item->qty ?></td>
                                                        <td><?= $item->ket ?></td>
                                                        <td>
                                                            <a href="<?= base_url('admin/barang_masuk/destroy/' . $item->id) ?>" class="btn btn-default btn-hapus"><span class="fa fa-trash"></span> Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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
    <?php $this->load->view('layouts/admin/alert') ?>

</body>

</html>
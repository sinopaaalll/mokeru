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
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Ruangan</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= count_ruangan() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Petugas</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= count_petugas() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-warning">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total User</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= count_user() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-success">
                                        <i class="fas fa-archive"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total Barang</h4>
                                        </div>
                                        <div class="card-body">
                                            <?= count_barang() ?>
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
    <?php $this->load->view('layouts/admin/alert') ?>

</body>

</html>
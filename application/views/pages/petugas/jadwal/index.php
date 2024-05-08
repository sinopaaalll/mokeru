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
                        <!-- <h2 class="section-title">This is Example Page</h2>
                        <p class="section-lead">This page is just an example for you to create your own page.</p> -->
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped" id="">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Petugas</th>
                                                    <th>Jam Mulai</th>
                                                    <th>Jam Selesai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $nama_hari = array(
                                                    1 => 'Senin',
                                                    2 => 'Selasa',
                                                    3 => 'Rabu',
                                                    4 => 'Kamis',
                                                    5 => 'Jumat',
                                                    6 => 'Sabtu',
                                                );
                                                $today = date('N');
                                                foreach ($jadwal as $item) {
                                                    $class = ($item->hari == $today) ? 'text-danger' : ''; // Kondisi untuk merahkan tulisan
                                                ?>
                                                    <tr>
                                                        <td class="<?= $class ?>"><?= $nama_hari[$item->hari] ?></td>
                                                        <td class="<?= $class ?>"><?= $item->nama_petugas ?></td>
                                                        <td class="<?= $class ?>"><?= date('H:i', strtotime($item->jam_mulai)) ?></td>
                                                        <td class="<?= $class ?>"><?= date('H:i', strtotime($item->jam_selesai)) ?></td>
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

            <?php $this->load->view('layouts/petugas/footer') ?>

        </div>
    </div>

    <?php $this->load->view('layouts/petugas/script') ?>
    <?php $this->load->view('layouts/petugas/alert') ?>

</body>

</html>
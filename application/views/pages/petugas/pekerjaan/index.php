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

                            <?php if ($jadwal_hari == date('N') && $petugas->bagian == 'kantor') { ?>
                                <?php foreach ($ruangan as $r) {
                                    if ($r->bagian == $bagian) { ?>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                            <div class="card card-primary text-center">
                                                <div class="card-body">
                                                    <span class="fa fa-4x fa-door-open"></span>
                                                    <h6 class="pb-3 pt-3"><?= $r->nama ?></h6>
                                                    <?php
                                                    $badge_color = '';
                                                    if ($r->status_pekerjaan == 'Belum dibersihkan') {
                                                        $badge_color = 'badge-danger';
                                                    } elseif ($r->status_pekerjaan == 'Proses dibersihkan') {
                                                        $badge_color = 'badge-secondary';
                                                    } elseif ($r->status_pekerjaan == 'Menunggu validasi') {
                                                        $badge_color = 'badge-primary';
                                                    } else {
                                                        $badge_color = 'badge-success';
                                                    } ?>
                                                    <span class="badge <?= $badge_color ?>"><?= $r->status_pekerjaan ?></span> <!-- Menampilkan status pekerjaan -->
                                                </div>
                                                <div class="card-footer mx-auto">
                                                    <?php if ($r->status_pekerjaan == 'Belum dibersihkan') { ?>
                                                        <a href="<?= base_url('petugas/pekerjaan/mulai/' . $r->id) ?>" class="btn btn-sm btn-primary">Unggah Foto <span class="fa fa-upload"></span></a>
                                                    <?php } elseif ($r->status_pekerjaan == 'Proses dibersihkan') { ?>
                                                        <button type="button" class="btn btn-sm btn-info btn-lihat" data-id="<?= $r->id ?>"><span class="fa fa-eye"></span> Lihat</button>
                                                        <a href="<?= base_url('petugas/pekerjaan/task/' . $r->id) ?>" class="btn btn-sm btn-warning"><span class="fa fa-check"></span> Ceklis Tugas </a>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-sm btn-info btn-lihat" data-id="<?= $r->id ?>"><span class="fa fa-eye"></span> Lihat</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } elseif ($jadwal_hari == NULL && $petugas->bagian == 'gudang') { ?>
                                <?php foreach ($ruangan as $r) {
                                    if ($r->bagian == $bagian) { ?>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                            <div class="card card-primary text-center">
                                                <div class="card-body">
                                                    <span class="fa fa-4x fa-door-open"></span>
                                                    <h6 class="pb-3 pt-3"><?= $r->nama ?></h6>
                                                    <?php
                                                    $badge_color = '';
                                                    if ($r->status_pekerjaan == 'Belum dibersihkan') {
                                                        $badge_color = 'badge-danger';
                                                    } elseif ($r->status_pekerjaan == 'Proses dibersihkan') {
                                                        $badge_color = 'badge-secondary';
                                                    } elseif ($r->status_pekerjaan == 'Menunggu validasi') {
                                                        $badge_color = 'badge-primary';
                                                    } else {
                                                        $badge_color = 'badge-success';
                                                    } ?>
                                                    <span class="badge <?= $badge_color ?>"><?= $r->status_pekerjaan ?></span> <!-- Menampilkan status pekerjaan -->
                                                </div>
                                                <div class="card-footer mx-auto">
                                                    <?php if ($r->status_pekerjaan == 'Belum dibersihkan') { ?>
                                                        <a href="<?= base_url('petugas/pekerjaan/mulai/' . $r->id) ?>" class="btn btn-sm btn-primary">Unggah Foto <span class="fa fa-upload"></span></a>
                                                    <?php } elseif ($r->status_pekerjaan == 'Proses dibersihkan') { ?>
                                                        <button type="button" class="btn btn-sm btn-info btn-lihat" data-id="<?= $r->id ?>"><span class="fa fa-eye"></span> Lihat</button>
                                                        <a href="<?= base_url('petugas/pekerjaan/task/' . $r->id) ?>" class="btn btn-sm btn-warning"><span class="fa fa-check"></span> Ceklis Tugas </a>
                                                    <?php } else { ?>
                                                        <button type="button" class="btn btn-sm btn-info btn-lihat" data-id="<?= $r->id ?>"><span class="fa fa-eye"></span> Lihat</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else {
                                echo '<div class="col-lg-12"><h6 class="text-center">Hari ini bukan jadwal anda</h6></div>';
                            } ?>
                        </div>


                    </div>
                </section>
            </div>

            <!-- Modal -->
            <div class="modal fade" role="dialog" id="modalLihat">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>:</th>
                                    <td id="tgl"></td>
                                </tr>
                                <tr>
                                    <th>Petugas</th>
                                    <th>:</th>
                                    <td id="petugas"></td>
                                </tr>
                                <tr>
                                    <th>Sebelum</th>
                                    <th>:</th>
                                    <td>
                                        <img src="" id="foto_sebelum" alt="Foto" width="50%">
                                    </td>
                                </tr>
                                <tr id="tr_tugas">
                                    <th>Tugas</th>
                                    <th>:</th>
                                    <td id="tugas"> </td>
                                </tr>
                                <tr id="tr_sesudah">
                                    <th>Sesudah</th>
                                    <th>:</th>
                                    <td>
                                        <img src="" id="foto_sesudah" alt="Foto" width="50%">
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->

            <?php $this->load->view('layouts/petugas/footer') ?>

        </div>
    </div>

    <?php $this->load->view('layouts/petugas/script') ?>
    <?php $this->load->view('layouts/petugas/alert') ?>

    <script>
        $(document).on('click', '.btn-lihat', function() {
            var ruangan_id = $(this).data('id');
            $('#modalLihat').modal('show');

            $.ajax({
                url: '<?= base_url('petugas/pekerjaan/lihat') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    ruangan_id: ruangan_id
                },
                success: function(response) {
                    $('#modalLihat .modal-title').text(response.ruangan);
                    $('#tgl').text(response.tanggal);
                    $('#petugas').text(response.petugas);
                    $('#tugas').text(response.tugas);
                    $('#foto_sebelum').attr('src', response.foto_sebelum);

                    if (response.foto_after === null) {
                        $('#tr_sesudah').hide();
                        $('#tr_tugas').hide();
                    } else {
                        $('#foto_sesudah').attr('src', response.foto_sesudah);
                        $('#tr_sesudah').show();
                        $('#tr_tugas').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

</body>

</html>
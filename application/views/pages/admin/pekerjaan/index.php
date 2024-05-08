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
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="<?= base_url('admin/' . strtolower($title)) ?>"><?= $title ?></a></div>
                            <div class="breadcrumb-item">Data <?= $title ?></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-group row">
                                                <label for="tgl" class="col-sm-4 col-form-label">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" name="tgl" id="tgl" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label"></label>
                                                <div class="col-sm-8">
                                                    <button type="submit" class="btn btn-primary"><span class="fa fa-filter"></span> Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped" id="dataTables">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Petugas</th>
                                                    <th>Detail Pekerjaan</th>
                                                    <th>Status</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pekerjaan as $item) { ?>
                                                    <tr>
                                                        <td><?= date('d/m/y, H:i', strtotime($item->tgl)) ?></td>
                                                        <td><?= $item->ruangan ?></td>
                                                        <td><?= $item->petugas ?></td>
                                                        <td><?= $item->tugas ?></td>
                                                        <td>
                                                            <?php
                                                            $badge_color = '';
                                                            if ($item->status == 'Belum dibersihkan') {
                                                                $badge_color = 'badge-danger';
                                                            } elseif ($item->status == 'Proses dibersihkan') {
                                                                $badge_color = 'badge-secondary';
                                                            } elseif ($item->status == 'Menunggu validasi') {
                                                                $badge_color = 'badge-primary';
                                                            } else {
                                                                $badge_color = 'badge-success';
                                                            } ?>
                                                            <span class="badge <?= $badge_color ?>"><?= $item->status ?></span>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-default btn-lihat" data-id="<?= $item->id ?>"><span class="fa fa-eye"></span> Lihat foto</button>
                                                        </td>
                                                        <td>
                                                            <?php if ($item->status == 'Menunggu validasi') { ?>
                                                                <a href="<?= base_url('admin/pekerjaan/validasi/' . $item->id) ?>" class="btn btn-success"><span class="fa fa-edit"></span> Validasi</a>
                                                            <?php } else {
                                                                echo "-";
                                                            } ?>
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

            <!-- Modal -->
            <div class="modal fade" role="dialog" id="modalLihat">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Sebelum</th>
                                    <th>:</th>
                                    <td>
                                        <img src="" id="foto_sebelum" alt="Foto" width="50%">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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

            <!-- FOOTER -->
            <?php $this->load->view('layouts/admin/footer') ?>


        </div>
    </div>

    <!-- SCRIPT -->
    <?php $this->load->view('layouts/admin/script') ?>
    <?php $this->load->view('layouts/admin/alert') ?>

    <script>
        $(document).on('click', '.btn-lihat', function() {
            var id = $(this).data('id');
            // console.log(id);
            $('#modalLihat').modal('show');

            $.ajax({
                url: '<?= base_url('admin/pekerjaan/lihat') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#foto_sebelum').attr('src', response.foto_sebelum);

                    if (response.foto_after === null) {
                        $('#tr_sesudah').hide();
                    } else {
                        $('#foto_sesudah').attr('src', response.foto_sesudah);
                        $('#tr_sesudah').show();
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
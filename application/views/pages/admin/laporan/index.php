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
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= base_url('admin/laporan/export') ?>" method="post">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label for="status" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label for="status" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="button" id="btn-filter" class="btn btn-lg btn-primary"><span class="fa fa-filter"></span> Filter</button>
                                                            <button type="submit" id="btn-export" class="btn btn-lg btn-danger"><span class="fa fa-print"></span> Export PDF</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped" id="dataTables1">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Ruangan</th>
                                                    <th>Petugas</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
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

    <script>
        $(document).ready(function() {
            var table = $('#dataTables1').DataTable();
            $(document).on('click', '#btn-filter', function() {
                var tglAwal = $('#tgl_awal').val();
                var tglAkhir = $('#tgl_akhir').val();

                // Memeriksa apakah nilai tanggal awal atau akhir kosong
                if (tglAwal === '' || tglAkhir === '') {
                    swal('Peringatan', 'Tanggal awal dan akhir wajib diisi.', 'warning');
                    return; // Menghentikan proses jika ada nilai yang kosong
                }

                $.ajax({
                    url: '<?= base_url('admin/laporan/get_laporan') ?>',
                    method: 'POST',
                    data: {
                        tgl_awal: tglAwal,
                        tgl_akhir: tglAkhir
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response);
                        table.clear().draw();

                        // Memasukkan data baru ke dalam tabel
                        $.each(response.data, function(index, item) {
                            var formattedDate = moment(item.tgl).format('DD MMM YYYY');
                            var row = '<tr>' +
                                '<td>' + formattedDate + '</td>' +
                                '<td>' + item.ruangan + '</td>' +
                                '<td>' + item.petugas + '</td>' +
                                '<td>' + item.status + '</td>' +
                                '</tr>';
                            table.row.add($(row)).draw(false);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat memuat data.');
                    }
                });
            });
        });
    </script>

</body>

</html>
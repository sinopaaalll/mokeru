<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item <?= $this->uri->segment(2) == 'pekerjaan' ? "active" : "" ?>">
                <a href="<?= base_url('petugas/pekerjaan') ?>" class="nav-link"><i class="fa fa-tasks"></i><span>Pekerjaan</span></a>
            </li>
            <?php if ($this->session->userdata('bagian') == 'kantor') { ?>
                <li class="nav-item <?= $this->uri->segment(2) == 'jadwal' ? "active" : "" ?>">
                    <a href="<?= base_url('petugas/jadwal') ?>" class="nav-link"><i class="fas fa-calendar"></i><span>Jadwal</span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
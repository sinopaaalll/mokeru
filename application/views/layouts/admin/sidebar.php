<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= base_url('admin/dashboard') ?>">MoKeRu</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?= base_url('admin/dashboard') ?>">MKR</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?= $this->uri->segment(2) == 'dashboard' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
      <li class="menu-header">Main Menu</li>
      <?php if ($this->session->userdata('role') == 'admin') { ?>
        <li class="<?= $this->uri->segment(2) == 'ruangan' || $this->uri->segment(2) == 'tugas' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/ruangan') ?>"><i class="fas fa-door-open"></i> <span>Ruangan</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'petugas' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/petugas') ?>"><i class="fas fa-users"></i> <span>Petugas</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'jadwal' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/jadwal') ?>"><i class="fas fa-calendar-alt"></i> <span>Jadwal</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'pekerjaan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/pekerjaan') ?>"><i class="fas fa-tasks"></i> <span>Pekerjaan</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'laporan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/laporan') ?>"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'user' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/user') ?>"><i class="fas fa-user"></i> <span>User</span></a></li>
        <li class="dropdown <?= $this->uri->segment(2) == 'barang' || $this->uri->segment(2) == 'barang_masuk' || $this->uri->segment(2) == 'barang_keluar' ? "active" : "" ?>">
          <a href=" #" class="nav-link has-dropdown"><i class="fas fa-archive"></i> <span>Kelola Barang</span></a>
          <ul class="dropdown-menu">
            <li class="<?= $this->uri->segment(2) == 'barang' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/barang') ?>">Barang</a></li>
            <li class="<?= $this->uri->segment(2) == 'barang_masuk' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/barang_masuk') ?>">Barang Masuk</a></li>
            <li class="<?= $this->uri->segment(2) == 'barang_keluar' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/barang_keluar') ?>">Barang Keluar</a></li>
          </ul>
        </li>
      <?php } else { ?>
        <li class="<?= $this->uri->segment(2) == 'jadwal' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/jadwal') ?>"><i class="fas fa-calendar-alt"></i> <span>Jadwal</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'pekerjaan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/pekerjaan') ?>"><i class="fas fa-tasks"></i> <span>Pekerjaan</span></a></li>
        <li class="<?= $this->uri->segment(2) == 'laporan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/laporan') ?>"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
      <?php } ?>

    </ul>
  </aside>
</div>
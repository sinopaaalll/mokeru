<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= base_url('admin/dashboard') ?>">Monitoring Kebersihan</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?= base_url('admin/dashboard') ?>">AK</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?= $this->uri->segment(2) == 'dashboard' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
      <li class="menu-header">Main Menu</li>
      <li class="<?= $this->uri->segment(2) == 'ruangan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/ruangan') ?>"><i class="fas fa-door-open"></i> <span>Ruangan</span></a></li>
      <li class="<?= $this->uri->segment(2) == 'tugas' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/tugas') ?>"><i class="fas fa-tasks"></i> <span>Tugas</span></a></li>
      <li class="<?= $this->uri->segment(2) == 'petugas' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/petugas') ?>"><i class="fas fa-users"></i> <span>Petugas</span></a></li>
      <li class="<?= $this->uri->segment(2) == 'jadwal' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/jadwal') ?>"><i class="fas fa-calendar-alt"></i> <span>Jadwal</span></a></li>
      <li class="menu-header">Akun</li>
      <li class="<?= $this->uri->segment(2) == 'user' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/user') ?>"><i class="fas fa-user"></i> <span>User</span></a></li>
      <!-- <li class="menu-header">Konfigurasi</li> -->
      <!-- <li class="dropdown <?= $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'sosmed' || $this->uri->segment(2) == 'kontak' || $this->uri->segment(2) == 'perizinan'  ? "active" : "" ?>">
        <a href=" #" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Konfigurasi</span></a>
        <ul class="dropdown-menu">
          <li class="<?= $this->uri->segment(2) == 'profile' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/profile') ?>">Profile</a></li>
          <li class="<?= $this->uri->segment(2) == 'sosmed' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/sosmed') ?>">Sosmed</a></li>
          <li class="<?= $this->uri->segment(2) == 'kontak' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/kontak') ?>">Kontak</a></li>
          <li class="<?= $this->uri->segment(2) == 'perizinan' ? "active" : "" ?>"><a class="nav-link" href="<?= base_url('admin/perizinan') ?>">Perizinan</a></li>
        </ul>
      </li> -->
    </ul>
  </aside>
</div>
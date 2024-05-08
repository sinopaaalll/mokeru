<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="<?= base_url('petugas/pekerjaan') ?>" class="navbar-brand sidebar-gone-hide">MoKeRu</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    <div class="form-inline ml-auto"></div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url('assets/uploads/petugas/' . $this->session->userdata('foto')) ?>" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama') ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('petugas/profil') ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('logout-petugas') ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
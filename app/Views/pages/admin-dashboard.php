<?= $this->extend('layout/template-admin') ?>
<?= $this->section('content') ?>

<?php
$db = \Config\Database::connect();
$school = session()->get('school');
$useradmin = session()->get('useradmin');

// dd(session()->get());
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <img class="ml-2" src="../logo/logo.png" width="52px" height="54px">
    <a class="navbar-brand" href="#">
        <?php foreach ($school as $sc) : ?>
            <?= $sc['name'] ?>
        <?php endforeach ?>
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <h4 class="ml-auto mr-0 mr-md-3 my-2 my-md-0 text-white"><?= date("j F Y") ?></h4>

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-power-off fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/admin/logout">Logout</a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Data User</div>
                    <a class="nav-link" href="mahasiswa">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Mahasiswa
                    </a>
                    <a class="nav-link" href="administrator">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Administrator
                    </a>
                </div>
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Data Ujian</div>
                    <a class="nav-link" href="jadwal">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Jadwal Ujian
                    </a>
                    <a class="nav-link" href="materi">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Materi Ujian
                    </a>
                </div>
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Download</div>
                    <a class="nav-link" href="../download">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-export"></i></div>
                        Rekap Hasil Ujian
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <?php foreach ($useradmin as $usr) : ?>
                    <div class="small">Nama :
                        <b>
                            <?= $usr['name'] ?>
                        </b>
                    </div>
                    <div class="small">NIP :
                        <b>
                            <?= $usr['nip'] ?>
                        </b>
                    </div>
                <?php endforeach ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">

                <!-- Nested Row within Card Body -->
                <div class="card o-hidden border-0 mt-3">
                    <div class="card-block mt-3">
                        <div class="card-text text-center">
                            <img class="mb-4" src="/logo/logo.png" alt="" width="45%" height="40%">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layout/template-download') ?>
<?= $this->section('content') ?>

<?php
$db = \Config\Database::connect();
$school = session()->get('school');
$useradmin = session()->get('useradmin');
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

</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Navigasi</div>
                    <a class="nav-link" href="dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-hand-point-left"></i></div>
                        Kembali ke Menu Awal
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
                        <div class="card-text">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-2">
                                    <img class="mb-4" src="/logo/logo.png" alt="" width="80%">
                                </div>
                                <div class="col-6 text-center text-success">
                                    <h2>Download Nilai Hasil Ujian</h2>
                                    <hr class="garis1">
                                    <h5>jurusan Profesi Ners dan D3-Keperawatan</h5>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <form action="/download" method="post">
                                    <div class="p-3 mr-5 text-center">
                                        <div class="font-weight-bold">Pilih Data yg di Download</div>
                                        <select id="prodi" name="prodi" class="form-control mt-2">
                                            <option value=0></option>
                                            <option value=1>All Prodi</option>
                                            <option value=2>D3 Keperawatan</option>
                                            <option value=3>Profesi Ners</option>
                                        </select>
                                        <div class="mt-2"><button class="btn btn-info" type="submit" name="filter-submit">Download</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection() ?>
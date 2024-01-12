<?= $this->extend('layout/template-form') ?>
<?= $this->section('content') ?>

<?php
$db = \Config\Database::connect();
$school = session()->get('school');
$useradmin = session()->get('useradmin');
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <img class="ml-2" src="/logo/logo.png" width="52px" height="54px">
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
                    <a class="nav-link" href="../../../admin/mahasiswa">
                        <div class="sb-nav-link-icon"><i class="fas fa-hand-point-left"></i></div>
                        Kembali ke List Mahasiswa
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

                            <?php foreach ($user as $usr) : ?>
                                <form method="post" action="../../update/mahasiswa/<?= $usr['id'] ?>">
                                    <?= csrf_field() ?>
                                    <img class=" mb-4" src="/logo/logo.png" alt="" width="140" height="135">
                                    <h1 class="h3 mb-3 font-weight-bold text-white bg-primary">INPUT DATA MAHASISWA</h1>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6 ">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" id="name" name="name" class="form-control <?= ($validation->hasError('name') ? "is-invalid" : "") ?>" placeholder="masukkan nama lengkap" value="<?= $usr['name'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" autofocus>
                                            <div class="invalid-feedback" value="<?= old('name') ?>">
                                                <?= $validation->getError('name') ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email" class="form-control <?= ($validation->hasError('email') ? "is-invalid" : "") ?>" placeholder="masukkan alamat email" value="<?= $usr['email'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                            <div class=" invalid-feedback" value="<?= old('email') ?>">
                                                <?= $validation->getError('email') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="major">Jurusan</label>
                                            <select id="major" name="major" class="form-control">
                                                <option value="1" <?= $usr['class_id'] == 1 ? "selected" : "" ?>>D3 Keperawatan</option>
                                                <option value="2" <?= $usr['class_id'] == 2 ? "selected" : "" ?>>Profesi Ners</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="nim">Nomor Induk Mahasiswa</label>
                                            <input type="text" id="nim" name="nim" class="form-control <?= ($validation->hasError('nim') ? "is-invalid" : "") ?>" placeholder="masukkan nomor induk mahasiswa" value="<?= $usr['nim'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);" disabled>
                                            <div class=" invalid-feedback" value="<?= old('nim') ?>">
                                                <?= $validation->getError('nim') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control <?= ($validation->hasError('password') ? "is-invalid" : "") ?>" placeholder="masukkan password" value="<?= $usr['password'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                            <div class="invalid-feedback" value="<?= old('password') ?>">
                                                <?= $validation->getError('password') ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="konfirmasi">Konfirmasi Password</label>
                                            <input type="password" id="konfirmasi" name="konfirmasi" class="form-control <?= ($validation->hasError('konfirmasi') ? "is-invalid" : "") ?>" placeholder="ulangi password" value="<?= $usr['password'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                            <div class=" invalid-feedback" value="<?= old('konfirmasi') ?>">
                                                <?= $validation->getError('konfirmasi') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="nimhidden" name="nimhidden" value="<?= $usr['nim'] ?>">
                                    <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">SIMPAN</button>
                                </form>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection() ?>
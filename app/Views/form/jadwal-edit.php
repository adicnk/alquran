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
                    <a class="nav-link" href="../../../admin/jadwal">
                        <div class="sb-nav-link-icon"><i class="fas fa-hand-point-left"></i></div>
                        Kembali ke List Jadwal
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
                            <?php foreach ($event as $ev) : ?>
                                <form method="post" action="../../update/jadwal/<?= $ev['id'] ?>">
                                    <?= csrf_field() ?>
                                    <img class=" mb-4" src="/logo/logo.png" alt="" width="140" height="135">
                                    <h1 class="h3 mb-3 font-weight-bold text-white bg-primary">INPUT JADWAL UJIAN</h1>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-6 ">
                                            <label for="name">Nama Ujian</label>
                                            <div class="input-group nama">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Teal;">
                                                            <i class="fas fa-user-edit"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" id="name" name="name" class="form-control ml-2 <?= ($validation->hasError('name') ? "is-invalid" : "") ?>" placeholder="masukkan nama lengkap" value="<?= $ev['name'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" autofocus>
                                                <div class="invalid-feedback" value="<?= old('name') ?>">
                                                    <?= $validation->getError('name') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="kategori">Kategori</label>
                                            <div class="input-group kategori">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Maroon;">
                                                            <i class="fas fa-copy"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <select id="kategori" name="kategori" class="form-control ml-2">
                                                    <option value="1" <?= $ev['event_category_id'] == 1 ? "selected" : "" ?>>Uji Kompetensi </option>
                                                    <option value="2" <?= $ev['event_category_id'] == 2 ? "selected" : "" ?>>Uji Mata Kuliah</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="major">Jurusan</label>
                                            <div class="input-group jurusan">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Tomato;">
                                                            <i class="fas fa-list-alt"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <select id="major" name="major" class="form-control ml-2">
                                                    <option value="1" <?= $ev['class_id'] == 1 ? "selected" : "" ?>>D3 Keperawatan</option>
                                                    <option value="2" <?= $ev['class_id'] == 2 ? "selected" : "" ?>>Profesi Ners</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $date = explode(" ", $ev['date']); ?>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="datepicker">Tanggal</label>
                                            <div class="input-group date" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Mediumslateblue;">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" id="date" name="date" class="form-control ml-2" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return false" value="<?= $date[0] ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="time">Jam</label>
                                            <div class="input-group kategori">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Navy;">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="time" id="time" name="time" class="form-control ml-2 timepicker" onfocusin="yellowin(this);" onfocusout="whiteout(this)" value="<?= $date[1] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="total_content">Jumlah Soal dalam Ujian</label>
                                            <div class="input-group kategori">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Orange;">
                                                            <i class="fas fa-list-ol"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" id="total" name="total" class="form-control ml-2 <?= ($validation->hasError('total') ? "is-invalid" : "") ?>" placeholder="masukkan jumlah soal yang disertakan dalam ujian" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);" value="<?= $ev['total_content'] ?>">
                                                <div class="invalid-feedback" value="<?= old('total') ?>">
                                                </div>
                                                <div class=" invalid-feedback" value="<?= old('total') ?>">
                                                    <?= $validation->getError('total') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="durasi">Durasi Ujian</label>
                                            <div class="input-group durasi">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Purple;">
                                                            <i class="fas fa-stopwatch"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" id="durasi" name="durasi" class="form-control ml-2 <?= ($validation->hasError('durasi') ? "is-invalid" : "") ?>" placeholder="masukkan lama waktu ujian" value="<?= $ev['duration'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);">
                                                <div class="invalid-feedback" value="<?= old('durasi') ?>">
                                                </div>
                                                <div class=" invalid-feedback" value="<?= old('durasi') ?>">
                                                    <?= $validation->getError('durasi') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="min-pass">Nilai Minimum Kelulusan</label>
                                            <div class="input-group min-pass">
                                                <div class="input-group-addon">
                                                    <span style="font-size: 1.5rem;">
                                                        <span style="color: Green;">
                                                            <i class="fas fa-compress-alt"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" id="min-pass" name="min-pass" class="form-control ml-2 <?= ($validation->hasError('min-pass') ? "is-invalid" : "") ?>" placeholder="masukkan nilai minimal kelulsan dalam ujian" value="<?= $ev['min_pass'] ?>" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return numOnly(event);">
                                                <div class="invalid-feedback" value="<?= old('min-pass') ?>">
                                                </div>
                                                <div class=" invalid-feedback" value="<?= old('min-pass') ?>">
                                                    <?= $validation->getError('min-pass') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="d-flex flex-row mt-3">
                                                <div class="p-2">
                                                    <input class="mr-2" id="auto-user" name="auto-user" type="checkbox" <?= $ev['is_auto_user'] == 1 ? "checked" : "" ?>>Semua mahasiswa aktif ikut secara otomatis dalam ujian
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex flex-row mt-3">
                                                <div class="p-2">
                                                    <input class="mr-2" id="auto-content" name="auto-content" type="checkbox" <?= $ev['is_auto_content'] == 1 ? "checked" : "" ?>>Semua soal aktif ikut secara otomatis di acak dalam ujian
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
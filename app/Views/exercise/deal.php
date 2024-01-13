<?= $this->extend('template/relogin') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mt-3">
        <hr>
    </div>
    <!-- Page Heading -->
    <div class="align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <h6 class="h6 mb-0 text-gray">Anda telah membeli paket Soal Keperewatan<br/>
            <br/>Informasi pembayaran akan di kirim ke email atau nomor telp yang terdaftar
             yang terhubung ke nomor whatsap di handphone anda.
        </h6>

    </div>
    <a class="btn btn-primary mt-3 mb-4" href="../dashboard">Kembali ke dashboard</a>
    <div class="mt-3">
        <hr>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>
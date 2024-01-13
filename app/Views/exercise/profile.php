<?= $this->extend('template/dashboard-profile') ?>
<?= $this->section('content') ?>

<?php foreach ($user as $usr) { ?>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><?= $usr['name'] ?></h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <div class="subheading mb-3">Sekolah Asal: <?= $usr['asal']; ?></div>
                            <div class="subheading mb-3">Pilihan Universitas: <?= $usr['pilihan']; ?></div>
                            <div class="subheading mb-3">Pilihan Jurusan: <?= $usr['jurusan']; ?></div>
                            <div class="subheading mb-3">Alamat <?= $usr['alamat']; ?></div>
                            <div class="subheading mb-3">Nmor HP: <?= $usr['hp']; ?></div>
                            <div>Email : <?= $usr['email'] ?></div>
                            <div>&nbsp</div><div>&nbsp</div>
                            <div>Paket Pembelajaran : <?= $usr['paket'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <strong><p>Nilai Latihan Rata-rata : <?= $nilai_ratarata ?></p></strong>
                </div>
                <div class="card-footer">
                    <a href="/dashboard" class="btn btn-primary">DASHBOARD</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->endSection() ?>
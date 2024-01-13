<?= $this->extend('template/dashboard-belajar') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="card-header">
                <h4 class="text-center">Pembelajaran tentang Tubuh Manusia</h4>
            </div> -->
            <div class="card-body">
<?php foreach ($user as $usr) {
    switch ($usr['paket']) {
        case "demo": 
            ?>
                <!--
                <iframe src="`https://materi-pait.devinc.website/tubuh" width="100%" height="500px"></iframe>
                -->
                <iframe src="https://belajaryuk.devinc.website/kisi-kisi-demo/" width="100%" height="500px"></iframe>
        <?php break;
        case "bronze": ?>
                <iframe src="https://belajaryuk.devinc.website/kisi-kisi/" width="100%" height="500px"></iframe>
        <?php break;
        case "silver": ?>
            <iframe src="https://belajaryuk.devinc.website/kisi-kisi/" width="100%" height="500px"></iframe>
    <?php break;
        case "paket": ?>
            <iframe src="https://belajaryuk.devinc.website/kisi-kisi/" width="100%" height="500px"></iframe>
    <?php break;
}} ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('template/dashboard-belajar') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="card-header">
                <h4 class="text-center">Pembelajaran tentang Tubuh Manusia</h4>
            </div> -->
            <div class="card-body">
                
                <form method="post" action="/latihanpaket">
                    <?= csrf_field() ?>
                
                    <?php foreach ($paket as $pkt) {
                        switch ($pkt['paket']) {
                            case "demo": 
                                ?>
            <h3>Account Demo</h3><hr/>
            <h5>Latihan Soal dengan Jawaban Tanpa Pembahasan</h5>
            <?php $queryClass = $db->table('kategori_soal')->getWhere(['is_tp' => 1]);
            foreach ($queryClass->getResult('array') as $k) : ?>
            <button type="submit" onclick="setSoalClass(<?=$k['id']?>)"  class="btn btn-primary">
            <span><?=$k['kname']?></span>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">15</span>
            </button><br/>
            <?php endforeach ?>
            <br/>
            <h5>Latihan Soal dengan Jawaban dan Pembahasan</h5>
            <?php $queryClass = $db->table('kategori_soal')->getWhere(['is_tp' => null]);
            foreach ($queryClass->getResult('array') as $k) : ?>
            <button type="submit" onclick="setSoalClass(<?=$k['id']?>)"  class="btn btn-warning"><?=$k['kname']?>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">5</span>
            </button><br/>
            <?php endforeach ?>
            
                
        <?php break;
        case "bronze": ?>
                
        <?php break;
        case "silver": ?>
            
    <?php break;
        case "paket": ?>
            
            <?php break;
}} ?>
            <input type="hidden" id="soalClass" name="soalClass">
            </form>
            </div>
            <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>
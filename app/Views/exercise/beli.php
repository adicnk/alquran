<?= $this->extend('template/dashboard-beli') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="card-header">
                <h4 class="text-center">Pembelajaran tentang Tubuh Manusia</h4>
            </div> -->
            <div class="card-body">
                
                <form method="post" action="/belipaket">
                    <?= csrf_field() ?>
                    
                    <?php foreach ($paket as $pkt) {
                        switch ($pkt['paket']) {
                            case "demo": 
                                ?>
            <h3>Paket yg Digunakan</h3><hr/>
            <!--<h5>Latihan Soal dengan Jawaban Tanpa Pembahasan</h5>-->
            <?php $queryClass = $db->table('kategori_soal')->getWhere(['is_tp' => 1]);
            foreach ($queryClass->getResult('array') as $k) : ?>
            <button class="btn btn-secondary" disabled>
            <span><?=$k['kname']?></span>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">6 soal</span>
            </button>
            <?php endforeach ?>
            <br/>
            <!--<h5>Latihan Soal dengan Jawaban dan Pembahasan</h5>-->
            <?php $queryClass = $db->table('kategori_soal')->getWhere(['is_tp' => null]);
            foreach ($queryClass->getResult('array') as $k) : ?>
            <button type="submit" onclick="setSoalClass(<?=$k['id']?>)"  class="btn btn-warning"><?=$k['kname']?>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">66</span>
            </button><br/>
            <?php endforeach ?>

            <br/><hr/>
            <h3>Beli Paket</h3><hr/>
            <?php $queryClass = $db->table('kategori_soal')->getWhere(['is_tp' => 1]);
            foreach ($queryClass->getResult('array') as $k) : ?>
            <button class="btn btn-warning" disabled>
            <span><?=$k['kname']?></span>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">180++ soal</span>
            </button>
            <h6>  <?= ($k['price']) ? 'Harga: Rp ' :'' ?><?= number_format($k['price']); ?>
            <?= $k['price'] ?  '<button role="link" type="submit" id="kategoriID" name="KategpriID" href="belipaket/'.$k['id'].'" class="btn btn-primary btn-sm">Beli</button>':'';?>
            
            <?php $queryUS = $db->query("SELECT * FROM user_subcribe 
                WHERE user_id=".$userID." AND kategori_soal_id=".$k['id']);                
            foreach ($queryUS->getResult('array') as $us) : ?>
                <?php //d($us['is_confirm']);
                if ($queryUS){                
                if ($us['is_confirm']) {
                    echo '<button class="btn btn-primary btn-sm" disabled>Beli</button>';
                }}else{
                    
                }
                ?>
            <?php endforeach; endforeach; ?>
                
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
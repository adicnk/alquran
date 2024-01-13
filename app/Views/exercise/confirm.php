<?= $this->extend('template/dashboard-confirm') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="card-header">
                <h4 class="text-center">Pembelajaran tentang Tubuh Manusia</h4>
            </div> -->
            <div class="card-body">
                
                <form method="post" action="/bayar" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
            <h4>Konfirmasi Pembayaran Pembelian Paket Soal</h4><hr/>
            <?php $userID = session()->get('userID'); 
                $nilaiNull; 
                $query = $db->query("SELECT * FROM user_subcribe as us 
                INNER JOIN kategori_soal as ks 
                WHERE us.subcribe_id = ks.id AND us.is_confirm is NULL AND us.user_id=".$userID);                
                foreach ($query->getResultArray() as $q) :
            ?>
            <a class="btn btn-primary">
            <span><?=$q['kname']?></span>
            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">50</span>
            </a>
            <h6>  <?= ($q['price']) ? 'Harga: Rp ' :'' ?><?= number_format($q['price']); ?>
                
            <div class="form-row align-items-right mt-3">
                <div class="col-7">                    
                    <div><em>Unggah bukti transfer anda</em></div>
                    <div>
                        <input type="file" name="fileGambar" id="fileGambar" class="form-control-file <?= ($validation->hasError('fileGambar')) ? ' is-invalid': ''?>">
                        <div class="invalid-feedback"><?= $validation->getError('fileGambar')?></div>
                        <button type="submit" onclick="setSoalClass(<?=$q['kategori_soal_id']?>)"  class="btn btn-secondary">Konfirmasi</button>
                    </div>
                </div>
            </div>

            <hr/><?php endforeach;  ?>
                
            <input type="hidden" id="soalClass" name="soalClass">
            </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>
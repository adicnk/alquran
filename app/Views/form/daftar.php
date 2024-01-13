<?= $this->extend('template/daftar') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<div class="mt-3">
        <hr>
    </div>
    <!-- Page Heading -->
    <div class="mb-2">
        <h1 class="h3 mb-0 text-gray-800"><center><strong><?= $title; ?></strong></center></h1>         
    </div>

    <div class="mt-3">
        <hr>
    </div>

    <!-- Nested Row within Card Body -->
    <div class="card o-hidden border-0 mt-3 bg-light">
        <div class="card-block mt-3">
        <div class="col-2"></div>
        <div class="col">            
            <div class="card-text text-center">
            
                <form method="post" action="../submit/daftar">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">                    
                    <div class=" form-row align-items-right mt-3">
                    <? //$validation->listErrors(); ?>
                    </div>

                        <div class=" form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Nama</strong></div>
                                    <input type="text" name="namaUser" id="namaUser" class="form-control <?= ($validation->hasError('namaUser')) ? ' is-invalid': ''?>" placeholder="Masukkan Nama ......" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('namaUser')?>">
                                    <div class="invalid-feedback"><?= $validation->getError('namaUser')?></div>                                    
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Sekolah</strong></div>
                                    <input type="text" name="asalUser" id="asalUser" class="form-control" placeholder="Masukkan Sekolah..." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('asalUser')?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Jurusan</strong></div>
                                    <select class="form-control" name="jurusanUser" id="jurusanUser" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                        <option value=1>D3 Keperawatan</option>
                                        <option value=2>S1 Profesi Ners</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Email</strong></div>
                                    <input type="email" name="emailUser" id="emailUser" class="form-control <?= ($validation->hasError('emailUser')) ? ' is-invalid': ''?>" placeholder="Masukkan Email ......" onfocusin="yellowin(this);" onfocusout="whiteout(this)" value="<?= old('emailUser')?>">
                                    <div class="invalid-feedback"><?= $validation->getError('emailUser')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Handphone</strong></div>
                                    <input type="hpUser" name="hpUser" id="hpUser" class="form-control <?= ($validation->hasError('hpUser')) ? ' is-invalid': ''?>" placeholder="Masukkan nomor handphone ......" onfocusin="yellowin(this);" onfocusout="whiteout(this)" value="<?= old('hpUser')?>">
                                    <div class="invalid-feedback"><?= $validation->getError('hpUser')?></div>
                                </div>
                            </div>
                        </div>
                        
                        <hr/>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Username</strong></div>
                                    <input type="text" name="usernameUser" id="usernameUser" class="form-control <?= ($validation->hasError('usernameUser')) ? ' is-invalid': ''?>" placeholder="Buat Username untuk Login ......" onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('usernameUser')?>">
                                    <div class="invalid-feedback"><?= $validation->getError('usernameUser')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Password</strong></div>
                                    <input type="password" name="passwordUser" id="passwordUser" class="form-control <?= ($validation->hasError('passwordUser')) ? ' is-invalid': ''?>" placeholder="Buat Password untuk Login ......" onfocusin="yellowin(this);" onfocusout="whiteout(this)" value="<?= old('passwordUser')?>">
                                    <div class="invalid-feedback"><?= $validation->getError('passwordUser')?></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3"><hr/>
                        </div>

                    </div>                
                    <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">SIMPAN</button>
                </form>
                <a href="../login/fp" class="btn btn-lg btn-danger btn-block mt-3 mb-4">CANCEL</a>
            </div>

        </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>
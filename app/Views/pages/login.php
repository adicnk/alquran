<?= $this->extend('layout/template-login') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <form class="form-signin" method="post" action="login/submit">
                            <img class="mb-4" src="logo/logo.png" alt="" width="160" height="155">
                            <h5 class="mb-1 font-weight-normal">APLIKASI CBT</h5>
                            <h5 class="mb-3 font-weight-normal">UJI KOMPETENSI</h5>
                            <h3 class="mb-3 font-weight-bold mt-2">STIKEP PPNI <br>JAWA BARAT</h3>

                            <!-- Flash Data -->
                            <?php if (session()->getFlashdata('message')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('message') ?>
                                </div>
                            <?php endif ?>

                            <label for="email" class="sr-only mt-2">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="masukkan alamat email" onfocusout="setSubject()" required autofocus>
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" id="password" name="password" class="form-control mt-2" placeholder="masukkan password" required>
                            <!-- <select id="ujian" name="ujian" class="form-control mt-2" onchange="changeType()">
                                <option value="1">Uji Kompetensi</option>
                                <option value="2">Uji Mata Kuliah</option>
                            </select>
                            <div id="divsubject">
                                <select id="subject" name="subject" class="form-control mt-2">
                                </select>
                            </div> -->
                            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Masuk</button>
                            <p class="mt-3 mb-2 text-muted">&copy; 2007 - 2021</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
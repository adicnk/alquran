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
                    <a class="nav-link" href="../../../admin/materi">
                        <div class="sb-nav-link-icon"><i class="fas fa-hand-point-left"></i></div>
                        Kembali ke List Materi
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

                            <?php foreach ($content as $cnt) : ?>
                                <form method="post" action="../../update/materi/<?= $cnt['id'] ?>">
                                    <?= csrf_field() ?>
                                    <img class=" mb-4" src="/logo/logo.png" alt="" width="140" height="135">
                                    <h1 class="h3 mb-3 font-weight-bold text-white bg-primary">EDIT MATERI UJIAN</h1>
                                    <hr>

                                    <div class="accordion" id="acdQuestion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Bagian Pertanyaan
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#acdQuestion">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <h5>Pertanyaan</h5>
                                                        <textarea id="question" name="question"><?= $cnt['question'] ?></textarea>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-4">
                                                            <label for="major">Jurusan</label>
                                                            <select id="major" name="major" class="form-control ml-2">
                                                                <option value="1" <?= $cnt['class_id'] == 1 ? "selected" : "" ?>>D3 Keperawatan</option>
                                                                <option value="2" <?= $cnt['class_id'] == 2 ? "selected" : "" ?>>Profesi Ners</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="kategori">Kategori</label>
                                                            <select id="kategori" name="kategori" class="form-control ml-2" onchange="changeType()">
                                                                <option value=" 1" <?= $cnt['event_category_id'] == 1 ? "selected" : "" ?>>Uji Kompetensi</option>
                                                                <option value="2" <?= $cnt['event_category_id'] == 2 ? "selected" : "" ?>>Uji Mata Kuliah</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4" id="divsubject" name="divsubject">
                                                            <label for="subjects">Mata Kuliah</label>
                                                            <select id="subjects" name="subjects" class="form-control ml-2">
                                                                <?php
                                                                $querySubjects = $db->query("SELECT * FROM subjects");
                                                                foreach ($querySubjects->getResult('array') as $qs) :
                                                                    if ($qs['id'] == $cnt['subjects_id']) {
                                                                ?>
                                                                        <option value="<?= $cnt['subjects_id'] ?>" selected>
                                                                            <?= $qs['name'] ?>
                                                                        </option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $qs['id'] ?>">
                                                                            <?= $qs['name'] ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion" id="acdAnswer">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Bagian Jawaban
                                                </button>
                                            </h2>

                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acdAnswer">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <h5>Jabawan Opsi A</h5>
                                                        <?php
                                                        $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=1");
                                                        foreach ($queryOption->getResult('array') as $qo) :
                                                        ?>
                                                            <textarea id="answerA" name="answerA"><?= $qo['answer'] ?></textarea>
                                                        <?php endforeach ?>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <h5>Jabawan Opsi B</h5>
                                                        <?php
                                                        $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=2");
                                                        foreach ($queryOption->getResult('array') as $qo) :
                                                        ?>
                                                            <textarea id="answerB" name="answerB"><?= $qo['answer'] ?></textarea>
                                                        <?php endforeach ?>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <h5>Jabawan Opsi C</h5>
                                                        <?php
                                                        $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=3");
                                                        foreach ($queryOption->getResult('array') as $qo) :
                                                        ?>
                                                            <textarea id="answerC" name="answerC"><?= $qo['answer'] ?></textarea>
                                                        <?php endforeach ?>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <h5>Jabawan Opsi D</h5>
                                                        <?php
                                                        $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=4");
                                                        foreach ($queryOption->getResult('array') as $qo) :
                                                        ?>
                                                            <textarea id="answerD" name="answerD"><?= $qo['answer'] ?></textarea>
                                                        <?php endforeach ?>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <h5>Jabawan Opsi E</h5>
                                                        <?php
                                                        $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=5");
                                                        foreach ($queryOption->getResult('array') as $qo) :
                                                        ?>
                                                            <textarea id="answerE" name="answerE"><?= $qo['answer'] ?></textarea>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion" id="acdDescription">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Bagian Pembahasan
                                                </button>
                                            </h2>

                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#acdDescription">
                                                <div class="accordion-body">
                                                    <div class="row mt-2">
                                                        <div class="col-5"></div>
                                                        <div class="col-2">
                                                            <label for="choosen">Pilih Jawaban</label>
                                                            <select id="choosen" name="choosen" class="form-control ml-2">
                                                                <option value="1" <?php
                                                                                    $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=1");
                                                                                    foreach ($queryOption->getResult('array') as $qo) :
                                                                                    ?> <?= $qo['is_answer'] == 1 ? "selected" : "" ?>>
                                                                    <?php endforeach ?>Opsi A
                                                                </option>

                                                                <option value="2" <?php
                                                                                    $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=2");
                                                                                    foreach ($queryOption->getResult('array') as $qo) :
                                                                                    ?> <?= $qo['is_answer'] == 1 ? "selected" : "" ?>>
                                                                    <?php endforeach ?>Opsi B
                                                                </option>

                                                                <option value="3" <?php
                                                                                    $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=3");
                                                                                    foreach ($queryOption->getResult('array') as $qo) :
                                                                                    ?> <?= $qo['is_answer'] == 1 ? "selected" : "" ?>>
                                                                    <?php endforeach ?>Opsi C
                                                                </option>

                                                                <option value="4" <?php
                                                                                    $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=4");
                                                                                    foreach ($queryOption->getResult('array') as $qo) :
                                                                                    ?> <?= $qo['is_answer'] == 1 ? "selected" : "" ?>>
                                                                    <?php endforeach ?>Opsi D
                                                                </option>

                                                                <option value="5" <?php
                                                                                    $queryOption = $db->query("SELECT * FROM content_option WHERE content_id=" . $cnt['id'] . " AND option=5");
                                                                                    foreach ($queryOption->getResult('array') as $qo) :
                                                                                    ?> <?= $qo['is_answer'] == 1 ? "selected" : "" ?>>
                                                                    <?php endforeach ?>Opsi E
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-5"></div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <label for="description">
                                                            Pembahasan Soal
                                                        </label>
                                                        <textarea id="description" name="description"><?= $cnt['description'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">UPDATE</button>
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
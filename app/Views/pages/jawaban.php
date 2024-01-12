<?= $this->extend('layout/template-score') ?>
<?= $this->section('content') ?>

<?php
$db = \Config\Database::connect();
$school = session()->get('school');
$event = session()->get('event');
$user = session()->get('user');
$eventcontent = session()->get('eventcontent');
$question = session()->get('question');
$startnumber = session()->get('startnumber');
$doneanswer = session()->get('doneanswer');
$doubtanswer = session()->get('doubtanswer');
$rightanswer = session()->get('rightanswer');
$timeremaining = session()->get('timeremaining');

// User Background Layout
$bg_red = session()->get('bg_red');
$bg_blue = session()->get('bg_blue');

foreach ($user as $usr) :
    session()->set('bg', $usr['class_id']);
endforeach;

$bg = session()->get('bg');
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <img class="ml-2" src="../logo/logo.png" width="52px" height="54px">
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
                    <div class="sb-sidenav-menu-heading">Bantuan</div>
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Petunjuk Pelaksanaan
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Nama :
                    <b>
                        <?php foreach ($user as $usr) : ?>
                            <?= $usr['name'] ?>
                        <?php endforeach ?>
                    </b>
                </div>
                <div class="small">NIM :
                    <b>
                        <?php foreach ($user as $usr) : ?>
                            <?= $usr['nim'] ?>
                        <?php endforeach ?>
                    </b>
                </div>
                <div class="small">Jurusan :
                    <b>
                        <?php foreach ($user as $usr) : ?>
                            <?php
                            $queryClass = $db->table('class')->getWhere(['id' => $usr['class_id']]);
                            foreach ($queryClass->getResult('array') as $qcls) :
                            ?>
                                <?= $qcls['name'] ?>
                            <?php endforeach ?>
                        <?php endforeach ?>
                    </b>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main class="mb-3">
            <div class="container-fluid">
                <h1 style="<?= $bg == 1 ? $bg_red : $bg_blue ?>" class="mt-4 text-center text-white">Review Jawaban
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="mata-kuliah breadcrumb-item active">
                    </li>
                </ol>
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4">
                        <!-- <h2 class="text-danger">Waktu Sekarang :</h2> -->
                        <h2 class="text-info" id="time-now" name="time-now"></h2>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-danger text-center"></h2>
                        <h2 class="text-center" id="time-remain" name="time-remain">
                            <?php
                            foreach ($event as $ev) :
                            ?>
                                <h3>
                                    <?php
                                    $noPrev = '/jawaban/' . ($startnumber - 1);
                                    $noNext = '/jawaban/' . ($startnumber + 1);
                                    ?>

                                    <a href="<?= $startnumber == 1 ? "" : $noPrev ?>"><i class="fas fa-angle-double-left fa-lg <?= $startnumber == 1 ? "text-light" : "text-info" ?>"></i></a>
                                    No. <?= $startnumber ?> dari
                                    <?php
                                    foreach ($event as $ev) :
                                    ?>
                                        <?= $ev['total_content'] ?>
                                    <?php endforeach ?>

                                    <a href="<?= $startnumber == $ev['total_content'] ? "" : $noNext ?>"><i class="fas fa-angle-double-right fa-lg <?= $startnumber == $ev['total_content'] ? "text-light" : "text-info" ?>"></i></a>
                                </h3>
                            <?php endforeach ?>
                        </h2>
                    </div>
                    <div class="col-md-2">
                        <!-- <h2 class="text-danger">Waktu Berakhir :</h2> -->
                        <h2 class="text-info" id="time-up" name="time-up"></h2>
                        <a href="../ujian/logout" class="btn btn-danger mt-3 ml-4 font-weight-bold">KELUAR</a>
                        <a href="../ujian/score" class="btn btn-info mt-3 ml-4 font-weight-bold" onclick="Javascript:history.go(1);">NILAI UJIAN</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header text-center">

                            </div>
                            <div class="card-block">
                                <?php
                                foreach ($event as $ev) :
                                    $queryContent = $db->query("SELECT * FROM event_content evc INNER JOIN content cnt ON cnt.id=evc.content_id WHERE evc.indexed=" . $question[$startnumber]);
                                    foreach ($queryContent->getResult('array') as $qc) :
                                ?>
                                        <h5 class="card-title ml-4 mt-3"><?= $qc['question'] ?></h5>
                                        <div class="card-text">
                                            <div class="row mt-3">
                                                <div class="col-10 ml-4">
                                                    <p> A.
                                                        <?php
                                                        $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=1");
                                                        foreach ($queryJawaban->getResult('array') as $qj) :
                                                        ?>
                                                            <?= $qj['answer'] ?>
                                                        <?php endforeach ?>
                                                        <?= ($doneanswer[$startnumber] == "A" or $doubtanswer[$startnumber] == "A") ? '<i class="fas fa-check"></i>' : "" ?>
                                                    </p>
                                                    <p> B.
                                                        <?php
                                                        $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=2");
                                                        foreach ($queryJawaban->getResult('array') as $qj) :
                                                        ?>
                                                            <?= $qj['answer'] ?>
                                                        <?php endforeach ?>
                                                        <?= ($doneanswer[$startnumber] == "B" or $doubtanswer[$startnumber] == "B") ? '<i class="fas fa-check"></i>' : "" ?>
                                                    </p>
                                                    <p> C.
                                                        <?php
                                                        $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $question[$startnumber] . " AND option=3");
                                                        foreach ($queryJawaban->getResult('array') as $qj) :
                                                        ?>
                                                            <?= $qj['answer'] ?>
                                                        <?php endforeach ?>
                                                        <?= ($doneanswer[$startnumber] == "C" or $doubtanswer[$startnumber] == "C") ? '<i class="fas fa-check"></i>' : "" ?>
                                                    </p>
                                                    <p> D.
                                                        <?php
                                                        $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=4");
                                                        foreach ($queryJawaban->getResult('array') as $qj) :
                                                        ?>
                                                            <?= $qj['answer'] ?>
                                                        <?php endforeach ?>
                                                        <?= ($doneanswer[$startnumber] == "D" or $doubtanswer[$startnumber] == "D") ? '<i class="fas fa-check"></i>' : "" ?>
                                                    </p>
                                                    <p> E.
                                                        <?php
                                                        $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=5");
                                                        foreach ($queryJawaban->getResult('array') as $qj) :
                                                        ?>
                                                            <?= $qj['answer'] ?>
                                                        <?php endforeach ?>
                                                        <?= ($doneanswer[$startnumber] == "E" or $doubtanswer[$startnumber] == "E") ? '<i class="fas fa-check"></i>' : "" ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="btn <?= $doneanswer[$startnumber] == $rightanswer[$startnumber] or $doubtanswer[$startnumber] == $rightanswer[$startnumber] ? "btn-warning" : "btn-danger" ?>"><?= ($doubtanswer[$startnumber] == "" and $doneanswer[$startnumber] == "") ? "<b>Anda tidak menjawab</b>" : "Anda menjawab : " ?><b><?= $doneanswer[$startnumber] == "" ? $doubtanswer[$startnumber] : $doneanswer[$startnumber] ?></b></h6>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="card bg-primary text-white mb-4 mt-3">
                            <div class="card-body">
                                Jawaban yang benar adalah :
                                <b>
                                    <?= $rightanswer[$startnumber] ?>
                                </b>
                            </div>
                            <div class="card-title ml-4">Penjelasannya seperti berikut :</div>

                            <div class="card-footer mt-1 font-weight-bold">
                                <?php
                                $queryKonfirmasi = $db->query("SELECT * FROM content WHERE id=" . $startnumber);
                                foreach ($queryKonfirmasi->getResult('array') as $qk) :
                                ?>
                                    <?= $qk['description'] ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex flex-column align-items-center justify-content-between small">
                    <div class="text-muted">&copy; 2017 - 2021</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?= $this->endSection() ?>
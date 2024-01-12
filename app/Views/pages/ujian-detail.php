<?= $this->extend('layout/template-ujian-detail') ?>
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
                <h1 style="<?= $bg == 1 ? $bg_red : $bg_blue ?>" class="mt-4 text-center text-white">
                    <?php
                    foreach ($event as $ev) : ?>
                        <?= $ev['name'] ?>
                    <?php endforeach ?>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="mata-kuliah breadcrumb-item active">
                    </li>
                </ol>
                <div class="row mb-3 align-items-center">
                    <div class="col-md-3">
                        <!-- <h2 class="text-danger">Waktu Sekarang :</h2> -->
                        <h2 class="text-info" id="time-now" name="time-now"></h2>
                    </div>
                    <div class="col-md-7">
                        <h2 class="text-danger text-center">Waktu Tersisa</h2>
                        <h2 class="text-info text-center" id="time-remain" name="time-remain"></h2>
                    </div>
                    <div class="col-md-2">
                        <!-- <h2 class="text-danger">Waktu Berakhir :</h2> -->
                        <h2 class="text-info" id="time-up" name="time-up"></h2>
                        <a href="../ujian/score" class="btn btn-info mt-3 ml-4 font-weight-bold">SELESAI</a>
                    </div>
                </div>

                <form onSubmit="JavaScript:disableRefreshDetection()" id="form-ujian" method="post" action="../ujian">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5>No. <?= $startnumber ?> dari
                                        <?php
                                        foreach ($event as $ev) :
                                        ?>
                                            <?= $ev['total_content'] ?>
                                        <?php endforeach ?>
                                    </h5>
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
                                                        <input type="checkbox" id="a-option" name="options" value="1" onclick="checkJawaban(1)" <?= ($doneanswer[$startnumber] == "A" or $doubtanswer[$startnumber] == "A") ? "checked" : "" ?>>
                                                        <label for="a-option" class="ml-2">
                                                            A.
                                                            <?php
                                                            $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=1");
                                                            foreach ($queryJawaban->getResult('array') as $qj) :
                                                            ?>
                                                                <?= $qj['answer'] ?>
                                                            <?php endforeach ?>
                                                        </label><br />

                                                        <input type="checkbox" id="b-option" name="options" value="2" onclick="checkJawaban(2)" <?= ($doneanswer[$startnumber] == "B" or $doubtanswer[$startnumber] == "B") ? "checked" : "" ?>>
                                                        <label for="b-option" class="ml-2">
                                                            B.
                                                            <?php
                                                            $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=2");
                                                            foreach ($queryJawaban->getResult('array') as $qj) :
                                                            ?>
                                                                <?= $qj['answer'] ?>
                                                            <?php endforeach ?>
                                                        </label><br />

                                                        <input type="checkbox" id="c-option" name="options" value="3" onclick="checkJawaban(3)" <?= ($doneanswer[$startnumber] == "C" or $doubtanswer[$startnumber] == "C") ? "checked" : "" ?>>
                                                        <label for="c-option" class="ml-2">
                                                            C.
                                                            <?php
                                                            $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=3");
                                                            foreach ($queryJawaban->getResult('array') as $qj) :
                                                            ?>
                                                                <?= $qj['answer'] ?>
                                                            <?php endforeach ?>
                                                        </label><br />
                                                        <input type="checkbox" id="d-option" name="options" value="4" onclick="checkJawaban(4)" <?= ($doneanswer[$startnumber] == "D" or $doubtanswer[$startnumber] == "D") ? "checked" : "" ?>>
                                                        <label for="d-option" class="ml-2">
                                                            D.
                                                            <?php
                                                            $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=4");
                                                            foreach ($queryJawaban->getResult('array') as $qj) :
                                                            ?>
                                                                <?= $qj['answer'] ?>
                                                            <?php endforeach ?>
                                                        </label><br />
                                                        <input type="checkbox" id="e-option" name="options" value="5" onclick="checkJawaban(5)" <?= ($doneanswer[$startnumber] == "E" or $doubtanswer[$startnumber] == "E") ? "checked" : "" ?>>
                                                        <label for="e-option" class="ml-2">
                                                            E.
                                                            <?php
                                                            $queryJawaban = $db->query("SELECT * FROM content_option WHERE content_id=" . $qc['id'] . " AND option=5");
                                                            foreach ($queryJawaban->getResult('array') as $qj) :
                                                            ?>
                                                                <?= $qj['answer'] ?>
                                                            <?php endforeach ?>
                                                        </label>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="isDoubt" name="isDoubt" value="
                                                <?php
                                                $doubt = "";
                                                if (!$doubtanswer[$startnumber] == "") {
                                                    echo '0';
                                                    $doubt = 10;
                                                } else if (!$doneanswer[$startnumber] == "") {
                                                    echo '1';
                                                    $doubt = 1;
                                                }
                                                if ($doubtanswer[$startnumber] == "" and $doneanswer[$startnumber] == "") {
                                                    echo null;
                                                }
                                                ?>
                                                ">

                                                <input type="hidden" id="isAnswer" name="isAnswer" value="<?= session()->get('isAnswer') ?>">

                                            </div>
                                            <p class="text-success ml-4 mt-3 font-weight-bold" style="display:none" id="jawaban"></p>
                                            <input type="submit" class="btn btn-success mt-3 ml-4 font-weight-bold" id="Submit" value="Submit Jawaban" onclick="unselectRaguRagu()"></input>

                                            <?php
                                            if ($doneanswer[$startnumber] == "" and $doubtanswer[$startnumber] == "") {
                                                echo '<input type="submit" class="btn btn-warning mt-3 ml-4 font-weight-bold" id="Doubt" value="Ragu - Ragu" onclick="selectRaguRagu()"></input>';
                                            }
                                            if (!$doubtanswer[$startnumber] == "") {
                                                echo '<input type="submit" class="btn btn-warning mt-3 ml-4 font-weight-bold" id="Doubt" value="Ragu - Ragu" onclick="selectRaguRagu()"></input>';
                                            }
                                            ?>

                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header text-center">
                                    <h5>Pilih Nomor Soal</h5>
                                </div>
                                <div class="card-block mt-3">
                                    <div class="card-text text-center">
                                        <?php foreach ($event as $ev) : ?>
                                            <?php for ($i = 1; $i <= $ev['total_content']; $i++) { ?>
                                                <a href="/ujian/<?= $i ?>" type="submit" id="box-number" name="box-number" class="
                                                <?php
                                                if ($doneanswer[$i]) {
                                                    echo 'box-green';
                                                } else if ($doubtanswer[$i]) {
                                                    echo 'box-fire';
                                                } else {
                                                    echo 'box-red';
                                                }
                                                ?> 
                                                text-white font-weight-bold mr-2 mb-2" value="<?= $i ?>"><?= $i ?></a>
                                            <?php } ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <footer class="py-4 <?= $bg == 1 ? 'bg-success' : 'bg-secondary' ?> mt-auto">
            <div class="container-fluid">
                <div class="d-flex flex-column align-items-center justify-content-between small">
                    <div class="text-white">&copy; 2017 - 2021</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?= $this->endSection() ?>
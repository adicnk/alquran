<?= $this->extend('layout/template-ujian') ?>
<?= $this->section('content') ?>

<?php
$db = \Config\Database::connect();
$school = session()->get('school');
$event = session()->get('event');
$user = session()->get('user');
$eventcontent = session()->get('eventcontent');
$startnumber = session()->get('startnumber');
$doneanswer = session()->get('doneanswer');
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

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="ujian/logout">Logout</a>
            </div>
        </li>
    </ul>
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
    <div style="<?= $bg == 1 ? $bg_red : $bg_blue ?>" id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <h1 class="<?= $bg == 1 ? "bg-success" : "bg-secondary" ?> text-center text-white">
                                    <?php
                                    foreach ($eventcontent as $evc) :
                                        $queryEvent = $db->query("SELECT * FROM event WHERE id=" . $evc['content_id']);
                                        foreach ($queryEvent->getResult('array') as $qe) :
                                    ?>
                                            <?= $qe['name'] ?>
                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                </h1>
                                <div id="time-remain" name="time-remain"></div>
                                <h4 class="text-muted text-center mt-4 mb-3 mr-3 ml-3">
                                    Jika sudah mengerti aturan mainnya, silahkan langsung dilanjutkan memulai dengan menekan tombol MULAI di bawah, atau jika belum gunakan Petunjuk Pelaksanaan dari link yang ada di sidebar.
                                </h4>
                                <div id="time-wait" name="time-wait" class="btn btn-lg btn-danger btn-block"></div>
                                <div id="time-run">
                                    <a href="/ujian/1" class="btn btn-lg btn-warning btn-block mt-5">
                                        <h4>MULAI</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
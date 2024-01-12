<?= $this->extend('layout/template-list') ?>
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
                    <a class="nav-link" href="dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-hand-point-left"></i></div>
                        Kembali ke Menu Awal
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
                        <div class="card-text">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-2">
                                    <img class="mb-4" src="/logo/logo.png" alt="" width="80%">
                                </div>
                                <div class="col-6 text-center text-success">
                                    <h2>Daftar Materi Ujian</h2>
                                    <hr class="garis1">
                                    <h5>jurusan Profesi Ners dan D3-Keperawatan</h5>
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse mt-3">
                        <div class="p-2">
                            <div class="search-field d-none d-md-block">
                                <form class="d-flex align-items-center h-100" action="/admin/materi" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-transparent border-0" placeholder="cari materi ujian" name="keyword">
                                        <div class="input-group-append">
                                            <div class="input-group-prepend bg-transparent">
                                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                                <button class="btn btn-info" type="submit" name="submit">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <form>
                            <div class="p-3 mr-5">
                                <div class="font-weight-bold">Filter Data</div>
                                <select id="filter-class" name="filter-class" class="form-control mt-2" onchange="changeType()">
                                    <option value="0" <?= $filter == 0 ? 'selected' : '' ?>>All Prodi</option>
                                    <option value="1" <?= $filter == 1 ? 'selected' : '' ?>>D3 Keperawatan</option>
                                    <option value="2" <?= $filter == 2 ? 'selected' : '' ?>>Profesi Ners</option>
                                </select>
                                <div class="mt-2"><button class="btn btn-info" type="submit" name="filter-submit">Search</button></div>
                            </div>
                        </form>
                    </div>
                    <a class="text-center text-info font-weight-bold mr-5 mt-3" href="/form/create/materi"><img src="../icon/add.png" />Add Materi Ujian</a>

                    <!-- Pagination Links -->
                    <div><?= $pager->links('content', 'custom_pagination') ?></div>

                    <!-- Flash Data -->
                    <?php if (session()->getFlashdata('message')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif ?>

                    <div class="table-responsive">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pertanyaan</th>
                                    <th>Prodi</th>
                                    <th>Kategori</th>
                                    <th>Mata Kuliah</th>
                                    <th>Dipilih</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1 + (5 * ($currentPage - 1));
                                foreach ($content as $ct) :
                                ?>
                                    <tr>
                                        <td><?= $index ?></td>
                                        <td width=30%><?= substr($ct['question'], 0, 90) . ' ...' ?></td>
                                        <?php
                                        $queryClass = $db->query("SELECT * FROM class WHERE id=" . $ct['class_id']);
                                        foreach ($queryClass->getResult('array') as $qc) :
                                        ?>
                                            <td><?= $qc['name'] ?></td>
                                        <?php endforeach ?>
                                        <?php
                                        $queryEvent = $db->query("SELECT * FROM event_category WHERE id=" . $ct['event_category_id']);
                                        foreach ($queryEvent->getResult('array') as $qe) :
                                        ?>
                                            <td><?= $qe['name'] ?></td>
                                        <?php endforeach ?>
                                        <?php
                                        $querySubjects = $db->query("SELECT * FROM subjects WHERE id=" . $ct['subjects_id']);
                                        if ($querySubjects->getResult('array')) {
                                            foreach ($querySubjects->getResult('array') as $qs) :
                                        ?>
                                                <td><?= ($qs['name']) ?></td>
                                            <?php endforeach ?>
                                        <?php
                                        } else {
                                        ?>
                                            <td></td>
                                        <?php
                                        }
                                        ?>
                                        <td>
                                            <input type="checkbox" <?= $ct['is_choosen'] == 1 ? "checked" : "" ?> onclick="Javascript:location.href='/materi/active/<?= $ct['id'] ?>'">
                                        </td>
                                        <td>
                                            <a href="/form/edit/materi/<?= $ct['id'] ?>"><img src="../icon/edit.png" class="mr-2" /></a>
                                            <a href="/materi/delete/<?= $ct['id'] ?>"><img src="../icon/delete.png" /></a>
                                        </td>
                                    </tr>
                                <?php
                                    $index++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?= $this->endSection() ?>
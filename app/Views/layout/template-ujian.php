<?php $db = \Config\Database::connect(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Uji Kompetensi</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/custom.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</head>

<body class="sb-nav-fixed">

    <?= $this->renderSection('content'); ?>

    <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-bar-demo.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-demo.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {

            window.onhashchange = function() {
                $('body').trigger('click');
            }

            var timeEnd = setInterval(function() {
                countTimeStart();
            }, 10);

            function disableBack() {
                window.history.forward()
            }

            window.onload = disableBack();
            window.onpageshow = function(evt) {
                if (evt.persisted) disableBack()
            }

            function countTimeStart() {
                // Calculating Start Time
                <?php
                date_default_timezone_set('Asia/Jayapura');
                $timer = $db->query("SELECT * FROM timer WHERE id=1");
                foreach ($timer->getResult('array') as $t) :
                ?>
                    var tahunDB = <?= $t['year'] ?>;
                    var bulanDB = <?= $t['month'] - 1 ?>;
                    if (bulanDB == 0) {
                        bulanDB = 12;
                    }
                    var hariDB = <?= $t['day'] ?>;
                    var detikDB = <?= $t['second'] ?>;
                    var menitDB = <?= $t['minute'] + 1 ?>;
                    if (menitDB == 60) {
                        menitDB = 0;
                        var jamDB = <?= $t['hour'] + 1 ?>;
                        if (jamDB == 25) {
                            var jamDB = <?= $t['hour'] ?>;
                            jamDB = 1;
                        }
                    } else {
                        var jamDB = <?= $t['hour'] ?>;
                    }
                <?php endforeach ?>

                var r = new Date(tahunDB, bulanDB, hariDB, jamDB, menitDB);
                var cddJS = r.getTime();

                var s = new Date()
                var now = s.getTime();
                var distance = cddJS - now;

                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var x = document.getElementById("time-run");
                var y = document.getElementById("time-wait");
                if (distance < 0) {
                    y.style.display = 'none';
                    x.style.display = 'block';
                    countTimeEnd();
                } else {
                    x.style.display = 'none';
                    y.style.display = 'block';
                    $("#time-wait").html("<h3>Ujian dimulai dalam " + hours + ":" + minutes + ":" + seconds + "</h3>");
                    countTimeStart();
                }
            }

            function countTimeEnd() {
                // Calculating End Time
                <?php
                date_default_timezone_set('Asia/Jayapura');
                $timer = $db->query("SELECT * FROM timer WHERE id=2");
                foreach ($timer->getResult('array') as $t) :
                ?>
                    var tahunDB = <?= $t['year'] ?>;
                    var bulanDB = <?= $t['month'] - 1 ?>;
                    if (bulanDB == 0) {
                        bulanDB = 12;
                    }
                    var hariDB = <?= $t['day'] ?>;
                    var detikDB = <?= $t['second'] ?>;
                    var menitDB = <?= $t['minute'] + 1 ?>;
                    if (menitDB == 60) {
                        menitDB = 0;
                        var jamDB = <?= $t['hour'] + 1 ?>;
                        if (jamDB == 25) {
                            var jamDB = <?= $t['hour'] ?>;
                            jamDB = 1;
                        }
                    } else {
                        var jamDB = <?= $t['hour'] ?>;
                    }
                <?php endforeach ?>

                var r = new Date(tahunDB, bulanDB, hariDB, jamDB, menitDB);
                var cddJS = r.getTime();

                var s = new Date()
                var now = s.getTime();
                var distance = cddJS - now;

                var x = document.getElementById("time-run");
                if (distance < 0) {
                    x.style.display = 'none';
                } else {
                    x.style.display = 'block';
                    countTimeEnd();
                }
            }

        });
    </script>

</body>

</html>
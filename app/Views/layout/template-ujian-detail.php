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
    <script src="../js/login.js"></script>

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
        function selectRaguRagu() {
            $("#isDoubt").val("1");
        }

        function unselectRaguRagu() {
            $("#isDoubt").val("0");
        }

        function checkJawaban(options) {
            var a = document.getElementById('a-option');
            var b = document.getElementById('b-option');
            var c = document.getElementById('c-option');
            var d = document.getElementById('d-option');
            var e = document.getElementById('e-option');
            var jawaban = document.getElementById("jawaban");
            switch (options) {
                case 1:
                    if (a.checked == true) {
                        b.checked = false;
                        c.checked = false;
                        d.checked = false;
                        e.checked = false;
                        jawaban.style.display = "block";
                        jawaban.innerHTML = "Anda memilih jawaban A";
                        $("#isAnswer").val("A");
                        $("#isDoubt").val("0");
                    } else {
                        jawaban.style.display = "none";
                        $("#isAnswer").val(<?= null ?>);
                        $("#isDoubt").val(<?= null ?>);
                    }
                    break;
                case 2:
                    if (b.checked == true) {
                        a.checked = false;
                        c.checked = false;
                        d.checked = false;
                        e.checked = false;
                        jawaban.style.display = "block";
                        jawaban.innerHTML = "Anda memilih jawaban B";
                        $("#isAnswer").val("B");
                        $("#isDoubt").val("0");
                    } else {
                        jawaban.style.display = "none";
                        $("#isAnswer").val(<?= null ?>);
                        $("#isDoubt").val(<?= null ?>);
                    }
                    break;
                case 3:
                    if (c.checked == true) {
                        a.checked = false;
                        b.checked = false;
                        d.checked = false;
                        e.checked = false;
                        jawaban.style.display = "block";
                        jawaban.innerHTML = "Anda memilih jawaban C";
                        $("#isAnswer").val("C");
                        $("#isDoubt").val("0");
                    } else {
                        jawaban.style.display = "none";
                        $("#isAnswer").val(<?= null ?>);
                        $("#isDoubt").val(<?= null ?>);
                    }
                    break;
                case 4:
                    if (d.checked == true) {
                        a.checked = false;
                        b.checked = false;
                        c.checked = false;
                        e.checked = false;
                        jawaban.style.display = "block";
                        jawaban.innerHTML = "Anda memilih jawaban D";
                        $("#isAnswer").val("D");
                        $("#isDoubt").val("0");
                    } else {
                        jawaban.style.display = "none";
                        $("#isAnswer").val(<?= null ?>);
                        $("#isDoubt").val(<?= null ?>);
                    }
                    break;
                case 5:
                    if (e.checked == true) {
                        a.checked = false;
                        b.checked = false;
                        c.checked = false;
                        d.checked = false;
                        jawaban.style.display = "block";
                        jawaban.innerHTML = "Anda memilih jawaban E";
                        $("#isAnswer").val("E");
                        $("#isDoubt").val("0");
                    } else {
                        jawaban.style.display = "none";
                        $("#isAnswer").val(<?= null ?>);
                        $("#isDoubt").val(<?= null ?>);
                    }
                    break;
            }
        }

        // $(document).ready(function() {
        //     // $("#shown").load("/", function() {});
        //     $("#Submit").click(function() {
        //         var data = $("#form").serialize();
        //         $.ajax({
        //             type: 'POST',
        //             url: 'pages/ujian',
        //             data: data,
        //             cache: false,
        //             success: function(data) {
        //                 //$("#shown").load("/");
        //             }
        //         });
        //     });
        // });

        $(document).ready(function() {

            <?php
            date_default_timezone_set('Asia/Dhaka');
            $timer = $db->query("SELECT * FROM timer where id = 3");
            foreach ($timer->getResult('array') as $t) :
            ?>
                var tahunDB = <?= $t['year'] ?>;
                var bulanDB = <?= $t['month'] ?>;
                var hariDB = <?= $t['day'] ?>;
                var detikDB = <?= $t['second'] ?>;
                var menitDB = <?= $t['minute'] ?>;
                var jamDB = <?= $t['hour'] ?>;
            <?php endforeach ?>

            // Set the date we're counting down to
            var r = new Date(tahunDB, bulanDB, hariDB, jamDB, menitDB, detikDB);
            var countDownDate = r.getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var s = new Date()
                var now = s.getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                $("#time-remain").html(hours + " : " +
                    minutes + " : " + seconds);
                // $("#time-now").html(distance);
                // $("#time-up").html(r);

                // If the count down is finished, write some text
                if (seconds < 1 && minutes < 1 && hours < 1) {
                    clearInterval(x);
                    // $("#time-remain").html("HABIS");
                    window.location.replace("/score");
                }
            }, 1000);
        });
    </script>
</body>

</html>
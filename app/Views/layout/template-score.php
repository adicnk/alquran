<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Uji Kompetensi</title>
    <link href="../css/styles.css" rel="stylesheet" />

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script type="text/javascript" src="../js/kuma-gauge.jquery.js"></script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</head>

<?php
$event = session()->get('event');
foreach ($event as $ev) :
?>

    <body onload="scored(<?= session()->get('score') ?>, <?= $ev['min_pass'] ?>)">
    <?php endforeach ?>
    <?= $this->renderSection('content'); ?>


    <script src="../js/scripts.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

    <script>
        function scored(score, min_pass) {
            $('.but').trigger('click');

            $('.js-score').kumaGauge({
                // value: Math.floor((Math.random() * 99) + 1)
                value: score
            });

            if (score < min_pass) {
                $("#score-desc").html("ANDA TIDAK LULUS");
            } else {
                $("#score-desc").html("ANDA LULUS");
            }
        }

        // $('.js-score').kumaGauge('update', {
        //     value: Math.floor((Math.random() * 99) + 1)
        // });

        // var update = setInterval(function() {
        //     var newVal = Math.floor((Math.random() * 99) + 1);
        //     $('.js-score').kumaGauge('update', {
        //         value: newVal
        //     });
        // }, 1000);
    </script>

    </body>

</html>
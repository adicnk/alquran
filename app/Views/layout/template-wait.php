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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../../../css/bootstrap.min.css" crossorigin="anonymous"> -->
    <script src="../../../../../js/keystroke.js"></script>
    <link href="../../../../../css/styles.css" rel="stylesheet" />
    <link href="../../../../../css/custom.css" rel="stylesheet" />

    <!-- <script src="../../../js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <link href="../../../css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> -->
    <script src="../../../../../js/bootstrap-datepicker.js" type="text/javascript"></script>
    <link href="../../../../../css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />

    <!-- include summernote css/js -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->

    <style type="text/css" media="all">
        @import "../../../../assets/editor/info.css";
        @import "../../../../assets/editor/main.css";
        @import "../../../../assets/editor/widgEditor.css";
    </style>
    <script type="text/javascript" src="../../../../assets/editor/widgEditor.js"></script>

    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</head>

<body class="sb-nav-fixed">

    <?= $this->renderSection('content'); ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="js/chart-area-demo.js"></script>
    <script src="js/chart-bar-demo.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../../../../js/datatables-demo.js"></script>
    <script src="../../../../js/sweetalert2.all.min.js"></script>
    <script src="../../../../js/scripts.js"></script>

    <script>
        function defaultType() {
            var x = document.getElementById("divsubject");
            x.style.display = 'none';
        }
        // $('#datepicker').datepicker({
        //     uiLibrary: 'bootstrap4',
        //     useCurrent: false,
        //     format: "YYYY/MM/DD"
        // });

        $.fn.datepicker.dates['en'] = {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd",
            titleFormat: "MM yyyy",
            /* Leverages same syntax as 'format' */
            weekStart: 0
        };
        $('.datepicker').datepicker();
    </script>

    <script>
        // $(document).ready(function() {
        //     $('#question').summernote();
        //     $('#description').summernote();
        //     $('#answerA').summernote();
        //     $('#answerB').summernote();
        //     $('#answerC').summernote();
        //     $('#answerD').summernote();
        //     $('#answerE').summernote();
        // });

        function getType() {
            var x = document.getElementById("divsubject");
            x.style.display = 'block';
        }

        function changeType() {
            var ujian = document.getElementById("kategori").value
            var x = document.getElementById("divsubject");
            // if (ujian == 2) {
            //     x.style.display = 'block';
            // } else {
            //     x.style.display = 'none';
            // }
            if (ujian == 2) {
                setSubject();
            }
            $("#divsubject").slideToggle();
        }

        function setSubject() {
            var subject = document.getElementById('subjects');
            for (var i = subject.options.length; i-- > -1;) subject.options[i] = null;
            <?php
            $querySubject = $db->query("SELECT * FROM subjects");
            foreach ($querySubject->getResult('array') as $sb) :
            ?>
                $("#subjects").append(new Option("<?= $sb['name'] ?>", "<?= $sb['id'] ?>"));
            <?php endforeach ?>
        }
    </script>
</body>

</html>
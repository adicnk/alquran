<?php $db = \Config\Database::connect(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <link href="userguide/foundation.joyride.css" rel="stylesheet">

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>

</head>

<body class="text-center">
    <?php
    // clear all session
    session()->destroy;
    ?>
    <?= $this->renderSection('content'); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script>
        function changeType() {
            // var ujian = document.getElementById("ujian").value
            // var x = document.getElementById("divsubject");
            // if (ujian == 2) {
            //     x.style.display = 'block';
            // } else {
            //     x.style.display = 'none';
            // }
            $("#divsubject").slideToggle();
        }

        $(document).ready(function() {

            window.onhashchange = function() {
                $('body').trigger('click');
            }

            $("#divsubject").hide();
            //$("#divsubject").slideToggle();
        })

        function setSubject() {
            var subject = document.getElementById('subject');
            for (var i = subject.options.length; i-- > -1;) subject.options[i] = null;
            <?php
            $querySubject = $db->query("SELECT * FROM subjects");
            foreach ($querySubject->getResult('array') as $sb) :
            ?>
                $("#subject").append(new Option("<?= $sb['name'] ?>", "<?= $sb['id'] ?>"));
            <?php endforeach ?>
        }
    </script>

</body>

</html>
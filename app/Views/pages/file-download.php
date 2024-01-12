<?php
$event = session()->get('event');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $title . ".xls");
    ?>

    <center>
        <h1><?= $title ?></h1>
    </center>

    <table border="1">
        <tr>
            <th>Nama Mahasiswa</th>
            <?php
            $x = 1;
            foreach ($result as $r) :
            ?>
                <th>Nilai <?= $x ?></th>
            <?php
                $x++;
            endforeach
            ?>
        </tr>

        <?php
        foreach ($event as $ev) :
        ?>
            <tr>
                <td><?= $r['name'] ?></td>
                <?php
                $x = 1;
                foreach ($result as $r) :
                ?>
                    <td><?= $r['score'] ?></td>
                <?php
                    $x++;
                endforeach
                ?>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>
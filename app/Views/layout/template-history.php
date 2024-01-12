<?php
$db = \Config\Database::connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <?php
    $event = session()->get('event');
    foreach ($event as $ev) :
    ?>
        <title>Rekam Ujian - <?= $ev['name'] ?></title>
    <?php endforeach ?>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
</head>

<?php
foreach ($event as $ev) :
?>

    <body onload="userHistory()">
    <?php endforeach ?>

    <?= $this->renderSection('content'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script>
        function userHistory() {
            <?php
            $historyLabel = null;
            $historyValue = null;
            $queryHistory = $db->query("SELECT * FROM user_history uh INNER JOIN event ev ON ev.id=uh.event_id WHERE uh.event_id=" . $ev['id']);
            $queryScore = $db->query("SELECT score FROM user_history");
            foreach ($db->query("SELECT count(*) as count FROM user_history WHERE event_id=" . $ev['id'])->getResult('array') as $qh) :
                $countHistory = $qh['count'];
            endforeach;
            $x = 1;
            foreach ($queryHistory->getResult('array') as $qh) :
                if ($x <= $countHistory) {
                    $historyLabel = $historyLabel . '"' . $qh['date'] . '",';
                    $x++;
                }
            endforeach;
            $x = 1;
            foreach ($queryScore->getResult('array') as $qs) :
                if ($x <= $countHistory) {
                    $historyValue = $historyValue . '"' . $qs['score'] . '",';
                    $x++;
                }
            endforeach;
            ?>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            <?php //dd($historyLabel) 
            ?>
            // console.log();

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?= $historyLabel ?>],
                    datasets: [{
                        label: "Nilai Ujian ",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: [<?= $historyValue ?>],
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }
    </script>
    </body>

</html>
<?php

define('mysql_server', '127.0.0.1');    // Adresse der Datenbank
define('mysql_name', 'defi-info');                                // Datenbankname
define('mysql_user', 'root');                                // Datenbankbenutzer
define('mysql_pass', '2wsxdr5');

$db = new mysqli(mysql_server, mysql_user, mysql_pass, mysql_name);

if (mysqli_connect_errno())
{
    echo "db error";
    exit;
}

include_once 'class_Masternode.php';

$mn = new Masternode();

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "dark2",
                dataPointWidth: 15,
                axisX:{
                    interval: 1,
                },
                title:{
                    text: "Target Multiplier Spread"
                },
                axisY: {
                    title: "TM count"
                },
                data: [{
                    type: "column",
                    color: "eee",
                    yValueFormatString: "#,##0.## TMs",
                    dataPoints: <?php echo json_encode($mn->getTMSpread(), JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

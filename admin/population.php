<?php
require_once './import/head.php';
$date = date("Y", strtotime("+ 8 HOURS"));
$count_preanatal = $db->query("SELECT COUNT(*) as total FROM `prenatal` WHERE `year` = '$date'");
$prenatal = $count_preanatal->fetch_array();
$count_immunize = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `year` = '$date'");
$immunization = $count_immunize->fetch_array();
$count_health = $db->query("SELECT COUNT(*) as total FROM `individual_treatment` WHERE `year` = '$date'");
$individual_treatment = $count_health->fetch_array();
?>

<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        window.onload = function() {

            var chart = new CanvasJS.Chart("populationChart", {
                animationEnabled: true, // change to true		
                data: [{
                    // Change type to "bar", "area", "spline", "pie",etc.
                    type: "column",
                    dataPoints: [{
                            label: "Prenatal Record",
                            y: <?php if ($prenatal == "") {
                                    echo 0;
                                } else {
                                    echo $prenatal['total'];
                                } ?>,
                            legendText: "Prenatal Record"
                        },
                        {
                            label: "Immunization Record",
                            y: <?php
                                if ($immunization == "") {
                                    echo 0;
                                } else {
                                    echo $immunization['total'];
                                }
                                ?>,
                            legendText: "Immunization Record"
                        },
                        {
                            label: "Individual Treatment Record",
                            y: <?php
                                if ($individual_treatment == "") {
                                    echo 0;
                                } else {
                                    echo $individual_treatment['total'];
                                }
                                ?>,
                            legendText: "Individual Treatment Record"
                        },
                    ],
                    backgroundColor: ['#32a8a2', '#dc3545', '#ffc107', ],
                }]

            });
            chart.render();

        }
    </script>
</head>

<body>
    <div id="populationChart" style="height: 370px; width: 100%;"></div>
    <script src="../assets/js/jquery.canvasjs.min.js"> </script>
</body>

</html>
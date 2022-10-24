<?php
require_once './import/head.php';
$date = date("Y", strtotime("+ 8 HOURS"));
$qfecalysis = $db->query("SELECT COUNT(*) as total FROM `prenatal` WHERE `year` = '$date'");
$prenatal = $qfecalysis->fetch_array();
$qmaternity = $db->query("SELECT COUNT(*) as total FROM `immunization` `prenatal` WHERE `year` = '$date'");
$immunization = $qmaternity->fetch_array();
$qhematology = $db->query("SELECT COUNT(*) as total FROM `individual_treatment` WHERE `year` = '$date'");
$individual_treatment = $qhematology->fetch_array();
?>

<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        window.onload = function() {

            var chart = new CanvasJS.Chart("populationChart", {
                theme: "light1", // "light2", "dark1", "dark2"
                animationEnabled: true, // change to true		
                title: {},
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
                    ]
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
<?php
require_once './import/head.php';
$year = date("Y", strtotime("+8 HOURS"));
$qjan = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Jan' && `year` = '$year'");
$fjan = $qjan->fetch_array();
$qfeb = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Feb' && `year` = '$year'");
$ffeb = $qfeb->fetch_array();
$qmar = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Mar' && `year` = '$year'");
$fmar = $qmar->fetch_array();
$qapr = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Apr' && `year` = '$year'");
$fapr = $qapr->fetch_array();
$qmay = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'May' && `year` = '$year'");
$fmay = $qmay->fetch_array();
$qjun = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Jun' && `year` = '$year'");
$fjun = $qjun->fetch_array();
$qjul = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Jul' && `year` = '$year'");
$fjul = $qjul->fetch_array();
$qaug = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Aug' && `year` = '$year'");
$faug = $qaug->fetch_array();
$qsep = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Sept' && `year` = '$year'");
$fsep = $qsep->fetch_array();
$qoct = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Oct' && `year` = '$year'");
$foct = $qoct->fetch_array();
$qnov = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Nov' && `year` = '$year'");
$fnov = $qnov->fetch_array();
$qdec = $db->query("SELECT COUNT(*) as total FROM `patient` WHERE `month` = 'Dec' && `year` = '$year'");
$fdec = $qdec->fetch_array();
$year = date("Y");
?>

<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2", // "light2", "dark1", "dark2"
                animationEnabled: true, // change to true		
                title: {
                },
                data: [{
                    // Change type to "bar", "area", "spline", "pie",etc.
                    type: "splineArea",
                    dataPoints: [{
                            label: "January",
                            y: <?php echo $fjan['total'] ?>
                        },
                        {
                            label: "February",
                            y: <?php echo $ffeb['total'] ?>
                        },
                        {
                            label: "March",
                            y: <?php echo $fmar['total'] ?>
                        },
                        {
                            label: "April",
                            y: <?php echo $fapr['total'] ?>
                        },
                        {
                            label: "May",
                            y: <?php echo $fmay['total'] ?>
                        },
                        {
                            label: "June",
                            y: <?php echo $fjun['total'] ?>
                        },
                        {
                            label: "July",
                            y: <?php echo $fjul['total'] ?>
                        },
                        {
                            label: "August",
                            y: <?php echo $faug['total'] ?>
                        },
                        {
                            label: "September",
                            y: <?php echo $fsep['total'] ?>
                        },
                        {
                            label: "October",
                            y: <?php echo $foct['total'] ?>
                        },
                        {
                            label: "November",
                            y: <?php echo $fnov['total'] ?>
                        },
                        {
                            label: "December",
                            y: <?php echo $fdec['total'] ?>
                        },
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="../assets/js/jquery.canvasjs.min.js"> </script>
</body>

</html>
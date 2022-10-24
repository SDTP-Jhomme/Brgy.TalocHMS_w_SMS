<?php
require_once './import/head.php';
$year = date("Y", strtotime("+8 HOURS"));
$qjan = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Jan' && `year` = '$year'");
$jan = $qjan->fetch_array();
$qfeb = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Feb' && `year` = '$year'");
$feb = $qfeb->fetch_array();
$qmar = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Mar' && `year` = '$year'");
$mar = $qmar->fetch_array();
$qapr = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Apr' && `year` = '$year'");
$apr = $qapr->fetch_array();
$qmay = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'May' && `year` = '$year'");
$may = $qmay->fetch_array();
$qjun = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Jun' && `year` = '$year'");
$jun = $qjun->fetch_array();
$qjul = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Jul' && `year` = '$year'");
$jul = $qjul->fetch_array();
$qaug = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Aug' && `year` = '$year'");
$aug = $qaug->fetch_array();
$qsep = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Sept' && `year` = '$year'");
$sep = $qsep->fetch_array();
$qoct = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Oct' && `year` = '$year'");
$oct = $qoct->fetch_array();
$qnov = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Nov' && `year` = '$year'");
$nov = $qnov->fetch_array();
$qdec = $db->query("SELECT COUNT(*) as total FROM `immunization` WHERE `month` = 'Dec' && `year` = '$year'");
$dec = $qdec->fetch_array();
$year = date("Y");
?>

<!DOCTYPE HTML>
<html>

<head>
    <script type="text/javascript">
        window.onload = function() {

            var chart = new CanvasJS.Chart("formChart", {
                theme: "light1", // "light2", "dark1", "dark2"
                animationEnabled: false, // change to true		
                title: {
                    text: "Total Immunization <?php echo $year ?>"
                },
                data: [{
                    // Change type to "bar", "area", "spline", "pie",etc.
                    type: "column",
                    dataPoints: [{
                            label: "January",
                            y: <?php echo $jan['total'] ?>
                        },
                        {
                            label: "February",
                            y: <?php echo $feb['total'] ?>
                        },
                        {
                            label: "March",
                            y: <?php echo $mar['total'] ?>
                        },
                        {
                            label: "April",
                            y: <?php echo $apr['total'] ?>
                        },
                        {
                            label: "May",
                            y: <?php echo $may['total'] ?>
                        },
                        {
                            label: "June",
                            y: <?php echo $jun['total'] ?>
                        },
                        {
                            label: "July",
                            y: <?php echo $jul['total'] ?>
                        },
                        {
                            label: "August",
                            y: <?php echo $aug['total'] ?>
                        },
                        {
                            label: "September",
                            y: <?php echo $sep['total'] ?>
                        },
                        {
                            label: "October",
                            y: <?php echo $oct['total'] ?>
                        },
                        {
                            label: "November",
                            y: <?php echo $nov['total'] ?>
                        },
                        {
                            label: "December",
                            y: <?php echo $dec['total'] ?>
                        },
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <div id="formChart" style="height: 370px; width: 100%;"></div>
    <script src="../assets/js/jquery.canvasjs.min.js"> </script>
</body>

</html>
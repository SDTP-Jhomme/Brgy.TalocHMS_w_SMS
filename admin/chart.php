<?php
require_once './import/head.php';
$year = date("Y", strtotime("+8 HOURS"));
$qjan = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Jan' && `year` = '$year'");
$fjan = $qjan->fetch_array();
$qfeb = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Feb' && `year` = '$year'");
$ffeb = $qfeb->fetch_array();
$qmar = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Mar' && `year` = '$year'");
$fmar = $qmar->fetch_array();
$qapr = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Apr' && `year` = '$year'");
$fapr = $qapr->fetch_array();
$qmay = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'May' && `year` = '$year'");
$fmay = $qmay->fetch_array();
$qjun = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Jun' && `year` = '$year'");
$fjun = $qjun->fetch_array();
$qjul = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Jul' && `year` = '$year'");
$fjul = $qjul->fetch_array();
$qaug = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Aug' && `year` = '$year'");
$faug = $qaug->fetch_array();
$qsep = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Sept' && `year` = '$year'");
$fsep = $qsep->fetch_array();
$qoct = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Oct' && `year` = '$year'");
$foct = $qoct->fetch_array();
$qnov = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Nov' && `year` = '$year'");
$fnov = $qnov->fetch_array();
$qdec = $db->query("SELECT COUNT(*) as total FROM `users` WHERE `month` = 'Dec' && `year` = '$year'");
$fdec = $qdec->fetch_array();
$year = date("Y");
?>
<script src="../js/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
    window.onload = function() {
        $(".chartContainer").CanvasJSChart({
            title: {
                text: "Monthly Fecalysis Patient Population <?php echo $year ?>"
            },
            axisY: {
                title: "Total Population",
                includeZero: false
            },
            data: [{
                type: "column",
                toolTipContent: "{label}: {y}",
                dataPoints: [{
                        label: "January",
                        y: <?php echo $fjan['total'] ?>
                    },
                    {
                        label: "Febuary",
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
                    }
                ]
            }]
        });
    }
</script>
<div id="ta" class="well">
    <div class="chartContainer" style="height: 300px; width: 1000px"></div>

</div>
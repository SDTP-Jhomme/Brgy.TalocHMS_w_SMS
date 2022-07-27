<?php



$identification =  $first_name = $last_name = $birthdate = $gender = $password = "";
$errors = array();

$viewBHW = md5(rand(1, 9));
$addBHW = md5(rand(1, 9));
$editBHW = md5(rand(1, 9));

$date_now = date("Y-m-d");
$month_day = date("m-d");
$date_interval = intval("$date_now") - 18;
$date_before_eighteen = "$date_interval-$month_day";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php

    include("../import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];

        $admin_record = mysqli_query($db, "SELECT * FROM admin where id='$id'");

        while ($admin_row = mysqli_fetch_assoc($admin_record)) {

            $db_username = $admin_row["username"];
            $logged_admin = ucfirst($db_username);
        }
    } else {

        header("Location: ./login");
        die();
    } ?>
</head>

<body class="sb-nav-fixed">
    <?php include("../import/nav.php"); ?>
    <div id="layoutSidenav">
        <?php include("../import/sidebar.php"); ?>
        <div id="layoutSidenav_content">
            <main>

            </main>
            <?php include("../import/footer.php"); ?>
        </div>
    </div>
    <?php include("../import/body.php"); ?>
</body>

</html>
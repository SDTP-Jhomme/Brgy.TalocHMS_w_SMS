<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m/d/Y");
$time_now = date("h:i A");
$date_time = $date_now . " " . $time_now;
$end_time = date("h:i A", strtotime("+5 minutes", strtotime($time_now)));

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'login') {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $check_admin = mysqli_query($db, "SELECT * FROM admin WHERE username='$username'");
    $check_admin_row = mysqli_num_rows($check_admin);

    if (!$username && !$password) {
        $response["error"] = true;
        $response["message"] = "Please fill in the data completely!";
    }

    if (!$check_admin_row) {

        $response["error"] = true;
        $response["message"] = "Admin user does not exist!";
    } else {

        $admin_row = mysqli_fetch_assoc($check_admin);

        $db_id = $admin_row["id"];
        $db_password = $admin_row["password"];
        $db_attempt = $admin_row["attempt"];
        $db_log_time = $admin_row["log_time"];

        $new_log_time = strtotime($db_log_time);

        if ($db_log_time <= $time_now) {

            if (password_verify($password, $db_password)) {

                session_start();

                $_SESSION["id"] = $db_id;

                mysqli_query($db, "UPDATE admin SET last_login='$date_time', attempt=0, log_time='' WHERE id='$db_id'");
            } else {

                $response["error"] = true;
                $response["message"] = "Password does not match!";

                $attempt = $db_attempt + 1;

                if ($attempt == 5) {

                    $error_attempt = 1;
                    mysqli_query($db, "UPDATE admin SET attempt=0, log_time='$end_time' WHERE id='$db_id'");
                    $response["error"] = true;
                    $response["message"] = "You have reached the maximum attempt. Please try again after $end_time.";
                } else {

                    mysqli_query($db, "UPDATE admin SET attempt='$attempt' WHERE id='$db_id'");
                }
            }
        } else {

            $response["error"] = true;
            $response["message"] = "Sorry you can't login until $db_log_time.";
        }
    }
}

if ($action == 'logout') {

    unset($_SESSION["id"]);
    session_unset();
    session_destroy();
    $response["message"] = "Logout success!";
}

echo json_encode($response);

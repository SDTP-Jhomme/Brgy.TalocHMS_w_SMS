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

if ($action == 'fetch') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM users");
    while ($data_row = mysqli_fetch_assoc($data)) {

        $array_data = array(
            "name" => $data_row["first_name"] . " " . $data_row["last_name"]
        );

        array_push($user_data, $array_data);
    }
}

echo json_encode($user_data);

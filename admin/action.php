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

        $fullname = $data_row["first_name"] . " " . $data_row["last_name"];
        $db_birthdate = $data_row["birthday"];
        $birthdate = date("F d, Y", strtotime($db_birthdate));

        $array_data = array(
            "id" => $data_row["id"],
            "username" => $data_row["username"],
            "name" => $fullname,
            "birthdate" => $birthdate,
            "gender" => $data_row["gender"],
            "identification" => $data_row["bhw_id"]
        );

        array_push($user_data, $array_data);
    }
}

echo json_encode($user_data);

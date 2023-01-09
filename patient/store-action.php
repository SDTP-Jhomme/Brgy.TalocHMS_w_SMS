<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'storeImmunization') {

    $patient_id = $_POST["patient_id"];
    $section = $_POST["section"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Immunization";

    $response = array(

        "patient_id" => $patient_id,
        "date" => $date,
        "appointment" => $appointment,
        "status" => $status,
        "section" => $section,
    );

    $request = mysqli_query($db, "INSERT INTO pending_request(patient_id,date,section,status,appointment) VALUES('$patient_id','$date','$section','$status','$appointment')");
}

if ($action == 'storeHealth') {

    $patient_id = $_POST["patient_id"];
    $section = $_POST["section"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Individual Treatment";

    $response = array(

        "patient_id" => $patient_id,
        "date" => $date,
        "appointment" => $appointment,
        "status" => $status,
        "section" => $section,

    );

    $request = mysqli_query($db, "INSERT INTO pending_request(patient_id,date,section,status,appointment) VALUES('$patient_id','$date','$section','$status','$appointment')");
}

if ($action == 'storePrenatal') {

    $patient_id = $_POST["patient_id"];
    $section = $_POST["section"];
    $week_day = $_POST['week_day'];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Maternity";

    $response = array(

        "patient_id" => $patient_id,
        "date" => $date,
        "appointment" => $appointment,
        "status" => $status,
        "section" => $section,
    );

    $request = mysqli_query($db, "INSERT INTO pending_request(patient_id,date,section,status,appointment) VALUES('$patient_id','$date','$section','$status','$appointment')");
}
if ($action == 'storeFamily') {

    $patient_id = $_POST["patient_id"];
    $section = $_POST["section"];
    $week_day = $_POST['week_day'];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Maternity";

    $response = array(

        "patient_id" => $patient_id,
        "date" => $date,
        "appointment" => $appointment,
        "status" => $status,
        "section" => $section,
    );

    $request = mysqli_query($db, "INSERT INTO pending_request(patient_id,date,section,status,appointment) VALUES('$patient_id','$date','$section','$status','$appointment')");
}
echo json_encode($response);

<?php
include("../database/database.php");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'fetch_patient') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM patient ORDER BY id");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1),"undefined") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"],"undefined");
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "date" => $date,
                "birthdate" => $birthdate,
                "gender" => $data_row["gender"],
                "fsn" => $data_row["fsn"],
                "first_name" => $data_row["first_name"],
                "last_name" => $data_row["last_name"],
                "phone_number" => $data_row["phone_number"],
                "last_login" => $data_row["last_login"],
                "avatar" => "../assets/$db_avatar",
            );

            array_push($user_data, $array_data);
            $response = $user_data;
        }
    } else {

        $response["error"] = true;
        $response["message"] = "Table is empty!";
    }
}
if ($action == 'sent_message') {

    $week_day = $_POST['week_day'];
    $contact = $_POST['phone_number'];
    $appointment = date("F d, Y", strtotime($_POST['appointment']));
    $message = $_POST['message'];

    $data = "Appointment Date: $week_day, $appointment\n\n$message";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $contact . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $contact);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
    $response = curl_exec($cURL);
    curl_close($cURL);
}

if ($action == 'bulk_message') {

    $week_day = $_POST['week_day'];
    $numbers = $_POST['number_blast'];
    $array_number = explode(',', $numbers);
    $appointment = date("F d, Y", strtotime($_POST['appointment']));
    $message = $_POST['message'];

    $data = "Appointment Date: $week_day, $appointment\n\n$message";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    foreach ($array_number as $value) {
        $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $value . "&data_type=Plain&message=" . urlencode("$data");
        $cURL = curl_init($msg);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $value);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        $response = curl_exec($cURL);
        curl_close($cURL);

        if ($response) sleep(2);
    }
}

echo json_encode($response);

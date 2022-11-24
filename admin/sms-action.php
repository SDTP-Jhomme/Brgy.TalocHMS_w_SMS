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

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]) . " " . $data_row["suffix"];
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

    $contact = $_POST['phone_number'];
    $appointment = $_POST['appointments'];
    $n_appointment = substr($appointment, 4, 11);
    $new_appointment = date("F d, Y", strtotime($n_appointment));
    $message = $_POST['message'];

    $data = $appointment . $message;
    $sms_url = "http://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "13";

    $sim_id = "99";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $contact . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $contact);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
    $response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($response, true);
}
if ($action == 'bulk_message') {

    if (isset($_POST['number_blast'])) {

        $array_number = $_POST['number_blast'];
        echo $array_number;
        $appointment = $_POST['appointment'];
        $n_appointment = substr($appointment, 4, 11);
        $new_appointment = date("F d, Y", strtotime($n_appointment));
        $message = $_POST['message'];

        $phone_number = $array_number;
        $data = $appointment . $message;
        $sms_url = "http://sms.pagenet.info/admin/index.php";
        $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

        $device_id = "13";

        $sim_id = "99";

        $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $phone_number . "&data_type=Plain&message=" . urlencode("$data");

        $cURL = curl_init($msg);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $phone_number);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        $response = curl_exec($cURL);
        curl_close($cURL);

        $result = json_decode($response, true);
    }
}

echo json_encode($response);

<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'fetch') {
    $user_data = array();

    $check_patient = mysqli_query($db, "SELECT * FROM patient");
    $data = mysqli_query($db, "SELECT * FROM patient LEFT JOIN immunization ON patient.id=immunization.patient_id LEFT JOIN individual_treatment ON patient.id=individual_treatment.patient_id LEFT JOIN prenatal ON patient.id=prenatal.patient_id");

    if (mysqli_num_rows($check_patient) > 0) {
        $response = $data->fetch_all(MYSQLI_ASSOC);
        // while ($data_row = mysqli_fetch_assoc($data)) {

        //     // $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
        //     // $db_birthdate = $data_row["birthdate"];
        //     // $birthday = substr($db_birthdate, 4, 11);
        //     // $birthdate = date("F d, Y", strtotime($birthday));
        //     // $db_avatar = $data_row["avatar"];
        //     // $date = $data_row["date"];

        //     $array_data = array(
        //         "id" => $data_row["id"],
        //         "fsn" => $data_row["fsn"],
        //         // "name" => $fullname,
        //         // "date" => $date,
        //         // "last_name" => $data_row["last_name"],
        //         // "first_name" => $data_row["first_name"],
        //         // "middle_name" => $data_row["middle_name"],
        //         // "suffix" => $data_row["suffix"],
        //         // "birthdate" => $birthdate,
        //         // "gender" => $data_row["gender"],
        //         // "phone_number" => $data_row["phone_number"],
        //         // "section" => $data_row["section"],
        //         // "status" => $data_row["status"],
        //         // "avatar" => "../assets/$db_avatar",
        //     );

        //     array_push($user_data, $array_data);

        // }
        // $response = $user_data;
    } else {

        $response["error"] = true;
        $response["message"] = "Table is empty!";
    }
}

if ($action == 'fetch_patient') {

    $user_data = array();

    $check_patient = mysqli_query($db, "SELECT * FROM patient");

    if (mysqli_num_rows($check_patient) > 0) {
        while ($data_row = mysqli_fetch_assoc($check_patient)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];

            $array_data = array(
                "id" => $data_row["id"],
                "fsn" => $data_row["fsn"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "date" => $date,
                "last_name" => $data_row["last_name"],
                "first_name" => $data_row["first_name"],
                "middle_name" => $data_row["middle_name"],
                "suffix" => $data_row["suffix"],
                "birthdate" => $birthdate,
                "appointment" => $appointment,
                "gender" => $data_row["gender"],
                "phone_number" => $data_row["phone_number"],
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
if ($action == 'fetch_request') {

    $user_data = array();

    $check_patient = mysqli_query($db, "SELECT * FROM patient INNER JOIN pending_request ON pending_request.patient_id=patient.id");

    if (mysqli_num_rows($check_patient) > 0) {
        while ($data_row = mysqli_fetch_assoc($check_patient)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $appointment = $data_row["appointment"];
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];

            $array_data = array(
                "id" => $data_row["id"],
                "fsn" => $data_row["fsn"],
                "name" => $fullname,
                "date" => $date,
                "last_name" => $data_row["last_name"],
                "first_name" => $data_row["first_name"],
                "middle_name" => $data_row["middle_name"],
                "suffix" => $data_row["suffix"],
                "birthdate" => $birthdate,
                "appointment" => $appointment,
                "gender" => $data_row["gender"],
                "phone_number" => $data_row["phone_number"],
                "section" => $data_row["section"],
                "status" => $data_row["status"],
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

    $contact = $_POST['contact'];
    $message = $_POST['message'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $appointment = $_POST['appointment'];
    $n_appointment = substr($appointment, 4, 11);
    $new_appointment = date("F d, Y", strtotime($n_appointment));

    $data = "Mr. / Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " Your appointment " . $new_appointment . " " . $message;
    $sms_url = "http://sms.pagenet.info/admin/index.php";
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

    $result = json_decode($response, true);
}

if ($action == 'sms_approve') {

    $user_id = $_POST["patient_id"];
    $contact = $_POST['contact'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $appointment = date("F d, Y", strtotime($_POST['new_appointment']));
    $week_day = $_POST['week_day'];

    $data = "Mr. / Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " Your Request have been APPROVED! \n\n APPOINTMENT: $week_day, $appointment";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $contact . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $contact);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
    $sms_response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($sms_response, true);

    $new_status = 'Approved';

    $response = mysqli_query($db, "UPDATE pending_request SET status='$new_status' , appointment = '$appointment' WHERE id='$user_id'");
}

if ($action == 'change_password') {

    $user_id = $_POST["id"];
    $new_password = $_POST["newPassword"];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $response = mysqli_query($db, "UPDATE users SET password='$hashed_password',last_login='$date_now' WHERE id='$user_id'");

    if ($response) {
        session_start();
        unset($_SESSION["bhw_id"]);
    }
}

if ($action == 'update_avatar') {

    $user_id = $_POST["id"];
    $targetDir = "../assets/avatar/";
    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $targetFilePath = $targetDir . $newfilename;
    $savedb_name = "avatar/$newfilename";

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        $response = mysqli_query($db, "UPDATE users SET avatar='$savedb_name' WHERE id='$user_id'");
    }
}

if ($action == "check_password") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM users where id='$user_id'");

    $user_row = mysqli_fetch_assoc($user_record);
    $db_password = $user_row["password"];

    if (!password_verify($_POST["currentPassword"], $db_password)) {

        $response["error"] = true;
        $response["message"] = "Password is incorrect!";
    } else {

        $response = true;
    }
}

if ($action == "update_password") {

    $user_id = $_POST["id"];
    $new_password = $_POST["newPassword"];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $response = mysqli_query($db, "UPDATE users SET password='$hashed_password' WHERE id='$user_id'");
}

if ($action == "fetch_avatar") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM users where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["avatar"];
}

echo json_encode($response);

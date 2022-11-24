<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'fetchHealth') {
    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM patient INNER JOIN health_request ON patient.fsn=health_request.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["date"];

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
if ($action == 'fetchMaternal') {
    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM patient INNER JOIN prenatal_request ON patient.fsn=prenatal_request.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["date"];

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
if ($action == 'fetchImmunization') {
    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM immunization_request INNER JOIN patient ON immunization_request.fsn=patient.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["date"];

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
                "gender" => $data_row["gender"],
                "phone_number" => $data_row["phone_number"],
                "section" => $data_row["section"],
                "status" => $data_row["status"],
                "m_lastname" => $data_row["m_lastname"],
                "m_firstname" => $data_row["m_firstname"],
                "m_middlename" => $data_row["m_middlename"],
                "f_lastname" => $data_row["f_lastname"],
                "f_firstname" => $data_row["f_firstname"],
                "f_middlename" => $data_row["f_middlename"],
                "purok" => $data_row["purok"],
                "barangay" => $data_row["barangay"],
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
if ($action == 'fetch') {
    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM patient INNER JOIN pending_request ON patient.fsn=pending_request.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["date"];

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
if ($action == 'store') {

    $fsn = $_POST["fsn"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];

    if ($gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }

    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "PATIENT-" . ucfirst($first_name);
    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $db_status = "Active";
    $type = "PATIENT";

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "suffix" => $suffix,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "phone_number" => $phone_number,
        "password" => $password,
    );

    mysqli_query($db, "INSERT INTO patient(fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,day,month,year)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number','$day','$month','$year')");
}

if ($action == 'sent_message') {

    $contact = $_POST['contact'];
    $message = $_POST['message'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $appointment = $_POST['appointment'];
    $n_appointment = substr($appointment, 4, 11);
    $new_appointment = date("F d, Y", strtotime($n_appointment));

    $data = "Mr. / Ms. ".ucfirst($first_name)." ".ucfirst($last_name)." Your appointment ".$new_appointment ." ". $message;
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

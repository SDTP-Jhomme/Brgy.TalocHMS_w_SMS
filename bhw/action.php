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

    $data = mysqli_query($db, "SELECT * FROM patient ORDER BY fsn ");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . substr(ucfirst($data_row["middle_name"]), 0, 1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthdate = date("F d, Y", strtotime($db_birthdate));
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

    $array_id = $_POST["user_ids"];
    $contact = $_POST['contact'];
    $appointment = $_POST['appointments'];
    $message = $_POST['message'];
    $apicodeBulk = "PR-SAMPLE123456_ABCDE";
    $password = "	123456789ABCD";

    $send = new ItexMoController();

    $send->itexmo($contact, $message, $appointment, $apicodeBulk, $password);

    if ($send == false) {
        header("Location: ./");
        $response["error"] = true;
        $response["message"] = "Message not sent!";
    } elseif ($send == true) {
        header("Location: ./");
        $response["error"] = true;
        $response["message"] = "Message sent!";
    } else {
        header("Location: ./");
        $response["error"] = true;
        $response["message"] = "Something went wrong!";
    }
    class ItexMoController
    {

        function itexmo($contact, $message, $apicode, $password)
        {

            $ch = curl_init();
            $itexmo = array('1' => $contact, '2' => $message, '3' => $apicode, 'password' => $password);
            curl_setopt($ch, CURLOPT_URL, "https://www.itexmo.com/php_api/api.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($itexmo));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            return curl_exec($ch);
            curl_close($ch);
        }
    }
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

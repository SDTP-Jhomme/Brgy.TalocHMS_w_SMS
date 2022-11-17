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
                "middle_name" => $data_row["middle_name"],
                "currentContact" => $data_row["phone_number"],
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
if ($action == 'change_password') {

    $user_id = $_POST["id"];
    $new_password = $_POST["newPassword"];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $response = mysqli_query($db, "UPDATE patient SET password='$hashed_password',last_login='$date_now' WHERE id='$user_id'");

    if ($response) {
        session_start();
        unset($_SESSION["user_id"]);
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
        $response = mysqli_query($db, "UPDATE patient SET avatar='$savedb_name' WHERE id='$user_id'");
    }
}

if ($action == "check_password") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");

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

    $response = mysqli_query($db, "UPDATE patient SET password='$hashed_password' WHERE id='$user_id'");
}

if ($action == "fetch_avatar") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["avatar"];
}
if ($action == "check_contact") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");

    $user_row = mysqli_fetch_assoc($user_record);
    $db_contact = $user_row["phone_number"];

    if ($_POST["currentContact"] != $db_password) {

        $response["error"] = true;
        $response["message"] = "Phone no. is incorrect!";
    } else {

        $response = true;
    }
}
if ($action == "update_contact") {

    $user_id = $_POST["id"];
    $new_contact = $_POST["newContact"];

    $response = mysqli_query($db, "UPDATE patient SET phone_number='$new_contact' WHERE id='$user_id'");
}

echo json_encode($response);

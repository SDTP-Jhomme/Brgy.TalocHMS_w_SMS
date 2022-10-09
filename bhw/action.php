<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'change_password') {

    $user_id = $_POST["id"];
    $new_password = $_POST["newPassword"];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $response = mysqli_query($db, "UPDATE users SET password='$hashed_password',last_login='$date_now' WHERE id='$user_id'");

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

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        $response = mysqli_query($db, "UPDATE users SET avatar='$savedb_name' WHERE id='$user_id'");
    }
}

echo json_encode($response);
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

    $data = mysqli_query($db, "SELECT * FROM patient ORDER BY fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = $data_row["first_name"] . " " . $data_row["last_name"];
            $db_birthdate = $data_row["birthday"];
            $birthdate = date("F d, Y", strtotime($db_birthdate));
            $db_avatar = $data_row["avatar"];

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "birthdate" => $birthdate,
                "gender" => $data_row["gender"],
                "fsn" => $data_row["fsn"],
                "first_name" => $data_row["first_name"],
                "last_name" => $data_row["last_name"],
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

if ($action == 'storeImmunization') {

    $fsn = $_POST["fsn"];
    $child_no = $_POST["child_no"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $m_lastname = $_POST["m_lastname"];
    $m_firstname = $_POST["m_firstname"];
    $m_middlename = $_POST["m_middlename"];
    $f_lastname = $_POST["f_lastname"];
    $f_firstname = $_POST["f_firstname"];
    $f_middlename = $_POST["f_middlename"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];
    $appontment = $_POST["appontment"];
    $age = $_POST["age"];
    $temp = $_POST["age"];
    $immunization_given = $_POST["immunization_given"];
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
    function rand_username($length = 3)
    {
        $str = "123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $username = "PATIENT-" . ucfirst($first_name . rand_username(3));
    $year = date("Y");
    $month = date("M");
    $mother_name = $m_firstname . " " . $m_middlename . " " . $m_lastname;
    $father_name = $f_firstname . " " . $f_middlename . " " . $f_lastname;

    $response = array(
        "fsn" => $first_name,
        "child_no" => $first_name,
        "first_name" => $first_name,
        "middle_name" => $middle_name,
        "last_name" => $last_name,
        "suffix" => $suffix,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "username" => $username,
        "password" => $password,
        "avatar" => $avatar,
        "password" => $password,
        "mother_name" => $mother_name,
        "father_name" => $father_name,
        "purok" => $purok,
        "barangay" => $barangay,
        "appointment" => $appointment,
        "age" => $age,
        "temp" => $temp,
        "immunization_given" => $immunization_given,
        "phone_number" => $phone_number,
    );

    $immunize_sql = mysqli_query($db, "INSERT INTO immunization(fsn,child_no,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,mother_name,father_name,purok,barangay,appointment,age,temp,immunization_given,phone_number,month,year)
        VALUES('$fsn','$child_no','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$mother_name','$father_name','$purok','$barangay','$appointment','$age','$temp','$immunization_given','$phone_number','$month','$year')");

    $patient_sql = mysqli_query($db, "INSERT INTO patient (fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,month,year) 
     VALUES('$fsn','$child_no','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number','$month','$year') SELECT (fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,month,year) FROM immunization WHERE fsn >= 1");
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

<?php

include("../database/database.php");

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
            "identification" => $data_row["bhw_id"],
            "first_name" => $data_row["first_name"],
            "last_name" => $data_row["last_name"]
        );

        array_push($user_data, $array_data);
        $response = $user_data;
    }
}

if ($action == 'store') {

    $identification = $_POST["identification"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];

    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "BHW-" . $first_name;

    $response = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "identification" => $identification,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "password" => $password
    );

    mysqli_query($db, "INSERT INTO users(first_name,last_name,birthday,gender,username,password,bhw_id)
        VALUES('$first_name','$last_name','$birthdate','$gender','$username','$hashed_password','$identification')");
}

if ($action == 'update') {

    $user_id = $_POST["id"];
    $new_identification = $_POST["identification"];
    $new_first_name = $_POST["first_name"];
    $new_last_name = $_POST["last_name"];
    $new_birthdate = $_POST["birthdate"];
    $new_gender = $_POST["gender"];
    $username = "BHW-" . $new_first_name;

    $response = array(
        "first_name" => $new_first_name,
        "last_name" => $new_last_name,
        "identification" => $new_identification,
        "username" => $username,
        "birthdate" => $new_birthdate,
        "gender" => $new_gender
    );
    
    mysqli_query($db, "UPDATE users SET first_name='$new_first_name',last_name='$new_last_name',birthday='$new_birthdate',
        gender='$new_gender',username='$username',bhw_id='$new_identification' WHERE id='$user_id'");
}

if ($action == 'delete') {

    $user_id = $_POST["id"];
    $response = mysqli_query($db, "DELETE FROM users WHERE id=$user_id");
}

echo json_encode($response);

<?php

include("../database/database.php");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'fetch') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM users ORDER BY bhw_id");

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
                "identification" => $data_row["bhw_id"],
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

if ($action == 'store') {

    $identification = $_POST["identification"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];

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

    $username = "BHW-" . ucfirst($first_name .rand_username(3) );

    $response = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "identification" => $identification,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "password" => $password
    );

    mysqli_query($db, "INSERT INTO users(first_name,last_name,birthday,gender,username,password,bhw_id,avatar)
        VALUES('$first_name','$last_name','$birthdate','$gender','$username','$hashed_password','$identification','$avatar')");
}

if ($action == 'update') {

    $user_id = $_POST["id"];
    $new_identification = $_POST["identification"];
    $new_first_name = $_POST["first_name"];
    $new_last_name = $_POST["last_name"];
    $new_birthdate = $_POST["birthdate"];
    $new_gender = $_POST["gender"];
    $username = "BHW-" . ucfirst($new_first_name);

    if ($new_gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }

    $response = array(
        "first_name" => $new_first_name,
        "last_name" => $new_last_name,
        "identification" => $new_identification,
        "username" => $username,
        "birthdate" => $new_birthdate,
        "gender" => $new_gender
    );

    mysqli_query($db, "UPDATE users SET first_name='$new_first_name',last_name='$new_last_name',birthday='$new_birthdate',
        gender='$new_gender',username='$username',bhw_id='$new_identification',avatar='$avatar' WHERE id='$user_id'");
}

if ($action == 'delete') {

    $user_id = $_POST["id"];
    $response = mysqli_query($db, "DELETE FROM users WHERE id=$user_id");
}

if ($action == 'reset') {

    $user_id = $_POST["id"];
    $username = $_POST["username"];
    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $response = array(
        "username" => $username,
        "password" => $password
    );

    mysqli_query($db, "UPDATE users SET password='$hashed_password',last_login=null WHERE id='$user_id'");
}

if ($action == 'bulk_delete') {
    $array_id = $_POST["user_ids"];

    $delete_array_query = mysqli_query($db, "DELETE FROM users WHERE id IN($array_id)");

    if ($delete_array_query) {
        $response["message"] = "Data deleted successfully!";
    }
}

echo json_encode($response);

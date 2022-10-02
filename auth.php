<?php

include("./database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'login') {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $check_user = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
    $check_user_row = mysqli_num_rows($check_user);

    if (empty($username)) {

        $response["error"] = true;
        $response["userErr"] = "Username is required!";
    }
    if (empty($password)) {

        $response["error"] = true;
        $response["passErr"] = "Password is required!";
    }

    if ($username) {
        if (!$check_user_row) {

            $response["error"] = true;
            $response["userErr"] = "Username does not exist!";
        }
    }

    if ($username && $password) {

        if (!$check_user_row) {

            $response["error"] = true;
            $response["userErr"] = "Username does not exist!";
        } else {

            $user_row = mysqli_fetch_assoc($check_user);

            $db_id = $user_row["id"];
            $db_password = $user_row["password"];
            $db_last_login = $user_row["last_login"];

            if (password_verify($password, $db_password)) {

                if ($db_last_login) {

                    session_start();

                    $_SESSION["id"] = $db_id;

                    mysqli_query($db, "UPDATE users SET last_login='$date_time' WHERE id='$db_id'");
                } else {

                    $response = $db_last_login;
                }
            } else {

                $response["error"] = true;
                $response["passErr"] = "Password is incorrect!";
            }
        }
    }
}

if ($action == 'logout') {

    unset($_SESSION["id"]);
    session_unset();
    session_destroy();
    $response["message"] = "Logout success!";
}

echo json_encode($response);

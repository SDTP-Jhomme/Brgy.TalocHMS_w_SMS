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

            $fullname =ucfirst($data_row["first_name"]) . " " .substr( ucfirst($data_row["middle_name"]),0,1) . " " . ucfirst($data_row["last_name"]) . " " . $data_row["suffix"];
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

    $array_id = $_POST["user_ids"];
    $contact = $_POST['contact'];
    $appointment = $_POST['appointments'];
    $message = $_POST['message'];
    $apicodeBulk = "PR-SAMPLE123456_ABCDE";
    $password = "	123456789ABCD";

    $send = new ItexMoController();

    $send->itexmo($contact, $message, $appointment, $apicodeBulk, $password);

    if ($send == false) {
        header("Location: ./sms");
        $response["message"] = "Message not sent!";
    } elseif ($send == true) {
        header("Location: ./sms");
        $response["message"] = "Message sent!";
    } else {
        header("Location: ./sms");
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

echo json_encode($response);

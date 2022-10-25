<?php
include("../database/database.php");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'sent_message') {

    $array_id = $_POST["user_ids"];
    $contact = $_POST['contact'];
    $appointment = $_POST['appointments'];
    $message = $_POST['message'];
    $apicodeBulk = "PR-SAMPLE123456_ABCDE";
    $password = "	123456789ABCD";

    $send = new ItexMoController();

    $send -> itexmo($contact, $message,$appointment, $apicodeBulk, $password);

    if($send == false){
        header("Location: ./sms");
        $response["message"] = "Message not sent!";
    }elseif($send == true){
        header("Location: ./sms");
        $response["message"] = "Message sent!";
    }else{
        header("Location: ./sms");
        $response["message"] = "Something went wrong!";
    }
    class ItexMoController
    {

        function itexmo($number, $message, $apicode, $passwd)
        {

            $ch = curl_init();
            $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
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

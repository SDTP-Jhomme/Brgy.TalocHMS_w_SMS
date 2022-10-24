<?php
include("../database/database.php");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'sent_message') {

    $array_id = $_POST["user_ids"];


    function itexmo()
    {
        $url = "https://api.itexmo.com/api/query";

        $contact = $_POST['contact'];
        $message = $_POST['message'];
        $apicode = "PR-SAMPL123456_ABCDE";

        $itexmo = array('1' => $contact, '2' => $message, '3' => $apicode);

        $param = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }

    $result = itexmo("$contact", "$message", "API_CODE");

    if ($result == "") {
        $response["message"] = "Message not sent!";
    } else {
        if ($result == 0) {
            $response["message"] = "Message sent!";

        }else{
            $response["message"] = $result;
        }
    }
}

echo json_encode($response);

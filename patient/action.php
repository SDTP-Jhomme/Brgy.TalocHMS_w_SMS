<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'fetch_prenatal') {

    $user_data = array();

    $user_id = $_POST["id"];
    $data = mysqli_query($db, "SELECT * FROM prenatal INNER JOIN patient ON patient.id=prenatal.patient_id where individual_treatment.patient_id='$user_id'");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined, U") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");
            $db_birthdate = substr($data_row["birthdate"], 4, 11);
            $birthdate = date("F d, Y", strtotime($db_birthdate));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];
            $edc = $data_row["edc"];
            $edc_Date = substr($edc, 4, 11);
            $date_edc = date("F d, Y", strtotime($edc_Date));
            $lmp = $data_row["lmp"];
            $lmp_Date = substr($lmp, 4, 11);
            $date_lmp = date("F d, Y", strtotime($lmp_Date));
            $date_visit = date("F d, Y", strtotime($data_row["date_visit"]));
            $address = "Purok " . $data_row["purok"] . ", " . "Barangay " . $data_row["barangay"];

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "date" => $date,
                "birthdate" => $birthdate,
                "address" => $address,
                "purok" => $data_row["purok"],
                "barangay" => $data_row["barangay"],
                "gp" => $data_row["gp"],
                "lmp" => $date_lmp,
                "edc" => $date_edc,
                "tt_status" => $data_row["tt_status"],
                "appointment" => $data_row["appointment"],
                "date_visit" =>  $date_visit,
                "weight" => $data_row["weight"],
                "bp" => $data_row["bp"],
                "cr" => $data_row["cr"],
                "rr" => $data_row["rr"],
                "temp" => $data_row["temp"],
                "aog" => $data_row["aog"],
                "fundic_height" => $data_row["fundic_height"],
                "fhb" => $data_row["fhb"],
                "presentation" => $data_row["presentation"],
                "gender" => $data_row["gender"],
                "fsn" => $data_row["fsn"],
                "first_name" => $data_row["first_name"],
                "last_name" => $data_row["last_name"],
                "phone_number" => $data_row["phone_number"],
                "last_login" => $data_row["last_login"],
                "spouse" => $data_row["spouse_name"],
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
if ($action == 'fetch_health') {

    $user_data = array();

    $user_id = $_POST["id"];
    $data = mysqli_query($db, "SELECT * FROM individual_treatment INNER JOIN patient ON patient.id=individual_treatment.patient_id where individual_treatment.patient_id='$user_id'");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];
            $address = "Purok " . $data_row["purok"] . ", " . "Barangay " . $data_row["barangay"];

            $array_data = array(
                "id" => $data_row["id"],
                "fsn" => $data_row["fsn"],
                "clinisys" => $data_row["clinisys"],
                "last_name" => $data_row["last_name"],
                "first_name" => $data_row["first_name"],
                "middle_name" => trim(ucfirst($data_row["middle_name"]), "undefined"),
                "suffix" => trim($data_row["suffix"], "undefined"),
                "birthdate" => $birthdate,
                "gender" => $data_row["gender"],
                "civil_status" =>  $data_row["civil_status"],
                "spouse" =>  $data_row["spouse"],
                "educ_attainment" =>  $data_row["educ_attainment"],
                "employment_status" =>  $data_row["employment_status"],
                "occupation" =>  $data_row["occupation"],
                "religion" =>  $data_row["religion"],
                "phone_number" => $data_row["phone_number"],
                "street" => $data_row["street"],
                "address" => $address,
                "purok" => $data_row["purok"],
                "barangay" => $data_row["barangay"],
                "blood_type" => $data_row["blood_type"],
                "family_member" => $data_row["family_member"],
                "other_member" => $data_row["other_member"],
                "philhealth_type" => $data_row["philhealth_type"],
                "philhealth_no" => $data_row["philhealth_no"],
                "m_lastname" => $data_row["m_lastname"],
                "m_firstname" => $data_row["m_firstname"],
                "m_middlename" => $data_row["m_middlename"],
                "nhts" => $data_row["nhts"],
                "pantawid_member" => $data_row["pantawid_member"],
                "hh_no" => $data_row["hh_no"],
                "alert_type" => $data_row["alert_type"],
                "other_alert" => $data_row["other_alert"],
                "medical_history" => $data_row["medical_history"],
                "other_history" => $data_row["other_history"],
                "encounter_type" => $data_row["encounter_type"],
                "consultation_type" => $data_row["consultation_type"],
                "consultation_date" => $data_row["consultation_date"],
                "age" => $data_row["age"],
                "transaction_mode" => $data_row["transaction_mode"],
                "s" => $data_row["s"],
                "o" => $data_row["o"],
                "pr" => $data_row["pr"],
                "rr" => $data_row["rr"],
                "bp" => $data_row["bp"],
                "weight" => $data_row["weight"],
                "height" => $data_row["height"],
                "temp" => $data_row["temp"],
                "a" => $data_row["a"],
                "p" => $data_row["p"],
                "date" => $date,
                "name" => $fullname,
                "last_login" => $data_row["last_login"],
                "avatar" => "../assets/$db_avatar",
                "username" => $data_row["username"],
            );

            array_push($user_data, $array_data);
            $response = $user_data;
        }
    } else {

        $response["error"] = true;
        $response["message"] = "Table is empty!";
    }
}
if ($action == 'fetch_immunization') {

    $user_data = array();

    $user_id = $_POST["id"];
    $data = mysqli_query($db, "SELECT * FROM immunization INNER JOIN patient ON patient.id=immunization.patient_id where immunization.patient_id='$user_id'");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];
            $address = "Purok " . $data_row["purok"] . ", " . "Barangay " . $data_row["barangay"];

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "date" => $date,
                "birthdate" => $birthdate,
                "address" => $address,
                "purok" => $data_row["purok"],
                "barangay" => $data_row["barangay"],
                "child_no" => $data_row["child_no"],
                "suffix" => $data_row["suffix"],
                "mother_name" => $data_row["mother_name"],
                "appointment" => $data_row["appointment"],
                "father_name" =>  $data_row["father_name"],
                "weight" => $data_row["weight"],
                "age" => $data_row["age"],
                "temp" => $data_row["temp"],
                "gender" => $data_row["gender"],
                "fsn" => $data_row["fsn"],
                "first_name" => $data_row["first_name"],
                "last_name" => $data_row["last_name"],
                "phone_number" => $data_row["phone_number"],
                "last_login" => $data_row["last_login"],
                "immunization_given" => $data_row["immunization_given"],
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
if ($action == "fetch_gender") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["gender"];
}
if ($action == "fetch_contac") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["phone_number"];
}
if ($action == "fetch_name") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = ucfirst($user_row["first_name"]) . " " . ucfirst($user_row["last_name"]);
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
if ($action == "fetch_contact") {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient where id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["phone_number"];
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

<?php

include("../database/database.php");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'fetch_health') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM individual_treatment INNER JOIN patient ON patient.fsn=individual_treatment.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname =ucfirst($data_row["first_name"]) . " " .substr( ucfirst($data_row["middle_name"]),0,1) . " " . ucfirst($data_row["last_name"])  . " " . $data_row["suffix"];
            $db_birthdate = $data_row["birthdate"];
            $birthday = substr($db_birthdate, 4, 11);
            $birthdate = date("F d, Y", strtotime($birthday));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];

            $array_data = array(
                "id" => $data_row["id"],
                "fsn" => $data_row["fsn"],
                "clinisys" => $data_row["clinisys"],
                "last_name" => $data_row["last_name"],
                "first_name" => $data_row["first_name"],
                "middle_name" => $data_row["middle_name"],
                "suffix" => $data_row["suffix"],
                "birthdate" => $birthdate,
                "gender" => $data_row["gender"],
                "civil_status" =>  $data_row["civil_status"],
                "spouse" =>  $data_row["spouse"],
                "educ_attainment" =>  $data_row["educ_attainment"],
                "employment_status" =>  $data_row["employment_status"],
                "occupation" =>  $data_row["occupation"],
                "religion" =>  $data_row["religion"],
                "phone_number" => $data_row["telephone"],
                "street" => $data_row["street"],
                "address" => $data_row["purok"],
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

    $data = mysqli_query($db, "SELECT * FROM immunization INNER JOIN patient ON patient.fsn=immunization.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname =ucfirst($data_row["first_name"]) . " " .substr( ucfirst($data_row["middle_name"]),0,1) . " " . ucfirst($data_row["last_name"])  . " " . $data_row["suffix"];
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
                "address" => $data_row["purok"],
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
if ($action == 'fetch_prenatal') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM prenatal INNER JOIN patient ON patient.fsn=prenatal.fsn");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname =ucfirst($data_row["first_name"]) . " " .substr( ucfirst($data_row["middle_name"]),0,1) . " " . ucfirst($data_row["last_name"]);
            $db_birthdate = $data_row["birthdate"];
            $birthdate = date("F d, Y", strtotime($db_birthdate));
            $db_avatar = $data_row["avatar"];
            $date = $data_row["month"] . " " . $data_row["day"] . ", " . $data_row["year"];
            $edc = $data_row["edc"];
            $edc_Date = substr($edc, 4, 11);
            $date_edc = date("F d, Y", strtotime($edc_Date));
            $date_visit = $data_row["date_visit"];
            $visit = substr($date_visit, 4, 11);
            $date_visited = date("F d, Y", strtotime($visit));

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "date" => $date,
                "birthdate" => $birthdate,
                "address" => $data_row["purok"],
                "barangay" => $data_row["barangay"],
                "gp" => $data_row["gp"],
                "lmp" => $data_row["lmp"],
                "edc" => $date_edc,
                "tt_status" => $data_row["tt_status"],
                "appointment" => $data_row["appointment"],
                "date_visit" =>  $date_visited,
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
if ($action == 'fetch') {

    $user_data = array();

    $data = mysqli_query($db, "SELECT * FROM users ORDER BY bhw_id DESC");

    if (mysqli_num_rows($data) > 0) {
        while ($data_row = mysqli_fetch_assoc($data)) {

            $fullname = $data_row["first_name"] . " " . $data_row["last_name"];
            $db_birthdate = $data_row["birthday"];
            $birthdate = date("F d, Y", strtotime($db_birthdate));
            $db_avatar = $data_row["avatar"];
            $status = $data_row["status"];

            $array_data = array(
                "id" => $data_row["id"],
                "username" => $data_row["username"],
                "name" => $fullname,
                "birthdate" => $birthdate,
                "gender" => $data_row["gender"],
                "identification" => $data_row["bhw_id"],
                "first_name" => $data_row["first_name"],
                "last_name" => $data_row["last_name"],
                "status" => $data_row["status"],
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

    $username = "BHW-" . ucfirst($first_name . rand_username(3));
    $year = date("Y");
    $month = date("M");
    $db_status = "Active";
    $type = "BHW";

    $response = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "identification" => $identification,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "password" => $password,
        "status" => $db_status,
        "type" => $type
    );

    mysqli_query($db, "INSERT INTO users(first_name,last_name,birthday,gender,username,password,bhw_id,avatar,status,month,year)
        VALUES('$first_name','$last_name','$birthdate','$gender','$username','$hashed_password','$identification','$avatar','$db_status','$month','$year')");
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
if ($action == 'fetch_contact') {

    $user_id = $_POST["id"];
    $user_record = mysqli_query($db, "SELECT * FROM patient WHERE id='$user_id'");
    $user_row = mysqli_fetch_assoc($user_record);

    $response = $user_row["phone_number"];
}
if ($action == 'update_contact') {

    $user_id = $_POST["id"];
    $phone_number = $_POST["phone_number"];

    $response =  array(
        "phone_number" => $phone_number,
    );

    $contact_array_query = mysqli_query($db, "UPDATE patient SET phone_number='$phone_number' WHERE id='$user_id'");
}
if ($action == 'inactive') {

    $array_id = $_POST["user_ids"];

    $deactive_array_query = mysqli_query($db, "UPDATE users SET status='Inactive' WHERE id IN($array_id)");
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

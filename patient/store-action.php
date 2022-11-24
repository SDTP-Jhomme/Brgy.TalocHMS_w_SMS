<?php

include("../database/database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m-d-Y");

$response = array('error' => false);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if ($action == 'storeImmunization') {

    $fsn = $_POST["fsn"];
    $m_lastname = $_POST["m_lastname"];
    $m_firstname = $_POST["m_firstname"];
    $m_middlename = $_POST["m_middlename"];
    $f_lastname = $_POST["f_lastname"];
    $f_firstname = $_POST["f_firstname"];
    $f_middlename = $_POST["f_middlename"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Immunization";

    $response = array(

        "fsn" => $fsn,
        "m_firstname" => $m_firstname,
        "m_middlename" => $m_middlename,
        "m_lastname" => $m_lastname,
        "f_firstname" => $f_firstname,
        "f_middlename" => $f_middlename,
        "f_lastname" => $f_lastname,
        "purok" => $purok,
        "barangay" => $barangay,
        "status" => $status,
        "section" => $section,
    );

    $immunize_sql = mysqli_query($db, "INSERT INTO immunization_request(fsn,m_firstname,m_middlename,m_lastname,f_firstname,f_middlename,f_lastname,purok,barangay,status,section,date)
        VALUES('$fsn','$m_firstname','$m_middlename','$m_lastname','$f_firstname','$f_middlename','$f_lastname','$purok','$barangay','$status','$section','$date')");

    $request = mysqli_query($db, "INSERT INTO pending_request(fsn,date,section,status) VALUES('$fsn','$date','$section','$status')");
}

if ($action == 'storeHealth') {

    $fsn = $_POST["fsn"];
    $civil_status = $_POST["civil"];
    $spouse = $_POST["spouse"];
    $educ_attainment = $_POST["educ_attainment"];
    $employment_status = $_POST["employment_status"];
    $occupation = $_POST["occupation"];
    $religion = $_POST["religion"];
    $street = $_POST["street"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];
    $blood_type = $_POST["blood_type"];
    $family_member = $_POST["family_member"];
    $other_member = $_POST["other_member"];
    $philhealth_type = $_POST["philhealth_type"];
    $philhealth_no = $_POST["philhealth_no"];
    $m_lastname = $_POST["m_lastname"];
    $m_firstname = $_POST["m_firstname"];
    $m_middlename = $_POST["m_middlename"];
    $nhts = $_POST["nhts"];
    $pantawid_member = $_POST["pantawid_member"];
    $hh_no = $_POST["hh_no"];
    $alert_type = $_POST["alert_type"];
    $other_alert = $_POST["other_alert"];
    $medical_history = $_POST["medical_history"];
    $other_history = $_POST["other_history"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Individual Treatment";

    $response = array(

        "fsn" => $fsn,
        "civil_status" => $civil_status,
        "spouse" => $spouse,
        "educ_attainment" => $educ_attainment,
        "employment_status" => $employment_status,
        "occupation" => $occupation,
        "religion" => $religion,
        "street" => $street,
        "purok" => $purok,
        "barangay" => $barangay,
        "blood_type" => $blood_type,
        "family_member" => $family_member,
        "other_member" => $other_member,
        "philhealth_type" => $philhealth_type,
        "philhealth_no" => $philhealth_no,
        "m_lastname" => $m_lastname,
        "m_firstname" => $m_firstname,
        "m_middlename" => $m_middlename,
        "mother_name" => $mother_name,
        "nhts" => $nhts,
        "pantawid_member" => $pantawid_member,
        "hh_no" => $hh_no,
        "alert_type" => $alert_type,
        "other_alert" => $other_alert,
        "medical_history" => $medical_history,
        "other_history" => $other_history,
        "status" => $status,
        "section" => $section,

    );

    $health_sql = mysqli_query($db, "INSERT INTO health_request(fsn,civil_status,spouse,educ_attainment,employment_status,occupation,religion,street,purok,barangay,blood_type,family_member,other_member,philhealth_type,philhealth_no,
    m_lastname,m_firstname,m_middlename,nhts,pantawid_member,hh_no,alert_type,other_alert,medical_history,other_history,section,status,date)
        VALUES('$fsn','$civil_status','$spouse','$educ_attainment','$employment_status','$occupation','$religion',''$street','$purok','$barangay','$blood_type','$family_member','$other_member','$philhealth_type','$philhealth_no',
        '$m_lastname','$m_firstname','$m_middlename','$nhts','$pantawid_member','$hh_no','$alert_type','$other_alert','$medical_history','$other_history','$section','$status','$date')");

    $request = mysqli_query($db, "INSERT INTO pending_request(fsn,date,section,status) VALUES('$fsn','$date','$section','$status')");
}

if ($action == 'storePrenatal') {

    $fsn = $_POST["fsn"];
    $spouse_lastname = $_POST["spouse_lastname"];
    $spouse_firstname = $_POST["spouse_firstname"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $date = $month . " " . $day . ", " . $year;
    $status = "Pending";
    $section = "Maternity";

    $response = array(

        "fsn" => $fsn,
        "spouse_lastname" => $spouse_lastname,
        "spouse_firstname" => $spouse_firstname,
        "purok" => $purok,
        "barangay" => $barangay,
        "status" => $status,
        "section" => $section,
    );

    $prenatal_sql = mysqli_query($db, "INSERT INTO prenatal_request(fsn,spouse_lastname,spouse_firstname,purok,barangay,status,section,date)
        VALUES('$fsn','$spouse_lastname','$spouse_firstname','$purok','$barangay','$status','$section','$date')");

    $request = mysqli_query($db, "INSERT INTO pending_request(fsn,date,section,status) VALUES('$fsn','$date','$section','$status')");
}
echo json_encode($response);

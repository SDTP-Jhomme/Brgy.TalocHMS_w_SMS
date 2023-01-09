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
    $child_no = $_POST["child_no"];
    $phone_number = $_POST["phone_number"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
    $birthday = substr($birthdate, 4, 11);
    $db_birthdate = date("F d, Y", strtotime($birthday));
    $gender = $_POST["gender"];
    $m_lastname = $_POST["m_lastname"];
    $m_firstname = $_POST["m_firstname"];
    $m_middlename = $_POST["m_middlename"];
    $f_lastname = $_POST["f_lastname"];
    $f_firstname = $_POST["f_firstname"];
    $f_middlename = $_POST["f_middlename"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];
    $appointment = $_POST["appointment"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $temp = $_POST["temp"];
    $immunization_given = $_POST["immunization_given"];

    if ($gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }

    function rand_username($length = 3)
    {
        $str = "123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "PATIENT-" . ucfirst($first_name . rand_username(3));

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $mother_name = ucfirst($m_firstname) . " " . substr(ucfirst($m_middlename), 0, 1) . ". " . ucfirst($m_lastname);
    $father_name = ucfirst($f_firstname) . " " . substr(ucfirst($f_middlename), 0, 1) . ". " . ucfirst($f_lastname);
    $section = "Immunization";
    $last_login = "";
    $request_id = 0;

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "suffix" => $suffix,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "phone_number" => $phone_number,
        "password" => $birthdate,
    );
    $patient = mysqli_query($db, "INSERT INTO patient(fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,max_limit,day,month,year,last_login,request_id,section)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number',0,'$day','$month','$year','$last_login','$request_id','$section')");

    $patient_id = $db->insert_id;

    $immunize_sql = mysqli_query($db, "INSERT INTO immunization(patient_id,child_no,mother_name,father_name,purok,barangay,appointment,age,weight,temp,immunization_given,day,month,year,max_limit,section)
    VALUES('$patient_id','$child_no','$mother_name','$father_name','$purok','$barangay','$appointment','$age','$weight','$temp','$immunization_given','$day','$month','$year',0,'$section')");

    $data = "Mr. / Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " This is your USERNAME: $username and PASSWORD: $password. THANK YOU!";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $phone_number . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $phone_number);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
    $sms_response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($sms_response, true);
}

if ($action == 'storeHealth') {

    $fsn = $_POST["fsn"];
    $clinisys = $_POST["clinisys"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
    $birthday = substr($birthdate, 4, 11);
    $db_birthdate = date("F d, Y", strtotime($birthday));
    $gender = $_POST["gender"];
    $civil_status = $_POST["civil_status"];
    $spouse = $_POST["spouse"];
    $educ_attainment = $_POST["educ_attainment"];
    $employment_status = $_POST["employment_status"];
    $occupation = $_POST["occupation"];
    $religion = $_POST["religion"];
    $phone_number = $_POST["phone_number"];
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
    $encounter_type = $_POST["encounter_type"];
    $consultation_type = $_POST["consultation_type"];
    $consultation_date = $_POST["consultation_date"];
    $age = $_POST["age"];
    $transaction_mode = $_POST["transaction_mode"];
    $s = $_POST["s"];
    $o = $_POST["o"];
    $pr = $_POST["pr"];
    $rr = $_POST["rr"];
    $bp = $_POST["bp"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $temp = $_POST["temp"];
    $a = $_POST["a"];
    $p = $_POST["p"];

    if ($gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }

    function rand_username($length = 3)
    {
        $str = "123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }

    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "PATIENT-" . ucfirst($first_name . rand_username(3));

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $section = "Individual Treatment";
    $last_login = "";
    $request_id = 0;

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "suffix" => $suffix,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "phone_number" => $phone_number,
        "password" => $birthdate,
    );
    $patient = mysqli_query($db, "INSERT INTO patient(fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,max_limit,day,month,year,last_login,request_id,section)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number',0,'$day','$month','$year','$last_login','$request_id','$section')");

    $patient_id = $db->insert_id;

    $health_sql = mysqli_query($db, "INSERT INTO individual_treatment(patient_id,clinisys,civil_status,spouse,educ_attainment,employment_status,occupation,religion,
    street,purok,barangay,blood_type,family_member,other_member,philhealth_type,philhealth_no,m_lastname,m_firstname,m_middlename,nhts,pantawid_member,hh_no,alert_type,other_alert,medical_history,other_history,
    encounter_type,consultation_type,consultation_date,age,transaction_mode,s,o,pr,rr,bp,weight,height,temp,a,p,day,month,year,max_limit,section)
        VALUES('$patient_id','$clinisys','$civil_status','$spouse','$educ_attainment','$employment_status','$occupation','$religion',
        '$street','$purok','$barangay','$blood_type','$family_member','$other_member','$philhealth_type','$philhealth_no','$m_lastname','$m_firstname','$m_middlename','$nhts','$pantawid_member','$hh_no','$alert_type','$other_alert','$medical_history','$other_history',
        '$encounter_type','$consultation_type','$consultation_date','$age','$transaction_mode','$s','$o','$pr','$rr','$bp','$weight','$height','$temp','$a','$p','$day','$month','$year',0,'$section')");

    $data = "Mr. / Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " This is your USERNAME: $username and PASSWORD: $password Thank you!";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $phone_number . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $phone_number);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
    $sms_response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($sms_response, true);
}

if ($action == 'storePrenatal') {

    $fsn = $_POST["fsn"];
    $phone_number = $_POST["phone_number"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $birthday = substr($birthdate, 4, 11);
    $db_birthdate = date("F d, Y", strtotime($birthday));
    $gender = $_POST["gender"];
    $spouse_lastname = $_POST["spouse_lastname"];
    $spouse_firstname = $_POST["spouse_firstname"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];
    $gp = $_POST["gp"];
    $lmp = $_POST["lmp"];
    $edc = $_POST["edc"];
    $tt_status = $_POST["tt_status"];
    $appointment = $_POST["appointment"];
    $date_visit = $_POST["date_visit"];
    $weight = $_POST["weight"];
    $bp = $_POST["bp"];
    $cr = $_POST["cr"];
    $rr = $_POST["rr"];
    $temp = $_POST["temp"];
    $aog = $_POST["aog"];
    $fundic_height = $_POST["height"];
    $fhb = $_POST["fhb"];
    $presentation = $_POST["presentation"];

    if ($gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }
    function rand_username($length = 3)
    {
        $str = "123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "PATIENT-" . ucfirst($first_name . rand_username(3));

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $spouse_name = ucfirst($spouse_firstname) . " " . ucfirst($spouse_lastname);
    $section = "Maternity";
    $last_login = "";
    $request_id = 0;

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "phone_number" => $phone_number,
        "password" => $birthdate,
    );
    $patient = mysqli_query($db, "INSERT INTO patient(fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,max_limit,day,month,year,last_login,request_id,section)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number',0,'$day','$month','$year','$last_login','$request_id','$section')");

    $patient_id = $db->insert_id;

    $prenatal_sql = mysqli_query($db, "INSERT INTO prenatal(patient_id,spouse_name,purok,barangay,gp,lmp,edc,tt_status,appointment,date_visit,weight,bp,cr,rr,temp,aog,fundic_height,fhb,presentation,day,month,year,max_limit,section)
        VALUES('$patient_id','$spouse_name','$purok','$barangay','$gp','$lmp','$edc','$tt_status','$appointment','$date_visit','$weight','$bp','$cr','$rr','$temp','$aog','$fundic_height','$fhb','$presentation','$day','$month','$year',0,'$section')");

    $data = "Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " This is your USERNAME: $username and PASSWORD: $password Thank you!";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $phone_number . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $phone_number);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
    $sms_response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($sms_response, true);
}
if ($action == 'storeFamily') {

    $fsn = $_POST["fsn"];
    $phone_number = $_POST["phone_number"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $birthday = substr($birthdate, 4, 11);
    $db_birthdate = date("F d, Y", strtotime($birthday));
    $gender = $_POST["gender"];
    $spouse_lastname = $_POST["spouse_lastname"];
    $spouse_firstname = $_POST["spouse_firstname"];
    $spouse_purok = $_POST["spouse_purok"];
    $spouse_barangay = $_POST["spouse_barangay"];
    $purok = $_POST["purok"];
    $barangay = $_POST["barangay"];
    $chLB = $_POST["chLB"];
    $heent = $_POST["heent"];
    $conjunctive = $_POST["conjunctive"];
    $neck = $_POST["neck"];
    $abdomen = $_POST["abdomen"];
    $appointment = $_POST["appointment"];
    $thorax = $_POST["thorax"];
    $weight = $_POST["weight"];
    $bp = $_POST["bp"];
    $pr = $_POST["pr"];
    $femGenital = $_POST["femGenital"];
    $maleGenital = $_POST["maleGenital"];

    if ($gender == "Male") {
        $avatar = "avatar/default.png";
    } else {
        $avatar = "avatar/default-woman.png";
    }
    function rand_username($length = 3)
    {
        $str = "123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    function random_password($length = 5)
    {
        $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $shuffled = substr(str_shuffle($str), 0, $length);
        return $shuffled;
    }
    $password = random_password(8);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $username = "PATIENT-" . ucfirst($first_name . rand_username(3));

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $spouse_name = ucfirst($spouse_firstname) . " " . ucfirst($spouse_lastname);
    $section = "Family Planning";
    $last_login = "";
    $request_id = 0;

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "middle_name" => $middle_name,
        "username" => $username,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "phone_number" => $phone_number,
        "password" => $birthdate,
    );
    $patient = mysqli_query($db, "INSERT INTO patient(fsn,first_name,middle_name,last_name,suffix,birthdate,gender,username,password,avatar,phone_number,max_limit,day,month,year,last_login,request_id,section)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$username','$hashed_password','$avatar','$phone_number',0,'$day','$month','$year','$last_login','$request_id','$section')");

    $patient_id = $db->insert_id;

    $planning_sql = mysqli_query($db, "INSERT INTO family_planning(patient_id,purok,barangay,appointment,spouse_name,spouse_purok,spouse_barangay,heent,bp,weight,pr,chLB,conjunctive,neck,abdomen,thorax,femGenital,maleGenital,day,month,year,max_limit,section)
        VALUES('$patient_id','$purok','$barangay','$appointment','$spouse_name','$spouse_purok','$spouse_barangay','$heent','$bp','$weight','$pr','$chLB','$conjunctive','$neck','$abdomen','$thorax','$femGenital','$maleGenital','$day','$month','$year',0,'$section')");

    if ($planning_sql === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $planning_sql . "<br>" . $db->error;
    }
    $data = "Ms. " . ucfirst($first_name) . " " . ucfirst($last_name) . " This is your USERNAME: $username and PASSWORD: $password Thank you!";
    $sms_url = "https://sms.pagenet.info/admin/index.php";
    $auth_key = "p6rV1tCjldQ05HCiuO8Zh5ZXtMSv44tIOG7bvHgC";

    $device_id = "18";

    $sim_id = "3";

    $msg = $sms_url . "?route=api/sms/send&auth_key=" . $auth_key . "&device_id=" . $device_id . "&sim_id=" . $sim_id . "&mobile_no=" . $phone_number . "&data_type=Plain&message=" . urlencode("$data");

    $cURL = curl_init($msg);
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $phone_number);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $data);
    $sms_response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($sms_response, true);
}
echo json_encode($response);

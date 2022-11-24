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
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
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
    $weight =$_POST["weight"];
    $temp = $_POST["temp"];
    $immunization_given = $_POST["immunization_given"];

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $mother_name = ucfirst($m_firstname) . " " . substr(ucfirst($m_middlename),0,1) . ". " . ucfirst($m_lastname);
    $father_name = ucfirst($f_firstname) . " " . substr(ucfirst($f_middlename),0,1) . ". " . ucfirst($f_lastname);

    $response = array(
        "fsn" => $fsn,
        "child_no" => $child_no,
        "first_name" => $first_name,
        "middle_name" => $middle_name,
        "last_name" => $last_name,
        "suffix" => $suffix,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "mother_name" => $mother_name,
        "father_name" => $father_name,
        "purok" => $purok,
        "barangay" => $barangay,
        "appointment" => $appointment,
        "age" => $age,
        "weight" => $weight,
        "temp" => $temp,
        "immunization_given" => $immunization_given,
    );

    $immunize_sql = mysqli_query($db, "INSERT INTO immunization(fsn,child_no,first_name,middle_name,last_name,suffix,birthdate,gender,mother_name,father_name,purok,barangay,appointment,age,weight,temp,immunization_given,day,month,year)
        VALUES('$fsn','$child_no','$first_name','$middle_name','$last_name','$suffix','$birthdate','$gender','$mother_name','$father_name','$purok','$barangay','$appointment','$age','$weight',    
        '$temp','$immunization_given','$day','$month','$year')");

    $request = mysqli_query($db, "UPDATE immunization_request SET status='Done' WHERE id");
}

if ($action == 'storeHealth') {

    $fsn = $_POST["fsn"];
    $clinisys = $_POST["clinisys"];
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $suffix = $_POST["suffix"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $civil_status = $_POST["civil"];
    $spouse = $_POST["spouse"];
    $educ_attainment = $_POST["educ_attainment"];
    $employment_status = $_POST["employment_status"];
    $occupation = $_POST["occupation"];
    $religion = $_POST["religion"];
    $telephone = $_POST["telephone"];
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

    $day = date("d");
    $year = date("Y");
    $month = date("M");

    $response = array(
        "fsn" => $fsn,
        "clinisys" => $clinisys,
        "last_name" => $last_name,
        "first_name" => $first_name,
        "middle_name" => $middle_name,
        "suffix" => $suffix,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "civil_status" => $civil_status,
        "spouse" => $spouse,
        "educ_attainment" => $educ_attainment,
        "employment_status" => $employment_status,
        "occupation" => $occupation,
        "religion" => $religion,
        "telephone" => $telephone,
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
        "encounter_type" => $encounter_type,
        "consultation_type" => $consultation_type,
        "consultation_date" => $consultation_date,
        "age" => $age,
        "transaction_mode" => $transaction_mode,
        "s" => $s,
        "o" => $o,
        "pr" => $pr,
        "rr" => $rr,
        "bp" => $bp,
        "weight" => $weight,
        "height" => $height,
        "temp" => $temp,
        "o" => $o,
        "p" => $p,

    );

    $health_sql = mysqli_query($db, "INSERT INTO individual_treatment(fsn,clinisys,last_name,first_name,middle_name,suffix,birthdate,gender,civil_status,spouse,educ_attainment,employment_status,occupation,religion,telephone,
    street,purok,barangay,blood_type,family_member,other_member,philhealth_type,philhealth_no,m_lastname,m_firstname,m_middlename,nhts,pantawid_member,hh_no,alert_type,other_alert,medical_history,other_history,
    encounter_type,consultation_type,consultation_date,age,transaction_mode,s,o,pr,rr,bp,weight,height,temp,a,p,day,month,year)
        VALUES('$fsn','$clinisys','$last_name','$first_name','$middle_name','$suffix','$birthdate','$gender','$civil_status','$spouse','$educ_attainment','$employment_status','$occupation','$religion','$telephone',
        '$street','$purok','$barangay','$blood_type','$family_member','$other_member','$philhealth_type','$philhealth_no','$m_lastname','$m_firstname','$m_middlename','$nhts','$pantawid_member','$hh_no','$alert_type','$other_alert','$medical_history','$other_history',
        '$encounter_type','$consultation_type','$consultation_date','$age','$transaction_mode','$s','$o','$pr','$rr','$bp','$weight','$height','$temp','$a','$p','$day','$month','$year')");

    $request = mysqli_query($db, "UPDATE immunization_request SET status='Done' WHERE id");
}

if ($action == 'storePrenatal') {

    $fsn = $_POST["fsn"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
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

    $day = date("d");
    $year = date("Y");
    $month = date("M");
    $spouse_name = ucfirst($spouse_firstname) . " " . ucfirst($spouse_lastname);

    $response = array(
        "fsn" => $fsn,
        "first_name" => $first_name,
        "middle_name" => $middle_name,
        "last_name" => $last_name,
        "birthdate" => $birthdate,
        "gender" => $gender,
        "spouse_name" => $spouse_name,
        "purok" => $purok,
        "barangay" => $barangay,
        "appointment" => $appointment,
        "gp" => $gp,
        "lmp" => $lmp,
        "edc" => $edc,
        "tt_status" => $tt_status,
        "date_visit" => $date_visit,
        "weight" => $weight,
        "bp" => $bp,
        "cr" => $cr,
        "rr" => $rr,
        "temp" => $temp,
        "aog" => $aog,
        "fundic_height" => $fundic_height,
        "fhb" => $fhb,
        "presentation" => $presentation,
    );

    $prenatal_sql = mysqli_query($db, "INSERT INTO prenatal(fsn,first_name,middle_name,last_name,birthdate,gender,spouse_name,purok,barangay,gp,lmp,edc,tt_status,appointment,date_visit,weight,bp,cr,rr,temp,aog,fundic_height,fhb,presentation,day,month,year)
        VALUES('$fsn','$first_name','$middle_name','$last_name','$birthdate','$gender','$spouse_name','$purok','$barangay','$gp','$lmp','$edc','$tt_status','$appointment','$date_visit','$weight','$bp','$cr','$rr','$temp','$aog','$fundic_height','$fhb','$presentation','$day','$month','$year')");
        
    $request = mysqli_query($db, "UPDATE immunization_request SET status='Done' WHERE id");
}
echo json_encode($response);

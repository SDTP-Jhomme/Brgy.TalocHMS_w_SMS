<?php

$immunization_request = mysqli_query($db, "SELECT * FROM immunization_request");

while ($immu_row = mysqli_fetch_assoc($immunization_request)) {

    $m_firstname = $immu_row['m_firstname'];
    $m_middlename = $immu_row['m_middlename'];
    $m_lastname = $immu_row['m_lastname'];
    $f_firstname = $immu_row['f_firstname'];
    $f_middlename = $immu_row['f_middlename'];
    $f_lastname = $immu_row['f_lastname'];
    $purok = $immu_row['purok'];
    $barangay = $immu_row['barangay'];

}

$health_request = mysqli_query($db, "SELECT * FROM health_request");

while ($health_row = mysqli_fetch_assoc($health_request)) {

    $civil_status = $health_row['civil_status'];
    $spouse = $health_row['spouse'];
    $educ_attainment = $health_row['educ_attainment'];
    $employment_status = $health_row['employment_status'];
    $occupation = $health_row['occupation'];
    $religion = $health_row['religion'];
    $street = $health_row['street'];
    $blood_type = $health_row['blood_type'];
    $family_member = $health_row['family_member'];
    $other_member = $health_row['other_member'];
    $philhealth_type = $health_row['philhealth_type'];
    $philhealth_no = $health_row['philhealth_no'];
    $nhts = $health_row['nhts'];
    $pantawid_member = $health_row['pantawid_member'];
    $hh_no = $health_row['hh_no'];
    $alert_type = $health_row['alert_type'];
    $other_alert = $health_row['other_alert'];
    $medical_history = $health_row['medical_history'];
    $other_history = $health_row['other_history'];
    $m_firstname = $health_row['m_firstname'];
    $m_middlename = $health_row['m_middlename'];
    $m_lastname = $health_row['m_lastname'];
    $purok = $health_row['purok'];
    $barangay = $health_row['barangay'];
}

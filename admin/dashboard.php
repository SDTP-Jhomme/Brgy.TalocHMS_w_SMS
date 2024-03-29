<?php
$count_patient = $db->query("SELECT COUNT(*) as total FROM `patient`");
$patient = $count_patient->fetch_array();
$count_request = $db->query("SELECT COUNT(*) as total FROM `pending_request` WHERE status='Pending'");
$request = $count_request->fetch_array();
$count_immunization = $db->query("SELECT COUNT(*) as total FROM `immunization` INNER JOIN patient ON patient.id=immunization.patient_id");
$immunization = $count_immunization->fetch_array();
$count_prenatal = $db->query("SELECT COUNT(*) as total FROM `prenatal` INNER JOIN patient ON patient.id=prenatal.patient_id");
$prenatal = $count_prenatal->fetch_array();
$count_health = $db->query("SELECT COUNT(*) as total FROM `individual_treatment` INNER JOIN patient ON patient.id=individual_treatment.patient_id");
$health = $count_health->fetch_array();
$count_planning = $db->query("SELECT COUNT(*) as total FROM `family_planning` INNER JOIN patient ON patient.id=family_planning.patient_id");
$family_planning = $count_planning->fetch_array();
?>
<div class="container-fluid px-4">
    <h1 class="my-4 pagetitle">Dashboard</h1>
    <div class="row mb-lg-3 d-flex justify-content-center">
        <div class="col-4">
            <div class="icon-box-registered">
                <h4 class="title-registered"><span class="small">Total Registered Patient(s)</span></h4>
                <div class="icon-registered"><i class="fas fa-users"></i></div>
                <p class="description-registered fs-4"><?php echo $patient['total']; ?> Patient(s)</p>
            </div>
        </div>
        <div class="col-4">
            <div class="icon-box-pending">
                <h4 class="title-pending"><span class="small">Total Pending Request(s)</span></h4>
                <div class="icon-pending"><i class="el-icon-loading"></i></div>
                <p class="description-pending fs-4"><?php echo $request['total']; ?> Request(s)</p>
            </div>
        </div>
    </div>
    <div class="row mb-lg-3 d-flex justify-content-center">
        <div class="col-3">
            <div class="icon-box-registered">
                <h4 class="title-registered"><span class="small">Maternal Record(s)</span></h4>
                <div class="icon-registered"><i class="el-icon-document"></i></div>
                <p class="description-registered fs-4"><?php echo $prenatal['total']; ?> Patient(s)</p>
            </div>
        </div>
        <div class="col-3">
            <div class="icon-box-declined">
                <h4 class="title-declined"><span class="small">Immunization Record(s)</span></h4>
                <div class="icon-declined"><i class="el-icon-document"></i></div>
                <p class="description-declined fs-4"><?php echo $immunization['total']; ?> Patient(s)</p>
            </div>
        </div>
        <div class="col-3">
            <div class="icon-box-approved">
                <h4 class="title-approved"><span class="small">Individual Treatment Record(s)</span></h4>
                <div class="icon-approved"><i class="el-icon-document"></i></div>
                <p class="description-approved fs-4"><?php echo $health['total']; ?> Patient(s)</p>
            </div>
        </div>
        <div class="col-3">
            <div class="icon-box-pending">
                <h4 class="title-pending"><span class="small">Family Planning Record(s)</span></h4>
                <div class="icon-pending"><i class="el-icon-document"></i></div>
                <p class="description-pending fs-4"><?php echo $family_planning['total']; ?> Patient(s)</p>
            </div>
        </div>
    </div>
</div>
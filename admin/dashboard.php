<?php
$sql = mysqli_query($db, "SELECT COUNT(*) AS `count` FROM patient");
$user_row = mysqli_fetch_assoc($sql);
$count = $user_row['count'];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<div class="container-fluid px-4">
    <h1 class="my-4 pagetitle">Dashboard</h1>
    <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box-registered">
                <div class="icon-registered"><i class="fas fa-users"></i></div>
                <h4 class="title-registered"> Patients<span class="small"> | Total Registered</span></h4>
                <p class="description-registered fs-4"><?php echo $count; ?> Patients</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box-approved">
                <div class="icon-approved"><i class="el-icon-document"></i></div>
                <h4 class="title-approved"> Patients<span class="small"> | Approved Request</span></h4>
                <p class="description-approved fs-4"><?php echo $count; ?> Request</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box-declined">
                <div class="icon-declined"><i class="fas fa-trash-alt"></i></div>
                <h4 class="title-declined"> Patients<span class="small"> | Declined Request</span></h4>
                <p class="description-declined fs-4"><?php echo $count; ?> Request</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box-pending">
                <div class="icon-pending"><i class="el-icon-loading"></i></div>
                <h4 class="title-pending"> Patients<span class="small"> | Pending Request</span></h4>
                <p class="description-pending fs-4"><?php echo $count; ?> Request</p>
            </div>
        </div>
    </div>
</div>
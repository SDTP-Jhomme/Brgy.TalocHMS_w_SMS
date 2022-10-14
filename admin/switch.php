<?php
include "../database/database.php";
if ($_POST['key'] == "getAllUsers") {
    $tableData = '';
    $sr = 1;
    $query = "SELECT * FROM users";
    $result = $db->query($query);
    if ($result->num_rows>0){
        while ($row = $result->fetch_object()){
            $buttonActive = (($row->status == 0)?'block':'none');
            $buttonInActive = (($row->status == 1)?'block':'none');
            $tableData .='<tr>
                <td>'.$sr.'</td>
                <td>'.$row->id.'</td>
                <td>'.$row->username.'</td>
                <td>'.$row->bhw_id.'</td>
                <td><a href="javaScript:void(0)" title="Active" style="display:'.$buttonActive.'" id="activeBtn'.$row->id.'" onclick="activeInactive(\''.$row->id.'\',1);" class="btn btn-success btn-sm"> <i class="fa fa-thumbs-up"></i></a>
                <a href="javaScript:void(0)" title="In active" style="display:'.$buttonInActive.'" id="inactiveBtn'.$row->id.'" onclick="activeInactive(\''.$row->id.'\',0);" class="btn btn-danger btn-sm"> <i class="fa fa-thumbs-down"></i></a> </td>
            </tr>';
            $sr++;
        }
    }
    echo $tableData;
}
if ($_POST['key'] == "activeInactive"){
    $status = $_POST['status'];
    $recordId = $_POST['bhw_id'];
    $query = "UPDATE users SET status='$status' WHERE id='$recordId'";
    $result = $db->query($query);
    if ($result){
        echo "success";
    }
}?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="active-inactive-script.js"></script>
<div class="container">
    <div class="row">
        <div class="col-lg-8 posts-list">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <center><img src="../website/img/coding-birds-online/coding-birds-online-favicon.png" width="70"></center>
                    <h5 class="card-title text-center">Active Inactive users in PHP</h5>
                </div>
                <table id="exampleTable" class="table table-bordered" style="width: 100%">
                    <thead id="thead">
                        <tr style="background-color: #1573ff">
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBodyData">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.post("script.php", {
            key: "getAllUsers"
        }, function(response) {
            $("#tableBodyData").html(response);
        })
    });

    function activeInactive(recordId, status) {
        var message = ((status == 0 ? " inactive " : " Active "));
        if (confirm("Are you sure to" + message + "the user")) {
            $.post("script.php", {
                key: "activeInactive",
                status: status,
                recordId: recordId
            }, function(response) {
                if (response == "success") {
                    if (status == 0) {
                        $('#activeBtn' + recordId).show();
                        $('#inactiveBtn' + recordId).hide();
                    } else if (status == 1) {
                        $('#inactiveBtn' + recordId).show();
                        $('#activeBtn' + recordId).hide();
                    }
                    alert("User is " + message + "now");
                }
            });
        }
    }
</script>
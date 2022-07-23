<?php

include("./index.php");

if (isset($_POST["delete"])) {

    $user_id = $_POST["id"];

    mysqli_query($db, "DELETE FROM users WHERE id=$user_id");

    echo "<script>window.location.href='index?viewBHW=$viewBHW && alertDelete=$alert'</script>";

}

if (isset($_POST["confirmDelete"])) {

    $array_id = $_POST["delete_user"];
    $extract_id = implode(",", $array_id);

    mysqli_query($db, "DELETE FROM users WHERE id IN($extract_id)");

    echo "<script>window.location.href='index?viewBHW=$viewBHW && alertBulkDelete=$alert'</script>";

}



?>
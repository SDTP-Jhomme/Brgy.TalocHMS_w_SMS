<?php

include("./index.php");

if (isset($_POST["delete"])) {

    $user_id = $_POST["id"];

    mysqli_query($db, "DELETE FROM users WHERE id=$user_id");

    echo "<script>window.location.href='?viewBHW=$viewBHW && alertDelete=$alert'</script>";

}

?>
<?php

$query = $db->query("SELECT * FROM `immunization` ORDER BY `fsn` DESC");
$i = 1;
while ($fetch = $query->fetch_array()) {
    $id = $fetch['fsn'];
    $pending_request = $db->query("SELECT COUNT(*) as total FROM `pending_request` where `fsn` = '$id' && `status` = 'Pending'");
    $done_request = $pending_request->fetch_array();
    $date = $fetch["day"] . "/" . $fetch["month"] . "/" . $fetch["year"];
    $db_birthdate = $fetch["birthdate"];
    $name = $fetch['first_name'] . " " . $fetch['last_name'];
    $birthdate = date("F d, Y", strtotime($db_birthdate));
}
?>
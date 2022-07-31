<?php

$db = mysqli_connect("localhost", "root", "", "capstone");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: ".mysqli_connect_errno();
}

session_start();

?>
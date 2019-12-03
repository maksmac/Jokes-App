<?php
    $host = "localhost";
    $username = "root";
    $password = "root";
    $database_in_use = "test";

    $mysqli = new mysqli($host, $username, $password, $database_in_use);

    if (mysqli_connect_error()) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
?>
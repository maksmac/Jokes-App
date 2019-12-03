<?php
    $host = "hcm4e9frmbwfez47.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "e48oxaowx6xev76t";
    $password = "amgpi1p16ldin1t7";
    $database_in_use = "p02svjwrxx0i9j6d";

    $mysqli = new mysqli($host, $username, $password, $database_in_use);

    if (mysqli_connect_error()) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
?>

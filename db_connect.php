<?php

$servername = "localhost";

$username = "root";

$password = "";

$database = "supplier_management_system";

$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
);

if(!$conn){

    die("Database connection failed");
}


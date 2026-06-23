<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'manager'){

    header("Location: view_suppliers.php");

    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$allowed_statuses = array(
    'Approved',
    'Rejected'
);

if(!in_array($status, $allowed_statuses)){

    header("Location: view_suppliers.php");

    exit();
}

$id = mysqli_real_escape_string($conn, $id);
$status = mysqli_real_escape_string($conn, $status);

$sql = "UPDATE suppliers
        SET status='$status'
        WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: view_suppliers.php");

exit();

?>

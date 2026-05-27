<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'admin'){

    header("Location: view_suppliers.php");

    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM suppliers WHERE id='$id'";

$result = mysqli_query($conn, $sql);

if($result){

    header("Location: view_suppliers.php");
}
else{

    echo "Delete Failed";
}

?>
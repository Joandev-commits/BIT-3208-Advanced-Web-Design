<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'procurement officer'){

    header("Location: view_suppliers.php");

    exit();
}

$column_check = mysqli_query($conn, "SHOW COLUMNS FROM suppliers LIKE 'supplier_document'");

if(mysqli_num_rows($column_check) == 0){

    mysqli_query($conn, "ALTER TABLE suppliers ADD supplier_document VARCHAR(255) NULL");
}

if(isset($_POST['add_supplier'])){

    $supplier_name = $_POST['supplier_name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $business_type = $_POST['business_type'];

    $status = "Pending Review";

    $supplier_document = "";

    if(isset($_FILES['supplier_document']) &&
       $_FILES['supplier_document']['error'] == 0){

        $upload_dir = "uploads/";

        if(!is_dir($upload_dir)){

            mkdir($upload_dir, 0777, true);
        }

        $extension = pathinfo($_FILES['supplier_document']['name'], PATHINFO_EXTENSION);
        $file_name = uniqid("supplier_", true) . "." . $extension;
        $upload_path = $upload_dir . $file_name;

        if(move_uploaded_file($_FILES['supplier_document']['tmp_name'], $upload_path)){

            $supplier_document = $upload_path;
        }
    }

    $sql = "INSERT INTO suppliers(

                supplier_name,
                email,
                phone,
                business_type,
                status,
                supplier_document

            )

            VALUES(

                '$supplier_name',
                '$email',
                '$phone',
                '$business_type',
                '$status',
                '$supplier_document'

            )";

    $result = mysqli_query($conn, $sql);

    if($result){

        echo "Supplier Added Successfully";
    }
    else{

        echo "Failed to Add Supplier";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Supplier</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <form method="POST"
          enctype="multipart/form-data"
          class="modern-form">

        <h2>Add Supplier</h2>

        <input type="text"
               name="supplier_name"
               placeholder="Supplier Name"
               required>

        <input type="email"
               name="email"
               placeholder="Email Address"
               required>

        <input type="text"
               name="phone"
               placeholder="Phone Number"
               required>

        <input type="text"
               name="business_type"
               placeholder="Business Type"
               required>

        <input type="text"
               value="Pending Review"
               readonly>

        <input type="file"
               name="supplier_document">

        <button type="submit"
                name="add_supplier">

            Add Supplier

        </button>

        <br><br>

        <a href="view_suppliers.php"
           class="back-link">

            View Suppliers

        </a>

    </form>

</div>

</body>

</html>

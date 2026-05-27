<?php

include("session_check.php");
include("db_connect.php");

if(isset($_POST['add_supplier'])){

    $supplier_name = $_POST['supplier_name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $business_type = $_POST['business_type'];

    $status = $_POST['status'];

    $sql = "INSERT INTO suppliers(

                supplier_name,
                email,
                phone,
                business_type,
                status

            )

            VALUES(

                '$supplier_name',
                '$email',
                '$phone',
                '$business_type',
                '$status'

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

        <select name="status" required>

            <option value="">
                Select Status
            </option>

            <option value="Pending">
                Pending
            </option>

            <option value="Approved">
                Approved
            </option>

            <option value="Rejected">
                Rejected
            </option>

        </select>

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
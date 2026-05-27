<?php

include("session_check.php");
include("db_connect.php");

$id = $_GET['id'];

$sql = "SELECT * FROM suppliers WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_supplier'])){

    $supplier_name = $_POST['supplier_name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $business_type = $_POST['business_type'];

    $status = $_POST['status'];

    $update = "UPDATE suppliers SET

                supplier_name='$supplier_name',
                email='$email',
                phone='$phone',
                business_type='$business_type',
                status='$status'

                WHERE id='$id'";

    if(mysqli_query($conn, $update)){

        header("Location: view_suppliers.php");
    }
    else{

        echo "Update Failed";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Supplier</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-container">

    <form method="POST" class="modern-form">

        <h2>Edit Supplier</h2>

        <input type="text"
               name="supplier_name"
               value="<?php echo $row['supplier_name']; ?>"
               required>

        <input type="email"
               name="email"
               value="<?php echo $row['email']; ?>"
               required>

        <input type="text"
               name="phone"
               value="<?php echo $row['phone']; ?>"
               required>

        <input type="text"
               name="business_type"
               value="<?php echo $row['business_type']; ?>"
               required>

        <select name="status" required>

            <option value="Pending"
            <?php
            if($row['status'] == 'Pending'){
                echo "selected";
            }
            ?>>

                Pending

            </option>

            <option value="Approved"
            <?php
            if($row['status'] == 'Approved'){
                echo "selected";
            }
            ?>>

                Approved

            </option>

            <option value="Rejected"
            <?php
            if($row['status'] == 'Rejected'){
                echo "selected";
            }
            ?>>

                Rejected

            </option>

        </select>

        <button type="submit"
                name="update_supplier">

            Update Supplier

        </button>

    </form>

</div>

</body>
</html>
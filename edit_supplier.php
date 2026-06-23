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

$id = $_GET['id'];

$sql = "SELECT * FROM suppliers WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_supplier'])){

    $supplier_name = $_POST['supplier_name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $business_type = $_POST['business_type'];

    $status = "Pending Review";

    $supplier_document = $row['supplier_document'];

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

    $update = "UPDATE suppliers SET

                supplier_name='$supplier_name',
                email='$email',
                phone='$phone',
                business_type='$business_type',
                status='$status',
                supplier_document='$supplier_document'

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

    <form method="POST"
          enctype="multipart/form-data"
          class="modern-form">

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

        <input type="text"
               value="Pending Review"
               readonly>

        <input type="file"
               name="supplier_document">

        <button type="submit"
                name="update_supplier">

            Update Supplier

        </button>

    </form>

</div>

</body>
</html>

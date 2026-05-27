<?php

include("session_check.php");
include("db_connect.php");

$sql = "SELECT * FROM suppliers";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>

    <title>View Suppliers</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="table-container">

    <h2>Suppliers List</h2>

    <a href="add_supplier.php"
       class="add-btn">

        Add Supplier

    </a>

    <br><br>

    <table>

        <tr>

            <th>ID</th>

            <th>Supplier Name</th>

            <th>Email</th>

            <th>Phone</th>

            <th>Business Type</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo $row['supplier_name']; ?>
            </td>

            <td>
                <?php echo $row['email']; ?>
            </td>

            <td>
                <?php echo $row['phone']; ?>
            </td>

            <td>
                <?php echo $row['business_type']; ?>
            </td>

            <td>
                <?php echo $row['status']; ?>
            </td>

            <td>

                <a href="edit_supplier.php?id=<?php echo $row['id']; ?>">
                    Edit
                </a>

                |

                <a href="delete_supplier.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Delete Supplier?')">

                    Delete

                </a>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

    <br>

    <?php

    if($_SESSION['role'] == 'admin'){

        echo "<a href='admin_dashboard.php'>Back to Dashboard</a>";
    }
    else{

        echo "<a href='procurement_dashboard.php'>Back to Dashboard</a>";
    }

    ?>

</div>

</body>
</html>
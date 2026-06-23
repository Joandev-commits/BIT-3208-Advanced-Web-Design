<?php

include("session_check.php");
include("db_connect.php");


if($_SESSION['role'] != 'admin'){

    header("Location: login.php");
    exit();
}

$sql = "SELECT
            audit_logs.*,
            users.fullname,
            users.role
        FROM audit_logs
        INNER JOIN users
        ON audit_logs.user_id = users.id
        ORDER BY audit_logs.created_at DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Audit Logs</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Audit Logs</h2>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        <tr>

            <th>User</th>

            <th>Role</th>

            <th>Action</th>

            <th>Date & Time</th>

        </tr>

        <?php

        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td>
                <?php echo $row['fullname']; ?>
            </td>

            <td>
                <?php echo ucfirst($row['role']); ?>
            </td>

            <td>
                <?php echo $row['action']; ?>
            </td>

            <td>
                <?php echo $row['created_at']; ?>
            </td>

        </tr>

        <?php

            }

        }else{

            echo "
            <tr>
                <td colspan='4'>
                    No audit logs found.
                </td>
            </tr>";
        }

        ?>

    </table>

    <br>

    <?php if($_SESSION['role'] == 'admin'){ ?>

        <a href="admin_dashboard.php">
            Back to Dashboard
        </a>

    <?php } ?>

</div>

</body>

</html>

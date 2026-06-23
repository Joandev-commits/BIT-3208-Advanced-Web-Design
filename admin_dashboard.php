<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'admin'){

    header("Location: login.php");

    exit();
}

$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers");
$total_row = mysqli_fetch_assoc($total_result);
$total_suppliers = $total_row['total'];

$approved_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Approved'");
$approved_row = mysqli_fetch_assoc($approved_result);
$approved_suppliers = $approved_row['total'];

$pending_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Pending Review'");
$pending_row = mysqli_fetch_assoc($pending_result);
$pending_suppliers = $pending_row['total'];

$rejected_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Rejected'");
$rejected_row = mysqli_fetch_assoc($rejected_result);
$rejected_suppliers = $rejected_row['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="dashboard-container">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div>

            <h2 class="logo">
                SupplyFlow
            </h2>

            <ul class="nav-links">

                <li>
                    <a href="admin_dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="register.php">
                        Create User
                    </a>
                </li>

                <li>
                    <a href="view_suppliers.php">
                        View Suppliers
                    </a>
                </li>
                <li>
                  <a href="audit_logs.php">
                        Audit Logs
    </a>
</li>

                <li>
                    <a href="reports.php">
                        Reports
                    </a>
                </li>

            </ul>

        </div>

        <a href="logout.php"
           class="logout-btn">

            Logout

        </a>

    </div>

    <!-- MAIN CONTENT -->

    <div class="main-content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>
                    Admin Dashboard
                </h1>

                <p>
                    Welcome,
                    <?php echo $_SESSION['fullname']; ?>
                </p>

            </div>

        </div>


        <div class="stats-container">

            <div class="stat-card">

                <h3>Total Suppliers</h3>

                <p><?php echo $total_suppliers; ?></p>

            </div>

            <div class="stat-card">

                <h3>Approved</h3>

                <p><?php echo $approved_suppliers; ?></p>

            </div>

            <div class="stat-card">

                <h3>Pending Review</h3>

                <p><?php echo $pending_suppliers; ?></p>

            </div>

            <div class="stat-card">

                <h3>Rejected</h3>

                <p><?php echo $rejected_suppliers; ?></p>

            </div>

        </div>

        <div class="content-section">

            <h2>Quick Actions</h2>

            <div class="action-grid">

                <div class="action-card">

                    <h3>Manage Users</h3>

                    <p>
                        Create admin, manager,
                        and procurement accounts.
                    </p>

                    <a href="register.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

                <div class="action-card">

                    <h3>View Suppliers</h3>

                    <p>
                        Monitor all supplier
                        verification activities.
                    </p>

                    <a href="view_suppliers.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

                <div class="action-card">

                    <h3>Reports</h3>

                    <p>
                        Review supplier status
                        summaries and exports.
                    </p>

                    <a href="reports.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>

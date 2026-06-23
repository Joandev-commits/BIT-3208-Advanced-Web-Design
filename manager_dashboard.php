<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'manager'){

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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manager Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="dashboard-container">

    <div class="sidebar">

        <div>

            <h2 class="logo">
                SupplyFlow
            </h2>

            <ul class="nav-links">

                <li>
                    <a href="manager_dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="view_suppliers.php">
                        View Suppliers
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

    <div class="main-content">

        <div class="topbar">

            <div>

                <h1>
                    Manager Dashboard
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

        </div>

        <div class="content-section">

            <h2>Management Tools</h2>

            <div class="action-grid">

                <div class="action-card">

                    <h3>View Suppliers</h3>

                    <p>
                        Review supplier records
                        and verification status.
                    </p>

                    <a href="view_suppliers.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

                <div class="action-card">

                    <h3>Reports</h3>

                    <p>
                        View supplier status
                        summaries and reports.
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

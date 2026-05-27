<?php

include("session_check.php");

if($_SESSION['role'] != 'admin'){

    header("Location: login.php");

    exit();
}

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
                    <a href="add_supplier.php">
                        Add Supplier
                    </a>
                </li>

                <li>
                    <a href="view_suppliers.php">
                        View Suppliers
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
                    <?php echo $_SESSION['email']; ?>
                </p>

            </div>

        </div>

        <!-- STATISTICS -->

        <div class="stats-container">

            <div class="stat-card">

                <h3>Total Suppliers</h3>

                <p>120</p>

            </div>

            <div class="stat-card">

                <h3>Approved</h3>

                <p>80</p>

            </div>

            <div class="stat-card">

                <h3>Pending</h3>

                <p>25</p>

            </div>

            <div class="stat-card">

                <h3>Rejected</h3>

                <p>15</p>

            </div>

        </div>

        <!-- QUICK ACTIONS -->

        <div class="content-section">

            <h2>Quick Actions</h2>

            <div class="action-grid">

                <div class="action-card">

                    <h3>Add Supplier</h3>

                    <p>
                        Register and manage
                        supplier records.
                    </p>

                    <a href="add_supplier.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

                <div class="action-card">

                    <h3>Manage Users</h3>

                    <p>
                        Create procurement
                        officer accounts.
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

            </div>

        </div>

    </div>

</div>

</body>

</html>
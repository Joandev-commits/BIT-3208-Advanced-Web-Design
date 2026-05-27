<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != 'procurement officer'){
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

    <title>Procurement Dashboard</title>

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
                    <a href="procurement_dashboard.php">
                        Dashboard
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
                    Procurement Dashboard
                </h1>

                <p>
                    Welcome,
                    <?php echo $_SESSION['fullname']; ?>
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

                <h3>Pending Verification</h3>

                <p>25</p>

            </div>

            <div class="stat-card">

                <h3>Approved Suppliers</h3>

                <p>80</p>

            </div>

        </div>

        <!-- PROCUREMENT ACTIONS -->

        <div class="content-section">

            <h2>Supplier Verification</h2>

            <div class="action-grid">

                <div class="action-card">

                    <h3>Add Supplier</h3>

                    <p>
                        Record new supplier
                        information for review.
                    </p>

                    <a href="add_supplier.php"
                       class="action-btn">

                        Open

                    </a>

                </div>

                <div class="action-card">

                    <h3>Verify Suppliers</h3>

                    <p>
                        Approve or reject
                        supplier verification.
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
<?php

include("session_check.php");
include("db_connect.php");

if($_SESSION['role'] != 'admin' &&
   $_SESSION['role'] != 'manager'){

    header("Location: login.php");

    exit();
}

$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers");
$total_row = mysqli_fetch_assoc($total_result);
$total_suppliers = $total_row['total'];

$pending_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Pending Review'");
$pending_row = mysqli_fetch_assoc($pending_result);
$pending_suppliers = $pending_row['total'];

$approved_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Approved'");
$approved_row = mysqli_fetch_assoc($approved_result);
$approved_suppliers = $approved_row['total'];

$rejected_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM suppliers WHERE status='Rejected'");
$rejected_row = mysqli_fetch_assoc($rejected_result);
$rejected_suppliers = $rejected_row['total'];

$suppliers_result = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reports</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .report-actions {
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-bottom:18px;
        }

        .report-btn {
            padding:10px 16px;
            border:none;
            border-radius:6px;
            background:#2563eb;
            color:white;
            cursor:pointer;
            font-weight:bold;
        }

        .report-btn.export {
            background:#2e7d32;
        }

        @media print {
            .no-print { display:none !important; }
            body { background:white; }
            .table-container { padding:0; }
        }
    </style>

</head>

<body>

<div class="table-container">

    <h2>Reports</h2>

    <div class="stats-container">

        <div class="stat-card">
            <h3>Total Suppliers</h3>
            <p><?php echo $total_suppliers; ?></p>
        </div>

        <div class="stat-card">
            <h3>Pending Review</h3>
            <p><?php echo $pending_suppliers; ?></p>
        </div>

        <div class="stat-card">
            <h3>Approved</h3>
            <p><?php echo $approved_suppliers; ?></p>
        </div>

        <div class="stat-card">
            <h3>Rejected</h3>
            <p><?php echo $rejected_suppliers; ?></p>
        </div>

    </div>

    <h2>Status Breakdown</h2>

    <table>
        <tr>
            <th>Status</th>
            <th>Count</th>
        </tr>
        <tr>
            <td>Pending Review</td>
            <td><?php echo $pending_suppliers; ?></td>
        </tr>
        <tr>
            <td>Approved</td>
            <td><?php echo $approved_suppliers; ?></td>
        </tr>
        <tr>
            <td>Rejected</td>
            <td><?php echo $rejected_suppliers; ?></td>
        </tr>
    </table>

    <br>

    <div class="report-actions no-print">
        <button class="report-btn export" onclick="exportReportCSV()">Export CSV</button>
        <button class="report-btn" onclick="window.print()">Print Report</button>
    </div>

    <h2>Supplier Report</h2>

    <table id="reportsTable">
        <tr>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Business Type</th>
            <th>Document</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($suppliers_result)){ ?>

        <tr>
            <td><?php echo $row['supplier_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['business_type']; ?></td>
            <td>
                <?php if(isset($row['supplier_document']) && $row['supplier_document'] != ''){ ?>
                    <?php echo $row['supplier_document']; ?>
                <?php } else { ?>
                    No document
                <?php } ?>
            </td>
            <td><?php echo $row['status']; ?></td>
        </tr>

        <?php } ?>

    </table>

    <br>

    <?php
    if($_SESSION['role'] == 'admin'){
        echo "<a href='admin_dashboard.php' class='no-print'>Back to Dashboard</a>";
    } else {
        echo "<a href='manager_dashboard.php' class='no-print'>Back to Dashboard</a>";
    }
    ?>

</div>

<script>
function exportReportCSV(){
    const table = document.getElementById('reportsTable');
    let csv = [];

    for(let i = 0; i < table.rows.length; i++){
        let row = table.rows[i];
        let cols = [];

        for(let j = 0; j < row.cells.length; j++){
            let text = row.cells[j].innerText.replace(/,/g, ' ');
            cols.push('"' + text + '"');
        }

        csv.push(cols.join(','));
    }

    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = URL.createObjectURL(blob);

    const a = document.createElement('a');
    a.href = url;
    a.download = 'supplier_report.csv';
    a.click();

    URL.revokeObjectURL(url);
}
</script>

</body>

</html>

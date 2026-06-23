<?php

include("session_check.php");
include("db_connect.php");

// Search and filter logic
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$filter_status = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';

$sql = "SELECT * FROM suppliers WHERE 1=1";

if($search != ''){
    $sql .= " AND (supplier_name LIKE '%$search%' OR email LIKE '%$search%' OR business_type LIKE '%$search%')";
}

if($filter_status != ''){
    $sql .= " AND status = '$filter_status'";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>

    <title>View Suppliers</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
            flex-wrap: wrap;
            align-items: center;
        }
        .search-bar input[type="text"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            width: 260px;
        }
        .search-bar select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        .search-bar button {
            padding: 8px 18px;
            background-color: #1F3864;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .search-bar a.clear-btn {
            padding: 8px 14px;
            background-color: #aaa;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }
        .export-btn {
            padding: 8px 18px;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
        }
        .print-btn {
            padding: 8px 18px;
            background-color: #1565C0;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
        .status-approved       { background-color: #e8f5e9; color: #2e7d32; }
        .status-pending-review { background-color: #fff8e1; color: #f57f17; }
        .status-pending        { background-color: #fff8e1; color: #f57f17; }
        .status-rejected       { background-color: #ffebee; color: #c62828; }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .table-container { box-shadow: none; }
        }
    </style>

</head>
<body>

<div class="table-container">

    <h2>Suppliers List</h2>

    <!-- Search and Filter -->
    <form method="GET" action="view_suppliers.php" class="search-bar no-print">

        <input type="text"
               name="search"
               placeholder="Search by name, email, business type..."
               value="<?php echo htmlspecialchars($search); ?>">

        <select name="status">
            <option value="">All Statuses</option>
            <option value="Pending Review" <?php echo $filter_status == 'Pending Review' ? 'selected' : ''; ?>>Pending Review</option>
            <option value="Approved"       <?php echo $filter_status == 'Approved'       ? 'selected' : ''; ?>>Approved</option>
            <option value="Rejected"       <?php echo $filter_status == 'Rejected'       ? 'selected' : ''; ?>>Rejected</option>
        </select>

        <button type="submit">Search</button>

        <a href="view_suppliers.php" class="clear-btn">Clear</a>

    </form>

    <!-- Action Row -->
    <div class="action-row">

        <?php if($_SESSION['role'] == 'procurement officer'){ ?>
            <a href="add_supplier.php" class="add-btn no-print">Add Supplier</a>
        <?php } ?>

        <div class="no-print">
            <button class="export-btn" onclick="exportCSV()">Export CSV</button>
            <button class="print-btn" onclick="window.print()">Print / Export PDF</button>
        </div>

    </div>

    <!-- Suppliers Table -->
    <table id="suppliersTable">

        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Business Type</th>
            <th>Document</th>
            <th>Status</th>
            <th class="no-print">Actions</th>
        </tr>

        <?php
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            $count++;
            $status = $row['status'];
            $badge_class = 'status-' . strtolower(str_replace(' ', '-', $status));
        ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['supplier_name']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['phone']; ?></td>

            <td><?php echo $row['business_type']; ?></td>

            <td>
                <?php if(isset($row['supplier_document']) && $row['supplier_document'] != ''){ ?>
                    <a href="<?php echo $row['supplier_document']; ?>" target="_blank">View</a>
                <?php } else { ?>
                    No document
                <?php } ?>
            </td>

            <td>
                <span class="status-badge <?php echo $badge_class; ?>">
                    <?php echo $status; ?>
                </span>
            </td>

            <td class="no-print">

                <?php if($_SESSION['role'] == 'procurement officer'){ ?>

                    <a href="edit_supplier.php?id=<?php echo $row['id']; ?>">Edit</a>

                <?php } elseif($_SESSION['role'] == 'manager'){ ?>

                    <a href="update_supplier_status.php?id=<?php echo $row['id']; ?>&status=Approved"
                       onclick="return confirm('Approve Supplier?')">Approve</a>

                    |

                    <a href="update_supplier_status.php?id=<?php echo $row['id']; ?>&status=Rejected"
                       onclick="return confirm('Reject Supplier?')">Reject</a>

                <?php } elseif($_SESSION['role'] == 'admin'){ ?>

                    <a href="delete_supplier.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Delete Supplier?')">Delete</a>

                <?php } ?>

            </td>

        </tr>

        <?php } ?>

    </table>

    <?php if($count == 0){ ?>
        <p style="text-align:center; color:#888; margin-top:20px;">No suppliers found.</p>
    <?php } ?>

    <br>

    <?php
    if($_SESSION['role'] == 'admin'){
        echo "<a href='admin_dashboard.php' class='no-print'>Back to Dashboard</a>";
    } elseif($_SESSION['role'] == 'manager'){
        echo "<a href='manager_dashboard.php' class='no-print'>Back to Dashboard</a>";
    } else {
        echo "<a href='procurement_dashboard.php' class='no-print'>Back to Dashboard</a>";
    }
    ?>

</div>

<script>
function exportCSV() {
    const table = document.getElementById('suppliersTable');
    let csv = [];

    for(let i = 0; i < table.rows.length; i++){
        let row = table.rows[i];
        let cols = [];

        for(let j = 0; j < row.cells.length; j++){
            // Skip the Actions column (last column)
            if(row.cells[j].classList.contains('no-print')) continue;
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
    a.download = 'suppliers_list.csv';
    a.click();

    URL.revokeObjectURL(url);
}
</script>

</body>
</html>

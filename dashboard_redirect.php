<?php

session_start();

if($_SESSION['role'] == 'admin'){

    header("Location: admin_dashboard.php");
}
elseif($_SESSION['role'] == 'manager'){

    header("Location: manager_dashboard.php");
}
else{

    header("Location: procurement_dashboard.php");
}

?>

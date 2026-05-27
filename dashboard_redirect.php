<?php

session_start();

if($_SESSION['role'] == 'admin'){

    header("Location: admin_dashboard.php");
}
else{

    header("Location: procurement_dashboard.php");
}

?>
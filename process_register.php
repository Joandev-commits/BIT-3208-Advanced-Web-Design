<?php

include("db_connect.php");

session_start();

$users_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$users_row = mysqli_fetch_assoc($users_result);
$has_users = $users_row['total'] > 0;

if($has_users && (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')){

    header("Location: login.php");

    exit();
}

$fullname = $_POST['fullname'];

$email = $_POST['email'];

$password = $_POST['password'];

$hashed_password =
password_hash($password, PASSWORD_DEFAULT);

$role = $_POST['role'];

$allowed_roles = array(
    'admin',
    'manager',
    'procurement officer'
);

if(!in_array($role, $allowed_roles)){

    echo "Invalid User Role";

    exit();
}

$sql = "INSERT INTO users(
            fullname,
            email,
            password,
            role
        )

        VALUES(
            '$fullname',
            '$email',
            '$hashed_password',
            '$role'
        )";

$result = mysqli_query($conn, $sql);

if($result){

    echo "Registration Successful";

    echo "<br><br>";

    echo "<a href='login.php'>Go to Login</a>";
}
else{

    echo "Registration Failed";
}

?>

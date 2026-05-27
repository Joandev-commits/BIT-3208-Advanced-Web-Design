<?php

include("db_connect.php");

$fullname = $_POST['fullname'];

$email = $_POST['email'];

$password = $_POST['password'];

// HASH PASSWORD

$hashed_password =
password_hash($password, PASSWORD_DEFAULT);

$role = $_POST['role'];

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
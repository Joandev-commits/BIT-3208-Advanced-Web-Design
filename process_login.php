<?php

session_start();

include("db_connect.php");

if(isset($_POST['login'])){

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){

            $_SESSION['user_id'] = $row['id'];

            $_SESSION['fullname'] = $row['fullname'];

            $_SESSION['email'] = $row['email'];

            $_SESSION['role'] = $row['role'];

            if($row['role'] == 'admin'){

                header("Location: admin_dashboard.php");

                exit();

            }
            elseif($row['role'] == 'procurement officer'){

                header("Location: procurement_dashboard.php");

                exit();

            }
            else{

                echo "Invalid User Role";

            }

        }
        else{

            echo "Incorrect Password";

        }

    }
    else{

        echo "Email Not Found";

    }

}
else{

    echo "Form Not Submitted";

}

?>
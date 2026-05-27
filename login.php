<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | SupplyFlow</title>

    <link rel="stylesheet" href="style.css">

    <script src="validate.js" defer></script>

</head>

<body class="auth-body">

<div class="auth-container">

    <div class="auth-card">

        <h1>Welcome Back</h1>

        <p class="auth-text">
            Login to continue to SupplyFlow
        </p>

        <form action="process_login.php"
              method="POST"
              onsubmit="return validateForm()">

            <div class="input-group">

                <label>Email Address</label>

                <input type="email"
                       name="email"
                       id="email"
                       placeholder="Enter email">

                <div class="error" id="emailError"></div>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input type="password"
                       name="password"
                       id="password"
                       placeholder="Enter password"
                       onkeyup="checkPasswordStrength()">

                <div class="strength"
                     id="strengthMessage"></div>

                <div class="error"
                     id="passwordError"></div>

            </div>

            <button type="submit"
                    name="login"
                    class="auth-btn">

                Login

            </button>

        </form>

    </div>

</div>

</body>

</html>
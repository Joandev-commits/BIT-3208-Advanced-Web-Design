<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register | SupplyFlow</title>

    <link rel="stylesheet" href="style.css">

    <script src="validate.js"></script>

</head>

<body class="auth-body">

<div class="auth-container">

    <div class="auth-card">

        <h1>Create Account</h1>

        <p class="auth-text">
            Join SupplyFlow today
        </p>

        <form action="process_register.php"
              method="POST"
              onsubmit="return validateRegisterForm()">

            <div class="input-group">

                <label>Full Name</label>

                <input type="text"
                       name="fullname"
                       id="fullname"
                       placeholder="Enter full name">

                <div class="error"
                     id="fullnameError"></div>

            </div>

            <div class="input-group">

               <label>Email Address</label>

<input type="email"
       name="email"
       id="email"
       placeholder="Enter email">

                <div class="error"
                     id="Email AddressError"></div>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input type="password"
                       name="password"
                       id="password"
                       placeholder="Create password"
                       onkeyup="checkPasswordStrength()">

                <div class="strength"
                     id="strengthMessage"></div>

                <div class="error"
                     id="passwordError"></div>

            </div>

            <div class="input-group">

                <label>Role</label>

                <select name="role" id="role">

                    <option value="">
                        Select Role
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="procurement officer">
                        procurement officer
                    </option>

                </select>

                <div class="error"
                     id="roleError"></div>

            </div>

            <button type="submit"
                    name="register"
                    class="auth-btn">

                Register

            </button>

        </form>

        <p class="bottom-text">

            Already have an account?

            <a href="login.php">
                Login
            </a>

        </p>

    </div>

</div>

</body>

</html>
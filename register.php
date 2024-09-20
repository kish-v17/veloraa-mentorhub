<?php
session_start();
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Registration logic
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validate password and confirm password match
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $role = $_POST["role"];

        // Check if the email is already registered
        $stmt = $dbh->prepare("SELECT * FROM user_tbl WHERE U_Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email is already registered!'); window.history.back();</script>";
            exit;
        } else {
            // Insert new user into the database
            $sql = "INSERT INTO user_tbl (U_Fnm, U_Email, U_Pwd, U_Role) VALUES (:name, :email, :password, :role)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':role', $role);
            if ($stmt->execute()) {
                // Start session and set session variables after successful registration
                $_SESSION['user_id'] = $dbh->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['user_role'] = $role;

                // Redirect to index.php
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
                exit;
            }
        }
    } elseif (isset($_POST['login'])) {
        // Login logic
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user exists
        $stmt = $dbh->prepare("SELECT * FROM user_tbl WHERE U_Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['U_Pwd'])) {
            $_SESSION['user_id'] = $user['U_Id'];
            $_SESSION['user_name'] = $user['U_Fnm'];
            $_SESSION['user_role'] = $user['U_Role']; // Store user role in session

            // Role-based redirection
            switch ($user['U_Role']) {
                case 1:
                    header("Location: admin/index.php");
                    break;
                case 2:
                    header("Location: mentor/index.php");
                    break;
                case 3:
                    header("Location: mentee/index.php");
                    break;
            }
            exit;
        } else {
            echo "<script>alert('Invalid email or password'); window.history.back();</script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elomoas - Online Course and LMS HTML Template</title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Initially hide the login form */
        #login-form {
            display: none;
        }

        /* Default button styles */
        .header-btn {
            background-color: white;
            color: blue;
        }

        /* Blue background for the selected button */
        .header-btn.selected {
            background-color: blue;
            color: white;
        }
    </style>
</head>

<body class="color-theme-blue">
    <div class="main-wrap">
        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
                <a href="index.php"><img src="images/logo.png" style="height:50px" /><span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Veloraa</span>
                </a>
                <button id="show-login"
                    class="header-btn d-none d-lg-block fw-500 text-blue font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">Login</button>
                <button id="show-register"
                    class="header-btn d-none d-lg-block fw-500 text-blue font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl selected">Register</button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
                style="background-image: url(images/login-bg-2.jpg);"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">

                        <!-- Register Form -->
                        <div id="register-form">
                            <form method="post" action="register.php">
                                <h3 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h3>
                                <div class="form-group mb-3 text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <label for="mentor" class="me-3 fs-2">
                                            <input type="radio" class="fs-6 me-2" name="role" value="2" id="mentor">
                                            Mentor
                                        </label>
                                        <label for="mentee" class="ms-3 fs-2">
                                            <input type="radio" class="fs-6 me-2" name="role" value="3" id="mentee">
                                            Mentee
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-user text-grey-500 pe-0"></i>
                                    <input type="text" name="name"
                                        class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="email" name="email"
                                        class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                        placeholder="Your Email Address" required>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <input type="password" name="password"
                                        class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                        placeholder="Password" required>
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-group icon-input mb-1">
                                    <input type="password" name="confirm_password"
                                        class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                        placeholder="Confirm Password" required>
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-check text-left mb-3">
                                    <input type="checkbox" name="terms" class="form-check-input mt-2" required>
                                    <label class="form-check-label font-xsss text-grey-500">Accept Terms and
                                        Conditions</label>
                                </div>
                                <div class="form-group mb-1">
                                    <input type="submit" name="register"
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                        value="Register">
                                </div>
                            </form>
                        </div>

                        <!-- Login Form -->
                        <div id="login-form">
                            <form method="post" action="register.php">
                                <h3 class="fw-700 display1-size display2-md-size mb-4">Log into <br>your account</h3>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="email" name="email"
                                        class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                        placeholder="Your Email Address" required>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <input type="password" name="password"
                                        class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                        placeholder="Password" required>
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-group mb-1">
                                    <input type="submit" name="login"
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0"
                                        value="Login">
                                </div>
                                <h6 class="mb-0 d-inline-block bg-white fw-600 font-xsss text-grey-500 mb-4">Or, Sign in with your social account </h6>
                                <div class="form-group mb-1 form-control text-left style2-input text-white fw-600 bg-facebook border-0 p-0 mb-2"><img src="images/icon-1.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Google</div>
                                <div class="form-group mb-1 form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="images/icon-3.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Facebook</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        document.getElementById('show-register').addEventListener('click', function() {
            document.getElementById('register-form').style.display = 'block';
            document.getElementById('login-form').style.display = 'none';
            this.classList.add('selected');
            document.getElementById('show-login').classList.remove('selected');
        });

        document.getElementById('show-login').addEventListener('click', function() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
            this.classList.add('selected');
            document.getElementById('show-register').classList.remove('selected');
        });
    </script>
</body>

</html>

<?php
// register.php
session_start();
require 'database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!')</script>";
        exit;
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Default role to 3 (assuming this represents "mentee")
    $role = 3;

    // Check if the email is already registered
    $stmt = $dbh->prepare("SELECT * FROM user_tbl WHERE U_Email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email is already registered!')</script>";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO user_tbl (U_Fnm, U_Email, U_Pwd, U_Role)
                VALUES (:name, :email, :password, :role)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            header("Location: mentee/index.php");
        } else {
            echo "<script>alert('Registration failed. Please try again.')</script>";
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



</head>

<body class="color-theme-blue">

    <div class="preloader"></div>

    <div class="main-wrap">

        <div class="nav-header bg-transparent shadow-none border-0">
            <div class="nav-top w-100">
                <a href="index.php"><i class="feather-zap text-success display1-size me-2 ms-0"></i><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Veloraa. </span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.php" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="#" class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl"  data-bs-toggle="modal" data-bs-target="#Modallogin">Login</a>
                <a href="#" class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl"  data-bs-toggle="modal" data-bs-target="#Modalregister">Register</a>

            </div>
            
            
        </div>

        <div class="row">
            <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat" style="background-image: url(images/login-bg-2.jpg);"></div>
            <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
                <div class="card shadow-none border-0 ms-auto me-auto login-card">
                    <div class="card-body rounded-0 text-left">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>                        
                            <form method="post" action="register.php">
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-user text-grey-500 pe-0"></i>
                                    <input type="text" name="name" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Name" required>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="email" name="email" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address" required>
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <input type="password" name="password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password" required>
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-group icon-input mb-1">
                                    <input type="password" name="confirm_password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Confirm Password" required>
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-check text-left mb-3">
                                    <input type="checkbox" name="terms" class="form-check-input mt-2" id="exampleCheck2" required>
                                    <label class="form-check-label font-xsss text-grey-500" for="exampleCheck2">Accept Terms and Conditions</label>
                                </div>
                           
                        <div class="col-sm-12 p-0 text-left">
                            <div class="form-group mb-1"><input type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 " value="Register"></div>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a href="login.php" class="fw-700 ms-1">Login</a></h6>
                        </div>
                        </form>
                         
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <!-- Modal Login -->
    <div class="modal bottom fade" style="overflow-y: scroll;" id="Modallogin" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                <div class="modal-body p-3 d-flex align-items-center bg-none">
                    <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                        <div class="card-body rounded-0 text-left p-3">
                            <h2 class="fw-700 display1-size display2-md-size mb-4">Login into <br>your account</h2>
                            <form>
                                
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">                        
                                </div>
                                <div class="form-group icon-input mb-1">
                                    <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-check text-left mb-3">
                                    <input type="checkbox" class="form-check-input mt-2" id="exampleCheck4">
                                    <label class="form-check-label font-xsss text-grey-500" for="exampleCheck4">Remember me</label>
                                    <a href="forgot.php" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a>
                                </div>
                            </form>
                             
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-1"><a href="#" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Login</a></div>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a href="register.php" class="fw-700 ms-1">Register</a></h6>
                            </div>
                            <div class="col-sm-12 p-0 text-center mt-3 ">
                                
                                <h6 class="mb-0 d-inline-block bg-white fw-600 font-xsss text-grey-500 mb-4">Or, Sign in with your social account </h6>
                                <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-facebook border-0 p-0 mb-2"><img src="images/icon-1.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Google</a></div>
                                <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="images/icon-3.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Facebook</a></div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Register -->
    <div class="modal bottom fade" style="overflow-y: scroll;" id="Modalregister" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                <div class="modal-body p-3 d-flex align-items-center bg-none">
                    <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                        <div class="card-body rounded-0 text-left p-3">
                            <h2 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>                        
                            <form>
                                
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-user text-grey-500 pe-0"></i>
                                    <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Name">                        
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                    <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Your Email Address">                        
                                </div>
                                <div class="form-group icon-input mb-3">
                                    <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-group icon-input mb-1">
                                    <input type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Confirm Password">
                                    <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                                </div>
                                <div class="form-check text-left mb-3">
                                    <input type="checkbox" class="form-check-input mt-2" id="exampleCheck7">
                                    <label class="form-check-label font-xsss text-grey-500" for="exampleCheck7">Accept Term and Conditions</label>
                                    <!-- <a href="#" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a> -->
                                </div>
                            </form>
                             
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-1"><a href="#" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Register</a></div>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a href="login.php" class="fw-700 ms-1">Login</a></h6>
                            </div>
                            <div class="col-sm-12 p-0 text-center mt-3 ">
                                
                                <h6 class="mb-0 d-inline-block bg-white fw-600 font-xsss text-grey-500 mb-4">Or, Sign in with your social account </h6>
                                <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-facebook border-0 p-0 "><img src="images/icon-1.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Google</a></div>
                                <div class="form-group mb-1"><a href="#" class="form-control text-left style2-input text-white fw-600 bg-twiiter border-0 p-0 "><img src="images/icon-3.png" alt="icon" class="ms-2 w40 mb-1 me-5"> Sign in with Facebook</a></div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <script src="js/plugin.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
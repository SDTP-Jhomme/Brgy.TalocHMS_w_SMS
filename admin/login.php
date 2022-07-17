<?php

include("../database.php");

date_default_timezone_set("Asia/Manila");
$date_now = date("m/d/Y");
$time_now = date("h:i A");
$date_time = $date_now." ".$time_now;
$end_time = date("h:i A", strtotime("+5 minutes", strtotime($time_now)));

$notify = $attempt = $log_time = $error_attempt = $error_log_time = "";
$username = $password = "";
$usernameErr = $passwordErr = "";

if (isset($_SESSION["id"])) {

    header("Location: ./");
    die();

}

if (isset($_POST["login"])) {

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required!";
    } else {
        $username = $_POST["username"];
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($username && $password) {

        $check_admin = mysqli_query($db, "SELECT * FROM admin WHERE username='$username'");
    
        $check_admin_row = mysqli_num_rows($check_admin);
    
        if ($check_admin_row) {
    
            $admin_row = mysqli_fetch_assoc($check_admin);

            $db_id = $admin_row["id"];
            $db_password = $admin_row["password"];
            $db_attempt = $admin_row["attempt"];
            $db_log_time = $admin_row["log_time"];

            $new_log_time = strtotime($db_log_time);

            if ($db_log_time <= $time_now) {

                if (password_verify($password, $db_password)) {

                    session_start();
    
                    $_SESSION["id"] = $db_id;

                    mysqli_query($db, "UPDATE admin SET last_login='$date_time', attempt=0 WHERE id='$db_id'");
    
                    header("Location: ./");
                    die();
    
                } else {

                    $passwordErr = "Password is incorrect!";
    
                    $attempt = $db_attempt + 1;
                    
                    if ($attempt == 5) {
    
                        $error_attempt = 1;
                        mysqli_query($db, "UPDATE admin SET attempt=0, log_time='$end_time' WHERE id='$db_id'");
    
                    } else {
                        mysqli_query($db, "UPDATE admin SET attempt='$attempt' WHERE id='$db_id'");
                    }
                }

            } else {

                $error_log_time = 1;

            }
    
        } else {
            $usernameErr = "Admin ".$username." is not registered!";
        }
    
    }

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Health Management | Login</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <!--  -->

    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center admin-section">
            <div class="admin-login">
                <!-- Section: Design Block -->
                <section class="text-center text-lg-start">
                    <div class="card">
                        <div class="row g-0 d-flex align-items-center">
                            <div class="col-lg-4 d-none d-lg-flex">
                                <img src="../images/admin-login.jpg" alt="Barangay Taloc Health Center Logo"
                                class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                            </div>
                            <div class="col-lg-8">
                                <div class="card-body py-5 px-md-5">

                                    <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

                                        <!-- Label -->
                                        <div class="mb-4">
                                            <p class="fs-4 text-center">Admin Login</p>
                                        </div>
                                        <!-- Login error notif -->
                                        <div class="alert alert-danger d-flex align-items-center" 
                                            <?php if ($error_attempt) {echo "style='display: block'"; } else {echo "style='display: none!important'"; } ?>
                                        role="alert">
                                            <div>
                                                You already reach the maximum attempt. Please try again after <?php echo $end_time; ?>.
                                            </div>
                                        </div>
                                        <!-- Login logtime error -->
                                        <div class="alert alert-danger d-flex align-items-center" 
                                            <?php if ($error_log_time) {echo "style='display: block'"; } else {echo "style='display: none!important'"; } ?>
                                        role="alert">
                                            <div>
                                                Sorry. You still have to wait <?php echo $db_log_time; ?> before login.
                                            </div>
                                        </div>
                                        <!-- Admin input -->
                                        <label class="form-label" for="form2Example1">Username</label>
                                        <div class="form-outline mb-3">
                                            <input type="text" id="form2Example1" class="form-control" name="username" value="<?php echo $username; ?>"/>
                                            <span class="text-danger"><?php echo $usernameErr; ?></span>
                                        </div>

                                        <!-- Password input -->
                                        <label class="form-label" for="form2Example2">Password</label>
                                        <div class="form-outline input-group">
                                            <input type="password" id="form2Example2" class="form-control" name="password" value="<?php echo $password; ?>"/>
                                            <span class="input-group-text">
                                                <i class="far fa-eye custom" id="togglePassword" 
                                                style="cursor: pointer"></i>
                                            </span>
                                        </div>
                                        <span class="text-danger"><?php echo $passwordErr; ?></span>

                                        <!-- Submit button -->
                                        <div class="form-outline mb-4">
                                            <input id="submitBtn" name="login" type="submit" class="btn btn-primary btn-block mt-4" value="Login"/>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Section: Design Block --> 
            </div>
        </div>
    </body>
    <script>
        // Enter Key Function
        var input = document.getElementById("form2Example2");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("submitBtn").click();
        }
        });
        // Password Toggle
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#form2Example2");

        togglePassword.addEventListener("click", function () {
        
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        });
    </script>
</html>
<?php

include("../database.php");

if (isset($_SESSION["id"])) {

    $id = $_SESSION["id"];

    $admin_record = mysqli_query($db, "SELECT * FROM admin where id='$id'");

    while($admin_row = mysqli_fetch_assoc($admin_record)) {

        $db_username = $admin_row["username"];
        $logged_admin = ucfirst($db_username);

    }

} else {

    header("Location: ./login");
    die();

}

$identification =  $first_name = $last_name = $birthdate = $gender = $password = "";
$errors = array();

if (isset($_POST["register"])) {

    if (empty($_POST["identification"])) {
        $errors["identification"] = "Identification number is required!";
    } else {
        $identification = $_POST["identification"];
    }

    if (empty($_POST["first_name"])) {
        $errors["first_name"] = "First Name is required!";
    } else {
        $first_name = $_POST["first_name"];
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $errors["first_name"] = "Invalid first name format!";
        } else {
            $count_first_name = strlen($first_name);
            if ($count_first_name <= 1) {
                $errors["first_name"] = "First name should contain atleast two(2) characters!";
            }
        }
    }

    if (empty($_POST["last_name"])) {
        $errors["last_name"] = "Last Name is required!";
    } else {
        $last_name = $_POST["last_name"];
        if (!preg_match("/^[a-zA-Z- ]*$/", $last_name)) {
            $errors["last_name"] = "Invalid last name format!";
        } else {
            $count_last_name = strlen($last_name);
            if ($count_last_name <= 1) {
                $errors["last_name"] = "Last name should contain atleast two(2) characters!";
            }
        }
    }

    if (empty($_POST["birthdate"])) {
        $errors["birthdate"] = "Birthday is required!";
    } else {
        $birthdate = $_POST["birthdate"];
        $currentDate = date("Y-m-d");
        $current_age = date_diff(date_create($currentDate), date_create($birthdate));
        $age = $current_age->format('%y');

        if ($age < 18) {
            $errors["birthdate"] = "Age must be 18 and above!";
        }
    }

    if (empty($_POST["gender"])) {
        $errors["gender"] = "Gender is required!";
    } else {
        $gender = $_POST["gender"];
    }

    if (!$errors) {

        function random_password ( $length = 5) {
            $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $shuffled = substr( str_shuffle($str), 0, $length );
            return $shuffled;
        }

        $password = random_password(8);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $showModal = true;

        $username = "BHW-".$first_name;

        mysqli_query($db, "INSERT INTO users(first_name,last_name,birthday,gender,username,password,bhw_id)
        VALUES('$first_name','$last_name','$birthdate','$gender','$username','$hashed_password','$identification')");

    }

    if (isset($_POST["closeBtn"])) {
        $showModal = false;
    }

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin | Add BHW</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="./">Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="./logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="./">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Table</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                BHWs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./bhw">Informations</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Patients
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./prenatal-patient">Prenatal</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./immunization-patient">Immunization</a>
                                </nav>
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="./checkup-patient">Individual Checkup</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $logged_admin ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <section class="gradient-custom">
                        <div class="container py-5 h-100">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-12 col-lg-9 col-xl-7">
                                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                        <div class="card-body p-4 p-md-5">
                                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">BHW Registration</h3>

                                            <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" >
                                                <div class="row">
                                                    <div class="mb-4">
                                                        <label class="form-label">BHW Identification Number</label>
                                                        <div class="form-outline input-group">
                                                            <input type="text" class="form-control form-control-lg" name="identification" value="<?php echo $identification; ?>" />
                                                            <span class="text-danger ps-2">*</span>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($errors['identification'])) echo $errors['identification'] ?></span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label" for="firstName">First Name</label>
                                                        <div class="form-outline input-group">
                                                            <input type="text" id="firstName" class="form-control form-control-lg" name="first_name" value="<?php echo $first_name; ?>" />
                                                            <span class="text-danger ps-2">*</span>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($errors['first_name'])) echo $errors['first_name'] ?></span>
                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label" for="lastName">Last Name</label>
                                                        <div class="form-outline input-group">
                                                            <input type="text" id="lastName" class="form-control form-control-lg" name="last_name" value="<?php echo $last_name; ?>" />
                                                            <span class="text-danger ps-2">*</span>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($errors['last_name'])) echo $errors['last_name'] ?></span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="birthdayDate" class="form-label">Birthday</label>
                                                        <div class="form-outline datepicker w-100 input-group">
                                                            <input type="date" class="form-control form-control-lg" id="birthdayDate" name="birthdate" value="<?php echo $birthdate; ?>" min="1960-01-01" />
                                                            <span class="text-danger ps-2">*</span>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($errors['birthdate'])) echo $errors['birthdate'] ?></span>
                                                    </div>

                                                    <div class="col-md-6 mb-4">
                                                        <div class="input-group justify-content-between">
                                                            <h6 class="mb-2 pb-1">Gender: </h6>
                                                            <span class="text-danger ps-2">*</span>
                                                        </div>

                                                        <div class="form-check form-check-inline mb-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                                            value="Female" <?php if ($gender == 'Female') { echo 'checked'; } ?> />
                                                            <label class="form-check-label" for="femaleGender">Female</label>
                                                        </div>

                                                        <div class="form-check form-check-inline mb-4">
                                                            <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                                            value="Male" <?php if ($gender == 'Male') { echo 'checked'; } ?> />
                                                            <label class="form-check-label" for="maleGender">Male</label>
                                                        </div>
                                                        <div class>
                                                            <span class="text-danger"><?php if(isset($errors['gender'])) echo $errors['gender'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 pt-2">
                                                    <input id="submitBtn" name="register" class="btn btn-primary btn-lg" type="submit" value="Submit" />
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Barangay Taloc Online Health Record Management System 2022</div>
                         </div>
                    </div>
                </footer>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="passModal" role="dialog" <?php if ($showModal) {echo "style='display: block!important; opacity: 1!important; transition: opacity 0.15s linear; background-color: rgb(0 0 0 / 45%)'"; } else {echo "style='display: none!important'"; }; ?>>
                <div class="modal-dialog">
                    <div class="modal-content" style="top: 100px">
                        <form method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">BHW Credentials</h5>
                                <input type="submit" name="closeBtn" class="btn-close" value=""/>
                            </div>
                            <div class="modal-body">
                                <label class="">Username</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo $username; ?>" disabled>
                                </div>
                                <label class="">Password</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="<?php echo $password; ?>" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="closeBtn" class="btn btn-primary" value="Close" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script>
            // Enter Key Function
            var input = document.getElementById("lastName");
            input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("submitBtn").click();
            }
            });
            // Close Modal

        </script>
    </body>
</html>
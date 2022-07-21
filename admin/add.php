<?php

if (isset($_POST["register"])) {

    if (empty($_POST["identification"])) {
        $errors["identification"] = "Identification number is required!";
    } else {
        $identification = $_POST["identification"];
        $check_identification = mysqli_query($db, "SELECT * FROM users WHERE bhw_id='$identification'");
        if (mysqli_num_rows($check_identification) > 0) {
            $errors["identification"] = "Identification number is already taken!";
        }
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

        if ($age <= 18) {
            $errors["birthdate"] = "Age must be 18 and above!";
        }
    }

    if (empty($_POST["gender"])) {
        $errors["gender"] = "Gender is required!";
    } else {
        $gender = $_POST["gender"];
    }

    if (!$errors) {

        function random_password($length = 5)
        {
            $str = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $shuffled = substr(str_shuffle($str), 0, $length);
            return $shuffled;
        }

        $password = random_password(8);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $username = "BHW-" . $first_name;

        mysqli_query($db, "INSERT INTO users(first_name,last_name,birthday,gender,username,password,bhw_id)
        VALUES('$first_name','$last_name','$birthdate','$gender','$username','$hashed_password','$identification')");

        echo    "<script>
                    $(document).ready(function(){
                        $('#passModal').modal('show');
                    });
                </script>";

    }
}

?>



<section class="gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">BHW Registration</h3>

                        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                            <div class="row">
                                <div class="mb-4">
                                    <label class="form-label">BHW Identification Number</label>
                                    <div class="form-outline input-group">
                                        <input type="text" class="form-control form-control-lg" name="identification" value="<?php echo $identification; ?>" <?php if (isset($errors['identification'])) echo "style='border-color:#dc3545;'" ?> />
                                        <span class="text-danger ps-2">*</span>
                                    </div>
                                    <span class="text-danger"><?php if (isset($errors['identification'])) echo $errors['identification'] ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" for="firstName">First Name</label>
                                    <div class="form-outline input-group">
                                        <input type="text" id="firstName" class="form-control form-control-lg" name="first_name" value="<?php echo $first_name; ?>" <?php if (isset($errors['first_name'])) echo "style='border-color:#dc3545;'" ?> />
                                        <span class="text-danger ps-2">*</span>
                                    </div>
                                    <span class="text-danger"><?php if (isset($errors['first_name'])) echo $errors['first_name'] ?></span>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label" for="lastName">Last Name</label>
                                    <div class="form-outline input-group">
                                        <input type="text" id="lastName" class="form-control form-control-lg" name="last_name" value="<?php echo $last_name; ?>" <?php if (isset($errors['last_name'])) echo "style='border-color:#dc3545;'" ?> />
                                        <span class="text-danger ps-2">*</span>
                                    </div>
                                    <span class="text-danger"><?php if (isset($errors['last_name'])) echo $errors['last_name'] ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="birthdayDate" class="form-label">Birthday</label>
                                    <div class="form-outline datepicker w-100 input-group">
                                        <input type="date" class="form-control form-control-lg" id="birthdayDate" name="birthdate" value="<?php echo $birthdate; ?>" min="1960-01-01" <?php if (isset($errors['birthdate'])) echo "style='border-color:#dc3545;'" ?> />
                                        <span class="text-danger ps-2">*</span>
                                    </div>
                                    <span class="text-danger"><?php if (isset($errors['birthdate'])) echo $errors['birthdate'] ?></span>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="input-group justify-content-between">
                                        <h6 class="mb-2 pb-1">Gender: </h6>
                                        <span class="text-danger ps-2">*</span>
                                    </div>

                                    <div class="form-check form-check-inline mb-4">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" <?php if ($gender == 'Female') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } if (isset($errors['gender'])) echo "style='border-color:#dc3545;'" ?> />
                                        <label class="form-check-label" for="femaleGender">Female</label>
                                    </div>

                                    <div class="form-check form-check-inline mb-4">
                                        <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" <?php if ($gender == 'Male') {
                                                                                                                                    echo 'checked';
                                                                                                                                } if (isset($errors['gender'])) echo "style='border-color:#dc3545;'" ?> />
                                        <label class="form-check-label" for="maleGender">Male</label>
                                    </div>
                                    <div class>
                                        <span class="text-danger"><?php if (isset($errors['gender'])) echo $errors['gender'] ?></span>
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

<!-- Modal -->
<div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BHW Credentials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Enter Key Function
    var input = document.getElementById("lastName");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("submitBtn").click();
        }
    });
</script>
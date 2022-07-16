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
                                <img src="../images/admin-login.jpg" alt="Trendy Pants and Shoes"
                                class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                            </div>
                            <div class="col-lg-8">
                                <div class="card-body py-5 px-md-5">

                                    <form>

                                        <!-- Label -->
                                        <div class="mb-4">
                                            <p class="fs-4 text-center">Admin Login</p>
                                        </div>
                                        <!-- Admin input -->
                                        <label class="form-label" for="form2Example1">Username</label>
                                        <div class="form-outline mb-3">
                                            <input type="email" id="form2Example1" class="form-control" />
                                        </div>

                                        <!-- Password input -->
                                        <label class="form-label" for="form2Example2">Password</label>
                                        <div class="form-outline mb-4 input-group">
                                            <input type="password" id="form2Example2" class="form-control" />
                                            <span class="input-group-text">
                                                <i class="far fa-eye custom" id="togglePassword" 
                                                style="cursor: pointer"></i>
                                            </span>
                                        </div>

                                        <!-- Submit button -->
                                        <button id="submitBtn" type="button" class="btn btn-primary btn-block mb-4">Login</button>

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
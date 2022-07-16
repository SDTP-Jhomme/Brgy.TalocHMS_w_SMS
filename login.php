<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Health Management | Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <!--  -->

    </head>
    <body>
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="./images/Logo.png"
                                                style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">BHW Login</h4>
                                        </div>

                                        <form>

                                            <label class="form-label" for="form2Example11">Username</label>
                                            
                                            <div class="form-outline mb-4">
                                                <input type="email" id="form2Example11" class="form-control"
                                                placeholder="Please input username" />
                                            </div>

                                            <label class="form-label" for="form2Example22">Password</label>

                                            <div class="form-outline mb-4 input-group">
                                                <input type="password" id="form2Example22" class="form-control" 
                                                placeholder="Please input password" />
                                                <span class="input-group-text">
                                                    <i class="far fa-eye custom" id="togglePassword" 
                                                style="cursor: pointer"></i>
                                                </span>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button id="submitBtn" class="btn btn-primary btn-block gradient-custom-2 mb-3" type="button">Login</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style="background: linear-gradient(135deg, rgb(81 191 35) 17%, rgba(23,153,15,1) 38%, rgba(18,194,9,1) 65%, rgba(10,255,0,1) 92%);">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">Barangay Taloc Online Health Record Management System</h4>
                                        <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script>
        // Enter Key Function
        var input = document.getElementById("form2Example22");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("submitBtn").click();
        }
        });

        // Password Toggle
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#form2Example22");

        togglePassword.addEventListener("click", function () {
        
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        });
    </script>
</html>
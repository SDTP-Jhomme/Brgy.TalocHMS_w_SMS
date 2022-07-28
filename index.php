<!DOCTYPE html>
<html lang="en">

<head>
    <title>Health Management | Login</title>
    <?php include("./database/database.php"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- import External CSS -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- import Element CSS -->
    <link rel="stylesheet" href="./assets/css/element.css">
    <!-- import Bootstrap.css  -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="./assets/img/logo-new.png" style="width: 185px;" alt="logo">
                                            <h4 class="mt-2 mb-4 pb-1">BHW Login</h4>
                                        </div>

                                        <label class="form-label" for="username">Username</label>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="username" class="form-control" v-model="username" />
                                        </div>

                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-outline mb-4 input-group">
                                            <input :type="type" id="password" class="form-control" v-model="password" />
                                            <button class="input-group-text" @click="showPassword" v-if="type == 'password'">
                                                <span>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </button>
                                            <button class="input-group-text" @click="hidePassword" v-if="type == 'text'">
                                                <span>
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </button>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1 d-grid gap-2">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Login</button>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">We are more than just a company</h4>
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
    </div>
    <!-- import External.js -->
    <script src="./assets/js/scripts.js"></script>
    <!-- import Vue.js -->
    <script src="./assets/js/vue.js"></script>
    <!-- import Element.js -->
    <script src="./assets/js/element.js"></script>
    <!-- import Bootstrap.js -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- import Axios.js -->
    <script src="./assets/js/axios.js"></script>
    <!-- import Font Awesome -->
    <script defer src="./assets/js/fontawesome.js"></script>
    <script>
        new Vue({
            el: "#app",
            data() {
                return {
                    type: "password",
                    username: "",
                    password: ""
                }
            },
            methods: {
                showPassword() {
                    this.type = "text"
                },
                hidePassword() {
                    this.type = "password"
                }
            }
        })
    </script>
</body>

</html>
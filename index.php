<!DOCTYPE html>
<html lang="en">

<head>
    <title>Health Management | Login</title>
    <?php
    include("./database/database.php");

    session_start();
    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id='$id'");
        $user_row = mysqli_fetch_assoc($user_record);
        $db_last_login = $user_row["last_login"];

        if ($db_last_login) {

            header("Location: ./bhw");
            die();
        } else {

            header("Location: ./bhw/change-password");
            die();
        }
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- import External CSS -->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- import Element CSS -->
    <link rel="stylesheet" href="./assets/css/element.css">
    <!-- import Bootstrap.css  -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- import Favicon -->
    <link href="./assets/img/favicon.png" rel="icon">
    <style>
        .has-error {
            border: 1px solid #dc3545;
            background-image: url(../assets/img/error.svg);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
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
                                        <div class="form-outline">
                                            <input v-on:keyup.enter="login" type="text" id="username" class="form-control" :class="{'has-error': this.userErr}" v-model="username" />
                                        </div>
                                        <div class="">
                                            <span class="text-danger">{{this.userErr}}</span>
                                        </div>

                                        <label class="form-label mt-4" for="password">Password</label>
                                        <div class="form-outline input-group">
                                            <input v-on:keyup.enter="login" :type="type" id="password" class="form-control" :class="{'has-error': this.passErr}" v-model="password" />
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
                                        <div class="mb-5">
                                            <span class="text-danger">{{this.passErr}}</span>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1 d-grid gap-2">
                                            <button @click="login" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Login</button>
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
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?> </div>
                    <div><a href="./about">About</a> | All Rigths Reserved</div>
                </div>
            </div>
        </footer>
    </div>
    <!-- import External.js -->
    <script src="./assets/js/scripts.js"></script>
    <!-- import Vue.js -->
    <script src="./assets/js/vue.js"></script>
    <!-- import Element.js -->
    <script src="./assets/js/element.js"></script>
    <!-- import Element-English.js -->
    <script src="./assets/js/element-en.js"></script>
    <!-- import Bootstrap.js -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- import Axios.js -->
    <script src="./assets/js/axios.min.js"></script>
    <!-- import Font Awesome -->
    <script defer src="./assets/js/fontawesome.js"></script>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    type: "password",
                    username: "",
                    password: "",
                    userErr: "",
                    passErr: "",
                }
            },
            methods: {
                showPassword() {
                    this.type = "text"
                },
                hidePassword() {
                    this.type = "password"
                },
                login() {
                    this.userErr = ""
                    this.passErr = ""
                    var data = new FormData()
                    data.append("username", this.username)
                    data.append("password", this.password)
                    axios.post("auth.php?action=login", data)
                        .then(response => {
                            localStorage.clear()
                            if (response.data.error) {
                                this.userErr = response.data.userErr
                                this.passErr = response.data.passErr
                            } else if (response.data === "") {
                                window.location.href = "./bhw/change-password"
                            } else {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged in!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "./bhw"
                                }, 1000)
                            }
                        })
                }
            }
        })
    </script>
</body>

</html>
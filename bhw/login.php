<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Login</title>
    <?php
    include("./import/head.php");

    if (isset($_SESSION["bhw_id"])) {

        $id = $_SESSION["bhw_id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id='$id'");
        $user_row = mysqli_fetch_assoc($user_record);
        $db_last_login = $user_row["last_login"];

        if ($db_last_login) {

            header("Location: ../bhw");
            die();
        } else {

            header("Location: ../bhw/change-password");
            die();
        }
    }
    ?>
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
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-10">
                        <div class="card shadow rounded">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5">
                                        <h3 class="mb-5 text-center">BHW Login</h3>

                                        <label class="form-label" for="username">Username</label>
                                        <div class="form-outline input-group">
                                            <input v-on:keyup.enter="login" type="text" id="username" class="form-control" :class="{'has-error': this.bhwErr}" v-model="username" />
                                        </div>
                                        <div class="mb-4">
                                            <span class="text-danger">{{this.bhwErr}}</span>
                                        </div>

                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-outline input-group">
                                            <input v-on:keyup.enter="login" :type="type" id="password" class="form-control" :class="{'has-error': this.passErr}" v-model="password" />
                                            <button class="input-group-text" @click="showPassword" v-if="type == 'password'">
                                                <span>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </button>
                                            <button class="input-group-text" @click="hidePassword" v-else>
                                                <span>
                                                    <i class="fa fa-eye-slash"></i>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="mb-5">
                                            <span class="text-danger">{{this.passErr}}</span>
                                        </div>

                                        <div class="text-center pt-1 mb-2 pb-1 d-grid gap-2">
                                            <button @click="login" class="btn btn-primary btn-block" type="submit">Login</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-flex align-items-center">
                                    <img src="../assets/img/health-center1.jpg" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("./import/body.php"); ?>
    <script>
        new Vue({
            el: "#app",
            data() {
                return {
                    type: "password",
                    error: "",
                    bhwErr: "",
                    passErr: "",
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
                },
                login() {
                    this.bhwErr = ""
                    this.passErr = ""
                    var data = new FormData()
                    data.append("username", this.username)
                    data.append("password", this.password)
                    axios.post("auth.php?action=login", data)
                        .then(response => {
                            if (response.data.error) {
                                this.bhwErr = response.data.bhwErr
                                this.passErr = response.data.passErr
                            } else if (response.data === "") {
                                window.location.href = "../bhw/change-password"
                            } else {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged in!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "../bhw"
                                }, 1000)
                            }
                        })
                }
            }
        })
    </script>
</body>

</html>
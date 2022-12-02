<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Login</title>
    <?php
    include("./import/head.php");
    include("../database/database.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

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
        .has-error input,
        .has-error input:focus {
            border: 1px solid #dc3545;
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
                <div class="d-flex shadow rounded p-5 w-80 m-auto text-align-center slide-down">
                    <div class="w-40 image-clip">
                        <h3 class="mb-5 text-center">BHW Login</h3>
                        <img src="../assets/logo/healthworker.png" alt="">
                    </div>
                    <div class="w-60 pl-5 pt-5">

                        <label class="form-label" for="username">Username</label>
                        <div class="form-outline input-group">
                            <el-input @keyup.enter.native="login" v-model="username" clearable :class="{'has-error': this.userErr}">
                            </el-input>
                        </div>
                        <div class="mb-4">
                            <span class="text-danger">{{this.userErr}}</span>
                        </div>

                        <label class="form-label" for="password">Password</label>
                        <div class="form-outline input-group">
                            <el-input @keyup.enter.native="login" v-model="password" clearable show-password :class="{'has-error': this.passErr}">
                            </el-input>
                        </div>
                        <div class="mb-5">
                            <span class="text-danger">{{this.passErr}}</span>
                        </div>

                        <div class="text-center pt-1 mb-2 pb-1 d-grid gap-2">
                            <button @click="login" class="btn btn-primary btn-block" type="submit">Login</button>
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
                    error: "",
                    userErr: "",
                    passErr: "",
                    username: "",
                    password: ""
                }
            },
            methods: {
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
                                window.location.href = "./change-password"
                            } else {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged in!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "./"
                                }, 1000)
                            }
                        })
                }
            }
        })
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Login</title>
    <?php
        include("../import/head.php");

        if (isset($_SESSION["id"])) {

            header("Location: ./");
            die();
        }
    ?>
</head>

<body>
    <div id="app">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow rounded">
                            <div class="card-body p-5">

                                <h3 class="mb-5 text-center">Admin Login</h3>

                                <label class="form-label" for="username">Username</label>
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" class="form-control" v-model="username" />
                                </div>

                                <label class="form-label" for="password">Password</label>
                                <div class="form-outline mb-5 input-group">
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

                                <div class="text-center pt-1 mb-2 pb-1 d-grid gap-2">
                                    <button @click="login" class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("../import/body.php"); ?>
    <script>
        new Vue({
            el: "#app",
            data() {
                return {
                    type: "password",
                    error: "",
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
                    var data = new FormData()
                    data.append("username", this.username)
                    data.append("password", this.password)
                    axios.post("action.php?action=login", data)
                        .then(response => {
                            if (response.data.error) {
                                this.error = response.data.message
                                this.$message.error(this.error)
                            } else {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged in!',
                                    type: 'success'
                                });
                                setTimeout( function () {
                                    window.location.href="index"
                                }, 1000)
                            }
                        })
                }
            }
        })
    </script>
</body>

</html>
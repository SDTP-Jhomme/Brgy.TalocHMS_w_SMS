<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Change Password</title>
    <?php
    include("./import/head.php");

    $id = $_SESSION["id"];

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id=$id");
        $user_row = mysqli_fetch_assoc($user_record);
        $db_username = $user_row["username"];
    } else {

        header("Location: ../");
        die();
    }
    ?>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Fill in Your New Password</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" type="text" disabled value="<?php echo $db_username; ?>" />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Password" v-model="newPassword" />
                                            <label for="inputPassword">Enter New Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="confirmPassword" type="password" placeholder="Password" v-model="confirmPassword" />
                                            <label for="confirmPassword">Confirm Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button @click="submit" class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php include("./import/footer.php"); ?>
        </div>
    </div>
    <?php include("./import/body.php"); ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#layoutAuthentication",
            data() {
                return {
                    type: "password",
                    newPassword: "",
                    confirmPassword: "",
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
                submit() {
                    this.userErr = ""
                    this.passErr = ""
                    var data = new FormData()
                    data.append("username", this.username)
                    data.append("password", this.password)
                    axios.post("auth.php?action=login", data)
                        .then(response => {
                            console.log(response.data)
                            if (response.data.error) {
                                this.userErr = response.data.userErr
                                this.passErr = response.data.passErr
                            } else if (response.data === "") {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged in!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "./bhw/change-password"
                                }, 1000)
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
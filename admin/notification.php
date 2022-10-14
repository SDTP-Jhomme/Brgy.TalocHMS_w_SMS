<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];

        $admin_record = mysqli_query($db, "SELECT * FROM admin where id='$id'");

        while ($admin_row = mysqli_fetch_assoc($admin_record)) {

            $db_username = $admin_row["username"];
            $logged_admin = ucfirst($db_username);
        }
    } else {

        header("Location: ./login");
        die();
    } ?>
</head>

<body class="sb-nav-fixed">
    <div id="app">
        <?php include("./import/nav.php"); ?>
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main class="container">
                    <div class="card my-5">
                        <div class="card-header">
                            <h5>Send message</h5>
                        </div>
                        <div class="card-body">
                            <el-form :model="smsNotif" :rules="rules" ref="smsNotif" label-width="120px" class="demo-ruleForm">
                                <el-form-item prop="sms">
                                    <el-input type="textarea" v-model="smsNotif.sms"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="submitForm('smsNotif')">Send</el-button>
                                    <el-button @click="resetForm('smsNotif')">Reset</el-button>
                                </el-form-item>
                            </el-form>
                        </div>
                    </div>
                </main>
                <?php include("./import/footer.php"); ?>
            </div>
        </div>
        <?php include("./import/body.php"); ?>
    </div>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    fullscreenLoading: true,
                    smsNotif: {
                        sms: "",
                    },
                    rules: {
                        sms: [{
                            required: true,
                            message: 'Text message is required!',
                            trigger: 'blur'
                        }, {
                            max: 250,
                            message: 'Text message has maximum of two-fifty(250) characters!',
                            trigger: 'blur'
                        }],
                    },
                }
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
            },
            methods: {
                // Logout ****************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged out!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "login"
                                }, 1000)
                            }
                        })
                },
                submitForm(smsNotif) {
                    this.$refs[smsNotif].validate((valid) => {
                        if (valid) {
                            var newData = new FormData()
                            newData.append("sms", this.smsNotif.sms)
                            this.loadButton = true;
                            axios.post("action.php?action=store", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New notification has been sent successfully!',
                                                type: 'success'
                                            });
                                        }, 1500);
                                    }
                                })
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            console.log('error submit!!');
                            return false;
                        }
                    });
                },
                resetForm(smsNotif) {
                    this.$refs[smsNotif].resetFields();
                }

                // *************************
            }
        })
    </script>
</body>

</html>
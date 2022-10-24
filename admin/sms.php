<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | SMS Appointments</title>
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
                <main>
                    <el-container>
                        <el-main>
                            <el-header>
                                <h4>Appointments</h4>
                            </el-header>
                            <div>
                                <el-divider></el-divider>
                            </div>
                            <el-form :model="addSms" :rules="smsRules" ref="addSms">
                                <div class="underline-input top d-flex justify-content-start">
                                    <div class="w-40">
                                        <el-form-item label="To :" prop="contact">
                                            <el-input v-model="addSms.contact" type="tel" maxlength='11' clearable></el-input>
                                        </el-form-item>
                                    </div>
                                    <div class="w-40">
                                        <el-tooltip class="item" effect="dark" content="Send" placement="top-start">
                                            <el-button type="white" @click="addUser('addSms')" size="small" icon="el-icon-position">Send</el-button>
                                        </el-tooltip>
                                    </div>
                                    <div class="w-30 mb-4">
                                        <el-form-item label="Appointment" prop="appointment">
                                            <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date">
                                            </el-date-picker>
                                        </el-form-item>
                                    </div>
                                </div>
                                <div>
                                    <el-divider></el-divider>
                                </div>
                                <div class="underline-input top d-flex justify-content-start">
                                    <div class="w-80">
                                        <el-form-item label="Message :" prop="message">
                                            <el-input v-model="addSms.message" type="textarea" placeholder="Message here" clearable></el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                            </el-form>
                        </el-main>
                    </el-container>
                </main>
                <?php include("./import/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php include("./import/body.php"); ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    fullscreenLoading: true,
                    addSms: {
                        contact: "",
                        message: "",
                        appointment: "",
                    },
                    smsRules: {
                        contact: [{
                            pattern: /^[0-9]*$/,
                            message: 'Invalid mobile number format!',
                            trigger: 'blur'
                        }, {
                            max: 11,
                            message: 'Phone number must eleven(11) digits!',
                            trigger: 'blur'
                        }],
                        message: [{
                            required: true,
                            message: 'Message is required!',
                            trigger: 'blur'
                        },{
                            min: 2,
                            message: 'Message should atleast two(2) characters!',
                            trigger: 'blur'
                        }],
                        appointment: [{
                            required: true,
                            message: 'Appointment is required!',
                            trigger: 'blur'
                        }],
                    }

                }
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
            },
            methods: {
                // Logout **********************************************************
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
                addUser(addSms) {
                    this.$refs[addSms].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            this.openAddDrawer = false;
                            var newData = new FormData()
                            newData.append("contact", this.addSms.contact)
                            newData.append("message", this.addSms.message)
                            newData.append("appointment", this.addSms.appointment)
                            axios.post("sms-action.php?action=store", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'Message sent successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                        }, 1500);
                                        this.resetFormData();
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        } else {
                            this.$message.error("Cannot submit the message. Please check the error(s).")
                            return false;
                        }
                    });
                },
                resetFormData() {
                    this.addSms = []
                },
            }
        })
    </script>
</body>

</html>
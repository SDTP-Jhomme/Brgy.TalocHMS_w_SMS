<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Prenatal Patients Edit Form</title>
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
                        <el-header class="mt-4" height="40">
                            <div class="container p-0">
                                <el-row :gutter="20">
                                    <div class="d-flex justify-content-between">
                                        <el-col :span="12">
                                            <h3 class="m-0">Edit Prenatal Form</h3>
                                        </el-col>
                                        <el-link class="fs-6 pe-5" href="./prenatal" icon="el-icon-back" type="primary" :underline="false">Back</el-link>
                                    </div>
                                </el-row>
                            </div>
                        </el-header>
                        <el-main class="mt-4">
                            <el-row :gutter="20">
                                <el-col :span="18">
                                    <el-card shadow="never" class="vh-100">
                                        <el-form ref="form" :label-position="labelPosition" :model="form" label-width="120px">
                                            <el-form-item v-for="input in inputs" label="Activity name">
                                                <el-input v-model="input.value"></el-input>
                                            </el-form-item>
                                        </el-form>
                                    </el-card>
                                </el-col>
                                <el-col :span="6">
                                    <el-card class="box-card vh-100">
                                        <el-tabs v-model="activeName" stretch>
                                            <el-tab-pane label="Field Attributes" name="first">
                                                <el-button @click="addInput" size="small" icon="el-icon-c-scale-to-original">Add Input</el-button>
                                            </el-tab-pane>
                                            <el-tab-pane label="Form Attributes" name="second">
                                                <label class="mb-2">Label Position</label>
                                                <el-radio-group v-model="labelPosition" size="small" class="d-block">
                                                    <el-radio-button label="left">Left</el-radio-button>
                                                    <el-radio-button label="top">Top</el-radio-button>
                                                    <el-radio-button label="right">Right</el-radio-button>
                                                </el-radio-group>
                                            </el-tab-pane>
                                        </el-tabs>
                                    </el-card>
                                </el-col>
                            </el-row>
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
                    inputs: [],
                    form: [],
                    activeName: 'first',
                    labelPosition: "right"
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
                // ******************************************************************
                addInput() {
                    this.inputs.push({
                        value: ''
                    });
                },
            }
        })
    </script>
</body>

</html>
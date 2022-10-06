<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Add Patient</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id='$id'");

        $user_row = mysqli_fetch_assoc($user_record);

        $db_username = $user_row["username"];
        $db_last_login = $user_row["last_login"];
        $logged_user = ucfirst($db_username);
        $db_avatar = $user_row["avatar"];

        if ($db_last_login == "") {
            header("Location: ./change-password");
        }
    } else {

        header("Location: ../../capstone-new");
        die();
    } ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="app" v-loading.fullscreen.lock="fullscreenLoading">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column vh-100">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include("./import/nav.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- ElementUI Container -->
                    <div>
                        <el-container>
                            <el-header>Header</el-header>
                            <el-main>
                                <el-form :model="addPatient" :rules="addRules" ref="addPatient">
                                    <el-row :gutter="20" type="flex" justify="center">
                                        <el-col :span="6">
                                            <el-form-item prop="lastName">
                                                <label class="m-0"><span class="text-danger">*</span> Last Name</label>
                                                <el-input v-model="addPatient.lastName" clearable></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="6">
                                            <el-form-item prop="firstName">
                                                <label class="m-0"><span class="text-danger">*</span> First Name</label>
                                                <el-input v-model="addPatient.firstName" clearable></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="6">
                                            <el-form-item prop="middleName">
                                                <label class="m-0">Middle Name</label>
                                                <el-input v-model="addPatient.middleName" clearable></el-input>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="2">
                                            <el-form-item prop="suffix">
                                                <label class="m-0">Suffix</label>
                                                <el-input v-model="addPatient.suffix" clearable></el-input>
                                            </el-form-item>
                                        </el-col>
                                    </el-row>
                                    <el-row :gutter="30" type="flex" justify="center">
                                        <el-col :span="6">
                                            <el-form-item prop="birthDate">
                                                <label class="m-0 d-block"><span class="text-danger">*</span> Birthdate</label>
                                                <el-date-picker v-model="addPatient.birthDate" type="date" placeholder="">
                                                </el-date-picker>
                                            </el-form-item>
                                        </el-col>
                                        <el-col :span="6">
                                            <el-form-item prop="gender">
                                                <label class="m-0"><span class="text-danger">*</span> Gender</label>
                                                <div>
                                                    <el-radio v-model="addPatient.gender" label="Male">Male</el-radio>
                                                    <el-radio v-model="addPatient.gender" label="Female">Female</el-radio>
                                                </div>
                                            </el-form-item>
                                        </el-col>
                                    </el-row>
                                </el-form>
                            </el-main>
                        </el-container>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php include("./import/footer.php") ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php include("./import/body.php") ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    fullscreenLoading: true,
                    input: "",
                    addPatient: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                        suffix: "",
                        birtthDate: "",
                        gender: "",
                    },
                    addRules: {
                        firstName: [{
                            required: true,
                            message: 'First name is required!',
                            trigger: 'blur'
                        }],
                        lastName: [{
                            required: true,
                            message: 'Last name is required!',
                            trigger: 'blur'
                        }],
                        birthDate: [{
                            required: true,
                            message: 'Birthdate is required!',
                            trigger: 'blur'
                        }],
                        gender: [{
                            required: true,
                            message: 'Gender is required!',
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
                    axios.post("../auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged out!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "../../capstone-new"
                                }, 1000)
                            }
                        })
                },
                // ******************************************************************
            }
        })
    </script>
</body>

</html>
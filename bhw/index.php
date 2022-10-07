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
                            <el-header height="0px"></el-header>
                            <el-main v-if="active == 0">
                                <el-row class="mb-3">
                                    <el-col :span="12" :offset="2">
                                        Patient Information
                                    </el-col>
                                </el-row>
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
                                    <el-row :gutter="30" type="flex" justify="center" align="middle">
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
                                <el-divider></el-divider>
                            </el-main>
                            <el-main v-if="active == 1">
                                <el-row class="mb-3">
                                    <el-col :span="12" :offset="2">
                                        Select Checkup
                                    </el-col>
                                </el-row>
                                <el-row :gutter="30" type="flex" justify="center">
                                    <el-col :span="5">
                                        <a href="javascript:void(0)" @click="healthCheckup">
                                            <div class="card" :class="{'border border-primary': this.isHealthCheckup}">
                                                <img src="../assets/img/health-checkup.png" alt="Health Checkup">
                                            </div>
                                        </a>
                                    </el-col>
                                    <el-col :span="5">
                                        <a href="javascript:void(0)" @click="immunization">
                                            <div class="card" :class="{'border border-primary': this.isImmunization}">
                                                <img src="../assets/img/immunization.png" alt="Immunization Checkup">
                                            </div>
                                        </a>
                                    </el-col>
                                    <el-col :span="5">
                                        <a href="javascript:void(0)" @click="pregnancy">
                                            <div class="card" :class="{'border border-primary': this.isPregnancy}">
                                                <img src="../assets/img/pregnancy.png" alt="Pregnancy Checkup">
                                            </div>
                                        </a>
                                    </el-col>
                                </el-row>
                            </el-main>
                            <el-main v-if="active == 2">
                                <el-row class="mb-3">
                                    <el-col :span="12" :offset="2">
                                        Fill in the Forms
                                    </el-col>
                                </el-row>
                                <el-row v-if="this.isHealthCheckup" :gutter="30" type="flex" justify="center">
                                    health checkup
                                </el-row>
                                <el-row v-if="this.isImmunization" :gutter="30" type="flex" justify="center">
                                    immunization
                                </el-row>
                                <el-row v-if="this.isPregnancy" :gutter="30" type="flex" justify="center">
                                    pregnancy
                                </el-row>
                            </el-main>
                            <el-main>
                                <el-row type="flex" justify="center" class="mt-4 mb-4">
                                    <el-col>
                                        <el-steps :space="800" :active="active" finish-status="success" align-center>
                                            <el-step title="Step 1"></el-step>
                                            <el-step title="Step 2"></el-step>
                                            <el-step title="Finish"></el-step>
                                        </el-steps>
                                    </el-col>
                                </el-row>
                                <el-row type="flex" justify="center" v-if="active == 0">
                                    <el-button type="primary" size="small" plain @click="proceed('addPatient')">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                                </el-row>
                                <el-row type="flex" justify="center" v-if="active == 1">
                                    <el-button-group>
                                        <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                                        <el-button type="primary" size="small" plain @click="next">Next <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                                    </el-button-group>
                                </el-row>
                                <el-row type="flex" justify="center" v-if="active == 2">
                                    <el-button-group>
                                        <el-button type="primary" size="small" plain @click="back" icon="el-icon-arrow-left el-icon-back">Back</el-button>
                                        <el-button type="primary" size="small" plain @click="next">Submit <i class="el-icon-arrow-right el-icon-right"></i></el-button>
                                    </el-button-group>
                                </el-row>
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
                    active: 0,
                    fullscreenLoading: true,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
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
                this.active = localStorage.active ? parseInt(localStorage.active) : 0
                this.addPatient = localStorage.addPatient ? JSON.parse(localStorage.addPatient) : {}
                this.isHealthCheckup = localStorage.isHealthCheckup ? localStorage.isHealthCheckup : false
                this.isImmunization = localStorage.isImmunization ? localStorage.isImmunization : false
                this.isPregnancy = localStorage.isPregnancy ? localStorage.isPregnancy : false
            },
            watch: {

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
                proceed(addPatient) {
                    this.$refs[addPatient].validate((valid) => {
                        if (valid) {
                            this.active++;
                            localStorage.setItem("active", this.active)
                            localStorage.setItem("addPatient", JSON.stringify(this.addPatient))
                        } else {
                            this.$message.error("Please fill in the required informations!");
                            return false;
                        }
                    })
                },
                back() {
                    this.active--
                    if (this.active == 0) {
                        localStorage.removeItem("addPatient")
                    }
                    localStorage.isHealthCheckup ? localStorage.removeItem("addPatient") : ""
                    localStorage.isImmunization ? localStorage.removeItem("isImmunization") : ""
                    localStorage.isPregnancy ? localStorage.removeItem("isPregnancy") : ""
                },
                next() {
                    if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    } else {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy) {
                        this.active++;
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                healthCheckup() {
                    this.isPregnancy = false;
                    this.isImmunization = false;
                    this.isHealthCheckup = true;
                },
                immunization() {
                    this.isPregnancy = false;
                    this.isImmunization = true;
                    this.isHealthCheckup = false;
                },
                pregnancy() {
                    this.isPregnancy = true;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                }
            }
        })
    </script>
</body>

</html>
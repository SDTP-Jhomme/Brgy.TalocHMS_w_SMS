<!DOCTYPE html>
<html lang="en">

<head>
    <title>PATIENT | Home</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM patient where id='$id'");

        while ($user_row = mysqli_fetch_assoc($user_record)) {

            $db_username = $user_row["username"];
            $db_last_login = $user_row["last_login"];
            $logged_user = ucfirst($db_username);
            $db_identification = $user_row["fsn"];
            $db_firstname = $user_row["first_name"];
            $db_lastname = $user_row["last_name"];
            $db_middlename = $user_row["middle_name"];
            $db_phonenumber = $user_row["phone_number"];
            $name = ucfirst($user_row["first_name"]) . " " . ucfirst($user_row["last_name"]);
            $db_avatar = $user_row["avatar"];
            $birthday = $user_row["birthdate"];
            $birth_date = substr($birthday, 4, 11);
            $db_birthday = date("F d, Y", strtotime($birth_date));
            $db_gender = $user_row["gender"];
            $db_suffix = $user_row["suffix"];
        }

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
                <!-- /.container-fluid -->
            </div>
            <div class="container-sm">
                <?php include("./main.php"); ?>
                <?php //include("./user-tables/immunization.php"); ?>
            </div>
            <el-dialog :visible.sync="openAppointmentDialog" width="20%" :before-close="closeAppointmentDialog">
                <div class="container">
                    <p>Please wait for <el-tag type="success">APPROVAL</el-tag> from BHWs via Sms.</p>
                    <h4 class="text-center">THANK YOU!</h4>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button-group v-if="isHealthCheckup">
                        <el-button type="primary" size="small" @click="closeAppointmentDialog">Close</el-button>
                        <el-button type="primary" size="small" plain @click="submitHealth('health')">Submit</i></el-button>
                    </el-button-group>
                    <el-button-group v-else-if="isImmunization">
                        <el-button type="primary" size="small" @click="closeAppointmentDialog">Close</el-button>
                        <el-button type="primary" size="small" plain @click="submitImmunization('immunize')">Submit</i></el-button>
                    </el-button-group>
                    <el-button-group v-else-if="isPregnancy">
                        <el-button type="primary" size="small" @click="closeAppointmentDialog">Close</el-button>
                        <el-button type="primary" size="small" plain @click="submitPrenatal('prenatal')">Submit</i></el-button>
                    </el-button-group>
                    <el-button-group v-else>
                        <el-button type="primary" size="small" @click="closeAppointmentDialog">Close</el-button>
                        <el-button type="primary" size="small" plain @click="submitFamily('family')">Submit</i></el-button>
                    </el-button-group>
                </span>
            </el-dialog>
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
                    datePickerOptions: {
                        disabledDate(date) {
                            return date < new Date()
                        }
                    },

                    active: 0,
                    fullscreenLoading: true,
                    openAppointmentDialog: false,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    isFamily: false,
                    avatar: "",
                    gender: "",
                    phone_number: "",
                    name: "",
                    family: {
                        id: <?php echo $id ?>,
                        section: "Family Planning",
                    },
                    maternal: {
                        id: <?php echo $id ?>,
                        section: "Maternity",
                    },
                    health: {
                        id: <?php echo $id ?>,
                        section: "Individual Treatment",
                    },
                    immunize: {
                        id: <?php echo $id ?>,
                        section: "Immunization",
                    },
                }
            },
            created() {
                this.fetchAvatar()
                this.fetchName()
                this.fetchContact()
                this.fetchGender()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
                this.active = localStorage.active ? parseInt(localStorage.active) : 0
                this.isHealthCheckup = localStorage.isHealthCheckup ? localStorage.isHealthCheckup : false
                this.isImmunization = localStorage.isImmunization ? localStorage.isImmunization : false
                this.isPregnancy = localStorage.isPregnancy ? localStorage.isPregnancy : false
                this.isFamily = localStorage.isFamily ? localStorage.isFamily : false

            },
            methods: {
                // Logout **********************************************************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("../auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                localStorage.clear();
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
                closeAppointmentDialog() {
                    this.$confirm('Are you sure you want to cancel?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openAppointmentDialog = false
                        })
                        .catch(() => {});
                },
                nextFamily(fam_planning) {
                    if (this.isFamily) {
                        localStorage.setItem("isFamily", this.isFamily)
                        this.openAppointmentDialog = true
                        localStorage.setItem("active", this.active)
                        console.log(this.isFamily)

                    } else if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isPregnancy) {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy || this.isFamily) {
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                nextImmunize(immunize) {
                    if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                        this.openAppointmentDialog = true
                        localStorage.setItem("active", this.active)
                        console.log(this.isImmunization)

                    } else if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isPregnancy) {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                    } else if (this.isFamily) {
                        localStorage.setItem("isFamily", this.isFamily)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy || this.isFamily) {
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                nextPrenatal(maternal) {
                    if (this.isPregnancy) {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                        this.openAppointmentDialog = true
                        localStorage.setItem("active", this.active)

                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    } else if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isFamily) {
                        localStorage.setItem("isFamily", this.isFamily)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy || this.isFamily) {
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                nextHealth(health) {
                    if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                        this.openAppointmentDialog = true
                        localStorage.setItem("active", this.active)

                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    } else if (this.isPregnancy) {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                    } else if (this.isFamily) {
                        localStorage.setItem("isFamily", this.isFamily)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy || this.isFamily) {
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                healthCheckup() {
                    this.isFamily = false;
                    this.isPregnancy = false;
                    this.isImmunization = false;
                    this.isHealthCheckup = !this.isHealthCheckup;
                },
                immunization() {
                    this.isFamily = false;
                    this.isPregnancy = false;
                    this.isImmunization = !this.isImmunization;
                    this.isHealthCheckup = false;
                },
                pregnancy() {
                    this.isFamily = false;
                    this.isPregnancy = !this.isPregnancy;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                },
                family() {
                    this.isFamily = !this.isFamily;
                    this.isPregnancy = false;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                },
                submitHealth(health) {
                    this.loadButton = true;
                    var newData = new FormData()
                    newData.append("patient_id", this.health.id)
                    newData.append("section", this.health.section)
                    console.log(this.name)
                    axios.post("store-action.php?action=storeHealth", newData)
                        .then(response => {
                            if (response.data) {
                                this.tableLoad = true;
                                setTimeout(() => {
                                    this.$message({
                                        message: 'New individual treatment request has been added successfully!',
                                        type: 'success'
                                    });
                                    this.tableLoad = false;
                                    this.fetchContact();
                                    this.fetchGender();
                                    this.fetchName();
                                    setTimeout(() => {
                                        this.openAppointmentDialog = false
                                    }, 500)
                                }, 1500);
                                this.loadButton = false
                                this.isHealthCheckup
                            }
                        })
                    localStorage.setItem("active", this.active)
                    localStorage.isHealthCheckup ? localStorage.removeItem("isHealthCheckup") : ""
                },
                resetFormData() {
                    this.health = []
                },
                submitImmunization(immunize) {
                    this.loadButton = true;
                    var newData = new FormData()
                    newData.append("patient_id", this.immunize.id)
                    newData.append("section", this.immunize.section)
                    axios.post("store-action.php?action=storeImmunization", newData)
                        .then(response => {
                            if (response.data) {
                                this.tableLoad = true;
                                setTimeout(() => {
                                    this.$message({
                                        message: 'New immunization request has been added successfully!',
                                        type: 'success'
                                    });
                                    this.tableLoad = false;
                                    this.fetchContact();
                                    this.fetchGender();
                                    this.fetchName();
                                    setTimeout(() => {
                                        this.openAppointmentDialog = false
                                    }, 500)
                                }, 1500);
                                this.loadButton = true;
                                this.isImmunization
                            }
                        })
                    localStorage.setItem("active", this.active)
                    localStorage.isImmunization ? localStorage.removeItem("isImmunization") : ""
                },
                resetFormData() {
                    this.immunize = []
                },
                submitPrenatal(prenatal) {
                    this.loadButton = true;
                    var newData = new FormData()
                    newData.append("patient_id", this.maternal.id)
                    newData.append("section", this.maternal.section)
                    axios.post("store-action.php?action=storePrenatal", newData)
                        .then(response => {
                            if (response.data) {
                                this.tableLoad = true;
                                setTimeout(() => {
                                    this.$message({
                                        message: 'New maternity request has been added successfully!',
                                        type: 'success'
                                    });
                                    this.tableLoad = false;
                                    this.fetchContact();
                                    this.fetchGender();
                                    this.fetchName();
                                    setTimeout(() => {
                                        this.openAppointmentDialog = false
                                    }, 500)
                                }, 1500);
                                this.loadButton = false
                                this.isPregnancy
                            }
                        })
                    localStorage.setItem("active", this.active)
                    localStorage.isPregnancy ? localStorage.removeItem("isPregnancy") : ""
                },
                resetFormData() {
                    this.prenatal = []
                },
                submitFamily(family) {
                    this.loadButton = true;
                    var newData = new FormData()
                    newData.append("patient_id", this.family.id)
                    newData.append("section", this.family.section)
                    axios.post("store-action.php?action=storeFamily", newData)
                        .then(response => {
                            if (response.data) {
                                this.tableLoad = true;
                                setTimeout(() => {
                                    this.$message({
                                        message: 'New family planning request has been added successfully!',
                                        type: 'success'
                                    });
                                    this.tableLoad = false;
                                    this.fetchContact();
                                    this.fetchGender();
                                    this.fetchName();
                                    setTimeout(() => {
                                        this.openAppointmentDialog = false
                                    }, 500)
                                }, 1500);
                                this.loadButton = false
                                this.isFamily
                            }
                        })
                    localStorage.setItem("active", this.active)
                    localStorage.isFamily ? localStorage.removeItem("isFamily") : ""
                },
                resetFormData() {
                    this.family = []
                },
                // ******************************************************************
                fetchAvatar() {
                    const fetchAvatar = new FormData();
                    fetchAvatar.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_avatar", fetchAvatar)
                        .then(response => {
                            if (response) {
                                this.avatar = "../assets/" + response.data
                            }
                        })
                },
                fetchName() {
                    const fetchName = new FormData();
                    fetchName.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_name", fetchName)
                        .then(response => {
                            if (response) {
                                this.name = response.data
                            }
                        })
                },
                fetchGender() {
                    const fetchName = new FormData();
                    fetchName.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_gender", fetchName)
                        .then(response => {
                            if (response) {
                                this.gender = response.data
                            }
                        })
                },
                fetchContact() {
                    const fetchName = new FormData();
                    fetchName.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_contact", fetchName)
                        .then(response => {
                            if (response) {
                                this.phone_number = response.data
                            }
                        })
                },
            }
        })
    </script>
</body>

</html>
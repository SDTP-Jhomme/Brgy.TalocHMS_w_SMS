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
                    <?php include("./bhw.php"); ?>
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
                const dateToday = new Date();
                return {
                    active: 0,
                    fullscreenLoading: true,
                    backToHome: false,
                    checkupType: "",
                    avatar: "",
                    addPatient: {
                        id: 0,
                        fsn: "",
                        firstName: "",
                        middleName: "",
                        lastName: "",
                        suffix: "",
                        birthDate: "",
                        gender: "",
                        phone: "",
                    },
                    prenatal: {
                        appointment: "",
                        dateVisit: "",
                        weight: "",
                        blood: "",
                        aog: "",
                        height: "",
                        fhb: "",
                        presentation: "",
                        purok: "",
                        brgy: "",
                        g: "",
                        p: "",
                        lmp: "",
                        edc: "",
                        status: "",

                    },
                    health: {
                        clinisysFSN: "",
                        civil: "",
                        spouse: "",
                        education: "",
                        employment: "",
                        occupation: "",
                        religion: "",
                        street: "",
                        purok: "",
                        barangay: "",
                        blood: "",
                        member: "",
                        otherMember: "",
                        phlType: "",
                        philhealth: "",
                        mLastName: "",
                        mFirstName: "",
                        mMidName: "",
                        nhts: "",
                        allergy: "",
                        disability: "",
                        drug: "",
                        handicap: "",
                        impairment: "",
                        otherAlert: "",
                        history: [],
                        otherHistory: [],
                        encounter: "",
                        date: "",
                        age: "",
                        transaction: "",
                    },
                    addRules: {
                        fsn: [{
                            required: true,
                            message: 'FSN is required!',
                            trigger: 'blur'
                        }],
                        firstName: [{
                            required: true,
                            message: 'First name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        lastName: [{
                            required: true,
                            message: 'Last name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
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
                        phone: [{
                            required: true,
                            message: 'Phone number is required!',
                            trigger: 'blur'
                        }, {
                            min: 11,
                            max: 11,
                            message: 'Invalid phone number!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[0-9]*$/,
                            message: 'Invalid phone number!',
                            trigger: 'blur'
                        }],
                    }
                }
            },
            created() {
                this.fetchAvatar()
                this.checkStatus()

                this.checkupType = localStorage.checkupType ? localStorage.checkupType : ""
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
                this.active = localStorage.active ? parseInt(localStorage.active) : 0
                this.addPatient = localStorage.addPatient ? JSON.parse(localStorage.addPatient) : {}

                this.prenatal.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
                this.health.date = localStorage.date ? localStorage.date : "January 01, 1970"
                this.health.age = localStorage.age ? localStorage.age : 0
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
                // ******************************************************************
                checkStatus() {
                    const fetchStatus = new FormData();
                    fetchStatus.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_status", fetchStatus)
                        .then(response => {
                            if (response.data == "Inactive") {
                                axios.post("../auth.php?action=logout")
                                    .then(response => {
                                        if (response.data.message) {
                                            localStorage.clear();
                                            this.$notify.error({
                                                title: 'Error',
                                                message: 'Status is inactive!',
                                            });
                                            setTimeout(() => {
                                                window.location.href = "../../capstone-new"
                                            }, 1000)
                                        }
                                    })
                            }
                        })
                },
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
                proceed(addPatient) {
                    this.$refs[addPatient].validate((valid) => {
                        if (valid) {
                            this.active++;
                            localStorage.setItem("active", this.active)
                            localStorage.setItem("addPatient", JSON.stringify(this.addPatient))

                            const now = new Date();
                            const options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };

                            const date = now.toLocaleDateString("en-US", options);
                            localStorage.setItem("date", date)

                            this.prenatal.appointment = date
                            this.health.date = date

                            var today = new Date();
                            var birthDate = new Date(this.addPatient.birthDate);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            localStorage.setItem("age", age);
                            this.health.age = age;
                        } else {
                            this.$message.error("Unable to proceed. Please check the errors!");
                            return false;
                        }
                    })
                },
                back() {
                    if (this.active == 1) {
                        if (Object.keys(this.addPatient).length != 0) {
                            this.$confirm('Changes unsaved. Continue?', {
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                                })
                                .then(() => {
                                    this.active--
                                    this.addPatient = {}
                                    this.checkupType = "";
                                    localStorage.removeItem("checkupType")
                                    localStorage.setItem("active", this.active)
                                })
                                .catch(() => {});
                        } else {
                            this.active--
                            localStorage.removeItem("checkupType")
                            this.checkupType = "";
                        }
                    } else {
                        if (this.checkupType == "isPregnancy") {
                            this.active--
                            this.prenatal = {}
                            localStorage.removeItem("addPatient")
                        } else {
                            this.active--
                        }
                    }

                    localStorage.setItem("active", this.active)
                },
                next() {
                    if (this.checkupType) {
                        this.active++;
                        localStorage.setItem("checkupType", this.checkupType)
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                healthCheckup() {
                    this.checkupType = "" ? "isHealthCheckup" : this.checkupType == "isHealthCheckup" ? "" : "isHealthCheckup";
                },
                immunization() {
                    this.checkupType = "" ? "isImmunization" : this.checkupType == "isImmunization" ? "" : "isImmunization";
                },
                pregnancy() {
                    this.checkupType = "" ? "isPregnancy" : this.checkupType == "isPregnancy" ? "" : "isPregnancy";
                    this.addPatient.gender = "Female"
                },
                submitHealth() {
                    console.log(this.addPatient, "healthcheck")
                },
                submitImmunization() {
                    console.log(this.addPatient, "immunization")
                },
                submitPrenatal(prenatal) {
                    console.log(this.addPatient, "pregnancy")
                }
            }
        })
    </script>
</body>

</html>
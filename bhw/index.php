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
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    avatar: "",
                    addPatient: {
                        id: 0,
                        firstName: "",
                        middleName: "",
                        lastName: "",
                        suffix: "",
                        birthDate: "",
                        gender: "",
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
                    },
                    health: {
                        fsn: "",
                        clinisysFSN: "",
                        civil: "",
                        spouse: "",
                        education: "",
                        employment: "",
                        occupation: "",
                        religion: "",
                        telephone: "",
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
                        age: ""
                    },
                    addRules: {
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
                    },
                    prenatalRules: {
                        dateVisit: [{
                            required: true,
                            message: 'Date is required!',
                            trigger: 'blur'
                        }],
                        weight: [{
                            required: true,
                            message: 'Weight is required!',
                            trigger: 'blur'
                        }],
                        blood: [{
                            required: true,
                            message: 'Blood type is required!',
                            trigger: 'blur'
                        }],
                        aog: [{
                            required: true,
                            message: 'AOG is required!',
                            trigger: 'blur'
                        }],
                        height: [{
                            required: true,
                            message: 'Height is required!',
                            trigger: 'blur'
                        }],
                        fhb: [{
                            required: true,
                            message: 'FHB is required!',
                            trigger: 'blur'
                        }],
                        presentation: [{
                            required: true,
                            message: 'Presentation is required!',
                            trigger: 'blur'
                        }],
                    },
                    healthRules: {

                    }
                }
            },
            created() {
                this.fetchAvatar()
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

                this.health.age = localStorage.age ? localStorage.age : 0

                const today = new Date();
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };

                const date = today.toLocaleDateString("en-US", options);
                localStorage.setItem("date", date)

                this.prenatal.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
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
                            this.isHealthCheckup = false;
                            this.isImmunization = false;
                            this.isImmunization = false;

                            var today = new Date();
                            var birthDate = new Date(this.addPatient.birthDate);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var m = today.getMonth() - birthDate.getMonth();
                            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            localStorage.setItem("age", age);
                            this.individual.age = age;
                        } else {
                            this.$message.error("Please fill in the required informations!");
                            return false;
                        }
                    })
                },
                back() {
                    this.active--
                    localStorage.setItem("active", this.active)
                    if (this.active == 0) {
                        localStorage.removeItem("addPatient")
                        localStorage.removeItem("age")
                    }
                    localStorage.isHealthCheckup ? localStorage.removeItem("isHealthCheckup") : ""
                    localStorage.isImmunization ? localStorage.removeItem("isImmunization") : ""
                    localStorage.isPregnancy ? localStorage.removeItem("isPregnancy") : ""
                },
                next() {
                    if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    } else if (this.isPregnancy) {
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
                    this.isHealthCheckup = !this.isHealthCheckup;
                },
                immunization() {
                    this.isPregnancy = false;
                    this.isImmunization = !this.isImmunization;
                    this.isHealthCheckup = false;
                },
                pregnancy() {
                    this.isPregnancy = !this.isPregnancy;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                },
                submitHealth() {
                    console.log(this.addPatient, "healthcheck")
                },
                submitImmunization() {
                    console.log(this.addPatient, "immunization")
                },
                submitPrenatal(prenatal) {
                    this.$refs[prenatal].validate((valid) => {
                        if (valid) {
                            console.log(this.addPatient, "pregnancy")
                        } else {

                        }
                    })
                }
            }
        })
    </script>
</body>

</html>
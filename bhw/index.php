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

<body>
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
                var first = /(^(\+63)(\d){10}$)/;
                var second = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                var third = new RegExp('(?!' + second.source + ')(?:' + first.source + ')')

                return {
                    labelPosition: "left",
                    active: 0,
                    checkbox: false,
                    fullscreenLoading: true,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    avatar: "",
                    addPatient: {
                        firstName: "",
                        middleName: "",
                        lastName: "",
                        suffix: "",
                        birtthDate: "",
                        gender: "",
                        spouse: "",
                        educAttainment: "",
                        emloymentStatus: "",
                        employed: "",
                        religion: "",
                        telephomne: "",
                        street: "",
                        purok: "",
                        barangay: "",
                        bloodType: "",
                        familyMember: "",
                        others: "",
                        Philhealth: "",
                        philhealthNo: "",
                        motherfirstName: "",
                        mothermiddleName: "",
                        motherlastName: "",
                        nhts: "",
                        pantawid: "",
                        pantawidMember: "",
                        S: "",
                        O: "",
                        pr: "",
                        rr: "",
                        bp: "",
                        weight: "",
                        height: "",
                        temp: "",
                        A: "",
                        P: "",
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
                            message: 'Invalid last name format!',
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
                        civil: [{
                            required: true,
                            message: 'Civil Status is required!',
                            trigger: 'blur'
                        }],
                        spouse: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Spouse format!',
                            trigger: 'blur'
                        }],
                        educAttainment: [{
                            required: true,
                            message: 'Educational Attainment is required!',
                            trigger: 'blur'
                        }],
                        emloymentStatus: [{
                            required: true,
                            message: 'Employment Status is required!',
                            trigger: 'blur'
                        }],
                        employed: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Occupation format!',
                            trigger: 'blur'
                        }],
                        religion: [{
                            required: true,
                            message: 'Religion is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Religion format!',
                            trigger: 'blur'
                        }],
                        telephone: [{
                            required: true,
                            message: 'Phone number/ Email Address is required!',
                            trigger: 'blur'
                        }, {
                            pattern: this.third,
                            message: 'Invalid Phone number/ Email Address format!',
                            trigger: 'blur'
                        }],
                        street: [{
                            required: true,
                            message: 'Street is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Street format!',
                            trigger: 'blur'
                        }],
                        purok: [{
                            required: true,
                            message: 'Purok is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Purok format!',
                            trigger: 'blur'
                        }],
                        barangay: [{
                            required: true,
                            message: 'Barangay is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Barangay format!',
                            trigger: 'blur'
                        }],
                        bloodType: [{
                            required: true,
                            message: 'Bloodtype is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid Bloodtype format!',
                            trigger: 'blur'
                        }],
                        familyMember: [{
                            required: true,
                            message: 'Please select!',
                            trigger: 'blur'
                        }],
                        Philhealth: [{
                            required: true,
                            message: 'Please select!',
                            trigger: 'blur'
                        }],
                        philhealthNo: [{
                            pattern: /^[0-9]+(-[0-9]+)+$/,
                            message: 'Invalid Philhealth Number format!',
                            trigger: 'blur'
                        }, {
                            min: 2,
                            message: 'Philhealth Number should atleast two(2) digits!',
                            trigger: 'blur'
                        }],
                        others: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid format!',
                            trigger: 'blur'
                        }],
                        motherfirstName: [{
                            required: true,
                            message: 'First name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        motherlastName: [{
                            required: true,
                            message: 'Last name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid last name format!',
                            trigger: 'blur'
                        }],
                        pantawidMember: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid format!',
                            trigger: 'blur'
                        }],
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

                this.addPatient.appointment = new Date()
                this.addPatient.consultationDate = new Date()
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
                submit(addPatient) {
                    this.$refs[addPatient].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            this.openAddDrawer = false;
                            const birthday = this.addPatient.birthdate;
                            const birthdayFormat = birthday.getFullYear() + "-" + ((birthday.getMonth() + 1) > 9 ? '' : '0') + (birthday.getMonth() + 1) + "-" + (birthday.getDate() > 9 ? '' : '0') + birthday.getDate();
                            var newData = new FormData()
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("niddle_name", this.addPatient.middleName)
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("suffix", this.addPatient.suffix)
                            newData.append("birthdate", birthdayFormat)
                            newData.append("gender", this.addPatient.gender)
                            axios.post("action.php?action=store", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New Patient has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData()
                                            setTimeout(() => {
                                                this.openAddDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.resetFormData();
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    });
                    console.log(this.addPatient)
                },
                resetForm(addPatient) {
                    this.$refs[addPatient].resetFields();
                },
                resetFormData() {
                    this.addBhw = []
                },
            }
        })
    </script>
</body>

</html>
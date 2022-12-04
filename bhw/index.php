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

        header("Location: ./login");
        die();
    } ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="app">
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
                return {
                    maxDate: {
                        disabledDate(date) {
                            return date > new Date();
                        }
                    },
                    active: 0,
                    backToHome: false,
                    checkupType: "",
                    avatar: "",
                    date: "",
                    age: "",
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
                        transaction: "",
                    },
                    otherMember: "",
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
                            min: 10,
                            message: 'Invalid phone number!',
                            trigger: 'blur'
                        }],
                    }
                }
            },
            mounted() {

                this.fetchAvatar()
                this.checkStatus()

                const now = new Date();
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const date = now.toLocaleDateString("en-US", options);
                this.date = date

                this.checkupType = localStorage.checkupType ? localStorage.checkupType : "";
                this.active = localStorage.active ? parseInt(localStorage.active) : 0;
                this.addPatient = localStorage.addPatient ? JSON.parse(localStorage.addPatient) : {};
                this.age = localStorage.age ? localStorage.age : "";

                if (this.checkupType == "isPregnancy") {
                    this.addPatient.gender = "Female";
                }

                if (this.active == 0) {
                    this.checkupType = "";
                    localStorage.clear();
                }
            },
            methods: {
                // Logout **********************************************************
                logout() {
                    axios.post("./auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                localStorage.clear();
                                this.$notify({
                                    title: 'Success',
                                    message: 'Successfully logged out!',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    window.location.href = "./login"
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
                                axios.post("./auth.php?action=logout")
                                    .then(response => {
                                        if (response.data.message) {
                                            localStorage.clear();
                                            this.$notify.error({
                                                title: 'Error',
                                                message: 'Status is inactive!',
                                            });
                                            setTimeout(() => {
                                                window.location.href = "./login"
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
                numbersOnly(event) {
                    let keyCode = (event.keyCode ? event.keyCode : event.which);
                    if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
                        event.preventDefault();
                    }
                },
                calculateAge(birthDay) {
                    let dob = new Date(birthDay);
                    let now = new Date();
                    let lastDayOfMonth = new Date(dob.getFullYear(), dob.getMonth() + 1, 0).getDate();

                    let birthYear = dob.getYear();
                    let birthMonth = dob.getMonth();
                    let birthDate = dob.getDate();

                    let currentYear = now.getYear();
                    let currentMonth = now.getMonth();
                    let currentDate = now.getDate();

                    let monthDiff = currentMonth - birthMonth;
                    let dateDiff = currentDate - birthDate;
                    let age = currentYear - birthYear;

                    if (age > 1 && (monthDiff < 0 || (monthDiff == 0 && currentDate < birthDate))) {
                        let ageCount = age - 1
                        return ageCount + ` year${ageCount > 1 ? "s" : ""} old`
                    } else if (age == 1 && (monthDiff < 0 || (monthDiff == 0 && currentDate < birthDate))) {
                        let ageCount = 11 - birthMonth + currentMonth
                        return ageCount + ` month${ageCount > 1 ? "s" : ""} old`
                    } else if (age == 0 && monthDiff > 0 && currentDate >= birthDate) {
                        let ageCount = monthDiff
                        return ageCount + ` month${ageCount > 1 ? "s" : ""} old`
                    } else if (age == 0 && monthDiff > 1 && currentDate < birthDate) {
                        let ageCount = monthDiff - 1
                        return ageCount + ` month${ageCount > 1 ? "s" : ""} old`
                    } else if (age == 0 && monthDiff <= 1 && currentDate >= birthDate) {
                        let ageCount = dateDiff
                        return ageCount + ` day${ageCount > 1 ? "s" : ""} old`
                    } else if (age == 0 && monthDiff <= 1 && currentDate < birthDate) {
                        let ageCount = lastDayOfMonth - birthDate + currentDate
                        return ageCount + ` day${ageCount > 1 ? "s" : ""} old`
                    }


                    return age + ` year${age > 1 ? "s" : ""} old`;
                },
                proceed(addPatient) {
                    this.$refs[addPatient].validate((valid) => {
                        if (valid) {
                            this.active++;
                            this.age = this.calculateAge(this.addPatient.birthDate);

                            localStorage.setItem("active", this.active)
                            localStorage.setItem("addPatient", JSON.stringify(this.addPatient))
                            localStorage.setItem("age", this.age);
                        } else {
                            this.$message.error("Unable to proceed. Please check the errors!");
                            return false;
                        }
                    })
                },
                back() {
                    if (this.active == 1) {
                        delete this.addPatient.gender
                        if (Object.values(this.addPatient).every((i) => i == "")) {
                            this.addPatient = {}
                        }
                        if (Object.values(this.addPatient).length != 0) {
                            this.$confirm('There are unsaved changes. Continue?', {
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                                })
                                .then(() => {
                                    this.active--
                                    this.addPatient = {}
                                    localStorage.removeItem("active")
                                })
                                .catch(() => {});
                        } else {
                            this.active--
                            localStorage.removeItem("active")
                        }
                    } else if (this.active == 2) {
                        if (Object.values(this.prenatal).every((i) => i == "") || Object.values(this.prenatal).every((i) => i == "")) {
                            this.prenatal = {}
                            this.health = {}
                        }
                        if (Object.values(this.prenatal).length != 0 || Object.values(this.health).length != 0) {
                            this.$confirm('There are unsaved changes. Continue?', {
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No',
                                })
                                .then(() => {
                                    this.active--
                                    this.prenatal = {}
                                    this.health = {}
                                    localStorage.removeItem("addPatient")
                                    localStorage.removeItem("age")
                                    localStorage.setItem("active", this.active)
                                })
                                .catch(() => {});
                        } else {
                            this.active--
                            localStorage.removeItem("addPatient")
                            localStorage.removeItem("age")
                            localStorage.setItem("active", this.active)
                        }
                    } else {
                        this.active--
                    }
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
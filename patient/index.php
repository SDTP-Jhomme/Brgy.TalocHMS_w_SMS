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
            </div>
                <!-- <el-dialog title="Set Appointment" :visible.sync="openAppointmentDialog" width="30%" :before-close="closeAppointmentDialog">
                    <el-form :model="addAppointment:" :rules="smsRules" ref="addAppointment:">
                        <el-form-item label="Set Appointment" prop="appointment">
                            <el-date-picker size="medium" v-model="addAppointment.appointment" type="date" placeholder="Select Date">
                            </el-date-picker>
                        </el-form-item>
                    </el-form>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="primary" @click="closeAppointmentDialog">Close</el-button>
                    </span>
                </el-dialog> -->
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
                    openAppointmentDialog: false,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    avatar: "",
                    gender: "",
                    addAppointment: {
                        appointment: ""
                    },
                    prenatal: {
                        fsn: <?php echo $db_identification ?>,
                        spouseFname: "",
                        spouseLname: "",
                        purok: "",
                        barangay: "",
                    },
                    health: {
                        fsn: <?php echo $db_identification ?>,
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
                        pantawid: "",
                        hhNo: "",
                        alert: "",
                        otherAlert: "",
                        medicalHistory: "",
                        otherHistory: "",
                    },
                    immunize: {
                        fsn: <?php echo $db_identification ?>,
                        childNo: "",
                        mLastName: "",
                        mFirstName: "",
                        mMidName: "",
                        fLastName: "",
                        fFirstName: "",
                        fMidName: "",
                        purok: "",
                        barangay: "",
                    },
                    apptRules: {
                        appointment: [{
                            required: true,
                            message: 'Please set your appointment!',
                            trigger: 'blur'
                        }]
                    },
                    prenatalRules: {
                        spouseFname: [{
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        spouseLname: [{
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid last name format!',
                            trigger: 'blur'
                        }],
                        purok: [{
                            required: true,
                            message: 'Purok is required!',
                            trigger: 'blur'
                        }],
                        barangay: [{
                            required: true,
                            message: 'Barangay is required!',
                            trigger: 'blur'
                        }],
                    },
                    healthRules: {
                        civil: [{
                            required: true,
                            message: 'Civil Status is required!',
                            trigger: 'blur'
                        }],
                        education: [{
                            required: true,
                            message: 'Education Attainment is required!',
                            trigger: 'blur'
                        }],
                        employment: [{
                            required: true,
                            message: 'Employment Status is required!',
                            trigger: 'blur'
                        }],
                        religion: [{
                            required: true,
                            message: 'Religion is required!',
                            trigger: 'blur'
                        }],
                        street: [{
                            required: true,
                            message: 'Street is required!',
                            trigger: 'blur'
                        }],
                        purok: [{
                            required: true,
                            message: 'Purok is required!',
                            trigger: 'blur'
                        }],
                        barangay: [{
                            required: true,
                            message: 'Barangay is required!',
                            trigger: 'blur'
                        }],
                        member: [{
                            required: true,
                            message: 'Family member is required!',
                            trigger: 'blur'
                        }],
                        mLastName: [{
                            required: true,
                            message: 'Mother last name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid last name format!',
                            trigger: 'blur'
                        }],
                        mFirstName: [{
                            required: true,
                            message: 'Mother first name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        mMidName: [{
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid middle name format!',
                            trigger: 'blur'
                        }],
                        alert: [{
                            required: true,
                            message: 'Alert type is required!',
                            trigger: 'blur'
                        }],
                        medicalHistory: [{
                            required: true,
                            message: 'Past medical family history  is required!',
                            trigger: 'blur'
                        }],
                    },
                    immunizationRules: {
                        mLastName: [{
                            required: true,
                            message: 'Mother last name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        mFirstName: [{
                            required: true,
                            message: 'Mother first name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        mMidName: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        fLastName: [{
                            required: true,
                            message: 'Father last name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        fFirstName: [{
                            required: true,
                            message: 'Father first name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        fMidName: [{
                            pattern: /^[a-zA-Z- ]*$/,
                            message: 'Invalid first name format!',
                            trigger: 'blur'
                        }],
                        purok: [{
                            required: true,
                            message: 'Purok is required!',
                            trigger: 'blur'
                        }],
                        barangay: [{
                            required: true,
                            message: 'Barangay is required!',
                            trigger: 'blur'
                        }],
                    },
                }
            },
            created() {
                this.fetchAvatar()
                this.getData()
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
                this.immunize.age = localStorage.age ? localStorage.age : 0


                const today = new Date();
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };

                const date = today.toLocaleDateString("en-US", options);
                localStorage.setItem("date", date)

                this.prenatal.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
                this.health.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
                this.immunize.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
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
                    this.$confirm('Done copying username & password?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openAppointmentDialog = false
                        })
                        .catch(() => {});
                },
                submit() {
                    if (this.active++ > 1) {
                        this.active = 0;
                    } else {

                    }
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
                submitHealth(health) {
                    if (this.active++ > 1) this.active = 0;
                    this.$refs[health].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            const newData = new FormData()
                            newData.append("fsn", this.health.fsn)
                            newData.append("civil", this.health.civil)
                            newData.append("spouse", this.health.spouse)
                            newData.append("educ_attainment", this.health.education)
                            newData.append("employment_status", this.health.employment)
                            newData.append("occupation", this.health.occupation)
                            newData.append("religion", this.health.religion)
                            newData.append("street", this.health.street)
                            newData.append("purok", this.health.purok)
                            newData.append("barangay", this.health.barangay)
                            newData.append("blood_type", this.health.blood)
                            newData.append("family_member", this.health.member)
                            newData.append("other_member", this.health.otherMember)
                            newData.append("philhealth_type", this.health.phlType)
                            newData.append("philhealth_no", this.health.philhealth)
                            newData.append("m_lastname", this.health.mLastName)
                            newData.append("m_firstname", this.health.mFirstName)
                            newData.append("m_middlename", this.health.mMidName)
                            newData.append("nhts", this.health.nhts)
                            newData.append("pantawid_member", this.health.pantawid)
                            newData.append("hh_no", this.health.hhNo)
                            newData.append("alert_type", this.health.alert)
                            newData.append("other_alert", this.health.otherAlert)
                            newData.append("medical_history", this.health.medicalHistory)
                            newData.append("other_history", this.health.otherHistory)
                            axios.post("store-action.php?action=storeHealth", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New individual treatment form has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData();
                                            setTimeout(() => {
                                                this.openAppointmentDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false
                                    }
                                })
                            this.loadButton = true
                            localStorage.setItem("active", this.active)
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                },
                submitImmunization(immunize) {
                    if (this.active++ > 1) this.active = 0;
                    this.$refs[immunize].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            const newData = new FormData()
                            newData.append("fsn", this.immunize.fsn)
                            newData.append("m_lastname", this.immunize.mLastName)
                            newData.append("m_firstname", this.immunize.mFirstName)
                            newData.append("m_middlename", this.immunize.mMidName)
                            newData.append("f_lastname", this.immunize.fLastName)
                            newData.append("f_firstname", this.immunize.fFirstName)
                            newData.append("f_middlename", this.immunize.fMidName)
                            newData.append("purok", this.immunize.purok)
                            newData.append("barangay", this.immunize.barangay)
                            axios.post("store-action.php?action=storeImmunization", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New immunization form has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData();
                                            setTimeout(() => {
                                                this.openAppointmentDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = true;
                                    }
                                })
                            this.loadButton = true
                            localStorage.setItem("active", this.active)
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                    console.log(this.addPatient, "immunization")
                },
                submitPrenatal(prenatal) {
                    if (this.active++ > 1) this.active = 0;
                    this.$refs[prenatal].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            const newData = new FormData()
                            newData.append("fsn", this.prenatal.fsn)
                            newData.append("spouse_lastname", this.prenatal.spouseLname)
                            newData.append("spouse_firstname", this.prenatal.spouseFname)
                            newData.append("purok", this.prenatal.purok)
                            newData.append("barangay", this.prenatal.barangay)
                            axios.post("store-action.php?action=storePrenatal", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New maternity form has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData();
                                            setTimeout(() => {
                                                this.openAppointmentDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false
                                    }
                                })
                            this.loadButton = true
                            localStorage.setItem("active", this.active)
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
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
                getData() {
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                this.gender = response.data
                                this.checkIdentification = response.data.map(res => res.fsn)
                            }
                        })
                },
            }
        })
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Add Patient</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM users where id='$id'");

        while ($user_row = mysqli_fetch_assoc($user_record)) {

            $db_username = $user_row["username"];
            $db_last_login = $user_row["last_login"];
            $logged_user = ucfirst($db_username);
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- ElementUI Container -->
                    <?php include("./bhw.php"); ?>
                </div>
                <!-- /.container-fluid -->
                <!-- After Add Show Patient Username & Password -->
                <el-dialog title="New Patient Username and Password" :visible.sync="openAddDialog" width="30%" :before-close="closeAddDialog">
                    <label>Fsn</label>
                    <el-input class="mb-2" v-model="newUser.fsn" disabled></el-input>
                    <label>Password</label>
                    <el-input class="mb-2" v-model="newUser.password" disabled></el-input>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="primary" @click="closeAddDialog">Close</el-button>
                    </span>
                </el-dialog>

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
                    openAddDialog: false,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    avatar: "",
                    newUser: [],
                    addPatient: {
                        id: 0,
                        fsn: "",
                        firstName: "",
                        middleName: "",
                        lastName: "",
                        suffix: "",
                        birthDate: "",
                        gender: "",
                        phoneNo: "",
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
                        age: "",
                        nhts: "",
                        pantawid: "",
                        hhNo: "",
                        alert: "",
                        otherAlert: "",
                        medicalHistory: "",
                        otherHistory: "",
                        encounter: "",
                        consultationType: "",
                        otherConsultation: "",
                        appointment: "",
                        age: "",
                        transaction: "",
                        s: "",
                        o: "",
                        pr: "",
                        rr: "",
                        bp: "",
                        weight: "",
                        height: "",
                        temp: "",
                        a: "",
                        p: "",
                    },
                    immunize: {
                        childNo: "",
                        mLastName: "",
                        mFirstName: "",
                        mMidName: "",
                        fLastName: "",
                        fFirstName: "",
                        fMidName: "",
                        purok: "",
                        barangay: "",
                        appointment: "",
                        age: "",
                        temp: "",
                        immunizationGiven: "",
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
                        phoneNo: [ {
                            pattern: /^(09|\+639)\d{9}$/,
                            message: 'Invalid phone number format!',
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
                        telephone: [{
                            required: true,
                            message: 'Telephone is required!',
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
                        blood: [{
                            required: true,
                            message: 'Blood type is required!',
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
                            required: true,
                            message: 'Mother middle name is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[a-zA-Z ]*$/,
                            message: 'Invalid middle name format!',
                            trigger: 'blur'
                        }],
                        nhts: [{
                            required: true,
                            message: 'NHTS is required!',
                            trigger: 'blur'
                        }],
                        pantawid: [{
                            required: true,
                            message: 'Pantawid pamilya member is required!',
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
                        encounter: [{
                            required: true,
                            message: 'Encounter type is required!',
                            trigger: 'blur'
                        }],
                        consultationType: [{
                            required: true,
                            message: 'Consultation type is required!',
                            trigger: 'blur'
                        }],
                        appointment: [{
                            required: true,
                            message: 'Consultation date is required!',
                            trigger: 'blur'
                        }],
                        age: [{
                            required: true,
                            message: 'Age is required!',
                            trigger: 'blur'
                        }],
                        transaction: [{
                            required: true,
                            message: 'Mode of transaction is required!',
                            trigger: 'blur'
                        }],
                        pr: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid pulse rate (PR) format!',
                            trigger: 'blur'
                        }],
                        rr: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid respiratory rate (RR) format!',
                            trigger: 'blur'
                        }],
                        bp: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid blood pressure (BP) format!',
                            trigger: 'blur'
                        }],
                        weight: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid weight format!',
                            trigger: 'blur'
                        }],
                        height: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid height format!',
                            trigger: 'blur'
                        }],
                        temp: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid temperature format!',
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
                            required: true,
                            message: 'Mother middle name is required!',
                            trigger: 'blur'
                        }, {
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
                            required: true,
                            message: 'Father middle name is required!',
                            trigger: 'blur'
                        }, {
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
                        temp: [{
                            required: true,
                            message: 'Temperature is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid temperature format!',
                            trigger: 'blur'
                        }],
                        immunizationGiven: [{
                            required: true,
                            message: 'Immunization Given is required!',
                            trigger: 'blur'
                        }],
                    },
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
                closeAddDialog() {
                    this.$confirm('Done copying username & password?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openAddDialog = false
                        })
                        .catch(() => {});
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
                            this.immunize.age = age;
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
                submitHealth(health) {
                    this.$refs[health].validate((valid) => {
                        if (valid) {
                            console.log(this.addPatient, "healthcheck")
                        } else {

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
                            }
                        })
                },
                submitImmunization(immunize) {
                    this.$refs[immunize].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("fsn", this.addPatient.fsn)
                            newData.append("child_no", this.immunize.childNo)
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("middle_name", this.addPatient.middleName)
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("suffix", this.addPatient.suffix)
                            newData.append("birthdate", this.addPatient.birthDate)
                            newData.append("gender", this.addPatient.gender)
                            newData.append("m_lastname", this.immunize.mLastName)
                            newData.append("m_firstname", this.immunize.mFirstName)
                            newData.append("m_middlename", this.immunize.mMidName)
                            newData.append("f_lastname", this.immunize.fLastName)
                            newData.append("f_firstname", this.immunize.fFirstName)
                            newData.append("f_middlename", this.immunize.fMidName)
                            newData.append("purok", this.immunize.purok)
                            newData.append("barangay", this.immunize.barangay)
                            newData.append("appointment", this.immunize.appointment)
                            newData.append("age", this.immunize.age)
                            newData.append("temp", this.immunize.temp)
                            newData.append("immunization_given", this.immunize.immunizationGiven)
                            axios.post("action.php?action=storeImmunization", newData)
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
                                        setTimeout(() => {
                                            window.location.href = "./"
                                        }, 1000)
                                    }
                                })
                            console.log(this.addPatient, "healthcheck")
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                    console.log(this.addPatient, "immunization")
                },
                submitPrenatal(prenatal) {
                    this.$refs[prenatal].validate((valid) => {
                        if (valid) {
                            console.log(this.addPatient, "pregnancy")
                        } else {

                        }
                    })
                },
                resetForm(addPatient) {
                    this.$refs[addPatient].resetFields();
                    this.$refs[immunize].resetFields();
                },
                resetFormData() {
                    this.addPatient = []
                    this.immunize = []
                },
            }
        })
    </script>
    <script>
        function add_hyphen() {
            var input = document.getElementById("hhno");
            var str = input.value;
            str = str.replace("-", "");
            if (str.length > 10) {
                str = str.substring(0, 4) + "-" + str.substring(4, 11) + "-" + str.substring(10);
            }
            input.value = str
        }
    </script>
</body>

</html>
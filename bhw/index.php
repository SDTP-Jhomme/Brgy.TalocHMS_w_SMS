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
            header("Location: ../bhw/change-password");
        }
    } else {

        header("Location: ../bhw/login");
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
                <el-dialog v-if="addPatient.lastName && addPatient.firstName == this.last_name && this.first_name" title="New Patient Username and Password" :visible.sync="newPatientDialog" width="30%" :before-close="closeAddDialog">
                    <label class="text-primary">Username</label>
                    <el-input class="mb-2 text-dark" v-model="newUser.username" disabled></el-input>
                    <label class="text-primary">Password</label>
                    <el-input class="mb-2 text-dark" v-model="newUser.birthdate" disabled></el-input>
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
                return {
                    datePickerOptions: {
                        disabledDate(date) {
                            return date < new Date()
                        }
                    },
                    birthdayOptions: {
                        disabledDate(date) {
                            return date > new Date()
                        }
                    },

                    page: 1,
                    pageSize: 10,
                    showAllData: false,
                    tableLoad: false,
                    tableData: [],
                    active: 0,
                    currentRow: [],
                    fullscreenLoading: true,
                    addDialog: false,
                    newPatientDialog: false,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    isFamily: false,
                    avatar: "",
                    date: "",
                    viewPatient: "",
                    age: "",
                    checkFirstname: [],
                    checkLastname: [],
                    searchValue: "",
                    searchNull: "",
                    searchName: "",
                    searchContact: "",
                    options: [{
                        value: 'name',
                        label: 'Name'
                    }, {
                        value: 'phone_number',
                        label: 'Phone No.'
                    }],
                    newUser: [],
                    addSms: {
                        message: "",
                        appointment: "",
                    },
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
                        spouseFname: "",
                        spouseLname: "",
                        purok: "",
                        barangay: "Taloc",
                        gp: "",
                        lmp: "",
                        edc: "",
                        ttStatus: "",
                        appointment: "",
                        dateVisit: "",
                        weight: "",
                        cr: "",
                        bp: "",
                        temp: "",
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
                        street: "",
                        purok: "",
                        barangay: "Taloc",
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
                        barangay: "Taloc",
                        appointment: "",
                        age: "",
                        temp: "",
                        immunizationGiven: "",
                    },
                    family: {
                        purok: "",
                        barangay: "Taloc",
                        appointment: "",
                        spouseFname: "",
                        spouseLname: "",
                        spousePurok: "",
                        spouseBarangay: "",
                        heent: [],
                        weigth: "",
                        bp: "",
                        pr: "",
                        chLB: [],
                        conjunctive: [],
                        neck: [],
                        abdomen: [],
                        thorax: [],
                        femGenital: [],
                        maleGenital: [],
                    },
                    smsRules: {
                        appointment: [{
                            required: true,
                            message: 'Appointment is required!',
                            trigger: 'blur'
                        }],
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
                        phoneNo: [{
                            required: true,
                            message: 'Phone number is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^(09|\+639)\d{9}$/,
                            message: 'Invalid phone number format!',
                            trigger: 'blur'
                        }],
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
                        dateVisit: [{
                            required: true,
                            message: 'Date is required!',
                            trigger: 'blur'
                        }],
                        cr: [{
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
                            message: 'Invalid fundic height format!',
                            trigger: 'blur'
                        }],
                        temp: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid temperature format!',
                            trigger: 'blur'
                        }],
                        aog: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid aog format!',
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
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid pulse rate (PR) format!',
                            trigger: 'blur'
                        }],
                        rr: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid respiratory rate (RR) format!',
                            trigger: 'blur'
                        }],
                        bp: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid blood pressure (BP) format!',
                            trigger: 'blur'
                        }],
                        weight: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid weight format!',
                            trigger: 'blur'
                        }],
                        height: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid height format!',
                            trigger: 'blur'
                        }],
                        temp: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
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
                        temp: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid temperature format!',
                            trigger: 'blur'
                        }],
                        weight: [{
                            pattern: /^[\.0-9]*$/,
                            message: 'Invalid weight format!',
                            trigger: 'blur'
                        }],
                    },
                    familyRules: {
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
                        bp: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid blood pressure (BP) format!',
                            trigger: 'blur'
                        }],
                        weight: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid weight format!',
                            trigger: 'blur'
                        }],
                        pr: [{
                            pattern: /^[0-9]+(\/[0-9]+)*$/,
                            message: 'Invalid pulse rate (PR) format!',
                            trigger: 'blur'
                        }],
                    }
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
                this.age = localStorage.age ? localStorage.age : 0


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
                this.family.appointment = localStorage.date ? localStorage.date : "January 01, 1970"
            },
            watch: {
                searchValue(value) {
                    if (value == "" || value == "name" || value == "phone_number") {
                        this.searchNull = '';
                        this.searchName = '';
                        this.searchContact = '';
                    }
                },
                showAllData(value) {
                    if (value == true) {
                        this.page = 1;
                        this.pageSize = this.tableData.length
                    } else {
                        this.pageSize = 10
                    }
                },
            },
            computed: {
                usersTable() {
                    return this.tableData
                        .filter((data) => {
                            return data.first_name.toLowerCase().includes(this.searchName.toLowerCase());
                        })
                        .filter((data) => {
                            return data.phone_number.toLowerCase().includes(this.searchContact.toLowerCase());
                        })
                        .slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
                }
            },
            methods: {
                // Logout **********************************************************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
                                localStorage.clear();
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
                handleCurrentChange(val) {
                    this.currentRow = val;
                },
                handleOpen(key, keyPath) {
                    console.log(key, keyPath);
                },
                handleClose(key, keyPath) {
                    console.log(key, keyPath);
                },
                closeAddDialog() {
                    this.$confirm('Are you sure you want to cancel?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.addDialog = false
                            this.$refs[addPatient].resetFields();
                            localStorage.removeItem("first_name")
                            localStorage.removeItem("last_name")
                        })
                        .catch(() => {});
                },
                resetForm(addPatient) {
                    this.$refs[addPatient].resetFields();
                },
                resetFormData() {
                    this.addPatient = []
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
                    axios.post("action.php?action=fetch_patient")
                        .then(response => {
                            console.log(response)
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                            }
                        })
                },
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchContact = ""
                },
                setPage(value) {
                    this.page = value
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
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
                // setCurrent(index, row) {
                //     this.active++;
                //     this.$refs.tableData.setCurrentRow(row);
                //     this.age = this.calculateAge(this.currentRow.birthdate);

                //     localStorage.setItem("active", this.active)
                //     localStorage.setItem("currentRow", JSON.stringify(this.currentRow))
                //     this.isHealthCheckup = false;
                //     this.isImmunization = false;
                //     this.isPregnancy = false;

                //     localStorage.setItem("age", this.age);
                //     this.health.age = this.age;
                //     this.immunize.age = this.age;
                // },
                proceed(addPatient) {
                    this.$refs[addPatient].validate((valid) => {
                        if (valid) {
                            this.active++;
                            this.age = this.calculateAge(this.addPatient.birthDate);

                            localStorage.setItem("active", this.active)
                            localStorage.setItem("addPatient", JSON.stringify(this.addPatient))
                            this.isHealthCheckup = false;
                            this.isImmunization = false;
                            this.isPregnancy = false;
                            this.isFamily = false;

                            localStorage.setItem("age", this.age);
                            this.health.age = this.age;
                            this.immunize.age = this.age;
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
                            localStorage.removeItem("age")
                            localStorage.setItem("active", this.active)
                        }
                    } else {
                        this.active--
                    }
                },
                next() {
                    if (this.isHealthCheckup) {
                        localStorage.setItem("isHealthCheckup", this.isHealthCheckup)
                    } else if (this.isImmunization) {
                        localStorage.setItem("isImmunization", this.isImmunization)
                    } else if (this.isPregnancy) {
                        localStorage.setItem("isPregnancy", this.isPregnancy)
                    } else if (this.isFamily) {
                        localStorage.setItem("isFamily", this.isFamily)
                    }

                    if (this.isHealthCheckup || this.isImmunization || this.isPregnancy || this.isFamily) {
                        this.active++;
                        localStorage.setItem("active", this.active)
                    } else {
                        this.$message.error("Please select an appointment!");
                    }
                },
                healthCheckup() {
                    this.isFamily = false
                    this.isPregnancy = false;
                    this.isImmunization = false;
                    this.isHealthCheckup = !this.isHealthCheckup;
                },
                immunization() {
                    this.isFamily = false
                    this.isPregnancy = false;
                    this.isImmunization = !this.isImmunization;
                    this.isHealthCheckup = false;
                },
                pregnancy() {
                    this.isFamily = false
                    this.isPregnancy = !this.isPregnancy;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                },
                familyPlaninng() {
                    this.isFamily = !this.isFamily;
                    this.isPregnancy = false;
                    this.isImmunization = false;
                    this.isHealthCheckup = false;
                },
                sendSms(addSms) {
                    this.$refs[addSms].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            const date = this.addSms.appointment;
                            let weekDay = date.getDay();
                            const newDate = date.getFullYear() + "-" + ((date.getMonth() + 1) > 9 ? '' : '0') + (date.getMonth() + 1) + "-" + (date.getDate() > 9 ? '' : '0') + date.getDate();
                            switch (weekDay) {
                                case 0:
                                    weekDay = "Sunday"
                                    break;
                                case 1:
                                    weekDay = "Monday"
                                    break;
                                case 2:
                                    weekDay = "Tuesday"
                                    break;
                                case 3:
                                    weekDay = "Wednesday"
                                    break;
                                case 4:
                                    weekDay = "Thursday"
                                    break;
                                case 5:
                                    weekDay = "Friday"
                                    break;
                                case 6:
                                    weekDay = "Saturday"
                                    break;
                                default:
                                    break;
                            }
                            this.openAddDrawer = false;
                            var newData = new FormData()
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("contact", this.addPatient.phoneNo)
                            newData.append("message", this.addSms.message)
                            newData.append("appointment", newDate)
                            newData.append("weekDay", weekDay)
                            axios.post("action.php?action=sent_message", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'Appointment Date sent successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                        }, 1500);
                                        this.resetFormData();
                                        this.loadButton = false;
                                    }
                                })
                            if (this.active++ > 2) this.active = 0;
                            this.loadButton = true;
                        } else {
                            this.$message.error("Cannot submit the message. Please check the error(s).")
                            return false;
                        }
                    });
                },
                resetFormData() {
                    this.addSms = []
                },
                submitHealth(health) {
                    this.$refs[health].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("phone_number", this.addPatient.phoneNo)
                            newData.append("fsn", this.addPatient.fsn)
                            newData.append("clinisys", this.health.clinisysFSN)
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("middle_name", this.addPatient.middleName)
                            newData.append("suffix", this.addPatient.suffix)
                            newData.append("birthdate", this.addPatient.birthDate)
                            newData.append("gender", this.addPatient.gender)
                            newData.append("civil_status", this.health.civil)
                            newData.append("spouse", this.health.spouse)
                            newData.append("educ_attainment", this.health.education)
                            newData.append("employment_status", this.health.employment)
                            newData.append("occupation", this.health.occupation)
                            newData.append("religion", this.health.religion)
                            newData.append("phone_number", this.addPatient.phoneNo)
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
                            newData.append("encounter_type", this.health.encounter)
                            newData.append("consultation_type", this.health.consultationType)
                            newData.append("consultation_date", this.health.appointment)
                            newData.append("age", this.health.age)
                            newData.append("transaction_mode", this.health.transaction)
                            newData.append("s", this.health.s)
                            newData.append("o", this.health.o)
                            newData.append("pr", this.health.pr)
                            newData.append("rr", this.health.rr)
                            newData.append("bp", this.health.bp)
                            newData.append("weight", this.health.weight)
                            newData.append("height", this.health.height)
                            newData.append("temp", this.health.temp)
                            newData.append("a", this.health.a)
                            newData.append("p", this.health.p)
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
                                            this.getData()
                                            setTimeout(() => {
                                                this.newPatientDialog = true;
                                            }, 1000)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                            this.active++;
                            localStorage.setItem("active", this.active)
                            console.log(this.healthCheckup, "healthcheck")
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                },
                submitImmunization(immunize) {
                    this.$refs[immunize].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("phone_number", this.addPatient.phoneNo)
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
                            newData.append("weight", this.immunize.weight)
                            newData.append("temp", this.immunize.temp)
                            newData.append("immunization_given", this.immunize.immunizationGiven)
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
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                            this.active++;
                            localStorage.setItem("active", this.active)
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                },
                submitPrenatal(prenatal) {
                    this.$refs[prenatal].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("phone_number", this.addPatient.phoneNo)
                            newData.append("fsn", this.addPatient.fsn)
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("middle_name", this.addPatient.middleName)
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("birthdate", this.addPatient.birthDate)
                            newData.append("gender", this.addPatient.gender)
                            newData.append("spouse_lastname", this.prenatal.spouseLname)
                            newData.append("spouse_firstname", this.prenatal.spouseFname)
                            newData.append("purok", this.prenatal.purok)
                            newData.append("barangay", this.prenatal.barangay)
                            newData.append("gp", this.prenatal.gp)
                            newData.append("lmp", this.prenatal.lmp)
                            newData.append("edc", this.prenatal.edc)
                            newData.append("tt_status", this.prenatal.ttStatus)
                            newData.append("appointment", this.prenatal.appointment)
                            newData.append("date_visit", this.prenatal.appointment)
                            newData.append("weight", this.prenatal.weight)
                            newData.append("bp", this.prenatal.bp)
                            newData.append("cr", this.prenatal.cr)
                            newData.append("rr", this.prenatal.rr)
                            newData.append("temp", this.prenatal.temp)
                            newData.append("aog", this.prenatal.aog)
                            newData.append("height", this.prenatal.height)
                            newData.append("fhb", this.prenatal.fhb)
                            newData.append("presentation", this.prenatal.presentation)
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
                                                this.newPatientDialog = true;
                                            }, 1000)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                            this.active++;
                            localStorage.setItem("active", this.active)

                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                },
                submitFamily(family) {
                    this.$refs[family].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("phone_number", this.addPatient.phoneNo)
                            newData.append("fsn", this.addPatient.fsn)
                            newData.append("first_name", this.addPatient.firstName)
                            newData.append("middle_name", this.addPatient.middleName)
                            newData.append("last_name", this.addPatient.lastName)
                            newData.append("birthdate", this.addPatient.birthDate)
                            newData.append("gender", this.addPatient.gender)
                            newData.append("spouse_lastname", this.family.spouseLname)
                            newData.append("spouse_firstname", this.family.spouseFname)
                            newData.append("spouse_purok", this.family.spousePurok)
                            newData.append("spouse_barangay", this.family.spouseBarangay)
                            newData.append("purok", this.family.purok)
                            newData.append("barangay", this.family.barangay)
                            newData.append("appointment", this.family.appointment)
                            newData.append("weight", this.family.weight)
                            newData.append("bp", this.family.bp)
                            newData.append("pr", this.family.pr)
                            newData.append("heent", this.family.heent)
                            newData.append("chLB", this.family.chLB)
                            newData.append("conjunctive", this.family.conjunctive)
                            newData.append("neck", this.family.neck)
                            newData.append("abdomen", this.family.abdomen)
                            newData.append("thorax", this.family.thorax)
                            newData.append("femGenital", this.family.femGenital)
                            newData.append("maleGenital", this.family.maleGenital)
                            axios.post("store-action.php?action=storeFamily", newData)
                                .then(response => {
                                    console.log(response)
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New family planning form has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData();
                                            setTimeout(() => {
                                                this.newPatientDialog = true;
                                            }, 1000)
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                            this.active++;
                            localStorage.setItem("active", this.active)

                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    })
                },
            }
        })
    </script>
</body>

</html>
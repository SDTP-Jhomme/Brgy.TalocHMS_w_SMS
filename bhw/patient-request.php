<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Patient Request</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];

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
                    <el-header class="mt-4" height="40">
                        <h1 class="mt-4">Patient(s) Request Table</h1>
                        <div class="card mb-5">
                            <div class="card-body text-primary">
                                Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                            </div>
                        </div>
                    </el-header>
                    <el-main>
                        <div class="container border rounded p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex">
                                    <el-select v-model="searchValue" size="mini" placeholder="Select Column" @changed="changeColumn" clearable>
                                        <el-option v-for="search in options" :key="search.value" :label="search.label" :value="search.value">
                                        </el-option>
                                    </el-select>
                                    <div class="ps-2">
                                        <div v-if="searchValue == 'fsn'">
                                            <el-input v-model="searchID" size="mini" placeholder="Type to search..." clearable />
                                        </div>
                                        <div v-else-if="searchValue == 'name'">
                                            <el-input v-model="searchName" size="mini" placeholder="Type to search..." clearable />
                                        </div>
                                        <div v-else>
                                            <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                <el-table-column label="No." type="index" width="50">
                                </el-table-column>
                                <el-table-column sortable label="FSN" prop="fsn">
                                </el-table-column>
                                <el-table-column sortable label="Date Requested" prop="date">
                                </el-table-column>
                                <el-table-column sortable label="Name" width="220" prop="name">
                                </el-table-column>
                                <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                    <template slot-scope="scope">
                                        <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                        <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                    </template>
                                </el-table-column>
                                <el-table-column sortable label="Section" prop="section" width="200" column-key="section" :filters="[{text: 'Maternity', value: 'Maternity'}, {text: 'Individual Treatment', value: 'Individual Treatment'}, {text: 'Immunization', value: 'Immunization'}]" :filter-method="filterHandler">
                                    <template slot-scope="scope">
                                        <el-tag size="small" v-if="scope.row.section == 'Maternity'">{{ scope.row.section }}</el-tag>
                                        <el-tag size="small" v-else-if="scope.row.section == 'Individual Treatment'" type="success">{{ scope.row.section }}</el-tag>
                                        <el-tag size="small" v-else type="danger">{{ scope.row.section }}</el-tag>
                                    </template>
                                </el-table-column>
                                <el-table-column sortable label="Status" width="110" prop="status">
                                    <template slot-scope="scope">
                                        <el-tag size="small" v-if="scope.row.status == 'Pending'" type="warning">{{ scope.row.status }}</el-tag>
                                        <el-tag size="small" v-else type="success">{{ scope.row.status }}</el-tag>
                                    </template>
                                </el-table-column>
                                <el-table-column label="Actions" width="140">
                                    <template slot-scope="scope">
                                        <el-tooltip class="item" effect="dark" content="View Details" placement="top-start">
                                            <el-button icon="el-icon-view" v-if="scope.row.section == 'Maternity'" size="mini" @click="handleView(scope.$index, scope.row)" plain>View Details</el-button>
                                            <el-button icon="el-icon-view" v-else-if="scope.row.section == 'Individual Treatment'" size="mini" type="success" @click="handleView(scope.$index, scope.row)" plain>View Details</el-button>
                                            <el-button icon="el-icon-view" v-else size="mini" type="danger" @click="handleView(scope.$index, scope.row)" plain>View Details</el-button>
                                        </el-tooltip>
                                    </template>
                                </el-table-column>
                            </el-table>
                            <div class="d-flex justify-content-between mt-2">
                                <el-checkbox v-model="showAllData">Show All</el-checkbox>
                                <el-pagination :current-page.sync="page" :pager-count="5" :page-size="this.pageSize" background layout="prev, pager, next" :total="this.tableData.length" @current-change="setPage">
                                </el-pagination>
                            </div>
                        </div>
                    </el-main>
                    <el-dialog :visible.sync="viewDialog" width="70%" :before-close="closeViewDialog">
                        <template #title>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pe-4">
                                    <el-avatar :size="70" :src="viewPatient.avatar"></el-avatar>
                                </div>
                            </div>
                        </template>
                        <div class="container">
                            <div v-if="viewPatient.section == 'Maternity'">
                                <?php include("./prenatal-request.php") ?>
                            </div>
                            <div v-else-if="viewPatient.section == 'Individual Treatment'">
                                <?php include("./health-request.php") ?>
                            </div>
                            <div v-else>
                                <?php include("./immunization-request.php") ?>
                            </div>
                        </div>
                        <span slot="footer" class="dialog-footer">
                            <div v-if="viewPatient.section == 'Maternity'">
                                <el-button size="medium" @click="closeViewDialog('addDetails')">Cancel</el-button>
                                <el-button size="medium" type="warning" @click="smsDialog=true">Set Appointment</el-button>
                                <el-button size="medium" :loading="loadButton" @click="submitPrenatal('prenatal')">Save</el-button>
                            </div>
                            <div v-else-if="viewPatient.section == 'Individual Treatment'">
                                <el-button size="medium" @click="closeViewDialog('addDetails')">Cancel</el-button>
                                <el-button size="medium" type="warning" @click="smsDialog=true">Set Appointment</el-button>
                                <el-button size="medium" :loading="loadButton" type="success" @click="submitHealth('health')">Save</el-button>
                            </div>
                            <div v-else>
                                <el-button size="medium" @click="closeViewDialog('addDetails')">Cancel</el-button>
                                <el-button size="medium" type="warning" @click="smsDialog=true">Send Appointment</el-button>
                                <el-button size="medium" :loading="loadButton" type="danger" @click="submitImmunization('immunize')">Save</el-button>
                            </div>
                        </span>
                    </el-dialog>
                    <el-dialog :visible.sync="smsDialog" width="50%" :before-close="closeSmsDialog">
                        <template #title>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fs-5">User {{ viewPatient.first_name }}</div>
                                <div class="pe-4">
                                    <el-avatar :size="70" :src="viewPatient.avatar"></el-avatar>
                                </div>
                            </div>
                        </template>
                        <div class="container">
                            <el-form :model="addSms" :rules="smsRules" ref="addSms">
                                <div class="row underline-input">
                                    <div class="col-auto">
                                        <el-header>
                                            <h4>Send Appointments</h4>
                                        </el-header>
                                    </div>
                                    <div class="col-auto">
                                        <el-form-item class="" label="Send To :" prop="phone_number">
                                            <el-input v-model="viewPatient.phone_number" clearable disabled></el-input>
                                        </el-form-item>
                                    </div>
                                </div>
                                <div>
                                    <el-divider></el-divider>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-9">
                                        <el-form-item prop="appointment">
                                            <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date">
                                            </el-date-picker>
                                        </el-form-item>
                                    </div>
                                </div>
                                <div>
                                    <el-divider></el-divider>
                                </div>
                            </el-form>
                        </div>
                        <span slot="footer" class="dialog-footer">
                            <el-button :loading="loadButton" type="primary" @click="sendSMS('addSms')" size="small" icon="el-icon-position">Send</el-button>
                            <el-button @click="closeSmsDialog('addSms')" size="small">Cancel</el-button>
                        </span>
                    </el-dialog>
                </div>
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
                    page: 1,
                    pageSize: 10,
                    showAllData: false,
                    tableLoad: false,
                    tableData: [],
                    viewDialog: false,
                    loadButton: false,
                    fullscreenLoading: true,
                    openAddDialog: false,
                    backToHome: false,
                    isHealthCheckup: false,
                    isImmunization: false,
                    isPregnancy: false,
                    avatar: "",
                    smsDialog: false,
                    viewPatient: [],
                    viewImmunization: [],
                    checkIdentification: [],
                    searchValue: "",
                    searchNull: "",
                    searchName: "",
                    searchID: "",
                    searchContact: "",
                    options: [{
                        value: 'fsn',
                        label: 'FSN No.'
                    }, {
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
                    prenatal: {
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
                        appointment: "",
                        age: "",
                        temp: "",
                        immunizationGiven: "",
                    },
                    smsRules: {
                        message: [{
                            required: true,
                            message: 'Message is required!',
                            trigger: 'blur'
                        }, {
                            min: 2,
                            message: 'Message should atleast two(2) characters!',
                            trigger: 'blur'
                        }],
                        appointment: [{
                            required: true,
                            message: 'Appointment is required!',
                            trigger: 'blur'
                        }],
                    },
                    prenatalRules: {
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
                }
            },
            created() {
                this.fetchAvatar()
                this.getData()
                this.getImmunization()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
                if (window.location.pathname != "/caps/capstone-new/bhw/") {
                    localStorage.clear()
                    this.backToHome = true;
                }
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
            watch: {
                searchValue(value) {
                    if (value == "" || value == "fsn" || value == "name" || value == "phone_number") {
                        this.searchNull = '';
                        this.searchID = '';
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
                            return data.fsn.toLowerCase().includes(this.searchID.toLowerCase());
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
                closeViewDialog(addDetails) {
                    this.$confirm('Are you sure you want to cancel?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.viewDialog = false
                            this.$refs[addDetails].resetFields();
                            localStorage.removeItem("fsn")
                        })
                        .catch(() => {});
                },
                closeSmsDialog(addSms) {
                    this.$confirm('Are you sure you want to cancel send message?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.smsDialog = false
                            this.$refs[addSms].resetFields();
                            localStorage.removeItem("fsn")
                        })
                        .catch(() => {});
                },
                handleView(index, row) {
                    this.viewImmunization = row;
                    this.viewPatient = row;
                    this.viewDialog = true;

                    localStorage.setItem("viewPatient", JSON.stringify(this.viewPatient))

                    var today = new Date();
                    var birthDate = new Date(this.viewPatient.birthdate);
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    localStorage.setItem("age", age);
                    this.health.age = age;
                    this.immunize.age = age;
                },
                handleOpen(key, keyPath) {
                    console.log(key, keyPath);
                },
                handleClose(key, keyPath) {
                    console.log(key, keyPath);
                },
                closeAddDialog() {
                    this.$confirm('Done copying username & password?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openAddDialog = false
                            setTimeout(() => {
                                this.fullscreenLoading = true
                            }, 1000)
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
                getData() {
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                this.checkIdentification = response.data.map(res => res.fsn)
                            }
                        })
                },
                getImmunization() {
                    axios.post("action.php?action=fetchImmunization")
                        .then(response => {
                            console.log(response)
                            if (response.data.error) {
                                this.viewImmunization.m_lastname = response.data
                            }
                        })
                },
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchContact = ""
                },
                setPage(value) {
                    this.page = value
                },
                handleSelectionChange(val) {
                    this.multiID = Object.values(val).map(i => i.id)
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                sendSMS(addSms) {
                    this.$refs[addSms].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("first_name", this.viewPatient.first_name)
                            newData.append("last_name", this.viewPatient.last_name)
                            newData.append("contact", this.viewPatient.phone_number)
                            newData.append("appointment", this.addSms.appointment)
                            axios.post("action.php?action=sent_message", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.loadButton = false;
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'Message sent successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                        }, 1500);
                                        this.resetFormData();
                                        this.loadButton = false;
                                        this.smsDialog = false;
                                    }
                                })
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
                            newData.append("fsn", this.viewPatient.fsn)
                            newData.append("clinisys", this.health.clinisysFSN)
                            newData.append("last_name", this.viewPatient.lastName)
                            newData.append("first_name", this.viewPatient.firstName)
                            newData.append("middle_name", this.viewPatient.middleName)
                            newData.append("suffix", this.viewPatient.suffix)
                            newData.append("birthdate", this.viewPatient.birthDate)
                            newData.append("gender", this.viewPatient.gender)
                            newData.append("civil", this.health.civil)
                            newData.append("spouse", this.health.spouse)
                            newData.append("educ_attainment", this.health.education)
                            newData.append("employment_status", this.health.employment)
                            newData.append("occupation", this.health.occupation)
                            newData.append("religion", this.health.religion)
                            newData.append("telephone", this.addPatient.phoneNo)
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
                                            this.getData();
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false
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
                submitImmunization(immunize) {
                    this.$refs[immunize].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("fsn", this.viewPatient.fsn)
                            newData.append("child_no", this.immunize.childNo)
                            newData.append("first_name", this.viewPatient.firstName)
                            newData.append("middle_name", this.viewPatient.middleName)
                            newData.append("last_name", this.viewPatient.lastName)
                            newData.append("suffix", this.viewPatient.suffix)
                            newData.append("birthdate", this.viewPatient.birthDate)
                            newData.append("gender", this.viewPatient.gender)
                            newData.append("m_lastname", <?php echo $m_lastname ?>)
                            newData.append("m_firstname", <?php echo $m_firstname ?>)
                            newData.append("m_middlename", <?php echo $m_middlename ?>)
                            newData.append("f_lastname", <?php echo $f_lastname ?>)
                            newData.append("f_firstname", <?php echo $f_firstname ?>)
                            newData.append("f_middlename", <?php echo $f_middlename ?>)
                            newData.append("purok", <?php echo $purok ?>)
                            newData.append("barangay", <?php echo $barangay ?>)
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
                                        this.loadButton = true;
                                    }
                                })
                            this.active++;
                            localStorage.setItem("active", this.active)
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
                            this.loadButton = true;
                            var newData = new FormData()
                            newData.append("fsn", this.viewPatient.fsn)
                            newData.append("first_name", this.viewPatient.firstName)
                            newData.append("middle_name", this.viewPatient.middleName)
                            newData.append("last_name", this.viewPatient.lastName)
                            newData.append("birthdate", this.viewPatient.birthDate)
                            newData.append("gender", this.viewPatient.gender)
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
                                        }, 1500);
                                        this.newUser = response.data;
                                        this.loadButton = false
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
                resetForm(addPatient) {
                    this.$refs[addPatient].resetFields();
                },
                resetFormData() {
                    this.addPatient = []
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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Sms Notification</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];
        $time = time();
        $admin_record = mysqli_query($db, "SELECT * FROM admin where id='$id'");

        while ($admin_row = mysqli_fetch_assoc($admin_record)) {

            $db_username = $admin_row["username"];
            $logged_admin = ucfirst($db_username);
        }
    } else {

        header("Location: ./login");
        die();
    } ?>
</head>

<body class="sb-nav-fixed">
    <div id="app">
        <?php include("./import/nav.php"); ?>
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <el-container>
                        <el-header class="mt-4" height="40">
                            <h1 class="mt-4">Send SMS</h1>
                            <div class="card mb-4">
                                <div class="card-body text-primary">
                                    Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                </div>
                            </div>
                            <div class="container p-0">
                                <el-row :gutter="20">
                                    <el-col :span="12">
                                        <el-button icon="el-icon-position" size="mini" type="danger" @click="bulkSms()">Text Blast</el-button>
                                    </el-col>
                                </el-row>
                            </div>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="mb-0"></p>
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
                                            <div v-else-if="searchValue == 'phone_number'">
                                                <el-input v-model="searchContact" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else>
                                                <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading" ref="myTable">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column label="FSN" width="50" prop="fsn">
                                    </el-table-column>
                                    <el-table-column sortable label="Date Visited" prop="date">
                                    </el-table-column>
                                    <el-table-column sortable label="Name" width="220" prop="name">
                                    </el-table-column>
                                    <el-table-column sortable label="Phone No." width="220" prop="phone_number">
                                    </el-table-column>
                                    <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                        <template slot-scope="scope">
                                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Actions" width="150">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="Send Message" placement="top-start">
                                                <el-button icon="el-icon-position" size="mini" type="success" @click="handleView(scope.$index, scope.row)">Send Sms</el-button>
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

                        <!----------------------------------------------------------------------------------- Modals/Drawers ----------------------------------------------------------------------------------->
                        <!-- View Dialog -->
                        <el-dialog :visible.sync="viewDialog" width="70%" :before-close="closeViewDialog">
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
                                        <div class="col-8">
                                            <el-header>
                                                <h4>Appointments</h4>
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
                                    <div class="row underline-input">
                                        <div class="col-7">
                                            <el-form-item label="Event Date(s) / Appointment(s)" prop="appointment">
                                                <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date" :picker-options="datePickerOptions">
                                                </el-date-picker>
                                            </el-form-item>
                                        </div>
                                        <div class="col-5">
                                            <el-form-item label="Message :" prop="message">
                                                <el-input v-model="addSms.message" type="textarea" placeholder="Message here" clearable></el-input>
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
                                <el-button @click="closeViewDialog('addSms')" size="small">Cancel</el-button>
                            </span>
                        </el-dialog>

                        <!-- bulksend -->
                        <el-dialog :visible.sync="smsDialog" width="70%" :before-close="closeSmsDialog">
                            <div class="container">
                                <el-form :model="addSms" :rules="smsRules" ref="addSms">
                                    <div class="row underline-input">
                                        <div class="col-8">
                                            <el-header>
                                                <h4>Health Center Event(s)</h4>
                                            </el-header>
                                        </div>
                                    </div>
                                    <div>
                                        <el-divider></el-divider>
                                    </div>
                                    <div class="row underline-input">
                                        <div class="col-7">
                                            <el-form-item label="Event Date(s) / Appointment(s)" prop="appointment">
                                                <el-date-picker size="medium" v-model="addSms.appointment" type="date" placeholder="Select Date">
                                                </el-date-picker>
                                            </el-form-item>
                                        </div>
                                        <div class="col-5">
                                            <el-form-item label="Message :" prop="message">
                                                <el-input v-model="addSms.message" type="textarea" placeholder="Message here" clearable></el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div>
                                        <el-divider></el-divider>
                                    </div>
                                </el-form>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button :loading="loadButton" type="primary" @click="sendSms('addSms')" size="small" icon="el-icon-position">Send</el-button>
                                <el-button @click="closeSmsDialog('addSms')" size="small">Cancel</el-button>
                            </span>
                        </el-dialog>
                        <!----------------------------------------------------------------------------------- End of Modals/Drawers ----------------------------------------------------------------------------------->
                    </el-container>
                </main>
                <?php include("./import/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php include("./import/body.php"); ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                const today = new Date();
                return {
                    datePickerOptions: {
                        disabledDate(date) {
                            return date < new Date()
                        }
                    },
                    addSms: {
                        multiNumber: [],
                        message: "",
                        appointment: "",
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
                    page: 1,
                    pageSize: 10,
                    showAllData: false,
                    searchValue: "",
                    searchNull: "",
                    searchName: "",
                    searchID: "",
                    searchContact: "",
                    topLabel: "top",
                    leftLabel: "left",
                    tableLoad: false,
                    loadButton: false,
                    viewDialog: false,
                    smsDialog: false,
                    multipleSelection: [],
                    fullscreenLoading: true,
                    tableData: [],
                    checkIdentification: [],
                    viewPatient: [],
                    options: [{
                        value: 'fsn',
                        label: 'FSN No.'
                    }, {
                        value: 'name',
                        label: 'Name'
                    }, {
                        value: 'phone_number',
                        label: 'Phone No.'
                    }, ]
                }
            },
            computed: {
                usersTable() {
                    return this.tableData
                        .filter((data) => {
                            return data.name.toLowerCase().includes(this.searchName.toLowerCase());
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
            created() {
                this.getData()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
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
            methods: {
                // Logout ***********************************************
                logout() {
                    this.fullscreenLoading = true
                    axios.post("auth.php?action=logout")
                        .then(response => {
                            if (response.data.message) {
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
                // ******************************************************
                handleSelectionChange(val) {
                    this.addSms.multiNumber = Object.values(val).map(i => i.phone_number)
                    console.log(this.addSms.multiNumber)
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                closeSmsDialog() {
                    this.smsDialog = false;
                },
                closeViewDialog() {
                    this.viewDialog = false;
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
                closeViewDialog(addSms) {
                    this.$confirm('Are you sure you want to cancel send message?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.viewDialog = false
                            this.$refs[addSms].resetFields();
                            localStorage.removeItem("fsn")
                        })
                        .catch(() => {});
                },
                setPage(value) {
                    this.page = value
                },
                getData() {
                    axios.post("sms-action.php?action=fetch_patient")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                this.checkIdentification = response.data.map(res => res.id)
                            }
                        })
                },
                handleView(index, row) {
                    this.viewPatient = row;
                    this.viewDialog = true;
                },
                sendSMS(addSms) {
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
                            var newData = new FormData()
                            newData.append("phone_number", this.viewPatient.phone_number)
                            newData.append("message", this.addSms.message)
                            newData.append("appointment", newDate)
                            newData.append("week_day", weekDay)
                            axios.post("sms-action.php?action=sent_message", newData)
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
                                        this.viewDialog = false;
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
                bulkSms() {
                    if (Object.keys(this.addSms.multiNumber).length === 0) {
                        this.$message.error("Please select aleast one(1) user to send message!")
                        console.log(this.addSms.multiNumber)
                    } else {
                        this.smsDialog = true

                    }
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
                            var newData = new FormData()
                            newData.append("number_blast", this.addSms.multiNumber)
                            newData.append("message", this.addSms.message)
                            newData.append("appointment", newDate)
                            newData.append("week_day", weekDay)
                            axios.post("sms-action.php?action=bulk_message", newData)
                                .then(response => {
                                    if (response.data) {
                                        console.log(response)
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
                                        this.addSms.multiNumber = []
                                        this.$refs.myTable.clearSelection();
                                    }
                                })
                        } else {
                            this.$message.error("Cannot submit the message. Please check the error(s).")
                            return false;
                        }
                    });
                },
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchContact = ""
                }
            }
        })
    </script>
</body>

</html>
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
                                <el-table-column sortable label="Date Requested" width="200" prop="date">
                                </el-table-column>
                                <el-table-column sortable label="Appointment Date" width="200" prop="appointment">
                                </el-table-column>
                                <el-table-column sortable label="Name" width="200" prop="name">
                                </el-table-column>
                                <el-table-column sortable label="Phone No." width="200" prop="phone_number">
                                </el-table-column>
                                <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                    <template slot-scope="scope">
                                        <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                        <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                    </template>
                                </el-table-column>
                                <el-table-column sortable label="Section" prop="section" width="190" column-key="section" :filters="[{text: 'Maternity', value: 'Maternity'}, {text: 'Individual Treatment', value: 'Individual Treatment'}, {text: 'Immunization', value: 'Immunization'}]" :filter-method="filterHandler">
                                    <template slot-scope="scope">
                                        <el-tag size="small" v-if="scope.row.section == 'Maternity'">{{ scope.row.section }}</el-tag>
                                        <el-tag size="small" v-else-if="scope.row.section == 'Individual Treatment'" type="success">{{ scope.row.section }}</el-tag>
                                        <el-tag size="small" v-else-if="scope.row.section == 'Immunization'" type="danger">{{ scope.row.section }}</el-tag>
                                        <el-tag size="small" v-else type="warning">{{ scope.row.section }}</el-tag>
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
                                            <el-button icon="el-icon-view" v-else-if="scope.row.section == 'Immunization'" size="mini" type="danger" @click="handleView(scope.$index, scope.row)" plain>View Details</el-button>
                                            <el-button icon="el-icon-view" v-else size="mini" type="warning" @click="handleView(scope.$index, scope.row)" plain>View Details</el-button>
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
                    smsDialog: false,
                    avatar: "",
                    viewPatient: [],
                    checkFsn: [],
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
                if (window.location.pathname != "/caps/capstone-new/bhw/") {
                    localStorage.clear()
                    this.backToHome = true;
                }
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
                closeResetDialog(addSms) {
                    this.$confirm('Are you sure you want to cancel setting new Appointment?', {
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
                handleView(index, row) {
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
                    const fetch = new FormData();
                    fetch.append("id", <?php echo $id; ?>)
                    axios.post("action.php?action=fetch_immunization", fetch)
                        .then(response => {
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
            }
        })
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["id"])) {

        $id = $_SESSION["id"];

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
        <div id="layoutSidenav">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <el-container>
                        <el-header class="mt-4" height="40">
                            <div class="container p-0">
                                <el-row :gutter="20">
                                    <el-col :span="12">
                                        <el-button type="primary" @click="openAddDrawer = true" size="small" icon="el-icon-user-solid">Add New BHW</el-button>
                                        <el-button-group>
                                            <el-button type="success" @click="changeStatus('activate')" size="small" icon="el-icon-open">Activate</el-button>
                                            <el-button type="danger" @click="changeStatus('deactivate')" size="small" icon="el-icon-turn-off">Deactivate</el-button>
                                        </el-button-group>
                                    </el-col>
                                </el-row>
                            </div>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="mb-0">BHW Information Table</p>
                                    <div class="d-flex">
                                        <el-select v-model="searchValue" size="mini" placeholder="Select Column" @changed="changeColumn" clearable>
                                            <el-option v-for="search in options" :key="search.value" :label="search.label" :value="search.value">
                                            </el-option>
                                        </el-select>
                                        <div class="ps-2">
                                            <div v-if="searchValue == 'identification'">
                                                <el-input v-model="searchID" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'name'">
                                                <el-input v-model="searchName" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'username'">
                                                <el-input v-model="searchUsername" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'birthdate'">
                                                <el-input v-model="searchBirthday" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else>
                                                <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table -->
                                <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column label="No." type="index" width="50">
                                    </el-table-column>
                                    <el-table-column sortable label="Identification No." prop="identification">
                                    </el-table-column>
                                    <el-table-column sortable label="Username" prop="username">
                                    </el-table-column>
                                    <el-table-column sortable label="Name" prop="name">
                                    </el-table-column>
                                    <el-table-column sortable label="Birthday" prop="birthdate">
                                    </el-table-column>
                                    <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                        <template slot-scope="scope">
                                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Status" prop="status" width="150" column-key="status">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" :content="scope.row.status == 'Active' ? 'Deactivate' : 'Activate'" placement="top-start">
                                                <el-switch v-model="scope.row.status" @change="handleSwitch(scope.row)" active-value="Active" inactive-value="Inactive" active-color="#13ce66" :active-text="scope.row.status == 'Active' ? 'Active' : 'Inactive'">
                                                </el-switch>
                                            </el-tooltip>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Actions">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="View" placement="top-start">
                                                <el-button icon="el-icon-view" size="mini" type="warning" @click="handleView(scope.$index, scope.row)"></el-button>
                                            </el-tooltip>
                                            <el-tooltip class="item" effect="dark" content="Edit" placement="top-start">
                                                <el-button icon="el-icon-edit" size="mini" type="primary" @click="handleEdit(scope.$index, scope.row)"></el-button>
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
                        <!-- Add Drawer -->
                        <el-drawer title="Add New BHW" :visible.sync="openAddDrawer" size="35%" :before-close="closeAddDrawer">
                            <div class="container p-4 d-flex flex-column pe-5">
                                <el-form :label-position="topLabel" :model="addBhw" :rules="rules" ref="addBhw">
                                    <el-form-item label="Identification Number" prop="identification">
                                        <el-input v-model="addBhw.identification" clearable></el-input>
                                    </el-form-item>
                                    <el-form-item label="First Name" prop="firstName">
                                        <el-input v-model="addBhw.firstName" clearable></el-input>
                                    </el-form-item>
                                    <el-form-item label="Last Name" prop="lastName">
                                        <el-input v-model="addBhw.lastName" clearable></el-input>
                                    </el-form-item>
                                    <el-form-item label="Birthday" prop="birthdate">
                                        <el-date-picker :picker-options="this.maxDate" v-model="addBhw.birthdate" type="date" placeholder="Select birthdate" clearable>
                                        </el-date-picker>
                                    </el-form-item>
                                    <el-form-item label="Gender" prop="gender">
                                        <el-radio-group v-model="addBhw.gender">
                                            <el-radio-button label="Female"></el-radio-button>
                                            <el-radio-button label="Male"></el-radio-button>
                                        </el-radio-group>
                                    </el-form-item>
                                </el-form>
                            </div>
                            <div class="d-flex p-4">
                                <el-button :loading="loadButton" class="flex-1" type="primary" @click="addUser('addBhw')">Submit</el-button>
                                <el-button :loading="loadButton" class="flex-1" @click="resetForm('addBhw')">Reset</el-button>
                            </div>
                        </el-drawer>

                        <!-- After Add Show BHW Username & Password -->
                        <el-dialog title="New BHW Username and Password" :visible.sync="openAddDialog" width="30%" :before-close="closeAddDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="newUser.username" disabled></el-input>
                            <label>Password</label>
                            <el-input class="mb-2" v-model="newUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeAddDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- Reset Password Dialog -->
                        <el-dialog title="BHW Username and New Password" :visible.sync="openResetDialog" width="30%" :before-close="closeResetDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="resetUser.username" disabled></el-input>
                            <label>New Password</label>
                            <el-input class="mb-2" v-model="resetUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeResetDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- View Dialog -->
                        <el-dialog :visible.sync="viewDialog" width="35%" :before-close="closeViewDialog">
                            <template #title>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fs-5">User {{ viewBhw.username }}</div>
                                    <div class="pe-4 view-avatar">
                                        <el-avatar :size="70" :src="viewBhw.avatar"></el-avatar>
                                    </div>
                                </div>
                            </template>
                            <div class="container">
                                <div class="">
                                    <el-descriptions direction="horizontal" :column="1" border>
                                        <el-descriptions-item label="Identification Number">{{ viewBhw.identification }}</el-descriptions-item>
                                        <el-descriptions-item label="Name">{{ viewBhw.name }}</el-descriptions-item>
                                        <el-descriptions-item label="Birthday">{{ viewBhw.birthdate }}</el-descriptions-item>
                                        <el-descriptions-item label="Gender">
                                            <el-tag v-if="viewBhw.gender == 'Male'">{{ viewBhw.gender }}</el-tag>
                                            <el-tag v-else type="danger">{{ viewBhw.gender }}</el-tag>
                                        </el-descriptions-item>
                                        <el-descriptions-item label="Status">
                                            <el-tag v-if="viewBhw.status == 'Active'" type="success">{{ viewBhw.status }}</el-tag>
                                            <el-tag v-else type="info">{{ viewBhw.status }}</el-tag>
                                        </el-descriptions-item>
                                    </el-descriptions>
                                </div>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeViewDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- Edit Dialog -->
                        <el-dialog :visible.sync="editDialog" width="40%" :before-close="closeEditDialog">
                            <template #title>
                                Edit User {{ updateBhw.username }}
                            </template>
                            <el-form :label-position="leftLabel" label-width="160px" :model="updateBhw" :rules="editRules" ref="updateBhw">
                                <el-form-item label="Identification Number" prop="identification">
                                    <el-input v-model="updateBhw.identification" clearable></el-input>
                                </el-form-item>
                                <el-form-item label="First Name" prop="firstName">
                                    <el-input v-model="updateBhw.firstName" clearable></el-input>
                                </el-form-item>
                                <el-form-item label="Last Name" prop="lastName">
                                    <el-input v-model="updateBhw.lastName" clearable></el-input>
                                </el-form-item>
                                <el-form-item label="Birthday" prop="birthdate">
                                    <el-date-picker :picker-options="this.maxDate" v-model="updateBhw.birthdate" type="date" placeholder="Select birthdate" clearable>
                                    </el-date-picker>
                                </el-form-item>
                                <el-form-item label="Gender" prop="gender">
                                    <el-radio-group v-model="updateBhw.gender">
                                        <el-radio-button label="Female"></el-radio-button>
                                        <el-radio-button label="Male"></el-radio-button>
                                    </el-radio-group>
                                </el-form-item>
                            </el-form>
                            <span slot="footer" class="dialog-footer">
                                <el-button :loading="loadButton" @click="closeEditDialog">Cancel</el-button>
                                <el-button :loading="loadButton" type="warning" @click="resetPassword">Reset Password</el-button>
                                <el-button :loading="loadButton" type="primary" @click="updateUser('updateBhw')">Update</el-button>
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
                const validateAddID = (rule, value, callback) => {
                    if (this.checkIdentification.includes(value.trim())) {
                        callback(new Error('Identification no. already exist!'));
                    } else {
                        callback();
                    }
                };
                const validateUpdateID = (rule, value, callback) => {
                    if (localStorage.getItem("identification") != value) {
                        if (this.checkIdentification.includes(value.trim())) {
                            callback(new Error('Identification no. already exist!'));
                        } else {
                            callback();
                        }
                    } else {
                        callback();
                    }
                };
                const validateBirthdate = (rule, value, callback) => {
                    var today = new Date();
                    var birthDate = new Date(value);
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    if (age < 18) {
                        callback(new Error('Age should atleast eightteen(18)!'));
                    } else {
                        callback();
                    }
                };
                return {
                    maxDate: {
                        disabledDate(date) {
                            return date > new Date();
                        }
                    },
                    rules: {
                        identification: [{
                            required: true,
                            message: 'Identification no. is required!',
                            trigger: 'blur'
                        }, {
                            validator: validateAddID,
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
                        }, {
                            min: 2,
                            message: 'First name should atleast two(2) characters!',
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
                        }, {
                            min: 2,
                            message: 'Last name should atleast two(2) characters!',
                            trigger: 'blur'
                        }],
                        birthdate: [{
                            required: true,
                            message: 'Birthday is required!',
                            trigger: 'blur'
                        }, {
                            validator: validateBirthdate,
                            trigger: 'blur'
                        }],
                        gender: [{
                            required: true,
                            message: 'Gender is required!',
                            trigger: 'blur'
                        }],
                    },
                    editRules: {
                        identification: [{
                            required: true,
                            message: 'Identification no. is required!',
                            trigger: 'blur'
                        }, {
                            validator: validateUpdateID,
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
                        }, {
                            min: 2,
                            message: 'First name should atleast two(2) characters!',
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
                        }, {
                            min: 2,
                            message: 'Last name should atleast two(2) characters!',
                            trigger: 'blur'
                        }],
                        birthdate: [{
                            required: true,
                            message: 'Birthday is required!',
                            trigger: 'blur'
                        }, {
                            validator: validateBirthdate,
                            trigger: 'blur'
                        }],
                        gender: [{
                            required: true,
                            message: 'Gender is required!',
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
                    searchUsername: "",
                    searchBirthday: "",
                    topLabel: "top",
                    leftLabel: "left",
                    tableLoad: false,
                    openAddDialog: false,
                    openResetDialog: false,
                    openAddDrawer: false,
                    loadButton: false,
                    editDialog: false,
                    viewDialog: false,
                    switch: false,
                    multipleSelection: [],
                    tableData: [],
                    multiID: [],
                    newUser: [],
                    resetUser: [],
                    checkIdentification: [],
                    editBhw: [],
                    viewBhw: [],
                    addBhw: {
                        identification: "",
                        firstName: "",
                        lastName: "",
                        birthdate: "",
                        gender: "",
                    },
                    updateBhw: {
                        id: 0,
                        username: "",
                        identification: "",
                        firstName: "",
                        lastName: "",
                        birthdate: "",
                        gender: "",
                    },
                    options: [{
                        value: 'identification',
                        label: 'Identification No.'
                    }, {
                        value: 'username',
                        label: 'Username'
                    }, {
                        value: 'name',
                        label: 'Name'
                    }, {
                        value: 'birthdate',
                        label: 'Birthday'
                    }]
                }
            },
            computed: {
                usersTable() {
                    return this.tableData
                        .filter((data) => {
                            return data.name.toLowerCase().includes(this.searchName.toLowerCase());
                        })
                        .filter((data) => {
                            return data.identification.toLowerCase().includes(this.searchID.toLowerCase());
                        })
                        .filter((data) => {
                            return data.username.toLowerCase().includes(this.searchUsername.toLowerCase());
                        })
                        .filter((data) => {
                            return data.birthdate.toLowerCase().includes(this.searchBirthday.toLowerCase());
                        })
                        .slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
                }
            },
            created() {
                this.getData()
            },
            watch: {
                editBhw(value) {
                    this.updateBhw.id = value.id ? value.id : "";
                    this.updateBhw.username = value.username ? value.username : "";
                    this.updateBhw.identification = value.identification ? value.identification : "";
                    this.updateBhw.firstName = value.firstName ? value.firstName : "";
                    this.updateBhw.lastName = value.lastName ? value.lastName : "";
                    this.updateBhw.birthdate = value.birthdate ? value.birthdate : "";
                    this.updateBhw.gender = value.gender ? value.gender : "";
                },
                searchValue(value) {
                    if (value == "" || value == "identification" || value == "name" || value == "username" || value == "birthdate") {
                        this.searchNull = '';
                        this.searchID = '';
                        this.searchName = '';
                        this.searchUsername = '';
                        this.searchBirthday = '';
                    }
                },
                showAllData(value) {
                    if (value == true) {
                        this.page = 1;
                        this.pageSize = this.tableData.length
                    } else {
                        this.pageSize = 10
                    }
                }
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
                    this.multiID = Object.values(val).map(i => i.id)
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                closeAddDrawer() {
                    if (!Object.values(this.addBhw).every((val) => val == "")) {
                        this.$confirm('There are unsaved changes. Continue?', {
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                            })
                            .then(() => {
                                this.openAddDrawer = false
                                this.resetForm("addBhw")
                            })
                            .catch(() => {});
                    } else {
                        this.openAddDrawer = false
                        this.resetForm("addBhw")
                    }
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
                closeViewDialog() {
                    this.viewDialog = false;
                },
                closeEditDialog() {
                    this.$confirm('Are you sure you want to cancel updating BHW?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.editDialog = false
                            this.resetForm("updateBhw")
                            localStorage.removeItem("identification")
                        })
                        .catch(() => {});
                },
                closeResetDialog() {
                    this.$confirm('Done copying new password?', 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.openResetDialog = false
                        })
                        .catch(() => {});
                },
                setPage(value) {
                    this.page = value
                },
                getData() {
                    this.tableLoad = true
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data.error) {
                                setTimeout(() => {
                                    this.tableData = []
                                    this.tableLoad = false
                                }, 1000)
                            } else {
                                setTimeout(() => {
                                    this.tableData = response.data
                                    this.tableLoad = false
                                }, 1000)
                                this.checkIdentification = response.data.map(res => res.identification)
                            }
                        })
                },
                addUser(addBhw) {
                    this.$refs[addBhw].validate((valid) => {
                        if (valid) {
                            this.loadButton = true;
                            this.openAddDrawer = false;
                            const birthday = this.addBhw.birthdate;
                            const birthdayFormat = birthday.getFullYear() + "-" + ((birthday.getMonth() + 1) > 9 ? '' : '0') + (birthday.getMonth() + 1) + "-" + (birthday.getDate() > 9 ? '' : '0') + birthday.getDate();
                            var newData = new FormData()
                            newData.append("identification", this.addBhw.identification)
                            newData.append("first_name", this.addBhw.firstName)
                            newData.append("last_name", this.addBhw.lastName)
                            newData.append("birthdate", birthdayFormat)
                            newData.append("gender", this.addBhw.gender)
                            axios.post("action.php?action=store", newData)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        setTimeout(() => {
                                            this.$message({
                                                message: 'New BHW has been added successfully!',
                                                type: 'success'
                                            });
                                            this.tableLoad = false;
                                            this.getData()
                                            setTimeout(() => {
                                                this.openAddDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.resetForm("addBhw");
                                        this.newUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    });
                },
                resetForm(form) {
                    this.$refs[form].resetFields();
                },
                handleView(index, row) {
                    this.viewBhw = row;
                    this.viewDialog = true;
                },
                handleEdit(index, row) {
                    localStorage.setItem("identification", row.identification)
                    this.editBhw = {
                        id: row.id,
                        username: row.username,
                        identification: row.identification,
                        firstName: row.first_name,
                        lastName: row.last_name,
                        birthdate: row.birthdate,
                        gender: row.gender
                    }
                    this.editDialog = true;
                },
                updateUser(updateBhw) {
                    this.$refs[updateBhw].validate((valid) => {
                        if (valid) {
                            if (JSON.stringify(this.editBhw) != JSON.stringify(this.updateBhw)) {
                                this.loadButton = true;
                                this.$confirm('This will update user ' + this.editBhw.username + '. Continue?', {
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                    })
                                    .then(() => {
                                        const birthday = new Date(Date.parse(this.updateBhw.birthdate));
                                        const birthdayFormat = birthday.getFullYear() + "-" + ((birthday.getMonth() + 1) > 9 ? '' : '0') + (birthday.getMonth() + 1) + "-" + (birthday.getDate() > 9 ? '' : '0') + birthday.getDate();
                                        this.editDialog = false;
                                        var updateData = new FormData()
                                        updateData.append("id", this.updateBhw.id)
                                        updateData.append("identification", this.updateBhw.identification)
                                        updateData.append("first_name", this.updateBhw.firstName)
                                        updateData.append("last_name", this.updateBhw.lastName)
                                        updateData.append("birthdate", birthdayFormat)
                                        updateData.append("gender", this.updateBhw.gender)
                                        axios.post("action.php?action=update", updateData)
                                            .then(response => {
                                                if (response.data) {
                                                    this.loadButton = false;
                                                    this.tableLoad = true;
                                                    setTimeout(() => {
                                                        this.tableLoad = false;
                                                        this.getData();
                                                        this.$message({
                                                            message: 'BHW has been updated successfully!',
                                                            type: 'success'
                                                        });
                                                    }, 1500)
                                                    this.resetForm("updateBhw")
                                                }
                                            })
                                        localStorage.removeItem("identification")
                                    })
                                    .catch(() => {
                                        this.loadButton = false;
                                    });
                            } else {
                                this.$confirm('No changes made. Cancel editing user?', {
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No',
                                    })
                                    .then(() => {
                                        this.editDialog = false
                                        localStorage.removeItem("identification")
                                    })
                                    .catch(() => {
                                        this.editDialog = true
                                    })
                            }
                        } else {
                            this.$message.error("Cannot submit the form. Please check the error(s).")
                            return false;
                        }
                    });
                },
                resetPassword() {
                    this.loadButton = true;
                    this.$confirm('This will reset user ' + this.editBhw.username + "'s password. Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.editDialog = false;
                            var data = new FormData();
                            data.append("id", this.editBhw.id)
                            data.append("username", this.editBhw.username)
                            axios.post("action.php?action=reset", data)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        localStorage.removeItem("identification")
                                        setTimeout(() => {
                                            this.tableLoad = false;
                                            this.$message({
                                                message: 'Password has been reset successfully!',
                                                type: 'success'
                                            });
                                            setTimeout(() => {
                                                this.openResetDialog = true;
                                            }, 1500)
                                        }, 1500);
                                        this.resetUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        })
                        .catch(() => {
                            this.loadButton = false;
                        });
                },
                changeStatus(status) {
                    let statusUpdate = "";
                    let statusSuccess = "";
                    if (Object.keys(this.multiID).length === 0) {
                        if (status == "activate") {
                            this.$message.error("Please select aleast one(1) user to activate!");
                        } else {
                            this.$message.error("Please select aleast one(1) user to deactivate!")
                        }
                    } else {
                        if (status == "activate") {
                            statusUpdate = "This will activate all selected users";
                            statusSuccess = "Selected users has been activated!"
                        } else {
                            statusUpdate = "This will deactivate all selected users";
                            statusSuccess = "Selected users has been deactivated!"
                        }
                        this.$confirm(statusUpdate + '. Continue?', "Warning", {
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                type: "warning"
                            })
                            .then(() => {
                                var ids = new FormData()
                                ids.append("user_ids", this.multiID)
                                ids.append("status", status)
                                axios.post("action.php?action=bulk_status", ids)
                                    .then(response => {
                                        if (response.data) {
                                            this.tableLoad = true;
                                            setTimeout(() => {
                                                this.getData()
                                                this.tableLoad = false;
                                                this.$message({
                                                    message: statusSuccess,
                                                    type: 'success'
                                                });
                                                this.page = 1;
                                            }, 1500);
                                        }
                                    })
                            })
                            .catch(() => {});
                    }
                },
                handleSwitch(row) {
                    var updateStatus = new FormData()
                    updateStatus.append("id", row.id)
                    updateStatus.append("status", row.status)
                    axios.post("action.php?action=update_status", updateStatus)
                        .then(response => {
                            if (response.data) {
                                this.loadButton = false;
                                this.tableLoad = true;
                                setTimeout(() => {
                                    this.tableLoad = false;
                                    this.getData();
                                    if (response.data.status == "Inactive") {
                                        this.$message({
                                            message: 'User has been deactivated!',
                                            type: 'success'
                                        });
                                    } else {
                                        this.$message({
                                            message: 'User has been activated!',
                                            type: 'success'
                                        });
                                    }

                                }, 1500)
                            }
                        })
                },
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchUsername = ""
                    this.searchBirthday = ""
                }
            }
        })
    </script>
</body>

</html>
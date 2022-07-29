<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
    <?php

    include("../import/head.php");

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
        <?php include("../import/nav.php"); ?>
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("../import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <el-container>
                        <el-header class="mt-4" height="40">
                            <el-row :gutter="20">
                                <el-col :span="6">
                                    <el-button type="success" @click="openAddDrawer = true" size="small" icon="el-icon-user-solid">Add New BHW</el-button>
                                    <el-button type="danger" size="small" icon="el-icon-delete-solid">Bulk Delete</el-button>
                                </el-col>
                            </el-row>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <el-row :gutter="20" class="mb-2">
                                    <el-col :span="6">
                                        <p class="mb-0">BHW Information Table</p>
                                    </el-col>
                                    <el-col :offset="6" :span="6">
                                        <el-input v-model="searchName" size="mini" placeholder="Search name..." clearable />
                                    </el-col>
                                    <el-col :span="6">
                                        <el-input v-model="searchID" size="mini" placeholder="Search ID no..." clearable />
                                    </el-col>
                                </el-row>
                                <el-table :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" max-height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
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
                                    <el-table-column sortable label="Gender" prop="gender" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                    </el-table-column>
                                    <el-table-column label="Actions" width="200" fixed="right">
                                        <template slot-scope="scope">
                                            <el-button icon="el-icon-view" size="mini" type="warning" @click="handleView(scope.$index, scope.row)"></el-button>
                                            <el-button icon="el-icon-edit" size="mini" type="primary" @click="handleEdit(scope.$index, scope.row)"></el-button>
                                            <el-button icon="el-icon-delete" size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)"></el-button>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </div>
                        </el-main>
                        <!----------------------------------------------------------------------------------- Modals/Drawers ----------------------------------------------------------------------------------->
                        <!-- Add Drawer -->
                        <el-drawer title="Add New BHW" :visible.sync="openAddDrawer" size="40%" :before-close="closeAddDrawer">
                            <div class="container p-4 d-flex flex-column">
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
                                        <el-date-picker v-model="addBhw.birthdate" type="date" placeholder="Select birthdate" clearable>
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
                                <el-button :loading="loadButton" class="flex-1" type="primary" @click="submitForm('addBhw')">Submit</el-button>
                                <el-button :loading="loadButton" class="flex-1" @click="resetForm('addBhw')">Reset</el-button>
                            </div>
                        </el-drawer>

                        <!-- After Add Show BHW Username & Password -->
                        <el-dialog title="BHW Username and Password" :visible.sync="openAddDialog" width="30%" :before-close="closeAddDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="newUser.username" disabled></el-input>
                            <label>Password</label>
                            <el-input class="mb-2" v-model="newUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeAddDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- After Add Show BHW Username & Password -->
                        <el-dialog title="BHW Username and Password" :visible.sync="openResetDialog" width="30%" :before-close="closeResetDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="resetUser.username" disabled></el-input>
                            <label>New Password</label>
                            <el-input class="mb-2" v-model="resetUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeResetDialog">Close</el-button>
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
                                    <el-date-picker v-model="updateBhw.birthdate" type="date" placeholder="Select birthdate" clearable>
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
                                <el-button :loading="loadButton" @click="closeEditDialog('updateBhw')">Cancel</el-button>
                                <el-button :loading="loadButton" type="warning" @click="resetPassword">Reset Password</el-button>
                                <el-button :loading="loadButton" type="primary" @click="updateUser('updateBhw')">Update</el-button>
                            </span>
                        </el-dialog>
                        <!----------------------------------------------------------------------------------- End of Modals/Drawers ----------------------------------------------------------------------------------->
                    </el-container>
                </main>
                <?php include("../import/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php include("../import/body.php"); ?>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                var textOnly = /^[a-zA-Z ]*$/;
                const validateID = (rule, value, callback) => {
                    if (this.checkIdentification.includes(value.trim())) {
                        callback(new Error('Identification no. already exist!'));
                    } else {
                        callback();
                    }
                };
                const validateBirthdate = (rule, value, callback) => {
                    var currentDate = new Date();
                    var difference = currentDate - value;
                    var age = Math.floor(difference / 31557600000);
                    if (age < 18) {
                        callback(new Error('Age should atleast 18!'));
                    } else {
                        callback();
                    }
                };
                return {
                    rules: {
                        identification: [{
                            required: true,
                            message: 'Identification no. is required!',
                            trigger: 'blur'
                        }, {
                            validator: validateID,
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
                    topLabel: "top",
                    leftLabel: "left",
                    tableLoad: false,
                    openAddDialog: false,
                    openResetDialog: false,
                    openAddDrawer: false,
                    loadButton: false,
                    editDialog: false,
                    multipleSelection: [],
                    searchName: "",
                    searchID: "",
                    fullscreenLoading: true,
                    tableData: [],
                    newUser: [],
                    resetUser: [],
                    checkIdentification: [],
                    editBhw: [],
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
                    }
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
                }
            },
            created() {
                this.getData()
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
                this.updateBhw.id = this.editBhw.id ? this.editBhw.id : "";
                this.updateBhw.username = this.editBhw.username ? this.editBhw.username : "";
                this.updateBhw.identification = this.editBhw.identification ? this.editBhw.identification : "";
                this.updateBhw.firstName = this.editBhw.firstName ? this.editBhw.firstName : "";
                this.updateBhw.lastName = this.editBhw.lastName ? this.editBhw.lastName : "";
                this.updateBhw.birthdate = this.editBhw.birthdate ? this.editBhw.birthdate : "";
                this.updateBhw.gender = this.editBhw.gender ? this.editBhw.gender : "";
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
                    this.multipleSelection = val;
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                closeAddDrawer() {
                    this.$confirm('Are you sure you want to cancel adding new BHW?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.openAddDrawer = false
                        })
                        .catch(() => {});
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
                closeEditDialog(editBhw) {
                    this.$confirm('Are you sure you want to cancel updating BHW?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.editDialog = false
                            this.$refs[editBhw].resetFields();
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
                getData() {
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data) {
                                this.tableData = response.data
                                this.checkIdentification = response.data.map(res => res.identification)
                            }
                        })
                },
                submitForm(addBhw) {
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
                                        this.$message({
                                            message: 'New BHW has been added successfully!',
                                            type: 'success'
                                        });
                                        this.tableLoad = true;
                                        this.getData()
                                        setTimeout(() => {
                                            this.openAddDialog = true;
                                            this.tableLoad = false;
                                        }, 2000);
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
                },
                resetForm(addBhw) {
                    this.$refs[addBhw].resetFields();
                },
                resetFormData() {
                    this.addBhw = []
                },
                handleView(index, row) {

                },
                handleEdit(index, row) {
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
                            if (this.editBhw.identification != this.updateBhw.identification || this.editBhw.firstName != this.updateBhw.firstName || this.editBhw.lastName != this.updateBhw.lastName || this.editBhw.birthdate != this.updateBhw.birthdate || this.editBhw.gender != this.updateBhw.gender) {
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
                                                    this.getData()
                                                    setTimeout(() => {
                                                        this.tableLoad = false;
                                                        this.$message({
                                                            message: 'BHW has been updated successfully!',
                                                            type: 'success'
                                                        });
                                                    }, 2000)
                                                }
                                            })
                                    })
                                    .catch(() => {
                                        this.loadButton = false;
                                    });
                            } else {
                                this.$confirm('No changes detected. Cancel editing user?', {
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No',
                                    })
                                    .then(() => {
                                        this.editDialog = false
                                    })
                                    .catch(() => {});
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
                                        setTimeout(() => {
                                            this.tableLoad = false;
                                            this.openResetDialog = true;
                                        }, 2000);
                                        this.resetUser = response.data;
                                        this.loadButton = false;
                                    }
                                })
                        })
                        .catch(() => {
                            this.loadButton = false;
                        });
                },
                handleDelete(index, row) {
                    this.$confirm('This will permanently delete user ' + row.username + ". Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            var id = new FormData();
                            id.append("id", row.id)
                            axios.post("action.php?action=delete", id)
                                .then(response => {
                                    if (response.data) {
                                        this.getData()
                                        this.tableLoad = true
                                        setTimeout(() => {
                                            this.tableLoad = false
                                            this.$message({
                                                message: 'User deleted successfully!',
                                                type: 'success'
                                            })
                                        }, 1000)
                                    }
                                })
                        })
                        .catch(() => {});
                }
            }
        })
    </script>
</body>

</html>
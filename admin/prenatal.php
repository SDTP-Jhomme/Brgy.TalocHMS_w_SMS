<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Prenatal Patients Information</title>
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
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <el-container>
                        <el-header class="mt-4" height="40">
                            <div class="container p-0">
                                <el-row :gutter="20">
                                    <el-col :span="12">
                                        <el-button @click="editForm" type="success" size="small" icon="el-icon-document">Edit Form</el-button>
                                    </el-col>
                                </el-row>
                            </div>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="mb-0">Prenatal Patient Table</p>
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
                            </div>
                        </el-main>
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
                    rules: {
                        identification: [{
                            required: true,
                            message: 'Identification no. is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^[0-9]+(-[0-9]+)+$/,
                            message: 'Invalid identification number format!',
                            trigger: 'blur'
                        }, {
                            min: 12,
                            message: 'Identification number should ten(10) digits!',
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
                            pattern: /^[0-9]+(-[0-9]+)+$/,
                            message: 'Invalid identification number format!',
                            trigger: 'blur'
                        }, {
                            validator: validateUpdateID,
                            trigger: 'blur'
                        }, {
                            min: 12,
                            message: 'Identification number should ten(10) digits!',
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
                    message: 'online',
                    onLine: navigator.onLine,
                    showBackOnline: false,
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
                    multipleSelection: [],
                    fullscreenLoading: true,
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
            mounted() {
                setTimeout(() => {
                        this.fullscreenLoading = false
                    }, 1000),
                    window.addEventListener('online', this.updateOnlineStatus);
                window.addEventListener('offline', this.updateOnlineStatus);
            },
            beforeDestroy() {
                window.removeEventListener('online', this.updateOnlineStatus);
                window.removeEventListener('offline', this.updateOnlineStatus);
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
                },
                onLine(v) {
                    if (v) {
                        this.showBackOnline = true;
                        setTimeout(() => {
                            this.showBackOnline = false;
                        }, 1000);
                    }
                }
            },
            methods: {
                updateOnlineStatus(e) {
                    const {
                        type
                    } = e
                    this.onLine = type === 'online'
                },
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
                closeViewDialog() {
                    this.viewDialog = false;
                },
                closeEditDialog(editBhw) {
                    this.$confirm('Are you sure you want to cancel updating BHW?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.editDialog = false
                            this.$refs[editBhw].resetFields();
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
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
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
                        gender: row.gender,
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
                                                    setTimeout(() => {
                                                        this.tableLoad = false;
                                                        this.getData();
                                                        this.$message({
                                                            message: 'BHW has been updated successfully!',
                                                            type: 'success'
                                                        });
                                                    }, 1500)
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
                handleActive(index, row) {
                    this.$confirm('This will change user status ' + row.username + ". Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            var id = new FormData();
                            id.append("id", row.id)
                            axios.post("action.php?action=active", id)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true
                                        setTimeout(() => {
                                            this.getData();
                                            this.tableLoad = false
                                            this.$message({
                                                message: 'User status change successfully!',
                                                type: 'success'
                                            })
                                            this.page = 1;
                                        }, 1500)
                                    }
                                })
                        })
                        .catch(() => {});
                },
                handleInactive(index, row) {
                    this.$confirm('This will change user status ' + row.username + ". Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            var id = new FormData();
                            id.append("id", row.id)
                            axios.post("action.php?action=inactive", id)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true
                                        setTimeout(() => {
                                            this.getData();
                                            this.tableLoad = false
                                            this.$message({
                                                message: 'User status change successfully!',
                                                type: 'success'
                                            })
                                            this.page = 1;
                                        }, 1500)
                                    }
                                })
                        })
                        .catch(() => {});
                },
                bulkDelete() {
                    if (Object.keys(this.multiID).length === 0) {
                        this.$message.error("Please select aleast one(1) user to delete!")
                    } else {
                        this.$confirm('This will permanently delete all selected users. Continue?', "Warning", {
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                type: "warning"
                            })
                            .then(() => {
                                var ids = new FormData()
                                ids.append("user_ids", this.multiID)
                                axios.post("action.php?action=bulk_delete", ids)
                                    .then(response => {
                                        if (response.data) {
                                            this.tableLoad = true;
                                            setTimeout(() => {
                                                this.getData()
                                                this.tableLoad = false;
                                                this.$message({
                                                    message: 'Selected users has been deleted successfully!',
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
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchUsername = ""
                    this.searchBirthday = ""
                },
                editForm() {
                    window.location.href = "prenatal-edit-form"
                }
            }
        })
    </script>
</body>

</html>
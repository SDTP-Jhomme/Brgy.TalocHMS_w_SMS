<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Immunization</title>
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
                            <h1 class="mt-4">Immunization Table</h1>
                            <div class="card mb-4">
                                <div class="card-body text-primary">
                                    Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                </div>
                            </div>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <el-button icon="el-icon-printer" size="mini" type="primary" @click="printDialog = true">Print</el-button>
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
                                            <div v-else-if="searchValue == 'birthdate'">
                                                <el-input v-model="searchBirthday" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else>
                                                <el-input v-model="searchNull" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column label="No." type="index" width="50">
                                    </el-table-column>
                                    <el-table-column sortable label="Date Visited" prop="date">
                                    </el-table-column>
                                    <el-table-column sortable label="Name" v-if="viewPatient.suffix != 'undefined'" width="220" prop="name">
                                    </el-table-column>
                                    <el-table-column sortable label="Birthday" width="160" prop="birthdate">
                                    </el-table-column>
                                    <el-table-column sortable label="Phone No." prop="phone_number">
                                    </el-table-column>
                                    <el-table-column sortable label="Gender" prop="gender" width="110" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                        <template slot-scope="scope">
                                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="Actions" width="200">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="View Details" placement="top-start">
                                                <el-button icon="el-icon-view" size="mini" type="warning" @click="handleView(scope.$index, scope.row)">View Details</el-button>
                                            </el-tooltip>
                                            <el-tooltip class="item" effect="dark" content="Update Phone No." placement="top-start">
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
                        <!-- Reset Password Dialog -->
                        <el-dialog title="Patient Username and New Password" :visible.sync="openResetDialog" width="30%" :before-close="closeResetDialog">
                            <label>Username</label>
                            <el-input class="mb-2" v-model="resetUser.username" disabled></el-input>
                            <label>New Password</label>
                            <el-input class="mb-2" v-model="resetUser.password" disabled></el-input>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeResetDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- print-table -->
                        <el-dialog :visible.sync="printDialog" width="80%" :before-close="closePrintDialog">
                            <div class="container">
                                <div class="mt-5" id="printThis">
                                    <?php include("./print-tables/immunization-print.php") ?>
                                </div>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" size="small" icon="el-icon-printer" id="tablePrint">Print</el-button>
                            </span>
                        </el-dialog>
                        <!-- end-print-table -->

                        <!-- View Dialog -->
                        <el-dialog :visible.sync="viewDialog" width="80%" :before-close="closeViewDialog">
                            <template #title>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="pe-4">
                                        <el-avatar :size="70" :src="viewPatient.avatar"></el-avatar>
                                    </div>
                                </div>
                            </template>
                            <div class="container">
                                <div class="" id="printThis">
                                    <div class="row d-flex justify-content-md-between" style="border-bottom: 5px solid black;">
                                        <div class="col-sm-4 ms-5">
                                            <h4 class="fw-bolder font-arial">City Health Office</h4>
                                            <h4 style="font-family:'Times New Roman', Times, serif;">Bago City, Negros Occidental</h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <img class="img-fluid" src="../assets/img/bcc-Logo.png" style="width:auto ;" alt="Bago City Logo">
                                            <img src="../assets/img/city-health.png" style="width:auto;" alt="Bago City Health Logo">
                                            <img src="../assets/img/sun-logo.png" style="width:auto ;" alt="Sun">
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <h4 class="fw-bold text-center mb-4">Expanded Program on Immunization Record</h4>
                                    </div>
                                    <div style="border-bottom:3px solid black ;">
                                        <div class="mx-5 fs-5" style="font-family:'Times New Roman', Times, serif;">
                                            <div class="row d-flex justify-content-md-between">
                                                <div class="col-auto">
                                                    <label>Name: <span class="border-bottom-1 border-dark">{{viewPatient.name}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label>FSN: <span class="border-bottom border-dark px-4">{{viewPatient.fsn}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-auto">
                                                    <label>Date of Birth: <span class="border-bottom-1 border-dark">{{viewPatient.birthdate}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label>Child's No.: <span class="border-bottom border-dark px-4">{{viewPatient.child_no}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-auto">
                                                    <label>Mother's name: <span class="border-bottom-1 border-dark">{{viewPatient.mother_name}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-auto">
                                                    <label>Father's name: <span class="border-bottom-1 border-dark">{{viewPatient.father_name}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3 d-flex justify-content-between">
                                                <div class="col-auto">
                                                    <label>Address:(Purok) <span class="border-bottom-1 border-dark">{{viewPatient.address}}</span></label>
                                                </div>
                                                <div class="col-5">
                                                    <label>Barangay: <span class="border-bottom-1 border-dark">{{viewPatient.barangay}}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-dark mx-5 my-4" style="font-family:'Times New Roman', Times, serif;">
                                        <div class="my-5" style="border-bottom:1px solid black ;">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Date: <span class="border-bottom-1 border-dark">{{viewPatient.appointment}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <label>Age: <span class="border-bottom border-dark px-4">{{viewPatient.age}}</span></label>
                                                </div>
                                                <div class="col-auto">
                                                    <label>Wt: <span class="border-bottom border-dark px-4">{{viewPatient.weight}}</span></label>
                                                </div>
                                                <div class="col-3">
                                                    <label>Temp: <span class="border-bottom border-dark px-4">{{viewPatient.temp}}</span></label>
                                                </div>
                                            </div>
                                            <div class="row mb-5 d-flex justify-content-between">
                                                <div class="col-auto">
                                                    <label>Immunization Given: <span class="border-bottom-1 border-dark">{{viewPatient.immunization_given}}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" icon="el-icon-printer" id="Print">Print</el-button>
                                <el-button type="info" @click="closeViewDialog">Close</el-button>
                            </span>
                        </el-dialog>

                        <!-- Edit Dialog -->
                        <el-dialog :visible.sync="editDialog" width="40%" :before-close="closeEditDialog">
                            <template #title>
                                Edit User {{ editContact.username }}
                            </template>
                            <el-descriptions direction="horizontal" class="mb-4" :column="1" border>
                                <el-descriptions-item label="FSN">{{ editContact.fsn }}</el-descriptions-item>
                            </el-descriptions>
                            <el-form :label-position="leftLabel" label-width="160px" :model="updateContact" :rules="editRules" ref="updateContact">
                                <el-form-item label="Phone Number" prop="phone_number">
                                    <el-input v-model="updateContact.phone_number" maxlength="11" clearable show-phone_number></el-input>
                                </el-form-item>
                            </el-form>
                            <span slot="footer" class="dialog-footer">
                                <el-button :loading="loadButton" @click="closeEditDialog('updateContact')">Cancel</el-button>
                                <el-button :loading="loadButton" type="warning" @click="resetPassword">Reset Password</el-button>
                                <el-button :loading="loadButton" type="primary" @click="updateUser('updateContact')">Update</el-button>
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
                return {
                    editRules: {
                        phone_number: [{
                            required: true,
                            message: 'Phone no. is required!',
                            trigger: 'blur'
                        }, {
                            pattern: /^(09|\+639)\d{9}$/,
                            message: 'Invalid phone number format!',
                            trigger: 'blur'
                        }, {
                            min: 11,
                            message: 'Phone number should eleven(11) digits!',
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
                    searchBirthday: "",
                    topLabel: "top",
                    leftLabel: "left",
                    tableLoad: false,
                    openResetDialog: false,
                    loadButton: false,
                    editDialog: false,
                    viewDialog: false,
                    printDialog: false,
                    multipleSelection: [],
                    fullscreenLoading: true,
                    tableData: [],
                    multiID: [],
                    resetUser: [],
                    checkIdentification: [],
                    editContact: [],
                    viewPatient: [],
                    updateContact: {
                        id: 0,
                        phone_number: "",
                    },
                    options: [{
                        value: 'fsn',
                        label: 'FSN No.'
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
                            return data.fsn.toLowerCase().includes(this.searchID.toLowerCase());
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
                }, 1000)
            },
            watch: {
                editContact(value) {
                    this.updateContact.id = value.id ? value.id : "";
                    this.updateContact.phone_number = value.phone_number ? value.phone_number : "";
                    this.updateContact.fsn = value.fsn ? value.fsn : "";
                },
                searchValue(value) {
                    if (value == "" || value == "fsn" || value == "name" || value == "birthdate") {
                        this.searchNull = '';
                        this.searchID = '';
                        this.searchName = '';
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
                closeViewDialog() {
                    this.viewDialog = false;
                },
                closePrintDialog() {
                    this.printDialog = false;
                },
                closeEditDialog(editContact) {
                    this.$confirm('Are you sure you want to cancel updating Phone no.?', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        })
                        .then(() => {
                            this.editDialog = false
                            this.$refs[editContact].resetFields();
                            localStorage.removeItem("fsn")
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
                    axios.post("action.php?action=fetch_immunization")
                        .then(response => {
                            console.log(response)
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                this.checkIdentification = response.data.map(res => res.fsn)
                            }
                        })
                },
                handleView(index, row) {
                    this.viewPatient = row;
                    this.viewDialog = true;
                },
                handleEdit(index, row) {
                    localStorage.setItem("fsn", row.fsn)
                    this.editContact = {
                        id: row.id,
                        phone_number: row.phone_number,
                        fsn: row.fsn,
                        username: row.username,
                        firstName: row.first_name,
                    }
                    this.editDialog = true;
                },
                updateUser(updateContact) {
                    this.$refs[updateContact].validate((valid) => {
                        if (valid) {
                            if (this.editContact.phone_number != this.updateContact.phone_number) {
                                this.loadButton = true;
                                this.$confirm('This will update user ' + this.editContact.firstName + '. Continue?', {
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                    })
                                    .then(() => {
                                        this.editDialog = false;
                                        var updateData = new FormData()
                                        updateData.append("id", this.updateContact.id)
                                        updateData.append("phone_number", this.updateContact.phone_number)
                                        axios.post("action.php?action=update_contact", updateData)
                                            .then(response => {
                                                if (response.data) {
                                                    this.loadButton = false;
                                                    this.tableLoad = true;
                                                    setTimeout(() => {
                                                        this.tableLoad = false;
                                                        this.getData();
                                                        this.$message({
                                                            message: 'Phone no. has been updated successfully!',
                                                            type: 'success'
                                                        });
                                                    }, 1500)
                                                }
                                            })
                                        localStorage.removeItem("fsn")
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
                                        localStorage.removeItem("fsn")
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
                    this.$confirm('This will reset user ' + this.editContact.username + "'s password. Continue?", 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: "warning"
                        })
                        .then(() => {
                            this.editDialog = false;
                            var data = new FormData();
                            data.append("id", this.editContact.id)
                            data.append("username", this.editContact.username)
                            axios.post("action.php?action=reset", data)
                                .then(response => {
                                    if (response.data) {
                                        this.tableLoad = true;
                                        localStorage.removeItem("fsn")
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
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchID = ""
                    this.searchBirthday = ""
                }
            }
        })
    </script>
    <script>
        document.getElementById("Print").onclick = function() {
            printElement(document.getElementById("printThis"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
    <script>
        document.getElementById("tablePrint").onclick = function() {
            printElement(document.getElementById("printTable"));
        };

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
</body>

</html>
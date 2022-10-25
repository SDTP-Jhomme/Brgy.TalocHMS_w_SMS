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
                            <div class="container p-0">
                            </div>
                        </el-header>
                        <el-main>
                            <div class="container border rounded p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="mb-0 fw-bold">Expanded Program on Immunization Record</p>
                                    <div class="d-flex">
                                        <el-select v-model="searchValue" size="mini" placeholder="Select Column" @changed="changeColumn" clearable>
                                            <el-option v-for="search in options" :key="search.value" :label="search.label" :value="search.value">
                                            </el-option>
                                        </el-select>
                                        <div class="ps-2">
                                            <div v-if="searchValue == 'fsn'">
                                                <el-input v-model="searchFsn" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'name'">
                                                <el-input v-model="searchName" size="mini" placeholder="Type to search..." clearable />
                                            </div>
                                            <div v-else-if="searchValue == 'address'">
                                                <el-input v-model="searchAddress" size="mini" placeholder="Type to search..." clearable />
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
                                <el-table v-if="this.tableData" :data="usersTable" border style="width: 100%" height="400" v-loading="tableLoad" @selection-change="handleSelectionChange" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column fixed label="No." type="index" width="50">
                                    </el-table-column>
                                    <el-table-column sortable prop="fsn" label="FSN" width="100">
                                    </el-table-column>
                                    <el-table-column sortable prop="name" label="Name">
                                    </el-table-column>
                                    <el-table-column sortable prop="address" label="Address">
                                    </el-table-column>
                                    <el-table-column sortable prop="birthdate" label="Birthday">
                                    </el-table-column>
                                    <el-table-column sortable label="Gender" prop="gender" column-key="gender" :filters="[{text: 'Female', value: 'Female'}, {text: 'Male', value: 'Male'}]" :filter-method="filterHandler">
                                        <template slot-scope="scope">
                                            <el-tag size="small" v-if="scope.row.gender == 'Male'">{{ scope.row.gender }}</el-tag>
                                            <el-tag size="small" v-else type="danger">{{ scope.row.gender }}</el-tag>
                                        </template>
                                    </el-table-column>
                                    <el-table-column fixed="right" label="Action" width="120">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="View" placement="top-start">
                                                <el-button icon="el-icon-view" size="mini" type="primary" @click="handleView(scope.$index, scope.row)">View Detail</el-button>
                                            </el-tooltip>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </div>
                            <!-- View Dialog -->
                            <el-dialog :visible.sync="viewDialog" width="35%" :before-close="closeViewDialog">
                                <template #title>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="fs-5">User {{ viewImmunization.username }}</div>
                                        <div class="pe-4">
                                            <el-avatar :size="70" :src="viewImmunization.avatar"></el-avatar>
                                        </div>
                                    </div>
                                </template>
                                <div class="container">
                                    <div class="">
                                        <el-descriptions direction="horizontal" :column="1" border>
                                            <el-descriptions-item label="Identification Number">{{ viewImmunization.fsn }}</el-descriptions-item>
                                            <el-descriptions-item label="Name">{{ viewImmunization.name }}</el-descriptions-item>
                                            <el-descriptions-item label="Birthday">{{ viewImmunization.birthdate }}</el-descriptions-item>
                                            <el-descriptions-item label="Gender">
                                                <el-tag v-if="viewImmunization.gender == 'Male'">{{ viewImmunization.gender }}</el-tag>
                                                <el-tag v-else type="danger">{{ viewImmunization.gender }}</el-tag>
                                            </el-descriptions-item>
                                        </el-descriptions>
                                    </div>
                                </div>
                                <span slot="footer" class="dialog-footer">
                                    <el-button type="primary" @click="closeViewDialog">Close</el-button>
                                </span>
                            </el-dialog>
                        </el-main>

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
                    tableData: [],
                    tableLoad: false,
                    fullscreenLoading: true,
                    viewImmunization: [],
                    viewDialog: false,
                    searchValue: "",
                    searchNull: "",
                    searchName: "",
                    searchFsn: "",
                    searchAddress: "",
                    searchBirthday: "",

                    options: [{
                        value: 'fsn',
                        label: 'FSN'
                    }, {
                        value: 'address',
                        label: 'Address'
                    }, {
                        value: 'name',
                        label: 'Name'
                    }, {
                        value: 'birthdate',
                        label: 'Birthday'
                    }]
                }
            },
            methods: {
                changeColumn(selected) {
                    this.searchNull = ""
                    this.searchName = ""
                    this.searchFsn = ""
                    this.searchAddress = ""
                    this.searchBirthday = ""
                },
                closeViewDialog() {
                    this.viewDialog = false;
                },
                handleClick() {
                    console.log('click');
                },
                handleView(index, row) {
                    this.viewImmunization = row;
                    this.viewDialog = true;
                },
                getData() {
                    axios.post("action.php?action=fetchImmunization")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                            }
                        })
                },
                created() {
                    this.getData()
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
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
                handleSelectionChange(val) {
                    this.multiID = Object.values(val).map(i => i.id)
                },
                // ******************************************************
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
            },
            watch: {
                searchValue(value) {
                    if (value == "" || value == "fsn" || value == "name" || value == "address" || value == "birthdate") {
                        this.searchNull = '';
                        this.searchFsn = '';
                        this.searchName = '';
                        this.searchAddress = '';
                        this.searchBirthday = '';
                    }
                },
            },
            computed: {
                usersTable() {
                    return this.tableData
                        .filter((data) => {
                            return data.name.toLowerCase().includes(this.searchName.toLowerCase());
                        })
                        .filter((data) => {
                            return data.fsn.toLowerCase().includes(this.searchFsn.toLowerCase());
                        })
                        .filter((data) => {
                            return data.address.toLowerCase().includes(this.searchFsn.toLowerCase());
                        })
                        .filter((data) => {
                            return data.birthdate.toLowerCase().includes(this.searchBirthday.toLowerCase());
                        })
                        .slice(this.pageSize * this.page - this.pageSize, this.pageSize * this.page)
                }
            },
        })
    </script>
</body>

</html>
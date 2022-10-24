<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Dashboard</title>
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
                                <el-table v-if="this.tableData" :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" height="400" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                    <el-table-column type="selection" width="55">
                                    </el-table-column>
                                    <el-table-column label="No." type="index" width="50">
                                    </el-table-column>
                                    <el-table-column sortable label="FSN." prop="identification">
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
                                    <el-table-column label="Actions" width="150">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" content="View" placement="top-start">
                                                <el-button icon="el-icon-view" size="mini" type="primary" @click="handleView(scope.$index, scope.row)">View Record</el-button>
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
                        <!-- View Dialog -->
                        <el-dialog :visible.sync="viewDialog" width="35%" :before-close="closeViewDialog">
                            <template #title>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fs-5">User {{ viewBhw.username }}</div>
                                    <div class="pe-4">
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
                                        <el-descriptions-item label="Birthday">{{ viewBhw.birthdate }}</el-descriptions-item>
                                    </el-descriptions>
                                </div>
                            </div>
                            <span slot="footer" class="dialog-footer">
                                <el-button type="primary" @click="closeViewDialog">Close</el-button>
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
                    viewDialog: false,
                    multipleSelection: [],
                    fullscreenLoading: true,
                    tableData: [],
                    viewBhw: [],
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
                    }, 1000)
            },
            watch: {
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
                setPage(value) {
                    this.page = value
                },
                getData() {
                    axios.post("immunization-action.php?action=fetch")
                        .then(response => {
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                            }
                        })
                },
                handleView(index, row) {
                    this.viewBhw = row;
                    this.viewDialog = true;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        function add_hyphen() {
            var input = document.getElementById("bhwID");
            var str = input.value;
            str = str.replace("-", "");
            if (str.length > 9) {
                str = str.substring(0, 3) + "-" + str.substring(3, 6) + "-" + str.substring(7);
            }
            input.value = str
        }
    </script>
</body>

</html>
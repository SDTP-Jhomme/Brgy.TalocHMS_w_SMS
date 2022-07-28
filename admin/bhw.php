<?php

$date_now = date("Y-m-d");
$month_day = date("m-d");
$date_interval = intval("$date_now") - 18;
$date_before_eighteen = "$date_interval-$month_day";

?>


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
                                    <el-button type="success" size="small" icon="el-icon-user-solid">Add New BHW</el-button>
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
                                        <el-input v-model="searchName" size="mini" placeholder="Search name..." />
                                    </el-col>
                                    <el-col :span="6">
                                        <el-input v-model="searchID" size="mini" placeholder="Search ID no..." />
                                    </el-col>
                                </el-row>
                                <el-table :data="usersTable" style="width: 100%" border @selection-change="handleSelectionChange" max-height="450">
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
                return {
                    multipleSelection: [],
                    searchName: "",
                    searchID: "",
                    fullscreenLoading: true,
                    tableData: []
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
                }, 2000)
            },
            methods: {
                // Logout ****************
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
                // *************************
                handleSelectionChange(val) {
                    this.multipleSelection = val;
                },
                filterHandler(value, row, column) {
                    const property = column['property'];
                    return row[property] === value;
                },
                getData() {
                    axios.post("action.php?action=fetch")
                        .then(response => {
                            if (response.data) {
                                this.tableData = response.data
                            }
                        })
                },
                handleEdit(index, row) {
                    console.log(index, row)
                }
            }
        })
    </script>
</body>

</html>
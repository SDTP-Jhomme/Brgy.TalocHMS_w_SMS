<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Immunization Patients Information</title>
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
                        <el-main>
                            <h1 class="mt-4">
                                <i class="material-icons">&#xe91e;</i>
                                Maternity Chart
                            </h1>
                            <div class="card mb-4">
                                <div class="card-body text-primary">
                                    <div class="row">
                                        <div class="col-10">
                                            Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                        </div>
                                        <div class="col-auto">
                                            <el-button type="primary" @click="openAddDrawer = true" size="small" icon="el-icon-s-data">Recorded Date Logs</el-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <el-drawer :visible.sync="openAddDrawer" :direction="direction" size="small" :before-close="closeAddDrawer">
                                <div class="container d-flex flex-column">
                                    <el-header height="40">
                                        <h1 class="mt-4">Maternity Records Logs</h1>
                                        <div class="card mb-5">
                                            <div class="card-body text-primary">
                                                Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                            </div>
                                        </div>
                                    </el-header>
                                    <el-main>
                                        <div class="container border rounded p-4">
                                            <el-table :data="tableData" style="width: 100%" border height="200" v-loading="tableLoad" element-loading-text="Loading. Please wait..." element-loading-spinner="el-icon-loading">
                                                <el-table-column label="No." type="index" width="50">
                                                </el-table-column>
                                                <el-table-column label="Last Appointment" width="200" prop="appointment">
                                                    <template slot-scope="scope">
                                                        <i class="el-icon-time"></i>
                                                        <span style="margin-left: 10px">{{ scope.row.appointment }}</span>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column sortable label="Name" prop="name">
                                                </el-table-column>
                                                <el-table-column sortable label="Address" prop="address">
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
                                <div class="d-flex justify-content-end p-4">
                                    <el-button type="info" size="small" @click="closeAddDrawer">Close</el-button>
                                </div>
                            </el-drawer>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <?php include("prenatal-chart.php"); ?>
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
                return {
                    fullscreenLoading: true,
                    openAddDrawer: false,
                    direction: 'btt',
                    page: 1,
                    pageSize: 10,
                    showAllData: false,
                    tableLoad: false,
                    tableData: [],
                    loadButton: false,
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
                // Logout **********************************************************
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
                closeAddDrawer() {
                    this.openAddDrawer = false
                },
                getData() {
                    axios.post("action.php?action=fetch_prenatal")
                        .then(response => {
                            console.log(response)
                            if (response.data.error) {
                                this.tableData = []
                            } else {
                                this.tableData = response.data
                                console.log(this.tableData)
                            }
                        })
                },
                setPage(value) {
                    this.page = value
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
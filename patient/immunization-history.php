<!DOCTYPE html>
<html lang="en">

<head>
    <title>BHW | Patient Request</title>
    <?php

    include("./import/head.php");

    if (isset($_SESSION["user_id"])) {

        $id = $_SESSION["user_id"];

        $user_record = mysqli_query($db, "SELECT * FROM patient where id='$id'");

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
    }
    ?>
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
                        <h1 class="mt-4">Immunization History</h1>
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
                                <el-table-column sortable label="Phone No." prop="phone_number">
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
                    loadButton: false,
                    fullscreenLoading: true,
                    backToHome: false,
                    avatar: "",
                    checkFsn: [],
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
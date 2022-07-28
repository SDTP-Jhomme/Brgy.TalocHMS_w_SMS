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
                    <el-table :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">
                        <el-table-column type="index" width="50">
                        </el-table-column>
                        <el-table-column label="Date" prop="date">
                        </el-table-column>
                        <el-table-column label="Name" prop="name">
                        </el-table-column>
                        <el-table-column align="right">
                            <template slot="header" slot-scope="scope">
                                <el-input v-model="search" size="mini" placeholder="Type to search" />
                            </template>
                            <template slot-scope="scope">
                                <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                                <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </main>
                <?php include("../import/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php include("../import/body.php"); ?>
    <script>
        new Vue({
            el: "#app",
            data() {
                return {
                    search: "",
                    fullscreenLoading: true,
                    tableData: []
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
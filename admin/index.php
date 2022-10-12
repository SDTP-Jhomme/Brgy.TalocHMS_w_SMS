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
        <div id="layoutSidenav" v-loading.fullscreen.lock="fullscreenLoading">
            <?php include("./import/sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <?php include("dashboard.php"); ?>
                </main>
                <?php include("./import/footer.php"); ?>
            </div>
        </div>
        <?php include("./import/body.php"); ?>
    </div>
    <script>
        ELEMENT.locale(ELEMENT.lang.en)
        new Vue({
            el: "#app",
            data() {
                return {
                    fullscreenLoading: true,
                }
            },
            mounted() {
                setTimeout(() => {
                    this.fullscreenLoading = false
                }, 1000)
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
            }
        })
        var xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        var yValues =[0];
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [0,0,0,0,00,0,0,0,, 0, 0, 0, 0],
                    borderColor: "red",
                    fill: false
                }, {
                    data: [1.0,0,0,0,0, 0, 0, 0],
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: true
                }
            }
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Maternity</title>
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
                        <el-main>
                            <h2 class="mt-4">Monthly Accomplishment Report</h2>
                            <div class="card mb-4">
                                <div class="card-body text-primary">
                                    Barangay Taloc Online Health Record Management System <?php echo date("Y"); ?>
                                </div>
                            </div>
                            <div class="card" id="printThis">
                                <div class="card-header">
                                    <form method="post" action="export-file">
                                        <input type="submit" name="export" class="btn btn-sm btn-outline-success float-end" value="Export to Excel">
                                    </form>
                                </div>
                                <div class="card-title mt-3 text-center">
                                    <p class="fw-bold">Bago City</p>
                                    <p class="fw-bold">Barangay Health Worker</p>
                                    <p>MONTHLY ACCOMPLISHMENT</p>
                                </div>
                                <div class="card-body mx-5" id="table">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="col-5 text-center">ACTIVITY</th>
                                                <th class="col-2 text-center">NO. ACCOMPLISHED</th>
                                                <th class="col-auto"></th>
                                                <th class="col-auto"></th>
                                                <th class="col-auto">REMARKS</th>
                                            </tr>
                                            <tr>
                                                <th class="col-5">RMCHN</th>
                                                <th class="col-auto">10-14 y.o.</th>
                                                <th class="col-auto">15-19 y.o.</th>
                                                <th class="col-auto">20-49 y.o.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count_prenatal = $db->query("SELECT COUNT(*) as total FROM `prenatal` INNER JOIN patient ON patient.fsn=prenatal.fsn");
                                            $prenatal = $count_prenatal->fetch_array();
                                            $count_aog = $db->query("SELECT COUNT(aog) as aog FROM `prenatal` INNER JOIN patient ON patient.fsn=prenatal.fsn");
                                            $aog = $count_aog->fetch_array();
                                            $query = $db->query("SELECT * FROM patient INNER JOIN prenatal ON prenatal.fsn=patient.fsn");
                                            while ($fetch = $query->fetch_array()) {
                                            ?>
                                                <tr>
                                                    <th class="col-5">I. MATERNAL CARE</th>
                                                    <th class="col-auto"></th>
                                                    <th class="col-auto"></th>
                                                    <th class="col-auto"></th>
                                                </tr>
                                                <tr>
                                                    <td class="col-5">1. No. of pregnant women identified and refered and tracked</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5">a. Number of pregnant women seen - 1st trimester</td>
                                                    <td class="col-auto"><?php echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end"> - 2nd trimester</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"><?php echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end"> - 3rd trimester</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"><?php echo $prenatal['total'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-4">b. Number of antenatal care check - ups monitored</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5"> - 1st trimester (up to 12 weeks and 6 days AOG)</td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '0' || $aog['aog'] <= '12') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5"> - 2nd trimester (13-27 weeks and 6 days AOG)</td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '13' || $aog['aog']<= '27') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5"> - 3rd trimester (28 weeks AOG and more )</td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '28') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">2. No. of pregnant women delivered this month</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5">Pregnancy Outcome</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Live birth</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Preterm</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Still Birth</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Abortion</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5">Gender of the Baby</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Boy</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Girl</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">No. of home delivered mother/newborn/transferred in referred to midwife</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ">3. Mother and Child Postnatal Check-up, followed-up and referred</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-auto ps-5">-Day of discharged/24 hours after birth</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-auto ps-5">-Within 7 days after birth</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ">4. Number of postpartum mothers monitored on exclusive breastfeeding</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ">5. Number of lactating mothers given Vit A (within 4 weeks)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <th class="col-8 ">Family Planning</th>
                                                    <th class="col-auto"></th>
                                                    <th class="col-auto"></th>
                                                    <th class="col-auto"></th>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">1. A Number of women referred for Family Planning(NEW)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">a. IUD (Interval)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 ps-4 float-end"> IUD (Postpartum)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">b. DMPA</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">c. PILLS (COC - Combined Oral Contraceptive)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 ps-4 float-end"> PILLS (POP) - (Progestin Only Pill)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">d. IMPLANTS(PSI)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">e. CONDOM</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">f. Vasectomy</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">g. BTL(Bilateral Tubal Ligation)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">h. Fertility Awareness Bases Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- SDM (Standard Days Method)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- STM (Syptho-thermal Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end"> - BBT(Basal Body Temperature</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- CCM (Cervical-Mucus Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-4">B. Number of women <b>USING</b> Family Planning method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">a. IUD (Interval)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 ps-4 float-end"> IUD (Postpartum)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">b. DMPA</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">c. PILLS (COC - Combined Oral Contraceptive)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 ps-4 float-end"> PILLS (POP) - (Progestin Only Pill)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">d. IMPLANTS(PSI)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">e. CONDOM</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">f. Vasectomy</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">g. BTL(Bilateral Tubal Ligation)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">h. Fertility Awareness Bases Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- SDM (Standard Days Method)</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- STM (Syptho-thermal Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end"> - BBT(Basal Body Temperature</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 float-end">- CCM (Cervical-Mucus Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">2. A Number of WRA profiled and masterlisted</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">3. A Number of WRA who do not practice any Family Planning Method</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                    loadButton: false,
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
        })
    </script>
    <script type="text/javascript">
        function exportReportToExcel() {
            let table = document.getElementById("table");
            TableToExcel.convert(table[0], {
                name: `monthly-accomplishment.xlsx`,
                sheet: {
                    name: 'Sheet 1'
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".dataExport").click(function() {
                var exportType = $(this).data('type');
                $('#dataTable').tableExport({
                    type: exportType,
                    escape: 'false',
                    ignoreColumn: []
                });
            });
        });
    </script>
</body>

</html>
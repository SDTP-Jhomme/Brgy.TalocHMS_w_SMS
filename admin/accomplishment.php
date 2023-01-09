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
    <style id="table_style" type="text/css">
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        table th {
            background-color: #F7F7F7;
            color: #333;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .text-center {
            text-align: center;
        }

        .ps-5 {
            padding-left: 3rem !important;
        }

        .float-end {
            float: right !important;
        }
    </style>
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
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <el-button type="primary" icon="el-icon-printer" onclick="PrintTable();">Print</el-button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="dvContents" style="border: 1px dotted black; padding: 5px; width:100%">
                                    <div class="card-title mt-3 text-center">
                                        <p class="fw-bold">Bago City</p>
                                        <p class="fw-bold">Barangay Health Worker</p>
                                        <p>MONTHLY ACCOMPLISHMENT</p>
                                    </div>
                                    <div class="card-body">
                                        <table cellspacing="0" rules="all" border="1">
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
                                                    <th class="col-auto text-center">10-14 y.o.</th>
                                                    <th class="col-auto text-center">15-19 y.o.</th>
                                                    <th class="col-auto text-center">20-49 y.o.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count_prenatal = $db->query("SELECT COUNT(*) as total FROM `prenatal` INNER JOIN patient ON patient.id=prenatal.patient_id");
                                                $prenatal = $count_prenatal->fetch_array();
                                                $count_planning = $db->query("SELECT COUNT(*) as total FROM `family_planning` INNER JOIN patient ON patient.id=family_planning.patient_id");
                                                $family_planning = $count_planning->fetch_array();
                                                $count_aog = $db->query("SELECT COUNT(aog) as aog FROM `prenatal` INNER JOIN patient ON patient.id=prenatal.patient_id");
                                                $aog = $count_aog->fetch_array();
                                                $count_presentation = mysqli_query($db, "SELECT * FROM `prenatal` INNER JOIN patient ON patient.id=prenatal.patient_id");
                                                $presentation = $count_presentation->fetch_array();;
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
                                                    <td class="col-auto"><?php if ($prenatal['total'] <= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end"> - 3rd trimester</td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
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
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '13' || $aog['aog'] <= '27') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '28') echo $aog['aog'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5"> - 2nd trimester (13-27 weeks and 6 days AOG)</td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '0' || $aog['aog'] <= '12') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '13' || $aog['aog'] <= '27') echo $aog['aog'] ?></td>
                                                    <td class="col-auto"><?php if ($aog['aog'] >= '28') echo $aog['aog'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5"> - 3rd trimester (28 weeks AOG and more )</td>
                                                    <td class="col-auto"><?php echo $aog['aog'] >= '0' && $aog['aog'] <= '12' ?></td>
                                                    <td class="col-auto"><?php echo $aog['aog'] >= '13' && $aog['aog'] <= '27'?></td>
                                                    <td class="col-auto"><?php echo $aog['aog'] >= '28'?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">2. No. of pregnant women delivered this month</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5">Pregnancy Outcome</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Live birth</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Preterm</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Still Birth</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Abortion</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 ps-5">Gender of the Baby</td>
                                                    <td class="col-auto"><?php if ($prenatal['total'] >= 'Apr') echo $prenatal['total'] ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Boy</td>
                                                    <td class="col-auto"><?php if($presentation['presentation'] == 'Boy') ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8 float-end">-Girl</td>
                                                    <td class="col-auto"><?php if($presentation['presentation'] == 'Girl'){echo $presentation;} ?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-8">No. of home delivered mother/newborn/transferred in referred to midwife</td>
                                                    <td class="col-auto"><?php echo $prenatal['total'] ?></td>
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
                                                    <td class="col-auto"><?php echo $family_planning['total'] ?></td>
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
                                                    <td class="col-auto"><?php echo $family_planning['total'] == 'COC'?></td>
                                                    <td class="col-auto"></td>
                                                    <td class="col-auto"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5 ps-4 float-end"> PILLS (POP) - (Progestin Only Pill)</td>
                                                    <td class="col-auto"><?php echo $family_planning['total'] == 'POP'?></td>
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
                                            </tbody>
                                        </table>
                                    </div>
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
        function PrintTable() {
            var printWindow = window.open('', '', 'height=800,width=1000');
            printWindow.document.write('<html><head><title>Table Contents</title>');

            //Print the Table CSS.
            var table_style = document.getElementById("table_style").innerHTML;
            printWindow.document.write('<style type = "text/css">');
            printWindow.document.write(table_style);
            printWindow.document.write('</style>');
            printWindow.document.write('</head>');

            //Print the DIV contents i.e. the HTML Table.
            printWindow.document.write('<body>');
            var divContents = document.getElementById("dvContents").innerHTML;
            printWindow.document.write(divContents);
            printWindow.document.write('</body>');

            printWindow.document.write('</html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>

</html>
<?php
//export.php  
$output = '';
include("../database/database.php");
if (isset($_POST["export"])) {
    $count_prenatal = $db->query("SELECT COUNT(*) as total FROM `prenatal` INNER JOIN patient ON patient.fsn=prenatal.fsn");
    $prenatal = $count_prenatal->fetch_array();
    $query = "SELECT * FROM patient INNER JOIN prenatal ON prenatal.fsn=patient.fsn";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
   <table class="table" bordered="1">  
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
  ';
        while ($row = mysqli_fetch_array($result)) {

            if ($row['aog'] <= '12') {
                $twelve = $row['aog'];
            } elseif ($row['aog'] <= '27') {
                $thirteen = $row['aog'];
            } else {
                $twentyseven = $row['aog'] >= '28';
            }
            $output .= '
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
                <td class="col-auto">' . $prenatal["total"] . '</td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
            </tr>
            <tr>
                <td class="col-8 float-end"> - 2nd trimester</td>
                <td class="col-auto"></td>
                <td class="col-auto">' . $prenatal["total"] . '</td>
                <td class="col-auto"></td>
            </tr>
            <tr>
                <td class="col-8 float-end"> - 3rd trimester</td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
                <td class="col-auto">' . $prenatal["total"] . '</td>
            </tr>
            <tr>
                <td class="col-8 ps-4">b. Number of antenatal care check - ups monitored</td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
            </tr>
            <tr>
                <td class="col-8 ps-5"> - 1st trimester (up to 12 weeks and 6 days AOG)</td>
                <td class="col-auto">' . $twelve . '</td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
            </tr>
            <tr>
                <td class="col-8 ps-5"> - 2nd trimester (13-27 weeks and 6 days AOG)</td>
                <td class="col-auto">' . $thirteen . '</td>
                <td class="col-auto"></td>
                <td class="col-auto"></td>
            </tr>
            <tr>
                <td class="col-8 ps-5"> - 3rd trimester (28 weeks AOG and more )</td>
                <td class="col-auto">' . $twentyseven . '</td>
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
            </tr><tr>
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
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}

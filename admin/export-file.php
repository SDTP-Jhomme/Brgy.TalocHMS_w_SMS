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
            <th>ACTIVITY</th>
            <th>NO. ACCOMPLISHED</th>
            <th></th>
            <th></th>
            <th>REMARKS</th>
        </tr>
        <tr>
            <th>RMCHN</th>
            <th>10-14 y.o.</th>
            <th>15-19 y.o.</th>
            <th>20-49 y.o.</th>
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
                <th>I. MATERNAL CARE</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>1. No. of pregnant women identified and refered and tracked</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>a. Number of pregnant women seen - 1st trimester</td>
                <td>' . $prenatal["total"] . '</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td> - 2nd trimester</td>
                <td></td>
                <td>' . $prenatal["total"] . '</td>
                <td></td>
            </tr>
            <tr>
                <td> - 3rd trimester</td>
                <td></td>
                <td></td>
                <td>' . $prenatal["total"] . '</td>
            </tr>
            <tr>
                <td>b. Number of antenatal care check - ups monitored</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td> - 1st trimester (up to 12 weeks and 6 days AOG)</td>
                <td>' . $twelve . '</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td> - 2nd trimester (13-27 weeks and 6 days AOG)</td>
                <td>' . $thirteen . '</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td> - 3rd trimester (28 weeks AOG and more )</td>
                <td>' . $twentyseven . '</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2. No. of pregnant women delivered this month</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Pregnancy Outcome</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>-Live birth</td>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
            <td>-Preterm</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Still Birth</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Abortion</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Gender of the Baby</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Boy</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Girl</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>No. of home delivered mother/newborn/transferred in referred to midwife</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3. Mother and Child Postnatal Check-up, followed-up and referred</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Day of discharged/24 hours after birth</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>-Within 7 days after birth</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4. Number of postpartum mothers monitored on exclusive breastfeeding</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5. Number of lactating mothers given Vit A (within 4 weeks)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th>Family Planning</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>1. A Number of women referred for Family Planning(NEW)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>a. IUD (Interval)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> IUD (Postpartum)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>b. DMPA</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>c. PILLS (COC - Combined Oral Contraceptive)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> PILLS (POP) - (Progestin Only Pill)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>d. IMPLANTS(PSI)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>e. CONDOM</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>f. Vasectomy</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>g. BTL(Bilateral Tubal Ligation)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>h. Fertility Awareness Bases Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- SDM (Standard Days Method)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- STM (Syptho-thermal Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - BBT(Basal Body Temperature</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- CCM (Cervical-Mucus Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>B. Number of women <b>USING</b> Family Planning method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>a. IUD (Interval)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> IUD (Postpartum)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>b. DMPA</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>c. PILLS (COC - Combined Oral Contraceptive)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> PILLS (POP) - (Progestin Only Pill)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>d. IMPLANTS(PSI)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>e. CONDOM</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>f. Vasectomy</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>g. BTL(Bilateral Tubal Ligation)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>h. Fertility Awareness Bases Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- SDM (Standard Days Method)</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- STM (Syptho-thermal Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> - BBT(Basal Body Temperature</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>- CCM (Cervical-Mucus Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2. A Number of WRA profiled and masterlisted</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3. A Number of WRA who do not practice any Family Planning Method</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=monthly-report.xls');
        echo $output;
    }
}

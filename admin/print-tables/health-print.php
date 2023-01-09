<div id="dvContents">
    <table class="table table-bordered" cellspacing="0" rules="all" border="1">
        <thead>
            <tr>
                <th class="col-3">FSN</th>
                <th class="col-7">Name</th>
                <th class="col-5">Purok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($db, "SELECT * FROM patient INNER JOIN individual_treatment ON individual_treatment.patient_id=patient.id");
            $i = 1;

            while ($data_row = mysqli_fetch_assoc($data)) {
                $fullname = ucfirst($data_row["first_name"]) . " " . trim(substr(ucfirst($data_row["middle_name"]), 0, 1), "undefined, U") . " " . ucfirst($data_row["last_name"]) . " " . trim($data_row["suffix"], "undefined");

            ?>
                <tr>
                    <td class="col-3"><?php echo $i++; ?></td>
                    <td class="col-7"><?php echo $fullname ?></td>
                    <td class="col-4"><?php echo $data_row['purok'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
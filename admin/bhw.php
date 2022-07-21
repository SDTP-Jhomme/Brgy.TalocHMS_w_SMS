<?php

$retrieve_users = mysqli_query($db, "SELECT * FROM users");

?>



<div class="lg-start mt-4">
    <a href="<?php echo "?addBHW=$addBHW"; ?>" class="btn btn-primary btn-sm">Add New BHW</a>
</div>
<div class="card mb-4 mt-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        BHW Information Table
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Identification No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th class="action-sort">Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Username</th>
                    <th>Identification No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th class="action-sort">Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <?php

                while ($users_row = mysqli_fetch_assoc($retrieve_users)) {

                    $user_id = $users_row["id"];
                    $username = $users_row["username"];
                    $first_name = $users_row["first_name"];
                    $last_name = $users_row["last_name"];
                    $bhw_id = $users_row["bhw_id"];
                    $birthdate = $users_row["birthday"];
                    $gender = $users_row["gender"];

                    echo    "<tr>
                                    <td>$username</td>
                                    <td>$bhw_id</td>
                                    <td>$first_name</td>
                                    <td>$last_name</td>
                                    <td>$birthdate</td>
                                    <td>$gender</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='?editBHW=$editBHW && id=$user_id' title='Edit'><i class='fas fa-edit'></i></a>
                                        <a class='btn btn-danger btn-sm' href='' title='Edit'><i class='fas fa-trash'></i></a>
                                    </td>
                            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
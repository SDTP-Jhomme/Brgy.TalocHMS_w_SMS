<?php

$retrieve_users = mysqli_query($db, "SELECT * FROM users");
$rowcount = mysqli_num_rows($retrieve_users);

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
                    <th>No.</th>
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
                    <th>No.</th>
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

                $i = 0;

                while (($users_row = mysqli_fetch_assoc($retrieve_users)) && ($i <= $rowcount)) {

                    $user_id = $users_row["id"];
                    $username = $users_row["username"];
                    $first_name = $users_row["first_name"];
                    $last_name = $users_row["last_name"];
                    $bhw_id = $users_row["bhw_id"];
                    $birthdate = $users_row["birthday"];
                    $birthday = date("F d, Y", strtotime($birthdate));
                    $gender = $users_row["gender"];
                    $i++;


                    echo    "<tr>
                                    <td style='display: none' class='bhw-id'>$user_id</td>
                                    <td>$i</td>
                                    <td class='bhw-username'>$username</td>
                                    <td>$bhw_id</td>
                                    <td>$first_name</td>
                                    <td>$last_name</td>
                                    <td>$birthday</td>
                                    <td>$gender</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='?editBHW=$editBHW && id=$user_id' title='Edit'><i class='fas fa-edit'></i></a>
                                        <a class='btn btn-danger btn-sm' href='javascript:void(0)' title='Delete'><i class='fas fa-trash'></i></a>
                                    </td>
                            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="delete.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-circle-exclamation" style="color: #ffc107"></i> Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input id="delete-id" name="id" type="hidden" />
                    This will permanently delete user <span class="bhw-modal-username"></span>. Continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn.btn-danger.btn-sm').click(function(e) {
            e.preventDefault();

            var bhwID = $(this).closest('tr').find('.bhw-id').text();
            var bhwUsername = $(this).closest('tr').find('.bhw-username').text();

            $('.bhw-modal-username').html(bhwUsername);
            $('#delete-id').val(bhwID);
            $('#deleteModal').modal('show')

        });
    });
</script>
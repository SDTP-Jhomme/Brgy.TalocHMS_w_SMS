<?php

$retrieve_users = mysqli_query($db, "SELECT * FROM users");
$rowcount = mysqli_num_rows($retrieve_users);

?>

<div class="d-flex ">
    <div class="lg-start mt-4 pe-4">
        <a href="<?php echo "index?addBHW=$addBHW"; ?>" class="btn btn-primary"><i class="fas fa-user pe-2 mb-0"></i>Add New BHW</a>
    </div>
    <div class="lg-start mt-4">
        <button class="btn btn-danger btn-bulk-delete"><i class="fas fa-trash pe-2 mb-0"></i>Bulk Delete</button>
    </div>
</div>

<div class="alert alert-success alert-dismissible fade <?php if (isset($_GET['alertAdd'])) {
                                                            echo "show d-block";
                                                        } else {
                                                            echo "hide d-none";
                                                        } ?> mt-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-circle-check pe-2 h3 mb-0"></i><strong class="pe-1">Success! </strong> New BHW has been added successfully.
    </div>
    <button id="alertAdd" type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if (isset($_GET['alertUpdate'])) {
                                                            echo "show d-block";
                                                        } else {
                                                            echo "hide d-none";
                                                        } ?> mt-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-circle-check pe-2 h3 mb-0"></i><strong class="pe-1">Success! </strong> BHW has been updated successfully.
    </div>
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if (isset($_GET['alertDelete'])) {
                                                            echo "show d-block";
                                                        } else {
                                                            echo "hide d-none";
                                                        } ?> mt-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-circle-check pe-2 h3 mb-0"></i><strong class="pe-1">Success! </strong> BHW has been deleted successfully.
    </div>
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="alert alert-success alert-dismissible fade <?php if (isset($_GET['alertBulkDelete'])) {
                                                            echo "show d-block";
                                                        } else {
                                                            echo "hide d-none";
                                                        } ?> mt-4" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-circle-check pe-2 h3 mb-0"></i><strong class="pe-1">Success! </strong> Selected BHWs has been deleted successfully.
    </div>
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <th class="no-sort"><input class="check-all form-check-input" type="checkbox" value=""></th>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Identification No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th class="no-sort">Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="no-sort"><input class="check-all form-check-input" type="checkbox" value=""></th>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Identification No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th class="no-sort">Actions</th>
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
                                    <td><input class='check-box form-check-input' name='delete_user[]' type='checkbox' value='$user_id'></td>
                                    <td>$i</td>
                                    <td class='bhw-username'>$username</td>
                                    <td class='bhw-id'>$bhw_id</td>
                                    <td class='bhw-first-name'>$first_name</td>
                                    <td class='bhw-last-name'>$last_name</td>
                                    <td class='bhw-birthday'>$birthday</td>
                                    <td class='bhw-gender'>$gender</td>
                                    <td style='width: 10%'>
                                        <a class='btn btn-warning btn-sm btn-view' style='color: #FFFFFF;' href='javascript:void(0)' title='View'><i class='fas fa-eye'></i></a>
                                        <a class='btn btn-primary btn-sm' href='?editBHW=$editBHW && id=$user_id' title='Edit'><i class='fas fa-edit'></i></a>
                                        <a class='btn btn-danger btn-sm btn-delete' href='javascript:void(0)' title='Delete'><i class='fas fa-trash'></i></a>
                                    </td>
                            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</form>

<!-- Modal Confirm Bulk Delete -->
<div class="modal fade" id="deleteBulkModal" tabindex="-1" aria-labelledby="deleteBulkModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-circle-exclamation" style="color: #ffc107"></i> Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                This will permanently delete selected users. Continue?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="confirmDelete" type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Bulk Error Delete -->
<div class="modal fade" id="deleteBulkModalError" tabindex="-1" aria-labelledby="deleteBulkModalError" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please select atleast one (1) user.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./delete">
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

<!-- Modal View -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalValue"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="">Identification Number</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control identification" disabled>
                </div>
                <label class="">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control name" disabled>
                </div>
                <label class="">Birthday</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control birthday" disabled>
                </div>
                <label class="">Gender</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control gender" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
        
        $('.btn-close-alert').click(function() {
            $(location).prop('href', 'index?viewBHW=<?php echo $viewBHW; ?>')
        });

        $('.btn-bulk-delete').click(function(e) {
            if ($('.check-box').is(":checked")) {
                $('#deleteBulkModal').modal('show')
            } else {
                $('#deleteBulkModalError').modal('show')
            }
        });

        $('#confirmDelete').click(function(e) {
            var arrayID = [];
            $(".check-box:checked").each(function() {
                arrayID.push(this.value);
            });
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: {
                    'delete_user': arrayID,
                    'confirmDelete': 1
                },
                success: function(msg) {
                    $(location).prop('href', 'index?viewBHW=<?php echo "$viewBHW && alertBulkDelete=$alert"; ?>')
                }
            });
        });

        $('.btn-view').click(function(e) {
            e.preventDefault();

            var bhwUsername = $(this).closest('tr').find('.bhw-username').text();
            var bhwIdentification = $(this).closest('tr').find('.bhw-id').text();
            var bhwFirstName = $(this).closest('tr').find('.bhw-first-name').text();
            var bhwLastName = $(this).closest('tr').find('.bhw-last-name').text();
            var bhwBirthday = $(this).closest('tr').find('.bhw-birthday').text();
            var bhwGender = $(this).closest('tr').find('.bhw-gender').text();


            $('#viewModalValue').html("Showing " + bhwUsername);
            $('.identification').val(bhwIdentification);
            $('.name').val(bhwFirstName + " " + bhwLastName);
            $('.birthday').val(bhwBirthday);
            $('.gender').val(bhwGender);

            $('#viewModal').modal('show')

        });

        $('.btn-delete').click(function(e) {
            e.preventDefault();

            var bhwID = $(this).closest('tr').find('.bhw-id').text();
            var bhwUsername = $(this).closest('tr').find('.bhw-username').text();

            $('.bhw-modal-username').html(bhwUsername);
            $('#delete-id').val(bhwID);
            $('#deleteModal').modal('show')

        });

        $('.no-sort .dataTable-sorter').removeClass('dataTable-sorter');

        $(".check-all").change(function() {
            var checked = $(this).is(':checked');
            if (checked) {
                $(".check-box").each(function() {
                    $(this).prop("checked", true);
                });
            } else {
                $(".check-box").each(function() {
                    $(this).prop("checked", false);
                });
            }
        });

    });
</script>
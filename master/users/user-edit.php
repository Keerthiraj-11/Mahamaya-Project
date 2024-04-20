<?php 
require '../include/dbconnection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cluster Edit</title>
</head>
<body>

<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="formContainer">
                    <?php 
                    if(isset($_GET['id'])) {
                        $student_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM users WHERE id='$student_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            $student = mysqli_fetch_array($query_run);
                    ?>
                    <form action="/master/include/code" method="POST" id="userEditForm">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                        <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>User Name</label>
                                    <input type="text" name="name" value="<?= $student['userName']; ?>" class="form-control"  placeholder="Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>User Type</label>
                                    <select class="form-select" name="userType" aria-label="Default select example">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Admin" <?= ($student['userType'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="Normal" <?= ($student['userType'] == 'Normal') ? 'selected' : ''; ?>>Normal</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>User Status</label>
                                    <select class="form-select" name="userStatus" aria-label="Default select example">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Active" <?= ($student['userStatus'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="Deactive" <?= ($student['userStatus'] == 'Deactive') ? 'selected' : ''; ?>>Deactive</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <!--
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>User Type</label>
                                    <select name="langOpt[]" multiple id="langOpt">
                                        <option value="C++"><input type="checkbox" />Check</option>
                                        <option value="C#">C#</option>
                                        <option value="Java">Java</option>
                                        <option value="Objective-C">Objective-C</option>
                                        <option value="JavaScript">JavaScript</option>
                                        <option value="Perl">Perl</option>
                                        <option value="PHP">PHP</option>
                                        <option value="Ruby on Rails">Ruby on Rails</option>
                                        <option value="Android">Android</option>
                                        <option value="iOS">iOS</option>
                                        <option value="HTML">HTML</option>
                                        <option value="XML">XML</option>
                                    </select>
                                </div>
                                -->
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Password</label>
                                    <input type="password" name="userPassword" value="<?= $student['userPassword']; ?>" class="form-control"  placeholder="Password">
                                    <small class="error"></small>
                                </div>
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Confirm</label>
                                    <input type="password" name="userConfirmPassword" value="<?= $student['userPassword']; ?>" class="form-control"  placeholder="Confirm Password">
                                    <small class="error"></small>
                                </div>
                            </div>  

                            <input type="hidden" name="add_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                            <!--<div class="mb-3">
                                <button type="submit" name="save_school" class="btn btn-primary">Save Student</button>
                            </div>-->
                            <!-- Add a hidden input field for the current URL -->
                            <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="editUser">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="edit_user" class="btn btn-primary">Save changes</button>
                            </div>


                    </form>
                    <?php } else { echo ""; }} ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

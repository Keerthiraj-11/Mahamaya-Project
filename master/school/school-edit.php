<?php 
require '../include/dbconnection.php';
$cluster_query = "SELECT cid, cname FROM cluster_add";
$cluster_result = mysqli_query($con, $cluster_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Edit</title>
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
                        $query = "SELECT * FROM school_add WHERE id='$student_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            $student = mysqli_fetch_array($query_run);
                    ?>
                    <form action="/master/include/code" method="POST" id="updateSchool">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                        <div class="mb-3 input-control" >
                            <label>School Name</label>
                            <input type="text" name="updateName" value="<?= $student['sname']; ?>" class="form-control">
                            <small class="error"></small>
                        </div>
                        <div class="mb-3 input-control">
                            <label>School Location</label>
                            <input type="text" name="updateLocation" value="<?= $student['slocation']; ?>" class="form-control">
                            <small class="error"></small>
                        </div>
                        <div class="mb-3 input-control">
                            <label>School Phone</label>
                            <input type="text" name="updatePhone" value="<?= $student['sphone']; ?>" class="form-control">
                            <small class="error"></small>
                        </div>
                        <div class="mb-3 input-control">
                            <label>School Email</label>
                            <input type="email" name="updateEmail" value="<?= $student['semail']; ?>" class="form-control">
                            <small class="error"></small>
                        </div>
                        <div class="mb-0 input-control">
                            <select class="form-select" name="updateCluster" aria-label="Select Cluster">
                                <option value="" disabled>Select Cluster</option>
                                <?php
                                $studentCluster = substr($student['sownedby'], 0, 3); // Get the first three characters of the student's sownedby value

                                while ($row = mysqli_fetch_assoc($cluster_result)) {
                                    $cluster_id = $row['cid'];
                                    $cluster_name = $row['cname'];

                                    // Check if the first three characters of the current cluster ID match the student's cluster ID
                                    $selected = (substr($cluster_id, 0, 3) == $studentCluster) ? 'selected' : '';

                                    // Output option with cluster name and set selected attribute if matched
                                    echo "<option value='$cluster_id' $selected>$cluster_name</option>";
                                }
                                ?>
                            </select>
                            <small class="error"></small>
                        </div>


                        <input type="hidden" name="add_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update_school" class="btn btn-primary">Update School</button>
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

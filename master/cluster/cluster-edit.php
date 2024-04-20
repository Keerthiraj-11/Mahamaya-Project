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
                        $query = "SELECT * FROM cluster_add WHERE id='$student_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            $student = mysqli_fetch_array($query_run);
                    ?>
                    <form action="/master/include/code" method="POST" id="clusterUpdate">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                        <div class="mb-3 input-control">
                            <label>Cluster Name</label>
                            <input type="text" name="updateCname" value="<?= $student['cname']; ?>" class="form-control" placeholder="Ex: Cluster-01">
                            <small class="error"></small>
                        </div>
                        <div class="mb-3 input-control">
                            <label>Cluster Owned-By</label>
                            <input type="text" name="updateCownedby" value="<?= $student['cownedby']; ?>" class="form-control" placeholder="Cluster Handled-By">
                            <small class="error"></small>
                        </div>
                    
                        <input type="hidden" name="updateCid" class="form-control" placeholder="Ex:- C01">
                        <input type="hidden" name="updateCadd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="updateCluster">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update_cluster" class="btn btn-primary">Save changes</button>
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

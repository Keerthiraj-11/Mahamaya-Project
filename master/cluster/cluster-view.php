<?php 
require '../include/dbconnection.php';

if(isset($_GET['id'])) {
    // Sanitize and validate the ID parameter
    $student_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if($student_id === false) {
        // Handle invalid ID
        echo "Invalid ID";
        exit; // Stop further execution
    }

    // Prepare and execute the query
    $query = "SELECT * FROM cluster_add WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if any rows are returned
    if(mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_array($result);
        // Display the school details
        ?>
        <div class="container mt-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Cluster Name</label>
                                <p class="form-control"><?=$student['cname'];?></p>
                            </div>
                            <div class="mb-3">
                                <label>Cluster Owned-By</label>
                                <p class="form-control"><?=$student['cownedby'];?></p>
                            </div>
                            <div class="mb-3">
                                <label>Cluster ID</label>
                                <p class="form-control"><?=$student['cid'];?></p>
                            </div>
                            <div class="mb-3">
                                <label>Cluster Add-Date</label>
                                <p class="form-control"><?=$student['cadddate'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // No record found with the given ID
        echo "No record found with the given ID";
    }
} else {
    // ID parameter is not set
    echo "ID parameter is not set";
}
?>

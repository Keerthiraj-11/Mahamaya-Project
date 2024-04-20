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
    $query = "SELECT * FROM admission WHERE id = ?";
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
                            <div class="col-sm-15 row mb-3">
                                <div class="align-middle admissionPic">
                                    <label>Student Photo</label>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($student['studentPic']); ?>" alt="Student Image"  width="100" height="100" style="border-radius: 50%;" />
                                </div>
                            </div>



                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Name</label>
                                    <p class="form-control"><?=$student['name'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>DOB</label>
                                    <p class="form-control"><?=$student['dob'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Collage Name</label>
                                    <p class="form-control"><?=$student['collage'];?></p>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class</label>
                                    <p class="form-control"><?=$student['class'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Board</label>
                                    <p class="form-control"><?=$student['board'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Prevoius Class %</label>
                                    <p class="form-control"><?=$student['pClassPer'];?></p>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Father Name</label>
                                    <p class="form-control"><?=$student['parent'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Occupation</label>
                                    <p class="form-control"><?=$student['occupation'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Address</label>
                                    <p class="form-control"><?=$student['address'];?></p>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Student Number</label>
                                    <p class="form-control"><?=$student['studentNum'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Parent Number</label>
                                    <p class="form-control"><?=$student['parentNum'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Email</label>
                                    <p class="form-control"><?=$student['sEmail'];?></p>
                                </div>
                            </div>
                            

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Religion</label>
                                    <p class="form-control"><?=$student['religion'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Caste</label>
                                    <p class="form-control"><?=$student['caste'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>1st Language</label>
                                    <p class="form-control"><?=$student['fLang'];?></p>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>2nd Language</label>
                                    <p class="form-control"><?=$student['sLang'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Stream</label>
                                    <p class="form-control"><?=$student['stream'];?></p>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class Mode</label>
                                    <p class="form-control"><?=$student['cMode'];?></p>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-5">
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Add-Date</label>
                                    <p class="form-control"><?=$student['adddate'];?></p>
                                </div>

                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Admission Year</label>
                                    <p class="form-control"><?=$student['aYear'];?></p>
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="col-8">
                                    <label>10th Marks Photo</label><br/>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($student['sslcMarks']); ?>" alt="10th Marks Image" style="max-width: 100%; max-height: 700px;">
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="col-8">
                                    <label>Mid-term Marks Photo</label><br/>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($student['midtermMarks']); ?>" alt="Mid-term Marks Image" style="max-width: 100%;max-height: 700px;">
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

<?php 
require '../include/dbconnection.php';

// Check if 'id' and 'marksDataValue' are set in $_GET
if(isset($_GET['id']) && isset($_GET['marksDataValue'])) {
    // Sanitize and validate the ID parameter
    $student_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    $marksDataValue = filter_var($_GET['marksDataValue'], FILTER_VALIDATE_INT);

    // Check if ID is valid
    if($student_id === false) {
        // Handle invalid ID
        echo "Invalid ID";
        exit; // Stop further execution
    }

    // Check if marksDataValue is valid
    if($marksDataValue === false || ($marksDataValue < 1 || $marksDataValue > 3)) {
        // Handle invalid marksDataValue
        $error = ['error' => 'Invalid marks value'];
        header('Content-Type: application/json');
        echo json_encode($error);
        exit(); // Terminate script execution
    }

    // Check the value of marks
    switch ($marksDataValue) {
        case '1':
            $table = 'student_add_details1';
            break;
        case '2':
            $table = 'student_add_details2';
            break;
        case '3':
            $table = 'student_add_details3';
            break;
        default:
            // Error handling for invalid marks value
            $error = ['error' => 'Invalid marks value'];
            header('Content-Type: application/json');
            echo json_encode($error);
            exit(); // Terminate script execution
    }

    // Prepare and execute the query
    $query = "SELECT * FROM $table WHERE id = ?";
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
                <div class="card-body" id="formContainer">
 
                    <div class="input-control mb-4">
                        <h5>School Name</h5>
                        <p class="form-control"><b><?=$student['schoolName'];?>(<?=$student['schoolId'];?>)</b></p>
                    </div>


                    <div class="col-sm-15 row mb-1">
                        <div class="col-8 col-sm-4 input-control">
                            <label>Student Name</label>
                            <p class="form-control"><?=$student['studentName'];?></p>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Student Class</label>
                            <p class="form-control"><?=$student['std'];?></p>    
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Board</label>
                            <p class="form-control"><?=$student['studentBoard'];?></p>
                        </div>
                    </div>

                    <div class="col-sm-15 row mb-1">
                        <div class="col-8 col-sm-4 input-control">
                            <label>Gender</label>
                            <p class="form-control"><?=$student['studentGender'];?></p>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Phone Number</label> 
                            <p class="form-control"><?=$student['studentContact'];?></p>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Parent Name</label>
                            <p class="form-control"><?=$student['studentParent'];?></p>
                        </div>
                    </div>

                    <div class="col-sm-18 row mb-3">
                        <div class="col-8 col-sm-4 input-control">
                            <label>Occupation</label>
                            <p class="form-control"><?=$student['studentParentOccupation'];?></p>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>School ID</label>
                            <p class="form-control"><?=$student['schoolId'];?></p>    
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Student Add-date</label>
                            <p class="form-control"><?=$student['studentAddDate'];?></p>
                        </div>
                    </div>


                    <h5>Student Marks</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Max-Marks</th>
                            <th scope="col">Min-Marks</th>
                            <th scope="col">Marks Optained</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">KANNADA</th>
                            <td>125</td>
                            <td>35</td>
                            <td><?=$student['subKan'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">ENGLISH</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['subEng'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">HINDI</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['subHin'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">MATHS/th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['subMat'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">SCIENCE</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['subSci'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">SOCIAL</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['subSoc'];?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
        
                        <tbody>
                            <tr>
                            <td colspan="2">Total marks(625)</td>
                            <td><b><?=$student['total'];?></b></td>
                            </tr>
                            <tr>
                            <td colspan="2">Percentage</td>
                            <td><b><?=$student['percentage'];?></b></td>
                            </tr>
                            </tr>
                            <tr>
                            <td colspan="2">Result</td>
                            <td><b><?=$student['result'];?></b></td>
                            </tr>
                        </tbody>
                    </table>
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

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
            $table = 'firstpuc';
            break;
        case '2':
            $table = 'secondpuc';
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
                <div class="card-body">
                    <div class="input-control  mb-3">
                        <label>Collage Name</label>
                        <p class="form-control"><?=$student['cName'];?></p>   
                    </div>
               
                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Name</label>
                            <p class="form-control"><?=$student['sName'];?></p>  
                        </div>
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Class</label>
                            <p class="form-control"><?=$student['class'];?></p>  
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Gender</label>
                            <p class="form-control"><?=$student['gender'];?></p>  
                        </div>

                    <div class="col-sm-15 row mb-3">
                        
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Parent Name</label>
                            <p class="form-control"><?=$student['parentName'];?></p>  
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Parent Occupation</label>
                            <p class="form-control"><?=$student['parentOcp'];?></p>  
                        </div> 

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Contact Number</label>
                            <p class="form-control"><?=$student['studentNum'];?></p>  
                        </div>
                    </div>


                    <div class="col-sm-15 row mb-3">

                        <div class="col-8 col-sm-4 input-control">
                            <label>Stream</label>
                            <p class="form-control"><?=$student['stream'];?></p>  
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>1st Language</label>
                            <?php
                                if($student['fLang'] == 'E'){
                                    echo '<p class="form-control">ENGLISH</p>';
                                } else if($student['fLang'] == 'S'){
                                    echo '<p class="form-control">SANSKRIT</p>';
                                } else if($student['fLang'] == 'H'){
                                    echo '<p class="form-control">HINDI</p>';
                                } else if($student['fLang'] == 'K'){
                                    echo '<p class="form-control">KANNADA</p>';
                                } else {
                                    echo '<p class="form-control">Empty Value</p>';
                                }
                            ?>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>2nd Language</label>
                            <?php
                                if($student['fLang'] == 'E'){
                                    echo '<p class="form-control">ENGLISH</p>';
                                } else if($student['fLang'] == 'S'){
                                    echo '<p class="form-control">SANSKRIT</p>';
                                } else if($student['fLang'] == 'H'){
                                    echo '<p class="form-control">HINDI</p>';
                                } else if($student['fLang'] == 'K'){
                                    echo '<p class="form-control">KANNADA</p>';
                                } else {
                                    echo '<p class="form-control">Empty Value</p>';
                                }
                            ?>  
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
                            <th scope="row">1st Language</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['fMark'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">2nd Lanuage</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['sMark'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">Physics</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['physics'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">Chemistry</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['chemistry'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">Maths</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['maths'];?></td>
                            </tr>
                            <tr>
                            <th scope="row">Bio/Cs/Ele</th>
                            <td>100</td>
                            <td>35</td>
                            <td><?=$student['biology'];?></td>
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

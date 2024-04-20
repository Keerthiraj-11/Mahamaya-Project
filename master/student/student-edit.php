
<?php 
require '../include/dbconnection.php';
$cluster_query = "SELECT sname, sownedby FROM school_add";
$cluster_result = mysqli_query($con, $cluster_query);
?>


<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="formContainer">

                <?php 
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
                            $marksFor = '1';
                            break;
                        case '2':
                            $table = 'student_add_details2';
                            $marksFor = '2';
                            break;
                        case '3':
                            $table = 'student_add_details3';
                            $marksFor = '3';
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
                    <form action="/master/include/code" method="POST" id="studentedit">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                        
                        <div class=" input-control mb-3">
                            <!-- set option selected based on $marksFor-->
                            <select class="form-select" name="studentMarksFor" aria-label="Default select example">
                                <option value="" disabled selected>Select Marks Entry For</option>
                                <option value="semiMarks" <?= ($marksFor == '1') ? 'selected' : ''; ?>>9th Final Exam Marks</option>
                                <option value="midMarks" <?= ($marksFor == '2') ? 'selected' : ''; ?>>10th Midterm Mark</option>
                                <option value="finalMarks" <?= ($marksFor == '3') ? 'selected' : ''; ?>>10th Final Exam Mark</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="input-control mb-3">
                            <!-- Select the value from DB if not select option Default -->
                            <select class="form-select" name="studentSchool" id="studentSchool" aria-label="Select School Name">
                                <?php
                                $studentID = substr($student['schoolId'], 0, 7);
                                $defaultOption = "<option value='' disabled selected>Select School Name</option>";
                                echo $defaultOption;
                                $foundMatch = false; // Initialize a flag to track if a match is found
                                while ($row = mysqli_fetch_assoc($cluster_result)) {
                                    $cluster_id = $row['sownedby'];
                                    $cluster_name = $row['sname'];
                                    $selected = ($studentID == $cluster_id) ? 'selected' : '';
                                    echo "<option value='$cluster_name' data-clusterid='$cluster_id' $selected>$cluster_name</option>";
                                    if ($selected) {
                                        $foundMatch = true; // Update flag if a match is found
                                    }
                                }
                                // If no match is found, select the default option
                                if (!$foundMatch) {
                                    echo $defaultOption;
                                }
                                ?>
                            </select>
                            <small class="error"></small>    
                        </div>
                
                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control ">
                                <label>Student Name</label>
                                <input type="text" name="studentName" value="<?=$student['studentName'];?>" class="form-control" placeholder="Student Name">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Student Standard</label>
                                <select class="form-select" name="studentStd" aria-label="Default select example">
                                    <?php
                                    $options = array(
                                        '9th' => '9th Standard',
                                        '10th' => '10th Standard',
                                        // Add more options as needed
                                    );
                                    
                                    $defaultOption = true; // Flag to track if a matching option is found

                                    foreach ($options as $value => $label) {
                                        if ($student['std'] == $value) {
                                            echo "<option value=\"$value\" selected>$label</option>";
                                            $defaultOption = false; // Set the flag to false if a match is found
                                        } else {
                                            echo "<option value=\"$value\">$label</option>";
                                        }
                                    }

                                    // If no match is found, set the default option
                                    if ($defaultOption) {
                                        echo '<option value="" disabled selected>Select Class</option>';
                                    }
                                    ?>
                                </select>
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Student Gender</label>
                                <select class="form-select" name="studentGender" aria-label="Default select example">
                                    <?php if ($student['studentGender'] == 'Male'): ?>
                                        <option value="Male" selected>Male</option>
                                        <option value="female">Female</option>
                                    <?php elseif ($student['studentGender'] == 'Female'): ?>
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
                                    <?php else: ?>
                                        <option value="" disabled selected>Select Class</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    <?php endif; ?>
                                </select>
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control">
                                <label>Contact Number</label>
                                <input type="text" name="studentContact" value="<?=$student['studentContact'];?>" class="form-control" placeholder="Student Phone Number">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Parent Name</label>
                                <input type="text" name="studentParent" value="<?=$student['studentParent'];?>" class="form-control" placeholder="Parent Name">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Parent Occupation</label>
                                <input type="text" name="studentParOcu" value="<?=$student['studentParentOccupation'];?>" class="form-control" placeholder="Parent Occupation">
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control">
                                <label>Student Board</label>
                                <select class="form-select" name="studentBoard" aria-label="Default select example">
                                    <?php if ($student['studentBoard'] == 'State'): ?>
                                        <option value="State" selected>State</option>
                                        <option value="CBSE">CBSE</option>
                                    <?php elseif ($student['studentBoard'] == 'CBSE'): ?>
                                        <option value="State">State</option>
                                        <option value="CBSE" selected>CBSE</option>
                                    <?php else: ?>
                                        <option value="" disabled selected>Select Class</option>
                                        <<option value="State">State</option>
                                        <option value="CBSE">CBSE</option>
                                    <?php endif; ?>
                                </select>
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Student Medium</label>
                                <select class="form-select" name="sMediumEdit" aria-label="Default select example">
                                    <?php if ($student['studentMedium'] == 'Kan'): ?>
                                        <option value="Kan" selected>KANNADA</option>
                                        <option value="Eng">ENGKISH</option>
                                    <?php elseif ($student['studentMedium'] == 'Eng'): ?>
                                        <option value="Kan">KANNADA</option>
                                        <option value="Eng" selected>ENGKISH</option>
                                    <?php else: ?>
                                        <option value="" disabled selected>Select Class</option>
                                        <option value="Kan">KANNADA</option>
                                        <option value="Eng">ENGKISH</option>
                                    <?php endif; ?>
                                </select>
                                <small class="error"></small>
                            </div>
                        </div>

                        <h5>Student Marks</h1>
                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control ">
                                <label>KANNADA</label>
                                <input type="text" name="subKan" value="<?=$student['subKan'];?>" class="form-control" placeholder="Kannada Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>ENGLISH</label>
                                <input type="text" name="subEng" value="<?=$student['subEng'];?>" class="form-control" placeholder="English Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                                <label>HINDI</label>
                                <input type="text" name="subHin" value="<?=$student['subHin'];?>" class="form-control" placeholder="Hindi Marks">
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            
                            <div class="col-8 col-sm-4 input-control">
                                <label>MATHS</label>
                                <input type="text" name="subMat" value="<?=$student['subMat'];?>" class="form-control" placeholder="Maths Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                                <label>SCIENCE</label>
                                <input type="text" name="subSci" value="<?=$student['subSci'];?>" class="form-control" placeholder="Science Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>SOCIAL</label>
                                <input type="text" name="subSoc" value="<?=$student['subSoc'];?>" class="form-control" placeholder="Social Marks">
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            
                        </div>
                    
                        <input type="hidden" name="marksTotal" value="">
                        <input type="hidden" name="percentage" value="">
                        <input type="hidden" name="studentResult" value="">
                        <input type="hidden" name="schoolIdEdit" id="schoolIdEdit" value="">
                        <input type="hidden" name="studentAdd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="updateStudent">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update_student" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <?php } else { echo ""; }} ?>
                </div>
            </div>
        </div>
    </div>
</div>
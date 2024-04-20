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
                    if($marksDataValue === false || ($marksDataValue < 1 || $marksDataValue > 2)) {
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
                            $marksFor = '1';
                            break;
                        case '2':
                            $table = 'secondpuc';
                            $marksFor = '2';
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
                    <form action="/master/include/code" method="POST" id="studentEditPuc">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                        <!-- <div class="col-sm-15 row">
                            <div class="col-8 col-sm-6 input-control">
                                <label>Cluster Name</label>
                                <input type="text" name="cname" class="form-control" placeholder="Ex: Cluster-01">
                                <small class="error"></small>
                            </div>
                            <div class="col-8 col-sm-6 input-control row">
                                <label>Cluster Owned-By</label>
                                <input type="text" name="cownedby" class="form-control" placeholder="Cluster Handled-By">
                                <small class="error"></small>
                            </div>
                        </div>-->

                        <!--
                        <div class="mb-0 input-control mb-3">
                            <select class="form-select" name="studentMarksFor" aria-label="Default select example">
                                <option value="" disabled selected>Select Marks Entry For</option>
                                <option value="semiMarks">1st PUC</option>
                                <option value="midMarks">2nd PUC</option>
                            </select>
                            <small class="error"></small>
                        </div>-->

                        <div class="input-control  mb-3">
                            <label>Collage Name</label>
                            <input type="text" name="studentSchool" class="form-control" value="<?=$student['cName'];?>" placeholder="Student Collage">
                            <small class="error"></small>    
                        </div>
                
                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control ">
                                <label>Student Name</label>
                                <input type="text" name="studentName" class="form-control" value="<?=$student['sName'];?>" placeholder="Student Name">
                                <small class="error"></small>
                            </div>
                            <div class="col-8 col-sm-4 input-control ">
                                <label>Student Class</label>
                                <select class="form-select" name="studentStd" aria-label="Default select example">
                                    <option value="" disabled selected>Select Class</option>
                                    <option value="1st PUC" <?= ($student['class'] == '1st PUC') ? 'selected' : ''; ?>>1st PUC</option>
                                    <option value="2nd PUC" <?= ($student['class'] == '2nd PUC') ? 'selected' : ''; ?>>2nd PUC</option>
                                </select>
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                            <label>Student Gender</label>
                                <select class="form-select" name="studentGender" aria-label="Default select example">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male" <?= ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?= ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            
                            <div class="col-8 col-sm-4 input-control ">
                                <label>Parent Name</label>
                                <input type="text" name="studentParent" class="form-control" value="<?=$student['parentName'];?>" placeholder="Parent Name">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                                <label>Parent Occupation</label>
                                <input type="text" name="studentParOcu" class="form-control" value="<?=$student['parentOcp'];?>" placeholder="Parent Occupation">
                                <small class="error"></small>
                            </div> 

                            <div class="col-8 col-sm-4 input-control ">
                                <label>Contact Number</label>
                                <input type="tel" name="studentContact" class="form-control" value="<?=$student['studentNum'];?>" placeholder="Student Phone Number">
                                <small class="error"></small>
                            </div>
                        </div>


                        <div class="col-sm-15 row mb-3">

                            <div class="col-8 col-sm-4 input-control">
                                <label>Stream</label>
                                <select class="form-select" name="studentStream" aria-label="Default select example">
                                    <option value="" disabled selected>Select Stream</option>
                                    <option value="PCMB" <?= ($student['stream'] == 'PCMB') ? 'selected' : ''; ?>>PCMB</option>
                                    <option value="PCMC" <?= ($student['stream'] == 'PCMC') ? 'selected' : ''; ?>>PCMC</option>
                                    <option value="PCME" <?= ($student['stream'] == 'PCME') ? 'selected' : ''; ?>>PCME</option>
                                </select>
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>1st Language</label>
                                <select class="form-select" name="fLang" aria-label="Default select example">
                                    <option value="" disabled selected>Select 1st Language</option>
                                    <option value="K" <?= ($student['fLang'] == 'K') ? 'selected' : ''; ?>>KANNADA</option>
                                    <option value="S" <?= ($student['fLang'] == 'S') ? 'selected' : ''; ?>>SANSKRIT</option>
                                    <option value="E" <?= ($student['fLang'] == 'E') ? 'selected' : ''; ?>>ENGLISH</option>
                                    <option value="H" <?= ($student['fLang'] == 'H') ? 'selected' : ''; ?>>HINDI</option>
                                </select>
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>2nd Language</label>
                                <select class="form-select" name="sLang" aria-label="Default select example">
                                    <option value="" disabled selected>Select 2nd Language</option>
                                    <option value="K" <?= ($student['sLang'] == 'K') ? 'selected' : ''; ?>>KANNADA</option>
                                    <option value="S" <?= ($student['sLang'] == 'S') ? 'selected' : ''; ?>>SANSKRIT</option>
                                    <option value="E" <?= ($student['sLang'] == 'E') ? 'selected' : ''; ?>>ENGLISH</option>
                                    <option value="H" <?= ($student['sLang'] == 'H') ? 'selected' : ''; ?>>HINDI</option>
                                </select>
                                <small class="error"></small>
                            </div>

                        </div>


                        <h5>Student Marks</h1>


                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control ">
                                <label>1st language Mark</label>
                                <input type="number" name="fMark" class="form-control" value="<?=$student['fMark'];?>" placeholder="1st Lang Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>2nd language Mark</label>
                                <input type="number" name="sMark" class="form-control" value="<?=$student['sMark'];?>" placeholder="2nd Lang Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                                <label>Physics</label>
                                <input type="number" name="phyMark" class="form-control" value="<?=$student['physics'];?>" placeholder="Physics Marks">
                                <small class="error"></small>
                            </div>
                        </div>

                        <div class="col-sm-15 row mb-3">
                            <div class="col-8 col-sm-4 input-control">
                                <label>Chemistry</label>
                                <input type="number" name="cheMark" class="form-control" value="<?=$student['chemistry'];?>" placeholder="Chemistry Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control ">
                                <label>Maths</label>
                                <input type="number" name="matMark" class="form-control" value="<?=$student['maths'];?>" placeholder="Maths Marks">
                                <small class="error"></small>
                            </div>

                            <div class="col-8 col-sm-4 input-control">
                                <label>Bio/CS/Ele</label>
                                <input type="number" name="bioMark" class="form-control" value="<?=$student['biology'];?>" placeholder="Bio/Cs/Ele Marks">
                                <small class="error"></small>
                            </div>
                        </div>

                        <input type="hidden" name="marksTotal" value="">
                        <input type="hidden" name="percentage" value="">
                        <input type="hidden" name="studentResult" value="">
                        <input type="hidden" name="studentMarksFor" value="">
                        <input type="hidden" name="studentAdd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="updatePucStudent">
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update_pucStudent" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    <?php } else { echo ""; }} ?>
                </div>
            </div>
        </div>
    </div>
</div>

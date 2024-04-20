<?php
require '../include/dbconnection.php';
$cluster_query = "SELECT sname, sownedby FROM school_add";
$cluster_result = mysqli_query($con, $cluster_query);
?>
<!-- HTML content goes here -->
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/master/include/code" method="POST" id="studentadd">
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

                    <div class="mb-0 input-control mb-3">
                        <select class="form-select" name="studentMarksFor" aria-label="Default select example">
                            <option value="" disabled selected>Select Marks Entry For</option>
                            <option value="semiMarks">9th Final Exam Marks</option>
                            <option value="midMarks">10th Midterm Mark</option>
                            <option value="finalMarks">10th Final Exam Mark</option>
                        </select>
                        <small class="error"></small>
                    </div>

                    <div class="input-control  mb-3">
                        <select class="form-select"  name="studentSchool" id="studentSchool" aria-label="Select School Name">
                            <option value="" disabled selected>Select School Name</option>
                            
                            <?php
                            while ($row = mysqli_fetch_assoc($cluster_result)) {
                                $cluster_id = $row['sownedby'];
                                $cluster_name = $row['sname'];
                                echo "<option value='$cluster_name' data-clusterid='$cluster_id'>$cluster_name</option>";
                            }
                            ?>
                            
                        </select>
                        <small class="error"></small>    
                    </div>
               
                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Name</label>
                            <input type="text" name="studentName" class="form-control" placeholder="Student Name">
                            <small class="error"></small>
                        </div>
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Standard</label>
                            <select class="form-select" name="studentStd" aria-label="Default select example">
                                <option value="" disabled selected>Select Class</option>
                                <option value="9th">9th Standard</option>
                                <option value="10th">10th Standard</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                        <label>Student Gender</label>
                            <select class="form-select" name="studentGender" aria-label="Default select example">
                                <option value="" disabled selected>Select Class</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <small class="error"></small>
                        </div>
                    </div>

                    <div class="col-sm-15 row mb-3">
                        
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Parent Name</label>
                            <input type="text" name="studentParent" class="form-control" placeholder="Parent Name">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Parent Occupation</label>
                            <input type="text" name="studentParOcu" class="form-control" placeholder="Parent Occupation">
                            <small class="error"></small>
                        </div> 

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Contact Number</label>
                            <input type="text" name="studentContact" class="form-control" placeholder="Student Phone Number">
                            <small class="error"></small>
                        </div>
                    </div>


                    <div class="col-sm-15 row mb-3">

                        <div class="col-8 col-sm-4 input-control">
                            <label>Student Board</label>
                            <select class="form-select" name="studentBoard" aria-label="Default select example">
                                <option value="" disabled selected>Select Board</option>
                                <option value="State">State</option>
                                <option value="CBSE">CBSE</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Student Medium</label>
                            <select class="form-select" name="sMedium" aria-label="Default select example">
                                <option value="" disabled selected>Select Medium</option>
                                <option value="Kan">KANNADA</option>
                                <option value="Eng">ENGLISH</option>
                            </select>
                            <small class="error"></small>
                        </div>
                    </div>


                    <h5>Student Marks</h1>
                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>KANNADA</label>
                            <input type="text" name="subKan" class="form-control" placeholder="Kannada Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>ENGLISH</label>
                            <input type="text" name="subEng" class="form-control" placeholder="English Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>HINDI</label>
                            <input type="text" name="subHin" class="form-control" placeholder="Hindi Marks">
                            <small class="error"></small>
                        </div>
                    </div>

                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control">
                            <label>MATHS</label>
                            <input type="text" name="subMat" class="form-control" placeholder="Maths Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>SCIENCE</label>
                            <input type="text" name="subSci" class="form-control" placeholder="Science Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>SOCIAL</label>
                            <input type="text" name="subSoc" class="form-control" placeholder="Social Marks">
                            <small class="error"></small>
                        </div>
                    </div>

                        <input type="hidden" name="marksTotal" value="">
                        <input type="hidden" name="percentage" value="">
                        <input type="hidden" name="studentResult" value="">
                        <input type="hidden" name="schoolId" id="schoolId">
                        <input type="hidden" name="studentAdd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="saveStudent">
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save_student" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

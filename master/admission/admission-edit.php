<?php 
require '../include/dbconnection.php';

?>


<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="formContainer">
                    <?php 
                    if(isset($_GET['id'])) {
                        $student_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM admission WHERE id='$student_id'";
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            $student = mysqli_fetch_array($query_run);
                    ?>
                    
                    <form action="/master/include/code" method="POST" id="editAddmission" enctype="multipart/form-data">
                            <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                            <div class="col-sm-15 row mb-3">
                                <div class="align-middle admissionPic">
                                    <label>Upload Your Photo</label>
                                    <div class="image-container" style="display: grid; place-items: center;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($student['studentPic']); ?>" alt="Student Image"  width="100" height="100" style="border-radius: 50%;" />
                                        <input type="file" name="studentPic" id="studentPic" accept="image/png, image/jpeg, image/jpg" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                        <small class="error"></small>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  value="<?=$student['name'];?>" placeholder="Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control"  value="<?=$student['dob'];?>" placeholder="Date-of-Birth">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Collage Name</label>
                                    <input type="text" name="cName" class="form-control"  value="<?=$student['collage'];?>" placeholder="Collage Name">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class</label>
                                    <select class="form-select" name="class" aria-label="Default select example">
                                        <option value="" disabled selected>Select Present Class</option>
                                        <option value="1st PUC" <?= ($student['class'] == '1st PUC') ? 'selected' : ''; ?>>1st PUC</option>
                                        <option value="2nd PUC" <?= ($student['class'] == '2nd PUC') ? 'selected' : ''; ?>>2nd PUC</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Board</label>
                                    <input type="text" name="board" class="form-control"  value="<?=$student['board'];?>" placeholder="Board">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Prevoius Class %</label>
                                    <input type="text" name="pClassPer" class="form-control"  value="<?=$student['pClassPer'];?>" placeholder="Board">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Father Name</label>
                                    <input type="text" name="parentName" class="form-control"  value="<?=$student['parent'];?>" placeholder="Father/Guardian Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Occupation</label>
                                    <input type="text" name="parentOcp" class="form-control"  value="<?=$student['occupation'];?>" placeholder="Occupation">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="<?=$student['address'];?>"  placeholder="Address">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Student Number</label>
                                    <input type="tel" id="sPhone" name="sPhone" class="form-control" value="<?=$student['studentNum'];?>">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Parent Number</label>
                                    <input type="tel" id="pPhone" name="pPhone" class="form-control" value="<?=$student['parentNum'];?>">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Email</label>
                                    <input type="email" name="sEmail" class="form-control"  value="<?=$student['sEmail'];?>" placeholder="Address">
                                    <small class="error"></small>
                                </div>
                            </div>
                            

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Religion</label>
                                    <input type="text" name="religion" class="form-control"  value="<?=$student['religion'];?>" placeholder="Religion">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Caste</label>
                                    <input type="text" name="caste" class="form-control"  value="<?=$student['caste'];?>" placeholder="Caste">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>1st Language</label>
                                    <select class="form-select" name="fLang" aria-label="Default select example">
                                        <option value="" disabled selected>Select 1st Language</option>
                                        <option value="KANNADA" <?= ($student['fLang'] == 'KANNADA') ? 'selected' : ''; ?>>KANNADA</option>
                                        <option value="SANSKRIT" <?= ($student['fLang'] == 'SANSKRIT') ? 'selected' : ''; ?>>SANSKRIT</option>
                                        <option value="ENGLISH" <?= ($student['fLang'] == 'ENGLISH') ? 'selected' : ''; ?>>ENGLISH</option>
                                        <option value="HINDI" <?= ($student['fLang'] == 'HINDI') ? 'selected' : ''; ?>>HINDI</option>
                                    </select>
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>2nd Language</label>
                                    <select class="form-select" name="sLang" aria-label="Default select example">
                                        <option value="" disabled selected>Select 2nd Language</option>
                                        <option value="KANNADA" <?= ($student['sLang'] == 'KANNADA') ? 'selected' : ''; ?>>KANNADA</option>
                                        <option value="SANSKRIT" <?= ($student['sLang'] == 'SANSKRIT') ? 'selected' : ''; ?>>SANSKRIT</option>
                                        <option value="ENGLISH" <?= ($student['sLang'] == 'ENGLISH') ? 'selected' : ''; ?>>ENGLISH</option>
                                        <option value="HINDI" <?= ($student['sLang'] == 'HINDI') ? 'selected' : ''; ?>>HINDI</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Stream</label>
                                    <select class="form-select" name="stream" aria-label="Default select example">
                                        <option value="" disabled selected>Select Present Class</option>
                                        <option value="PCMB" <?= ($student['stream'] == 'PCMB') ? 'selected' : ''; ?>>PCMB</option>
                                        <option value="PCMC" <?= ($student['stream'] == 'PCMC') ? 'selected' : ''; ?>>PCMC</option>
                                        <option value="PCME" <?= ($student['stream'] == 'PCME') ? 'selected' : ''; ?>>PCME</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class Mode</label>
                                    <select class="form-select" name="cMode" aria-label="Default select example">
                                        <option value="" disabled selected>Select Mode</option>
                                        <option value="ONLINE" <?= ($student['cMode'] == 'ONLINE') ? 'selected' : ''; ?>>ONLINE</option>
                                        <option value="OFFLINE" <?= ($student['cMode'] == 'OFFLINE') ? 'selected' : ''; ?>>OFFLINE</option>
                                    </select>
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class=" mb-5">
                                <div class="col-8">
                                    <label>10th Marks Photo</label>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($student['sslcMarks']); ?>" alt="10th Marks Image" style="max-width: 100%; max-height: 700px;">
                                    <input type="file" name="sslcMarks" id="sslcMarks" class="form-control sslc"  placeholder="2nd Language" accept="image/png, image/jpeg, image/jpg">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="col-8">
                                    <label>Mid-term Marks Photo</label>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($student['midtermMarks']); ?>" alt="Mid-term Marks Image" style="max-width: 100%; max-height: 700px;">
                                    <input type="file" name="midtermMarks" id="midtermMarks" class="form-control midterm"  placeholder="2nd Language" accept="image/png, image/jpeg, image/jpg">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <input type="hidden" name="add_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                            <input type="hidden" name="aYear" value="<?php echo date('Y'); ?>">

                            <!--<div class="mb-3">
                                <button type="submit" name="save_school" class="btn btn-primary">Save Student</button>
                            </div>-->
                            <!-- Add a hidden input field for the current URL -->
                            <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="editAdmission">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="edit_admission" class="btn btn-primary">Save changes</button>
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

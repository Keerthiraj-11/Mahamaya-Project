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
                    <form action="/master/include/code" method="POST" id="studentaddPuc">
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
                        <input type="text" name="studentSchool" class="form-control" placeholder="Student Collage">
                        <small class="error"></small>    
                    </div>
               
                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Name</label>
                            <input type="text" name="studentName" class="form-control" placeholder="Student Name">
                            <small class="error"></small>
                        </div>
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Student Class</label>
                            <select class="form-select" name="studentStd" aria-label="Default select example">
                                <option value="" disabled selected>Select Class</option>
                                <option value="1st PUC">1st PUC</option>
                                <option value="2nd PUC">2nd PUC</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                        <label>Student Gender</label>
                            <select class="form-select" name="studentGender" aria-label="Default select example">
                                <option value="" disabled selected>Select Gender</option>
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
                            <input type="tel" name="studentContact" class="form-control" placeholder="Student Phone Number">
                            <small class="error"></small>
                        </div>
                    </div>


                    <div class="col-sm-15 row mb-3">

                        <div class="col-8 col-sm-4 input-control">
                            <label>Stream</label>
                            <select class="form-select" name="studentStream" aria-label="Default select example">
                                <option value="" disabled selected>Select Stream</option>
                                <option value="PCMB">PCMB</option>
                                <option value="PCMC">PCMC</option>
                                <option value="PCME">PCME</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>1st Language</label>
                            <select class="form-select" name="fLang" aria-label="Default select example">
                                <option value="" disabled selected>Select 1st Language</option>
                                <option value="K">KANNADA</option>
                                <option value="E">ENGLISH</option>
                                <option value="S">SANSKRIT</option>
                                <option value="H">HINDI</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>2nd Language</label>
                            <select class="form-select" name="sLang" aria-label="Default select example">
                                <option value="" disabled selected>Select 2nd Language</option>
                                <option value="K">KANNADA</option>
                                <option value="E">ENGLISH</option>
                                <option value="S">SANSKRIT</option>
                                <option value="H">HINDI</option>
                            </select>
                            <small class="error"></small>
                        </div>

                    </div>


                    <h5>Student Marks</h1>


                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>1st language Mark</label>
                            <input type="number" name="fMark" class="form-control" placeholder="1st Lang Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>2nd language Mark</label>
                            <input type="number" name="sMark" class="form-control" placeholder="2nd Lang Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Physics</label>
                            <input type="number" name="phyMark" class="form-control" placeholder="Physics Marks">
                            <small class="error"></small>
                        </div>
                    </div>

                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control">
                            <label>Chemistry</label>
                            <input type="number" name="cheMark" class="form-control" placeholder="Chemistry Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Maths</label>
                            <input type="number" name="matMark" class="form-control" placeholder="Maths Marks">
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Bio/CS/Ele</label>
                            <input type="number" name="bioMark" class="form-control" placeholder="Bio/Cs/Ele Marks">
                            <small class="error"></small>
                        </div>
                    </div>

                        <input type="hidden" name="marksTotal" value="">
                        <input type="hidden" name="percentage" value="">
                        <input type="hidden" name="studentResult" value="">
                        <input type="hidden" name="studentMarksFor" value="">
                        <input type="hidden" name="studentAdd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="savePucStudent">
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save_pucStudent" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

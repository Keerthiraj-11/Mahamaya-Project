<?php 
require '../include/dbconnection.php';
//session_start();
// Fetch cluster data
//$cluster_query = "SELECT cid, cname FROM cluster_add";
//$cluster_result = mysqli_query($con, $cluster_query);

?>




    <div class="container mt-0">


        <?php //include('message.php'); ?>
       

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <form action="/master/include/code" method="POST" id="addAddmission" enctype="multipart/form-data">
                            
                            <div class="col-sm-15 row mb-3">
                                <div class="align-middle admissionPic">
                                    <label>Upload Your Photo</label>
                                    <div class="image-container" style="display: grid; place-items: center;">
                                        <img id="blah" src="/master/admissionDefault.jpg" alt="your image" width="100" height="100" style="border-radius: 50%;" />
                                        <input type="file" name="studentPic" id="studentPic" accept="image/png, image/jpeg, image/jpg" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br/>
                                        <small class="error" style="text-align: center;"></small>
                                    </div>
                                    
                                </div>
                                
                            </div>



                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"  placeholder="Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>DOB</label>
                                    <input type="date" name="dob" class="form-control"  placeholder="Date-of-Birth">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Collage Name</label>
                                    <input type="text" name="cName" class="form-control"  placeholder="Collage Name">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class</label>
                                    <select class="form-select" name="class" aria-label="Default select example">
                                        <option value="" disabled selected>Select Present Class</option>
                                        <option value="1st PUC">1st PUC</option>
                                        <option value="2nd PUC">2nd PUC</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Board</label>
                                    <input type="text" name="board" class="form-control"  placeholder="Board">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Prevoius Class %</label>
                                    <input type="text" name="pClassPer" class="form-control"  placeholder="Board">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Father Name</label>
                                    <input type="text" name="parentName" class="form-control"  placeholder="Father/Guardian Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Occupation</label>
                                    <input type="text" name="parentOcp" class="form-control"  placeholder="Occupation">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control"  placeholder="Address">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Student Number</label>
                                    <input type="tel" id="sPhone" name="sPhone" class="form-control">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Parent Number</label>
                                    <input type="tel" id="pPhone" name="pPhone" class="form-control">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Email</label>
                                    <input type="email" name="sEmail" class="form-control"  placeholder="Address">
                                    <small class="error"></small>
                                </div>
                            </div>
                            

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Religion</label>
                                    <input type="text" name="religion" class="form-control"  placeholder="Religion">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Caste</label>
                                    <input type="text" name="caste" class="form-control"  placeholder="Caste">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>1st Language</label>
                                    <select class="form-select" name="fLang" aria-label="Default select example">
                                        <option value="" disabled selected>Select 1st Language</option>
                                        <option value="KANNADA">KANNADA</option>
                                        <option value="SANSKRIT">SANSKRIT</option>
                                        <option value="ENGLISH">ENGLISH</option>
                                        <option value="HINDI">HINDI</option>
                                    </select>
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>2nd Language</label>
                                    <select class="form-select" name="sLang" aria-label="Default select example">
                                        <option value="" disabled selected>Select 2nd Language</option>
                                        <option value="KANNADA">KANNADA</option>
                                        <option value="SANSKRIT">SANSKRIT</option>
                                        <option value="ENGLISH">ENGLISH</option>
                                        <option value="HINDI">HINDI</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Stream</label>
                                    <select class="form-select" name="stream" aria-label="Default select example">
                                        <option value="" disabled selected>Select Present Class</option>
                                        <option value="PCMB">PCMB</option>
                                        <option value="PCMC">PCMC</option>
                                        <option value="PCME">PCME</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-4 input-control ">
                                    <label>Class Mode</label>
                                    <select class="form-select" name="cMode" aria-label="Default select example">
                                        <option value="" disabled selected>Select Mode</option>
                                        <option value="ONLINE">ONLINE</option>
                                        <option value="OFFLINE">OFFLINE</option>
                                    </select>
                                    <small class="error"></small>
                                </div>
                            </div>

                            <div class="col-sm-15 row mb-5">
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>10th Marks Photo</label>
                                    <input type="file" name="sslcMarks" id="sslcMarks" class="form-control sslc"  placeholder="2nd Language" accept="image/png, image/jpeg, image/jpg">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Mid-term Marks Photo</label>
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
                            <input type="hidden" name="saveAdmission">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="save_admission" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    

    
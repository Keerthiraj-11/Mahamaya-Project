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
                        <form action="/master/include/code" method="POST" id="addUserName">
                            
                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>User Name</label>
                                    <input type="text" name="name" class="form-control"  placeholder="Name">
                                    <small class="error"></small>
                                </div>

                                <div class="col-8 col-sm-6 input-control ">
                                    <label>User Type</label>
                                    <select class="form-select" name="userType" aria-label="Default select example">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                    <small class="error"></small>
                                </div>

                                <!--
                                <div class="col-8 col-sm-4 input-control ">
                                    <label>User Type</label>
                                    <select name="langOpt[]" multiple id="langOpt">
                                        <option value="C++"><input type="checkbox" />Check</option>
                                        <option value="C#">C#</option>
                                        <option value="Java">Java</option>
                                        <option value="Objective-C">Objective-C</option>
                                        <option value="JavaScript">JavaScript</option>
                                        <option value="Perl">Perl</option>
                                        <option value="PHP">PHP</option>
                                        <option value="Ruby on Rails">Ruby on Rails</option>
                                        <option value="Android">Android</option>
                                        <option value="iOS">iOS</option>
                                        <option value="HTML">HTML</option>
                                        <option value="XML">XML</option>
                                    </select>
                                </div>
                                -->
                            </div>

                            <div class="col-sm-15 row mb-3">
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Password</label>
                                    <input type="password" name="userPassword" class="form-control"  placeholder="Password">
                                    <small class="error"></small>
                                </div>
                                <div class="col-8 col-sm-6 input-control ">
                                    <label>Confirm</label>
                                    <input type="password" name="userConfirmPassword" class="form-control"  placeholder="Confirm Password">
                                    <small class="error"></small>
                                </div>
                            </div>

                            <input type="hidden" name="userStatus" value="Active">

                            

                            <input type="hidden" name="add_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                            <!--<div class="mb-3">
                                <button type="submit" name="save_school" class="btn btn-primary">Save Student</button>
                            </div>-->
                            <!-- Add a hidden input field for the current URL -->
                            <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="saveUser">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="save_user" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    

    
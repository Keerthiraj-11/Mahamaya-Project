<?php 
require '../include/dbconnection.php';
//session_start();
// Fetch cluster data
$cluster_query = "SELECT cid, cname FROM cluster_add";
$cluster_result = mysqli_query($con, $cluster_query);

?>




    <div class="container mt-0">


        <?php //include('message.php'); ?>
       

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <form action="/master/include/code" method="POST" id="addschool">
                            
                            <div class="mb-3 input-control">
                                <label>School Name</label>
                                <input type="text" name="name" class="form-control"  placeholder="Name">
                                <small class="error"></small>
                            </div>

                            <div class="mb-3 input-control">
                                <label>School Location</label>
                                <input type="text" name="location" class="form-control" placeholder="Location" >
                                <small class="error"></small>
                            </div>

                            <div class="mb-3 input-control">
                                <label>School Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" >
                                <small class="error"></small>
                            </div>

                            <div class="mb-3 input-control">
                                <label>School Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" >
                                <small class="error"></small>
                            </div>

                            <div class="mb-0 input-control">
                                <select class="form-select"  name="cluster" aria-label="Select Cluster">
                                    <option value="" disabled selected>Select Cluster</option>
                                    
                                    <?php
                                    while ($row = mysqli_fetch_assoc($cluster_result)) {
                                        $cluster_id = $row['cid'];
                                        $cluster_name = $row['cname'];
                                        echo "<option value='$cluster_id'>$cluster_name</option>";
                                    }
                                    ?>
                                    
                                </select>
                                <small class="error"></small>

                            
                            </div>

                            <input type="hidden" name="add_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
                            <!--<div class="mb-3">
                                <button type="submit" name="save_school" class="btn btn-primary">Save Student</button>
                            </div>-->
                            <!-- Add a hidden input field for the current URL -->
                            <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="save_school" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    

    
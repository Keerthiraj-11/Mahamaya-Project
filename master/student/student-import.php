<?php
require '../include/dbconnection.php';
$cluster_query = "SELECT sname, sownedby FROM school_add";
$cluster_result = mysqli_query($con, $cluster_query);
?>

<div class="col-md-12" id="importFrm">
    <form action="/master/include/code" method="POST" enctype="multipart/form-data" id="studentImportForm" >

        <div class="col-10 col-md-12 mb-3">

            <div class="col-sm-15 row mb-3">
                <div class="col-8 col-sm-6 input-control ">
                    <label>School Name</label>
                    <select class="form-select"  name="studentSchool" id="studentImport" aria-label="Select School Name">
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

                <div class="col-8 col-sm-6 input-control mb-3">
                    <label>Student Medium</label>
                    <select class="form-select" name="sMediumImport" aria-label="Default select example">
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
                            <select class="form-select" name="maxKan" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="125">125</option>
                                <option value="100">100</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>ENGLISH</label>
                            <select class="form-select" name="maxEng" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="100">100</option>
                                <option value="80">80</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>HINDI</label>
                            <select class="form-select" name="maxHin" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="100">100</option>
                                <option value="80">80</option>
                            </select>
                            <small class="error"></small>
                        </div>
                    </div>

                    <div class="col-sm-15 row mb-3">
                        <div class="col-8 col-sm-4 input-control ">
                            <label>Maths</label>
                            <select class="form-select" name="maxMat" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="100">100</option>
                                <option value="80">80</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control">
                            <label>Science</label>
                            <select class="form-select" name="maxSci" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="100">100</option>
                                <option value="80">80</option>
                            </select>
                            <small class="error"></small>
                        </div>

                        <div class="col-8 col-sm-4 input-control ">
                            <label>Social</label>
                            <select class="form-select" name="maxSoc" aria-label="Default select example">
                                <option value="" disabled selected>Select Max Marks</option>
                                <option value="100">100</option>
                                <option value="80">80</option>
                            </select>
                            <small class="error"></small>
                        </div>
                    </div>


            <input type="hidden" name="schoolId" id="schoolIdImport">
            <input type="hidden" name="importValue" id="importValue">
            <input type="hidden" name="studentAdd_date" value="<?php echo date('Y-m-d H:i:sa'); ?>">
            <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <input type="hidden" name="importStudent">
            <!--
            <div class="col-8 col-sm-6 input-control ">
                <label>Student Standard</label>
                <select class="form-select" name="studentStd" aria-label="Default select example">
                    <option value="" disabled selected>Select Class</option>
                    <option value="9th">9th Standard</option>
                    <option value="10th">10th Standard</option>
                </select>
                <small class="error"></small>
            </div>

            <div class="input-control row mb-3 col-sm-6">
                <label>Student Board</label>
                <select class="form-select" name="studentBoard" aria-label="Default select example">
                    <option value="" disabled selected>Select Board</option>
                    <option value="State">State</option>
                    <option value="CBSE">CBSE</option>
                </select>
                <small class="error"></small>
            </div>
            -->
        </div>

        <div>
        <input type="file" name="file" accept=".csv"/>
        <input type="submit" class="btn btn-primary" id = "importButton" name="importStudentButton" value="IMPORT">
        </div>
    </form>
</div>
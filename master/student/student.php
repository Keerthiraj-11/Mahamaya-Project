
<?php
    session_start();
    require '../include/dbconnection.php';
    $cluster_query = "SELECT sname, sownedby FROM school_add";
    $cluster_result = mysqli_query($con, $cluster_query);
?>
<?php include('../sidebar.php'); ?>
<section class="home">


<?php include('../include/header.php'); ?>
<?php

// Check if a success message is set
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> ' . $_SESSION['success_message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

    // Clear the session variable to avoid displaying the message again on page refresh
    unset($_SESSION['success_message']);
}

// Check if an error message is set
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $_SESSION['error_message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

    // Clear the session variable to avoid displaying the message again on page refresh
    unset($_SESSION['error_message']);
}
?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="container">

                <!--<div class="row">
                    <div class="col-md-2"></div>
                    <div class="heading">
                        <h1 class="text-center">School Details</h1>
                    </div>
                    <div class="col-md-8">
                       
                        <button type="button" style="margin-bottom: 40px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addschool">Add School</button>
                    </div>
                </div>-->

                <div class="panel-heading">
                    <div class="row justify-content-center" style="padding: 1px 1px 50px 1px;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-md-6">
                                <h1 class="text-start">Student Details</h1>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addstudent">Add Student</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 row mb-3">
                    <div class="col-8 col-sm-7 row">
                        <div class="col-8 col-sm-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary importStudent" data-bs-toggle="modal" data-bs-target="#importstudent">Import</button>
                        </div>

                        <div class="col-8 col-sm-3">
                            <!-- Button trigger modal -->
                            <form action="/master/include/code" method="POST"  id="exportForm">
                                <div>
                                    <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                    <input type="hidden" name="exportPage" id="exportPage">
                                    <input type="hidden" name="exportSchool" id="exportSchool">
                                    <button type="submit" name="exportStudent" id="exportButton"  class="btn btn-secondary exportStudent">Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-15 row mb-3">
                    
                    <div class="col-10 col-sm-3">
                        <select id="marksSelect" class="form-select marksFor" aria-label="Default select example" onchange="toggleOptions(this.value)">
                            <option selected value="1" marksData="1">9th Final Exam Marks</option>
                            <option value="2" marksData="2">10th Midterm Mark</option>
                            <option value="3" marksData="3">10th Final Exam Mark</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <div class="col-10 col-sm-3">
                            <select class="form-select"  name="studentSchoolFilter" id="studentSchoolFilter" aria-label="Select School Name">
                                <option value="" selected>All School</option>
                                
                                <?php
                                while ($row = mysqli_fetch_assoc($cluster_result)) {
                                    $cluster_id = $row['sownedby'];
                                    $cluster_name = $row['sname'];
                                    echo "<option value='$cluster_name' data-clusterid='$cluster_id'>$cluster_name</option>";
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    

                    <div class="col-8 col-sm-1 ">
                        <div class="col-8 col-sm-1 ">
                            <button type="button" class="btn btn-danger bulkDeleteBtn" data-bs-toggle="modal" data-bs-target="#deleteStudentBulk">Delete</button>
                        </div> 
                    </div>           
                </div>

                <!-- Option 1-->
                <div id="option1" class="option-content row">
                    <div class="col-md-12 studentDetails" >
                        <table id="datatable" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0 table1">
                            <thead>
                                
                                <th>SL.No</th>
                                <th>School_Name</th> 
                                <th>Studnet_Name</th>
                                <th>Student_ID</th>
                                <th>Std/Medium</th>
                                <th>Board</th>
                                <th>Gender</th>
                                <th>Father/Guardian_Name</th>
                                <th>Occupation</th>
                                <th>Contact_Number</th>
                                <th>KAN</th>
                                <th>ENG</th>
                                <th>HIN</th>
                                <th>MAT</th>
                                <th>SCI</th>
                                <th>SOC</th>
                                <th>TOTAL</th>
                                <th>PERCENTAGE</th>
                                <th>RESULT</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                                <th><input type="checkbox" id="checkAll1"></th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM student_add_details1";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['schoolName']; ?></td>
                                                <td><?= $student['studentName']; ?></td>
                                                <td><?= $student['schoolId']; ?></td>
                                                <td><?= $student['std']; ?>/<?= $student['studentMedium']; ?></td>
                                                <td><?= $student['studentBoard']; ?></td>
                                                <td><?= $student['studentGender']; ?></td>
                                                <td><?= $student['studentParent']; ?></td>
                                                <td><?= $student['studentParentOccupation']; ?></td>
                                                <td><?= $student['studentContact']; ?></td>
                                                <td><?= $student['subKan']; ?></td>
                                                <td><?= $student['subEng']; ?></td>
                                                <td><?= $student['subHin']; ?></td>
                                                <td><?= $student['subMat']; ?></td>
                                                <td><?= $student['subSci']; ?></td>
                                                <td><?= $student['subSoc']; ?></td>
                                                <td><?= $student['total']; ?></td>
                                                <td><?= $student['percentage']; ?></td>
                                                <td><?= $student['result']; ?></td>
                                                <td><?= $student['studentAddDate']; ?></td>
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><input type="checkbox" id="checkItem1" class="checkItem1" value="<?= $student['id']; ?>" name="id[]"></td>

                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo"<h5> No Records Found </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="col-md-2"></div>-->
                </div>
                <!--End -->
            
                <!-- Option 2-->
                <div id="option2" class="option-content row" style="display: none;">
                    <div class="col-md-12 studentDetails" >
                        <table id="datatable" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0 table2">
                            <thead>
                                <th>SL.No</th>
                                <th>School_Name</th> 
                                <th>Studnet_Name</th>
                                <th>Std/Medium</th>
                                <th>Board</th>
                                <th>Gender</th>
                                <th>Father/Guardian_Name</th>
                                <th>Occupation</th>
                                <th>Contact_Number</th>
                                <th>KAN</th>
                                <th>ENG</th>
                                <th>HIN</th>
                                <th>MAT</th>
                                <th>SCI</th>
                                <th>SOC</th>
                                <th>TOTAL</th>
                                <th>PERCENTAGE</th>
                                <th>RESULT</th>
                                <th>School_ID</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                                <th><input type="checkbox" id="checkAll2"></th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM student_add_details2";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['schoolName']; ?></td>
                                                <td><?= $student['studentName']; ?></td>
                                                <td><?= $student['std']; ?>/<?= $student['studentMedium']; ?></td>
                                                <td><?= $student['studentBoard']; ?></td>
                                                <td><?= $student['studentGender']; ?></td>
                                                <td><?= $student['studentParent']; ?></td>
                                                <td><?= $student['studentParentOccupation']; ?></td>
                                                <td><?= $student['studentContact']; ?></td>
                                                <td><?= $student['subKan']; ?></td>
                                                <td><?= $student['subEng']; ?></td>
                                                <td><?= $student['subHin']; ?></td>
                                                <td><?= $student['subMat']; ?></td>
                                                <td><?= $student['subSci']; ?></td>
                                                <td><?= $student['subSoc']; ?></td>
                                                <td><?= $student['total']; ?></td>
                                                <td><?= $student['percentage']; ?></td>
                                                <td><?= $student['result']; ?></td>
                                                <td><?= $student['schoolId']; ?></td>
                                                <td><?= $student['studentAddDate']; ?></td>
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><input type="checkbox" id="checkItem2" class="checkItem2" value="<?= $student['id']; ?>" name="id[]"></td>

                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo"<h5> No Records Found </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="col-md-2"></div>-->
                </div>
                <!-- End-->

                <!-- Option 2-->
                <div id="option3" class="option-content row" style="display: none;">
                    <div class="col-md-12 studentDetails" >
                        <table id="datatable" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0 table3">
                            <thead>
                                <th>SL.No</th>
                                <th>School_Name</th> 
                                <th>Studnet_Name</th>
                                <th>Std/Medium</th>
                                <th>Board</th>
                                <th>Gender</th>
                                <th>Father/Guardian_Name</th>
                                <th>Occupation</th>
                                <th>Contact_Number</th>
                                <th>KAN</th>
                                <th>ENG</th>
                                <th>HIN</th>
                                <th>MAT</th>
                                <th>SCI</th>
                                <th>SOC</th>
                                <th>TOTAL</th>
                                <th>PERCENTAGE</th>
                                <th>RESULT</th>
                                <th>School_ID</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                                <th><input type="checkbox" id="checkAll3"></th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM student_add_details3";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['schoolName']; ?></td>
                                                <td><?= $student['studentName']; ?></td>
                                                <td><?= $student['std']; ?>/<?= $student['studentMedium']; ?></td>
                                                <td><?= $student['studentBoard']; ?></td>
                                                <td><?= $student['studentGender']; ?></td>
                                                <td><?= $student['studentParent']; ?></td>
                                                <td><?= $student['studentParentOccupation']; ?></td>
                                                <td><?= $student['studentContact']; ?></td>
                                                <td><?= $student['subKan']; ?></td>
                                                <td><?= $student['subEng']; ?></td>
                                                <td><?= $student['subHin']; ?></td>
                                                <td><?= $student['subMat']; ?></td>
                                                <td><?= $student['subSci']; ?></td>
                                                <td><?= $student['subSoc']; ?></td>
                                                <td><?= $student['total']; ?></td>
                                                <td><?= $student['percentage']; ?></td>
                                                <td><?= $student['result']; ?></td>
                                                <td><?= $student['schoolId']; ?></td>
                                                <td><?= $student['studentAddDate']; ?></td>
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteStudent" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td><input type="checkbox" id="checkItem3" class="checkItem3" value="<?= $student['id']; ?>" name="id[]"></td>

                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo"<h5> No Records Found </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="col-md-2"></div>-->
                </div>
                <!-- End-->
            </div>
        </div>
    </div>
   

        <!-- Add Modal -->
    <div class="modal fade bd-example-modal-xl" id="addstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./student-add.php'); ?>   
                </div>          
            </div>
        </div>
    </div>


    <!-- Import Modal -->
    <div class="modal fade bd-example-modal-xl" id="importstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./student-import.php'); ?>   
                </div>          
            </div>
        </div>
    </div>

    <!-- Export Modal 
    <div class="modal fade" id="exportstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php //include('./student-import.php'); ?>   
                </div>          
            </div>
        </div>
    </div>-->

    <!-- View Modal -->
    <div class="modal fade bd-example-modal-xl" id="viewStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./student-view.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

     <!-- Edit Modal -->
    <div class="modal fade bd-example-modal-xl" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./student-edit.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

     <!-- Delete Modal -->
    <div class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this student?</p>
                </div>
                <form action="/master/include/code" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="deletePage" id="deletePage">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_student" id="deleteStudentBtn"  class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Delete Selected Data -->
     <div class="modal fade" id="deleteStudentBulk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Deletes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the selected students?</p>
                </div>
                <form action="/master/include/code" method="POST"  id="bulkDeleteForm">
                    <div class="modal-footer">
                        <div>
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="bulkDeletePage" id="bulkDeletePage">
                        <input type="hidden" name="bulkDeleteData" id="bulkDeleteData">
                        <small class="error"></small>
                        </div>
                        <input type="hidden" name="bulkDelete" id="deleteStudentBulk">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="bulk_Delete" id="deleteStudentBtnBulk"  class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<script>
document.addEventListener('DOMContentLoaded', function () {
    const marksSelect = document.getElementById('marksSelect');
    
    // Read selected value from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const selectedValue = urlParams.get('selectedValue');
    if (selectedValue) {
        marksSelect.value = selectedValue;
    } else {
        // If there's no selected value in the URL parameter, set the default selected option in the URL
        const url = new URL(window.location.href);
        url.searchParams.set('selectedValue', marksSelect.value);
        history.replaceState(null, '', url); // Replace the current URL without reloading the page
    }

    // Function to toggle options
    function toggleOptions(selectedValue) {
        const optionContents = document.querySelectorAll('.option-content');
        
        // Hide all option contents
        optionContents.forEach(optionContent => {
            optionContent.style.display = 'none';
        });

        // Show the selected option content based on its value
        const selectedOptionContent = document.getElementById(`option${selectedValue}`);
        if (selectedOptionContent) {
            selectedOptionContent.style.display = 'block';
        }
    }

    // Set default selected option to option 1
    toggleOptions(marksSelect.value);

    //Multiple Table display
    marksSelect.addEventListener('change', function () {
        // Set the selected option in URL parameter
        const url = new URL(window.location.href);
        url.searchParams.set('selectedValue', marksSelect.value);
        window.location.href = url.toString();
    });
});
</script>

  

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const viewButtons = document.querySelectorAll(".view");
            const editButtons = document.querySelectorAll(".edit");
            const deleteButtons = document.querySelectorAll(".delete");
            const importButtons = document.querySelectorAll(".importStudent");
            const exportButtons = document.querySelectorAll(".exportStudent");
            const bulkDeleteButton = document.querySelectorAll(".bulkDeleteBtn");
            
            // Setting the Filter value to the export school value.
            const selectElement = document.querySelector("#studentSchoolFilter");

                // Add event listener to listen for changes in the select element
                selectElement.addEventListener("change", function() {
                    // Get the selected option
                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    
                    // Fetch the value of the selected option
                    selectedValue = selectedOption.value;
                    const exportSchool = document.getElementById('exportSchool');
                    exportSchool.value = selectedValue;
                    // You can now use the selected value as needed
                });
            //End Export


            // Get the selected option element
            const selectedOption = document.querySelector('.marksFor option:checked');
            // Get the value of the marksData attribute
            const marksDataValue = selectedOption.getAttribute('marksData');

            const bultDeleteFrm = document.querySelectorAll("#bulkDeleteData");
            const deletePageValue = document.querySelectorAll('#bulkDeleteForm input[name="bulkDeletePage"]');

            // Log the value to the console
            console.log("marksData value:", marksDataValue);

            viewButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const studentId = this.getAttribute("data-student-id");
                    fetchSchoolDetails(studentId);
                });
            });

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const studentId = this.getAttribute("data-student-id");
                    fetchEditSchoolForm(studentId);
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const studentId = this.getAttribute("data-student-id");
                    // Call the function to set the value of the delete button in the modal
                    setDeleteButtonValue(studentId);
                });
            });

            importButtons.forEach(button => {
                button.addEventListener("click", function() {
                    
                    // Call the function to set the value of the delete button in the modal
                    setImportButtonValue();
                    
                });
            });
        
            exportButtons.forEach(button => {
                button.addEventListener("click", function() {
                    
                    // Call the function to set the value of the delete button in the modal
                    setExportButtonValue();
                    
                });
            });

            //Bulk Delete Function
            bulkDeleteButton.forEach(button => {
                button.addEventListener("click", function() {
                    // Array to store the values of checked items
                    const checkedValues = [];

                    let checkboxes; // Define checkboxes outside of the if-else block
                    let deletePageValues;

                    if(marksDataValue == 1){
                        checkboxes = document.querySelectorAll('.checkItem1');
                        deletePageValues = "1";
                    } else if(marksDataValue == 2){
                        checkboxes = document.querySelectorAll('.checkItem2');
                        deletePageValues = "2";
                    } else if(marksDataValue == 3) {
                        checkboxes = document.querySelectorAll('.checkItem3');
                        deletePageValues = "3";
                    } else{
                        alert( "Please select marks data" );
                    }
                
                    // Iterate over each checkbox
                    checkboxes.forEach(function(checkbox) {
                        // Check if the checkbox is checked
                        if (checkbox.checked) {
                            // If checked, push its value to the checkedValues array
                            checkedValues.push(checkbox.value);
                        }
                    });

                    // Set values to the appropriate elements
                    bultDeleteFrm.forEach(form => {
                        form.value = checkedValues;
                    });

                    deletePageValue.forEach(pageValue => {
                        pageValue.value = deletePageValues;
                    });

                    bulkFormValidation();
                });
            });


            //View Function
            function fetchSchoolDetails(studentId, marksData) {
                fetch(`student-view?id=${studentId}&marksDataValue=${marksDataValue}`)
                .then(response => response.text())
                .then(data => {
                    const modalBody = document.querySelector("#viewStudent .modal-body");
                    modalBody.innerHTML = data;
                    $('#viewStudent').modal('show'); // Show the modal after fetching the details
                })
                .catch(error => {
                    console.error('Error fetching school details:', error);
                });
                console.log();
            }

            //Edit Function
            function fetchEditSchoolForm(studentId, marksData) {
                fetch(`student-edit?id=${studentId}&marksDataValue=${marksDataValue}`)
                .then(response => response.text())
                .then(data => {
                    const modalBody = document.querySelector("#editStudent .modal-body");
                    modalBody.innerHTML = data;
                    $('#editStudent').modal('show'); // Show the modal after fetching the form
                    
                    // Call form validation initialization after content is loaded
                    initializeFormValidation(modalBody.querySelector('form'));
                })
                .catch(error => {
                    console.error('Error fetching edit school form:', error);
                });
            }


            // Function to set the value of the delete button in the modal
            function setDeleteButtonValue(studentId, marksData) {
                const deleteButton = document.getElementById('deleteStudentBtn');
                const deleteValue = document.getElementById('deletePage');
                deleteButton.value = studentId;
                deleteValue.value =  marksDataValue;
            }

            // Function to set the value of the import button in the modal
            function setImportButtonValue(marksData) {
                const importButton = document.getElementById('importButton');
                const importValue = document.getElementById('importValue');
                
                importValue.value =  marksDataValue;
            }


            // Function to set the value of the export button in the modal
            function setExportButtonValue(marksData, selectedValue) {
                const exportButton = document.getElementById('exportButton');
                const exportSchool = document.getElementById('exportSchool');
                const exportPage = document.getElementById('exportPage');

                exportPage.value = marksDataValue;
            }

        

            function initializeFormValidation(formElement) {
                const form = document.querySelector('#studentedit');
                const marks = document.querySelector('#studentedit select[name="studentMarksFor"]');
                const sschool = document.querySelector('#studentedit select[name="studentSchool"]');
                const sname = document.querySelector('#studentedit input[name="studentName"]');
                const sclass = document.querySelector('#studentedit select[name="studentStd"]');
                const studentboard = document.querySelector('#studentedit select[name="studentBoard"]');
                const sgender = document.querySelector('#studentedit select[name="studentGender"]');
                const sparent = document.querySelector('#studentedit input[name="studentParent"]');
                const sparentocp = document.querySelector('#studentedit input[name="studentParOcu"]');
                const scontact = document.querySelector('#studentedit input[name="studentContact"]');
                const smedium = document.querySelector('#studentedit select[name="sMediumEdit"]');
                const ssubkan = document.querySelector('#studentedit input[name="subKan"]');
                const ssubeng = document.querySelector('#studentedit input[name="subEng"]');
                const ssubhin = document.querySelector('#studentedit input[name="subHin"]');
                const ssubmat = document.querySelector('#studentedit input[name="subMat"]');
                const ssubsci = document.querySelector('#studentedit input[name="subSci"]');
                const ssubsoc = document.querySelector('#studentedit input[name="subSoc"]');
                const savestudentButton = document.querySelector('#studentadd button[name="save_student"]');

                
                console.log("running");
                const setError = (element, message) => {
                    const inputControl = element.parentElement;
                    const errorDisplay = inputControl.querySelector('.error');
                
                    errorDisplay.innerText = message;
                    inputControl.classList.add('error');
                    inputControl.classList.remove('success')
                };
                
                const setSuccess = element => {
                    const inputControl = element.parentElement;
                    const errorDisplay = inputControl.querySelector('.error');
                
                    errorDisplay.innerText = '';
                    inputControl.classList.add('success');
                    inputControl.classList.remove('error');
                };

                
                form.addEventListener('submit', (event) => {
                    event.preventDefault();// Prevent the default form submission behavior
                    console.log();
                    checkInputs(event);
                });

                const checkInputs = (event) => {
                    // Prevent form submission
                    
                    let hasErrors = false;
                    event.preventDefault();
                    const marksValue = marks.value.trim();
                    const sschoolValue = sschool.value.trim();
                    const snameValue = sname.value.trim();
                    const sclassValue = sclass.value.trim();
                    const studentboardValue = studentboard.value.trim();
                    const sgenderValue = sgender.value.trim();
                    const sparentValue = sparent.value.trim();
                    const sparentocpValue = sparentocp.value.trim();
                    const scontactValue = scontact.value.trim();
                    const ssubkanValue = ssubkan.value.trim();
                    const ssubengValue = ssubeng.value.trim();
                    const ssubhinValue = ssubhin.value.trim();
                    const ssubmatValue = ssubmat.value.trim();
                    const ssubsciValue = ssubsci.value.trim();
                    const ssubsocValue = ssubsoc.value.trim();
                    const smediumValue = smedium.value.trim();

                    const specialCharRegex = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
                    // Define a regex pattern to match numbers with up to 3 digits
                    const threeDigitRegex = /^\d{1,3}$/;
                    //const isDuplicate = await checkDuplicateName(MarksValue);
                    //const isDuplicate = await checkDuplicateName(marksValue, sschoolValue, snameValue, sschoolidValue);
                    // Marks for Logic
                    if (marksValue === '') {
                        setError(marks, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(marks);
                        console.log("Success");
                    }


                    // School validation
                    if (sschoolValue === '') {
                        setError(sschool, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(sschool);
                    }

                    // Student Name validation
                    if (snameValue === '') {
                        setError(sname, 'Name cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(snameValue)) {
                        setError(sname, 'Name should not contain special characters');
                        hasErrors = true;
                    } else {
                        setSuccess(sname);
                        console.log("Success");
                    }

                    // Student Class
                    if (sclassValue === '') {
                        setError(sclass, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(sclass);
                    }

                    // Student Board
                    if (studentboardValue === '') {
                        setError(studentboard, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(studentboard);
                    }

                    // Student Gender
                    if (sgenderValue === '') {
                        setError(sgender, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(sgender);
                    }

                    // Student Medium
                    if (smediumValue === '') {
                        setError(smedium, 'Please Select the Option');
                        hasErrors = true;
                    } else {
                        setSuccess(smedium);
                    }
                    
                    // Parent Name validation
                    if (sparentValue === '') {
                        setError(sparent, 'Name cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(sparentValue)) {
                        setError(sparent, 'Value should not contain special characters');
                        hasErrors = true;
                    } else {
                        setSuccess(sparent);
                        console.log("Success");
                    }

                    // Parent Occupation validation
                    if (sparentocpValue === '') {
                        setError(sparentocp, 'Name cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(sparentocpValue)) {
                        setError(sparentocp, 'Value should not contain special characters');
                        hasErrors = true;
                    } else {
                        setSuccess(sparentocp);
                        console.log("Success");
                    }

                    // Phone validation
                if (scontactValue === '') {
                    setError(scontact, 'Phone number cannot be empty');
                    hasErrors = true;
                    } else if (!isValidPhoneNumber(scontactValue)) { // Check if phone number is valid
                        setError(scontact, 'Provide a valid phone number (e.g., +91 1234567890)');
                        hasErrors = true;
                    } else {
                        setSuccess(scontact);
                    }

                    // Subject Kannada validation
                    if (ssubkanValue === '') {
                        setError(ssubkan, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubkanValue)) {
                        setError(ssubkan, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubkanValue)) {
                        setError(ssubkan, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubkanValue) > 125) {
                        setError(ssubkan, 'Value should not exceed 125');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubkan);
                        console.log("Success");
                    }

                    // Subject English validation
                    if (ssubengValue === '') {
                        setError(ssubeng, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubengValue)) {
                        setError(ssubeng, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubengValue)) {
                        setError(ssubeng, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubengValue) > 100) {
                        setError(ssubeng, 'Value should not exceed 100');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubeng);
                        console.log("Success");
                    }

                    // Subject Hindi validation
                    if (ssubhinValue === '') {
                        setError(ssubhin, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubhinValue)) {
                        setError(ssubhin, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubhinValue)) {
                        setError(ssubhin, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubhinValue) > 100) {
                        setError(ssubhin, 'Value should not exceed 100');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubhin);
                        console.log("Success");
                    }

                    // Subject Maths validation
                    if (ssubmatValue === '') {
                        setError(ssubmat, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubmatValue)) {
                        setError(ssubmat, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubmatValue)) {
                        setError(ssubmat, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubmatValue) > 100) {
                        setError(ssubmat, 'Value should not exceed 100');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubmat);
                        console.log("Success");
                    }

                    // Subject Maths validation
                    if (ssubsciValue === '') {
                        setError(ssubsci, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubsciValue)) {
                        setError(ssubsci, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubsciValue)) {
                        setError(ssubsci, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubsciValue) > 100) {
                        setError(ssubsci, 'Value should not exceed 100');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubsci);
                        console.log("Success");
                    }

                    // Subject Maths validation
                    if (ssubsocValue === '') {
                        setError(ssubsoc, 'Value cannot be empty');
                        hasErrors = true;
                    } else if (specialCharRegex.test(ssubsocValue)) {
                        setError(ssubsoc, 'Value should not contain special characters');
                        hasErrors = true;
                    } else if (!threeDigitRegex.test(ssubsocValue)) {
                        setError(ssubsoc, 'Value should be below 3 digits');
                        hasErrors = true;
                    } else if (parseInt(ssubsocValue) > 100) {
                        setError(ssubsoc, 'Value should not exceed 100');
                        hasErrors = true;
                    } else {
                        setSuccess(ssubsoc);
                        console.log("Success");
                    }

                    const selectedSchoolOption = sschool.options[sschool.selectedIndex];
                    const sschoolid = document.getElementById('schoolIdEdit');
                    sschoolid.value = selectedSchoolOption.getAttribute('data-clusterid');
        
                    if(hasErrors){
                        event.preventDefault();
                    } else {
                            setSuccess(sname);
                            console.log("Complete");
                            form.submit();
                        }
                    
                };
                /*
                const checkDuplicateName = async (marksValue, sschoolValue, snameValue, sschoolidValue) => {
                    console.log('Checking for duplicate Marks:', marksValue);
                    
                    const postData = {
                        marks: marksValue,
                        sschool: sschoolValue,
                        sname: snameValue,
                        sschoolid: sschoolidValue
                    };
                    console.log('Post Data:', postData); // Log postData object
                    const response = await fetch('/master/student/nameValidation', {
                        method: 'POST',
                        body: JSON.stringify(postData),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    
                    console.log('Response received:', response);
                    const data = await response.json();
                    console.log('Data received:', data);
                    return data.exists;
                }*/

                const isValidPhoneNumber = phoneNumber => {
                    // Regular expression pattern
                    const regex = /^\+91 \d{10}$/;
                    // Test the input against the pattern
                    return regex.test(phoneNumber);
                };
            }

            function bulkFormValidation(formElement) {
                const form = document.querySelector('#bulkDeleteForm');
                const bulkDeleteData = document.querySelector('#bulkDeleteForm input[name="bulkDeleteData"]');

                
                console.log("running");
                const setError = (element, message) => {
                    const inputControl = element.parentElement;
                    const errorDisplay = inputControl.querySelector('.error');
                
                    errorDisplay.innerText = message;
                    inputControl.classList.add('error');
                    inputControl.classList.remove('success')
                };
                
                const setSuccess = element => {
                    const inputControl = element.parentElement;
                    const errorDisplay = inputControl.querySelector('.error');
                
                    errorDisplay.innerText = '';
                    inputControl.classList.add('success');
                    inputControl.classList.remove('error');
                };

                
                form.addEventListener('submit', (event) => {
                    event.preventDefault();// Prevent the default form submission behavior
                    console.log();
                    checkInputs(event);
                });

                const checkInputs = (event) => {
                    // Prevent form submission
                    
                    let hasErrors = false;
                    event.preventDefault();
                    const bulkDeleteDataValue = bulkDeleteData.value.trim();

                    // Marks for Logic
                    if (bulkDeleteDataValue === '') {
                        setError(bulkDeleteData, 'Select the students.');
                        hasErrors = true;
                    } else {
                        setSuccess(bulkDeleteData);
                        console.log("Success");
                    }

        
                    if(hasErrors){
                        event.preventDefault();
                    } else {
                        form.submit();
                    }
                    
                };
            }

        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the select element and hidden input
        const selectSchool = document.getElementById('studentImport');
        const hiddenInput = document.getElementById('schoolIdImport');

        // Add event listener to the select element
        selectSchool.addEventListener('change', function() {
            // Set the value of the hidden input to the data-clusterid attribute of the selected option
            hiddenInput.value = this.options[this.selectedIndex].getAttribute('data-clusterid');
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#studentImportForm');
    const studentSchool = document.querySelector('#studentImportForm select[name="studentSchool"]');
    const studentMedium = document.querySelector('#studentImportForm select[name="sMediumImport"]');
    const subKan = document.querySelector('#studentImportForm select[name="maxKan"]');
    const subEng = document.querySelector('#studentImportForm select[name="maxEng"]');
    const subHin = document.querySelector('#studentImportForm select[name="maxHin"]');
    const subMat = document.querySelector('#studentImportForm select[name="maxMat"]');
    const subSci = document.querySelector('#studentImportForm select[name="maxSci"]');
    const subSoc = document.querySelector('#studentImportForm select[name="maxSoc"]');

    const studentId = document.querySelector('#studentImportForm input[name="schoolId"]');
    const importNum = document.querySelector('#studentImportForm input[name="importValue"]');
    const fileInput = document.querySelector('#studentImportForm input[name="file"]');

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };
    
    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
    
        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent the default form submission behavior
        checkInputs(event);
    });

    const checkInputs = (event) => {
        let hasErrors = false;
        event.preventDefault();

        const studentschoolValue = studentSchool.value.trim();
        const studentMediumValue = studentMedium.value.trim();
        const subKanValue = subKan.value.trim();
        const subEngValue = subEng.value.trim();
        const subHinValue = subHin.value.trim();
        const subMatValue = subMat.value.trim();
        const subSciValue = subSci.value.trim();
        const subSocValue = subSoc.value.trim();

        const studentIdValue = studentId.value.trim();
        const importNumValue = importNum.value.trim();
        const file = fileInput.files[0]; // Get the selected file

        // School validation
        if (studentschoolValue === '') {
            setError(studentSchool, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(studentSchool);
        }

        // Medium validation
        if (studentMediumValue === '') {
            setError(studentMedium, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(studentMedium);
        }

        // Max Kannada
        if (subKanValue === '') {
            setError(subKan, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subKan);
        }

        // Max English
        if (subEngValue === '') {
            setError(subEng, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subEng);
        }

        // Max Hindi
        if (subHinValue === '') {
            setError(subHin, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subHin);
        }

        // Max Maths
        if (subMatValue === '') {
            setError(subMat, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subMat);
        }

        // Max Science
        if (subSciValue === '') {
            setError(subSci, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subSci);
        }

        // Max Social
        if (subSocValue === '') {
            setError(subSoc, 'Please Select the Option');
            hasErrors = true;
        } else {
            setSuccess(subSoc);
        }
        
        // File validation
        if (!file) {
            alert('Please select a file');
            hasErrors = true;
        }

        if (hasErrors) {
            event.preventDefault();
        } else {
            form.submit();
        }
    };
});
</script>


<script>
    // student ID set value
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to the select element and hidden input
        const selectSchool = document.getElementById('studentSchool');
        const hiddenInput = document.getElementById('schoolId');

        // Add event listener to the select element
        selectSchool.addEventListener('change', function() {
            // Set the value of the hidden input to the data-clusterid attribute of the selected option
            hiddenInput.value = this.options[this.selectedIndex].getAttribute('data-clusterid');
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
        $('#checkAll1').click(function() {
            if ($(this).is(":checked")) {
                $(".checkItem1").prop('checked', true);
            } else {
                $(".checkItem1").prop('checked', false);
            }
        });
    });

    $(document).ready(function() {
        $('#checkAll2').click(function() {
            if ($(this).is(":checked")) {
                $(".checkItem2").prop('checked', true);
            } else {
                $(".checkItem2").prop('checked', false);
            }
        });
    });

    $(document).ready(function() {
        $('#checkAll3').click(function() {
            if ($(this).is(":checked")) {
                $(".checkItem3").prop('checked', true);
            } else {
                $(".checkItem3").prop('checked', false);
            }
        });
    });
});
</script>

<!-- School Filter -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    $(document).ready(function () {
        // Event listener for dropdown change
        $('#studentSchoolFilter').change(function () {
            var selectedSchool = $(this).val(); // Get selected value
            $('#datatable tbody tr').each(function () {
                var schoolName = $(this).find('td:eq(1)').text(); // Assuming school name is in the first column
                if (selectedSchool === '' || schoolName === selectedSchool) {
                    $(this).show(); // Show row if selected value matches or is empty
                } else {
                    $(this).hide(); // Hide row if selected value doesn't match
                }

                
            });
            var selectedOption = $(this).find(':selected');
            var clusterName = selectedOption.val();
            var clusterId = selectedOption.data('clusterid');
            console.log("Selected Cluster Name: " + clusterName);
            console.log("Selected Cluster ID: " + clusterId);
        });
    });
});
</script>

<!--
<script>
document.addEventListener('DOMContentLoaded', () => {
    $(document).ready(function () {
    $("#exportButton").click(function () {
        var exportPage = $("#exportPage").val();
        var exportSchool = $("#exportSchool").val();

        $.ajax({
            url: '/master/include/code',
            type: 'POST',
            dataType: 'json', // Expect JSON response
            data: {
                exportStudent: true,
                exportPage: exportPage,
                exportSchool: exportSchool
            },
            success: function (response) {
                // Convert JSON response to CSV string
                var csvContent = response.map(row => row.join(",")).join("\n");

                // Create a temporary blob
                var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

                // Create a temporary download link
                var link = document.createElement("a");
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", "export.csv");
                document.body.appendChild(link);

                // Trigger the download
                link.click();

                // Cleanup
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
            },
            error: function (xhr, status, error) {
                console.error(error);
                // Handle errors
            }
        });
    });
});
});
</script>


<script>
document.querySelector('button[name="exportStudent"]').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission

    // Example data to be sent via AJAX
    var data = {
        exportStudent : document.querySelector('button[name="exportStudent"]').value,
        exportPage: document.getElementById('exportPage').value, // Get your exportPage value
        exportSchool: document.getElementById('exportSchool').value // Get your exportSchool value
    };

    // AJAX request to trigger the export process
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/master/include/code', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.responseType = 'blob'; // Set the response type to blob
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Create a blob object from the response
            var blob = new Blob([xhr.response], { type: 'text/csv' });

            // Create a temporary URL for the blob
            var url = window.URL.createObjectURL(blob);

            // Create an anchor element
            var a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'export.csv'; // Default file name
            document.body.appendChild(a);

            // Trigger a click event on the anchor element
            a.click();

            // Clean up
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }
    };
    xhr.send(JSON.stringify(data));
});
</script>
-->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable for all tables with classes 'table1', 'table2', and 'table3'
    $('table.table1, table.table2, table.table3').each(function() {
        var table = $(this).DataTable({
            columnDefs: [
                {
                    searchable: false,
                    orderable: false,
                    targets: 0
                }
            ],
            scrollCollapse: true,
            scrollY: '600px',
            scrollX: true,
            order: [[1, 'asc']]
        });

        // Reindex the first column after ordering or searching for each table
        table
            .on('order.dt search.dt', function () {
                let i = 1;
                table
                    .cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            })
            .draw();
    });
});
</script>
<script src="/master/student/validation.js"></script>

</body>
</html>   
  </section>
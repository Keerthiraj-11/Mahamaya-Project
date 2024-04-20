
<?php
    session_start();
    require '../include/dbconnection.php';
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
                                <h1 class="text-start">Cluster Details</h1>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcluster">Add Cluster</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- <div class="col-md-2"></div>-->
                    
                    <div class="col-md-12">
                    <table id="datatable" class="table table-striped dt-responsive w-100 table-bordered display nowrap table-hover mb-0">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Owned-By</th>
                                <th>Cluster-ID</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM cluster_add";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['cname']; ?></td>
                                                <td><?= $student['cownedby']; ?></td>
                                                <td><?= $student['cid']; ?></td>
                                                <td><?= $student['cadddate']; ?></td>
                                                
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewCluster" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editCluster" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteCluster" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                

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
            </div>
        </div>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="addcluster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cluster Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./cluster-add.php'); ?>   
                </div>          
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewCluster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cluster View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./cluster-view.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCluster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./cluster-edit.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCluster" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cluster Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this cluster?</p>
                </div>
                <form action="/master/include/code" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_cluster" id="deleteStudentBtn"  class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const viewButtons = document.querySelectorAll(".view");
        const editButtons = document.querySelectorAll(".edit");
        const deleteButtons = document.querySelectorAll(".delete");

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

        // Function to set the value of the delete button in the modal
        function setDeleteButtonValue(studentId) {
            const deleteButton = document.getElementById('deleteStudentBtn');
            deleteButton.value = studentId;
        }

        function fetchSchoolDetails(studentId) {
            fetch(`cluster-view?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#viewCluster .modal-body");
                modalBody.innerHTML = data;
                $('#viewCluster').modal('show'); // Show the modal after fetching the details
            })
            .catch(error => {
                console.error('Error fetching school details:', error);
            });
        }

        function fetchEditSchoolForm(studentId) {
            fetch(`cluster-edit?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#editCluster .modal-body");
                modalBody.innerHTML = data;
                $('#editCluster').modal('show'); // Show the modal after fetching the form
                
                // Call form validation initialization after content is loaded
                initializeFormValidation(modalBody.querySelector('form'));
            })
            .catch(error => {
                console.error('Error fetching edit school form:', error);
            });
        }

        function initializeFormValidation(formElement) {
            const form = formElement; // Use the passed form element
            const cname = form.querySelector('input[name="updateCname"]');
            const cownedby = form.querySelector('input[name="updateCownedby"]');
            const saveClusterButton = form.querySelector('button[name="update_cluster"]');

            const setError = (element, message) => {
                const errorDisplay = element.parentElement.querySelector('.error');
                errorDisplay.innerText = message;
                errorDisplay.classList.add('error');
            };

            const setSuccess = element => {
                const inputControl = element.parentElement;
                const errorDisplay = inputControl.querySelector('.error');
                errorDisplay.innerText = '';
                inputControl.classList.add('success');
                inputControl.classList.remove('error');
            };

            form.addEventListener('submit', event => {
                event.preventDefault(); // Prevent the default form submission behavior
                
                let hasErrors = false;
                const cnameValue = cname.value.trim();
                const cownedbyValue = cownedby.value.trim();
                const specialCharRegex = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]+/;
                const cnameRegex = /^Cluster-\d{2}$/;
                
                // Name validation
                if (cnameValue === '') {
                    setError(cname, 'Name cannot be empty');
                    hasErrors = true;
                } else if (!cnameRegex.test(cnameValue)) {
                    setError(cname, 'Name should start with "Cluster-" followed by exactly two digits');
                    hasErrors = true;
                } else {
                    setSuccess(cname);
                }

                // Location validation
                if (cownedbyValue === '') {
                    setError(cownedby, 'Owned-By cannot be empty');
                    hasErrors = true;
                } else if (specialCharRegex.test(cownedbyValue)) {
                    setError(cownedby, 'Owned-By should not contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(cownedby);
                }

                if (!hasErrors) {
                    form.submit();
                }
            });
        }

    });
</script>
 
<script src="/master/cluster/validation.js"></script>
    <?php include('../include/footer.php'); ?>   
  </section>
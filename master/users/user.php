
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
                                <h1 class="text-start">Users</h1>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
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
                                <th>User Name</th>
                                <th>Password</th>
                                <th>User Type</th>
                                <th>User For</th>
                                <th>Status</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM users";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['userName']; ?></td>
                                                <td><?= $student['userPassword']; ?></td>

                                                <td><?= $student['userType']; ?></td>
                                                <td><?= $student['userFor']; ?></td>
                                                <td><?= $student['userStatus']; ?></td>
                                                <td><?= $student['userAddDate']; ?></td>
                    
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <!--<button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewUser" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> -->
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editUser" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteUser" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                

                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        
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
    <div class="modal fade bd-example-modal-xl" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./user-add.php'); ?>   
                </div>          
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!--
    <div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cluster View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?//php include('./cluster-view.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>
    -->

    <div class="modal fade bd-example-modal-xl" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./user-edit.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this cluster?</p>
                </div>
                <form action="/master/include/code" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_user" id="deleteUserBtn"  class="btn btn-danger">Delete</button>
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
            const deleteButton = document.getElementById('deleteUserBtn');
            deleteButton.value = studentId;
        }

        //Function to View
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

        //Function to edit
        function fetchEditSchoolForm(studentId) {
            fetch(`user-edit?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#editUser .modal-body");
                modalBody.innerHTML = data;
                $('#editUser').modal('show'); // Show the modal after fetching the form
                
                // Call form validation initialization after content is loaded
                initializeFormValidation(modalBody.querySelector('form'));
            })
            .catch(error => {
                console.error('Error fetching edit school form:', error);
            });
        }

        function initializeFormValidation(formElement) {
            const form = document.querySelector('#userEditForm');
            const uName = document.querySelector('#userEditForm input[name="name"]');
            const uType = document.querySelector('#userEditForm select[name="userType"]');
            const uStatus = document.querySelector('#userEditForm select[name="userStatus"]');
            const uPass = document.querySelector('#userEditForm input[name="userPassword"]');
            const uCPass = document.querySelector('#userEditForm input[name="userConfirmPassword"]');

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
                checkInputs(event);
            });

            const checkInputs = (event) => {
                let hasErrors = false;
                event.preventDefault();
                const uNameValue = uName.value.trim();
                const uTypeValue = uType.value.trim();
                const uStatusValue = uStatus.value.trim();

                const uPassValue = uPass.value.trim();
                const uCPassValue = uCPass.value.trim();
                
                //const isDuplicate = await checkDuplicateName(uNameValue);
                // Regular expression to check for special characters
                const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                // Name validation
                if (uNameValue === '') {
                    setError(uName, 'User Name cannot be empty');
                    hasErrors = true;
                } else if (specialCharRegex.test(uNameValue)) {
                    setError(uName, 'Name should not contain special characters');
                    hasErrors = true;
                } /*else if (isDuplicate) {
                    setError(uName, 'User Name already present.');
                    hasErrors = true;
                }*/ else {
                    setSuccess(uName);
                }

                // User Type validation
                if (uTypeValue === '') {
                    setError(uType, 'Please select an option');
                    hasErrors = true;
                } else {
                    setSuccess(uType);
                }

                // User Status validation
                if (uStatusValue === '') {
                    setError(uStatus, 'Please select an option');
                    hasErrors = true;
                } else {
                    setSuccess(uStatus);
                }

                // User Password validation
                if (uPassValue === '') {
                    setError(uPass, 'Password cannot be empty');
                    hasErrors = true;
                } /*else if (specialCharRegex.test(uPassValue)) {
                    setError(uPass, 'Password should not contain special characters');
                    hasErrors = true;
                }*/ else {
                    setSuccess(uPass);
                }

                // User Confirm Password validation
                if (uCPassValue === '') {
                    setError(uCPass, 'Please confirm the password');
                    hasErrors = true;
                } /*else if (specialCharRegex.test(uCPassValue)) {
                    setError(uCPass, 'Password should not contain special characters');
                    hasErrors = true;
                } */else if (uCPassValue !== uPassValue) {
                    setError(uCPass, 'Passwords do not match');
                    hasErrors = true;
                } else {
                    setSuccess(uCPass);
                }

                if (hasErrors) {
                    event.preventDefault(); // Don't submit the form if there are errors
                } else {
                    form.submit();
                }
            };
            /*
            const checkDuplicateName = async (uNameValue) => {
                console.log('Checking for duplicate Marks:', uNameValue);
                
                const postData = {
                    uName: uNameValue
                };
                console.log('Post Data:', postData); // Log postData object
                const response = await fetch('/master/users/userNameValidation', {
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
        }

    });
</script>

<script>
      let output = document.getElementById('output');
      var showCheckBoxes = true;

      function showOptions() {
         var options =
            document.getElementById("options");

         if (showCheckBoxes) {
            options.style.display = "flex";
            showCheckBoxes = !showCheckBoxes;
         } else {
            options.style.display = "none";
            showCheckBoxes = !showCheckBoxes;
         }
      }
      function getOptions() {
         var selectedOptions = document.querySelectorAll('input[type=checkbox]:checked')
         output.innerHTML = "The selected options are given below. <br/>";
         for (var i = 0; i < selectedOptions.length; i++) {
            output.innerHTML += selectedOptions[i].value + " , ";
            console.log(selectedOptions[i])
         }
      }
   </script>
 
 <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


    <script src="js/multiselect/jquery.multiselect.js"></script>
    <script>
        $('#langOpt').multiselect({
        columns: 1,
        texts: {
            placeholder: 'Select Languages',
            search     : 'Search Languages'
        },
        search: true
    });
    </script>
-->
<script src="/master/users/validation.js"></script>
    <?php include('../include/footer.php'); ?>   
  </section>
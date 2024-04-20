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
                                <h1 class="text-start">School Details</h1>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addschool">Add School</button>
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
                                <th>Location</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Owned-By</th>
                                <th>Add-Date</th>
                                <th>Action</th>
                                
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM school_add";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><?= $student['sname']; ?></td>
                                                <td><?= $student['slocation']; ?></td>
                                                <td><?= $student['sphone']; ?></td>
                                                <td><?= $student['semail']; ?></td>
                                                <td><?= $student['sownedby']; ?></td>
                                                <td><?= $student['sadddate']; ?></td>
                                                <td>
                                                    
                                                    
                                                    <!-- Example with Bootstrap Icons -->
                                                    <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewSchool" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editSchool" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteSchool" data-student-id="<?= $student['id']; ?>">
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
    <div class="modal fade" id="addschool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./school-add.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="viewSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./school-view.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this school?</p>
                </div>
                <form action="/master/include/code" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_school" id="deleteStudentBtn"  class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    


    <div class="modal fade" id="editSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./school-edit.php'); ?>   
                </div>
            
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
            fetch(`school-view?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#viewSchool .modal-body");
                modalBody.innerHTML = data;
                $('#viewSchool').modal('show'); // Show the modal after fetching the details
            })
            .catch(error => {
                console.error('Error fetching school details:', error);
            });
        }

        function fetchEditSchoolForm(studentId) {
            fetch(`school-edit?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#editSchool .modal-body");
                modalBody.innerHTML = data;
                $('#editSchool').modal('show'); // Show the modal after fetching the form
                
                // Call form validation initialization after content is loaded
                initializeFormValidation(modalBody.querySelector('form'));
            })
            .catch(error => {
                console.error('Error fetching edit school form:', error);
            });
        }

        function initializeFormValidation(formElement) {
        // Form validation
        const form = document.querySelector('form'); // Select the form element within the modal
        const name = document.querySelector('input[name="updateName"]');
        const location = document.querySelector('input[name="updateLocation"]');
        const phone = document.querySelector('input[name="updatePhone"]');
        const email = document.querySelector('input[name="updateEmail"]');
        const cluster = document.querySelector('select[name="updateCluster"]');
        const updateButton = document.querySelectorAll('button[name="update_school"]');


        
        // Event delegation for update buttons
        updateButton.forEach(button => {
            button.addEventListener('click', () => {
                checkInputs();
            });
        });

        const checkInputs = () => {
            let hasErrors = false;
            const nameValue = name.value.trim();
            const locationValue = location.value.trim();
            const phoneValue = phone.value.trim();
            const emailValue = email.value.trim();
            const clusterValue = cluster.value.trim();

            // Regular expression to check for special characters
            const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

            // Name validation
            if (nameValue === '') {
                setError(name, 'Name cannot be empty');
                hasErrors = true;
            } else if (specialCharRegex.test(nameValue)) {
                setError(name, 'Name should not contain special characters');
                hasErrors = true;
            } else {
                setSuccess(name);
            }

            // Location validation
            if (locationValue === '') {
                setError(location, 'Location cannot be empty');
                hasErrors = true;
            } else if (specialCharRegex.test(locationValue)) {
                setError(location, 'Location should not contain special characters');
                hasErrors = true;
            } else {
                setSuccess(location);
            }

            // Phone validation
            if (phoneValue === '') {
                setError(phone, 'Phone number cannot be empty');
                hasErrors = true;
            } else if (!isValidPhoneNumber(phoneValue)) { // Check if phone number is valid
                setError(phone, 'Provide a valid phone number (e.g., +91 1234567890)');
                hasErrors = true;
            } else {
                setSuccess(phone);
            }

            // Email validation
            if (emailValue === '') {
                setError(email, 'Email cannot be empty');
                hasErrors = true;
            } else if (!isValidEmail(emailValue)) {
                setError(email, 'Provide a valid email address');
                hasErrors = true;
            } else {
                setSuccess(email);
            }

            // Cluster validation
            if (clusterValue === '') {
                setError(cluster, 'Please select a cluster');
                hasErrors = true;
            } else {
                setSuccess(cluster);
            }

            // Prevent form submission if there are errors
            if (hasErrors) {
                // If there are errors, prevent the form submission
                event.preventDefault();
            }
        };

        const isValidPhoneNumber = phoneNumber => {
            // Regular expression pattern
            const regex = /^\+91 \d{10}$/;
            // Test the input against the pattern
            return regex.test(phoneNumber);
        };



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

            const isValidEmail = email => {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            };

    }
    });
</script>

    <script src="/master/school/validation.js"></script>
    <?php include('../include/footer.php'); ?>   

</section>
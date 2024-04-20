
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
                                <h1 class="text-start">Admission Details</h1>
                            </div>
                            <div>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmission">New Admission</button>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Date-of-Birth</th>
                                <th>Collage</th>
                                <th>Class</th>
                                <th>Board</th>
                                <th>Prevoius Class %</th>
                                <th>Father/Guardian Name</th>
                                <th>Occupation</th>
                                <th>Address</th>
                                <th>Student Phone.No</th>
                                <th>Parent Phone.No</th>
                                <th>Email</th>
                                <th>Religion</th>
                                <th>Caste</th>
                                <th>1st Language</th>
                                <th>2nd Language</th>
                                <th>Stream</th>
                                <th>Class Mode</th>
                                <th>Add-Date</th>
                                <th>Year</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM admission";
                                    $query_run = mysqli_query($con, $query);
                                    
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            //echo $students['name'];
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($student['studentPic']); ?>" alt="Student Image"  width="45" height="45" style="border-radius: 50%;"></td>
                                                <td><?= $student['name']; ?></td>
                                                <td><?= $student['dob']; ?></td>
                                                <td><?= $student['collage']; ?></td>
                                                <td><?= $student['class']; ?></td>
                                                <td><?= $student['board']; ?></td>
                                                <td><?= $student['pClassPer']; ?></td>
                                                <td><?= $student['parent']; ?></td>
                                                <td><?= $student['occupation']; ?></td>
                                                <td><?= $student['address']; ?></td>
                                                <td><?= $student['studentNum']; ?></td>
                                                <td><?= $student['parentNum']; ?></td>
                                                <td><?= $student['sEmail']; ?></td>
                                                <td><?= $student['religion']; ?></td>
                                                <td><?= $student['caste']; ?></td>
                                                <td><?= $student['fLang']; ?></td>
                                                <td><?= $student['sLang']; ?></td>
                                                <td><?= $student['stream']; ?></td>
                                                <td><?= $student['cMode']; ?></td>
                                                <td><?= $student['adddate']; ?></td>
                                                <td><?= $student['aYear']; ?></td>
                                                
                                                <td>
                                                <div class="d-flex justify-content-between action">
                                                        <button type="button" class="btn-icon btn-primary view" data-bs-toggle="modal" data-bs-target="#viewAdmission" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-eye"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary edit" data-bs-toggle="modal" data-bs-target="#editAdmission" data-student-id="<?= $student['id']; ?>">
                                                            <i class="bi bi-pencil"></i> 
                                                        </button>
                                                        <button type="button" class="btn-icon btn-primary delete" data-bs-toggle="modal" data-bs-target="#deleteAdmission" data-student-id="<?= $student['id']; ?>">
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
    <div class="modal fade bd-example-modal-xl" id="addAdmission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Admission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./admission-add.php'); ?>   
                </div>          
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-xl" id="viewAdmission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admission Record View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./admission-view.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="editAdmission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admission Record Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include('./admission-edit.php'); ?>   
                </div>
            
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAdmission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admission Record Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <form action="/master/include/code" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_admission" id="deleteRecordBtn"  class="btn btn-danger">Delete</button>
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
            const deleteButton = document.getElementById('deleteRecordBtn');
            deleteButton.value = studentId;
        }

        //Function to view
        function fetchSchoolDetails(studentId) {
            fetch(`admission-view?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#viewAdmission .modal-body");
                modalBody.innerHTML = data;
                $('#viewAdmission').modal('show'); // Show the modal after fetching the details
            })
            .catch(error => {
                console.error('Error fetching school details:', error);
            });
        }

        function fetchEditSchoolForm(studentId) {
            fetch(`admission-edit?id=${studentId}`)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector("#editAdmission .modal-body");
                modalBody.innerHTML = data;
                $('#editAdmission').modal('show'); // Show the modal after fetching the form
                
                // Call form validation initialization after content is loaded
                initializeFormValidation(modalBody.querySelector('form'));
            })
            .catch(error => {
                console.error('Error fetching edit school form:', error);
            });
        }

        
        function initializeFormValidation(formElement) {
            const form = document.querySelector('#editAddmission');
            const studentPic = document.querySelector('#editAddmission input[name="studentPic"]');
            const name = document.querySelector('#editAddmission input[name="name"]');
            const dob = document.querySelector('#editAddmission input[name="dob"]');
            const cName = document.querySelector('#editAddmission input[name="cName"]');
            const sClass = document.querySelector('#editAddmission select[name="class"]');
            const board = document.querySelector('#editAddmission input[name="board"]');
            const pClassPer = document.querySelector('#editAddmission input[name="pClassPer"]');
            const parentName = document.querySelector('#editAddmission input[name="parentName"]');
            const parentOcp = document.querySelector('#editAddmission input[name="parentOcp"]');
            const address = document.querySelector('#editAddmission input[name="address"]');
            const sPhone = document.querySelector('#editAddmission input[name="sPhone"]');
            const pPhone = document.querySelector('#editAddmission input[name="pPhone"]');
            const sEmail = document.querySelector('#editAddmission input[name="sEmail"]');
            const religion = document.querySelector('#editAddmission input[name="religion"]');
            const caste = document.querySelector('#editAddmission input[name="caste"]');
            const fLang = document.querySelector('#editAddmission select[name="fLang"]');
            const sLang = document.querySelector('#editAddmission select[name="sLang"]');
            const stream = document.querySelector('#editAddmission select[name="stream"]');
            const cMode = document.querySelector('#editAddmission select[name="cMode"]');
            const sslcMarks = document.querySelector('#editAddmission input[name="sslcMarks"]');
            const midtermMarks = document.querySelector('#editAddmission input[name="midtermMarks"]');

            // Set default value for phone input
            sPhone.value = '+91 '; // Set the initial value to '+91 '
            pPhone.value = '+91 '; // Set the initial value to '+91 '

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

            const checkInputs = async (event) => {
                let hasErrors = false;
                event.preventDefault();
                const studentPicValue = studentPic.value.trim();
                const nameValue = name.value.trim();
                const dobValue = dob.value.trim();
                const cNameValue = cName.value.trim();
                const sClassValue = sClass.value.trim();
                const boardValue = board.value.trim();
                const pClassPerValue = pClassPer.value.trim();
                const parentNameValue = parentName.value.trim();
                const parentOcpValue = parentOcp.value.trim();
                const addressValue = address.value.trim();
                const sPhoneValue = sPhone.value.trim();
                const pPhoneValue = pPhone.value.trim();
                const sEmailValue = sEmail.value.trim();
                const religionValue = religion.value.trim();
                const casteValue = caste.value.trim();
                const fLangValue = fLang.value.trim();
                const sLangValue = sLang.value.trim();
                const streamValue = stream.value.trim();
                const cModeValue = cMode.value.trim();
                const sslcMarksValue = sslcMarks.value.trim();
                const midtermMarksValue = midtermMarks.value.trim();
                

                // Regular expression to check for special characters
                const specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/;


                // Upload file validation for studentPic
                if (studentPicValue !== '') {
                    if (studentPic.files.length > 0) {
                        if (studentPic.files[0].size > 1024 * 1024) {
                            setError(studentPic, 'File size should not exceed 5 MB.');
                            hasErrors = true;
                        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(studentPic.files[0].type)) {
                            setError(studentPic, 'File type should be JPEG, JPG, or PNG.');
                            hasErrors = true;
                        } else {
                            convertToPNG(studentPic);
                            setSuccess(studentPic);
                        }
                    } else {
                        setError(studentPic, 'Please select the file.');
                        hasErrors = true;
                    }
                }


                //Name validation
                if (nameValue === '') {
                    setError(name, 'Name cannot be empty');
                    hasErrors = true;
                } else if (specialCharRegex.test(nameValue)) {
                    setError(name, 'Name should not contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(name);
                }

                // Date of Birth validation
                if (dobValue === '') {
                    setError(dob, 'DOB cannot be empty.');
                    hasErrors = true;
                } else {
                    setSuccess(dob);
                }

                // Collage Name validation
                if (cNameValue === '') {
                    setError(cName, 'Collage Name cannot be empty');
                    hasErrors = true;
                } else if (specialCharRegex.test(cNameValue)) {
                    setError(cName, 'Name should not contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(cName);
                }

                // Student Class validation
                if (sClassValue === '') {
                    setError(sClass, 'Present Class cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(sClassValue)) {
                    setError(sClass, 'Input cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(sClass);
                }

                // Board Input validation
                if (boardValue === '') {
                    setError(board, 'Board cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(boardValue)) {
                    setError(board, 'Board Value cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(board);
                }

                // Percentage Input validation
                if (pClassPerValue === '') {
                    setError(pClassPer, 'Enter the previous class Percentage.');
                    hasErrors = true;
                } else if (specialCharRegex.test(pClassPerValue)) {
                    setError(pClassPer, 'Enter only percentage Ex:- 55.01');
                    hasErrors = true;
                } else {
                    setSuccess(pClassPer);
                }

                // Parent Name validation
                if (parentNameValue === '') {
                    setError(parentName, 'Name cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(parentNameValue)) {
                    setError(parentName, 'Name cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(parentName);
                }

                // Parent Occupation validation
                if (parentOcpValue === '') {
                    setError(parentOcp, 'Name cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(parentOcpValue)) {
                    setError(parentOcp, 'Name cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(parentOcp);
                }

                // Parent Occupation validation
                if (addressValue === '') {
                    setError(address, 'Address cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(addressValue)) {
                    setError(address, 'Address cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(address);
                }

                // Student Number validation
                if (sPhoneValue === '') {
                    setError(sPhone, 'Number cannot be empty.');
                    hasErrors = true;
                } else if (!isValidPhoneNumber(sPhoneValue)) { // Check if phone number is valid
                    setError(sPhone, 'Provide a valid phone number (e.g., +91 1234567890)');
                    hasErrors = true;
                } else {
                    setSuccess(sPhone);
                }

                // Student Number validation
                if (pPhoneValue === '') {
                    setError(pPhone, 'Number cannot be empty.');
                    hasErrors = true;
                } else if (!isValidPhoneNumber(pPhoneValue)) { // Check if phone number is valid
                    setError(pPhone, 'Provide a valid phone number (e.g., +91 1234567890)');
                    hasErrors = true;
                } else {
                    setSuccess(pPhone);
                }


                // Email validation
                if (sEmailValue === '') {
                    setError(sEmail, 'Email Address cannot be empty.');
                    hasErrors = true;
                } else if (!isValidEmail(sEmailValue)) {
                    setError(sEmail, 'Provide a valid email address');
                    hasErrors = true;
                } else {
                    setSuccess(sEmail);
                }


                // Religion validation
                if (religionValue === '') {
                    setError(religion, 'Religion cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(religionValue)) {
                    setError(religion, 'Religion cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(religion);
                }

                // Caste validation
                if (casteValue === '') {
                    setError(caste, 'Caste cannot be empty.');
                    hasErrors = true;
                } else if (specialCharRegex.test(casteValue)) {
                    setError(caste, 'Caste cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(caste);
                }

                // Language 1st validation
                if (fLangValue === '') {
                    setError(fLang, 'Please Enter 1st Language.');
                    hasErrors = true;
                } else if (specialCharRegex.test(fLangValue)) {
                    setError(fLang, 'Language cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(fLang);
                }

                // Language 2nd validation
                if (sLangValue === '') {
                    setError(sLang, 'Please Enter 2nd Language.');
                    hasErrors = true;
                } else if (specialCharRegex.test(sLangValue)) {
                    setError(sLang, 'Language cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(sLang);
                }

                // Stream validation
                if (streamValue === '') {
                    setError(stream, 'Select the Value.');
                    hasErrors = true;
                } else if (specialCharRegex.test(streamValue)) {
                    setError(stream, 'Value cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(stream);
                }

                // Class mode validation
                if (cModeValue === '') {
                    setError(cMode, 'Select the Value.');
                    hasErrors = true;
                } else if (specialCharRegex.test(cModeValue)) {
                    setError(cMode, 'Value cannot contain special characters');
                    hasErrors = true;
                } else {
                    setSuccess(cMode);
                }

                // Upload file validation for sslcMarks
                if (sslcMarksValue !== '') {
                    if (sslcMarks.files.length > 0) {
                        if (sslcMarks.files[0].size > 5 * 1024 * 1024) {
                            setError(sslcMarks, 'File size should not exceed 5 MB.');
                            hasErrors = true;
                        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(sslcMarks.files[0].type)) {
                            setError(sslcMarks, 'File type should be JPEG, JPG, or PNG.');
                            hasErrors = true;
                        } else {
                            convertToPNG(sslcMarks);
                            setSuccess(sslcMarks);
                        }
                    } else {
                        setError(sslcMarks, 'Please select the file.');
                        hasErrors = true;
                    }
                }

                // Upload file validation for midtermMarks
                if (midtermMarksValue !== '') {
                    if (midtermMarks.files.length > 0) {
                        if (midtermMarks.files[0].size > 5 * 1024 * 1024) {
                            setError(midtermMarks, 'File size should not exceed 5 MB.');
                            hasErrors = true;
                        } else if (!['image/jpeg', 'image/jpg', 'image/png'].includes(midtermMarks.files[0].type)) {
                            setError(midtermMarks, 'File type should be JPEG, JPG, or PNG.');
                            hasErrors = true;
                        } else {
                            convertToPNG(midtermMarks);
                            setSuccess(midtermMarks);
                        }
                    } else {
                        setError(midtermMarks, 'Please select the file.');
                        hasErrors = true;
                    }
                }


                if (hasErrors) {
                    event.preventDefault(); // Don't submit the form if there are errors
                } else {
                    form.submit();
                }
            };

            const isValidPhoneNumber = phoneNumber => {
                // Regular expression pattern
                const regex = /^\+91 \d{10}$/;
                // Test the input against the pattern
                return regex.test(phoneNumber);
            };

            const isValidEmail = email => {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            };


            // Function to check if the uploaded file is a PNG file
            function isValidFileType(fileInput) {
                var file = fileInput.files[0];
                var fileType = file.type;
                return fileType === 'image/png';
            }

            // Function to handle file conversion from JPEG/JPG to PNG
            function convertToPNG(fileInput) {
                var file = fileInput.files[0];
                if (file.type === 'image/jpeg' || file.type === 'image/jpg') {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var img = new Image();
                        img.onload = function() {
                            var canvas = document.createElement('canvas');
                            canvas.width = img.width;
                            canvas.height = img.height;
                            var ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0);
                            canvas.toBlob(function(blob) {
                                var newFile = new File([blob], file.name.replace(/\.(jpeg|jpg)$/, '.png'), { type: 'image/png' });
                                fileInput.files[0] = newFile;
                                console.log('File type after conversion:', newFile.type);
                            }, 'image/png');
                        };
                        img.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

    });
</script>
<!--
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add submit event listener to the form
        document.getElementById('addAddmission').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Call function to handle file conversion
            convertFilesAndSubmit();
        });

        function convertFilesAndSubmit() {
            // Get the file inputs
            const sslcMarksInput = document.getElementById('sslcMarks');
            const midtermMarksInput = document.getElementById('midtermMarks');

            // Array to hold the converted PNG files
            const convertedFiles = [];

            // Function to handle file conversion
            function handleFileConversion(input) {
                const file = input.files[0];

                if (file && (file.type === 'image/jpeg' || file.type === 'image/jpg')) {
                    console.log('Starting file conversion...');
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        console.log('File loaded successfully.');

                        const img = new Image();
                        img.onload = function() {
                            console.log('Image loaded successfully.');

                            // Create a canvas element
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');

                            // Calculate the new width and height to reduce file size
                            const maxWidth = 100; // Adjust as needed
                            const maxHeight = 100; // Adjust as needed
                            let width = img.width;
                            let height = img.height;
                            if (width > maxWidth || height > maxHeight) {
                                const ratio = Math.min(maxWidth / width, maxHeight / height);
                                width *= ratio;
                                height *= ratio;
                            }

                            // Set canvas dimensions
                            canvas.width = width;
                            canvas.height = height;

                            // Draw image onto canvas with reduced dimensions
                            ctx.drawImage(img, 0, 0, width, height);

                            // Convert canvas to compressed PNG data URL
                            const compressedPngDataUrl = canvas.toDataURL('image/png', 0.5); // Adjust compression quality (0.0 - 1.0)

                            // Convert data URL to File object
                            const compressedFile = dataURLtoFile(compressedPngDataUrl, file.name);
                            console.log('File compressed successfully.');

                            // Push compressed file to array
                            convertedFiles.push(compressedFile);

                            // Check if all files have been converted
                            if (convertedFiles.length === 2) { // Adjust the number accordingly
                                // Replace original files with compressed files
                                sslcMarksInput.files[0] = convertedFiles[0];
                                midtermMarksInput.files[0] = convertedFiles[1];

                                // Submit the form
                                console.log('All files converted successfully. Submitting form...');
                                document.getElementById('addAddmission').submit();
                            }
                        };
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            }

            // Trigger file conversion for each input
            console.log('Starting file conversion for SSLC Marks...');
            handleFileConversion(sslcMarksInput);
            console.log('Starting file conversion for Midterm Marks...');
            handleFileConversion(midtermMarksInput);
        }

        // Function to convert data URL to File object
        function dataURLtoFile(dataUrl, filename) {
            const arr = dataUrl.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, { type: mime });
        }
    });
</script>
-->


<script src="/master/admission/validation.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    console.log('Initializing DataTable');
    const table = $('#datatable').DataTable({
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
</script>
  </section>
<?php
session_start();
require '../include/dbconnection.php';

var_dump($_POST, $_FILES);

//School Delete
if(isset($_POST['delete_school'])){
    $student_id = mysqli_real_escape_string($con, $_POST['delete_school']);

    $query = "DELETE FROM school_add WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Update Record";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/school/index" );
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

// Student Delete
if(isset($_POST['delete_student'])){
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);
    $studentPage = mysqli_real_escape_string($con, $_POST['deletePage']);

    switch ($studentPage) {
        case '1':
            $table = 'student_add_details1';
            break;
        case '2':
            $table = 'student_add_details2';
            break;
        case '3':
            $table = 'student_add_details3';
            break;
        default:
            // Handle unexpected page number
            $_SESSION['error_message'] = "Invalid page number";
            header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
            exit(); // Terminate script execution
    }

    $query = "DELETE FROM $table WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete Record";
    }

    // Redirect to the current page or default URL
    $redirect_url = isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url';
    header("Location: $redirect_url");
    exit();
}

// Student Bulk Delete
if(isset($_POST['bulkDelete'])){
    $bulkDeleteData = mysqli_real_escape_string($con, $_POST['bulkDeleteData']);
    $bulkDeletePage = mysqli_real_escape_string($con, $_POST['bulkDeletePage']);

    switch ($bulkDeletePage) {
        case '1':
            $table = 'student_add_details1';
            break;
        case '2':
            $table = 'student_add_details2';
            break;
        case '3':
            $table = 'student_add_details3';
            break;
        default:
            // Handle unexpected page number
            $_SESSION['error_message'] = "Invalid page number";
            header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
            exit(); // Terminate script execution
    }
    $deletedCount = 0; // Variable to store the count of deleted records

    foreach (explode(',', $bulkDeleteData) as $singleID) {
        $query = "DELETE FROM $table WHERE id = '$singleID' ";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $deletedCount++; // Increment count for each successful deletion
        }
    }

    if ($deletedCount > 0) {
        $_SESSION['success_message'] = "$deletedCount record(s) Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete Record";
    }

    // Redirect to the current page or default URL
    $redirect_url = isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url';
    header("Location: $redirect_url");
    exit();
}

//Import Validation Function
function validateData($name, $class, $sboard, $gender, $parent, $parentocp, $phoneNum, $kan, $eng, $hin, $mat, $sci, $soc, $importValue, $maxKan, $maxEng, $maxHin, $maxMat, $maxSci, $maxSoc)
{
    // Name validation
    if (strlen($name) > 30 || !preg_match('/^[a-zA-Z0-9 ]+$/', $name)) {
        $_SESSION['error_message'] .= "Error: Name should not exceed 30 characters and should not contain special characters.\n";
    }

    // Class validation
    if (!in_array($class, ['9th', '10th']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $class)) {
        $_SESSION['error_message'] .= "Error: Class should be either 9th or 10th and should not contain special characters.\n";
    }

    // Sboard validation
    if (!in_array($sboard, ['State', 'CBSE']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $sboard)) {
        $_SESSION['error_message'] .= "Error: Sboard should be either State or CBSE and should not contain special characters.\n";
    }

    // Gender validation
    if (!in_array($gender, ['Male', 'Female']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $gender)) {
        $_SESSION['error_message'] .= "Error: Gender should be Male or Female and should not contain special characters.\n";
    }

    // Parent validation
    if (strlen($parent) > 30 || !preg_match('/^[a-zA-Z0-9 ]+$/', $parent)) {
        $_SESSION['error_message'] .= "Error: Parent name should not exceed 30 characters and should not contain special characters.\n";
    }

    // Parent occupation validation
    if (strlen($parentocp) > 20 || !preg_match('/^[a-zA-Z0-9 ]+$/', $parentocp)) {
        $_SESSION['error_message'] .= "Error: Parent occupation should not exceed 20 characters and should not contain special characters.\n";
    }

    // Ensure $phoneNum starts with '+91 ' by default

        if (!preg_match('/^\+91 \d{10}$/', $phoneNum)) {
            $_SESSION['error_message'] .= "Error: Phone number should contain only 10 digits and should start with '+91 '.\n";
        }
    



        if (!ctype_digit($kan) || $kan > $maxKan) {
            $_SESSION['error_message'] .= "Error: Kannada score should be a number and should not exceed $maxKan.\n";
        }

        if (!ctype_digit($eng) || $eng > $maxEng) {
            $_SESSION['error_message'] .= "Error: English score should be a number and should not exceed $maxEng.\n";
        }

        if (!ctype_digit($hin) || $hin > $maxHin) {
            $_SESSION['error_message'] .= "Error: Hindi score should be a number and should not exceed $maxHin.\n";
        }

        if (!ctype_digit($mat) || $mat > $maxMat) {
            $_SESSION['error_message'] .= "Error: Math score should be a number and should not exceed $maxMat.\n";
        }

        if (!ctype_digit($sci) || $sci > $maxSci) {
            $_SESSION['error_message'] .= "Error: Science score should be a number and should not exceed $maxSci.\n";
        }

        if (!ctype_digit($soc) || $soc > $maxSoc) {
            $_SESSION['error_message'] .= "Error: Science score should be a number and should not exceed $maxSoc.\n";
        }
    
}

                
//Import
if(isset($_POST['importStudent'])){
    $studentSchool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $schoolid = mysqli_real_escape_string($con, $_POST['schoolId']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);
    $importValue = mysqli_real_escape_string($con, $_POST['importValue']);
    $smedium = mysqli_real_escape_string($con, $_POST['sMediumImport']);
    $current_url = mysqli_real_escape_string($con, $_POST['current_url']);

    $maxKan = mysqli_real_escape_string($con, $_POST['maxKan']);
    $maxEng = mysqli_real_escape_string($con, $_POST['maxEng']);
    $maxHin = mysqli_real_escape_string($con, $_POST['maxHin']);
    $maxMat = mysqli_real_escape_string($con, $_POST['maxMat']);
    $maxSci = mysqli_real_escape_string($con, $_POST['maxSci']);
    $maxSoc = mysqli_real_escape_string($con, $_POST['maxSoc']);

    // Allowed mime types for CSV files
    $csvMimes = array(
        'text/csv',
        'application/csv',
        'application/x-csv',
        'text/x-csv',
        'text/plain',
        'text/comma-separated-values'
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name'])) {
        // Check if the file type is not in the list of allowed CSV MIME types
        if (!in_array($_FILES['file']['type'], $csvMimes)) {
            $_SESSION['error_message'] = "Error: Only CSV files are allowed.";
            header("Location: " . $_POST['current_url']);
            exit();
        }

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            $lineNumber = 1; // Initialize line number
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $name   = $line[0];
                $class  = $line[1];
                $sboard  = $line[2];
                $gender = $line[3];
                $parent = $line[4];
                $parentocp = $line[5];
                $phoneNum = '+91 ' . $line[6];
                $kan = $line[7];
                $eng = $line[8];
                $hin = $line[9];
                $mat = $line[10];
                $sci = $line[11];
                $soc = $line[12];

                // Validate data for each row
                validateData($name, $class, $sboard, $gender, $parent, $parentocp, $phoneNum, $kan, $eng, $hin, $mat, $sci, $soc, $importValue, $maxKan, $maxEng, $maxHin, $maxMat, $maxSci, $maxSoc);

                // Check if there are any error messages
                if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
                    $_SESSION['error_message'] .= "Error occurred in line $lineNumber.\n"; // Append line number to error message
                    fclose($csvFile);
                    header("Location: " . $_POST['current_url']); // Redirect to the current page
                    exit();
                }
                
                $lineNumber++; // Increment line number

                switch ($importValue) {
                    case '1':
                        $table = 'student_add_details1';
                        $total = $kan + $eng + $hin + $mat + $sci + $soc;
                        $percentage = ($total / 625) * 100;
                        break;
                    case '2':
                        $table = 'student_add_details2';
                        $total = $kan + $eng + $hin + $mat + $sci + $soc;
                        $percentage = ($total / 500) * 100;
                        break;
                    case '3':
                        $table = 'student_add_details3';
                        $total = $kan + $eng + $hin + $mat + $sci + $soc;
                        $percentage = ($total / 625) * 100;
                        break;
                    default:
                        // Handle unexpected page number
                        $_SESSION['error_message'] = "Invalid page number";
                        header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
                        exit(); // Terminate script execution
                }

                // Calculate result based on percentage
                if ($percentage >= 70) {
                        $resultValue = "Distinction";
                    } elseif ($percentage >= 60) {
                        $resultValue = "First Class";
                    } elseif ($percentage >= 50) {
                        $resultValue = "Second Class";
                    } elseif ($percentage >= 35) {
                        $resultValue = "Pass";
                    } else {
                        $resultValue = "Fail";
                }

                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM $table WHERE studentName = '".$name."' AND studentContact= '".$phoneNum."' ";
                $prevResult = $con->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Retrieve the existing schoolId and studentMedium from the database for the given student_id
                    $fetch_query = "SELECT schoolId FROM $table WHERE studentName = '".$name."' AND studentContact= '".$phoneNum."' ";
                    $fetch_result = mysqli_query($con, $fetch_query);

                        if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
                            $row = mysqli_fetch_assoc($fetch_result);
                            $existing_school_id = $row['schoolId'];

                            // Check if the initial seven characters of $schoolid match with the initial seven characters of $existing_school_id
                            // Also, check if the first character of $smedium matches with the fourth character of $existing_school_id
                            if (substr($schoolid, 0, 7) === substr($existing_school_id, 0, 7) && $smedium[0] === $existing_school_id[8]) {
                                // If the conditions are met, set the new_student_id as the existing schoolId
                                $new_student_id = $existing_school_id;
                                echo "Student ID remains unchanged: $new_student_id";
                                } else {
                                // If no student ID exists for the given school ID and smedium, create the first one
                                $new_sequential_part = '001';
                            
                                // Creating the new student ID
                                $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;
                            
                                // Check if the newly generated student ID already exists
                                $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
                                $check_result = mysqli_query($con, $check_query);
                            
                                // Loop until we find a unique student ID
                                while (mysqli_num_rows($check_result) > 0) {
                                    // Increment the sequential part
                                    $new_sequential_part++;
                            
                                    // Incrementing the sequential part and padding with zeros
                                    $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . str_pad($new_sequential_part, 3, '0', STR_PAD_LEFT);
                            
                                    // Check again if the newly generated student ID exists
                                    $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
                                    $check_result = mysqli_query($con, $check_query);
                                }
                            
                                echo "New Student ID: $new_student_id";
                            }
                            } else {
                            echo "Error fetching existing student ID: " . mysqli_error($con);
                            }


                            // Update member data in the database
                            $con->query("UPDATE $table SET schoolName = '".$studentSchool."', schoolId = '".$new_student_id."', studentBoard = '".$sboard."', std = '".$class."', studentMedium = '".$smedium."',
                            studentName = '".$name."', studentGender = '".$gender."', studentParent = '".$parent."', studentParentOccupation = '".$parentocp."', studentContact = '".$phoneNum."', subKan = '".$kan."', subEng = '".$eng."', subHin = '".$hin."', subMat = '".$mat."', subSci = '".$sci."', subSoc = '".$soc."', total = '".$total."', percentage = '".$percentage."', result = '".$resultValue."', studentAddDate = '".$sadd_date."'
                                        WHERE studentName = '".$name."' AND studentContact= '".$phoneNum."' ");
                                        $_SESSION['success_message'] = "Successfully Updated and Insterted " . ($lineNumber - 1) . " Rows \n";
                        }else if($prevResult->num_rows == 0){
                        // Insert member data in the database


                            $query = "SELECT schoolId FROM $table WHERE LEFT(schoolId, 7) = LEFT('$schoolid', 7) AND studentMedium = '$smedium' ORDER BY schoolId DESC LIMIT 1";
                            $result = mysqli_query($con, $query);
                            $sequential_part = 0;
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    // Extracting the sequential number part of the student ID
                                    $row = mysqli_fetch_assoc($result);
                                    $max_student_id = $row['schoolId'];
                                    $parts = explode('-', $max_student_id);
                                    $sequential_part = intval(end($parts));

                                    // Incrementing the sequential part and padding with zeros
                                    $new_sequential_part = str_pad(($sequential_part + 1), 3, '0', STR_PAD_LEFT);
                                    } else {
                                    // If no student ID exists for the given school ID and smedium, create the first one
                                    $new_sequential_part = '001';
                                }

                                // Creating the new student ID
                                $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;

                                // Check if the newly generated student ID already exists
                                $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
                                $check_result = mysqli_query($con, $check_query);

                                // Loop until we find a unique student ID
                                while (mysqli_num_rows($check_result) > 0) {
                                    // Increment the sequential part
                                    $sequential_part++;

                                    // Incrementing the sequential part and padding with zeros
                                    $new_sequential_part = str_pad($sequential_part, 3, '0', STR_PAD_LEFT);

                                    // Creating the new student ID
                                    $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;

                                    // Check again if the newly generated student ID exists
                                    $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
                                    $check_result = mysqli_query($con, $check_query);
                                }

                                    echo "New Student ID: $new_student_id";
                                // Now you can use $new_student_id to insert/update your database record
                                } else {
                                echo "Error: " . mysqli_error($con);
                            }
                        


                            $con->query("INSERT INTO $table (`schoolName`, `schoolId`, `studentBoard`, `std`, `studentMedium`, `studentName`, `studentGender`, `studentParent`, `studentParentOccupation`, `studentContact`, `subKan`, `subEng`, `subHin`, `subMat`, `subSci`, `subSoc`, `total`, `percentage`, `result`, `studentAddDate`) 
                            VALUES ('".$studentSchool."', '".$new_student_id."', '".$sboard."', '".$class."', '".$smedium."',
                            '".$name."', '".$gender."', '".$parent."', '".$parentocp."', '".$phoneNum."', 
                            '".$kan."', '".$eng."', '".$hin."', '".$mat."', '".$sci."', '".$soc."', '".$total."', '".$percentage."',
                            '".$resultValue."', 
                            '".$sadd_date."')
                            ");
                
                            $_SESSION['success_message'] = "Record Updated and Inserted Successfully till" . ($lineNumber - 1) . "row \n";
                            } else {
                            $_SESSION['error_message'] = "Failed to Create";
                            }
                        }
            
                        // Close opened CSV file
                        fclose($csvFile);
                        
                        $qstring = '?status=succ';
                    }else{
                            $qstring = '?status=err';
                    }
                } else {
                    $_SESSION['error_message'] = "Error: No file uploaded.";
                    header("Location: " . $_POST['current_url']);
                    exit();
                }
                

            
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    exit();

}


// Export
if(isset($_POST['exportStudent'])){
    try {
        // Prevent SQL injection
        $exportPage = mysqli_real_escape_string($con, $_POST['exportPage']);
        $exportSchool = mysqli_real_escape_string($con, $_POST['exportSchool']);

        switch ($exportPage) {
            case '1':
                $table = 'student_add_details1';
                break;
            case '2':
                $table = 'student_add_details2';
                break;
            case '3':
                $table = 'student_add_details3';
                break;
            default:
                // Handle unexpected page number
                throw new Exception("Invalid page number.");
        }


        // SQL query to select data from table
        $sql = "SELECT * FROM $table";
        // Append WHERE clause if $exportSchool is not empty
        if(!empty($exportSchool)) {
            $sql .= " WHERE schoolName = ?";
        }
        $stmt = $con->prepare($sql);
        // Bind parameter if $exportSchool is not empty
        if(!empty($exportSchool)) {
            $stmt->bind_param("s", $exportSchool);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Set appropriate headers for CSV download
            ob_clean(); // Clear output buffer
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');
            // Output CSV data directly to browser
            $output = fopen('php://output', 'w');
            // Write headers to CSV
            $headers = array();
            $row = $result->fetch_assoc();
            foreach ($row as $key => $value) {
                $headers[] = $key;
            }
            fputcsv($output, $headers);
            // Write data to CSV
            do {
                fputcsv($output, $row);
            } while ($row = $result->fetch_assoc());
            // Close file handle
            fclose($output);
            // Stop further script execution
            exit();
        } else {
            // No records found
            throw new Exception("No records found for selected school.");
        }

        // Success message
        $_SESSION['success_message'] = "Data exported successfully.";
    } catch (Exception $e) {
        // Error message
        $_SESSION['error_message'] = $e->getMessage();
    } finally {
        // Close statement
        $stmt->close();
        // Close MySQL connection
        $con->close();
        // Redirect to the current page or default location
        redirectToDefault();
    }
}

//Export Redirect
function redirectToDefault() {
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    // Ensure script execution stops after redirection
    exit();
}


//Cluster Delete
if(isset($_POST['delete_cluster'])){
    $student_id = mysqli_real_escape_string($con, $_POST['delete_cluster']);

    $query = "DELETE FROM cluster_add WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Update Record";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/cluster/cluster" );
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

//School Edit
if(isset($_POST['update_school'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['updateName']);
    $location = mysqli_real_escape_string($con, $_POST['updateLocation']);
    $phone = mysqli_real_escape_string($con, $_POST['updatePhone']);
    $email = mysqli_real_escape_string($con, $_POST['updateEmail']);
    $cluster = mysqli_real_escape_string($con, $_POST['updateCluster']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);

    // Fetch the previous cluster name for the student
    function getPreviousClusterName($con, $student_id) {
        $query = "SELECT sownedby FROM school_add WHERE id='$student_id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['sownedby'];
    }

    // Get the previous cluster name
    $previousClusterName = getPreviousClusterName($con, $student_id);

    // Check if the first 3 characters of the current cluster name match the previous one
    if (substr($cluster, 0, 3) === substr($previousClusterName, 0, 3)) {
        // If the first 3 characters match, retain the existing ID
        $cluster_id = $previousClusterName;
    } else {
        // If the first 3 characters don't match, generate a new unique ID
        // Function to generate unique ID based on cluster value
        function generateUniqueID($con, $cluster) {
            $query = "SELECT MAX(CONVERT(SUBSTRING_INDEX(sownedby, '-', -1), UNSIGNED)) AS max_id FROM school_add WHERE sownedby LIKE '$cluster-%'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $max_id = $row['max_id'];

            if ($max_id !== null) {
                // If records with similar cluster exist, increment the count
                $new_id = sprintf('%03d', intval($max_id) + 1);
            } else {
                // If no records with similar cluster exist, start from 001
                $new_id = '001';
            }

            return $cluster . '-' . $new_id;
        }

        // Generate a new unique ID
        $cluster_id = generateUniqueID($con, $cluster);
    }

    
    // Update query with the new cluster_id
    $query = "UPDATE school_add SET sname='$name', slocation='$location', sphone='$phone', semail='$email', sownedby='$cluster_id', sadddate='$add_date' WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);
    
    

    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Update Record";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/school/index" );
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

//Add Cluster
if (isset($_POST['saveCluster'])) {
    $name = mysqli_real_escape_string($con, $_POST['cname']);
    $ownedby = mysqli_real_escape_string($con, $_POST['cownedby']);
    $id = mysqli_real_escape_string($con, $_POST['cid']);
    $add_date = mysqli_real_escape_string($con, $_POST['cadd_date']);

    $query = "INSERT INTO cluster_add (cname,cownedby,cid,cadddate) VALUES 
            ('$name', '$ownedby', '$id', '$add_date')";

    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Created Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    var_dump($_POST);
    exit();

}

// Cluster Edit
if (isset($_POST['updateCluster'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['updateCname']);
    $ownedby = mysqli_real_escape_string($con, $_POST['updateCownedby']);
    $id = mysqli_real_escape_string($con, $_POST['updateCid']);
    $add_date = mysqli_real_escape_string($con, $_POST['updateCadd_date']);

    // Function to validate and update CID
    function validateAndUpdateCID($con, $cname, $cid, $student_id) {
        $query = "SELECT cid FROM cluster_add WHERE id='$student_id'";
        $result = mysqli_query($con, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $previousCID = $row['cid'];
            
            $clusterNumber = preg_match('/\d{2}/', $cname, $matches) ? $matches[0] : null;
            if ($clusterNumber !== null) {
                $updatedCID = 'C' . $clusterNumber;
                if ($cid !== $updatedCID) {
                    return $updatedCID; // Return the updated CID value
                }
            }
        }
        // If CID is not updated, return null
        return null;
    }
    
    // Call the function to validate and update CID
    $updatedCID = validateAndUpdateCID($con, $name, $id, $student_id);

    // Update query for cluster details
    $query = "UPDATE cluster_add SET cname='$name', cownedby='$ownedby', cadddate='$add_date'";
    
    // Append CID update to the query if necessary
    if ($updatedCID !== null) {
        $query .= ", cid='$updatedCID'";
    }
    
    // Complete the WHERE clause
    $query .= " WHERE id='$student_id'";
    
    // Execute the update query
    $query_run = mysqli_query($con, $query);
    
    // Check if the query executed successfully
    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Update Record";
    }
    
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/cluster/cluster" );
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

//Add School
if (isset($_POST['save_school'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $cluster = mysqli_real_escape_string($con, $_POST['cluster']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);

    // Function to generate unique ID based on cluster value
    function generateUniqueID($con, $cluster) {
        $query = "SELECT MAX(CONVERT(SUBSTRING_INDEX(sownedby, '-', -1), UNSIGNED)) AS max_id FROM school_add WHERE sownedby LIKE '$cluster-%'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'];

        if ($max_id !== null) {
            // If records with similar cluster exist, increment the count
            $new_id = sprintf('%03d', intval($max_id) + 1);
        } else {
            // If no records with similar cluster exist, start from 001
            $new_id = '001';
        }

        return $cluster . '-' . $new_id;
    }


    $cluster_id = generateUniqueID($con, $cluster);

    $query = "INSERT INTO school_add (sname, slocation, sphone, semail, sownedby, sadddate) VALUES 
            ('$name', '$location', '$phone', '$email', '$cluster_id', '$add_date')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Created Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

//Add Student
if (isset($_POST['saveStudent'])) {
    $marks = mysqli_real_escape_string($con, $_POST['studentMarksFor']);
    $sschool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $sname = mysqli_real_escape_string($con, $_POST['studentName']);
    $sclass = mysqli_real_escape_string($con, $_POST['studentStd']);
    $sboard = mysqli_real_escape_string($con, $_POST['studentBoard']);
    $smedium = mysqli_real_escape_string($con, $_POST['sMedium']);
    $sgender = mysqli_real_escape_string($con, $_POST['studentGender']);
    $sparent = mysqli_real_escape_string($con, $_POST['studentParent']);
    $sparocp = mysqli_real_escape_string($con, $_POST['studentParOcu']);
    $sphone = mysqli_real_escape_string($con, $_POST['studentContact']);
    $subkan = mysqli_real_escape_string($con, $_POST['subKan']);
    $subeng = mysqli_real_escape_string($con, $_POST['subEng']);
    $subhin = mysqli_real_escape_string($con, $_POST['subHin']);
    $submat = mysqli_real_escape_string($con, $_POST['subMat']);
    $subsci = mysqli_real_escape_string($con, $_POST['subSci']);
    $subsoc = mysqli_real_escape_string($con, $_POST['subSoc']);
    $schoolid = mysqli_real_escape_string($con, $_POST['schoolId']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);

    
    // Check the value of marks
    switch ($marks) {
        case 'semiMarks':
            $table = 'student_add_details1';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            break;
        case 'midMarks':
            $table = 'student_add_details2';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 500) * 100;
            break;
        case 'finalMarks':
            $table = 'student_add_details3';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            break;
        default:
           // Handle unexpected marks value
           $_SESSION['error_message'] = "Invalid marks value";
           header("Location: /master/student/studentt");
           exit(); // Terminate script execution
    }



    $query = "SELECT schoolId FROM $table WHERE LEFT(schoolId, 9) = LEFT('$schoolid', 9) AND studentMedium = '$smedium' ORDER BY schoolId DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Extracting the sequential number part of the student ID
            $row = mysqli_fetch_assoc($result);
            $max_student_id = $row['schoolId'];
            $parts = explode('-', $max_student_id);
            $sequential_part = intval(end($parts));

            // Incrementing the sequential part and padding with zeros
            $new_sequential_part = str_pad(($sequential_part + 1), 3, '0', STR_PAD_LEFT);
        } else {
            // If no student ID exists for the given school ID and smedium, create the first one
            $new_sequential_part = '001';
        }

        // Creating the new student ID
        $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;

        // Check if the newly generated student ID already exists
        $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
        $check_result = mysqli_query($con, $check_query);

        // Loop until we find a unique student ID
        while (mysqli_num_rows($check_result) > 0) {
            // Increment the sequential part
            $sequential_part++;

            // Incrementing the sequential part and padding with zeros
            $new_sequential_part = str_pad($sequential_part, 3, '0', STR_PAD_LEFT);

            // Creating the new student ID
            $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;

            // Check again if the newly generated student ID exists
            $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
            $check_result = mysqli_query($con, $check_query);
        }

        echo "New Student ID: $new_student_id";
        // Now you can use $new_student_id to insert/update your database record
    } else {
        echo "Error: " . mysqli_error($con);
    }


    // Calculate result based on percentage

    if ($percentage >= 70) {
        $result = "Distinction";
    } elseif ($percentage >= 60) {
        $result = "First Class";
    } elseif ($percentage >= 50) {
        $result = "Second Class";
    } elseif ($percentage >= 35) {
        $result = "Pass";
    } else {
        $result = "Fail";
    }

    $query = "INSERT INTO $table (`schoolName`, `schoolId`, `studentBoard`, `std`, `studentMedium`, `studentName`, `studentGender`, `studentParent`, `studentParentOccupation`, `studentContact`, `subKan`, `subEng`, `subHin`, `subMat`, `subSci`, `subSoc`, `total`, `percentage`, `result`, `studentAddDate`) VALUES 
            ('$sschool', '$new_student_id', '$sboard', '$sclass', '$smedium', '$sname', '$sgender', '$sparent', '$sparocp', '$sphone', '$subkan', '$subeng', '$subhin', '$submat', '$subsci', '$subsoc', '$total', '$percentage', '$result', '$sadd_date')";

    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Created Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    var_dump($_POST);
    exit();

}

//Edit Student
if (isset($_POST['updateStudent'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $marks = mysqli_real_escape_string($con, $_POST['studentMarksFor']);
    $sschool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $sname = mysqli_real_escape_string($con, $_POST['studentName']);
    $sclass = mysqli_real_escape_string($con, $_POST['studentStd']);
    $smedium = mysqli_real_escape_string($con, $_POST['sMediumEdit']);
    $sboard = mysqli_real_escape_string($con, $_POST['studentBoard']);
    $sgender = mysqli_real_escape_string($con, $_POST['studentGender']);
    $sparent = mysqli_real_escape_string($con, $_POST['studentParent']);
    $sparocp = mysqli_real_escape_string($con, $_POST['studentParOcu']);
    $sphone = mysqli_real_escape_string($con, $_POST['studentContact']);
    $subkan = mysqli_real_escape_string($con, $_POST['subKan']);
    $subeng = mysqli_real_escape_string($con, $_POST['subEng']);
    $subhin = mysqli_real_escape_string($con, $_POST['subHin']);
    $submat = mysqli_real_escape_string($con, $_POST['subMat']);
    $subsci = mysqli_real_escape_string($con, $_POST['subSci']);
    $subsoc = mysqli_real_escape_string($con, $_POST['subSoc']);
    $schoolid = mysqli_real_escape_string($con, $_POST['schoolIdEdit']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);


    // Check the value of marks
    $current_url = "/master/student/student?selectedValue=";
    switch ($marks) {
        case 'semiMarks':
            $table = 'student_add_details1';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            $current_url .= "1";
            break;
        case 'midMarks':
            $table = 'student_add_details2';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 500) * 100;
            $current_url .= "2";
            break;
        case 'finalMarks':
            $table = 'student_add_details3';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            $current_url .= "3";
            break;
        default:
        // Handle unexpected marks value
        $_SESSION['error_message'] = "Invalid marks value";
        header("Location: " . $current_url);
        exit(); // Terminate script execution
    }


    // Assuming $student_id is available and represents the ID of the student record you want to update

    // Retrieve the existing schoolId and studentMedium from the database for the given student_id
    $fetch_query = "SELECT schoolId FROM $table WHERE id = '$student_id'";
    $fetch_result = mysqli_query($con, $fetch_query);

    if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
        $row = mysqli_fetch_assoc($fetch_result);
        $existing_school_id = $row['schoolId'];

        // Check if the initial seven characters of $schoolid match with the initial seven characters of $existing_school_id
        // Also, check if the first character of $smedium matches with the fourth character of $existing_school_id
        if (substr($schoolid, 0, 7) === substr($existing_school_id, 0, 7) && $smedium[0] === $existing_school_id[8]) {
            // If the conditions are met, set the new_student_id as the existing schoolId
            $new_student_id = $existing_school_id;
            echo "Student ID remains unchanged: $new_student_id";
        } else {
            // If no student ID exists for the given school ID and smedium, create the first one
            $new_sequential_part = '001';
        
            // Creating the new student ID
            $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . $new_sequential_part;
        
            // Check if the newly generated student ID already exists
            $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
            $check_result = mysqli_query($con, $check_query);
        
            // Loop until we find a unique student ID
            while (mysqli_num_rows($check_result) > 0) {
                // Increment the sequential part
                $new_sequential_part++;
        
                // Incrementing the sequential part and padding with zeros
                $new_student_id = substr($schoolid, 0, 7) . '-' . $smedium[0] . str_pad($new_sequential_part, 3, '0', STR_PAD_LEFT);
        
                // Check again if the newly generated student ID exists
                $check_query = "SELECT schoolId FROM $table WHERE schoolId = '$new_student_id'";
                $check_result = mysqli_query($con, $check_query);
            }
        
            echo "New Student ID: $new_student_id";
        }
    } else {
        echo "Error fetching existing student ID: " . mysqli_error($con);
    }


    // Calculate result based on percentage
    if ($percentage >= 70) {
        $result = "Distinction";
    } elseif ($percentage >= 60) {
        $result = "First Class";
    } elseif ($percentage >= 50) {
        $result = "Second Class";
    } elseif ($percentage >= 35) {
        $result = "Pass";
    } else {
        $result = "Fail";
    }

    $query = "UPDATE $table SET schoolName='$sschool', schoolId='$new_student_id', studentBoard='$sboard', std='$sclass', studentMedium= '$smedium',
                                studentName = '$sname', studentGender='$sgender', studentParent= '$sparent', studentParentOccupation= '$sparocp',
                                studentContact = '$sphone', subKan = '$subkan', subEng='$subeng', subHin='$subhin', subMat='$submat', subSci='$subsci', subSoc='$subsoc', total='$total', percentage='$percentage', result='$result', studentAddDate='$sadd_date' WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $current_url);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    
    exit();

}

// Add User
if (isset($_POST['saveUser'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $userType = mysqli_real_escape_string($con, $_POST['userType']);
    $userFor = mysqli_real_escape_string($con, $_POST['userFor']);
    $userStatus = mysqli_real_escape_string($con, $_POST['userStatus']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPass = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);

    // Check if passwords match
    if ($pass == $confirmPass) {
        // Check password requirements
        if (strlen($pass) >= 8 && preg_match('/[A-Za-z]/', $pass) && preg_match('/\d/', $pass)) {
            // Hash the password for security
            $password = password_hash($pass, PASSWORD_DEFAULT);

            // Prepare the SQL statement with placeholders
            $query = "INSERT INTO users (userName, userPassword, userType, userFor, userStatus, userAddDate) VALUES (?, ?, ?, ?, ?, ?)";

            // Bind parameters and execute the query using prepared statement
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $password, $userType, $userFor, $userStatus, $add_date);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success_message'] = "Record Created Successfully";
            } else {
                $_SESSION['error_message'] = "Failed to Create";
            }
        } else {
            // Password does not meet requirements
            $_SESSION['error_message'] = "Password must be at least 8 characters long and include at least one letter and one number";
        }
    } else {
        // Passwords don't match
        $_SESSION['error_message'] = "Passwords Don't Match";
    }

    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    exit();
}

//User Delete
if(isset($_POST['delete_user'])){
    $student_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    exit();
}

// User Edit
if (isset($_POST['editUser'])) {
    // Escape user inputs for security
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $userType = mysqli_real_escape_string($con, $_POST['userType']);
    $userStatus = mysqli_real_escape_string($con, $_POST['userStatus']);
    $pass = mysqli_real_escape_string($con, $_POST['userPassword']);
    $confirmPass = mysqli_real_escape_string($con, $_POST['userConfirmPassword']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);

    // Check if name is the same as before
    $query = "SELECT userName FROM users WHERE id='$student_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $previousName = $row['userName'];

    if ($name == $previousName) {
        // Name remains the same, proceed with update

        // Check if passwords match
        if ($pass == $confirmPass) {
            // Check password requirements
            if (strlen($pass) >= 8 && preg_match('/[A-Za-z]/', $pass) && preg_match('/\d/', $pass)) {
                // Hash the password for security
                $password = password_hash($pass, PASSWORD_DEFAULT);

                // Prepare the SQL statement with placeholders
                $query = "UPDATE users SET userName='$name', userPassword='$password', userType='$userType', userStatus='$userStatus', userAddDate='$add_date' WHERE id='$student_id'";

                // Execute the query
                if (mysqli_query($con, $query)) {
                    $_SESSION['success_message'] = "Record Updated Successfully";
                } else {
                    $_SESSION['error_message'] = "Failed to Update Record";
                }
            } else {
                // Password does not meet requirements
                $_SESSION['error_message'] = "Password must be at least 8 characters long and include at least one letter and one number";
            }
        } else {
            // Passwords don't match
            $_SESSION['error_message'] = "Passwords Don't Match";
        }
    } else {
        // Name has changed, check if the new name already exists in the database
        $query = "SELECT * FROM users WHERE userName='$name'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Name already exists in the database
            $_SESSION['error_message'] = "User Name already exists";
        } else {
            // Name doesn't exist, proceed with update

            // Check if passwords match
            if ($pass == $confirmPass) {
                // Check password requirements
                if (strlen($pass) >= 8 && preg_match('/[A-Za-z]/', $pass) && preg_match('/\d/', $pass)) {
                    // Hash the password for security
                    $password = password_hash($pass, PASSWORD_DEFAULT);

                    // Prepare the SQL statement with placeholders
                    $query = "UPDATE users SET userName='$name', userPassword='$password', userType='$userType', userStatus='$userStatus', userAddDate='$add_date' WHERE id='$student_id'";

                    // Execute the query
                    if (mysqli_query($con, $query)) {
                        $_SESSION['success_message'] = "Record Updated Successfully";
                    } else {
                        $_SESSION['error_message'] = "Failed to Update Record";
                    }
                } else {
                    // Password does not meet requirements
                    $_SESSION['error_message'] = "Password must be at least 8 characters long and include at least one letter and one number";
                }
            } else {
                // Passwords don't match
                $_SESSION['error_message'] = "Passwords Don't Match";
            }
        }
    }

    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/users/user");
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    exit();
}

//admission-Add
if (isset($_POST['saveAdmission'])) {
    // Check if all files were uploaded without errors
    $uploadErrors = false;
    $uploadedFiles = array();

    // Handle studentPic file upload
    if (isset($_FILES['studentPic']) && $_FILES['studentPic']['error'] === UPLOAD_ERR_OK) {
        $studentPic = $_FILES['studentPic']['tmp_name'];
        $studentPicData = file_get_contents($studentPic);
        $uploadedFiles['studentPic'] = mysqli_real_escape_string($con, $studentPicData);
    } else {
        // Handle studentPic file upload error
        $uploadErrors = true;
    }

    // Handle sslc file upload
    if (isset($_FILES['sslcMarks']) && $_FILES['sslcMarks']['error'] === UPLOAD_ERR_OK) {
        $sslcFile = $_FILES['sslcMarks']['tmp_name'];
        $sslcData = file_get_contents($sslcFile);
        $uploadedFiles['sslcMarks'] = mysqli_real_escape_string($con, $sslcData);
    } else {
        // Handle sslc file upload error
        $uploadErrors = true;
    }

    // Handle midTerm file upload
    if (isset($_FILES['midtermMarks']) && $_FILES['midtermMarks']['error'] === UPLOAD_ERR_OK) {
        $midTermFile = $_FILES['midtermMarks']['tmp_name'];
        $midTermData = file_get_contents($midTermFile);
        $uploadedFiles['midtermMarks'] = mysqli_real_escape_string($con, $midTermData);
    } else {
        // Handle midTerm file upload error
        $uploadErrors = true;
    }

    // If any file upload encountered an error, set error message and redirect
    if ($uploadErrors) {
        $_SESSION['error_message'] = "Failed to upload one or more images.";
        header("Location: " . $_POST['current_url']);
        exit();
    }

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $cName = mysqli_real_escape_string($con, $_POST['cName']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $board = mysqli_real_escape_string($con, $_POST['board']);
    $pClassPer = mysqli_real_escape_string($con, $_POST['pClassPer']);
    $parentName = mysqli_real_escape_string($con, $_POST['parentName']);
    $parentOcp = mysqli_real_escape_string($con, $_POST['parentOcp']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $sPhone = mysqli_real_escape_string($con, $_POST['sPhone']);
    $pPhone = mysqli_real_escape_string($con, $_POST['pPhone']);
    $sEmail = mysqli_real_escape_string($con, $_POST['sEmail']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $caste = mysqli_real_escape_string($con, $_POST['caste']);
    $fLang = mysqli_real_escape_string($con, $_POST['fLang']);
    $sLang = mysqli_real_escape_string($con, $_POST['sLang']);
    $stream = mysqli_real_escape_string($con, $_POST['stream']);
    $cMode = mysqli_real_escape_string($con, $_POST['cMode']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);
    $aYear = mysqli_real_escape_string($con, $_POST['aYear']);

    // Construct your INSERT query
    $query = "INSERT INTO admission (`studentPic`, `sslcMarks`, `midtermMarks`, `name`, `dob`, `collage`, `class`, `board`, `pClassPer`, `parent`, `occupation`, `address`, `studentNum`, `parentNum`, `sEmail`, `religion`, `caste`, `fLang`, `sLang`, `stream`, `cMode`, `adddate`, `aYear`) VALUES 
            ('$uploadedFiles[studentPic]', '$uploadedFiles[sslcMarks]', '$uploadedFiles[midtermMarks]', '$name', '$dob', '$cName',  '$class', '$board' , '$pClassPer', '$parentName', '$parentOcp', '$address', '$sPhone', '$pPhone', '$sEmail', '$religion', '$caste'
            , '$fLang', '$sLang' , '$stream', '$cMode', '$add_date', '$aYear')";

    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Created Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    var_dump($_POST);
    exit();

}

//Admission Delete
if(isset($_POST['delete_admission'])){
    $student_id = mysqli_real_escape_string($con, $_POST['delete_admission']);

    $query = "DELETE FROM admission WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    exit();
}

// Admission Edit
if (isset($_POST['editAdmission'])) {
    // Extract POST data for non-file fields
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $cName = mysqli_real_escape_string($con, $_POST['cName']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $board = mysqli_real_escape_string($con, $_POST['board']);
    $pClassPer = mysqli_real_escape_string($con, $_POST['pClassPer']);
    $parentName = mysqli_real_escape_string($con, $_POST['parentName']);
    $parentOcp = mysqli_real_escape_string($con, $_POST['parentOcp']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $sPhone = mysqli_real_escape_string($con, $_POST['sPhone']);
    $pPhone = mysqli_real_escape_string($con, $_POST['pPhone']);
    $sEmail = mysqli_real_escape_string($con, $_POST['sEmail']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $caste = mysqli_real_escape_string($con, $_POST['caste']);
    $fLang = mysqli_real_escape_string($con, $_POST['fLang']);
    $sLang = mysqli_real_escape_string($con, $_POST['sLang']);
    $stream = mysqli_real_escape_string($con, $_POST['stream']);
    $cMode = mysqli_real_escape_string($con, $_POST['cMode']);
    $add_date = mysqli_real_escape_string($con, $_POST['add_date']);
    $aYear = mysqli_real_escape_string($con, $_POST['aYear']);

    // Initialize the update query
    $query = "UPDATE admission SET ";

    // Initialize an array to store fields that should not be updated
    $ignoreFields = array('sslcMarks', 'midtermMarks', 'studentPic');

    // Check if any file was uploaded without errors
    if (isset($_FILES['sslcMarks']) && $_FILES['sslcMarks']['error'] === UPLOAD_ERR_OK) {
        $sslcFile = $_FILES['sslcMarks']['tmp_name'];
        $sslcData = file_get_contents($sslcFile);
        $query .= "sslcMarks='" . mysqli_real_escape_string($con, $sslcData) . "', ";
        // Add sslcMarks to ignoreFields
        $ignoreFields = array_diff($ignoreFields, array('sslcMarks'));
    }

    if (isset($_FILES['midtermMarks']) && $_FILES['midtermMarks']['error'] === UPLOAD_ERR_OK) {
        $midtermFile = $_FILES['midtermMarks']['tmp_name'];
        $midtermData = file_get_contents($midtermFile);
        $query .= "midtermMarks='" . mysqli_real_escape_string($con, $midtermData) . "', ";
        // Add midtermMarks to ignoreFields
        $ignoreFields = array_diff($ignoreFields, array('midtermMarks'));
    }

    if (isset($_FILES['studentPic']) && $_FILES['studentPic']['error'] === UPLOAD_ERR_OK) {
        $studentPicFile = $_FILES['studentPic']['tmp_name'];
        $studentPicData = file_get_contents($studentPicFile);
        $query .= "studentPic='" . mysqli_real_escape_string($con, $studentPicData) . "', ";
        // Add studentPic to ignoreFields
        $ignoreFields = array_diff($ignoreFields, array('studentPic'));
    }

    // Append non-file fields to the query
    $query .= " name='$name', dob='$dob', collage='$cName', class='$class', board='$board', pClassPer='$pClassPer', parent='$parentName', occupation='$parentOcp',
    address='$address', studentNum='$sPhone', parentNum='$pPhone', sEmail='$sEmail', religion='$religion', caste='$caste', fLang='$fLang', sLang='$sLang', stream='$stream',
    cMode='$cMode', adddate='$add_date', aYear='$aYear' ";

    // Remove trailing comma and space
    $query = rtrim($query, ", ");

    // Append WHERE condition
    $query .= " WHERE id='$student_id'";

    // Exclude fields that should not be updated
    foreach ($ignoreFields as $field) {
        $query = str_replace("$field=", "$field", $query);
    }

    // Execute the update query
    $query_run = mysqli_query($con, $query);
    
    // Check if the query executed successfully
    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Update Record";
    }
    
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/admission/admission");
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /default-redirect-url");
    }
    exit();
}

//PUC add
if (isset($_POST['savePucStudent'])) {
    $marks = mysqli_real_escape_string($con, $_POST['studentStd']);
    $sschool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $sname = mysqli_real_escape_string($con, $_POST['studentName']);
    $sclass = mysqli_real_escape_string($con, $_POST['studentStd']);
    //$sboard = mysqli_real_escape_string($con, $_POST['studentBoard']);
    //$smedium = mysqli_real_escape_string($con, $_POST['sMedium']);
    $sgender = mysqli_real_escape_string($con, $_POST['studentGender']);
    $sparent = mysqli_real_escape_string($con, $_POST['studentParent']);
    $sparocp = mysqli_real_escape_string($con, $_POST['studentParOcu']);
    $sphone = mysqli_real_escape_string($con, $_POST['studentContact']);
    $stream = mysqli_real_escape_string($con, $_POST['studentStream']);
    $fLang = mysqli_real_escape_string($con, $_POST['fLang']);
    $sLang = mysqli_real_escape_string($con, $_POST['sLang']);

    $fMark = mysqli_real_escape_string($con, $_POST['fMark']);
    $sMark = mysqli_real_escape_string($con, $_POST['sMark']);
    $physics = mysqli_real_escape_string($con, $_POST['phyMark']);
    $chemistry = mysqli_real_escape_string($con, $_POST['cheMark']);
    $maths = mysqli_real_escape_string($con, $_POST['matMark']);
    $biology = mysqli_real_escape_string($con, $_POST['bioMark']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);

    
    // Check the value of marks
    switch ($marks) {
        case '1st PUC':
            $table = 'firstpuc';
            $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
            $percentage = ($total / 600) * 100;
            break;
        case '2nd PUC':
            $table = 'secondpuc';
            $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
            $percentage = ($total / 600) * 100;
            break;
        /*
        case 'finalMarks':
            $table = 'student_add_details3';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            break;*/
        default:
           // Handle unexpected marks value
           $_SESSION['error_message'] = "Invalid marks value";
           header("Location: /master/puc/student");
           exit(); // Terminate script execution
    }


    // Calculate result based on percentage

    if ($percentage >= 85) {
        $result = "Distinction";
    } elseif ($percentage >= 60) {
        $result = "First Class";
    } elseif ($percentage >= 50) {
        $result = "Second Class";
    } elseif ($percentage < 50) {
        $result = "Third Class";
    } else {
        $result = "Fail";
    }

    $query = "INSERT INTO $table (`sName`, `cName`, `stream`, `class`, `gender`, `parentName`, `parentOcp`, `studentNum`, `fLang`, `sLang`, `fMark`, `sMArk`, `physics`, `chemistry`, `maths`, `biology`, `total`, `percentage`, `result`, `add_date`) VALUES 
            ('$sname','$sschool','$stream','$sclass', '$sgender', '$sparent', '$sparocp', '$sphone', '$fLang', '$sLang', '$fMark', '$sMark', '$physics', '$chemistry', '$maths', '$biology', '$total', '$percentage', '$result', '$sadd_date')";

    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Created Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/sidebar");
    }
    var_dump($_POST);
    exit();

}

//Puc Delete
if(isset($_POST['deletePucStudent'])){
    $student_id = mysqli_real_escape_string($con, $_POST['deletePucStudent']);
    $studentPage = mysqli_real_escape_string($con, $_POST['deletePage']);

    switch ($studentPage) {
        case '1':
            $table = 'firstpuc';
            break;
        case '2':
            $table = 'secondpuc';
            break;
        default:
            // Handle unexpected page number
            $_SESSION['error_message'] = "Invalid page number";
            header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
            exit(); // Terminate script execution
    }

    $query = "DELETE FROM $table WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['success_message'] = "Record Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete Record";
    }

    // Redirect to the current page or default URL
    $redirect_url = isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url';
    header("Location: $redirect_url");
    exit();
}

//Edit PUC Student
if (isset($_POST['updatePucStudent'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $marks = mysqli_real_escape_string($con, $_POST['studentMarksFor']);
    $sschool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $sname = mysqli_real_escape_string($con, $_POST['studentName']);
    $sclass = mysqli_real_escape_string($con, $_POST['studentStd']);
    //$sboard = mysqli_real_escape_string($con, $_POST['studentBoard']);
    //$smedium = mysqli_real_escape_string($con, $_POST['sMedium']);
    $sgender = mysqli_real_escape_string($con, $_POST['studentGender']);
    $sparent = mysqli_real_escape_string($con, $_POST['studentParent']);
    $sparocp = mysqli_real_escape_string($con, $_POST['studentParOcu']);
    $sphone = mysqli_real_escape_string($con, $_POST['studentContact']);
    $stream = mysqli_real_escape_string($con, $_POST['studentStream']);
    $fLang = mysqli_real_escape_string($con, $_POST['fLang']);
    $sLang = mysqli_real_escape_string($con, $_POST['sLang']);

    $fMark = mysqli_real_escape_string($con, $_POST['fMark']);
    $sMark = mysqli_real_escape_string($con, $_POST['sMark']);
    $physics = mysqli_real_escape_string($con, $_POST['phyMark']);
    $chemistry = mysqli_real_escape_string($con, $_POST['cheMark']);
    $maths = mysqli_real_escape_string($con, $_POST['matMark']);
    $biology = mysqli_real_escape_string($con, $_POST['bioMark']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);

    
    // Check the value of marks
    switch ($marks) {
        case '1':
            $table = 'firstpuc';
            $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
            $percentage = ($total / 600) * 100;
            break;
        case '2':
            $table = 'secondpuc';
            $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
            $percentage = ($total / 600) * 100;
            break;
        /*
        case 'finalMarks':
            $table = 'student_add_details3';
            $total = $subkan + $subeng + $subhin + $submat + $subsci + $subsoc;
            $percentage = ($total / 625) * 100;
            break;*/
        default:
           // Handle unexpected marks value
           $_SESSION['error_message'] = "Invalid marks value";
           header("Location: /master/puc/student");
           exit(); // Terminate script execution
    }


    // Calculate result based on percentage
    if ($percentage >= 85) {
        $result = "Distinction";
    } elseif ($percentage >= 60) {
        $result = "First Class";
    } elseif ($percentage >= 50) {
        $result = "Second Class";
    } elseif ($percentage < 50) {
        $result = "Third Class";
    } else {
        $result = "Fail";
    }

    $query = "UPDATE $table SET `sName` = '$sname', `cName` = '$sschool', `stream` = '$stream', `class` = '$sclass', `gender` = '$sgender',
     `parentName` = '$sparent', `parentOcp` = '$sparocp', `studentNum` = '$sphone', `fLang` = '$fLang', `sLang` = '$sLang', 
     `fMark` = '$fMark', `sMark` = '$sMark', `physics` = '$physics', `chemistry` = '$chemistry', `maths` = ' $maths', `biology` = '$biology', 
     `total` = '$total', `percentage` = '$percentage', `result` = '$result', `add_date` = '$sadd_date' WHERE `$table`.`id`='$student_id'";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['success_message'] = "Record Updated Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Create";
    }
    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: /master/puc/student");
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: /master/puc/student");
    }
    
    exit();

}

//Import PUC Validation Function
function validatePucData($name, $studentSchool, $stream, $studentClass, $gender, $parent, $parentocp, $phoneNum, $fLang, $sLang, $fMark, $sMark, $physics, $chemistry, $maths, $biology, $importValue)
{
    // Name validation
    if (strlen($name) > 30 || !preg_match('/^[a-zA-Z0-9.]+$/', $name)) {
        $_SESSION['error_message'] .= "Error: Name should not exceed 30 characters and should not contain special characters.\n";
    }

    // School validation
    if (strlen($studentSchool) > 30 || !preg_match('/^[a-zA-Z0-9 ]+$/', $studentSchool)) {
        $_SESSION['error_message'] .= "Error: Collage Name should not exceed 30 characters and should not contain special characters.\n";
    }

    // Stream validation
    if (!in_array($stream, ['PCME', 'PCMC', 'PCMB']) || strlen($stream) > 30) {
        $_SESSION['error_message'] .= "Error: Stream should be PCME, PCMC, or PCMB and should not exceed 30 characters.\n";
    }


    // Class validation
    if (!in_array($studentClass, ['1st PUC', '2nd PUC']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $studentClass)) {
        $_SESSION['error_message'] .= "Error: Class should be either 1st PUC or 2nd PUC and should not contain special characters.\n";
    }

    /*
    // Sboard validation
    if (!in_array($sboard, ['State', 'CBSE']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $sboard)) {
        $_SESSION['error_message'] .= "Error: Sboard should be either State or CBSE and should not contain special characters.\n";
    }*/

    // Gender validation
    if (!in_array($gender, ['Male', 'Female']) || !preg_match('/^[a-zA-Z0-9 ]+$/', $gender)) {
        $_SESSION['error_message'] .= "Error: Gender should be Male or Female and should not contain special characters.\n";
    }

    // Parent validation
    if (strlen($parent) > 30 || !preg_match('/^[a-zA-Z0-9 ]+$/', $parent)) {
        $_SESSION['error_message'] .= "Error: Parent name should not exceed 30 characters and should not contain special characters.\n";
    }

    // Parent occupation validation
    if (strlen($parentocp) > 20 || !preg_match('/^[a-zA-Z0-9 ]+$/', $parentocp)) {
        $_SESSION['error_message'] .= "Error: Parent occupation should not exceed 20 characters and should not contain special characters.\n";
    }

    // Ensure $phoneNum starts with '+91 ' by default
    if (!preg_match('/^\+91 \d{10}$/', $phoneNum)) {
        $_SESSION['error_message'] .= "Error: Phone number should contain only 10 digits.\n";
    }
    
    // 1st Lang validation
    if (!in_array($fLang, ['K', 'H', 'E', 'S']) || strlen($fLang) > 30) {
        $_SESSION['error_message'] .= "Error: 1st Language should be 'Kannada', 'Hindi', 'English', 'Sanskrit' and should not exceed 30 characters.\n";
    }

    // 2nd Lang validation
    if (!in_array($sLang, ['K', 'H', 'E', 'S']) || strlen($sLang) > 30) {
        $_SESSION['error_message'] .= "Error: 2nd Language should be KANNADA, ENGLISH, HINDI, SANSKRIT and should not exceed 30 characters.\n";
    }
    



        if (!ctype_digit($fMark) || $fMark > 100) {
            $_SESSION['error_message'] .= "Error: Kannada score should be a number and should not exceed 100.\n";
        }

        if (!ctype_digit($sMark) || $sMark > 100) {
            $_SESSION['error_message'] .= "Error: English score should be a number and should not exceed 100.\n";
        }

        if (!ctype_digit($physics) || $physics > 100) {
            $_SESSION['error_message'] .= "Error: Hindi score should be a number and should not exceed 100.\n";
        }

        if (!ctype_digit($chemistry) || $chemistry > 100) {
            $_SESSION['error_message'] .= "Error: Math score should be a number and should not exceed 100.\n";
        }

        if (!ctype_digit($maths) || $maths > 100) {
            $_SESSION['error_message'] .= "Error: Science score should be a number and should not exceed 100.\n";
        }

        if (!ctype_digit($biology) || $biology > 100) {
            $_SESSION['error_message'] .= "Error: Science score should be a number and should not exceed 100.\n";
        }

        // 2nd Lang validation
        if (!in_array($importValue, ['1', '2'])) {
            $_SESSION['error_message'] .= "Error: Something went wrong.\n";
        }
    
}
//Import
if(isset($_POST['importPucStudent'])){
    $studentSchool = mysqli_real_escape_string($con, $_POST['studentSchool']);
    $studentClass = mysqli_real_escape_string($con, $_POST['studentStd']);
    //$schoolid = mysqli_real_escape_string($con, $_POST['schoolId']);
    $sadd_date = mysqli_real_escape_string($con, $_POST['studentAdd_date']);
    $importValue = mysqli_real_escape_string($con, $_POST['importValue']);
    //$smedium = mysqli_real_escape_string($con, $_POST['sMediumImport']);
    $current_url = mysqli_real_escape_string($con, $_POST['current_url']);
    /*
    $maxKan = mysqli_real_escape_string($con, $_POST['maxKan']);
    $maxEng = mysqli_real_escape_string($con, $_POST['maxEng']);
    $maxHin = mysqli_real_escape_string($con, $_POST['maxHin']);
    $maxMat = mysqli_real_escape_string($con, $_POST['maxMat']);
    $maxSci = mysqli_real_escape_string($con, $_POST['maxSci']);
    $maxSoc = mysqli_real_escape_string($con, $_POST['maxSoc']);*/
    
    // Allowed mime types for CSV files
    $csvMime = array(
        'text/csv',
        'application/csv',
        'application/x-csv',
        'text/x-csv',
        'text/plain',
        'text/comma-separated-values'
    );

    
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name'])) {
        // Check if the file type is not in the list of allowed CSV MIME types
        if (!in_array($_FILES['file']['type'], $csvMime)) {
            $_SESSION['error_message'] = "Error: Only CSV files are allowed.";
            header("Location: " . $_POST['current_url']);
            exit();
        }

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            $lineNumber = 1; // Initialize line number
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $name   = $line[0];
                $gender = ucfirst(strtolower($line[1]));
                $parent = $line[2];
                $parentocp = $line[3];
                $phoneNum = '+91 ' . $line[4];
                $stream = strtoupper($line[5]); // Capitalize the entire stream
                $fLang = strtoupper(substr($line[6], 0, 1)); // Extract first character and capitalize
                $sLang = strtoupper(substr($line[7], 0, 1)); // Extract first character and capitalize
                $fMark = $line[8];
                $sMark = $line[9];
                $physics = $line[10];
                $chemistry = $line[11];
                $maths = $line[12];
                $biology = $line[13];

                // Validate data for each row
                validatePucData($name, $studentSchool, $stream, $studentClass, $gender, $parent, $parentocp, $phoneNum, $fLang, $sLang, $fMark, $sMark, $physics, $chemistry, $maths, $biology, $importValue);

                // Check if there are any error messages
                if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
                    $_SESSION['error_message'] .= "Error occurred in line $lineNumber.\n"; // Append line number to error message
                    fclose($csvFile);
                    header("Location: " . $_POST['current_url']); // Redirect to the current page
                    exit();
                }
                
                $lineNumber++; // Increment line number

                switch ($studentClass) {
                    case '1st PUC':
                        $table = 'firstpuc';
                        $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
                        $percentage = ($total / 600) * 100;
                        break;
                    case '2nd PUC':
                        $table = 'secondpuc';
                        $total = $fMark + $sMark + $physics + $chemistry + $maths + $biology;
                        $percentage = ($total / 600) * 100;
                        break;
                    default:
                        // Handle unexpected page number
                        $_SESSION['error_message'] = "Invalid page number";
                        header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
                        exit(); // Terminate script execution
                }

                // Calculate result based on percentage
                if ($percentage >= 85) {
                    $result = "Distinction";
                } elseif ($percentage >= 60) {
                    $result = "First Class";
                } elseif ($percentage >= 50) {
                    $result = "Second Class";
                } elseif ($percentage < 50) {
                    $result = "Third Class";
                } else {
                    $result = "Fail";
                }
                /*
                $query = "INSERT INTO $table (`sName`, `cName`, `stream`, `class`, `gender`, `parentName`, `parentOcp`, `studentNum`, `fLang`, `sLang`, `fMark`, `sMArk`, 
                `physics`, `chemistry`, `maths`, `biology`, `total`, `percentage`, `result`, `add_date`) VALUES 
                ('".$name."','$studentSchool','".$stream."','".$studentClass."', '".$gender."', '".$parent."', '".$parentocp."', '".$phoneNum."', '".$fLang."', '".$sLang."', '".$fMark."', '".$sMark."',
                '".$physics."', '".$chemistry."', '".$maths."', '".$biology."', '$total', '$percentage', '$result', '$sadd_date')";

                $query_run = mysqli_query($con, $query);
                if ($query_run) {
                    $_SESSION['success_message'] = "Record Created Successfully";
                } else {
                    $_SESSION['error_message'] = "Failed to Create";
                }*/

                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT id FROM $table WHERE sName = '".$name."' AND studentNum = '".$phoneNum."' AND class = '$studentClass' AND stream = '".$stream."' AND cName = '$studentSchool' ";
                $prevResult = $con->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Retrieve the existing schoolId and studentMedium from the database for the given student_id
                    $fetch_query = "SELECT id FROM $table WHERE sName = '".$name."' AND studentNum = '".$phoneNum."' AND class = '$studentClass' AND stream = '".$stream."' AND cName = '$studentSchool' ";
                    $fetch_result = mysqli_query($con, $fetch_query);

                        if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
                            $row = mysqli_fetch_assoc($fetch_result);
                            $existing_school_id = $row['id'];

                        } else {
                            echo "Error fetching existing student ID: " . mysqli_error($con);
                        }

                        // Update member data in the database
                        $con->query("UPDATE $table SET `sName` = '".$name."', `cName` = '$studentSchool', `stream` = '".$stream."', `class` = '".$studentClass."', `gender` = '".$gender."',
                        `parentName` = '".$parent."', `parentOcp` = '".$parentocp."', `studentNum` = '".$phoneNum."', `fLang` = '".$fLang."', `sLang` = '".$sLang."', 
                        `fMark` = '".$fMark."', `sMark` = '".$sMark."', `physics` = '".$physics."', `chemistry` = '".$chemistry."', `maths` = '".$maths."', `biology` = '".$biology."', 
                        `total` = '$total', `percentage` = '$percentage', `result` = '$result', `add_date` = '$sadd_date' WHERE `$table`.`id`='$existing_school_id'");
                            
                        $_SESSION['success_message'] = "Successfully Updated and Insterted " . ($lineNumber - 1) . " Rows \n";

                } else if($prevResult->num_rows == 0){
                // Insert member data in the database

                    $con->query("INSERT INTO $table (`sName`, `cName`, `stream`, `class`, `gender`, `parentName`, `parentOcp`, `studentNum`, `fLang`, `sLang`, `fMark`, `sMArk`, 
                    `physics`, `chemistry`, `maths`, `biology`, `total`, `percentage`, `result`, `add_date`) VALUES 
                    ('".$name."','$studentSchool','".$stream."','".$studentClass."', '".$gender."', '".$parent."', '".$parentocp."', '".$phoneNum."', '".$fLang."', '".$sLang."', '".$fMark."', '".$sMark."',
                    '".$physics."', '".$chemistry."', '".$maths."', '".$biology."', '$total', '$percentage', '$result', '$sadd_date')");
        
                    $_SESSION['success_message'] = "Record Updated and Inserted Successfully till" . ($lineNumber - 1) . "row \n";
                } else {
                    $_SESSION['error_message'] = "Failed to Create";
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
                    
            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
            
        }

    } else {
        $_SESSION['error_message'] = "Error: No file uploaded.";
        header("Location: " . $_POST['current_url']);
        exit();
    }

    // Redirect to the current page
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    exit();
}

var_dump($_POST);
// Export PUC
if (isset($_POST['exportPucStudent'])) {
    try {
        // Prevent SQL injection
        $exportPage = mysqli_real_escape_string($con, $_POST['exportPage']);
        $exportSchool = mysqli_real_escape_string($con, $_POST['exportSchool']);

        switch ($exportPage) {
            case '1':
                $table = 'firstpuc';
                break;
            case '2':
                $table = 'secondpuc';
                break;
            default:
                throw new Exception("Invalid page number.");
        }

        // SQL query to select data from table
        $sql = "SELECT * FROM $table";
        // Append WHERE clause if $exportSchool is not empty
        if (!empty($exportSchool)) {
            $sql .= " WHERE cName = ?";
        }
        $stmt = $con->prepare($sql);
        // Bind parameter if $exportSchool is not empty
        if (!empty($exportSchool)) {
            $stmt->bind_param("s", $exportSchool);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Set appropriate headers for CSV download
            ob_clean(); // Clear output buffer
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');
            // Output CSV data directly to browser
            $output = fopen('php://output', 'w');
            // Write headers to CSV
            $headers = array();
            $row = $result->fetch_assoc();
            foreach ($row as $key => $value) {
                $headers[] = $key;
            }
            fputcsv($output, $headers);
            // Write data to CSV
            do {
                fputcsv($output, $row);
            } while ($row = $result->fetch_assoc());
            // Close file handle
            fclose($output);
            // Stop further script execution
            exit();
        } else {
            // No records found
            throw new Exception("No records found for selected school.");
        }

        // Success message
        $_SESSION['success_message'] = "Data exported successfully.";
    } catch (Exception $e) {
        // Error message
        $_SESSION['error_message'] = $e->getMessage();
    } finally {
        // Close statement
        $stmt->close();
        // Close MySQL connection
        $con->close();
        // Redirect to the current page or default location
        redirectToDefaultPuc();
    }
}

// Export Redirect
function redirectToDefaultPuc() {
    if (isset($_POST['current_url'])) {
        header("Location: " . $_POST['current_url']);
    } else {
        // If the current URL is not available, redirect to a default location
        header("Location: " . $_POST['current_url']);
    }
    // Ensure script execution stops after redirection
    exit();
}

// PUC Student Bulk Delete
if(isset($_POST['bulkDelete_Puc'])){
    $bulkDeleteData = mysqli_real_escape_string($con, $_POST['bulkDeleteData']);
    $bulkDeletePage = mysqli_real_escape_string($con, $_POST['bulkDeletePage']);

    switch ($bulkDeletePage) {
        case '1':
            $table = 'firstpuc';
            break;
        case '2':
            $table = 'secondpuc';
            break;
        default:
            // Handle unexpected page number
            $_SESSION['error_message'] = "Invalid page number";
            header("Location: " . (isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url'));
            exit(); // Terminate script execution
    }
    $deletedCount = 0; // Variable to store the count of deleted records

    foreach (explode(',', $bulkDeleteData) as $singleID) {
        $query = "DELETE FROM $table WHERE id = '$singleID' ";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $deletedCount++; // Increment count for each successful deletion
        }
    }

    if ($deletedCount > 0) {
        $_SESSION['success_message'] = "$deletedCount record(s) Deleted Successfully";
    } else {
        $_SESSION['error_message'] = "Failed to Delete Record";
    }

    // Redirect to the current page or default URL
    $redirect_url = isset($_POST['current_url']) ? $_POST['current_url'] : '/default-redirect-url';
    header("Location: $redirect_url");
    exit();
}
?>
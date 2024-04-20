<?php
// nameValidation.php
require '../include/dbconnection.php';

// Log the contents of the $_POST superglobal array
error_log(print_r($_POST, true));
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data from the request body
    $postData = json_decode(file_get_contents("php://input"));

    // Check if the JSON data contains the required fields
    if (isset($postData->marks, $postData->sschool, $postData->sname ,$postData->sschoolid)) {
        // Sanitize input values to prevent SQL injection
        $marks = mysqli_real_escape_string($con, $postData->marks);
        $sschool = mysqli_real_escape_string($con, $postData->sschool);
        $sname = mysqli_real_escape_string($con, $postData->sname);
        $sschoolid = mysqli_real_escape_string($con, $postData->sschoolid);

        // Check the value of marks
        switch ($marks) {
            case 'semiMarks':
                $table = 'student_add_details1';
                break;
            case 'midMarks':
                $table = 'student_add_details2';
                break;
            case 'finalMarks':
                $table = 'student_add_details3';
                break;
            default:
                // Error handling for invalid marks value
                $error = ['error' => 'Invalid marks value'];
                header('Content-Type: application/json');
                echo json_encode($error);
                exit(); // Terminate script execution
        }

        // Perform a database query to check if sname and sschool already exist in the specified table
        $query = "SELECT COUNT(*) AS count FROM $table WHERE studentName = '$sname' AND schoolName = '$sschool'  AND schoolId='$sschoolid'";
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the count of rows with the given sname and sschool
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];

            // Prepare the response data
            $response = ['exists' => ($count > 0)];

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Error handling if the query fails
            $error = ['error' => 'Database query failed'];
            header('Content-Type: application/json');
            echo json_encode($error);
        }
    } else {
        // Error handling if any required field is missing in the request
        $error = ['error' => 'One or more required fields are missing'];
        header('Content-Type: application/json');
        echo json_encode($error);
    }
} else {
    // Error handling if the request method is not POST
    $error = ['error' => 'Invalid request method'];
    header('Content-Type: application/json');
    echo json_encode($error);
}
?>

<?php
// nameValidation.php
require '../include/dbconnection.php';

// Assuming you have a database connection established already

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data from the request body
    $postData = json_decode(file_get_contents("php://input"));

    // Check if the JSON data contains the 'cname' field
    if (isset($postData->cname)) {
        // Sanitize the cname value to prevent SQL injection
        $cname = mysqli_real_escape_string($con, $postData->cname);

        // Perform a database query to check for duplicate cname
        $query = "SELECT COUNT(*) AS count FROM cluster_add WHERE cname = '$cname'";
        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch the count of rows with the given cname
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
        // Error handling if 'cname' field is missing in the request
        $error = ['error' => 'cname field is missing'];
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

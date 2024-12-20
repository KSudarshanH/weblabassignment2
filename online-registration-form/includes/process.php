<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'registration_db');

// Function to sanitize input data
function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Initialize response array
$response = array(
  'status' => 'error',
  'message' => '',
  'data' => null
);

try {
  // Log request method
  error_log("Request Method: " . $_SERVER["REQUEST_METHOD"]);

  // Log POST data
  error_log("POST data: " . print_r($_POST, true));

  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $formData = array(
      'fullName' => sanitize_input($_POST['fullName'] ?? ''),
      'email' => sanitize_input($_POST['email'] ?? ''),
      'phone' => sanitize_input($_POST['phone'] ?? ''),
      'dob' => sanitize_input($_POST['dob'] ?? ''),
      'gender' => sanitize_input($_POST['gender'] ?? ''),
      'address' => sanitize_input($_POST['address'] ?? ''),
      'education' => sanitize_input($_POST['education'] ?? '')
    );

    // Log sanitized data
    error_log("Sanitized data: " . print_r($formData, true));

    // Database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
      throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    // For testing, just return the data without database insertion
    $response['status'] = 'success';
    $response['message'] = 'Data received successfully';
    $response['data'] = $formData;
  } else {
    throw new Exception("Invalid request method");
  }
} catch (Exception $e) {
  error_log("Error in process.php: " . $e->getMessage());
  $response['message'] = $e->getMessage();
}

// Log response before sending
error_log("Response: " . print_r($response, true));

// Send JSON response
echo json_encode($response);

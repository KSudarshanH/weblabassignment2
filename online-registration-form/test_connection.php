<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'registration_db');

try {
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Database connection successful!";

  // Test if table exists
  $result = $conn->query("SHOW TABLES LIKE 'registrations'");
  if ($result->num_rows > 0) {
    echo "<br>Table 'registrations' exists!";
  } else {
    echo "<br>Table 'registrations' does not exist!";
  }
} catch (Exception $e) {
  die("Error: " . $e->getMessage());
}

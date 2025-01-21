<?php
// Define database connection constants
define('HOSTNAME', "localhost");
define('USERNAME', "root");
define('PASSWORD', "");
define("DATABASE", "career_bank_it");

// Create a connection to the database
$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
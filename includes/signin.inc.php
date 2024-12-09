<?php
/**
 * Signin form handler
 * This script processes the signin form submission:
 * - Validates that form was submitted properly
 * - Gets username/email and password from POST data
 * - Includes required database and function files
 * - Validates input fields are not empty
 * - Attempts to log in user by checking credentials
 * - Redirects with error message if validation fails
 * - Redirects to home page on successful login
 */

if (isset($_POST['signin'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];

    include("./db_con.php");
    include("./functions.inc.php");

    if (emptyInputSignin($userName, $password) !== false) {
        header("location:../signin.php?error=fill all fields");
        exit();
    }

    loginUser($conn, $userName, $password);

} else {
    header("location:../signin.php?error=something went wrong");
    exit();
}


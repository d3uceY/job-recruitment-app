<?php
/**
 * Helper functions for user authentication and validation
 * Contains functions to:
 * - Validate signup/signin form inputs
 * - Check username/email availability
 * - Handle user registration and login
 * - Perform password validation and matching
 */

// Check if signup form fields are empty
function emptyInputSignup($userName, $email, $password, $passwordRepeat) {
    $result = false;
    if (empty($userName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}



// Validate username contains only letters and numbers 
function invalidUsername($userName) {
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}



// Validate email format
function invalidEmail($email) {
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}



// Check if passwords match
function passwordMatch($password, $passwordRepeat) {
    return $password === $passwordRepeat;
}



// Check if username or email already exists in database
function userNameExists($conn, $userName, $email) {
    $query = "SELECT * FROM users WHERE user_name =? OR user_email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../signup.php?error=something went wrong");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}



// Create new user in database
function createUser($conn, $userName, $email, $password) {
    $query = "INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../signin.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $userName, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:../signin.php?success=you have signed up successfully");
    exit();
}



// Check if signin form fields are empty
function emptyInputSignin($userName, $password) {
    $result = false;
    if (empty($userName) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    
    return $result;
}



// Login user in the database
// This handles signin and checks if user exists in database
function loginUser($conn, $userName, $password) {
    $userNameExists = userNameExists($conn, $userName, $userName);

    if (!$userNameExists) {
        header("location:../signin.php?error=wrong login");
        exit();
    }

    # $userNameExists can either return $result(boolean) or $row which is an associative array,
    # and with that, we can target the hashed password
    $passwordHashed = $userNameExists["user_password"];

    // Checks if hashed password in database is the same with user password input
    // Returns a boolean
    $checkPassword = password_verify($password, $passwordHashed);

    // If password is wrong
    if (!$checkPassword) {
        header("location:../signin.php?error=wrong password");
        exit();
    } else if ($checkPassword) {
        // Start session
        session_start();
        // Set session variables
        $_SESSION['userid'] = $userNameExists['id'];
        $_SESSION['username'] = $userNameExists['user_name'];
        // Redirect to home page
        header("location:../index.php");
        exit();
    }
}
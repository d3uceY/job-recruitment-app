<?php
// Include database connection
include("./db_con.php");


if (isset($_POST["sign_up"])) {
    // Get form data
    $userName = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password_repeat"];

    // Include helper functions
    include("./functions.inc.php");

    // Check if any inputs are empty
    if (emptyInputSignup($userName, $email, $password, $passwordRepeat) !== false) {
        header("location:../signup.php?error=fill all fields");
        exit();
    }

    // Validate username format
    if (invalidUsername($userName) !== false) {
        header("location:../signup.php?error=use a valid username");
        exit();
    }

    // Validate email format
    if (invalidEmail($email) !== false) {
        header("location:../signup.php?error=use a valid email");
        exit();
    }

    // Check if passwords match
    if (!passwordMatch($password, $passwordRepeat)) {
        header("location:../signup.php?error=password doesn't match");
        exit();
    }

    // Check if username/email already exists
    if (userNameExists($conn, $userName, $email) !== false) {
        header("location:../signup.php?error=username exists");
        exit();
    }

    // Create new user if all validation passes
    createUser($conn, $userName, $email, $password);

} else {
    // Redirect if form not submitted properly
    header("location:../signup.php?error=sign up with valid details");
}
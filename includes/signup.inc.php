<?php
include("./db_con.php");


if (isset($_POST["sign_up"])) {
    $userName = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password_repeat"];

    include("./functions.inc.php");

    if (emptyInputSignup($userName, $email, $password, $passwordRepeat) !== false) {
        header("location:../signup.php?error=empty input");
        exit();
    }

    if (invalidUsername($userName) !== false) {
        header("location:../signup.php?error=Invalid username");
        exit();
    }


    if (invalidEmail($email) !== false) {
        header("location:../signup.php?error=Invalid Email");
        exit();
    }


    if (passwordMatch($password, $passwordRepeat) !== false) {
        header("location:../signup.php?error=password doesn't match");
        exit();
    }

    if (userNameExists($conn, $userName, $email) !== false) {
        header("location:../signup.php?error=username exists");
        exit();
    }


    createUser($conn, $userName, $email, $password);

} else {
    header("location:../signup.php?error=sign up with valid details");
}
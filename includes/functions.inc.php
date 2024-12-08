<?php

function emptyInputSignup($userName, $email, $password, $passwordRepeat)
{
    $result = false;
    if (empty($userName) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}


function invalidUsername($userName)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}



function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}


function passwordMatch($password, $passwordRepeat)
{
    $result = false;
    if ($password !== $passwordRepeat) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function userNameExists($conn, $userName, $email)
{
    // first colon to close query, second colon to close php
    $query = "SELECT * FROM users WHERE user_name =? OR user_email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location:../signup.php?error=stmtfailed");
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


function createUser($conn, $userName, $email, $password)
{
    // first colon to close query, second colon to close php
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

    header("location:../signup.php?error=none");
    exit();
}
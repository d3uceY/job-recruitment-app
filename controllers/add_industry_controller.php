<?php
include '../includes/db_con.php';

if (isset($_POST['add_industry'])) {
    $name = $_POST['name'];

    $query = "INSERT INTO industry_category (category) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $name);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../industry.php?success=Industry category added successfully");
    } else {
        header("Location: ../industry.php?error=Failed to add industry category");
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: ../industry.php");
}
?>
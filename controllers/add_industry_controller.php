<?php
// This controller handles adding new industry categories to the database
// It receives industry name via POST, validates it, and inserts into industry_category table
// Redirects back to industry.php with success/error message

include '../includes/db_con.php';

if (isset($_POST['add_industry'])) {
    $name = $_POST['name'];

    if (empty($name) || trim($name) == '') {
        header('Location: ../industry.php?error=type in a valid industry name');
        exit();
    } else {
        $query = "INSERT INTO industry_category (category) VALUES (?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param("s", $name);
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            header("Location: ../industry.php?success=Industry category added successfully");
        } else {
            header("Location: ../industry.php?error=Failed to add industry category");
        }

        $stmt->close();
    }
} else {
    header("Location: ../industry.php");
}
?>
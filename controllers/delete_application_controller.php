<?php
// DB connection
include '../includes/db_con.php';

// Check ID exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $query = "DELETE FROM job_applications WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Handle result
    if ($stmt->affected_rows > 0) {
        header('Location: ../job_applications.php?success=Application deleted successfully');
    } else {
        header('Location: ../job_applications.php?error=something went wrong');
    }
} else {
    header('Location: ../job_applications.php?error=something went wrong');
}

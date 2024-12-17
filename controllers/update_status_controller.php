<?php
// Required files
include '../includes/db_con.php';
 
// Check ID exists
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    echo $status;
    // Update status
    $query = "UPDATE job_applications SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    // Handle result
    if ($stmt->affected_rows > 0) {
        header('Location: ../manage_job_applications.php?success=Status updated successfully');
    } else {
        header('Location: ../manage_job_applications.php?error=something went wrong');
    }
} else {
    header('Location: ../manage_job_applications.php?error=something went wrong');
}

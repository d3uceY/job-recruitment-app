<?php
include '../includes/db_con.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "DELETE FROM job_openings WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("location: ../view_jobs.php?success=Job deleted successfully");
        exit();
    } else {
        header("location: ../view_jobs.php?error=Failed to delete job");
        exit();
    }
}
?>
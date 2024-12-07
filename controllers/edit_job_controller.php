<?php
// Controller to handle updating job posting details in the database
include("../includes/db_con.php");

if (isset($_POST['edit_job'])) {
    // Get form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $summary = $_POST['summary'];
    $responsibility = $_POST['responsibilities'];
    $requirements = $_POST['requirements'];

    // Prepare and execute update query
    $query = "UPDATE job_openings SET job_title=?, job_location=?, duration=?, job_summary=?, job_responsibility=?, job_requirements=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sissssi", $title, $location, $duration, $summary, $responsibility, $requirements, $id);
    $stmt->execute();

    // Check if update was successful
    if ($stmt->affected_rows > 0) {
        header("location: ../view_jobs.php?success=Job updated successfully");
        exit();
    } else {
        header("location: ../view_jobs.php?error=Failed to update job");
        exit();
    }
}
?>
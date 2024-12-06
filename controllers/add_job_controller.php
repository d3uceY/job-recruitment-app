<?php
/*
 * This file handles adding new job postings to the database
 * It receives POST data from the add-jobs.php form containing:
 * - Job title
 * - Location ID
 * - Duration date
 * - Job summary (from Quill editor)
 * - Job responsibilities (from Quill editor) 
 * - Job requirements (from Quill editor)
 * Validates that all required fields are not empty
 * On success, inserts the job posting into the database and redirects with success message
 * On failure, redirects back to add-jobs.php with appropriate error message
 */

include '../includes/db_con.php';

if (isset($_POST['submit'])) {
    // Get form data
    $title = $_POST['title'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $summary = $_POST['summary'];
    $responsibilities = $_POST['responsibilities'];
    $requirements = $_POST['requirements'];

    // Validate required fields
    if (empty($title) || trim($title) == '') {
        header('location:../add-jobs.php?error=Title is required');
        exit();
    } else if (empty($location) || trim($location) == '') {
        header('location:../add-jobs.php?error=Location is required');
        exit();
    } else if (empty($duration) || trim($duration) == '') {
        header('location:../add-jobs.php?error=Duration is required');
        exit();
    } else if (empty($summary) || trim($summary) == '') {
        header('location:../add-jobs.php?error=Summary is required');
        exit();
    } else if (empty($responsibilities) || trim($responsibilities) == '') {
        header('location:../add-jobs.php?error=Responsibilities is required');
        exit();
    } else if (empty($requirements) || trim($requirements) == '') {
        header('location:../add-jobs.php?error=Requirements is required');
        exit();
    } else {
        // Insert job into database
        $query = "INSERT INTO job_openings (job_title, job_location, duration, job_summary, job_responsibility, job_requirements) 
                 VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $title, $location, $duration, $summary, $responsibilities, $requirements);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header('location:../add-jobs.php?success=Job added successfully');
            exit();
        } else {
            header('location:../add-jobs.php?error=Failed to add job' . mysqli_error($conn));
            exit();
        }
    }
}
?>
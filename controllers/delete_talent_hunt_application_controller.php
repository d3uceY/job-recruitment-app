<?php
// DB connection
include '../includes/db_con.php';

// Check ID exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    // First get the file paths before deleting the record
    $fileDeletequery = "SELECT resume_path, cover_letter_path FROM talents WHERE id = ?";
    $stmt = $conn->prepare($fileDeletequery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $application = $result->fetch_assoc();

    // Delete the files if they exist

    // Delete resume file
    if ($application['resume_path']) {
        $resumePath = "../uploads/resumes/" . $application['resume_path'];
        if (file_exists($resumePath)) {
            unlink($resumePath);
        }
    }

    // Delete cover letter file
    if ($application['cover_letter_path']) {
        $coverLetterPath = "../uploads/cover-letter/" . $application['cover_letter_path'];
        if (file_exists($coverLetterPath)) {
            unlink($coverLetterPath);
        }
    }


    // Delete query
    $query = "DELETE FROM talents WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Handle result
    if ($stmt->affected_rows > 0) {
        header('Location: ../manage_talent_hunt_application.php?success=Application deleted successfully');
    } else {
        header('Location: ../manage_talent_hunt_application.php?error=something went wrong');
    }
} else {
    header('Location: ../manage_talent_hunt_application.php?error=something went wrong');
}

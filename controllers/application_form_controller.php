<?php
include("../includes/db_con.php");

// Debug: Check if form is submitted
if (!isset($_POST['submit'])) {
    die("Form not submitted properly");
}

// Debug: Check file upload
var_dump($_FILES);

// Debug: Check POST data
var_dump($_POST);

if (isset($_POST['submit'])) {
    // Handle file upload
    $uploadDir = '../uploads/resumes/';
    $resumePath = '';

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        // Generate unique filename
        $fileExtension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('resume_') . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;

        // Check file type
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!in_array($_FILES['resume']['type'], $allowedTypes)) {
            header('location:../career.php?status=error&message=' . urlencode('Invalid file type. Only PDF and DOC files are allowed.'));
            exit();
        }

        // Check file size (2MB max)
        if ($_FILES['resume']['size'] > 2 * 1024 * 1024) {
            header('location:../career.php?status=error&message=' . urlencode('File is too large. Maximum size is 2MB.'));
            exit();
        }

        if (move_uploaded_file($_FILES['resume']['tmp_name'], $targetPath)) {
            $resumePath = $fileName;
        } else {
            header('location:../career.php?status=error&message=' . urlencode('Failed to upload file.'));
            exit();
        }
    }

    // Get form data
    $job_id = $_POST['job_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $education = $_POST['education'];
    $industry = $_POST['industry'];
    $experience = $_POST['experience'];
    $salary = $_POST['salary'];
    $coverLetter = $_POST['coverLetter'];

    // Debug: Check database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert application into database
    $query = "INSERT INTO job_applications (job_id, first_name, last_name, email, phone, address, education, industry, 
              experience, expected_salary, cover_letter, resume_path, application_date) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "isssssssidss",
        $job_id,
        $firstName,
        $lastName,
        $email,
        $phone,
        $address,
        $education,
        $industry,
        $experience,
        $salary,
        $coverLetter,
        $resumePath
    );

    // Debug: Check for SQL errors
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    if ($stmt->execute()) {
        header('location:../career.php?status=success');
        exit();
    } else {
        header('location:../career.php?status=error&message=' . urlencode('Failed to submit application: ' . $conn->error));
        exit();
    }
} else {
    header('location:../career.php?status=error&message=' . urlencode('Invalid request method.'));
}
?>
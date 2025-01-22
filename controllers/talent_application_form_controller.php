<?php
// Include database connection file
include("../includes/db_con.php");

// Check if form is submitted via POST
if (!isset($_POST['submit'])) {
    die("Form not submitted properly");
}

// Array to store validation errors 
$errors = [];

//application status
$status = "NEW";

/**
 * Validates email address format
 * @param string $email Email address to validate
 * @return bool True if valid email format, false otherwise
 */
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}





/**
 * Validates phone number format
 * Accepts formats: +1234567890, 123-456-7890, (123) 456-7890
 * @param string $phone Phone number to validate
 * @return bool True if valid phone format, false otherwise
 */
function validatePhone($phone)
{
    return preg_match('/^[0-9\+\(\)\-\.\s]{10,15}$/', $phone);
}





/**
 * Sanitizes input data by removing whitespace, slashes and converting special characters
 * @param string $data Input data to sanitize
 * @return string Sanitized data
 */
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}





if (isset($_POST['submit'])) {


    //default status
    $status = 'NEW';


    // Validate first name
    $firstName = sanitizeInput($_POST['firstName']);
    if (empty($firstName) || strlen($firstName) > 50) {
        $errors[] = "First name is required and must be less than 50 characters";
    }



    // Validate last name  
    $lastName = sanitizeInput($_POST['lastName']);
    if (empty($lastName) || strlen($lastName) > 50) {
        $errors[] = "Last name is required and must be less than 50 characters";
    }



    // Validate email
    $email = sanitizeInput($_POST['email']);
    if (!validateEmail($email)) {
        $errors[] = "Invalid email format";
    }



    // Validate phone number
    $phone = sanitizeInput($_POST['phone']);
    if (!validatePhone($phone)) {
        $errors[] = "Invalid phone number format";
    }



    // Validate address
    $address = sanitizeInput($_POST['address']);
    if (empty($address)) {
        $errors[] = "Address is required";
    }



    // Validate education
    $education = sanitizeInput($_POST['education']);
    if (empty($education)) {
        $errors[] = "Education is required";
    }






    // Validate years of experience
    $experience = filter_var($_POST['experience'], FILTER_VALIDATE_INT);
    if ($experience === false || $experience < 0) {
        $errors[] = "Invalid experience value";
    }



    // Validate expected salary
    $salary = filter_var($_POST['salary'], FILTER_VALIDATE_FLOAT);
    if ($salary === false || $salary < 0) {
        $errors[] = "Invalid salary expectation";
    }


    //validate skills
    $skills = sanitizeInput($_POST['skills']);
    if (empty($skills)) {
        $errors[] = "Skills are required";
    }

    //validate start date 
    $start_date = $_POST['start_date'];

    // Validate preferred location
    $desired_role = sanitizeInput($_POST['desired_role']);
    if (empty($desired_role)) {
        $errors[] = "Desired role is required";
    }



    // If validation errors exist, redirect back with error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header('location:../career.php?status=error&message=' . urlencode($errorString));
        exit();
    }





    // Handle resume file upload
    $uploadDir = '../uploads/resumes/';
    $resumePath = '';

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        // Generate unique filename for resume
        $fileExtension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('resume_') . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;



        // Validate file type (PDF, DOC, DOCX only)
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!in_array($_FILES['resume']['type'], $allowedTypes)) {
            header('location:../career.php?status=error&message=' . urlencode('Invalid file type. Only PDF and DOC files are allowed.'));
            exit();
        }



        // Validate file size (max 2MB)
        if ($_FILES['resume']['size'] > 2 * 1024 * 1024) {
            header('location:../career.php?status=error&message=' . urlencode('File is too large. Maximum size is 2MB.'));
            exit();
        }



        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $targetPath)) {
            $resumePath = $fileName;
        } else {
            header('location:../career.php?status=error&message=' . urlencode('Failed to upload file.'));
            exit();
        }
    } else {


        $errors[] = "Resume file is required";
        header('location:../career.php?status=error&message=' . urlencode('Resume file is required'));
        exit();


    }




    // Handle cover letter file upload
    $uploadCoverLetterDir = '../uploads/cover-letter/';
    $coverLetterPath = '';

    if (isset($_FILES['cover_letter']) && $_FILES['cover_letter']['error'] === UPLOAD_ERR_OK) {
        // Generate unique filename for cover letter
        $fileExtension = pathinfo($_FILES['cover_letter']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('cover_letter_') . '.' . $fileExtension;
        $targetPath = $uploadCoverLetterDir . $fileName;



        // Validate file type (PDF, DOC, DOCX only)
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!in_array($_FILES['cover_letter']['type'], $allowedTypes)) {
            header('location:../career.php?status=error&message=' . urlencode('Invalid file type. Only PDF and DOC files are allowed.'));
            exit();
        }



        // Validate file size (max 2MB)
        if ($_FILES['cover_letter']['size'] > 2 * 1024 * 1024) {
            header('location:../career.php?status=error&message=' . urlencode('File is too large. Maximum size is 2MB.'));
            exit();
        }



        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['cover_letter']['tmp_name'], $targetPath)) {
            $coverLetterPath = $fileName;
        } else {
            header('location:../career.php?status=error&message=' . urlencode('Failed to upload file.'));
            exit();
        }
    }


    // Verify database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    // Prepare and execute database insert query
    $query = "INSERT INTO talents ( 
    first_name, #s
    last_name, #s
    email, #s
    phone_number, #s
    address, #s
    position, #s
    education, #s
    experience,  #i
    salary_expectation, #i
    skills, #s
    start_date, #s
    resume_path, #s
    cover_letter_path, #s
    status #s
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";



    $stmt = $conn->prepare($query);

    $stmt->bind_param(
        "sssssssiisssss",
        $firstName,
        $lastName,
        $email,
        $phone,
        $address,
        $desired_role,
        $education,
        $experience,
        $salary,
        $skills,
        $start_date,
        $resumePath,
        $coverLetterPath,
        $status,
    );



    // Execute query and handle result
    if ($stmt->execute()) {
        header('location:../career.php?status=success&message=form submitted successfully ');
        exit();
    } else {
        header('location:../career.php?status=error&message=' . urlencode('Failed to submit application: ' . $conn->error));
        exit();
    }

} else {
    // Redirect if form not submitted via POST
    header('location:../career.php?status=error&message=' . urlencode('Invalid request method.'));
}

?>
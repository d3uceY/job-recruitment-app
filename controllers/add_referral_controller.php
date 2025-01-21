<?php
// This controller handles adding new referrals to the database
// It receives referral name via POST, validates it, and inserts into referrals table
// Redirects back to manage_referrals.php with success/error message

include '../includes/db_con.php';

if (isset($_POST['add_referral'])) {
    $name = $_POST['name'];

    if (empty($name) || trim($name) == '') {
        header('Location: ../manage_referrals.php?error=type in a valid referral name');
        exit();
    } else {
        $query = "INSERT INTO referrals (referral) VALUES (?)";
        $stmt = $conn->prepare($query);
        
        $stmt->bind_param("s", $name);
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            header("Location: ../manage_referrals.php?success=Referral added successfully");
        } else {
            header("Location: ../manage_referrals.php?error=Failed to add referral");
        }

        $stmt->close();
    }
} else {
    header("Location: ../manage_referrals.php");
}
?>
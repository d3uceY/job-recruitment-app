<?php
// This controller handles the deletion of referrals from the database
// It expects an referral ID via GET parameter and deletes the corresponding record
// Redirects back to manage_referrals.php with success/error message
include '../includes/db_con.php';

// Check if referral ID was provided in URL
if (isset($_GET['id'])) {
  // Get the referral ID from URL parameter
  $id = $_GET['id'];

  // Prepare DELETE query with parameterized statement for security
  $query = "DELETE FROM referrals WHERE id = ?";

  // Create prepared statement
  $stmt = $conn->prepare($query);

  // Bind the ID parameter as integer
  $stmt->bind_param("i", $id);

  // Execute the delete query
  $stmt->execute();

  // Check if deletion was successful
  if ($stmt->affected_rows > 0) {
    // Redirect with success message if row was deleted
    header("Location:../manage_referrals.php?success=Referral deleted successfully");
    exit();
  } else {
    // Redirect with error if deletion failed
    header("Location: ../manage_referrals.php?error=Failed to delete referral"); 
    exit();
  }

}
// Close the prepared statement
$stmt->close();
?>
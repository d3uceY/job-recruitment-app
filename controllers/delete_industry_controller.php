<?php
// This controller handles the deletion of industry categories from the database
// It expects an industry ID via GET parameter and deletes the corresponding record
// Redirects back to industry.php with success/error message
include '../includes/db_con.php';

// Check if industry ID was provided in URL
if (isset($_GET['id'])) {
  // Get the industry ID from URL parameter
  $id = $_GET['id'];

  // Prepare DELETE query with parameterized statement for security
  $query = "DELETE FROM industry_category WHERE id = ?";

  // Create prepared statement
  $stmt = $conn->prepare($query);

  // Bind the ID parameter as integer
  $stmt->bind_param("i", $id);

  // Execute the delete query
  $stmt->execute();

  // Check if deletion was successful
  if ($stmt->affected_rows > 0) {
    // Redirect with success message if row was deleted
    header("Location:../industry.php?success=Industry deleted successfully");
    exit();
  } else {
    // Redirect with error if deletion failed
    header("Location: ../industry.php?error=Failed to delete industry"); 
    exit();
  }

}
// Close the prepared statement
$stmt->close();
?>
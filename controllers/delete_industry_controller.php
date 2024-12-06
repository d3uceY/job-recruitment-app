<?php
// This controller handles the deletion of industry categories from the database
// It expects an industry ID via GET parameter and deletes the corresponding record
// Redirects back to industry.php with success/error message
include '../includes/db_con.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "DELETE FROM industry_category WHERE id = ?";

  $stmt = $conn->prepare($query);

  $stmt->bind_param("i", $id);

  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    header("Location:../industry.php?success=Industry deleted successfully");
    exit();
  } else {
    header("Location: ../industry.php?error=Failed to delete industry");
    exit();
  }
  
}
$stmt->close();
?>
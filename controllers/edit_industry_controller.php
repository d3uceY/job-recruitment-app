<?php
include '../includes/db_con.php';

if (isset($_POST['edit_industry'])) {
    $industry = $_POST['name'];
    $id = $_POST['id'];


    if (empty($industry) || trim($industry) === '') {
        header('location: ../industry.php?error=type a valid industry');
        exit();
    } else {
        $query = "UPDATE industry_category SET category=? WHERE id=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $industry, $id);

        if ($stmt->execute()) {
            header("location: ../industry.php?success=you successfully edited an industry");
            exit();
        } else {
            header("location:../industry.php?error=" . urlencode($stmt->error));
            exit();
        }
    }
}
?>
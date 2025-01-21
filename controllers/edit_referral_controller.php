<?php
include '../includes/db_con.php';

if (isset($_POST['edit_referral'])) {
    $referral = $_POST['name'];
    $id = $_POST['id'];


    if (empty($referral) || trim($referral) === '') {
        header('location: ../manage_referrals.php?error=type a valid referral');
        exit();
    } else {
        $query = "UPDATE referrals SET referral=? WHERE id=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $referral, $id);

        if ($stmt->execute()) {
            header("location: ../manage_referrals.php?success=you successfully edited a referral");
            exit();
        } else {
            header("location:../manage_referrals.php?error=" . urlencode($stmt->error));
            exit();
        }
    }
}
?>
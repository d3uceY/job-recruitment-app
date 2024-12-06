<?php
include("../includes/db_con.php");


if (isset($_POST['edit_level'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];


    if (empty($name) || trim($name) == "") {
        header("Location: ../educational_level.php?error=empty_field");
        exit();
    } else {
        $query = "UPDATE educational_level SET education='$name' WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("Location: ../educational_level.php?success=updated");
        } else {
            echo "Error updating educational level: " . mysqli_error($conn);
        }
    }
}
?>
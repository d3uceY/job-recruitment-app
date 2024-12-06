<?php
include '../includes/db_con.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM educational_level WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if($result){
        header('location:../educational_level.php?success=Educational level deleted successfully');
        exit();
    } else {
        header('location:../educational_level.php?error=Failed to delete educational level');
        exit();
    }
}
?>
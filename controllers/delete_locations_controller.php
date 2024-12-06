<?php 
/*
 * This file handles deletion of locations from the database
 * It receives a location ID via GET parameter and removes the corresponding record
 * On success, redirects back to locations.php with success message
 * On failure, redirects back to locations.php with error message
 */

include('../includes/db_con.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM locations WHERE id = '$id'";

    $result = mysqli_query($conn, $query);
    if($result){
        header('location:../locations.php?success=Location deleted successfully');
        exit();
    } else{
        header('location:../locations.php?error=Failed to delete location');
        exit();
    }
}
?>
<?php
/*
 * This file handles adding new locations to the database
 * It receives POST data from the locations.php form containing state and country
 * Validates that both state and country fields are not empty
 * On success, inserts the location into the database and redirects with success message
 * On failure, redirects back to locations.php with appropriate error message
 */

include('../includes/db_con.php');

if (isset($_POST['add_location'])) {
    $state = $_POST['state'];
    $country = $_POST['country'];

    if (empty($state) || trim($state) == '') {
        header('location:../locations.php?error=State is required');
        exit();
    } else if (empty($country) || trim($country) == '') {
        header('location:../locations.php?error=Country is required');
        exit();
    }

    else{
        $query = "INSERT INTO locations (state, country) VALUES ('$state', '$country')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            header('location:../locations.php?success=Location added successfully');
            exit();
        } else {
            header('location:../locations.php?error=Failed to add location');
            exit();
        }
    }
}

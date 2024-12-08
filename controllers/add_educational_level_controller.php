<?php
include '../includes/db_con.php';

if(isset($_POST['add_level'])){
    $name = $_POST['name'];
}
if(empty($name) || trim($name) == ''){
    header('location:../educational_level.php?error=Educational level cannot be empty');
    exit();
} else {
    $query = "INSERT INTO educational_level (education) VALUES ('$name')";
    $result = mysqli_query($conn, $query);
    if($result){
        header('location:../educational_level.php?success=Educational level added successfully');
        exit();
    }
} 
?>
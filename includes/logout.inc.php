<?php
/**
 * Logout script
 * This script logs out the user by destroying the session
 * and redirects to the signin page
 */
session_start();
session_unset();
session_destroy();
header("location:../signin.php");
exit();
?>
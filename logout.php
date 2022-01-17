<!-- constants.php for Site Url -->
<?php include('../config/constants.php'); ?>

<?php

// End the Login Session and Redirect to login page
session_destroy(); //unset $_SESSION['user']

//Redirect to login
header('location:'.SITE_URL.'admin/login.php');

?>
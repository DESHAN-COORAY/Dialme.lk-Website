<?php 

//Access control
// check user logged into the system or not
if(!isset($_SESSION['user'])) // if user session not set
{
    //user is not logged in
    // redirect to login page
    $_SESSION['not_login'] = "<div class='error'>  Please Login to the System to Access Dashboard. </div>";
    //Redirect to login page
    header('location:'.SITE_URL.'admin/login.php');

}

?>
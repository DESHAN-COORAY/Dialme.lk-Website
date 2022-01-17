
<?php

// Include constant.php file
include('../config/constants.php');

// Get the ID of Admin to be deleted
$id = $_GET['id'];

// Create SQL query to the Delete Admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the Query
$result = mysqli_query($conn,$sql);

// check the Query executed or not
if($result==TRUE)
{
    // When Query executed successfully 
    // echo " Admin Deleted";
    $_SESSION['delete'] = "<div class='success'>Admin Deleted successfully.</div>";
    // Redirect to Admin page
    header('location:'.SITE_URL.'/admin/admin.php');
}
else{
    $_SESSION['delete'] = "<div class='error'>Failed to Deleted.</div> ";
    // Redirect to Admin page
    header('location:'.SITE_URL.'/admin/admin.php');
}
?>
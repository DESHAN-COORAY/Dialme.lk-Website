<?php

// include constants file
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // 01. Get the id and image name

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 02. Remove the image if available

    if($image_name !="")
    {
        // check Image available 
        $path = "../images/phones/".$image_name;

        // Remove the image
        $remove = unlink($path);

        // if failed to remove image show a error message and end the process
        if($remove == false)
            {
                // Show a session message
                $_SESSION ['upload'] = "<div class='error'>Failed to remove the Phone image</div> ";
                // Redirect to category page
                header('location:'.SITE_URL.'admin/phone.php');
                //End the Process
                die();
            }

    }

    // 03. Delete Phone from database

    $sql= "DELETE FROM tbl_phone WHERE id=$id";

    // execute the query
    $result = mysqli_query($conn,$sql);

    // check data are deleted from the database
     // Redirect to phone page with a session message
    if(result==true)
        {
            // show the success message and redirect to category page
            $_SESSION ['delete'] = "<div class='success'>Successfully deleted the Category.</div> ";
            // Redirect to category page
            header('location:'.SITE_URL.'admin/phones.php');
        }
    else
        {
             // show the success message and redirect to category page
             $_SESSION ['delete'] = "<div class='error'>Failed to deleted the pHONE.</div> ";
             // Redirect to category page
             header('location:'.SITE_URL.'admin/phones.php');
        }

   

}
else{
    // show error message and redirect to Phone page
    $_SESSION ['access_denied'] = "<div class='error'>Can not access to the page</div> ";
    // Redirect to category page
    header('location:'.SITE_URL.'admin/phones.php');
}
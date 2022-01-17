<?php
// include constants file
include('../config/constants.php');

// Check image name and id 
if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the values

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove image file if image is available
        if($image_name !="")
        {
            // check Image available 
            $path = "../images/category/".$image_name;

            // Remove the image
            $remove = unlink($path);

            // if failed to remove image show a error message and end the process
            if($remove == false)
                {
                    // Show a session message
                    $_SESSION ['remove'] = "<div class='error'>Failed to remove the Category image</div> ";
                    // Redirect to category page
                    header('location:'.SITE_URL.'admin/category.php');
                    //End the Process
                    die();
                }

        }
        // Delete data from database
        // SQL query to delete data from database
        $sql= "DELETE FROM tbl_category WHERE id=$id";

        // execute the query
        $result = mysqli_query($conn,$sql);

        //check the data is deleted from the database
        if($result==true)
            {
                // show the success message and redirect to category page
                $_SESSION ['delete'] = "<div class='success'>Successfully deleted the Category.</div> ";
                // Redirect to category page
                header('location:'.SITE_URL.'admin/category.php');
            }
            else{
                // show error message and redirect to category page
                $_SESSION ['delete'] = "<div class='error'>Failed to deleted the Category.</div> ";
                // Redirect to category page
                header('location:'.SITE_URL.'admin/category.php');

            }

        // Redirect to Category Page
    }
    else
    {
        // Redirect to category page
        header('location:'.SITE_URL.'admin/category.php');
    }
?>
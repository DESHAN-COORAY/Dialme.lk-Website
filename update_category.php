<?php include('partials/menu.php'); ?>

<!-- Main Section Start -->
<div class="main_content">
        <div class="wrapper">
            <h2>UPDATE CATEGORY</h2>

            <?php 
            
            //check the category id
            if(isset($_GET['id']))
            {
                //Get the all data
               // Get the id of Selected category
            $id=$_GET['id'];

            // Create SQL Query to get the Details
            $sql= "SELECT * FROM tbl_category WHERE id=$id";

            // Execute the Query
            $result= mysqli_query($conn, $sql);

                //check the data rows is available
                $count = mysqli_num_rows($result); 
                //check category data
                if($count==1)
                {
                    // Get the data
                    $row=mysqli_fetch_assoc($result);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }
                else{
                    // Show a error message
                    $_SESSION['no_category_found'] = "<div class='error'>Category Not Found</div> ";
                    //Redirect to Category Page
                    header("location:".SITE_URL.'admin/category.php');
                }

            
            }
            else
            {
                // Redirect to Admin page
                header('location:'.SITE_URL.'/admin/category.php');

            }
            
            ?>
            <!-- FORM Start-->

            <div class="form form_w2">
            <form  method="POST" action="" enctype="multipart/form-data">
                <div class="title">Welcome</div>
                <div class="subtitle">Let's create your Category!</div>
                <div class="input-container ic1">
                    <input name="title" class="input" type="text" value ="<?php echo $title ?> " />
                    <div class="cut"></div>
                    <label for="title" class="placeholder">Category Title</label>
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">Current image :  </label><br>
                    <?php 
                        if($current_image !="")
                            {
                                // Display Image
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?>" width=120px >
                                <?php
                            }
                            else
                            {
                                // Show Message
                                echo "<div class='error'>Image is not Available</div>";
                            }
                        
                        
                        ?> 
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">New image :  </label>
                    <input name="image" class="btn_radio" type="file" value= ""  />
                </div>
               
                <div class=" btn_radio btn">
                    <label class="px-1" for="active">Featured :  </label>
                    <input <?php if($featured=="yes"){echo "checked" ;}  ?> name="featured" class="" type="radio" value= "yes"  />  Yes 
                    
                    <input <?php if($featured=="no"){echo "checked" ;}  ?> name="featured" class="btn_radio" type="radio" value= "no"  />    No 
                
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">Active :  </label>
                    
                    <input <?php if($active=="yes"){echo "checked" ;}  ?> name="active" class="" type="radio" value= "yes"  />  Yes 
                    
                    <input <?php if($active=="no"){echo "checked" ;}  ?> name="active" class="btn_radio" type="radio" value= "no"  />    No 
                
                </div>
                <input type="hidden" name= "current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name= "id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" class="submit" value="Update Category"></input>
                </form>

            
    <?php 
    
                // Check the submit button clicked 
                if(isset($_POST['submit']))
                {
                    // Get the values from the form to update
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //Update the image if selected
                    // Check image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        //Get the image
                        $image_name =$_FILES['image']['name'];

                        //check image name available or not
                        if($image_name !="")
                        {
                            // Image Available

                            // upload new image
                            // Auto Rename the Images
                            //Get the image extension (jpg,png) ex:(Iphone.jpg)
                            $ext = end(explode('.', $image_name));

                            // Rename the Image
                            $image_name="phone_category_".rand(000,999).'.'.$ext; // new name = phone_category_512.jpg

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            // Final Step to upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check image uploaded or Not
                            //if image is not uploaded - Redirect the page with error message
                            if($upload==false)
                                {
                                    // Error Message
                                $_SESSION['upload'] = "<div class='error'> Image Upload Failed</div>";
                                //Redirect to category page
                                header('location:'.SITE_URL.'admin/category.php');
                                die();
                        }
                            // Remove the current image if its available
                            if($current_image !="")
                            {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);
    
                                // Check image is removed from the database
                                // If failed to remove the image display a message
                                if($remove==false)
                                {
                                    // Failed to remove message
                                    $_SESSION['remove_failed']= "<div class='error'>Failed to Remove the Current Image</div>";
                                     //Redirect to Category page
                                     header('location:'.SITE_URL.'admin/category.php');
                                     die();
                                }
                            }
                           

                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    // SQL Query to Update the category
                    $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                    ";

                    // Execute the SQL Query
                    $result2 = mysqli_query($conn,$sql2);

                    // check the SQL Query executed or not
                    if($result2==true)
                    {
                        // Query executed and Update category
                        $_SESSION['update'] = "<div class='success'> Category Updated Successfully</div>";
                        //Redirect to category page
                        header('location:'.SITE_URL.'admin/category.php');
                    }
                    else{
                        // Query not executed and failed to Update Category
                        $_SESSION['update'] = " <div class='error'> Category Updated Failed</div>";
                        //Redirect to Category page
                        header('location:'.SITE_URL.'admin/category.php');

                    }
                }
    ?>             


                </div>
            <!-- FORM END-->
        </div>
    
        
    <!-- Main Section End-->



<?php include('partials/footer.php'); ?>

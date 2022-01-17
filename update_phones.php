<?php include('partials/menu.php'); 
ob_start();
?>

<?php 

    // check id is set
    if(isset($_GET['id']))
    {
        // Got the all details
        $id = $_GET['id'];
        // sql query to select the phones
        $sql2 = "SELECT * FROM tbl_phone WHERE id=$id";

        // Execute the query
        $result2 = mysqli_query($conn,$sql2);
            
        // Get the values
        $row2 = mysqli_fetch_assoc($result2);

        //Get the values of phones
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
        


    }
    else
    {
         //Redirect to Category Page
         header("location:".SITE_URL.'admin/phones.php');
    }

?>

<div class="main_content">
        <div class="wrapper">
            <h2>ADD PHONES</h2>

    <div class="form form_large">
                <form  method="POST" action="" enctype="multipart/form-data">
                    <div class="title">Welcome</div>
                    <div class="subtitle">Let's Update Your Phone!</div>
                    <div class="input-container ic1">
                        <input name="title" class="input" type="text" value="<?php echo $title; ?> " />
                        <div class="cut"></div>
                        <label for="title" class="placeholder">Phone Title</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="description" class="input" type="textarea" value="<?php echo $description; ?> "  />
                        <div class="cut"></div>
                        <label for="description" class="placeholder">Description</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="price" class="input" type="number" value="<?php echo $price; ?>"  />
                        <div class="cut"></div>
                        <label for="price" class="placeholder">price</label>
                    </div>

                   

                    <div class="input-container ic1">
                    <label for="Category" class="select_lb" for="number" class="placeholder">Category</label>

                        <select class="select" name="category" id="">
                            <?php

                            $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                            // query executed
                            $result = mysqli_query($conn, $sql);

                            // count rows
                            $count = mysqli_num_rows($result);

                            // check category available
                            if($count>0)
                            {
                                // category available
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php

                                }
                            }

                            ?>
                        </select>
                
                    </div>

                    <div class=" btn_radio ">
                    <label class="px-1" for="current_image">Current image :  </label><br>
                    <td>
                    <?php 
                    
                    // check image is empty or not
                    if($current_image == "")
                        {
                            // Image not available
                            echo "<div class='error'>Image is not available.</div>";
                        }
                        else
                        {
                            // Image available
                            ?>
                            <img src="<?php echo SITE_URL; ?>images/phones/<?php echo $current_image; ?>" width="120px">

                            <?php
                        }

                    
                    ?>
                    </td>
                     </div>

                    <div class=" btn_radio ">
                        <label class="px-1" for="image">Select image :  </label>
                        <input name="image" class="btn_radio" type="file" value= ""  />
                    </div>
                
                    <div class=" btn_radio btn">
                        <label class="px-1" for="featured">Featured :  </label>
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
                    <input type="submit" name="submit" class="submit" value="Update Phone"></input>
                    </form>

                    <?php

                        if(isset($_POST['submit']))
                        {
                            // 01. Get the values from the form to update
                            // Get the values from the form to update
                                $id = $_POST['id'];
                                $title = $_POST['title'];
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $current_image = $_POST['current_image'];
                                $category = $_POST['category'];
                                $featured = $_POST['featured'];
                                $active = $_POST['active'];

                            // 02. Upload the image if selected

                            // check upload button clicked or not
                            if(isset($_FILES['image']['name']))
                                {

                                    // upload button clicked
                                    $image_name = $_FILES['image']['name']; // New image name

                                    // check file  available or not
                                    if($image_name!=="")
                                    {
                                        //Image is available
                                        // Rename the image
                                        //Upload the new image
                                        //Get the image extension (jpg,png) ex:(Iphone.jpg)
                                        $ext = explode('.', $image_name);
                                        $file_extension = end($ext);
                                        // Rename the Image
                                        $image_name="phone_name_".rand(000,999).".". $file_extension; // new name = phone_name_512.jpg

                                        $source_path = $_FILES['image']['tmp_name'];

                                        $destination_path = "../images/phones/".$image_name;

                                        // Final Step to upload the image
                                        $upload = move_uploaded_file($source_path,$destination_path);

                                        //check image uploaded or Not
                                        //if image is not uploaded - Redirect the page with error message
                                        if($upload==false)
                                        {
                                            // Failed to upload the image
                                            // Error Message
                                            $_SESSION['upload'] = "<div class='error'> Image Upload Failed</div>";
                                            //Redirect to phone page
                                            header('location:'.SITE_URL.'admin/phones.php');
                                            die();
                                        }
                                        
                                        // Remove the current image if available
                                        // 03. Remove the current image if new image is uploaded

                                        if( $current_image  =! " ") // check this later ---------------------------------------------------------
                                            {
                                            $remove_path = "../images/phones/".$current_image;

                                            $remove = unlink($remove_path);

                                            // check image removed or not

                                            if($remove==false)
                                            {
                                                // Failed to remove message
                                                $_SESSION['remove_failed']= "<div class='error'>Failed to Remove the Current Image</div>";
                                                 //Redirect to Category page
                                                 header('location:'.SITE_URL.'admin/phones.php');
                                                 die();
                                            }

                                        }
                                    }

                                    else
                                    {
                                         $image_name = $current_image; // Default image when image is not selected

                                    }

                                }
                                else
                                {
                                    $image_name = $current_image; // Default image when button is not clicked
                                }


                            // 04. Update the phone in the database
                            // SQL Query to Update the category
                                $sql3 = "UPDATE tbl_phone SET
                                title = '$title',
                                description = '$description',
                                price = $price,
                                image_name = '$image_name',
                                category_id = '$category',
                                featured= '$featured',
                                active = '$active'
                                WHERE id = $id
                                ";

                            // Execute the SQL Query
                            $result3 = mysqli_query($conn,$sql3);

                            // check query executed or not
                            if($result3==true)
                            {
                                 // Query not executed and failed to Update Phone
                                 $_SESSION['update'] = " <div class='success'> Phone Updated Successfully.</div>";
                                 //Redirect to phone page
                                 header('location:'.SITE_URL.'admin/phones.php');
                            }
                            else
                            {
                                // Query not executed and failed to Update Phone
                                $_SESSION['update'] = " <div class='error'> Phone Updated Failed</div>";
                                //Redirect to phone page
                                header('location:'.SITE_URL.'admin/phones.php');
                            }


                            // Redirect to Phone page
                            
                        }




                    ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

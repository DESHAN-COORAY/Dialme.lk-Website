<?php include('partials/menu.php'); ?>


        
<div>
  <div class="row">
    <div class="col">


<!-- Main Section Start -->
<div class="main_content">
        <div class="wrapper">
            <h2>Add Category</h2>
            <?php 
            
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Hide session message
            }

            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; // Display session message
                unset($_SESSION['upload']); // Hide session message
            }
            
            ?>
            <!-- FORM Start-->

            <div class="form form_w1">
            <form  method="POST" action="" enctype="multipart/form-data">
                <div class="title">Welcome</div>
                <div class="subtitle">Let's create your Category!</div>
                <div class="input-container ic1">
                    <input name="title" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="title" class="placeholder">Category Title</label>
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">Add image :  </label>
                    <input name="image" class="btn_radio" type="file" value= ""  />
                </div>
               
                <div class=" btn_radio btn">
                    <label class="px-1" for="active">Featured :  </label>
                    <input name="featured" class="" type="radio" value= "yes"  />  Yes 
                    <input name="featured" class="btn_radio" type="radio" value= "no"  />    No 
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">Active :  </label>
                    <input name="active" class="" type="radio" value= "yes"  />  Yes 
                    <input name="active" class="btn_radio" type="radio" value= "no"  />    No 
                </div>
                <input type="submit" name="submit" class="submit" value="Add Category"></input>
                </form>

            <?php

            // Check the submit button is clicked
            if(isset($_POST['submit']))
            {
                // Get the value from Category Form
                $title = $_POST['title'];

                // check the radio buttons selected or not
                if(isset($_POST['featured']))
                {
                    // get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    // Set default value 
                    $featured = 'no';
                }

                if(isset($_POST['active']))
                {
                    // get the value from form
                    $active = $_POST['active'];
                }
                else
                {
                    // Set default value 
                    $active = 'no';
                }

                //Check image selected or not
                
                if(isset($_FILES['image']['name']))
                {
                    // Upload Image
                    //to upload image - image name , image src path , image destination path needed
                    $image_name = $_FILES['image']['name'];

                    //Upload Image if only its selected by the user
                    if($image_name !="")
                    {

                            // Auto Rename the Images
                            //Get the image extension (jpg,png) ex:(Iphone.jpg)
                            $ext = end(explode('.', $image_name));

                            // Rename the Image
                            //$image_name="phone_category_".rand(000,999).'.'.$ext; // new name = phone_category_512.jpg

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
                                //Redirect to Admin page
                                header('location:'.SITE_URL.'admin/add_category.php');
                                die();

                        }
                    } 
                }
                else
                {
                    // Set default value as blank
                    $image_name = "";
                }

                
                // SQL Query to insert category to the database
                $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name' ,
                        featured='$featured',
                        active='$active'
                ";

                // Execute the Query and Save the data in database
                $result = mysqli_query($conn, $sql);

                // check Query is executed or not
                if($result==TRUE)
                {
                    // Query Executed and Category added
                    $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                    //Redirect to Category page
                    header('location:'.SITE_URL.'admin/category.php');
                }
                else
                {
                    // Failed to add Category
                     $_SESSION['add']="<div class='error'>Failed to Add Category </div>";
                     //Redirect to Category page
                     header('location:'.SITE_URL.'admin/add_category.php');

                }

            }

            ?>



                </div>
            <!-- FORM END-->
        </div>
    
        
    <!-- Main Section End-->
  
    <div class="col">
    <div class="backgrounds">
        <video autoplay muted loop id="myVideo" class="video2">
        <source src="../images/Animation.mp4" type="video/mp4">
        </video>
    </div>
  </div>

</div>


    <?php include('partials/footer.php') ?>

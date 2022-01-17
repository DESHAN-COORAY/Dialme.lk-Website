<?php include_once('partials/menu.php');
ob_start();
?>

<!-- Main Section Start -->
<div class="main_content">
        <div class="wrapper">
            <h2>Add Phones</h2>
            <?php 

            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; // Display session message
                unset($_SESSION['upload']); // Hide session message
            }
            
            ?>
            <!-- FORM Start-->

            <div class="form form_w3">
            <form  method="POST" action="" enctype="multipart/form-data">
                <div class="title">Welcome</div>
                <div class="subtitle">Let's Add Your Phone!</div>
                <div class="input-container ic1">
                    <input name="title" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="title" class="placeholder">Phone Title</label>
                </div>

                <div class="input-container ic1">
                    <input name="description" class="input" type="textarea" placeholder=" " />
                    <div class="cut"></div>
                    <label for="description" class="placeholder">Description</label>
                </div>

                <div class="input-container ic1">
                    <input name="price" class="input" type="number" placeholder=" " />
                    <div class="cut"></div>
                    <label for="number" class="placeholder">Price</label>
                </div>

                <div class="input-container ic1">
                <label for="Category" class="select_lb" for="number" class="placeholder">Category</label>

                    <select class="select" name="category" id="">

                        <?php 
                        
                        // Display categories from database
                        // 01. SQL Query to get all the active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";

                        $result = mysqli_query ($conn,$sql);

                        // Count rows to check the categories are available
                        $count = mysqli_num_rows($result);
                        
                        // if count > 0 database has categories
                        if($count > 0)
                        {
                            while($row=mysqli_fetch_assoc($result))
                            {
                                // Get the values of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            ?>

                        <option value="0">No Categories Found.</option>
                            <?php
                        }

                        // 02. Display on Drop Down       
                        ?>
                    </select>
            
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="image">Select image :  </label>
                    <input name="image" class="btn_radio" type="file" value= ""  />
                </div>
               
                <div class=" btn_radio btn">
                    <label class="px-1" for="featured">Featured :  </label>
                    <input name="featured" class="" type="radio" value= "yes"  />  Yes 
                    <input name="featured" class="btn_radio" type="radio" value= "no"  />    No 
                </div>

                <div class=" btn_radio ">
                    <label class="px-1" for="active">Active :  </label>
                    <input name="active" class="" type="radio" value= "yes"  />  Yes 
                    <input name="active" class="btn_radio" type="radio" value= "no"  />    No 
                </div>
                <input type="submit" name="submit" class="submit" value="Add Phone"></input>
                </form>

            <?php

            // Check the submit button is clicked
            if(isset($_POST['submit']))
            {
                // Get the value from Category Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check the radio buttons selected or not
                if(isset($_POST['featured']))
                {
                    // get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    // Set default value 
                    $featured = "no";
                }

                if(isset($_POST['active']))
                {
                    // get the value from form
                    $active = $_POST['active'];
                }
                else
                {
                    // Set default value 
                    $active = "no";
                }

                //Check image selected or not
                
                if(isset($_FILES['image']['name']))
                {
                    // Upload Image
                    //to upload image - image name , image src path , image destination path needed
                    $image_name = $_FILES['image']['name'];

                    //Upload Image if only its selected by the user
                    if($image_name!="")
                    {

                            // Auto Rename the Images
                            //Get the image extension (jpg,png) ex:(Iphone.jpg)
                            $ext = explode('.', $image_name);
                            $file_extension = end($ext);
                            
                            // Rename the Image
                            //$image_name="phone_name_".rand(000,999).".". $file_extension; // new name = phone_name_512.jpg

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/phones/".$image_name;

                            // Final Step to upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check image uploaded or Not
                            //if image is not uploaded - Redirect the page with error message
                            if($upload==false)
                                {
                                    // Error Message
                                $_SESSION['upload'] = "<div class='error'> Image Upload Failed</div>";
                                //Redirect to Admin page
                                header('location:'.SITE_URL.'admin/phones.php');
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
                // add ' ' to only for the string values
                $sql2 = "INSERT INTO tbl_phone SET
                        title='$title',
                        description='$description' ,
                        price= $price ,
                        image_name='$image_name' ,
                        category_id= $category ,
                        featured='$featured',
                        active='$active'
                ";

                // Execute the Query and Save the data in database
                $result2 = mysqli_query($conn, $sql2);

                // check Query is executed or not
                if($result2 == true)
                {
                    // Query executed and Update phone
                    $_SESSION['added'] = "<div class='success'> phone added Successfully</div>";
                    //Redirect to phone page
                    
                    header('location:'.SITE_URL.'admin/phones.php');
                    exit();
                }
                else{
                    // Query not executed and failed to add phone
                    $_SESSION['added'] = "<div class='error'> phone added Failed</div>";
                    //Redirect to phone page
                    header('location:'.SITE_URL.'admin/phones.php');

                }
            }
           ?>
                </div>
            <!-- FORM END-->
        </div>
    <!-- Main Section End food-->

<?php include('partials/footer.php'); ?>
<?php include('partials/menu.php') ?>
        
    <!-- Main Section Start -->
        <div class="main_content">
        <div class="wrapper">
            <h2>UPDATE ADMIN</h2>
            <?php 
            
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Hide session message
            }
            
            ?>

            <?php 
            
            // Get the id of Selected Admin
            $id=$_GET['id'];

            // Create SQL Query to get the Details
            $sql= "SELECT * FROM tbl_admin WHERE id=$id";

            // Execute the Query
            $result= mysqli_query($conn, $sql);

            // check Query executed
            if($result==TRUE){
                //check the data rows is available
                $count = mysqli_num_rows($result); 
                //check admin data
                if($count==1)
                {
                    // Get the data
                    $row=mysqli_fetch_assoc($result);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    //Redirect to Admin Page
                    header("location:".SITE_URL.'admin/admin.php');
                }

            }

            ?>
            <!-- FORM Start-->

            <div class="form">
            <form  method="POST" action="" >
                <div class="title">Welcome</div>
                <div class="subtitle">Let's create your account!</div>
                <div class="input-container ic1">
                    <input name="full_name" class="input" type="text" value="<?php echo $full_name;?>" placeholder=" " />
                    <div class="cut"></div>
                    <label for="full_name" class="placeholder">Full name</label>
                </div>
                <div class="input-container ic2">
                    <input name="username" class="input" type="text" value="<?php echo $username;?>" placeholder=" " />
                    <div class="cut"></div>
                    <label for="username" class="placeholder">Username</label>
                </div>
                <input type="hidden" name="id" value="<?php echo $id;?>"</input>
                <input type="submit" name="submit" class="submit" value="Update Admin"></input>
                </form>
                </div>
            <!-- FORM END-->
        </div>
    
    <?php 
    
    // Check the submit button clicked 
    if(isset($_POST['submit']))
    {
        // Get the values from the form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // SQL Query to Update the Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        // Execute the SQL Query
        $result = mysqli_query($conn,$sql);

        // check the SQL Query executed or not
        if($result==TRUE)
        {
            // Query executed and Update Admin
            $_SESSION['update'] = "<div class='success'> Admin Updated Successfully</div>";
            //Redirect to Admin page
            header('location:'.SITE_URL.'admin/admin.php');
        }
        else{
            // Query not executed and failed to Update Admin
            $_SESSION['update'] = " <div class='error'> Admin Updated Failed</div>";
            //Redirect to Admin page
            header('location:'.SITE_URL.'admin/admin.php');

        }
    }
    ?>
        
    <!-- Main Section End-->


    <?php include('partials/footer.php') ?>

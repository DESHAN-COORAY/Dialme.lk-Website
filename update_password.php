<!--  Navigation menu -->
<?php include('partials/menu.php') ?>

    <!-- Main Section Start -->
    <div class="main_content">
        <div class="wrapper">
            <h2>UPDATE PASSWORD</h2>

            <?php 
            
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            
            ?>
            <!-- FORM Start-->

            <div class="form">
            <form  method="POST" action="" >
                <div class="title">Welcome</div>
                <div class="subtitle">Let's create your account!</div>
                <div class="input-container ic1">
                    <input name="current_password" class="input" type="password" placeholder=" " />
                    <div class="cut"></div>
                    <label for="current_password" class="placeholder">Current Password</label>
                </div>
                <div class="input-container ic2">
                    <input name="new_password" class="input" type="password" placeholder=" " />
                    <div class="cut"></div>
                    <label for="new_password" class="placeholder">New Password</label>
                </div>
                <div class="input-container ic2">
                    <input name="confirm_password" class="input" type="password" placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="confirm_password" class="placeholder">Confirm Password</>
                </div>
                <input type="hidden" name="id"  value="<?php echo $id; ?>" >
                <input type="submit" name="submit" class="submit" value="Update Password"></input>
                </form>
                </div>
            <!-- FORM END-->
        </div>
    
        
    <!-- Main Section End-->

<?php 

// check Update Password button clicked or not
if(isset($_POST['submit']))
{
    //Get the Data from Form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //Check the user with current password is exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id= $id AND password='$current_password'";

    // execute the SQL Query
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    
    // Check data is inserted to the database
        if($result==TRUE)
        {
            // check data is available or not
            $count = mysqli_num_rows($result);
            if($count==1)
            {
                //When user is exist and password can be change
                
                // Check new password equals to the confirm password
                if($new_password==$confirm_password){

                    // Update the Password
                    $sql_2 = "UPDATE tbl_admin SET password='$new_password' WHERE id = $id";

                    // execute the Query
                    $result_2 =  mysqli_query($conn,$sql_2);

                    // check query executed or not
                    if($result_2==TRUE)
                    {
                            // Display Success Message 
                            $_SESSION['password_change'] = "<div class='success'>Password Changed Successfully.</div> ";
                            // Redirect to Admin page
                            header('location:'.SITE_URL.'/admin/admin.php');
                    }
                    else{
                            // Display Error Message
                            $_SESSION['password_change'] = "<div class='error'>Password Changed Failed.</div> ";
                            // Redirect to Admin page
                            header('location:'.SITE_URL.'/admin/admin.php');
                    }
                }
                else{
                    // Redirect to Admin page
                    $_SESSION['password_not_match'] = "<div class='error'>Password Didn't Match.</div> ";
                    // Redirect to Admin page
                    header('location:'.SITE_URL.'/admin/admin.php');
                }
            }

            else{
                //When count is not equal to one
                $_SESSION['user_not_found'] = "<div class='error'>User Not Found.</div> ";
                // Redirect to Admin page
                header('location:'.SITE_URL.'/admin/admin.php');
            }
        }

    //check new password and confirm password match or not

    // Update the new password if above conditions are true
}

?>

<!-- Footer -->
<?php include('partials/footer.php') ?>
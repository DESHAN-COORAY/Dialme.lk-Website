<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login Form</title>
</head>
<body>

<!-- Login Form Start -->
<div class="login_form overlay">
<form  method="POST" action="" >
<div class="center">
  <h1>Admin Login</h1>
  <?php

    if (isset($_SESSION['login'])) 
     {
      echo $_SESSION['login']; // Display session login message
      unset($_SESSION['login']); // Hide session login message
      }
    
      if (isset($_SESSION['not_login'])) 
      {
       echo $_SESSION['not_login']; // Display session not_login message
       unset($_SESSION['not_login']); // Hide session not_login message
       }

  ?>

  <br>

  <form>
    <div class="inputbox">
      <input type="text" name="username" required="required">
      <span>Username</span>
    </div>
    <div class="inputbox">
      <input type="password" name="password" required="required">
      <span>Password</span>
    </div>
    <div class="inputbox">
      <input type="submit" name="submit" value="Log In">
    </div>
  </form>
</div>
</div>
<!-- Login Form End -->

</body>
</html>

<?php 

// Check the submit is clicked
if(isset($_POST['submit'])){

    // Get the data from Login Form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQl query to check username and password exist in the database
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // Execute the Query
    $result = mysqli_query($conn,$sql);

    // Count the rows to check users exists
    $count = mysqli_num_rows($result);

    if($count==1)
    {
        // User available
        $_SESSION['login'] = "<div class='success'> Admin Login Successful.</div>";
        $_SESSION['user'] = $username; // check user logged into the system or not
         //Redirect to Index page
         header('location:'.SITE_URL.'admin/index.php');

    }
    else{
        // User not available
        $_SESSION['login'] = "<div class='error'>  Username or Password Incorrect. </div>";
        //Redirect to login page
        header('location:'.SITE_URL.'admin/login.php');

    }

}
else 
{ 

}




?>
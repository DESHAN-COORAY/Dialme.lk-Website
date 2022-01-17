<?php include('partials/menu.php') ?>
<?php
// Check submit button clicked or not 

if (isset($_POST['submit'])) {
    echo "Submitted";
}

else{
    echo "Not Submitted";
}

// Get data from the form

$full_name = $_POST['full_name'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Password encrypted with md5

// SQl Query to insert the data into database

$sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
";

// execute the sql query to add data into the database

$result = mysqli_query($conn,$sql) or die(mysqli_error());

// Check data is inserted to the database
if($result==TRUE)
{

    //Create a session variable to display a message
   $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

   //redirect to Admin page
   header("location:".SITE_URL.'admin/admin.php');
}
else
{
    //Create a session variable to display a message
   $_SESSION['add'] = "<div class='error'>Admin Added Failed</div>";

   //redirect to Admin page
   header("location:".SITE_URL.'admin/add_admin.php');
}

?>
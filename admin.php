<?php include('partials/menu.php') ?>
        
    <!-- Main Section Start -->
        <div class="main_content">
        <div class="wrapper">
            <h2 >Admin Manage</h2>
        <div class="mid">
            <br>
            <?php 
            
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; // Display session add message
                unset($_SESSION['add']); // Hide session add message
            }

            if (isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; // Display session delete message
                unset($_SESSION['delete']); // Hide session delete message
            }

            if (isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; // Display session update message
                unset($_SESSION['update']); // Hide session update message
            }

            if (isset($_SESSION['user_not_found'])) 
            {
                echo $_SESSION['user_not_found']; // Display session user_not_found message
                unset($_SESSION['user_not_found']); // Hide session user_not_found message
            }

            if (isset($_SESSION['password_not_match'])) 
            {
                echo $_SESSION['password_not_match']; // Display session password_not_match message
                unset($_SESSION['password_not_match']); // Hide session password_not_match message
            }

            if (isset($_SESSION['password_change'])) 
            {
                echo $_SESSION['password_change']; // Display session password_change message
                unset($_SESSION['password_change']); // Hide session password_change message
            }
            
            
            ?>
        </div>
            <!-- ADD ADMINS BUTTON -->
          
          <div class="btn">
                <a href="add_admin.php" class="btn_primary">Add Admin</a> <br><br>
                </div>
           
            <table>
                <thead>
                    <tr>
                    <th scope="col">Admin ID</th>
                    <th scope="col">FULL NAME</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">ACTIONS</th>
                    </tr>
                </thead>

                <?php 
                //Query to get data from database
                $sql = "SELECT * FROM tbl_admin";

                // execute the Query
                $result = mysqli_query($conn,$sql);

                //check the Query is working

                if($result==TRUE)
                    {
                        // count rows to check the database has data or not
                        $count = mysqli_num_rows($result); // Query to get all the rows in the database

                        $A_I = 1; //
                        // check the number of rows
                        if($count>0) {
                            // when data is in the database
                            while($rows=mysqli_fetch_assoc($result))
                            {
                                // Use while loop to get all the data from the database . while loop will execute as long as the  we have data in the database

                                //Get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display the values in the table
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $A_I++;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $username;?></td>
                                            <td>
                                                <a href="<?php echo SITE_URL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn_primary"><i class="fas fa-unlock-alt"></i></i></a>
                                                <a href="<?php echo SITE_URL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn_second"><i class="fas fa-user-edit"></i></a>
                                                <a href="<?php echo SITE_URL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn_danger"><i class="fas fa-user-times"></i></a>
                                            </td>
                                        </tr>
                                <?php

                            }
                        }
                        else
                        {
                            // when data is not in the database
                        }
                    }
                ?>

                </tbody>
        </table>
        </div>
    
        
    <!-- Main Section End-->


    <?php include('partials/footer.php') ?>
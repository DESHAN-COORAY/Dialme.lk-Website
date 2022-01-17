<?php include('partials/menu.php'); ?>
        
    <!-- Main Section Start -->
        <div class="main_content">
        <div class="wrapper">
            <h2>Phones Manage</h2>

            <!-- ADD ADMINS BUTTON -->
           <br>
                <div class="btn">
                 <a href="<?php echo SITE_URL; ?>admin/add_phone.php " class="btn_primary">Add Phones</a> <br><br>
                </div>

            <?php       
            if (isset($_SESSION['added'])) 
            {
                echo $_SESSION['added']; // Display session add message
                unset($_SESSION['added']); // Hide session add message
            }

            if (isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; // Display session add message
                unset($_SESSION['delete']); // Hide session add message
            }

            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; // Display session add message
                unset($_SESSION['upload']); // Hide session add message
            }

            if (isset($_SESSION['access_denied'])) 
            {
                echo $_SESSION['access_denied']; // Display session add message
                unset($_SESSION['access_denied']); // Hide session add message
            }

            if (isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; // Display session add message
                unset($_SESSION['update']); // Hide session add message
            }

            ?>
           
            <table>
                <thead>
                    <tr>
                    <th scope="col">Phone ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">FEATURED</th>
                    <th scope="col">ACTIVE</th>
                    <th scope="col">ACTIONS</th>
                    </tr>
                </thead>

                    <?php 
                    //Query to get data from database
                     $sql = "SELECT * FROM tbl_phone";

                    // execute the Query
                     $result = mysqli_query($conn,$sql);

                     // Phone Id variable
                     $P_I = 1;

                     $count = mysqli_num_rows($result); // Query to get all the rows in the database

                     if($count>0)
                     {
                        //  Phones are in the database
                        while($rows=mysqli_fetch_assoc($result))
                            {
                                // Use while loop to get all the data from the database . while loop will execute as long as the  we have data in the database

                                //Get individual data
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $description=$rows['description'];
                                $price=$rows['price'];
                                $image_name=$rows['image_name'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                                ?>

                                <tbody>
                                    <tr>
                                        <td><?php echo $P_I++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                        <?php 
                                
                                        // Check image is available
                                            if($image_name!="")
                                            {
                                                ?>
                                                <img src="<?php echo SITE_URL;  ?>images/phones/<?php echo $image_name;  ?>" width="100px">
                                                <?php

                                            }
                                            else{
                                                echo '<div class="error"> Image Not Available</div>';
                                            }
                                        
                                        ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update_phones.php?id=<?php echo $id; ?>" class="btn_second"><i class="fas fa-pen"></i></i></a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete_phones.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class="btn_danger"><i class="fas fa-trash"></i></i></a>
                                            
                                        </td>
                                    </tr>
                                    
                                </tbody>

                                <?php
                            }

                     }
                     else
                     {
                        // Phones are not in the database
                        echo "<tr><td class='error'>Phones are not in the Database</td></tr>";
                     }

                    
                    ?>

              
        </table>
        </div>
    
        
    <!-- Main Section End-->


    <?php include('partials/footer.php') ?>
<?php include('partials/menu.php') ?>
        
    <!-- Main Section Start -->
        <div class="main_content">
        <div class="wrapper">
            <h2>Category Manage</h2>

            <?php
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Hide session message
            }

            if (isset($_SESSION['remove'])) 
            {
                echo $_SESSION['remove']; // Display remove session message
                unset($_SESSION['remove']); // Hide remove session message
            }

            if (isset($_SESSION['delete'])) 
            {
                echo $_SESSION['delete']; // Display delete session message
                unset($_SESSION['delete']); // Hide delete session message
            }

            if (isset($_SESSION['no_category_found'])) 
            {
                echo $_SESSION['no_category_found']; // Display no_category_found session message
                unset($_SESSION['no_category_found']); // Hide no_category_found session message
            }

            if (isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; // Display update session message
                unset($_SESSION['update']); // Hide update session message
            }

            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload']; // Display upload session message
                unset($_SESSION['upload']); // Hide upload session message
            }
            
            
            ?>
            

            <!-- ADD ADMINS BUTTON -->
           <br>
          <div class="btn">
          <a href="<?php echo SITE_URL; ?>admin/add_category.php ?>" class="btn_primary">ADD CATEGORY</a>
                <br><br>
                </div>
           
            <table>
                <thead>
                    <tr>
                    <th scope="col">CATEGORY ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">FEATURED</th>
                    <th scope="col">ACTIVE</th>
                    <th scope="col">ACTION</th>

                    </tr>

                    <?php 
                    // SQL Query to get all the values from category table
                    $sql = "SELECT * FROM tbl_category";

                    //Execute the Query
                    $result = mysqli_query($conn,$sql);

                    // Count Rows
                    $count = mysqli_num_rows($result);

                    // Create id number
                    $C_I = 1; //
                    
                    // Check the data is available in database
                    if($count>0)
                    
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
            
                            ?>
                          <tbody>
                            <tr>
                                <td><?php echo $C_I++;?></td>
                                <td><?php echo $title;?></td>

                                <td>
                                    
                                <?php 
                                
                                // Check image is available
                                    if($image_name!="")
                                    {
                                        ?>
                                        <img src="<?php echo SITE_URL;  ?>images/category/<?php echo $image_name;  ?>" width="100px">
                                        <?php

                                    }
                                    else{
                                        echo '<div class="error"> Image Not Available</div>';
                                    }
                                
                                ?>
                            
                                </td>

                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <!-- <a href="#" class="btn_second" ><i class="fas fa-pen"></i></i></a> -->
                                    <a class="btn_second" href="<?php echo SITE_URL; ?>/admin/update_category.php.?id=<?php echo $id;?>" class="btn_second"><i class="fas fa-pen"></i></i></a>
                                    <a href="<?php echo SITE_URL; ?>/admin/delete_category.php.?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn_danger"><i class="fas fa-trash"></i></i></a>
                                </td>
                            </tr>
                    
                            </tbody>

                            <?php
                        }

                    {
                        ?>

                        <?php
                    }
                   
                    
                    
                    ?>

                </thead>
              
        </table>
        </div>
    
        
    <!-- Main Section End-->


    <?php include('partials/footer.php') ?>
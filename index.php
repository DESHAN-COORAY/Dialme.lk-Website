<?php include('partials/menu.php') ?>
        
    <div class="main_form ">
    <!-- Main Section Start -->
        <div class="container">
            <br>
            <h2 class="text-center">Dashboard</h2>
        
            <div class="text_center">
                <?php
                    if (isset($_SESSION['login'])) 
                    {
                    echo $_SESSION['login']; // Display session login message
                    unset($_SESSION['login']); // Hide session login message
                    }
                ?>
            </div>

                <div class=" wrapper1 content ">      
                    <div class="dashboard text_center ">
                        <?php
                        // sql query
                        $sql = "SELECT * FROM tbl_category";
                        // execute query
                        $result = mysqli_query($conn,$sql);
                        // count rows
                        $count = mysqli_num_rows($result);

                        ?>
                        <h3><?php echo $count; ?></h3><br>
                        Categories
                    </div>
                    <div class="dashboard text_center">
                            <?php
                                // sql query
                                $sql2 = "SELECT * FROM tbl_phone";
                                // execute query
                                $result2 = mysqli_query($conn,$sql2);
                                // count rows
                                $count2 = mysqli_num_rows($result2);

                            ?>
                        <h3><?php echo $count2; ?></h3><br>
                        Phones
                    </div>

                    <div class="dashboard text_center dashboard">
                            <?php
                                // sql query
                                $sql3 = "SELECT * FROM tbl_order ";
                                // execute query
                                $result3 = mysqli_query($conn,$sql3);
                                // count rows
                                $count3 = mysqli_num_rows($result3);

                            ?>
                        <h3><?php echo $count3; ?></h3><br>
                        Total Orders
                    </div>

                     <div class="text_center dashboard">
                            <?php
                                // sql query
                                $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE states='Delivered'";
                                // execute query
                                $result4 = mysqli_query($conn,$sql4);
                                // count rows
                                $row4 = mysqli_fetch_assoc($result4);

                                // Get total income
                                $total_income= $row4['Total'];

                            ?>
                        <h3><?php echo"Rs. ". $total_income; ?></h3><br>
                        Total Income
                    </div>
                    
            </div>
        </div>

        <div class="bg">
            <div class="backgrounds">
                    <video autoplay muted loop id="myVideo" class="video1">
                    <source src="../images/Admin.mp4" type="video/mp4">
                    </video>
                </div>
        </div>
    </div>
    <!-- Main Section End-->

    <?php include('partials/footer.php') ?>
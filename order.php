<?php include('partials/menu.php') ?>
        
    <!-- Main Section Start -->
        <div class="main_content">
        <div class="wrapper">
            <h2>Orders Manage</h2>
            <?php 
            

            if (isset($_SESSION['update'])) 
            {
                echo $_SESSION['update']; // Display session update message
                unset($_SESSION['update']); // Hide session update message
            }
            
            ?>

            <table>
                
                <thead>
                    <tr>
                    <th width="5%">O.ID</th>
                    <th width="18%">Phone </th>
                    <th width="18%">Price</th>
                    <th width="8%">Qty</th>
                    <th width="18%">Total </th>
                    <th width="15%">Order date </th>
                    <th width="15%">States </th>
                    <th width="20%">Name </th>
                    <th width="20%">Contact </th>
                    <th width="45%">Email</th>
                    <th width="45%">Address</th>
                    <th width="15%">Action</th>
                    </tr>
                </thead>

                <?php 
                //Query to get data from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                // execute the Query
                $result = mysqli_query($conn,$sql);

                // add variable to id
                $O_I = 1;

                //count rows
                $count = mysqli_num_rows($result);

                if($count>0)
                    {
                        // Orders available
                        while($row=mysqli_fetch_assoc($result))
                            {
                                // get the all orders from database
                                $id = $row['id'];
                                $phone = $row['phone'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $states = $row['states'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                ?>
                              <tbody>
                                    <tr>
                                        <td><?php echo $O_I++; ?></td>
                                        <td><?php echo $phone ?></td>
                                        <td><?php echo $price ?></td>
                                        <td><?php echo $qty ?></td>
                                        <td><?php echo $total ?></td>
                                        <td><?php echo $order_date ?></td>

                                        <td>
                                            <!-- Ordered -->
                                            <?php
                                            if($states=="ordered")
                                                {
                                                    echo "<label  style='color:#fff;  padding: 10px 10px;background-color: #f1c40f;'>$states</label>";


                                                }
                                                elseif ($states=="On Delivery")
                                                {
                                                    echo "<label  style='color:#fff;  padding: 10px 10px;background-color: #3498db;'>$states</label>";

                                                }
                                                elseif ($states=="Delivered")
                                                {
                                                    echo "<label  style='color:#fff;  padding: 10px 10px;background-color: #2ecc71;'>$states</label>";

                                                }
                                                 elseif ($states=="Canceled")
                                                {
                                                    echo "<label  style='color:#fff;  padding: 10px 10px;background-color: #e74c3c;'>$states</label>";

                                                }

                                            ?>
                                        </td>

                                        <td><?php echo $customer_name ?></td>
                                        <td><?php echo $customer_contact ?></td>
                                        <td><?php echo $customer_email ?></td>
                                        <td><?php echo $customer_address ?></td>

                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn_second"><i class="fas fa-user-edit"></i></a>
                                        </td>
                                    </tr>
                                    
                              </tbody>
                                <?php

                            }
                    }
                    else
                    {
                        // orders not available
                        echo "<div class='error'> Orders Not Available.</div>";
                    }

                ?>

        </table>
        </div>
    
        
    <!-- Main Section End-->


    <?php include('partials/footer.php') ?>
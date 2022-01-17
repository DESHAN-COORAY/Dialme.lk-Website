<?php include('partials/menu.php'); 
ob_start();
?>

<?php 

    // check id is set
    if(isset($_GET['id']))
    {
        // Got the all details
        $id = $_GET['id'];
        // sql query to select the order
        $sql = "SELECT * FROM tbl_order WHERE id=$id";

        // Execute the query
        $result = mysqli_query($conn,$sql);
            
        // Count Rows
        $count = mysqli_num_rows($result);

        if($count==1)
            {
                $row = mysqli_fetch_assoc($result);
                //Get the values of order
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
        
            }
            else
            {
                   //Redirect to Order Page
                    header("location:".SITE_URL.'admin/order.php');
            }
    }
    else
    {
         //Redirect to Order Page
         header("location:".SITE_URL.'admin/order.php');
    }

?>

<div class="main_content">
        <div class="wrapper">
            <h2>Update Order</h2>

    <div class="form form_large">
                <form  method="POST" action="" enctype="multipart/form-data">
                    <div class="title">Welcome</div>
                    <div class="subtitle">Let's Update Your Order!</div>
                    <div class="input-container ic1">
                        <input name="phone" class="input" type="text" value="<?php echo $phone; ?> " />
                        <div class="cut"></div>
                        <label for="title" class="placeholder">Ordered Phone</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="qty" class="input" type="number" value="<?php echo $qty; ?>"  />

                        <div class="cut"></div>
                        <label for="qty" class="placeholder">qty</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="price" class="input" type="number" value="<?php echo $price; ?>"  />
                        <div class="cut"></div>
                        <label for="price" class="placeholder">price</label>
                    </div>

                    <div class="input-container ic1">
                    <label for="states" class="select_lb" for="states" class="placeholder">states</label>

                        <select class="select" name="states" id="">
                        <option <?php if($states=="ordered"){echo "selected";} ?> value="Ordered" >Ordered</option>
                        <option <?php if($states=="on Delivery"){echo "selected";} ?> value="On Delivery" >On Delivery</option>
                        <option <?php if($states=="delivered"){echo "selected";} ?> value="Delivered" >Delivered</option>
                        <option <?php if($states=="canceled"){echo "selected";} ?> value="Canceled" >Canceled</option>
                        </select>
                    </div>

                    <div class="input-container ic1">
                        <input name="customer_name" class="input" type="text" value="<?php echo $customer_name; ?> "  />
                        <div class="cut"></div>
                        <label for="customer_name" class="placeholder">customer_name</label>
                    </div>

                    <div class="input-container ic1">
                    <input name="customer_contact" class="input" type="number" value="<?php echo $customer_contact; ?>"  />
                        <div class="cut"></div>
                        <label for="customer_contact" class="placeholder">customer contact</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="customer_email" class="input" type="email" value="<?php echo $customer_email; ?> "  />
                        <div class="cut"></div>
                        <label for="customer_email" class="placeholder">customer email</label>
                    </div>

                    <div class="input-container ic1">
                        <input name="customer_address" class="input" type="text" value="<?php echo $customer_address; ?> "  />
                        <div class="cut"></div>
                        <label for="customer_address" class="placeholder">customer address</label>
                    </div>


                    <input type="hidden" name= "price" value="<?php echo $price; ?>">
                    <input type="hidden" name= "id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" class="submit" value="Update Order"></input>
                    </form>

                  <?php

                    // check update button clicked
                    if(isset($_POST['submit']))
                        {
                            // Get the values from the form
                            $id = $_POST['id'];
                            $phone = $_POST['phone'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = $price * $qty;
                            $states = $_POST['states'];
                            $customer_name = $_POST['customer_name'];
                            $customer_contact = $_POST['customer_contact'];
                            $customer_email = $_POST['customer_email'];
                            $customer_address = $_POST['customer_address'];

                            // Update the values
                            $sql2 = "UPDATE tbl_order SET
                                    phone = '$phone',
                                    price = $price,
                                    qty = $qty,
                                    total = $total,
                                    states ='$states',
                                    customer_name = '$customer_name',
                                    customer_contact = '$customer_contact',
                                    customer_email = '$customer_email',
                                    customer_address = '$customer_address'
                                    WHERE id=$id;                     
                            ";

                            // execute the query
                            $result2 = mysqli_query($conn,$sql2);

                            // check data is update or not
                            if($result2==true)
                                {
                                    // data updated
                                     // Query executed and Update Order
                                    $_SESSION['update'] = "<div class='success'> Order Updated Successfully</div>";
                                    //Redirect to Admin page
                                    header('location:'.SITE_URL.'admin/order.php');
                                }
                                else
                                {
                                     // Query executed and Update Order
                                     $_SESSION['update'] = "<div class='error'> Order Updated Failed</div>";
                                     //Redirect to Admin page
                                     header('location:'.SITE_URL.'admin/order.php');
                                }

                        }


                  ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php include("./frontend_partials/menu.php") ;?>

<?php

  // check category id passed 
  if(isset($_GET['category_id']))
  {
    // category id get
    $category_id = $_GET['category_id'];

    // select category from its id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    // connect
    $result = mysqli_query($conn,$sql);

    // get the values from database
    $row = mysqli_fetch_assoc($result);
    
    //Get the title
    $category_title = $row['title']; 
  }
  else
  {
    // category not found - redirect to home page
    header('location:'.SITE_URL);


  }

?>

<!-- Sidebar -->
    <div class="row ">
      <div class=" col-md-2 v_menu v_nav" >
        <ul class="list-group list-group-flush ml-2 align-items-center bg">

        <a href="#" class="list-group-item"></a>
         <a href="#" class="list-group-item"></a> 
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=37" class="list-group-item">APPLE</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=38" class="list-group-item">SAMSUNG</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=39" class="list-group-item">HUAWEI</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=40" class="list-group-item">NOKIA</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=43" class="list-group-item">ONEPLUS</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=42" class="list-group-item">VIVO</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=41" class="list-group-item">XIAOMI</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=44" class="list-group-item">OPPO</a>
         <a href="http://localhost/DialmeProject/phone_category.php?category_id=45" class="list-group-item">REALME</a>
         <a href="#" class="list-group-item"></a>

        </ul>
      </div>

  <!-- Sidebar end -->

  <!-- main content -->

  <div class="col-md-10 main">
    <!-- Slider -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 pr-3 py-3" src="images/phones.png" alt="First slide">
    </div>
    
  </div>

    <!-- Phone SEARCH Section ends Here -->

  <section class="row">
  <div class="head">
    
    <h2>Results For Your Search Term: <a ><?php echo $category_title ?></a></h2>
  </div>

  <?php

    // sql query to get related to the search term
    $sql2 = "SELECT * FROM tbl_phone WHERE category_id=$category_id ";

    // execute the query
    $result2 = mysqli_query($conn,$sql2);

    // count rows
    $count2 = mysqli_num_rows($result2);

    // check phones are available in the database
    if($count2>0)
        {
            // phones available
            while($row2=mysqli_fetch_assoc($result2))
            {
                 // get the values 
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
  ?>

                        <section class="row ">
                                    <!-- Phone items -->
                                <div class=" row ml-5 mt-4 pl-3 align-items-center box " >
                                    <div class="card border-0" style="width: 20.5rem;">
                                    <?php
                                                if($image_name=="")
                                                {
                                                    // Display unavailable message
                                                    echo  "<div class='error'> Image Not Available.</div>";
                                                }
                                                else
                                                {
                                                    // image available
                                                    ?>
                                                <img class="card-img-top" src="<?php echo SITE_URL; ?>images/phones/<?php echo $image_name; ?>" >
                                                    <?php
                                                }

                                                ?>
                                        <div class="card-body text-center ">
                                        <h4 class="card-title "><?php echo $title; ?></h4>
                                        <p><?php echo $description; ?></p>
                                        <h5 class="card-title "><?php echo $price; ?></h5>
                                        </div>
                                        <a class="btn_second text-center" href="<?php echo SITE_URL; ?>order.php?phone_id=<?php echo $id; ?>">ORDER NOW</a>
                                    </div>
                                    </div>

                        </section>

                        <?php
            }

        }
        else
        {
            // Phones not available
            echo "<div class='error'>Can not access to the page</div> ";
        }

    ?>
              
</section>
</div>
</div>
    </div>
  </div>

<?php include("./frontend_partials/footer.php") ;?>
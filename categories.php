<?php include("./frontend_partials/menu.php") ;?>

<div class="col-md-10 main">
    <!-- Slider -->
    <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 pr-3 py-3" src="images/categories.png" alt="First slide">
    </div>
  </div> -->
  
 </div>
</div>
<video style="" width="1550px" height="" muted loop autoplay>
  <source src="images/Category.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>
<!-- Sidebar -->
    <div class="row ">

<!-- Sidebar end -->

  <!-- main content -->

<section class="row ">

      <?php 

      // SQL query to display phone categories
      $sql = "SELECT * FROM tbl_category WHERE active='yes' " ;

      // execute the query
      $result = mysqli_query($conn,$sql);

      // count the rows to check category table data is available
      $count = mysqli_num_rows($result);

      if($count > 0)
        {
          // Categories available
          while($row=mysqli_fetch_assoc($result))
          {
            // get the values from categories
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
      ?>
               <!-- Phone items -->
       <a href="<?php echo SITE_URL; ?>phone_category.php?category_id=<?php echo $id; ?>">
        <div class=" row ml-5 mt-4 pl-3 align-items-center box " >
              <div class="card border-0" style="width: 21rem;">
              <!-- Display image only if it is available -->
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
                <img class="card-img-top" src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" >
                    <?php
                  }

              ?>
                <div class="card-body text-center ">
                  <h4 class="card-title "><?php echo $title; ?></h4>
                </div>
              </div>
            </div>
                </a>
</section>

      <?php

          }
        }
        else
        {
          echo  "<div class='error'> Category not Found</div>";
        }
?>

    </div>
  </div>

<?php include("./frontend_partials/footer.php") ;?>
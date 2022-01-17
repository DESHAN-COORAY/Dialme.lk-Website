<?php include('partials/menu.php') ?>
        
<div class="container">
  <div class="row">
    <div class="col">
          <!-- Main Section Start -->

            <h2 class="wrapper">Add Admin</h2>
            <?php 
            
            if (isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Hide session message
            }
            
            ?>
            
            <!-- FORM Start-->

            <div class="form">
            <form  method="POST" action="connect.php" >
                <div class="title">Welcome</div>
                <div class="subtitle">Let's create your account!</div>
                <div class="input-container ic1">
                    <input name="full_name" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="full_name" class="placeholder">Full name</label>
                </div>
                <div class="input-container ic2">
                    <input name="username" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="username" class="placeholder">Username</label>
                </div>
                <div class="input-container ic2">
                    <input name="password" class="input" type="password" placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="password" class="placeholder">Password</>
                </div>
                <input type="submit" name="submit" class="submit" value="Add Admin"></input>
                </form>
                </div>
            <!-- FORM END-->
            </div>
    
        
    <!-- Main Section End-->
  
    <div class="col">
    <div class="backgrounds">
        <video autoplay muted loop id="myVideo" class="video">
        <source src="../images/Animation.mp4" type="video/mp4">
        </video>
    </div>
  </div>

</div>


    <?php include('partials/footer.php') ?>

<?php include("./frontend_partials/menu.php") ;?>


        
<div class="container">
  <div class="row">
    <div class="col ">
          <!-- Main Section Start -->           
            <!-- FORM Start-->
          <div class="contact">
            <div class="form">
            <form  method="POST" action="connect.php" >
                <div class="title">Contact Us</div>
                <div class="subtitle">Send Us a Message!</div>
                <div class="input-container ic1">
                    <input name="full_name" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="full_name" class="placeholder">Full name</label>
                </div>
                <div class="input-container ic2">
                    <input name="email" class="input" type="email" placeholder=" " />
                    <div class="cut"></div>
                    <label for="username" class="placeholder">Email</label>
                </div>
                <div class="input-container ic2">
                    <input name="Message" class="input" type="textarea" placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="Message" class="placeholder">Message</>
                </div>
                <input type="submit" name="submit" class="submit" value="Send"></input>
                </form>
                </div>
            <!-- FORM END-->
            </div>
            </div>
 

</div>


<?php include("./frontend_partials/footer.php") ;?>

<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
 require "app/database/connect.php";

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome -->
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>


        <!-- Custom Styling -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- page Styling -->
        <!-- <link rel="stylesheet" href="assets/css/page.css"> -->

        <title>Esport Brunei - Profile</title>
        <link rel="icon" href="assets/logo/logo3.png">

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- page Page Wrapper -->
        <div class="page-wrapper">

        <div class="sidebar-wrapper">

        <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>


                <div class="auth-content" align="center" >
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?> 


                    <?php  
                    // to get user details by fetching user punya database table 

                    $id = $_SESSION['id'];
                    $email_check = "SELECT * FROM users WHERE id = '$id'";
                    $res = mysqli_query($conn, $email_check);
                    if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_assoc($res);
                        $pic = $fetch['pic'];
                        $phone_number = $fetch['phone_number'];
                        $instagram = $fetch['instagram'];
                        $steam = $fetch['steam'];
                        $discord = $fetch['discord'];
                    }
                    
                    ?>
                    
                    

                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" >
                       
                        <div   >
                            <h3 >Profile Picture</h3>
                            <input type="file" name="image" class="text-input"  ></input>
                        </div>
                        <div > 
                            <h3>Username</h3>
                            <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" class="text-input" style = "text-align:center;">
                        </div>
                        
                        <div>
                            <h3>Email</h3>
                            <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" class="text-input" style = "text-align:center;" >
                        </div>
                        <div>
                            <h3>Phone Number</h3>
                            <input type="number" name="phone_number" value="<?php echo $phone_number; ?>" class="text-input" style = "text-align:center;" >
                        </div>
                        <div>
                            <h3>Bio</h3>
                            <textarea type="text" name="bio"  class="text-input"  ><?php echo $_SESSION['bio']; ?></textarea>
                        </div>
                        <div > 
                            <h3>Instagram</h3>
                            <input type="text" name="instagram" value="<?php echo $instagram; ?>" class="text-input" style = "text-align:center;">
                        </div>
                        <div > 
                            <h3>Steam</h3>
                            <input type="text" name="steam" value="<?php echo $steam; ?>" class="text-input" style = "text-align:center;">
                        </div>
                        <div > 
                            <h3>Discord</h3>
                            <input type="text" name="discord" value="<?php echo $discord; ?>" class="text-input" style = "text-align:center;">
                        </div>
                        <div>
                            <h3>Password</h3>
                            <input type="password" name="password" Placeholder = "Please re-enter your password to avoid errors" class="text-input" style = "text-align:center;" required></input>
                        </div>
                        <div>
                            <h3>Password Confirmation </h3>
                            <input type="password" name="passwordConf"  class="text-input" style = "text-align:center;" required></input>
                        </div>
                        <br>
                        <div>
                            <button type="submit" name="update-profile" class="btn btn-big">Update Profile</button>
                           <a href="<?php echo BASE_URL . '/profile.php' ?>" class="btn btn-big">Cancel Update</a>

                        </div>


                        
                    </form>
                   
                    </div>

                </div>

            </div>
            <!-- // page Content -->

        
        <!-- // Page Wrapper -->


        <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="assets/js/scripts.js"></script>

        <script>
  /* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }</script>

    </body>
    

</html>
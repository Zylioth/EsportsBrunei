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
        <link rel="stylesheet" href="assets/css/prof.css">
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


                <!-- <div class="auth-content" align="center" > -->
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?> 
                    <!-- <h1 class="page-title">Welcome to your profile</h1> -->
                </div> 
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
                        $created = $fetch['created_at'];
                    }
                    
                    ?>
            <!-- // page Content -->
            <form action="profile.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" >
    <div class="wrapper">
 
    <div class="left">
        <img src="<?php echo BASE_URL . '/assets/profile/' . $pic; ?>" 
        alt="user" width="75%" height="auto">
        <h3><i class="far fa-user-circle"></i> Profile Image</h3>
        <input type="file" name="image" class="text-input"  ></input>
        <br> 
        <div class="bio">
        <h3><i class="far fa-address-card"></i> Bio</h3>
         <textarea type="text" name="bio"  class="text-input" cols="30" rows="5"><?php echo $_SESSION['bio']; ?></textarea>
              </div>

        <!-- <div class="badges">
        <h3>Badges</h3>
        <img src="assets/profile_badge/b3.png" 
        alt="user" width="13%" height="auto">

        <img src="assets/profile_badge/b2.png" 
        alt="user" width="15%" height="auto">

        <img src="assets/profile_badge/b1.png" 
        alt="user" width="15%" height="auto">
        </div> -->
    </div>

    <div class="right">

        <div class="info">
            <h3><i class="fas fa-info-circle"></i> Information</h3>
            <div class="info_data">
                 <div class="data">
                   <h4><i class="fas fa-at"></i> Username</h4>
                   <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" class="text-input" style = "text-align:center;">
              </div>
            </div>
            <div class="info_data">
                 <div class="data">
                    <h4>Email <i class="far fa-envelope"></i></h4>
                    <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" class="text-input" style = "text-align:center;" >
                 </div>
                 <div class="data">
                   <h4>Phone <i class="fas fa-phone"></i></h4>
                   <input type="number" name="phone_number" value="<?php echo $phone_number; ?>" class="text-input" style = "text-align:center;" >
              </div>
            </div>
            <div class="info_data">
                 <div class="data">
                    <h4>password <i class="fas fa-key"></i></h4>
                    <input type="password" name="password" Placeholder = "Please re-enter your password to avoid errors" class="text-input" style = "text-align:center;" required></input>
                 </div>
                 <div class="data">
                   <h4>confirm password <i class="fas fa-key"></i></h4>
                   <input type="password" name="passwordConf"  class="text-input" style = "text-align:center;" required></input>
              </div>
            </div>
        </div>

      <div class="projects">
        <div class="links">
            <h3><i class="fas fa-user-plus"></i> Social Media</h3>
            <ul>
            <li><a href="#"><i class="fab fa-steam"></i></a></li>
              <li style="width:250px;"><input type="text" name="steam" value="<?php echo $steam; ?>" class="text-input" style = "text-align:center;"></li>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              <li style="width:160px;"><input type="text" name="instagram" value="<?php echo $instagram; ?>" class="text-input" style = "text-align:center;"></li>
              <li><a href="#"><i class="fab fa-discord"></i></a></li>
              <li style="width:160px;"><input type="text" name="discord" value="<?php echo $discord; ?>" class="text-input" style = "text-align:center;"></li>
          </ul>
          </div>
      </div>

      <div class="edit">
       <a href="<?php echo BASE_URL . '/profile.php' ?>" class="batn">Cancel Update</a>
      </div>
      <div class="update">
      <button type="submit" name="update-profile" class="batn">Update Profile</button>
       </div>
    </form>
      
    </div>
</div>

        
        <!-- // Page Wrapper -->
        </div>

        <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="assets/js/scripts.js"></script>
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
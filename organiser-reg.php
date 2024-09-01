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
        <link rel="stylesheet" href="assets/css/org.css">
        <!-- page Styling -->
        <!-- <link rel="stylesheet" href="assets/css/page.css"> -->

        <title>Esport Brunei - Organiser Registration</title>
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
                        $proof = $fetch['proof'];
                        $details = $fetch['details'];
                        $phone_number = $fetch['phone_number'];
                        $instagram = $fetch['instagram'];
                        $steam = $fetch['steam'];
                        $discord = $fetch['discord'];
                        $created = $fetch['created_at'];
                        $username = $fetch['username'];
                        $email = $fetch['email'];
                    }
                    
                    ?>
                    
            <!-- // page Content -->
    <form action="organiser-reg.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" >
<div class="wrapper">
 
    <div class="left">
     <div class="users">
     <img src="<?php echo BASE_URL . "/assets/logo/logo3.png" ?>" style="width:45%;" align="center" >
        <h5>User Organiser details: </h5>
        <img src="<?php echo BASE_URL . '/assets/proof/' . $proof; ?>" class="rounded" style="max-width:50%;"  alt="Organiser Proof Image">
        <?php echo html_entity_decode($details); ?>
      </div>   
    </div>

    <div class="right">

        <div class="info">
            <h3><i class="fas fa-info-circle"></i> Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Username <i class="far fa-user"></i></h4>
                    <p>@ <?php echo $username; ?> </p>
                    <input type="hidden" name="username" value="<?php echo $username; ?>" class="text-input" style = "text-align:center;" readonly>
                 </div>
                 <div class="data">
                 <h4>Email <i class="far fa-envelope"></i></h4>
                   <p><?php echo $email; ?> </p>
                   <input type="hidden" name="email"  value="<?php echo $email; ?>" class="text-input" style = "text-align:center;" readonly>
              </div>
              <div class="data">
                   <h4>Phone <i class="fas fa-phone"></i></h4>
                    <p>+673 <?php echo $phone_number; ?></p>
              </div>
            </div>
        </div>
      
        <div class="projects">
            <h3><i class="far fa-image"></i> Upload Proof Of organiser to be checked by the moderator/s : </h3>
            <div class="projects_data">
                 <div class="data">
                 <input type="file" name="image" class="text-input" ></input>
                 </div>
            </div>
        </div>

      <div class="projects">
            <h3><i class="fas fa-paragraph"></i> Enter your Organiser Details here : </h3>
            <div class="projects_data">
                 <div class="data">
                 <textarea name="details" id="body" ><?php echo $details ?></textarea>
                 </div>
            </div>
        </div>

      <div class="update">
      <button type="submit" name="organiser-register" class="batn" >Upload Organiser Detail</button>
      </div>
      
    </div>
</div>

        
        <!-- // Page Wrapper -->
        </div>
  </form>
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
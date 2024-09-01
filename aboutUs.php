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
        <link rel="stylesheet" href="assets/css/about.css">
        <!-- page Styling -->
        <!-- <link rel="stylesheet" href="assets/css/page.css"> -->

        <title>Esport Brunei - About Us</title>
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
                    
            <!-- // page Content -->
<div class="wrapper">
 
    <div class="left">
    <img src="<?php echo BASE_URL . "/assets/logo/logo3.png" ?>" style="width:70%;" align="center" >
    <h2>What is Esport BN ?</h2>
                <p>It is a website developed 
                    to satisfy the needs of a user that could not 
                    only just advertise but also to allow players 
                    get updated news of Bruneian gaming in the Bruneian gaming community . 
                    Furthermore , Esports BN becomes a one way for users to register for 
                    events that are available for them to join to .
                </p>
    </div>

    <div class="right">

        <div class="info">
            <h3><i class="far fa-newspaper"></i> Forums</h3>
            <div class="info_data">
                 <div class="links">
                    <p>In the forum, the community will be posting  news, strategies and events that are upcoming. </p>
                    <br>
                    <div class="view">
                        <a href="<?php echo BASE_URL . '/index.php' ?>" class="btn">View Forums</a>
                    </div>
                 </div>
            </div>
        </div>
      
      <div class="projects">
            <h3><i class="fas fa-trophy"></i> Event Creations</h3>
            <div class="projects_data">
                 <div class="links">
                 <p>Want to organise a tournament or gaming event? Be part of the team by becoming an Organiser and you will be able to host/organise this event. Organiser can also look for volunteers through the help of this platform. </p>
                 <br>
                 <div class="view">
                 <a href="<?php echo BASE_URL . '/eventsPage.php' ?>" class="btn">View Events</a>
                    </div>
                 </div>
            </div>
        </div>
      <div class="projects">
        <div class="links">
            <h3><i class="fas fa-users"></i> Teams</h3>
            <p>Our website allows users to create teams/squad for them to able to register for events in the event page</p>
            <br>
            <div class="view">
            <a href="<?php echo BASE_URL . '/Team-profile.php' ?>" class="btn">View Teams</a>
            </div>
          </div>
      </div>      
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
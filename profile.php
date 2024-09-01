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
                    $participants = "SELECT * FROM `payments` as p 
                    inner join users as u on p.user_id = u.id
                    inner JOIN events as e on e.id = p.product_id where u.id = $id";

                    ?>
                    
            <!-- // page Content -->
<div class="wrapper">
 
    <div class="left">
     <div class="users">
        <img src="<?php echo BASE_URL . '/assets/profile/' . $pic; ?>" 
        alt="user" width="75%" height="auto">
        <h1><i class="fas fa-at"></i> <?php echo $_SESSION['username']; ?></h1>
         <p><?php echo $_SESSION['bio']; ?></p>
      </div>   
      
         <div class="summoned">
            <h4><i class="fa fa-gamepad"></i> Summoned on</h4>
            <p><?php echo date('F j, Y', strtotime($created)); ?></p>
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
                    <h4>Email <i class="far fa-envelope"></i></h4>
                    <p><?php echo $_SESSION['email']; ?> </p>
                 </div>
                 <div class="data">
                   <h4>Phone <i class="fas fa-phone"></i></h4>
                    <p>+673 <?php echo $phone_number; ?></p>
              </div>
            </div>
        </div>
      

      <div class="projects">
            <h3><i class="fas fa-trophy"></i> Achievements</h3>
            <div class="projects_data">
                 <div class="data">
                   <?php $res = mysqli_query($conn, $participants);
                          if (!empty($res)){
                            if(mysqli_num_rows($res) > 0){
                              $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                   ?>
                   <table>
                     <thead>
                    <th><h4><i class="fas fa-certificate"></i> Events Joined:</h4></th>
                    <th><h4><i class="far fa-calendar-check"></i> Joined:</h4></th>
                    <th><h4><i class="fas fa-users-cog"></i> Category:</h4></th>
                    <th><h4><i class="fas fa-file-invoice-dollar"></i> Invoice:</h4></th>
                  </thead>
                    <?php                          
                          foreach ($fetch as $key => $participant){   ?>
                    <tr>
                    <td><p><a href="eventSingle.php?id=<?php echo $participant['id']; ?>"><?php echo $key + 1; ?>. <?php echo $participant['title']; ?></a></p></td>
                    <td><p><?php echo date('F j, Y', strtotime($participant['created'])); ?></p></td>
                    <td><p><?php echo $participant['category']; ?></p></td>
                    <td><p><a href="app/payment/payment-status.php?id=<?php echo $participant['paymentid']; ?>">View</a></p></td>
                      </tr>
                    <?php
                                        } 
                                    } else { ?>
                                      <p>You have not participated in any events yet...</p>
                                   <?php  }
                                  ?>
                   </table>
                   <?php } ?>
                 </div>
            </div>
            
        </div>
        <div class="projects">
        <div class="links">
            <h3><i class="fas fa-user-plus"></i> Social Media</h3>
            <ul>
            <div class="data">
              
              <li><a href="https://steamcommunity.com/profiles/<?php echo $steam?>/"><i class="fab fa-steam"></i></a></li>
            </div>  

            <div class="data">
              <li><a href="https://www.instagram.com/<?php echo $instagram?>/"><i class="fab fa-instagram"></i></a></li>
            </div>
            
            <div class="data">
              <li style="width:160px;"><a href="#"><i class="fab fa-discord"></i> <?php echo $discord ?></a></li>
            </div>
          </ul>
        </div>
      </div>

      <div class="edit">
        <a href="<?php echo BASE_URL . '/edit-profile.php' ?>" class="batn">Edit Profile</a>
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
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
                

                    <h1 class="page-title">Welcome to your profile</h1>


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
                    

                    $participants = "SELECT * FROM `payments` as p 
                                    inner join users as u on p.user_id = u.id
                                    inner JOIN events as e on e.id = p.product_id where u.id = $id; ";
                    }
                    ?>
                    
                     

                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" >
                       
                        <div   >
                        <img src="<?php echo BASE_URL . '/assets/profile/' . $pic; ?>" height="100" width="100"/> 
                        </div>
                        <div > 
                            <h3>Username</h3>
                                <p><?php echo $_SESSION['username']; ?></p>
                        </div>
                        
                        <div>
                            <h3>Email</h3>
                          <p> <?php echo $_SESSION['email']; ?> </p>
                        </div>
                        <div>
                            <h3>Phone Number</h3>
                            <p> <?php echo $phone_number; ?> </p>
                        </div>
                        <div>
                            <h3>instagram</h3>
                            <a href = " <?php echo $instagram?> "><i class="fab fa-instagram"></i></a>
                        </div>
                        <div>
                            <h3>steam</h3>
                            <a href = " <?php echo $steam?> "><i class="fab fa-steam"></i></a>
                        </div>
                        <div>
                            <h3>discord</h3>
                            <p> <?php echo $discord; ?> </p>
                        </div>
                        <table>
                                  <thead>
                                      <th><h2>Events Participated</h2></th>
                                      <th><h2>Category</h2></th>
                                      <th><h2>joined</h2></th>
                                    </thead>
                              <?php 
                                $res = mysqli_query($conn, $participants);
                                  if(mysqli_num_rows($res) > 0){
                                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);

                                      foreach ($fetch as $key => $participant){   ?>
                                    <tr>
                                      <td><?php echo $key + 1; ?>. <?php echo $participant['title']; ?></td>
                                      <td><?php echo $participant['category']; ?></td>
                                      <td><?php echo date('F j, Y', strtotime($participant['created'])); ?></td>

                                    </tr>  
                                        <?php
                                        } 
                                    }
                                  ?>
                              </table>
                        <div>
                            <h3>Bio</h3>
                            <p> <?php echo $_SESSION['bio']; ?> </p>
                            <p>Gamer summoned on <?php echo date('F j, Y', strtotime($created)); ?></p>
                        </div>
                        <br>
                        <div>
                           <a href="<?php echo BASE_URL . '/edit-profile.php' ?>" class="btn btn-big">Edit Profile</a>

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
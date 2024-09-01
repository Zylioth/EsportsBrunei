<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/team-listing.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title> Esport Brunei - Team Listing </title>
  <link rel="icon" href="assets/logo/logo3.png">

</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
 
  <div class="sidebar-wrapper">
<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>



  <!-- Page Wrapper -->


    <!-- Content -->


      <!-- Main Content Wrapper -->
     
        <div class="auth-content">
        <center>
        <?php 
        $teamId2 = $_GET['id'];
                        $teamId = "SELECT * FROM users INNER JOIN teams ON users.id = teams.team_captain WHERE teams.id = $teamId2";
                        $res = mysqli_query($conn, $teamId); //run the query
                        if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC); //fetch all results from that column's name
                        foreach ($fetch as $teams){
                         echo "<h2>".$teams['team_name']."</h2>";
                         echo "<h2>Team Coach: ".$teams['team_coach']."</h2>";
                         echo "<h2>Team Creator: ".$teams['username']."</h2>";
                        }
                    }

                    echo "<br><button class=\"btn btn-big\"><a href=\"team-add.php?id=".$teamId2."\">Add Members</a></button><br><br>";
                    echo "<button class=\"btn btn-big\"><a href=\"team-edit.php?id=".$teamId2."\">View Members</a></button>";

                            ?>

                  </center>
              
           
      <!-- // Main Content -->


   
  <!-- // Page Wrapper -->
  </div>
  </div>
  <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Slick Carousel -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

  <script src="assets/js/comment.js"></script> <!-- Comment script -->

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
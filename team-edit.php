<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/team-listing.php');

// DELETE AREA
if (isset($_GET['id']) && isset($_GET['memberid'])){
  // if(count($errors) === 0){
    $addId = $_GET['memberid'];
    $teamId = $_GET['id'];
    $delete_data = "DELETE FROM team_members WHERE team_id = $teamId AND member_id = $addId";
    $data_check = mysqli_query($conn, $delete_data);
    if ($data_check){
          header('Refresh:3; url=team-edit.php?id="'.$teamId);
          echo "<h3>User has been deleted to the team!</h3>";
          exit();
          //set id on this php
        } else {
          echo "Error";
        }
      }?>

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

  <title> Esport Brunei - Adding Members </title>
  <link rel="icon" href="assets/logo/logo3.png">

</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
  <div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>


  <!-- Page Wrapper -->


    <!-- Content -->
 

      <!-- Main Content Wrapper -->
        <div class="auth-content" align="center">
          <h1 class="post-title">List of Users</h1>

          <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>


            <?php 
              
              $teamId = $_GET['id'];
              $teamMembers = "SELECT limit_members FROM teams WHERE id = $teamId";
                //echo the users that are not in the list
                $teamUserAdd = "SELECT * FROM users WHERE id IN ( SELECT member_id FROM team_members WHERE team_id = $teamId) AND admin = 0;";
                // $getId = "SELECT * FROM team_members INNER JOIN teams ON team_members.team_id = teams.id WHERE team_members.member_id = $userId";
                //"SELECT member_id FROM team_members"; 
                        $res = mysqli_query($conn, $teamUserAdd);
                        // $data_check = mysqli_query($conn, $getId);
                        if (!empty($res)){
                        if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                        // $obtain = mysqli_fetch_all($data_check,MYSQLI_ASSOC);
                        echo "<table>
                        <tr>
                        <th>View Users</th>
                        </tr>
                        ";
                        foreach ($fetch as $teams){
                          // foreach ($obtain as $team){
                        echo "<tr><td>".$teams['username']."</td>";
                         echo "<td class=\"btn btn-big\" name=\"submit\"><a href=\"team-edit.php?id=".$teamId."&memberid=".$teams['id']."\">Delete Member</a></td></tr>"; 
                        //  }
                      }
                     } else {
                        echo "It seems like there is an error, try again!";
                      }
                    } else {
                      echo "List is empty.";
                    }
                      
                      echo "
                      </table>";
                       ?>

                </div>
                </div>


           
  <!-- // Page Wrapper -->

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
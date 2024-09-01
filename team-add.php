<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/team-listing.php');

// PENDING AREA
if (isset($_GET['id']) && isset($_GET['memberid'])){

  $addId = $_GET['memberid'];
  $teamId = $_GET['id'];

  //Check limit of members
  $limit_data = "SELECT FROM teams WHERE team_creator AND team_coach =". $_SESSION['id'];
  $teamUserLimit = "SELECT * COUNT (users) WHERE id IN ( SELECT member_id FROM team_members WHERE team_id = $teamId) AND admin = 0;";
  $data_limit01 = mysqli_query($conn, $limit_data);
  $data_limit02 = mysqli_query($conn, $teamUserLimit);
  if ($data_limit01 < $data_limit02){
    echo "You reach the maximum number of team members you can add!";
  } else {
 $insert_data = "INSERT INTO pending (member_id, team, approval)
                 values('$addId','$teamId', '0')";
                    $data_check = mysqli_query($conn, $insert_data);

                    if ($data_check){
                      // echo "<h3>User added is now in the pending list.</h3>";
                      header('Refresh:3; url=team-add.php?id='.$teamId);
                      //set id on this php
                      echo "<h3>User added is now in the pending list.</h3>";
                      exit;
                    } else {
                      echo "There is an error occurring.";
                    }
                  }

//approval table
// if 0 = pending
// if 1 = accept
// if 2 = reject

}
?>

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
 <?php
$teamId = $_GET['id'];
 ?>

      <!-- Main Content Wrapper -->
        <div class="auth-content" align="center">
          <h1 class="post-title">List of Users</h1>

          <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

          
          <div class="section search">

          <form action="team-add.php?id=<?php echo $teamId?>" method="post">
          <input type="text" name="search-term" class="text-input" placeholder="Search User...">
          </form>
        </div>
<?php

// this area for usernames to add
              
              // $teamMembers = "SELECT limit_members FROM teams WHERE id = $teamId";
                //echo the users that are not in the list
                $teamUserAdd = "SELECT * FROM users WHERE id NOT IN ( SELECT member_id FROM team_members WHERE team_id = $teamId) AND admin = 0;";
                // $getId = "SELECT * FROM team_members INNER JOIN teams ON team_members.team_id = teams.id WHERE team_members.member_id = $userId";
                //"SELECT member_id FROM team_members"; 
                        $res = mysqli_query($conn, $teamUserAdd);
                        if (isset($_POST['search-term'])){

                          $searchU = $_POST['search-term'];
                          $searchUser = "SELECT * FROM users WHERE admin = 0 AND username LIKE '%$searchU%'  ORDER BY id ASC";
                
                        $resSearch = mysqli_query($conn, $searchUser);

                          if (!empty($resSearch)){
                          if(mysqli_num_rows($resSearch) > 0){
                            $fetchSearch = mysqli_fetch_all($resSearch,MYSQLI_ASSOC);
                            echo "<table>
                            <tr>
                            <th>Viewing Searched Users</th>
                            </tr>
                            ";
                            foreach ($fetchSearch as $teams){
                              // foreach ($obtain as $team){
                            echo "<tr><td>".$teams['username']."</td>";
                             echo "<td class=\"btn btn-big\" name=\"submit\"><a href=\"team-add.php?id=".$teamId."&memberid=".$teams['id']."\">Add Member</a></td></tr>"; 
                            //  }
                          }
                         } else {
                            echo "There is no one with that username.";
                          }
                        } else {
                          echo "There is no one with that username.";
                        }
                          
                          echo "
                          </table>";
                        } else {
                          if (!empty($res)){
                          if(mysqli_num_rows($res) > 0){
                          $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                          echo "<table>
                          <tr>
                          <th>View Users</th>
                          </tr>
                          ";
                          foreach ($fetch as $teams){
                            // foreach ($obtain as $team){
                          echo "<tr><td>".$teams['username']."</td>";
                           echo "<td class=\"btn btn-big\" name=\"submit\"><a href=\"team-add.php?id=".$teamId."&memberid=".$teams['id']."\">Add Member</a></td></tr>"; 
                          //  }
                        }
                       } else {
                          echo "It seems like there is an error, try again!";
                        }
                      } else {
                        echo "List is empty.";
                      }
                        
                        echo "
                        </table>";}
                        
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
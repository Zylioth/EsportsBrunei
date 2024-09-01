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
          echo "<h3>User has been deleted to the team!</h3>";
          exit();
          header('Location: team-edit.php?id="'.$teamId.'">');
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

  <title> Esport Brunei - Viewing Members in Team </title>
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

          <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
  <div class="main-content">

            <?php 
              
              $teamId = $_GET['id'];
                //echo the users that are not in the list
                $teamUserAdd = "SELECT * FROM users WHERE id IN ( SELECT member_id FROM team_members WHERE team_id = $teamId) AND admin = 0;";
                        $res = mysqli_query($conn, $teamUserAdd);
                        if (!empty($res)){
                        if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                        echo "
                        <h2 class=\"page-title\" style='border-style:solid' >View Team Members</h2>
                        <table>
                        ";

                        $image_check = "SELECT * FROM teams WHERE id = '$teamId'";
                        $resImage = mysqli_query($conn, $image_check);
                        if(mysqli_num_rows($resImage) > 0){
                            $fetchImg = mysqli_fetch_assoc($resImage);
                            $pic = $fetchImg['team_logo']; 
                        }

                        $teamName = "SELECT * FROM users INNER JOIN teams ON users.id = teams.team_captain WHERE teams.id = $teamId";
                        $resName = mysqli_query($conn, $teamName); //run the query
                        if(mysqli_num_rows($resName) > 0){
                        $fetchName = mysqli_fetch_all($resName,MYSQLI_ASSOC); //fetch all results from that column's name
                        foreach ($fetchName as $team){
                          echo "<h2>Team ".$team['team_name']."</h2>";
                          echo '<img src='.BASE_URL.'/assets/team_logo/'.$pic." style = 'max-width:50%;max-height:50%;' >";
                         echo "<h3>Team Coach: ".$team['team_coach']."</h3>";
                        }
                    }
                    echo "<br><thead>
                    <th colspan=\"3\">Members</th>
                    </thead>";
                        foreach ($fetch as $teams){
                          // foreach ($obtain as $team){
                        echo "<tbody><tr>
                        <td>".$teams['username']."</td>";
                      }
                     } else {
                        echo "It seems like there is an error, try again!";
                      }
                    } else {
                      echo "List is empty.";
                    }
                      
                      echo "</tbody>
                      </tr>
                      </table><br><br>";
                       ?>

<?php 
//Event Achivements
$teamId = $_GET['id'];
$participants = "SELECT *, p.id as paymentid  FROM payments as p
                        inner join teams as t on p.team_id = t.id
                        inner JOIN events as e on e.id = p.product_id where t.id = $teamId; ";
$res = mysqli_query($conn, $participants);
                          if (!empty($res)){
                            if(mysqli_num_rows($res) > 0){
                              $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                              foreach ($fetch as $key => $participant){
                               ?>
                               <table style='border: 1px solid black';>
                               <thead style='border: 1px solid black';>
                            <th style='border: 1px solid black';>Events Previously Joined</th>
                            <th style='border: 1px solid black';>Date</th>
                        </thead>
                        <tbody>
                              <tr style='border: 1px solid black';>
                              <td ><p><a href="eventSingle.php?id=<?php echo $participant['id']; ?>"><?php echo $key + 1; ?>. <?php echo $participant['title']; ?></a></p></td>
                              <td><p><?php echo date('F j, Y', strtotime($participant['created'])); ?></p></td>
                                </tr>
                              </tbody>
                              </table>
                              <?php 
                              }
                                                  } 
                                              } else { ?>
                                                <h3>The team have not participated in any events yet...</h3>
                                             <?php  }
                   ?>


  </div>
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
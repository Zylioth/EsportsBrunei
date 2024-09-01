<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/events.php');


// if (isset($_GET['id'])) {
//   $post = selectOne('events', ['id' => $_GET['id']]);
// }
// $topics = selectAll('topics');
// $posts = selectAll('events', ['published' => 1]);


// To get session of Events by id

if (isset($_GET['id'])) {
  $post = selectOne('events', ['id' => $_GET['id']]);
  $_SESSION['postid'] = $_GET['id'];
}
$topics = selectAll('topics');
$posts = selectAll('events', ['published' => 1]);

$_SESSION['postid'] = $_GET['id'];
?>


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

  <title> Esport Brunei - <?php echo $post['title']; ?> </title>
  <link rel="icon" href="assets/logo/logo3.png">

</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">
  <div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>
    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content Wrapper -->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title']; ?></h1>

           
            <div class="text-center">
              <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="rounded" style="max-width:100%;" alt="...">
            </div>
           

          <div class="post-content">

              <!-- will show price for tournaments based on the category (solo/team) -->

              <?php 
              //limit to only one registration for single user
              if (isset($_SESSION['id'])){

               $id = $_GET['id'];
               $uid = $_SESSION['id'];
                 
               $user = "SELECT COUNT(*) as u FROM payments WHERE product_id= $id and user_id = $uid";
               $query_test = mysqli_query($conn, $user);
               $userid = mysqli_fetch_assoc($query_test);
              }
               //counter for user participants
                $query = "SELECT COUNT(*) as p FROM payments WHERE product_id= $id and payment_status='approved'";
                $query_run = mysqli_query($conn, $query);

                $total_ikut = mysqli_fetch_assoc($query_run);
                
                //counter for team user participants
                 $queryteam = "SELECT COUNT(*) as total_player FROM teams as t 
                 INNER JOIN team_members as tm ON t.id = tm.team_id 
                 INNER JOIN payments as p ON p.team_id = t.id 
                 WHERE product_id = $id AND payment_status = 'approved' ";
                 $query_run_team = mysqli_query($conn, $queryteam);
 
                 $total_ikut_team = mysqli_fetch_assoc($query_run_team);
              
              ?>  
              <!-- participant counter for solo -->
            <?php if ($post['category'] == 'Solo') { ?>
              <h3>Available slots :  <?php echo $total_ikut['p']; ?> / <?php echo $post['participant_limit']; ?> 
              <br>
              <a href="partlist.php?id=<?php echo $post['id']; ?>" class="btn" >View participants</a></h3>
              <?php } ?>
              <!-- participant counter for team -->
              <?php if ($post['category'] == 'Team') { ?>
              <h3>Available slots :  <?php echo $total_ikut_team['total_player']; ?> / <?php echo $post['participant_limit']; ?> 
              <br>
              <a href="partlist.php?id=<?php echo $post['id']; ?>" class="btn" >View participants</a></h3>
              <?php } ?>
              <br>

              <h3>Tournament Category :</h3>
              <p> <?php echo $post['category'] ?> </p>

              <h3>Registration Fees :</h3>

              <p> <?php echo $post['s_price'] ?> <?php echo $post['currency'] ?> </p>

              <h3>Event Description :</h3> 

              <p><?php echo html_entity_decode($post['body']); ?></p>

              <!-- <h3>Availability to join</h3>  -->
          </div>
 <?php 
            //if already logged in
          if (isset($_SESSION['id'])) {
            // solo event registration conditions
              if ($post['category'] == 'Solo'){
                // if have not registered event
                  if ($userid['u'] < 1 && isset($_SESSION['id'])) { ?>
                        <a href="app/payment/checkout.php?id=<?php echo $post['id'];?>&teamid=0 " class="btn btn-big" >Register for this event</a>  
              <?php
              // if event is full 
             } else if ($total_ikut['p'] >= $post['participant_limit']){ ?>
                      <h1>Registration for this event is full</h1>
              <?php
              // if already registered for event
             } else { ?>
                       <h3>You have already registered for this event</h3>
              <?php   }
              }
             // team query check team captain and also team id ?
             $teamcaptain = "SELECT * , t.id as teamid , t.team_name as teamname FROM TEAMS as t
                     INNER JOIN USERS AS u ON u.id = t.team_captain
                     WHERE team_captain = $uid ";
                     $res = mysqli_query($conn, $teamcaptain);
                            if(mysqli_num_rows($res) > 0){
                                $fetch = mysqli_fetch_assoc($res);
                                $captain = $fetch['team_captain'];
                                $creator = $fetch['team_creator'];
                                $teamid = $fetch['teamid'];
                                $teamname = $fetch['teamname'];

                    // query for number of teams the team captain have
                    $userteams = "SELECT *, t.id as teamid FROM teams AS t 
                                    INNER JOIN users as u on u.id = t.team_captain
                                    INNER JOIN team_members as tm on tm.team_id = t.id
                                    WHERE team_captain = $uid ";
                    $result = mysqli_query($conn, $userteams);
                            if(mysqli_num_rows($result) > 0){
                              $team = mysqli_fetch_all($result,MYSQLI_ASSOC); 
                            }

              // team event registration conditions
              if ($post['category'] == 'Team'){
                // if not a team captain
                if($captain != $uid && $creator != $uid){
                  echo "you are a not a team captain";
                } else {
                  // if user is a team captain and have not registered this event for team
                if ($userid['u'] < 1 && isset($_SESSION['id'])) {
                  foreach($team as $key => $teams){ ?>
                    <br><br> <a href="app/payment/checkout.php?id=<?php echo $post['id'];?>&teamid=<?php echo $teams['teamid']; ?> " class="btn btn-big" >Register for <?php echo $teams['team_name']; ?></a><br> 
         <?php  }  // if event is full
                } else if ($total_ikut_team['total_player'] >= $post['participant_limit']){ ?>
                      <h1>Registration for this event is full</h1> <?php
                  // if already registered
              } else { ?>
                       <h3>You have already registered your team for this event</h3> <?php 
              }
            } 
          }

              }
          } // if user is not logged into website
          else { ?>
                  <a href=" <?php echo BASE_URL . '/login-user.php' ?> " class="btn btn-big">Login/Signup to register for this event</a>
        <?php  } ?>

      </div>
      
      <!-- // Main Content -->

      

    </div>
    <!-- // Content -->

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
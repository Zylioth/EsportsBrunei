<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/events.php');
require (ROOT_PATH . "/app/database/connect.php");

// CODES FOR PARTICIPANTS
$eventid = $_GET['id'];

$participants = "SELECT `username`,`created` FROM `payments` as p 
inner join users as u on p.user_id = u.id
inner JOIN events as e on e.id = p.product_id where e.id = $eventid
";

$teamparticipants = "SELECT team_name,created FROM payments as p 
inner join users as u on p.user_id = u.id
inner join teams as t on t.id = p.team_id
inner JOIN events as e on e.id = p.product_id 
where e.id = $eventid";
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
              <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="rounded" style="max-width:30%;" alt="...">
            </div>
           

          <div class="post-content">
                                   <!-- CODES FOR PARTICIPANTS -->
                                <table>
                                  <thead>
                                    <?php if ($post['category'] == 'Solo') { ?>
                                      <th ><h2>Participants</h2></th>
                                      <th ><h2>Registered</h2></th>
                                      <?php }?>

                                      <?php if ($post['category'] == 'Team') { ?>
                                      <th ><h2>Team Participated</h2></th>
                                      <th ><h2>Registered</h2></th>
                                      <?php }?>

                                    </thead>
                              <?php 

                              if ($post['category'] == 'Solo') {
                                $res = mysqli_query($conn, $participants);
                                  if(mysqli_num_rows($res) > 0){
                                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);

                                      foreach ($fetch as $key => $participant){   ?>
                                    <tr>
                                      <td><?php echo $key + 1; ?>. <?php echo $participant['username']; ?></td>
                                      <td><?php echo date('F j, Y', strtotime($participant['created'])); ?></td>
                                    </tr>  
                                        <?php
                                        } 
                                    }
                                  }

                              if ($post['category'] == 'Team') {
                                $res = mysqli_query($conn, $teamparticipants);
                                  if(mysqli_num_rows($res) > 0){
                                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);

                                      foreach ($fetch as $key => $participant){   ?>
                                    <tr>
                                      <td><?php echo $key + 1; ?>. <?php echo $participant['team_name']; ?></td>
                                      <td><?php echo date('F j, Y', strtotime($participant['created'])); ?></td>
                                    </tr>  
                                        <?php
                                        } 
                                    }
                                  }
                                  ?>
                              </table>
        </div>
        </div>
        <h4><a href="eventsingle.php?id=<?php echo $post['id']; ?>" class="btn btn-big">back</a></h4>
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
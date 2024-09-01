<?php include("../../path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/events.php');
require (ROOT_PATH . "/app/database/connect.php");

// CODES FOR PARTICIPANTS
$eventid = $_GET['id'];

$participants = "SELECT * FROM `payments` as p 
inner join users as u on p.user_id = u.id
inner JOIN events as e on e.id = p.product_id where e.id = $eventid
";

$teamparticipants = "SELECT team_name,created FROM payments as p 
inner join users as u on p.user_id = u.id
inner join teams as t on t.id = p.team_id
inner JOIN events as e on e.id = p.product_id 
where e.id = $eventid";
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
        <link rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
            crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>


        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../assets/css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Moderator Section - participant list</title>
        <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/moderatorHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/moderatorSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add Events</a>
                    <a href="index.php" class="btn btn-big">Manage Events</a>
                </div>


                <div class="content">

                    <h2 class="page-title">Manage Events</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    
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
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

    </body>

</html>
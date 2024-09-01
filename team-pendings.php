<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/team-listing.php");
// UsersOnly();
$userId = $_SESSION['id'];
$teamCheck = "SELECT * FROM team_members WHERE member_id = '$userId'";
                        $res = mysqli_query($conn, $teamCheck);
                        if(mysqli_num_rows($res) < 1){
                        header("Location: team-registration.php");
                        exit;
                        }

                        // ADD AREA
    if (isset($_GET['id']) && isset($_GET['memberid-add'])){

      //PENDING ADJUSTMENT
      $adjust_data = "UPDATE pending SET approval = 1 WHERE member_id =". $_SESSION['id'];
      $accepted_data = mysqli_query($conn, $adjust_data);
    
        $addId = $_GET['memberid-add'];
        $teamId = $_GET['id'];
        $insert_data = "INSERT INTO team_members (team_id, member_id)
                             values('$teamId','$addId')";
            $data_check = mysqli_query($conn, $insert_data);
    
            $removal = "DELETE FROM pending WHERE member_id =". $_SESSION['id'];
            $remove_data = mysqli_query($conn, $removal);
    
            if ($data_check){
              if ($accepted_data){
                if ($remove_data){
              header('Refresh:3; url=Location: team-pendings.php');
              echo "<h3>You have joined the team! It'll reflect your current team list.</h3>";
                          exit;
            }
            }
        } else {
              echo "Error";
            }
          }
            
      // REJECT AREA
      if (isset($_GET['id']) && isset($_GET['memberid-reject'])){
    
          // $teamId = $_GET['id'];
          
          $insert_data = "DELETE FROM pending WHERE member_id =". $_SESSION['id'];
          $data_check = mysqli_query($conn, $insert_data);
              if ($data_check){
                echo "<h3>You have rejected this team's offer. It will send a notification to the team captain on your rejection.</h3>";
                header('Location: team-pendings.php');
                exit();
              } else {
                echo "Error";
              }
            }

?>

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

        <!-- Admin Styling -->

        <title>Esport Brunei - Pending Area</title>
        <link rel="icon" href="assets/logo/logo3.png">

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="page-wrapper">
        <div class="sidebar-wrapper">

        <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

                <div class="auth-content" align="center">

                    <h2 class="page-title">Teams Joined : </h2>
                    

                    <div class="main-content">
                        
                        <?php 

                        //Current Teams Joined

                        $teamId = "SELECT * FROM team_members INNER JOIN teams ON team_members.team_id = teams.id where team_members.member_id = $userId";
                        $res = mysqli_query($conn, $teamId);
                        if(mysqli_num_rows($res) > 0){
                        // $teamNumber = "Team"; 
                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                        foreach ($fetch as $teams){
                            //I forgotten that it requires double quotation marks I am so sorry
                         echo "<br><h2 class=\"btn btn-big\"><a href=\"team-no-view.php?id=".$teams['team_id']."\">TEAM ".$teams['team_name']."</a></h2>";
                        }
                    }
                            ?>
                            <br><br>
                            <h2>Pending Invitations : </h2>

                            

                            <?php 

                        //FIND THE PENDING TABLE

                // $teamId = $_GET['id'];
                //echo the pending teams
                $teamPending = "SELECT *, p.id as pendingteamid FROM pending as p 
                INNER JOIN teams as t on t.id = p.team
                WHERE p.member_id =". $_SESSION['id'];
                        $res = mysqli_query($conn, $teamPending);
                        if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_all($res,MYSQLI_ASSOC);
                        echo "<table>
                        ";
                        foreach ($fetch as $teams){
                        echo "<th> From : ".$teams['team_name']."</th>";
                         echo "<tr><td class=\"btn btn-big\" name=\"submit\"><a href=\"team-pendings.php?id=".$teams['id']."&memberid-add=".$teams['member_id']."\">Accept</a></td>"; 
                         echo "<td class=\"btn btn-big\" name=\"submit\"><a href=\"team-pendings.php?id=".$teams['id']."&memberid-reject=".$teams['member_id']."\">Reject</a></td></tr>";
                        }
                      } else {
                      echo "There is nothing pending available.";
                    }
                      
                      echo "
                      </table>";
                       ?>
                        
                        </div>
                    </div>
                </div>

            </div>
            <!-- // Admin Content -->

        </div>
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

    </body>
</html>
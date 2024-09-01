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

        <!-- Admin Styling -->

        <title>Esport Brunei - Profile</title>
        <link rel="icon" href="assets/logo/logo3.png">

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

        <!-- Wrapper -->
        <div class="sidebar-wrapper">

            <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

                <div class="auth-content" align="center">

                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <h2 class="page-title" >Team Menu</h2>
                    

                    <div class="main-content">
                        
                        <h3 class="btn btn-big"><a href="team-profile.php">Teams Management</a></h3>
                        <h3 class="btn btn-big"><a href="team-pendings.php">Current Teams Joined</a></h3>
                        
            <!-- //  Content -->

        </div>
                    </div>
                    </div>
                    </div>
                </div>

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

    <!-- Invitation (requirement) + search function + add team members
team member table - requires the id, team_id (from teams table), member_id (user_id)
insert query - team captain insert to team members table

receive invitation -> invitation table (approval/reject)
if approved, move to team member table
reject -> status to reject 
user profile -> add team invitation


LIST OF LINKS

1) Team Registration = Limit 2/3/5/8 members (DONE)
2) Team Profile Page = 
a) List of all users (add member) ( must be not in the team )
b) Team Profile Page (delete member) ( list in a certain team )

(Members)
SELECT *
FROM users
WHERE user_id = (
    SELECT user_id 
    FROM team_members where id = teamid);

(Non-Members)
SELECT *
FROM users
WHERE user_id != (
    SELECT user_id 
    FROM team_members where id = teamid);

List out teams -> 2/3 list of teams

Captain -- remove player/delete team
Add member -- Insert
Delete member -- Delete

Cannot edit team name or number of members




list of teams-->



</html>
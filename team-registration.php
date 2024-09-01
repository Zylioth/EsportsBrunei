<?php include("path.php"); ?>
<?php require "team-userData.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Esport Brunei - Team Registration</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/tukverify.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/logo/logo3.png">


</head>
<body>
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="team-registration.php" method="POST" autocomplete=""  enctype="multipart/form-data">
                    <h2 class="text-center">Team Registration Form</h2>
                    <p class="text-center">Register a team to become official for tournament sign ups!</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                    
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="teamName" placeholder="Team Name" required value="<?php echo $teamName ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="teamCoach" placeholder="Team Coach's Name" required>
                    </div>
                    <div class="form-group">
                    <label for="limit">Member Limit: </label>
                        <select name="limit" required>
                            <option value=2>2</option>
                            <option value=3>3</option>
                            <option value=5>5</option>
                            <option value=8>8</option>
                         </select>
                    </div>
                    <div class="form-group">
                    <label for="image">Team Logo</label>
                        <input class="form-control" type="file" name="image" placeholder="Team Logo" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="teamReg" value="Register Team">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

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
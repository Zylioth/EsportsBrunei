<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php");
 require "app/database/connect.php";

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



  <title>Esport Brunei - Organiser Registration</title>
  <link rel="icon" href="assets/logo/logo3.png">

</head>

<body>
  

<?php include(ROOT_PATH . "/app/includes/header.php"); ?>


  <div class="auth-content">
  <div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>
    <?php
       // to get user details by fetching user punya database table 
        $id = $_SESSION['id'];
        $email_check = "SELECT * FROM users WHERE id = '$id'";
        $res = mysqli_query($conn, $email_check);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $username = $fetch['username'];
            $email = $fetch['email'];
            $proof = $fetch['proof'];
            $details = $fetch['details'];

            // $pic = $fetch['pic'];
        } 
               
    ?>
    <form action="organiser-reg.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" >
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
      <h1 class="form-title" align="center">Become an Organiser</h1>      

      <div align="center">
        <h3>Organiser Name</h3>
        <h2><?php echo $username; ?></h2>
        <input type="hidden" name="username" value="<?php echo $username; ?>" class="text-input" style = "text-align:center;" readonly>
      </div>

      <div align="center">
        <h3>Organiser Email</h3>
        <h2><?php echo $email; ?></h2>
        <input type="hidden" name="email"  value="<?php echo $email; ?>" class="text-input" style = "text-align:center;" readonly>
      </div>

      <div >  
      <h3 align="center" >Enter your Oraniser Details here</h3>          
          <textarea name="details" id="body" ><?php echo $details ?></textarea>
      </div>

      <div>
        <h3 align="center" >Upload an image of your organiser details</h3>
        <input type="file" name="image" class="text-input" ></input>
        </div>

        <div class="text-center" style="max-width:100%; " align="center">
        <h3 >Proof :</h3>
        <img src="<?php echo BASE_URL . '/assets/proof/' . $proof; ?>" class="rounded" style="max-width:50%;"  alt="Organiser Proof Image">
         </div>
         
      <div align="center">
        <button type="submit" name="organiser-register" class="btn btn-big" >Register</button>
      </div>

    </form>

  </div>
  <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <!-- Ckeditor -->
   <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

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
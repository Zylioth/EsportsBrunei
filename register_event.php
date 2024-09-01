<?php include("path.php"); 
include(ROOT_PATH . "/app/controllers/users.php"); 
require "app/database/connect.php";
?>
<!DOCTYPE html>
<html>
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

        <!-- page Styling -->
        <!-- <link rel="stylesheet" href="assets/css/page.css"> -->

        <title>Esport Brunei - Event Register Page</title>
        <link rel="icon" href="assets/logo/logo3.png">

</head>
<body>
      
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>

<!-- page Page Wrapper -->
<div class="page-wrapper">

<div class="sidebar-wrapper">

<?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

</div>

<div class="auth-content" align="center" >

<form action="app/controllers/payment.php" method="post">
<div>
<h4>Type Registration: </h4>
<!--- REGISTRATION --->
<select name="registration" id="registration" class="text-input">
  <option value="solo">Solo Registration</option>
  <option value="team">Team Registration</option>
</select>
</div>
<div>
  <h4>Type: </h4>
<!--- GAME_ENTERING --->
<select name="item_name" id="item_name" class="text-input">
  <option value="CS">CS:GO</option>
  <option value="DOTA">DOTA</option>
  <option value="VALORANT">VALORANT</option>
  <option value="LOL">League Of Legends</option>
  <option value="rocketleague">Rocket League</option>
  <option value="fifa">FIFA</option>
</select>
</div>
<div>
<!-- <h4>Paypal Email: </h4> -->
<!--- EMAIL TO SEND --->
<input type="hidden" name="payer_email" class="text-input" value ="sb-e4vyr8091156@business.example.com">
</div>
<div>
<!--- AMOUNT--->
<h4>Amount:</h4>
 <input type="number" name="amountSent" class="text-input">
<!-- dunno what the bottom ones do but it's best not to touch unless necessary-->
        <input type="hidden" name="cmd" value="_xclick"/>
        <input type="hidden" name="no_note" value="1"/>
        <input type="hidden" name="lc" value="BN"/>
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest"/>
        <!-- <input type="hidden" name="first_name" value="Customer's First Name"/>
        <input type="hidden" name="last_name" value="Customer's Last Name"/> -->
        <!-- below here is the example email which is use for sandbox purposes-->
        <!-- <input type="hidden" name="example" value="sb-fqdiq6294203@business.example.com"/> -->
        <!-- <input type="hidden" name="receiver_email" value="sb-e4vyr8091156@business.example.com"/> -->
        <!-- above here is the example email which is use for sandbox purposes-->
        <input type="hidden" name="item_number" value="01" />
</div>
<div>
    <button type="submit" name="submit" class="btn btn-big">Submit Payment</button>
</div>
</form>
</div>
</div>
<?php include(ROOT_PATH . "/app/includes/footer.php"); ?>

<!-- JQuery -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Ckeditor -->
<script
    src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
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
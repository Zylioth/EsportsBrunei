
<?php include("path.php"); ?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Esport Brunei - Help Page</title>
  <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/contact.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body >
<?php include(ROOT_PATH . "/app/includes/header.php"); ?>
<div class="sidebar-wrapper">

      <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>
      <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
      
  <div  class="wrapper">
<div class="left">
<img src=<?php echo BASE_URL . "/assets/logo/logo3.png" ?> alt="user" width="75%" height="auto"></img>
<h2>Send us an message if theres any.. or contact us at :</h2>
<h3><a href="tel:7258975" ><i class="fas fa-phone"></i> +673 7258975</a></h3>
</div>

<div class="right">
    <form action="#">
      <div class="info_data">
        <div class="field">
          <h3><i class='fas fa-user'></i> Enter your name : </h3>
          <input type="text" name="name" placeholder="Enter your name" class="text-input" >
        </div>
        <div class="field">
        <h3><i class='fas fa-envelope'></i> Enter your email : </h3>
          <input type="text" name="email" placeholder="Enter your email" class="text-input">
        </div>
      </div>

      <div class="info_data">
        <div class="field">
        <h3><i class='fas fa-phone'></i> Enter your phone number : </h3>
          <input type="text" name="phone" placeholder="Enter your phone" class="text-input"></input>

        </div>
        <div class="field">
        <h3><i class='fas fa-globe'></i> Enter your website : (Optional)</h3>
          <input type="text" name="website" placeholder="Enter your website (optional)" class="text-input">
        </div>
      </div>

      <div class="message">
      <h3>Enter your message here :</h3>
        <textarea placeholder="Write your message" name="message" class="text-input"></textarea>
      </div>
      <br>
      <div class="button-area">
        <button type="submit" class="btn">Send Message</button>
      <a href="<?php echo BASE_URL . '/index.php' ?>" class="btn"> cancel </a> 
        <span></span>
      </div>
    </form>
    </div>
</div>
  </div>

  <script src="ContactUs/script.js"></script>
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

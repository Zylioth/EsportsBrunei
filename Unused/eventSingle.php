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
               $id = $_GET['id'];
                $query = "SELECT COUNT(*) as p FROM payments WHERE product_id= $id and payment_status='approved'";
                $query_run = mysqli_query($conn, $query);

                $total_ikut = mysqli_fetch_assoc($query_run);
              ?>  
              <h3>Available slots :  <?php echo $total_ikut['p']; ?> / <?php echo $post['participant_limit']; ?> 
              <br>
              <a href="partlist.php?id=<?php echo $post['id']; ?>" class="btn" >View participants</a></h3>
              <br>
              <h3>Tournament Category :</h3>
              <p> <?php echo $post['category'] ?> </p>

              <h3>Registration Fees :</h3>

              <p> <?php echo $post['s_price'] ?> <?php echo $post['currency'] ?> </p>

              <h3>Event Description :</h3> 

                      <p><?php echo html_entity_decode($post['body']); ?></p>

              <!-- <h3>Availability to join</h3>  -->
          </div>




            <?php if ($total_ikut['p'] >= $post['participant_limit']) {?>
              <h1>Registration for this event is full</h1>
            <?php } else  if (isset($_SESSION['id'])) {?>
                <a href="app/payment/checkout.php?id=<?php echo $post['id'];?> " class="btn btn-big" >Register For this event</a>  
              <?php } else {?>
                <a href=" <?php echo BASE_URL . '/login-user.php' ?> " class="btn btn-big">Login/Signup to register for this event</a>
                 <?php } ?>  
        </div>

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
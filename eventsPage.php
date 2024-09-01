<?php 
include("path.php");

include(ROOT_PATH . "/app/controllers/events.php");

// gets all the events from events table in database
$posts = array();
$postsTitle = 'Upcoming Events';

if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);
  $postsTitle = "You searched for events under '" . $_GET['name'] . "'";
} else if (isset($_POST['search-term'])) {
  $postsTitle = "You searched for '" . $_POST['search-term'] . "'";
  $posts = searchPosts($_POST['search-term']);
} else {
  $posts = getPublishedPosts();
}

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

  <title>Esport Brunei - Event Page</title>
  <link rel="icon" href="assets/logo/logo3.png">

</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Page Wrapper for sidebar -->
    <div class="sidebar-wrapper">

      <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

    </div>
    <!-- End Page Wrapper for sidebar -->

  

    <!--Event Post Slider -->

    <div class="post-slider">
      <h1 class="slider-title" style="color:white;">Recent Events</h1>

      <div class="post-wrapper">

        <?php foreach ($events as $post): ?>
          <div class="post">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image">
            <div class="post-info">
              <h3><?php echo $post['title']; ?></h3>
              <!-- <h4>Post created by <?php echo $post['username']; ?></h4>
             <h4>created at <?php echo date('F j, Y', strtotime($post['created_at'])); ?></h4> -->
             <h4><a href="eventsingle.php?id=<?php echo $post['eventid']; ?>">More Details</a></h4>
            </div>
          </div>
        <?php endforeach; ?>


      </div>

    </div>
    <!-- //Event Post Slider -->

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($events as $post): ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="eventSingle.php?id=<?php echo $post['eventid']; ?>"><?php echo $post['title']; ?></a></h2>
              <i class="far fa-user"> <?php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
              </p>
              <a href="EventSingle.php?id=<?php echo $post['eventid']; ?>" class="btn read-more">Read More</a>
            </div>
          </div>    
        <?php endforeach; ?>
        


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
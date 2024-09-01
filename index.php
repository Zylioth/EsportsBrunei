<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

// gets all the posts from post table in database
$posts = array();
$postsTitle = 'Forum Posts';


if (isset($_GET['t_id'])) {
  $posts = getPostsByTopicId($_GET['t_id']);
  $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
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

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css">



  <title>Esport Brunei - Homepage</title>
  <link rel="icon" href="assets/logo/logo3.png">
</head>

<body>

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Page Wrapper for sidebar -->
    <div class="sidebar-wrapper">

      <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

    </div>
    <!-- End Page Wrapper for sidebar -->
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

    <!-- Post Slider -->

    <div class="post-slider">
      <h1 class="slider-title" style="color:white;">Recent Posts</h1>
      

      <div class="post-wrapper">

        <?php foreach ($posts as $post): ?>
          <div class="post">
             
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-image">
             
            <div class="post-info">
              <h3><?php echo $post['title']; ?></h3>
              <!-- <h4>Post created by <?php echo $post['username']; ?></h4>
             <h4>created at <?php echo date('F j, Y', strtotime($post['created_at'])); ?></h4> -->
             <h4><a href="single.php?id=<?php echo $post['id']; ?>">More Details</a></h4>
            </div>
          </div>
        <?php endforeach; ?>


      </div>

    </div>
    <!-- // Post Slider -->

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">

      <div class="section search">

          <form action="index.php" method="post">
          <input type="text" name="search-term" class="text-input" placeholder="Search...">
          </form>
        </div>

        <!-- <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            <?php foreach ($topics as $key => $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div> -->

        <h1 class="recent-post-title"><?php echo $postsTitle ?></h1>

        <?php foreach ($posts as $post): ?>
          <div class="post clearfix">
            <img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
            <div class="post-preview">
              <h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
              <i class="far fa-user"> <?php echo $post['username']; ?></i>
              &nbsp;
              <i class="far fa-calendar"> <?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
              <p class="preview-text">
                <?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?>
              </p>
              <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
            </div>
          </div>    
        <?php endforeach; ?>
        


      </div>
      <!-- // Main Content -->
<!--  This is the search -->
      <!-- <div class="sidebar">

        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            <?php foreach ($topics as $key => $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        

      </div> -->

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
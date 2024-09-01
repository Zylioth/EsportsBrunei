<?php include("path.php"); ?>

<?php include(ROOT_PATH . '/app/controllers/posts.php');

// To get session of Post by id

if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' => $_GET['id']]);
}
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);



if (isset($_GET['id'])) {
  $post = selectOne('posts', ['id' => $_GET['id']]);
  $_SESSION['postid'] = $_GET['id'];
}
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);

// $_SESSION['postid'] = $_GET['id'];
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
            <?php echo html_entity_decode($post['body']); ?>
          </div>
          <h2 class="post-title">Comment Section</h2>
          <?php if (isset($_SESSION['id'])) { ?>
          <!-- comment Section -->
          <?php include(ROOT_PATH . "/app/includes/comment.php"); ?>
              <?php } else { ?>
                <a href=" <?php echo BASE_URL . '/login-user.php' ?> " class="btn btn-big">Login/Signup to comment</a><?php }?>
               
                <!-- sharing section -->
                <div align="center">
                <br>
                  <h5>share now !</h5>
            <?php include(ROOT_PATH . "/app/includes/share.php"); ?>    
            
            <h5>save/bookmark this post !</h5>
          <a href="bookmarkpost.php?bookmark=1&p_id=<?php echo $post['id'] ?>" class="bookmark"><img src="<?php echo BASE_URL . '/assets/logo/bookmark.png' ?>" alt="bookmark link" style = "max-width:20px" /></a>
          </div>

        </div>
        
      </div>
      
      <!-- // Main Content -->

      <!-- Sidebar -->
      <!-- <div class="sidebar single">

        <div class="section popular">
          <h2 class="section-title">Popular</h2>

          <?php foreach ($posts as $p): ?>
            <div class="post clearfix">
              <img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="">
              <a href="" class="title">
                <h4><a href="single.php?id=<?php echo $p['id']; ?>"><?php echo $p['title']; ?></a></h4>
              </a>
            </div>
          <?php endforeach; ?>
          

        </div>

        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            <?php foreach ($topics as $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>

          </ul>
        </div>
      </div> -->
      <!-- // Sidebar -->

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
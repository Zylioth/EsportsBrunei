<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");?>
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
        <link rel="stylesheet" href="assets/css/admin.css">

        <!-- Admin Styling -->

        <title>Esport Brunei - Manage Bookmarked Posts</title>
        <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/Header.php"); ?>

    <div class="page-wrapper">
  <div class="sidebar-wrapper">
      <?php include(ROOT_PATH . "/app/includes/sidebar.php"); ?>

      </div>
        <!-- Admin Page Wrapper -->
        


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="content">

                    <h2 class="page-title">Manage Bookmarked Posts</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

        <?php if (isset($_SESSION['id'])){ ?>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Title</th>
                            <th colspan="3">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($bookmarks as $key => $bookmark): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $bookmark['title'] ?></td>
                                    <td><a href="Single.php?id=<?php echo $bookmark['id']; ?>" class="view">view post</a></td>
                                    <td><a href="bookmarkpost.php?bookmarkid=<?php echo $bookmark['bookmarkid'] ?>" class="remove">remove from bookmark</a></td>                                    
                                </tr>
                            <?php endforeach; ?>
                                <?php } ?>
                        </tbody>
                    </table>

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
        <script src="../../assets/js/scripts.js"></script>

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
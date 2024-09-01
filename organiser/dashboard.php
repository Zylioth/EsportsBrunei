<?php include("../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
adminOnly();
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
        <link rel="stylesheet" href="../assets/css/style.css">

        <!-- moderator Styling -->
        <link rel="stylesheet" href="../assets/css/moderator.css">

        <title>Organiser Section - Dashboard</title>
        <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/organiserHeader.php"); ?>

        <!-- moderator Page Wrapper -->
        <div class="moderator-wrapper">

        <?php include(ROOT_PATH . "/app/includes/organiserSidebar.php"); ?>


            <!-- moderator Content -->
            <div class="moderator-content">

            <div>

                <h1 class="page-title2">Welcome to the Organiser Dashboard</h1>

                    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>

                    <div class="container">
                            <img src=<?php echo BASE_URL . "/assets/logo/o1.png" ?> alt="Avatar" class="image">
                            <div class="overlay">
                            <div class="text">Greetings Organiser</div>
                        </div>
                    </div>

                    <div class="container2">
                        <div class="center">
                            <button onclick="window.location.href='/prototype/organiser/events/create.php';" class="button">Create Events</button>
                            <button onclick="window.location.href='/prototype/organiser/events/index.php';"  class="button">Event Lists</button>
                        </div>
                    </div>

                </div>

            </div>
            <!-- // moderator Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../assets/js/scripts.js"></script>

    </body>

</html>
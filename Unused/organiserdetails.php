<?php include("../../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 

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
        <link rel="stylesheet" href="../../assets/css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Admin Section - User Organiser Registration Details</title>
        <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>


            <!-- Admin Content -->
            <!-- <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Add User</a>
                    <a href="index.php" class="btn btn-big">Manage Users</a>
                </div> -->
                <div class="admin-content">
                <div class="content">
             
                <h1 class="page-title" align="center" >User Organiser Details</h1>

                    

                    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <div align="center" >
                            <h4>Organiser Username :</h4>
                            <h2><?php echo $username; ?></h2>
                            <input type="hidden" name="username" value="<?php echo $username; ?>" class="text-input" style="max-width:30%; " readonly>
                        </div>
                        <div align="center">
                        <h4>Organiser Email :</h4>
                            <h2><?php echo $email; ?></h2>
                            <input type="hidden" name="email" value="<?php echo $email; ?>" class="text-input" style="max-width:30%; " readonly>
                        </div>
                        <div align="center" >
                            <h4>Organiser Details : </h4>
                            <?php echo html_entity_decode($user['details']); ?>
                        </div>
                        <div class="text-center" style="max-width:100%; " align="center">
                         <h4>Image Upload of registered organiser:</h4>
                         <br>
                         <img src="<?php echo  BASE_URL .'/assets/proof/' . $proof; ?>" class="rounded" style="max-width:50%;"  alt="No registration proof">
                         </div>
                         <!-- <div>
                            <label>Approve as organiser (change from 0 to 3)</label>
                            <input type="text" name="admin" value="<?php echo $admin; ?>" class="text-input">
                        </div> -->
                        <!-- <div>
                            <?php if (isset($admin) && $admin == 1): ?>
                                <label>
                                    <input type="checkbox" name="admin" checked>
                                    Admin
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="admin">
                                    Admin
                                </label>
                            <?php endif; ?>
                            
                        </div> -->
                        
                        <!-- New Add Block area --> 
                        <!-- <div>
                            <?php if (empty($organiser) && $organiser == 0): ?>
                                <label>
                                    <input type="checkbox" name="organiser">
                                    Approve
                                </label>
                            <?php else: ?>
                                <label>
                                    <input type="checkbox" name="organiser" checked>
                                    Unapporve
                                </label>
                            <?php endif; ?>
                           

                        </div> -->
                        <!-- New Add Block area  -->


                        <div align="center">
                            <button class="btn btn-big"><a href="<?php echo BASE_URL . '/Admin/organiserlist/index.php'; ?>">back</a></button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->



        <!-- JQuery -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Ckeditor -->
        <script
            src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
        <!-- Custom Script -->
        <script src="../../assets/js/scripts.js"></script>

    </body>

</html>
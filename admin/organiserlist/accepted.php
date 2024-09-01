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

        <!-- Players Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css">

        <title>Admin Section - Accepted Organiser List</title>
        <link rel="icon" href= <?php echo BASE_URL . "/assets/logo/logo3.png" ?>>

    </head>

    <body>
        
    <?php include(ROOT_PATH . "/app/includes/AdminHeader.php"); ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-wrapper">

        <?php include(ROOT_PATH . "/app/includes/AdminSidebar.php"); ?>


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <!-- <a href="create.php" class="btn btn-big">Add User</a> -->
                    <a href="index.php" class="btn btn-big">Pending User Organiser Registration List</a>
                </div>
                <div class="content">
                    <h2 class="page-title">Organiser Accepted List</h2>

                    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

                    <table>
                        <thead>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th colspan="3">Status</th>
                        </thead>
                        <tbody>
                            <?php foreach ($organiser_users as $key => $user): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><a href="details.php?id=<?php echo $user['id']; ?>" class="details">Details</a></td>
                                    
                                       

                                    <!-- New Add organiser approval area --> 
                                    <td><a href="details.php?admin=0&organiser_status=3&p_id=<?php echo $user['id'] ?>" class="unapprove">unapprove</a></td>
                                  
                                  <td><a href="details.php?admin=3&organiser_status=2&p_id=<?php echo $user['id'] ?>" class="approve">approve</a></td>
                                    <!--New Add Bloked area  -->
                                     
                                    <?php if ($user['blocked'] == 1): ?>
                                        <td><a href="details.php?organiser_blocked=0&p_id=<?php echo $user['id'] ?>" class="unblock">unblock</a></td>
                                    <?php else: ?>
                                        <td><a href="details.php?organiser_blocked=1&p_id=<?php echo $user['id'] ?>" class="block">block</a></td>
                                    <?php endif; ?>

                                    </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
           
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
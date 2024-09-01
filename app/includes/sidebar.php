<div id="mySidenav" class="sidenav">

<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

<div class="left-sidebar" align="center">



<!-- <a href="<?php echo BASE_URL . '/index.php' ?>" class="logo">
      <h1 class="logo-text"><span>Esport</span>Brunei</h1>
    </a> -->

    <ul>   
         <!-- Profile image display code  -->
    <?php if (isset($_SESSION['id'])){ ?>
        <?php  
                    $id = $_SESSION['id'];
                    $email_check = "SELECT * FROM users WHERE id = '$id'";
                    $res = mysqli_query($conn, $email_check);
                    if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_assoc($res);
                        $pic = $fetch['pic'];
                    } 
                    
        // Default image punya stuffz
        // $user_pic = "/assets/images/".$pic;
        // $default = "assets/uploads/avatar.png";    
        
        // if(file_exists($user_pic)){
        //     $profile_picture = $user_pic;
        // }else{
        //     $profile_picture =$default;

        // }
        
                    
        ?>
                <br>

        <!-- profile image display code -->
        <li><img src="<?php echo BASE_URL . '/assets/profile/' . $pic; ?>" class="rounded" style="border-radius:50%;max-width:50%;" alt="Profile Image"></li>
        <li ><h1><?php echo $_SESSION['username'];?></h1></li>
        <li><h5><a href="<?php echo BASE_URL . '/profile.php' ?>" class="profile"><i class="fas fa-user-circle"></i> My Profile</a></h5></li>
        
        <!-- IF NORMAL USER -->
        <?php if($_SESSION['admin']  == 0 ){ ?>
            <li><h5><a href="<?php echo BASE_URL . '/team-menu.php' ?>" class="TeamProfile"><i class="fa fa-users"></i> Team Management</a></h5></li> 
            <li><h5><a href="<?php echo BASE_URL . '/team-registration.php' ?>" class="TeamRegistration"><i class="fa fa-user-plus"></i> Team Registration</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/organiser-reg.php' ?>" class="organiserreg"><i class="fas fa-user-plus"></i> Organiser Registration</a></h5></li>  
        <?php }?>

        <!-- IF ADMIN USER -->
        <?php if($_SESSION['admin']  == 1 ){ ?>
            <li><h5><a href="<?php echo BASE_URL . '/admin/events/create.php' ?>" class="organiserreg"><i class="far fa-calendar-plus"></i> Create Event</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/admin/events/index.php'; ?>"><i class="far fa-calendar-minus"></i> Manage Events</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/admin/posts/index.php'; ?>"><i class="far fa-clipboard"></i> Manage Posts</a></h5></li> 
            <li><h5><a href="<?php echo BASE_URL . '/admin/users/index.php'; ?>"><i class="fas fa-users-cog"></i> Manage Users</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/admin/organiserlist/index.php'; ?>"><i class="fa fa-user"></i> Organiser Lists</a></h5></li>
        <?php }?>

        <!-- IF MODERATOR USER -->
        <?php if($_SESSION['admin']  == 2 ){ ?>
            <li><h5><a href="<?php echo BASE_URL . '/moderator/events/create.php' ?>" class="organiserreg"><i class="far fa-calendar-plus"></i> Create Event</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/moderator/players/index.php'; ?>"><i class="fas fa-users-cog"></i> Manage Players</a></h5></li>
            <li><h5><a href="<?php echo BASE_URL . '/moderator/organiserlist/index.php'; ?>"><i class="fa fa-user"></i> Organiser Lists</a></h5></li> 
        <?php }?>

        <!-- IF ORGANISER USER -->
        <?php if($_SESSION['admin']  == 3 ){ ?>
            <li><h5><a href="<?php echo BASE_URL . '/organiser/events/create.php' ?>" class="organiserreg"><i class="far fa-calendar-plus"></i> Create Event</a></h5></li>
        <?php }?> 
        
        <?php if($_SESSION['admin']  == 0 || $_SESSION['admin']  == 2 || $_SESSION['admin']  == 3 ){ ?>
            <li><h5><a href= <?php echo BASE_URL . "/bookmarkpost.php" ?> ><i class="far fa-bookmark"></i> Bookmark posts </a></h5></li>
            <li><h5><a href= "contact.php" ><i class="fa fa-address-book"></i> Help </a></h5></li>
        <?php } ?>

        <li><h5><a href="<?php echo BASE_URL . '/logout-user.php' ?>" class="logout">Logout</a></h5></li>
        <?php } else { ?>
            
        <!-- IF GUEST USER PUNYA SIDEBAR -->
            <li><h5><a href=" <?php echo BASE_URL . '/login-user.php' ?> "><i class="fa fa-user" ></i> login/Register</a></h5></li>
            <li><h5><a href= "contact.php" ><i class="fa fa-address-book"></i> Help </a></h5></li>
       <?php } ?>
    <br>   
    <br>   
     
    
    <li>Esports Brunei © 2021</li>         
    </ul>
</div>

</div>
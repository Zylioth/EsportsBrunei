<header>

<div class="botan">


<button type="button" onclick="openNav()" id="sidebarCollapse" class="btn btn-info">
<img src="<?php echo BASE_URL . "/assets/logo/logo3.png" ?>" style="width:105px;" align="center" >
                
            </button>
           
            <!-- <a href="<?php echo BASE_URL . '/index.php' ?>" class="logo">
      <h1 class="logo-text"><span>Esport</span>Brunei</h1>
    </a> -->

    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
    <li><a href="<?php echo BASE_URL . '/index.php' ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?php echo BASE_URL . '/aboutUs.php' ?>"><i class="fa fa-question"></i> About us</a></li>
      <li><a href="<?php echo BASE_URL . '/eventsPage.php'; ?>"><i class="fa fa-gamepad"></i> Events</a></li>
      <li><a href="<?php echo BASE_URL . '/team-profile.php' ?>" class="TeamProfile"><i class="fa fa-users"></i> Team Management</a></li>

      <?php if (isset($_SESSION['id'])): ?>
        
        <li>
          <a href="#"> 
          <img src="<?php echo BASE_URL . '/assets/logo/logo3.png' ?>" class="rounded" style="border-radius:50%;max-width:40px;" alt="Profile Image">         </a>
          <ul>
            <?php if($_SESSION['admin']  == 1){ ?>
              <li> <a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>"></i>Dashboard </a></li>
            <?php } ?>
            <?php if($_SESSION['admin'] == 2){ ?>
            <li><a href="<?php echo BASE_URL . '/moderator/dashboard.php' ?>" class="moderator"></i> Moderator</a></li>
            <?php } ?>
            <!-- soon to be changed or used -->
            <?php if($_SESSION['admin'] == 3){ ?> 
            <li><a href="<?php echo BASE_URL . '/organiser/dashboard.php' ?>" class="organiser"></i> Organiser</a></li>
             <?php } ?>
            <li><a href="<?php echo BASE_URL . '/profile.php' ?>" class="profile">Profile</a></li>
            <li><a href="<?php echo BASE_URL . '/logout-user.php' ?>" class="logout">Logout</a></li>
          </ul>
        </li>
      <?php else: ?>
       <!-- <li><a href=" <?php echo BASE_URL . '/register.php' ?> ">Sign Up</a></li> -->
       <!-- <li><a href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li> -->

       <li><a href=" <?php echo BASE_URL . '/login-user.php' ?> "><i class="fa fa-user" ></i> login/Register</a></li>
      <?php endif; ?>
    </ul>
    </div>
</header>
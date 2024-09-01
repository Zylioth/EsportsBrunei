<header>
    <a class="logo" href="<?php echo BASE_URL . '/index.php'; ?>">
    <img src= <?php echo BASE_URL . "/assets/logo/logo3.png" ?> style="width:25%;padding-right:15px;" >
    </a>
    <i class="fa fa-bars menu-toggle"></i>
    <ul class="nav">
        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL . '/logout-user.php'; ?>" class="logout">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</header>
<?php if(isset($_SESSION['message'])): ?>
  <div class="msg <?php echo $_SESSION['type']; ?>" style="max-width:30%; ">
    <li><?php echo $_SESSION['message']; ?></li>
    <?php
      unset($_SESSION['message']);
      unset($_SESSION['type']);
    ?>
  </div>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
    <div class="msg error" style="max-width:30%; ">
    <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
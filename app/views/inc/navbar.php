<div class="nav">
    <?php if(isset($_SESSION['user_id'])) : ?>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    <?php else : ?>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Log in</a>
    <?php endif; ?>   

</div>
<div class="nav">
    <?php if(isset($_SESSION['user_id'])) : ?>
        <p>Здравей, <?php echo $_SESSION['user_name']; ?>!</p>
        <a class="nav-link" href="<?php echo URLROOT; ?>/curriculums/index">Учебни планове</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/disciplines/index">Дисциплини</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
    <?php else : ?>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Регистрация</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Вход</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/curriculums/index">Учебни планове</a>
        <a class="nav-link" href="<?php echo URLROOT; ?>/disciplines/index">Дисциплини</a>
    <?php endif; ?>  
</div>
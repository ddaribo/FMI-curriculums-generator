<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div>
            <?php flash('register_success');?>
            <h2>Вход в системата</h2>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">

                <div class="form-group">
                <label for="email">Email:</label>
                    <input type="text" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="form-group">
                <label for="password">Password:</label>
                    <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ;?>/users/register">Sign up</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
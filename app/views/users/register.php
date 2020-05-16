<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div>
            <h2>Регистрация в системата</h2>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                <label for="name">Name:</label>
                    <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>

                <div class="form-group">
                <label for="email">Email:</label>
                    <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="form-group">
                <label for="password">Password:</label>
                    <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>

                <div class="form-group">
                <label for="confirm_password">Password:</label>
                    <input type="password" name="confirm_password" class="<?php echo (!empty($data['confirm_passwod_err'])) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT ;?>/users/login">Log in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
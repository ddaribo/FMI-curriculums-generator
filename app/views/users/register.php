<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="authFormContainer">
            <h2>Регистрация в системата</h2>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <div class="row">
                        <label for="name">Потребителско име:</label>
                        <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['name']; ?>">
                    </div>
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="email">Имейл:</label>
                        <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['email']; ?>">
                    </div>
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="password">Парола:</label>
                        <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['password']; ?>">
                    </div>
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>

                <div class="form-group">
                <div class="row">
                        <label for="confirm_password">Потвърди паролата:</label>
                        <input type="password" name="confirm_password" class="<?php echo (!empty($data['confirm_passwod_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['confirm_password']; ?>">
                </div>
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                </div>

                <div class="buttonRow">
                    <a class="commonLink" href="<?php echo URLROOT ;?>/users/login">Вход</a>
                    <input type="submit" value="Регистрирай ме">
                    </div>
                </div>
            </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
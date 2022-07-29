<?php include 'v_header.php'; ?>

<form method='post'>
    Login<br>
    <input type='text' name='login'><br>
    <?php if (isset($login_errors) && $login_errors): ?>
        <?php foreach ($login_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>

    Password<br>
    <input type='password' name='password'><br>
    <?php if (isset($password_errors) && $password_errors): ?>
        <?php foreach ($password_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>

    <input type='checkbox' name='remember'>Remeber<br>
    <input type='submit' value='Add'>
</form>
<?php if (isset($log_pass_errors) && $log_pass_errors): ?>
    <?php foreach ($log_pass_errors as $error): ?>
        <span style='color: red'><?=$error?></span><br>
    <?php endforeach; ?>
<?php endif; ?>

<?php include 'v_footer.php'; ?>
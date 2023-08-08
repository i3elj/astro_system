<!DOCTYPE html>
<html>

<?= create_head_tag($title, ['views/auth/auth.style.css']) ?>

<body>
  <div id="loginContainer">
    <h1>Login</h1>
    <form action="/login" method="POST">

      <?php
      (isset($field) && $field == 'email') || !isset($field)
        ? $focus = 'email'
        : $focus = 'pwd';
      ?>

      <input required <?= $focus == 'email' ? "autofocus" : null ?> class="emailField <?= isset($auth_error) && $focus == 'email' ? 'emailFieldError' : '' ?>" type="email" name="email" placeholder="Type your email" value="<?= isset($email_recovery) ? $email_recovery : null ?>" />
      <input required <?= $focus == 'pwd' ? 'autofocus' : null ?> class="pwdField <?= isset($auth_error) && $focus == 'pwd' ? 'pwdFieldError' : '' ?>" type="password" name="password" placeholder="Type your password" />
      <input class="submitButton" type="submit" />

      <?php if (isset($auth_error)) : ?>
        <p id="loginError"><?= $auth_error ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>

<!DOCTYPE html>
<html>

<?= create_head_tag($title, ['views/auth/auth.style.css']) ?>

<body>
  <div id="authContainer">
    <h1>Login</h1>
    <p></p>
    <form id="form">
      <input class="inputField" required type="email" name="email" placeholder="Type your email" />
      <input class="inputField" required type="password" name="password" placeholder="Type your password" />
      <input class="submitButton" type="submit" onclick="auth()" value="Authenticate" />
    </form>
  </div>
</body>

<script type="text/javascript" src="views/auth/login/login.js"></script>

</html>

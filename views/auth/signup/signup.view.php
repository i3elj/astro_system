<!DOCTYPE html>
<html>

<?= create_head_tag($title, ['views/auth/auth.style.css']) ?>

<body>
  <div id="authContainer">
    <h1>Sign Up</h1>
    <p></p>
    <form id="form">
      <input class="inputField" required type="text" name="nickname" placeholder="Choose a nickname" />
      <input class="inputField" required type="text" name="realname" placeholder="Real (full) name" />
      <div class="row">
        <input class="inputField" required type="text" name="cpf" placeholder="CPF" />
        <input class="inputField" required type="tel" name="phonenumber" placeholder="+55 (33)91111-2222" pattern="\+[0-9]{2} \([0-9]{2}\)[0-9]{5}-[0-9]{4}" />
      </div>
      <div class="row">
        <input class="inputField" required type="email" name="email" placeholder="Type your email" />
        <input class="inputField" required type="email" name="email" placeholder="Confirm your email" />
      </div>
      <div class="row">
        <input class="inputField" required type="password" name="password" placeholder="Type your password" />
        <input class="inputField" required type="password" name="password" placeholder="Confirm your password" />
      </div>
      <div id="termsOfServiceContainer">
        <input id="tos" type="checkbox" name="tos" value="yes" />
        <label for="tos">I agree with the Terms of Service</label>
      </div>
      <input class="submitButton" type="submit" value="Sign" onclick="auth()" disabled />
    </form>
  </div>

  <script type="text/javascript" src="views/auth/signup/signup.js"></script>
</body>

</html>

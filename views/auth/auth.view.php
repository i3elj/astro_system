<head>
  <title><?= $title ?></title>
</head>

<body>
  <div id="loginContainer">
    <h1>Login</h1>
    <form action="/login" method="POST">
      <input autofocus id="emailField" type="email" name="email" placeholder="Type your email" />
      <input id="passwordField" type="password" name="password" placeholder="Type your password" />
      <input id="submitButton" type="submit"/>
    </form>
  </div>
</body>

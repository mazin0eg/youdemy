<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css" />
  </head>
  <body>
    <div class="center">
      <h1>YouDemy</h1>
      <!-- Afficher les messages d'erreur -->
      <?php
      if (isset($_GET['error'])) {
          echo "<p style='color: red; text-align: center;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
      }
      ?>
      <!-- Formulaire de connexion -->
      <form method="post" action="login_action.php">
        <div class="txt_field">
          <input type="text" name="username" required />
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required />
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" value="Login" />
        <div class="signup_link">
          Not a member? <a href="register.php">Signup</a>
        </div>
      </form>
    </div>
  </body>
</html>

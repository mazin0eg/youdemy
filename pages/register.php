<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link rel="stylesheet" href="../style/style.css" />
  </head>
  <body>
    <div class="center">
      <h1>Register</h1>
      <!-- Afficher les messages d'erreur ou de succès -->
      <?php
      if (isset($_GET['success'])) {
          echo "<p style='color: green; text-align: center;'>Registration successful!</p>";
      }
      if (isset($_GET['error'])) {
          echo "<p style='color: red; text-align: center;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
      }
      ?>
      <!-- Formulaire d'inscription -->
      <form method="post" action="register_action.php">
        <div class="txt_field">
          <input type="text" name="username" required />
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="email" name="email" required />
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required />
          <span></span>
          <label>Password</label>
        </div>
        <!-- Boutons radio pour sélectionner le rôle -->
        <div class="role_selection" style="margin: 20px 0; text-align: left;">
          <p style="margin-bottom: 10px;">Select your role:</p>
          <input type="radio" id="etudiant" name="role" value="etudiant" required />
          <label for="etudiant">Étudiant</label><br />
          <input type="radio" id="enseignant" name="role" value="enseignant" />
          <label for="enseignant">Enseignant</label>
        </div>
        <input type="submit" value="Register" />
        <div class="signup_link">
          Already a member? <a href="login.php">Login</a>
        </div>
      </form>
    </div>
  </body>
</html>

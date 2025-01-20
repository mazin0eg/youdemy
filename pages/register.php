<?php
require_once '../classes/utilisateure.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Assuming role comes from a form input

    Utilisateur::register($nom, $email, $password, $role);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="center">
        <h1>Register</h1>
        <form method="post" action="register.php">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="role_field">
                <label>Select Role:</label>
                <br>
                <input type="radio" name="role" value="Enseignant" required> Enseignant<br>
                <input type="radio" name="role" value="Etudiant" required> Etudiant
            </div>
            <input type="submit" value="Register">
     
            <div class="signup_link">
            Already a member? <a href="login.php">Login</a>
            </div>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?= htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

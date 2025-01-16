<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE nom = :nom");
        $stmt->bindParam(':nom', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom'];
            $_SESSION['role'] = $user['role'];

            // Redirection après succès
            header("Location: dashboard.php");
            exit;
        } else {
            // Redirection avec message d'erreur
            header("Location: login.php?error=Invalid username or password");
            exit;
        }
    } catch (PDOException $e) {
        // Redirection avec message d'erreur
        header("Location: login.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}
?>

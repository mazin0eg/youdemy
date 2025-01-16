<?php
require_once '../db/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    try {
        
        $db = new Database();
        $conn = $db->connect();

       
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            
            header("Location: register.php?error=Email already registered!");
            exit;
        }

        
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)");
        $stmt->bindParam(':nom', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

       
        header("Location: register.php?success=1");
        exit;
    } catch (PDOException $e) {
        
        header("Location: register.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}
?>

<?php
require_once '../db/database.php'; // Inclure le fichier de connexion à la base de données

// Créer une instance de la classe Database
$db = new Database();

// Tenter de se connecter à la base de données
try {
    $connection = $db->connect();
    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

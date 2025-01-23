<?php
require_once '../classes/utilisateure.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Etudiant') {
    header('Location: login.php');
    exit;
}

// Vérifier si l'ID du cours est soumis
if (isset($_POST['id_cours'])) {
    $coursId = $_POST['id_cours'];
    $etudiantId = $_SESSION['user_id']; // ID de l'étudiant connecté

    // Créer une instance de la classe Etudiant
    $etudiant = new Etudiant();

    // Inscrire l'étudiant au cours
    $resultat = $etudiant->inscrireCours($etudiantId, $coursId);

    if ($resultat) {
        // Succès : redirection vers une page de confirmation
        header('Location: confirmation-inscription.php?success=1');
        exit;
    } else {
        // Échec : afficher un message d'erreur
        echo "Erreur lors de l'inscription au cours.";
    }
} else {
    echo "Aucun cours sélectionné.";
    exit;
}
?>

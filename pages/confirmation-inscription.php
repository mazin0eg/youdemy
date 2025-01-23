<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Etudiant') {
    header('Location: login.php');
    exit;
}

$success = isset($_GET['success']) && $_GET['success'] == 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-3xl mx-auto mt-16 text-center">
        <?php if ($success): ?>
            <h1 class="text-2xl font-bold text-green-600">Inscription réussie !</h1>
            <p class="mt-4">Vous êtes maintenant inscrit à ce cours.</p>
        <?php else: ?>
            <h1 class="text-2xl font-bold text-red-600">Erreur lors de l'inscription</h1>
            <p class="mt-4">Vous êtes peut-être déjà inscrit à ce cours ou une erreur est survenue.</p>
        <?php endif; ?>
        <a href="etudiant-dashboard.php" class="mt-6 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
            Retour au tableau de bord
        </a>
    </div>
</body>
</html>

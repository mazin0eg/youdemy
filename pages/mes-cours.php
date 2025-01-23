<?php
require_once '../classes/utilisateure.php';
session_start();

// Vérifier si l'utilisateur est connecté et est un étudiant
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Etudiant') {
    header('Location: login.php');
    exit;
}

$etudiantId = $_SESSION['user_id'];

$etudiant = new Etudiant();

$coursInscrits = $etudiant->getCoursInscrits($etudiantId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body class="bg-gray-50">
<aside class="sidebar">
            <div class="sidebar-header">
                <h2>Tableau de Bord Étudiant</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="etudiant-dashboard.php"><i class="fas fa-home"></i> Tableau de bord</a></li>
                <li><a href="mes-cours.php"><i class="fas fa-book"></i> Mes Cours</a></li>
                <li><a href="#progress"><i class="fas fa-chart-line"></i> Mes Progrès</a></li>
                <li><a href="#settings"><i class="fas fa-cogs"></i> Paramètres</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </aside>

    <!-- Contenu principal -->
    <div class="max-w-5xl mx-auto mt-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Mes Cours</h1>

        <?php if (empty($coursInscrits)): ?>
            <p class="text-gray-500">Vous n'êtes inscrit à aucun cours pour le moment.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($coursInscrits as $cours): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <!-- Afficher l'image du cours -->
                        <?php if (!empty($cours['image'])): ?>
                            <img src="<?= htmlspecialchars($cours['image']) ?>" alt="Image du cours" class="w-full h-40 object-cover rounded-lg mb-4">
                        <?php else: ?>
                            <div class="w-full h-40 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                <span class="text-gray-500">Aucune image disponible</span>
                            </div>
                        <?php endif; ?>

                        <!-- Afficher le titre et la description -->
                        <h2 class="text-xl font-semibold text-blue-600 mb-2"><?= htmlspecialchars($cours['titre']) ?></h2>
                        <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($cours['description']) ?></p>

                        <!-- Bouton pour accéder au cours -->
                        <a href="details-cours.php?id=<?= $cours['id'] ?>" class="bg-blue-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-blue-700">
                            Voir le cours
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

   
</body>
</html>

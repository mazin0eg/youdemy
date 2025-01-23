<?php
require_once '../classes/cours.php';
require_once '../classes/utilisateure.php';
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Etudiant') {
    header('Location: login.php');
    exit;
}

// Verify if a course ID is passed in the URL
if (isset($_GET['id'])) {
    $idCours = $_GET['id'];

    // Create an instance of the `Cours` class
    $cours = new Cours();

    // Fetch course details
    $detailsCours = $cours->recupererCoursParId($idCours);

    if (!$detailsCours) {
        echo "Aucun cours trouvé.";
        exit;
    }
} else {
    echo "ID du cours manquant.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($detailsCours['titre']) ?> - Détails du Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="student-dashboard.php" class="text-lg font-semibold">Youdemy</a>
                </div>
                <div>
                    <a href="logout.php" class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg text-sm">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Course Details -->
    <div class="max-w-5xl mx-auto mt-12">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <!-- Course Image -->
            <?php if (!empty($detailsCours['image'])): ?>
                <img src="<?= htmlspecialchars($detailsCours['image']) ?>" alt="Image du cours" class="w-full h-64 object-cover rounded-lg mb-6">
            <?php else: ?>
                <div class="w-full h-64 bg-gray-200 rounded-lg mb-6 flex items-center justify-center">
                    <span class="text-gray-500">Aucune image disponible</span>
                </div>
            <?php endif; ?>

            <!-- Course Title and Description -->
            <h1 class="text-3xl font-extrabold text-blue-600 mb-4"><?= htmlspecialchars($detailsCours['titre']) ?></h1>
            <p class="text-gray-600 text-lg mb-6"><?= htmlspecialchars($detailsCours['description']) ?></p>

            <!-- Video Section -->
            <?php if (!empty($detailsCours['video'])): ?>
                <div class="aspect-w-16 aspect-h-9 mb-6">
                    <video controls class="w-full rounded-lg shadow">
                        <source src="<?= htmlspecialchars($detailsCours['video']) ?>" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture des vidéos.
                    </video>
                </div>
            <?php else: ?>
                <p class="text-gray-500 mb-6">Aucune vidéo disponible pour ce cours.</p>
            <?php endif; ?>

            <!-- Inscription Button -->
            <form method="POST" action="inscrire.php">
    <input type="hidden" name="id_cours" value="<?= $idCours ?>">
    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg text-sm font-medium hover:bg-blue-700">
        S'inscrire
    </button>
</form>

        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="student-dashboard.php" class="inline-block bg-gray-300 text-gray-700 py-2 px-4 rounded-lg text-sm font-medium hover:bg-gray-400">
                Retour au tableau de bord
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-6 mt-16 border-t">
        <p class="text-sm text-gray-500">© 2025 Youdemy. Tous droits réservés.</p>
    </footer>
</body>
</html>

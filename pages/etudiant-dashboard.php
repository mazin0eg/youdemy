<?php
// Code PHP pour récupérer les cours disponibles
require_once '../classes/utilisateure.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Etudiant') {
    header('Location: login.php');
    exit;
}

// Récupérer les cours disponibles
$student = new Etudiant();
$courses = $student->getAvailableCourses(); // méthode fictive pour récupérer les cours
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Étudiant</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/dashboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styles généraux */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            height: 100vh;
            display: flex;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            padding: 30px 15px;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 40px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 15px 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 18px;
            text-decoration: none;
            color: #555;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu .active {
            background-color: #3498db;
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f9f9f9;
            overflow-y: auto;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 30px;
            margin-bottom: 10px;
            color: #333;
        }

        .header p {
            color: #777;
        }

        /* Liste des cours */
        .course-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .course-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: calc(33% - 20px);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            text-align: center;
        }

        .course-item:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .course-item h3 {
            color: #2980b9;
            margin-bottom: 10px;
        }

        .course-item p {
            margin-bottom: 15px;
            color: #777;
        }

        .enroll-button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .enroll-button:hover {
            background-color: #216ea0;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Tableau de Bord Étudiant</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="student-dashboard.php"><i class="fas fa-home"></i> Tableau de bord</a></li>
                <li><a href="mes-cours.php"><i class="fas fa-book"></i> Mes Cours</a></li>
                <li><a href="#progress"><i class="fas fa-chart-line"></i> Mes Progrès</a></li>
                <li><a href="#settings"><i class="fas fa-cogs"></i> Paramètres</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Mes Cours Disponibles</h1>
                <p>Découvrez et inscrivez-vous aux cours qui vous intéressent.</p>
            </header>

            <section class="pt-4 pb-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Mes Cours Disponibles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Affichage des cours -->
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="relative h-48 bg-gray-100">
                            <!-- Affichage de l'image du cours -->
                            <img src="../uploads/<?= htmlspecialchars($course['image']) ?>" alt="Course thumbnail" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <!-- Affichage de la catégorie -->
                            <span class="bg-orange-100 text-orange-600 text-xs px-2 py-1 rounded-full"><?= htmlspecialchars($course['tags']) ?></span>
                            <a href="courseDetails.php?id=<?= urlencode($course['id']) ?>" class="block">
                                <!-- Titre du cours -->
                                <h3 class="text-lg font-semibold text-gray-900 my-3 hover:text-orange-600 transition-colors duration-300 break-words line-clamp-2">
                                    <?= htmlspecialchars($course['titre']) ?>
                                </h3>
                            </a>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <!-- Affichage de l'enseignant -->
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-orange-500"></i>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        <?= htmlspecialchars($course['enseignant_id']) ?> <!-- Affichage du nom de l'enseignant -->
                                    </p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?= date('F j, Y', strtotime($course['date_creation'])) ?> <!-- Date de création du cours -->
                                </div>
                            </div>
                            <!-- Bouton d'inscription -->
                            <form method="post">
                                <button type="submit" name="enroll_course" class="enroll-button">S'inscrire</button>
                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun cours disponible pour l'instant.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-12">
            <a href="pages/courseDetails.php" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-medium hover:bg-gray-800 transform hover:-translate-y-0.5 transition">
                Voir tous les cours
            </a>
        </div>
    </div>
</section>


        </main>
    </div>
</body>
</html>

<?php
require_once '../classes/utilisateure.php';

// Démarrer la session
session_start();

// Vérifier si l'enseignant est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Enseignant') {
    header('Location: login.php');
    exit;
}

// Créer une instance de la classe Enseignant
$enseignant = new Enseignant();

// Récupérer les cours de l'enseignant connecté
$enseignantId = $_SESSION['user_id'];
$courses = $enseignant->getCourses($enseignantId);



// Gérer la suppression de cours
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_course'])) {
    $courseId = $_POST['course_id'];
    if ($enseignant->supprimerCours($courseId)) {
        $success = "Cours supprimé avec succès.";
    } else {
        $error = "Échec de la suppression du cours.";
    }
}

// Gérer la modification de cours
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_course'])) {
    $courseData = [
        'id' => $_POST['course_id'],
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'image' => $_POST['image'] ?? null,
        'tags' => $_POST['tags'] ?? null,
        'video' => $_POST['video'] ?? null
    ];

    if ($enseignant->modifierCours($courseData)) {
        $success = "Cours modifié avec succès.";
    } else {
        $error = "Échec de la modification du cours.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style/dashboard.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f4f7fb;
            display: flex;
            height: 100vh;
        }

        .dashboard-container {
            display: flex;
            flex: 1;
            justify-content: space-between;
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 30px 15px;
            height: 100vh;
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

        .sidebar-menu a i {
            margin-right: 10px;
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

        .course-list {
            margin-top: 30px;
        }

        .course-item {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
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

        .form-section {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 30px auto;
        }

        .form-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .form-section input, .form-section textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .form-section input:focus, .form-section textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        .submit-button {
            background-color: #3498db;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .submit-button:hover {
            background-color: #216ea0;
            transform: scale(1.02);
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Styling for the course edit form */
.course-item {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
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

.course-item input, .course-item textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: border-color 0.3s ease;
}

.course-item input:focus, .course-item textarea:focus {
    border-color: #3498db;
    outline: none;
}

.course-item .btn-primary, .course-item .btn-danger {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    display: inline-block;
    margin-top: 10px;
}

.course-item .btn-primary {
    background-color: #3498db;
    color: white;
    border: none;
}

.course-item .btn-primary:hover {
    background-color: #216ea0;
    transform: scale(1.05);
}

.course-item .btn-danger {
    background-color: #e74c3c;
    color: white;
    border: none;
}

.course-item .btn-danger:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}


    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Tableau de Bord </h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="enseignant-dashboard.php"><i class="fas fa-home"></i> Tableau de bord</a></li>
                <li><a href="my_courses.php" class="active"><i class="fas fa-book"></i> Mes Cours</a></li>
                <li><a href="#students"><i class="fas fa-user-graduate"></i> Mes Étudiants</a></li>
                <li><a href="add_course.php"><i class="fas fa-plus"></i> Ajouter un Cours</a></li>
                <li><a href="#settings"><i class="fas fa-cogs"></i> Paramètres</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Mes Cours</h1>
                <p>Gérez vos cours ci-dessous :</p>
            </header>

            <!-- Affichage des messages -->
            <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <!-- Liste des Cours -->
            <section id="courses">
                <h2>Liste des Cours</h2>
                <div class="course-list">
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $course): ?>
                            <div class="course-item">
                                <h3><?= htmlspecialchars($course['titre']) ?></h3>
                                <p><?= htmlspecialchars($course['description']) ?></p>

                                <!-- Actions sur le cours -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                    <button type="submit" name="delete_course" class="btn-danger">Supprimer</button>
                                </form>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                    <input type="text" name="titre" value="<?= htmlspecialchars($course['titre']) ?>" required>
                                    <textarea name="description"><?= htmlspecialchars($course['description']) ?></textarea>
                                    <button type="submit" name="edit_course" class="btn-primary">Modifier</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun cours disponible.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

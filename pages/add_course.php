<?php
// Activer les erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../classes/utilisateure.php';

session_start();

$enseignant = new Enseignant();
$tags = $enseignant->getTags(); // Récupère les tags

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $tagsSelected = isset($_POST['tags']) ? implode(',', $_POST['tags']) : ''; // IDs des tags sélectionnés
    $image = $_FILES['image'];

    // Gérer l'upload de l'image
    $imagePath = '';
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $imagePath = $uploadDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    // Appeler la méthode `ajouterCours`
    $cours = [
        'titre' => $titre,
        'description' => $description,
        'tags' => $tagsSelected, // Insérer les IDs sous forme de chaîne
        'image' => $imagePath,
        'enseignant_id' => $_SESSION['user_id'], // ID de l'enseignant connecté
    ];

    if ($enseignant->ajouterCours($cours)) {
        echo "Cours ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du cours.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Teacher Panel</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="enseignant-dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="my_courses.php"><i class="fas fa-book"></i> My Courses</a></li>
                <li><a href="#students"><i class="fas fa-user-graduate"></i> My Students</a></li>
                <li><a href="add_course.php" class="active"><i class="fas fa-plus"></i> Add Course</a></li>
                <li><a href="#settings"><i class="fas fa-cogs"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="header">
                <h1>Add a New Course</h1>
                <p>Fill in the form below to add a new course to your teaching portfolio.</p>
            </header>
            <section id="add-course" class="form-section">
                <form method="POST" enctype="multipart/form-data" class="add-course-form">
                    <label for="titre">Course Title</label>
                    <input type="text" id="titre" name="titre" placeholder="Enter course title" required>

                    <label for="tags">Tags:</label>
                    <label for="tags">Tags:</label>
<select id="tags" name="tags[]"  class="form-select">
    <?php foreach ($tags as $tag): ?>
        <option value="<?= $tag['id'] ?>"><?= htmlspecialchars($tag['nom']) ?></option>
    <?php endforeach; ?>
</select>





                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Write a brief description of the course..." rows="5" required></textarea>

                    <label for="image">Course Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <button type="submit" class="submit-button">Add Course</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>

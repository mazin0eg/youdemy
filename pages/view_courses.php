<?php
require_once '../classes/utilisateure.php';
require_once '../classes/cours.php';
require_once '../db/database.php';



// Instanciation de la classe Administrateur
$admin = new Administrateur();
$courses = $admin->afficherCours();

// Suppression d'un cours
if (isset($_POST['delete_course'])) {
    $courseId = $_POST['course_id'];
    if ($admin->supprimerCours($courseId)) {
        header("Location: view_courses.php");
        exit();
    } else {
        echo "<p>Erreur lors de la suppression du cours.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f8fa;
            color: #333;
        }

        .main-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #2980b9;
            color: white;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f4f6fa;
        }

        table tr:hover {
            background-color: #dfe9f3;
        }

        .delete-btn {
            padding: 8px 12px;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Courses</h1>
        <?php if (count($courses) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['id']); ?></td>
                            <td><?php echo htmlspecialchars($course['titre']); ?></td>
                            <td><?php echo htmlspecialchars($course['description']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                    <button type="submit" name="delete_course" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No courses found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

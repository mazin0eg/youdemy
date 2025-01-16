<?php
// Include the Administrateur class
require_once '../classes/utilisateure.php';
require_once '../db/database.php';
$admin = new Administrateur();

// Handle deletion of a user
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    if ($admin->supprimerUtilisateur($deleteId)) {
        echo "User deleted successfully!";
    } else {
        echo "Failed to delete user.";
    }
}

// Fetch all users
$users = $admin->afficherUtilisateurs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
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
            color: #2980b9;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #2980b9;
            color: #ffffff;
        }

        thead th {
            padding: 15px;
            font-size: 16px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f8fa;
        }

        tbody tr:hover {
            background-color: #eaf2f8;
        }

        tbody td {
            padding: 15px;
            font-size: 15px;
            color: #555;
        }

        tbody td a {
            text-decoration: none;
            color: #e74c3c;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        tbody td a:hover {
            color: #c0392b;
        }

        /* Buttons */
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            tbody td {
                padding: 10px;
            }

            thead th {
                font-size: 14px;
            }

            .delete-btn {
                padding: 8px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>All Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclusion de la classe Administrateur
                include '../classes/Administrateur.php';
                $admin = new Administrateur();

                // Récupération des utilisateurs
                $users = $admin->afficherUtilisateurs();

                // Affichage des utilisateurs dans le tableau
                foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="view_users.php?delete_id=<?php echo $user['id']; ?>" class="delete-btn">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

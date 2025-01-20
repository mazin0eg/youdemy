<?php
require_once '../classes/utilisateure.php';
require_once '../db/database.php';

$admin = new Administrateur();

// Handle tag addition
if (isset($_POST['add_tag'])) {
    $tagName = $_POST['tag_name'];
    // Add the tag to the database (assuming method exists)
    $admin->ajouterTag($tagName); 
}

// Handle tag deletion
if (isset($_POST['delete_tag'])) {
    $tagId = $_POST['tag_id'];
    // Delete the tag from the database (assuming method exists)
    $admin->supprimerTag($tagId);
}

$tags = $admin->afficherTags(); // Fetching tags data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Management</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>YouDemy</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="profile-admin.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="tags.php" class="active"><i class="fas fa-tag"></i> Tags</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Manage Tags</h1>
                <p>View and manage all tags below:</p>
            </header>

            <!-- Add Tag Section -->
            <section class="add-tag-section">
                <h2>Add a New Tag</h2>
                <form method="POST" action="tags.php">
                    <input type="text" name="tag_name" placeholder="Enter tag name" required>
                    <button type="submit" name="add_tag" class="add-btn">Add Tag</button>
                </form>
            </section>

            <!-- Tags Section -->
            <section class="tags-section">
                <h2>All Tags</h2>
                <?php if (count($tags) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tag Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tags as $tag): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($tag['id']); ?></td>
                                    <td><?php echo htmlspecialchars($tag['nom']); ?></td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="tag_id" value="<?php echo $tag['id']; ?>">
                                            <button type="submit" name="delete_tag" class="delete-btn">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No tags found.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <style>
        /* Styles for Add Tag Form */
        .add-tag-section {
            margin-bottom: 30px;
        }

        .add-tag-section input {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-tag-section button {
            padding: 10px 15px;
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-tag-section button:hover {
            background-color: #3498db;
        }

        /* Delete Button with Trash Icon */
        .delete-btn {
            padding: 8px 12px;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 16px;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .delete-btn i {
            margin-right: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
    </style>
</body>
</html>

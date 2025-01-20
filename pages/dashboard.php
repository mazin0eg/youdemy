<?php
require_once '../classes/utilisateure.php';
require_once '../db/database.php';
$admin = new Administrateur();

$users = $admin->afficherUtilisateurs();

$courses = $admin->afficherCours();

$stats = $admin->consulterStatistiquesGlobales();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <li><a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="profile-admin.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="tags.php"><i class="fas fa-tag"></i> Tags</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Welcome Back, Admin!</h1>
                <p>Your dashboard overview is below:</p>
            </header>

            <!-- Statistics Cards -->
            <section class="stats-section">
    <!-- Users Card -->
    <a href="view_users.php" class="stat-card">
        <div class="stat-icon"><i class="fas fa-user"></i></div>
        <div class="stat-info">
            <h3><?php echo $stats['total_users']; ?></h3>
            <p>Total Users</p>
        </div>
    </a>

    <!-- Courses Card -->
    <a href="view_courses.php" class="stat-card">
        <div class="stat-icon"><i class="fas fa-book"></i></div>
        <div class="stat-info">
            <h3><?php echo $stats['total_courses']; ?></h3>
            <p>Total Courses</p>
        </div>
    </a>
</section>


<!-- Recent Users -->
<section class="recent-activity">
    <h2>Users</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><i class="fas fa-user"></i> <?php echo htmlspecialchars($user['nom']); ?> (<?php echo htmlspecialchars($user['role']); ?>)</li>
        <?php endforeach; ?>
    </ul>
</section>

<!-- Recent Courses -->
<section class="recent-activity">
    <h2>Courses</h2>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li><i class="fas fa-book"></i> <?php echo htmlspecialchars($course['titre']); ?></li>
        <?php endforeach; ?>
    </ul>
</section>


            <!-- Recent Activity -->
            <section class="recent-activity">
                <h2>Recent Activity</h2>
                <ul>
                    <li><i class="fas fa-check-circle"></i> Completed "JavaScript Basics" course</li>
                    <li><i class="fas fa-user-plus"></i> New student enrolled: John Doe</li>
                    <li><i class="fas fa-book"></i> Added new course: "Laravel Advanced"</li>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>

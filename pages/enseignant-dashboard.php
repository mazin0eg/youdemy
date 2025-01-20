

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
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
                <h2>Teacher Panel</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="enseignant-dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="my_courses.php"><i class="fas fa-book"></i> My Courses</a></li>
                <li><a href="#students"><i class="fas fa-user-graduate"></i> My Students</a></li>
                <li><a href="add_course.php"><i class="fas fa-plus"></i> Add Course</a></li>
                <li><a href="#settings"><i class="fas fa-cogs"></i> Settings</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Welcome Back, Teacher!</h1>
                <p>Here is an overview of your teaching activities:</p>
            </header>

            <!-- Courses Section -->
            <section id="courses" class="stats-section">
                <h2>My Courses</h2>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Active Courses</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                    <div class="stat-info">
                        <h3>2</h3>
                        <p>Pending Courses</p>
                    </div>
                </div>
            </section>

            <!-- Students Section -->
            <section id="students" class="recent-activity">
                <h2>My Students</h2>
                <ul>
                    <li><i class="fas fa-user"></i> John Doe</li>
                    <li><i class="fas fa-user"></i> Jane Smith</li>
                    <li><i class="fas fa-user"></i> Ahmed Benali</li>
                </ul>
            </section>

            <!-- Add Course Section -->
           
        </main>
    </div>
</body>
</html>

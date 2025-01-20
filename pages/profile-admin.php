<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../style/dashboard.css">

  <style>
    /* General Styles */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-color: #f7f8fa;
      color: #333;
      display: flex;
      min-height: 100vh;
      height: 100vh;
    }

    .dashboard-container {
      display: flex;
      height: 100%;
      flex: 1;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #ffffff;
      box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      padding: 20px 10px;
      height: 100%;    }

    .sidebar-header {
      text-align: center;
      font-size: 22px;
      font-weight: 700;
      color: #333;
      margin-bottom: 30px;
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
      padding: 12px 20px;
      text-decoration: none;
      color: #555;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      transition: background 0.3s, color 0.3s;
    }

    .sidebar-menu a:hover, .sidebar-menu .active {
      background-color: #2980b9;
      color: white;
    }

    .sidebar-menu a i {
      margin-right: 10px;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      padding: 30px;
      background-color: #f4f6fa;
    }

    .header {
      text-align: left;
      margin-bottom: 20px;
    }

    .header h1 {
      font-size: 28px;
      margin-bottom: 10px;
      color: #333;
    }

    .header p {
      color: #777;
    }

    /* Profile Form */
    .profile-form {
      background: #ffffff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-form h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-size: 14px;
      color: #333;
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .form-actions {
      text-align: right;
    }

    .form-actions button {
      padding: 10px 20px;
      border: none;
      background: #2980b9;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .form-actions button:hover {
      background: #216a96;
    }

  </style>
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
        <li><a href="profile-admin.php" class="active"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="tags.php"><i class="fas fa-tag"></i> Tags</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
      <div class="header">
        <h1>Admin Profile</h1>
        <p>Manage your profile details here.</p>
      </div>

      <div class="profile-form">
        <h2>Update Profile</h2>
        <form action="update_profile.php" method="POST">
          <!-- Username -->
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter a new password">
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password">
          </div>

          <!-- Form Actions -->
          <div class="form-actions">
            <button type="submit">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<?php
// Only start a session if one hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Don't redirect if we're on the login page or processing a login
$current_page = basename($_SERVER['PHP_SELF']);
$is_login_page = ($current_page === 'index.php');

// If not logged in and not on the login page, redirect to login
if (!isset($_SESSION['admin']) && !$is_login_page) {
    header('Location: index.php');
    exit;
}

// If already logged in and trying to access login page, redirect to dashboard
if (isset($_SESSION['admin']) && $is_login_page && !isset($_POST['login'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PUNYamu Bukan?</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/images/logo punyamu bukan.png">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .sidebar .nav-link {
            color: #fd7e14 !important; /* Orange color */
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0.25rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, 
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fd7e14 !important; /* Keep orange on hover/active */
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .main-content {
            padding: 2rem;
        }
        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: transform 0.2s;
        }
        .card-dashboard:hover {
            transform: translateY(-5px);
        }
        .table th {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-3">
                        <img src="../assets/images/logo punyamu bukan.png" alt="Logo" style="height: 50px;">
                        <h5 class="mt-2">Admin Panel</h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <i class="fas fa-home"></i> Kembali
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h3"><?= $page_title ?? 'Dashboard' ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="text-muted">
                                <i class="fas fa-user-circle me-1"></i> 
                                <?php 
                                $username = is_array($_SESSION['admin'] ?? null) ? 
                                    ($_SESSION['admin']['username'] ?? 'Admin') : 
                                    ($_SESSION['admin'] ?? 'Admin');
                                echo htmlspecialchars($username); 
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

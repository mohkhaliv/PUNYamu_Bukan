<?php
// Only start a session if one hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = 'Admin Login';
$error = '';

// Process login form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Verify CSRF token if needed
    
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = "Silakan masukkan username dan password";
    } else {
        // Include DB connection only when needed
        require_once '../db.php';
        
        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);
                
                // Set session variables
                $_SESSION['admin'] = [
                    'id' => $user['admin_id'],
                    'username' => $user['username'],
                    'logged_in' => true,
                    'last_activity' => time()
                ];
                
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Username atau password salah";
            }
        } catch (PDOException $e) {
            error_log('Login error: ' . $e->getMessage());
            $error = "Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }
}

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PUNYamu Bukan?</title>
    
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
            display: flex;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-container {
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .login-header {
            background: #2c3e50;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .login-body {
            padding: 2rem;
            background: white;
        }
        .form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }
        .btn-login {
            background-color: #2c3e50;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <img src="../assets/images/logo punyamu bukan.png" alt="Logo" style="height: 60px; margin-bottom: 15px;">
                    <h4 class="mb-0">Admin Panel</h4>
                    <p class="mb-0">Silakan masuk untuk melanjutkan</p>
                </div>
                <div class="login-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= htmlspecialchars($error) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <a href="../index.php" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php exit; ?>
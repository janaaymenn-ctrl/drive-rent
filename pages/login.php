<?php
require_once '../config/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Please enter email and password';
    } else {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type'] = $user['user_type'];

                if ($user['user_type'] === 'admin') {
                    header('Location: ../admin/index.php');
                } else {
                    header('Location: dashboard.php');
                }
                exit();
            } else {
                $error = 'Incorrect password';
            }
        } else {
            $error = 'Email not found';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Drive Rent</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <header>
        <div class="header-container">
            <a href="../index.php" class="logo">
                <i class="fas fa-car"></i>
                Drive Rent
            </a>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="vehicles.php">Our Vehicles</a></li>
                    <li><a href="../about.php">About Us</a></li>
                    <li><a href="../index.php#contact">Contact</a></li>
                    <li><a href="register.php" class="btn btn-primary">Sign Up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Form -->
    <div class="auth-container">
        <div class="auth-box">
            <h2><i class="fas fa-sign-in-alt"></i> Login to Your Account</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="remember_me">
                        Remember me
                    </label>
                    <a href="#" style="color: var(--primary-color); text-decoration: none;">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="auth-link">
                Don't have an account? <a href="register.php">Sign Up Here</a>
            </div>

            <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid var(--border-color);">
            
            <p style="text-align: center; color: #999; font-size: 0.9rem;">
                <strong>Demo Credentials:</strong><br>
                Email: admin@driverent.com<br>
                Password: admin123
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2026 Drive Rent. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
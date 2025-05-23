<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\User;

$user = new User();

if (isset($_POST['submit'])) {
    $user_info = $user->login([
        'email' => $_POST['email'],
    ]);

    if ($user_info && password_verify($_POST['password'], $user_info['password'])) {
        $_SESSION['user'] = $user_info;
        header('Location: my-account.php');
        exit;
    } else {
        $message = 'Invalid username or password';
    }
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: my-account.php');
    exit;
}
?>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/styles.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
/* Nude Blue Theme for Login Page */
body {
    background-color: #e6f0fa; /* very light blue */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.login-card {
    background: #f5f3f1; /* light nude */
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(50, 75, 100, 0.15);
    width: 100%;
    max-width: 400px;
    padding: 30px 35px;
}

.login-card h1 {
    color: #557a95; /* muted blue */
    font-weight: 700;
    margin-bottom: 20px;
}

.login-card h5 {
    font-weight: 600;
}

.input-group-text {
    background-color: #c7d2e7; /* light nude blue */
    border: none;
    color: #557a95;
    font-size: 1.2rem;
}

.form-control {
    border: 1.5px solid #a1b5d8;
    border-left: none;
    color: #557a95;
    font-weight: 500;
}

.form-control:focus {
    outline: none;
    border-color: #6c8ebf;
    box-shadow: 0 0 6px #a1b5d8;
}

.form-text {
    color: #7a8ca8;
    font-size: 0.85rem;
}

.form-check-label {
    color: #557a95;
    font-weight: 500;
}

.btn-gradient {
    width: 100%;
    background: linear-gradient(135deg, #7899c9 0%, #a3b8e6 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 12px 0;
    border-radius: 8px;
    transition: background 0.3s ease;
    cursor: pointer;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #557a95 0%, #7899c9 100%);
}

a {
    color: #557a95;
}

a:hover {
    text-decoration: underline;
}
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h1 class="text-center mb-3"><i class="fas fa-user-circle me-2"></i>Login</h1>
        <h5 class="text-center text-danger"><?php echo isset($message) ? $message : ''; ?></h5>

        <form action="login.php" method="POST">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email address" required>
            </div>
            <div class="form-text mb-2 ms-1">We'll never share your email with anyone else.</div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck">
                <label class="form-check-label" for="rememberCheck">Remember me</label>
            </div>

            <button type="submit" name="submit" class="btn btn-gradient mb-3 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <p class="text-center mt-3" style="font-size: 0.9rem;">
                Don’t have an account? <a href="register.php" class="text-decoration-none">Register here</a>
            </p>
        </form>
    </div>
</div>

<?php template('footer.php'); ?>

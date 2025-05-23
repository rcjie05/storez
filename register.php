<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<style>
/* Nude Blue Register Page Styles */

body {
    background-color: #e6f0f8; /* soft light blue */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2a3d66; /* dark blue-ish text */
}

.register-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.register-card {
    background: #f7f9fc; /* very light nude/blue-ish white */
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(42, 61, 102, 0.15);
    padding: 40px 30px;
    width: 100%;
    max-width: 450px;
    border: 1px solid #c1d1e8; /* subtle border in blue */
}

h1, .alert {
    color: #3a4a7a; /* deeper muted blue */
}

.alert-success {
    background-color: #d7e8fc;
    border-color: #a1b6e2;
    color: #2a3d66;
    font-weight: 600;
}

.input-group-text {
    background-color: #d9e3f0; /* pale blue background for icons */
    border: 1px solid #b0c4df;
    color: #3a4a7a;
}

.form-control {
    border: 1px solid #b0c4df;
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 1rem;
    color: #2a3d66;
    background-color: #f9fbfd; /* very light blue */
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #5a7abd;
    box-shadow: 0 0 5px rgba(90, 122, 189, 0.5);
    outline: none;
    background-color: #fff;
}

.btn-gradient {
    background: linear-gradient(135deg, #7b9acc, #a1b6e2);
    color: #fff;
    border: none;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #5a7abd, #849ed9);
}

.login-link {
    margin-top: 15px;
    text-align: center;
    color: #4a5a7a;
    font-size: 0.95rem;
}

.login-link a {
    color: #7b9acc;
    text-decoration: none;
    transition: color 0.3s ease;
}

.login-link a:hover {
    color: #5a7abd;
}
</style>

<?php

use Aries\MiniFrameworkStore\Models\User;
use Carbon\Carbon;

$user = new User();

if (isset($_POST['submit'])) {
    $registered = $user->register([
        'name' => $_POST['full-name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone'],
        'birthdate' => $_POST['birthdate'],
        'created_at' => Carbon::now('Asia/Manila'),
        'updated_at' => Carbon::now('Asia/Manila')
    ]);
}

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/styles.css">
<!-- FontAwesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<div class="container register-wrapper">
    <div class="register-card">
        <h1 class="text-center mb-4"><i class="fas fa-user-plus me-2"></i>Create Account</h1>
        
        <?php if (isset($registered)): ?>
            <div class="alert alert-success text-center" role="alert">
                <i class="fas fa-check-circle me-1"></i> You have successfully registered!
                <br><a href="login.php" class="alert-link">Click here to login</a>.
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input name="full-name" type="text" class="form-control" placeholder="Full Name" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="form-text mb-2 ms-1">We’ll never share your email with anyone else.</div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                <input name="address" type="text" class="form-control" placeholder="Address">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input name="phone" type="text" class="form-control" placeholder="Phone Number">
            </div>

            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input name="birthdate" type="date" class="form-control">
            </div>

            <button type="submit" name="submit" class="btn btn-gradient w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>

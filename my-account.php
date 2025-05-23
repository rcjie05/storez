<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>
<?php

use Aries\MiniFrameworkStore\Models\User;

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $birthdate = $_POST['birthdate'] ?? null;

    // Update user details in the database
    $userModel = new User();
    $userModel->update([
        'id' => $_SESSION['user']['id'],
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'birthdate' => Carbon\Carbon::createFromFormat('Y-m-d', $birthdate)->format('Y-m-d')
    ]);

    // Update session data
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['address'] = $address;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['birthdate'] = $birthdate;

    echo "<script>alert('Account details updated successfully!');</script>";
}

?>

<style>
/* Nude Blue Theme for My Account */

body {
    background-color: #e6f0fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 960px;
    margin: 40px auto;
    padding: 0 20px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
}

.col-md-4, .col-md-8 {
    box-sizing: border-box;
}

.col-md-4 {
    flex: 0 0 30%;
    background: #f5f3f1;
    border-radius: 15px;
    padding: 25px 20px;
    box-shadow: 0 6px 15px rgba(50, 75, 100, 0.1);
    color: #557a95;
}

.col-md-4 h1 {
    font-weight: 700;
    margin-bottom: 10px;
    color: #557a95;
}

.col-md-4 p {
    font-size: 1.1rem;
    margin-bottom: 25px;
}

.btn-danger {
    background-color: #9b5c5c;
    border: none;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 600;
    color: white;
    transition: background-color 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-danger:hover {
    background-color: #7e4747;
}

.col-md-8 {
    flex: 0 0 65%;
    background: white;
    border-radius: 15px;
    padding: 40px 35px;
    box-shadow: 0 6px 25px rgba(50, 75, 100, 0.15);
}

.col-md-8 h2 {
    font-weight: 700;
    color: #557a95;
    margin-bottom: 30px;
}

.form-label {
    color: #557a95;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #a1b5d8;
    border-radius: 10px;
    font-size: 1rem;
    color: #557a95;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #7899c9;
    box-shadow: 0 0 8px #a1b5d8;
}

button.btn-primary {
    background: linear-gradient(135deg, #7899c9 0%, #a3b8e6 100%);
    border: none;
    color: white;
    font-weight: 700;
    padding: 14px 0;
    width: 100%;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1.1rem;
    margin-top: 20px;
    transition: background 0.3s ease;
}

button.btn-primary:hover {
    background: linear-gradient(135deg, #557a95 0%, #7899c9 100%);
}

@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }
    .col-md-4, .col-md-8 {
        flex: 1 1 100%;
    }
}
</style>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <h1>My Account</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></p>
            <a href="logout.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to log out?');">Logout</a>
        </div>
        <div class="col-md-8">
            <h2>Edit Account Details</h2>
            <form action="my-account.php" method="POST">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name']); ?>" required>

                <label for="email" class="form-label mt-3">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>" required>

                <label for="address" class="form-label mt-3">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($_SESSION['user']['address'] ?? ''); ?>">

                <label for="phone" class="form-label mt-3">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['user']['phone'] ?? ''); ?>">

                <label for="birthdate" class="form-label mt-3">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($_SESSION['user']['birthdate'] ?? ''); ?>">

                <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>

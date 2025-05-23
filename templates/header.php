<?php

require 'vendor/autoload.php';

use Aries\MiniFrameworkStore\Models\Category;

$categories = new Category();

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="store-body">
    <nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">🛒 Online Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-product.php">Add Product</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($categories->getAll() as $category): ?>
                            <li><a class="dropdown-item" href="category.php?name=<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>

            <a class="icon-link" href="cart.php">
                <i class="fas fa-shopping-cart fa-lg"></i>
                <span class="badge bg-success"><?php echo countCart(); ?></span>
            </a>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a 
  class="nav-link dropdown-toggle" 
  href="#" 
  role="button" 
  data-bs-toggle="dropdown"
  style="
    padding: 10px 20px; 
    padding-left: 10px;
    padding-right: 10px;
    background-color: black; 
    color: white; 
    border-radius: 50px;
    transition: background-color 0.3s ease;
  "
>
  Hello, <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; ?>
</a>

                    <ul class="dropdown-menu">
                        <?php if (isLoggedIn()): ?>
                            <li><a class="dropdown-item" href="my-account.php">My Account</a></li>
                            <li><a class="dropdown-item" href="dashboard.php">My Orders</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


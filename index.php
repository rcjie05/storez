<?php include 'helpers/functions.php'; ?>
<?php template('header.php'); ?>

<?php
use Aries\MiniFrameworkStore\Models\Product;

$products = new Product();
$amounLocale = 'en_PH';
$pesoFormatter = new NumberFormatter($amounLocale, NumberFormatter::CURRENCY);
?>

<!-- Load external CSS -->
<link rel="stylesheet" href="assets/css/styles.css">

<!-- Nude Blue Theme Styles -->
<style>
/* Background for the whole store wrapper */
.store-wrapper {
    background-color: #E6EEF6;
    color: #2C3E66;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Hero Box styling */
.hero-box {
    background-color: #567BAE;
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(86, 123, 174, 0.4);
}

/* Heading in Hero */
.hero-box h1 {
    font-weight: 700;
}

/* Product Cards */
.product-card {
    background-color: #FFFFFF;
    border: 1px solid #7DA7D9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(125, 167, 217, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(86, 123, 174, 0.3);
}

/* Product Title */
.product-card .card-title {
    color: #2C3E66;
    font-weight: 600;
}

/* Price styling */
.text-success {
    color: #567BAE !important;
    font-weight: 700;
}

/* Buttons */
.btn-modern {
    background-color: #567BAE;
    color: white;
    border-radius: 6px;
    font-weight: 600;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-modern:hover, .btn-modern:focus {
    background-color: #7DA7D9;
    color: white;
    text-decoration: none;
}

/* Add spacing between product text and buttons */
.card-text {
    color: #405A8C;
}

/* Icons color */
.btn-modern i {
    margin-right: 6px;
}
</style>

<div class="store-wrapper py-5">
    <div class="container">

        <!-- Hero Section -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-10">
                <div class="p-5 hero-box">
                    <h1 class="display-5">Welcome to the Online Store</h1>
                    <p class="lead">Discover your next favorite item today!</p>
                </div>
            </div>
        </div>

        <!-- Product Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">🛒 Products</h2>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($products->getAll() as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 product-card">
                        <img src="<?php echo $product['image_path'] ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <h6 class="text-success mb-2"><?php echo $pesoFormatter->formatCurrency($product['price'], 'PHP'); ?></h6>
                            <p class="card-text mb-4">
                                <?php echo strlen($product['description']) > 100 ? substr($product['description'], 0, 100) . '...' : $product['description']; ?>
                            </p>
                            <div class="mt-auto d-grid gap-2">
                                <a href="product.php?id=<?php echo $product['id'] ?>" class="btn btn-modern btn-view">
                                    <i class="bi bi-eye"></i> View Product
                                </a>
                                <a href="#" class="btn btn-modern btn-cart add-to-cart" data-productid="<?php echo $product['id'] ?>" data-quantity="1">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php template('footer.php'); ?>

<?php

include 'auth.php';
include '../config/db.php';

$product_count = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM products")
);

$user_count = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM users")
);

$order_count = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM orders")
);

$sales = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT SUM(total_amount) total FROM orders")
);

include '../includes/header.php';
?>

<div class="container mt-5">

<h2>Admin Dashboard</h2>

<div class="row mt-4">

<div class="col-md-3">
<div class="card bg-primary text-white">
<div class="card-body">
<h4><?php echo $product_count['total']; ?></h4>
Products
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white">
<div class="card-body">
<h4><?php echo $user_count['total']; ?></h4>
Users
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-warning text-dark">
<div class="card-body">
<h4><?php echo $order_count['total']; ?></h4>
Orders
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white">
<div class="card-body">
<h4>₹<?php echo $sales['total'] ?? 0; ?></h4>
Sales
</div>
</div>
</div>

</div>

<div class="mt-4">

<a href="products.php" class="btn btn-primary">
Manage Products
</a>

<a href="categories.php" class="btn btn-success">
Manage Categories
</a>

<a href="orders.php" class="btn btn-warning">
Manage Orders
</a>

<a href="users.php" class="btn btn-info">
Manage Users
</a>

</div>

</div>

<?php include '../includes/footer.php'; ?>
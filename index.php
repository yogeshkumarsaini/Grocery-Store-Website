<<<<<<< HEAD
<?php

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

$products = mysqli_query($conn,
"SELECT * FROM products ORDER BY id DESC LIMIT 8");

?>

<section class="hero">

<div class="container text-center">

<h1>Fresh Grocery Delivered To Your Door</h1>

<p>Healthy Food & Daily Essentials</p>

<a href="products.php"
class="btn btn-light">
Shop Now
</a>

</div>

</section>

<div class="container mt-5">

<h2 class="mb-4">
Featured Products
</h2>

<div class="row">

<?php while($row=mysqli_fetch_assoc($products)){ ?>

<div class="col-md-3 mb-4">

<div class="card shadow">

<img
src="assets/images/<?php echo $row['image']; ?>"
class="card-img-top product-img">

<div class="card-body">

<h5>
<?php echo $row['product_name']; ?>
</h5>

<p class="text-success fw-bold">
₹ <?php echo $row['price']; ?>
</p>

<a href="product-details.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary">

View Product

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

=======
<?php

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

$products = mysqli_query($conn,
"SELECT * FROM products ORDER BY id DESC LIMIT 8");

?>

<section class="hero">

<div class="container text-center">

<h1>Fresh Grocery Delivered To Your Door</h1>

<p>Healthy Food & Daily Essentials</p>

<a href="products.php"
class="btn btn-light">
Shop Now
</a>

</div>

</section>

<div class="container mt-5">

<h2 class="mb-4">
Featured Products
</h2>

<div class="row">

<?php while($row=mysqli_fetch_assoc($products)){ ?>

<div class="col-md-3 mb-4">

<div class="card shadow">

<img
src="assets/images/<?php echo $row['image']; ?>"
class="card-img-top product-img">

<div class="card-body">

<h5>
<?php echo $row['product_name']; ?>
</h5>

<p class="text-success fw-bold">
₹ <?php echo $row['price']; ?>
</p>

<a href="product-details.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary">

View Product

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
<?php include 'includes/footer.php'; ?>
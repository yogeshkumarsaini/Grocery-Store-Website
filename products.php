<?php

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

$where = " WHERE 1 ";

if(isset($_GET['search']) && $_GET['search'] != '')
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $where .= " AND product_name LIKE '%$search%'";
}

if(isset($_GET['category']) && $_GET['category'] != '')
{
    $category = (int)$_GET['category'];

    $where .= " AND category_id='$category'";
}

$query = mysqli_query($conn,
"SELECT * FROM products $where ORDER BY id DESC");

$categories = mysqli_query($conn,
"SELECT * FROM categories");

?>

<div class="container mt-4">

<div class="row">

<div class="col-md-3">

<div class="card shadow">

<div class="card-header bg-success text-white">
Categories
</div>

<div class="card-body">

<a href="products.php"
class="btn btn-outline-success w-100 mb-2">
All Products
</a>

<?php while($cat=mysqli_fetch_assoc($categories)){ ?>

<a href="products.php?category=<?php echo $cat['id']; ?>"
class="btn btn-outline-secondary w-100 mb-2">

<?php echo $cat['category_name']; ?>

</a>

<?php } ?>

</div>

</div>

</div>

<div class="col-md-9">

<form method="GET">

<div class="input-group mb-4">

<input type="text"
name="search"
class="form-control"
placeholder="Search Products">

<button class="btn btn-success">
Search
</button>

</div>

</form>

<div class="row">

<?php

if(mysqli_num_rows($query)>0)
{
while($product=mysqli_fetch_assoc($query))
{
?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<img src="assets/images/<?php echo $product['image']; ?>"
class="card-img-top product-img">

<div class="card-body">

<h5>
<?php echo $product['product_name']; ?>
</h5>

<p class="text-success fw-bold">
₹ <?php echo $product['price']; ?>
</p>

<p>
Stock:
<?php echo $product['stock']; ?>
</p>

<a href="product-details.php?id=<?php echo $product['id']; ?>"
class="btn btn-primary mb-2">
View Details
</a>

<a href="cart.php?add=<?php echo $product['id']; ?>"
class="btn btn-success">
Add To Cart
</a>

</div>

</div>

</div>

<?php
}
}
else
{
echo "<div class='alert alert-warning'>
No Products Found
</div>";
}
?>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>
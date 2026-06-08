<<<<<<< HEAD
<?php

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = (int)$_GET['id'];

$productQuery = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

$product = mysqli_fetch_assoc($productQuery);

if(!$product)
{
    echo "<div class='container mt-5'>
          <div class='alert alert-danger'>
          Product Not Found
          </div>
          </div>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="container mt-5">

<div class="row">

<div class="col-md-5">

<img
src="assets/images/<?php echo $product['image']; ?>"
class="img-fluid rounded shadow">

</div>

<div class="col-md-7">

<h2>
<?php echo $product['product_name']; ?>
</h2>

<h3 class="text-success">
₹ <?php echo $product['price']; ?>
</h3>

<p>
<?php echo $product['description']; ?>
</p>

<p>
Available Stock :
<b><?php echo $product['stock']; ?></b>
</p>

<a href="cart.php?add=<?php echo $product['id']; ?>"
class="btn btn-success">

Add To Cart

</a>

<a href="products.php"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

=======
<?php

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = (int)$_GET['id'];

$productQuery = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

$product = mysqli_fetch_assoc($productQuery);

if(!$product)
{
    echo "<div class='container mt-5'>
          <div class='alert alert-danger'>
          Product Not Found
          </div>
          </div>";
    include 'includes/footer.php';
    exit();
}
?>

<div class="container mt-5">

<div class="row">

<div class="col-md-5">

<img
src="assets/images/<?php echo $product['image']; ?>"
class="img-fluid rounded shadow">

</div>

<div class="col-md-7">

<h2>
<?php echo $product['product_name']; ?>
</h2>

<h3 class="text-success">
₹ <?php echo $product['price']; ?>
</h3>

<p>
<?php echo $product['description']; ?>
</p>

<p>
Available Stock :
<b><?php echo $product['stock']; ?></b>
</p>

<a href="cart.php?add=<?php echo $product['id']; ?>"
class="btn btn-success">

Add To Cart

</a>

<a href="products.php"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

>>>>>>> 01c2f9787f72f05f6df1b4565ac1f76af4d236a3
<?php include 'includes/footer.php'; ?>
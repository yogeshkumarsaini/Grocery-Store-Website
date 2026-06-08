<?php

include 'auth.php';
include '../config/db.php';

$id = (int)$_GET['id'];

$product = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'")
);

if(isset($_POST['update']))
{
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    mysqli_query($conn,
    "UPDATE products SET
    product_name='$name',
    price='$price',
    stock='$stock',
    description='$description'
    WHERE id='$id'");

    header("Location: products.php");
    exit();
}
?>

<form method="POST">

<input
type="text"
name="product_name"
value="<?php echo $product['product_name']; ?>"
class="form-control">

<br>

<input
type="number"
name="price"
value="<?php echo $product['price']; ?>"
class="form-control">

<br>

<input
type="number"
name="stock"
value="<?php echo $product['stock']; ?>"
class="form-control">

<br>

<textarea
name="description"
class="form-control"><?php echo $product['description']; ?></textarea>

<br>

<button
name="update"
class="btn btn-success">

Update Product

</button>

</form>
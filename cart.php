<?php

session_start();
include 'config/db.php';

/*
|--------------------------------------------------------------------------
| Add Product To Cart
|--------------------------------------------------------------------------
*/

if(isset($_GET['add']))
{
    $product_id = (int)$_GET['add'];

    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$product_id]))
    {
        $_SESSION['cart'][$product_id]++;
    }
    else
    {
        $_SESSION['cart'][$product_id] = 1;
    }

    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Remove Item
|--------------------------------------------------------------------------
*/

if(isset($_GET['remove']))
{
    $product_id = (int)$_GET['remove'];

    unset($_SESSION['cart'][$product_id]);

    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Update Quantity
|--------------------------------------------------------------------------
*/

if(isset($_POST['update_cart']))
{
    foreach($_POST['qty'] as $pid=>$qty)
    {
        if($qty <= 0)
        {
            unset($_SESSION['cart'][$pid]);
        }
        else
        {
            $_SESSION['cart'][$pid] = (int)$qty;
        }
    }
}

include 'includes/header.php';
include 'includes/navbar.php';

$total = 0;
?>

<div class="container mt-5">

<h2 class="mb-4">Shopping Cart</h2>

<?php if(empty($_SESSION['cart'])) { ?>

<div class="alert alert-warning">
Your Cart Is Empty
</div>

<a href="products.php" class="btn btn-success">
Continue Shopping
</a>

<?php } else { ?>

<form method="POST">

<table class="table table-bordered">

<thead class="table-success">

<tr>
<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Subtotal</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php

foreach($_SESSION['cart'] as $product_id=>$qty)
{
$product = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM products WHERE id='$product_id'")
);

$subtotal = $product['price'] * $qty;

$total += $subtotal;
?>

<tr>

<td width="100">
<img src="assets/images/<?php echo $product['image']; ?>"
width="80">
</td>

<td>
<?php echo $product['product_name']; ?>
</td>

<td>
₹ <?php echo $product['price']; ?>
</td>

<td width="120">

<input type="number"
name="qty[<?php echo $product_id; ?>]"
value="<?php echo $qty; ?>"
class="form-control">

</td>

<td>
₹ <?php echo number_format($subtotal,2); ?>
</td>

<td>

<a href="cart.php?remove=<?php echo $product_id; ?>"
class="btn btn-danger btn-sm">

Remove

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<button type="submit"
name="update_cart"
class="btn btn-primary">

Update Cart

</button>

</form>

<div class="card mt-4">

<div class="card-body">

<h4>Total :
₹ <?php echo number_format($total,2); ?></h4>

<a href="checkout.php"
class="btn btn-success">

Proceed To Checkout

</a>

</div>

</div>

<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>